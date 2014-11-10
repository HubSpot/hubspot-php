<?php namespace Fungku\HubSpot\Providers;

use Fungku\Hubspot\Contracts\HttpClient;
use Fungku\HubSpot\Http\GuzzleClient;

abstract class HubSpotProvider
{
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
}