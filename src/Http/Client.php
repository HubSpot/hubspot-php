<?php

namespace Fungku\HubSpot\Http;

use Fungku\HubSpot\Contracts\HttpClient;
use GuzzleHttp\Client as GuzzleClient;

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
     * @param  string  $url
     * @param  array   $options
     * @return \Fungku\HubSpot\Http\Response
     */
    public function get($url, $options = [])
    {
        return new Response($this->client->request('GET', $url, $options));
    }

    /**
     * @param  string  $url
     * @param  array   $options
     * @return \Fungku\HubSpot\Http\Response
     */
    public function post($url, $options = [])
    {
        return new Response($this->client->request('POST', $url, $options));
    }

    /**
     * @param  string  $url
     * @param  array   $options
     * @return \Fungku\HubSpot\Http\Response
     */
    public function put($url, $options = [])
    {
        return new Response($this->client->request('PUT', $url, $options));
    }

    /**
     * @param  string  $url
     * @param  array   $options
     * @return \Fungku\HubSpot\Http\Response
     */
    public function delete($url, $options = [])
    {
        return new Response($this->client->request('DELETE', $url, $options));
    }
}
