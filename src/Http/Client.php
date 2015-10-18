<?php

namespace Fungku\HubSpot\Http;

use Fungku\HubSpot\Contracts\HttpClient;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;

class Client implements HttpClient
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * Make it, baby.
     *
     * @param \GuzzleHttp\Client $client
     */
    public function __construct(GuzzleClient $client = null)
    {
        $this->client = $client ?: new GuzzleClient();
    }

    /**
     * Submit the request and build the response object.
     *
     * @param string $method
     * @param string $url
     * @param array  $options
     * @return \Fungku\HubSpot\Http\Response
     */
    private function makeRequest($method, $url, $options)
    {
        try {
            return new Response($this->client->request($method, $url, $options));
        } catch (RequestException $e) {
            return new Response($e->getResponse());
        }
    }

    /**
     * @param  string $url
     * @param  array  $options
     * @return \Fungku\HubSpot\Http\Response
     */
    public function get($url, $options = [])
    {
        return $this->makeRequest('GET', $url, $options);
    }

    /**
     * @param  string $url
     * @param  array  $options
     * @return \Fungku\HubSpot\Http\Response
     */
    public function post($url, $options = [])
    {
        return $this->makeRequest('POST', $url, $options);
    }

    /**
     * @param  string $url
     * @param  array  $options
     * @return \Fungku\HubSpot\Http\Response
     */
    public function put($url, $options = [])
    {
        return $this->makeRequest('PUT', $url, $options);
    }

    /**
     * @param  string $url
     * @param  array  $options
     * @return \Fungku\HubSpot\Http\Response
     */
    public function delete($url, $options = [])
    {
        return $this->makeRequest('DELETE', $url, $options);
    }
}
