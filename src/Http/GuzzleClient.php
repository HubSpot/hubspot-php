<?php namespace Fungku\HubSpot\Http;

use Fungku\Hubspot\Contracts\HttpClient;
use GuzzleHttp\Client;

class GuzzleClient implements HttpClient
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * Constructor.
     */
    function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param $url
     * @param array $options
     */
    public function get($url, $options = [])
    {
        return $this->client->get($url, $options);
    }

    /**
     * @param $url
     * @param array $options
     */
    public function post($url, $options = [])
    {
        return $this->client->post($url, $options);
    }

    /**
     * @param $url
     * @param array $options
     */
    public function put($url, $options = [])
    {
        return $this->client->put($url, $options);
    }

    /**
     * @param $url
     * @param array $options
     */
    public function delete($url, $options = [])
    {
        return $this->client->delete($url, $options);
    }
}