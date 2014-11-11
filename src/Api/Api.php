<?php namespace Fungku\HubSpot\Api;

use Fungku\Hubspot\Contracts\HttpClient;
use Fungku\HubSpot\Http\GuzzleClient;

abstract class Api
{
    /**
     * @var string
     */
    protected $baseUrl = "https://api.hubapi.com";

    /**
     * HubSpot api key.
     *
     * @var string
     */
    protected $apiKey;

    /**
     * Client UserAgent.
     *
     * @var string
     */
    protected $userAgent;

    /**
     * @var HttpClient
     */
    protected $client;

    /**
     * @param string     $apiKey    HubSpot api key.
     * @param string     $userAgent Client user agent.
     * @param HttpClient $client    Client that implements HttpClient interface.
     */
    function __construct($apiKey, $userAgent, HttpClient $client = null)
    {
        $this->apiKey = $apiKey;
        $this->userAgent = $userAgent;
        $this->client = $client ?: new GuzzleClient();
    }

    /**
     * @param string $requestType
     * @param string $endpoint
     * @param array  $options
     * @return mixed
     */
    protected function call($requestType, $endpoint, $options)
    {
        $url = $this->baseUrl . $endpoint . '?hapikey=' . $this->apiKey;

        $options['headers']['User-Agent'] = $this->userAgent;

        return $this->client->$requestType($url, $options);
    }
}