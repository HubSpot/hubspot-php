<?php

namespace SevenShores\Hubspot\Http;

use GuzzleHttp\Client as GuzzleClient;
use Psr\Http\Message\ResponseInterface;
use SevenShores\Hubspot\Exceptions\BadRequest;
use SevenShores\Hubspot\Exceptions\InvalidArgument;

class Client
{
    /** @var string */
    public $key;
    /** @var bool */
    public $oauth;

    /** @var bool */
    public $oauth2;

    /** @var int */
    public $userId;

    /** @var \GuzzleHttp\Client */
    public $client;

    /**
     * Guzzle allows options into its request method. Prepare for some defaults
     * @var array
     */
    protected $clientOptions = [];

    /**
     * if set to false, no Response object is created, but the one from Guzzle is directly returned
     * comes in handy own error handling
     *
     * @var bool
     */
    protected $wrapResponse = true;

    /** @var string */
    private $user_agent = "SevenShores_Hubspot_PHP/1.0.0-rc.1 (https://github.com/ryanwinchester/hubspot-php)";

    /**
     * Make it, baby.
     *
     * @param  array $config Configuration array
     * @param  GuzzleClient $client The Http Client (Defaults to Guzzle)
     * @param array $clientOptions options to be passed to Guzzle upon each request
     * @param bool $wrapResponse wrap request response in own Response object
     */
    public function __construct($config = [], $client = null, $clientOptions = [], $wrapResponse = true)
    {
        $this->clientOptions = $clientOptions;
        $this->wrapResponse = $wrapResponse;

        $this->key = isset($config["key"]) ? $config["key"] : getenv("HUBSPOT_SECRET");
        if (empty($this->key)) {
            throw new InvalidArgument("You must provide a Hubspot api key or token.");
        }

        if (isset($config['userId'])) {
            $this->userId = $config['userId'];
        }

        $this->oauth = isset($config["oauth"]) ? $config["oauth"] : false;
        $this->oauth2 = isset($config["oauth2"]) ? $config["oauth2"] : false;
        if ($this->oauth && $this->oauth2) {
            throw new InvalidArgument("Cannot sign requests with both OAuth1 and OAuth2");
        }

        $this->client = $client ?: new GuzzleClient();
    }

    /**
     * Send the request...
     *
     * @param  string $method The HTTP request verb
     * @param  string $endpoint The Hubspot API endpoint
     * @param  array $options An array of options to send with the request
     * @param  string $query_string A query string to send with the request
     * @param  boolean $requires_auth Whether or not this HubSpot API endpoint requires authentication
     * @return \SevenShores\Hubspot\Http\Response|ResponseInterface
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     */
    public function request($method, $endpoint, $options = [], $query_string = null, $requires_auth = true)
    {
        $url = $this->generateUrl($endpoint, $query_string, $requires_auth);

        $options = array_merge($this->clientOptions, $options);
        $options["headers"]["User-Agent"] = $this->user_agent;

        if ($this->oauth2) {
            $options["headers"]["Authorization"] = "Bearer " . $this->key;
        }

        try {
            if ($this->wrapResponse === false) {
                return $this->client->request($method, $url, $options);
            }
            return new Response($this->client->request($method, $url, $options));
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            throw new BadRequest(\GuzzleHttp\Psr7\str($e->getResponse()), $e->getCode(), $e);
        } catch (\Exception $e) {
            throw new BadRequest($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Generate the full endpoint url, including query string.
     *
     * @param  string  $endpoint      The HubSpot API endpoint.
     * @param  string  $query_string  The query string to send to the endpoint.
     * @param  boolean $requires_auth Whether or not this HubSpot API endpoint requires authentication
     * @return string
     */
    protected function generateUrl($endpoint, $query_string = null, $requires_auth = true)
    {
        $url = $endpoint."?";

        if ($requires_auth) {
            $authType = $this->oauth ? "access_token" : "hapikey";

            if (!$this->oauth2) {
                $url .= $authType."=".$this->key;

                if ($this->userId) {
                    $url .= "&userId={$this->userId}";
                }
            } else {
                if ($this->userId) {
                    $url .= "userId={$this->userId}";
                }
            }
        }

        return $url.$query_string;
    }
}
