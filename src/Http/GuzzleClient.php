<?php namespace Fungku\Http;

use Fungku\Hubspot\Contracts\HttpClient;
use GuzzleHttp\Client;

class GuzzleClient implements HttpClient
{
    function __construct()
    {
        $this->client = new GuzzleHttp\Client();
    }

    public function get($url, $params, $options)
    {
        return $this->client->get($url);
    }

    public function post($url, $params, $options)
    {
        return $this->client->post($url);
    }
}