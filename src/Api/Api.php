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
     * @param string  $method
     * @param string  $endpoint
     * @param array   $options
     * @param string  $queryString
     * @return mixed
     */
    protected function request($method, $endpoint, array $options = [], $queryString = null)
    {
        $url = $this->generateUrl($endpoint, $queryString);

        $options['headers']['User-Agent'] = $this->userAgent;

        return $this->client->$method($url, $options);
    }

    /**
     * @param string $endpoint
     * @param string $queryString
     * @return string
     */
    protected function generateUrl($endpoint, $queryString = null)
    {
        return $this->baseUrl . $endpoint . '?hapikey=' . $this->apiKey . $queryString;
    }
}