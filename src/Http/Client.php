<?php

namespace SevenShores\Hubspot\Http;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Psr\Http\Message\ResponseInterface;
use SevenShores\Hubspot\Exceptions\BadRequest;
use SevenShores\Hubspot\Exceptions\HubspotException;
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
     * Guzzle allows options into its request method. Prepare for some defaults.
     *
     * @var array
     */
    protected $clientOptions = [];

    /**
     * if set to false, no Response object is created, but the one from Guzzle is directly returned
     * comes in handy own error handling.
     *
     * @var bool
     */
    protected $wrapResponse = true;

    /** @var string */
    protected $user_agent = 'SevenShores_Hubspot_PHP/2.0.4 (https://github.com/HubSpot/hubspot-php)';

    /**
     * Make it, baby.
     *
     * @param array        $config        Configuration array
     * @param GuzzleClient $client        The Http Client (Defaults to Guzzle)
     * @param array        $clientOptions options to be passed to Guzzle upon each request
     * @param bool         $wrapResponse  wrap request response in own Response object
     */
    public function __construct(array $config = [], $client = null, array $clientOptions = [], bool $wrapResponse = true)
    {
        $this->clientOptions = $clientOptions;
        $this->wrapResponse = $wrapResponse;

        $this->key = isset($config['key']) ? $config['key'] : getenv('HUBSPOT_SECRET');

        if (isset($config['userId'])) {
            $this->userId = $config['userId'];
        }

        $this->oauth = isset($config['oauth']) ? $config['oauth'] : false;
        $this->oauth2 = isset($config['oauth2']) ? $config['oauth2'] : false;
        if ($this->oauth && $this->oauth2) {
            throw new InvalidArgument('Cannot sign requests with both OAuth1 and OAuth2');
        }

        if (is_null($client)) {
            $client = new GuzzleClient();
        }
        $this->client = $client;
    }

    /**
     * Send the request...
     *
     * @param string $method        The HTTP request verb
     * @param string $endpoint      The Hubspot API endpoint
     * @param array  $options       An array of options to send with the request
     * @param string $query_string  A query string to send with the request
     * @param bool   $requires_auth Whether or not this HubSpot API endpoint requires authentication
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     * @throws \SevenShores\Hubspot\Exceptions\HubspotException
     *
     * @return ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function request(string $method, string $endpoint, array $options = [], $query_string = null, bool $requires_auth = true)
    {
        if ($requires_auth && empty($this->key)) {
            throw new InvalidArgument('You must provide a Hubspot api key or token.');
        }

        $url = $this->generateUrl($endpoint, $query_string, $requires_auth);

        $options = array_merge($this->clientOptions, $options);
        $options['headers']['User-Agent'] = $this->user_agent;

        if ($this->oauth2) {
            $options['headers']['Authorization'] = 'Bearer '.$this->key;
        }

        try {
            if (false === $this->wrapResponse) {
                return $this->client->request($method, $url, $options);
            }

            return new Response($this->client->request($method, $url, $options));
        } catch (ServerException $e) {
            if (false === $this->wrapResponse) {
                throw $e;
            }

            throw HubspotException::create($e);
        } catch (ClientException $e) {
            if (false === $this->wrapResponse) {
                throw $e;
            }

            throw BadRequest::create($e);
        }
    }

    /**
     * Generate the full endpoint url, including query string.
     *
     * @param string $endpoint      the HubSpot API endpoint
     * @param string $query_string  the query string to send to the endpoint
     * @param bool   $requires_auth Whether or not this HubSpot API endpoint requires authentication
     *
     * @return string
     */
    protected function generateUrl(string $endpoint, $query_string = null, $requires_auth = true)
    {
        $url = $endpoint.'?';

        if ($requires_auth) {
            $authType = $this->oauth ? 'access_token' : 'hapikey';
            $query_params = [];

            if (!$this->oauth2) {
                $query_params[$authType] = $this->key;
            }

            if ($this->userId) {
                $query_params['userId'] = $this->userId;
            }

            $query_string .= $this->addQuery($query_string, http_build_query($query_params));
        }

        return $url.$query_string;
    }

    /**
     * @param string $query_string the query string to send to the endpoint
     * @param string $addition     addition query string to send to the endpoint
     */
    protected function addQuery($query_string, $addition): string
    {
        $result = '';

        if (!empty($addition)) {
            if (empty($query_string)) {
                $result = $addition;
            } else {
                $result .= '&'.$addition;
            }
        }

        return $result;
    }
}
