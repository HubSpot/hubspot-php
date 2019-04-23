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
     * @var int Number of requests remaining this second
     */
    private $requestsRemainingThisSecond = null;

    private $requestsRemainingThisSecondTime = null;

    /** @var int Max number of exceptions we can handle before aborting the re-try */
    private $exceptionMax = null;

    /** @var int Delay before retry in microseconds when an exception occurs */
    private $exceptionDelay = null;

    /** @var int Delay before we wait before requests when API reports low request credits  */
    private $backOffDelay = null;

    /** @var bool Handle rate limits automatically */
    private $handleRateLimits = null;

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

        $this->exceptionMax = isset($config["exceptionMax"]) ? $config["exceptionMax"] : 10;
        $this->exceptionDelay = isset($config["exceptionDelay"]) ? $config["exceptionDelay"] : 1000000;
        $this->backOffDelay = isset($config["backOffDelay"]) ? $config["backOffDelay"] : 1000000;
        $this->handleRateLimits = isset($config["handleRateLimits"]) ? $config["handleRateLimits"] : true;

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
            $keepTrying = true;
            $exceptionCounter = 0;
            if($this->handleRateLimits
                && !is_null($this->requestsRemainingThisSecond)
                && (
                    ($this->requestsRemainingThisSecond <= 1)
                    ||
                    (($this->requestsRemainingThisSecond <= 2)
                        && ($this->requestsRemainingThisSecondTime == time()))
                )
            ){
                usleep($this->backOffDelay);
            }
            do {
                try {
                    $response = $this->client->request($method, $url, $options);
                    $keepTrying = false;
                } catch (\GuzzleHttp\Exception\BadResponseException $e) {
                    if(!$this->handleRateLimits) {
                        throw $e;
                    }
                    switch ($e->getCode()) {
                        /**
                         * @see https://developers.hubspot.com/docs/faq/api-error-responses
                         *
                         * 500 This is not documented but it happens. Seems like its part of the rate limiting but they
                         * choose this instead of 429 in some cases. If the message is "internal error" then that means
                         * we have to backoff, otherwise re-throw the user error for them to handle it
                         */
                        case 500:
                            if(strpos($e->getMessage(),'"message":"internal error"') === false) {
                                throw $e;
                            }
                        /**
                         * 502/504 timeouts - HubSpot has processing limits in place to prevent a single client causing
                         * degraded performance, and these responses indicate that those limits have been hit.
                         * You'll normally only see these timeout responses when making a a large number of requests
                         * over a sustained period.  If you get one of these responses, you should pause your requests
                         * for a few seconds, then retry.
                         */
                        case 502:
                        case 504:
                            /**
                             * 429 Too many requests - Returned when your portal or app is over the API rate limits.
                             * Please see this document for details on those rate limits and suggestions for working within
                             * those limits.
                             */
                        case 429:
                            $header = $e->getResponse()->getHeader('X-HubSpot-RateLimit-Daily-Remaining');
                            if(is_array($header) && sizeof($header)) {
                                $dailyLimitLeft = (int)$header[0];
                                if($dailyLimitLeft === 0) {
                                    throw $e;
                                }
                            }
                            $exceptionCounter++;
                            if ($exceptionCounter >= $this->exceptionMax) {
                                throw $e;
                            }
                            usleep($this->exceptionDelay);
                            $keepTrying = true;
                            break;
                        default: // Throw to outer handler
                            throw $e;
                    }
                }
            } while ($keepTrying === true);

            // Check headers for delay
            if($this->handleRateLimits) {
                $header = $response->getHeader('X-HubSpot-RateLimit-Secondly-Remaining');
                if(is_array($header) && sizeof($header)) {
                    $this->requestsRemainingThisSecond = (int)$header[0];
                    $this->requestsRemainingThisSecondTime = time();
                }
            }

            if ($this->wrapResponse === false) {
                return $response;
            }
            return new Response($response);
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
