<?php namespace Fungku\HubSpot\Api;

use Fungku\HubSpot\Exceptions\HubSpotException;
use Fungku\HubSpot\Endpoint;

abstract class Api
{
    protected $apiKey;
    protected $userAgent = 'Fungku_HubSpot_PHP/0.1 (https://github.com/fungku/hubspot-php)';

    function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    //public function __call($endpoint, array $params = [])
    //{
    //    if ( ! isset($this->$endpoint)) {
    //        throw new HubSpotException('Endpoint does not exist.');
    //    }
    //
    //    $endpoint = Endpoint::make($this->$endpoint);
    //
    //    return Request::make($endpoint, $params);
    //}
    //
    //private function replaceKeys($endpoint, array $keys)
    //{
    //    foreach ($keys as $key => $value) {
    //        $endpoint = str_replace('{' . $key . '}', $value, $endpoint);
    //    }
    //
    //    return $endpoint;
    //}
    //
    ///**
    // * @param string  $method
    // * @param string  $endpoint
    // * @param array   $options
    // * @param string  $queryString
    // * @return mixed
    // */
    //protected function request($method, $endpoint, array $options = [], $queryString = null)
    //{
    //    $url = $this->generateUrl($endpoint, $queryString);
    //
    //    $options['headers']['User-Agent'] = $this->userAgent;
    //
    //    return $this->client->$method($url, $options);
    //}
    //
    ///**
    // * @param string $endpoint
    // * @param string $queryString
    // * @return string
    // */
    //protected function generateUrl($endpoint, $queryString = null)
    //{
    //    return $this->baseUrl . $endpoint . '?hapikey=' . $this->apiKey . $queryString;
    //}
    //
    //protected function makeRequest($endpoint, array $args = [])
    //{
    //    $endpoint = Endpoint::contacts($endpoint);
    //
    //    $params = array_pop($args['params']);
    //
    //    $vars = $args;
    //
    //    return Request::make($endpoint, $vars, $params);
    //
    //}
}