<?php

namespace Fungku\HubSpot\Api;

use Fungku\HubSpot\Contracts\HttpClient;
use Fungku\HubSpot\Support\QueryBuilder;
use GuzzleHttp\Exception\RequestException;

abstract class Api
{
    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var HttpClient
     */
    protected $client;

    /**
     * @var bool
     */
    private $oauth;

    /**
     * @var string
     */
    protected $baseUrl = "https://api.hubapi.com";

    const USER_AGENT = 'Fungku_HubSpot_PHP/0.9 (https://github.com/ryanwinchester/hubspot-php)';

    /**
     * @param  string     $apiKey
     * @param  HttpClient $client
     * @param  bool       $oauth
     */
    public function __construct($apiKey, HttpClient $client, $oauth = false)
    {
        $this->apiKey = $apiKey;
        $this->client = $client;
        $this->oauth = $oauth;
    }

    /**
     * Send the request to the HubSpot API.
     *
     * @param  string $method  The HTTP request verb.
     * @param  string $url     The url to send the request to.
     * @param  array  $options An array of options to send with the request.
     * @return \Fungku\HubSpot\Http\Response
     */
    protected function requestUrl($method, $url, array $options = [])
    {
        $options['headers']['User-Agent'] = self::USER_AGENT;

        try {
            return $this->client->$method($url, $options);
        } catch (RequestException $e) {
            return $e->getResponse();
        }
    }

    /**
     * Build the request to the HubSpot API.
     *
     * @param  string $method      The HTTP request verb.
     * @param  string $endpoint    The HubSpot API endpoint.
     * @param  array  $options     An array of options to send with the request.
     * @param  string $queryString A query string to send with the request.
     * @return \Fungku\HubSpot\Http\Response
     */
    protected function request($method, $endpoint, $options = [], $queryString = null)
    {
        $url = $this->generateUrl($endpoint, $queryString);

        return $this->requestUrl($method, $url, $options);
    }

    /**
     * Generate the full endpoint url, including query string.
     *
     * @param  string $endpoint    The HubSpot API endpoint.
     * @param  string $queryString The query string to send to the endpoint.
     * @return string
     */
    protected function generateUrl($endpoint, $queryString = null)
    {
        $authType = $this->oauth ? 'access_token' : 'hapikey';

        return $this->baseUrl . $endpoint . '?' . $authType . '=' . $this->apiKey . $queryString;
    }

    /**
     * @param  array $query
     * @return string
     */
    protected function buildQueryString($query = [])
    {
        return QueryBuilder::build($query);
    }
}
