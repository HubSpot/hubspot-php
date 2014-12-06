<?php namespace Fungku\HubSpot\Api;

use Fungku\HubSpot\Http\Client;

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
     * @var Client
     */
    protected $client;

    /**
     * @param string     $apiKey    HubSpot api key.
     * @param string     $userAgent Client user agent.
     */
    function __construct($apiKey, $userAgent)
    {
        $this->apiKey = $apiKey;
        $this->userAgent = $userAgent;
        $this->client = new Client();
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

    protected function endpoint(array $vars = [])
    {
        $endpoint_key = $this->getEndpointKey();

        return $this->generateEndpoint($endpoint_key, $vars);
    }

    private function getEndpointKey()
    {
        $callers = debug_backtrace();

        return $callers[2]['function'];
    }

    private function generateEndpoint($key, array $vars = [])
    {
        if (count($vars)) {
            return array_walk($vars, replace($key, $vars, $this->endpoints[$key]));
        }

        return $this->endpoints[$key];

    }

    private function replace($key, $var, $string)
    {
        return str_replace('{' . $key . '}', $var, $string);
    }

    protected function makeRequest($endpoint, array $args = [])
    {
        $endpoint = Endpoint::contacts($endpoint);

        $params = array_pop($args['params']);

        $vars = $args;

        return Request::make($endpoint, $vars, $params);

    }
}