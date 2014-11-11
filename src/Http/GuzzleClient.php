<?php namespace Fungku\HubSpot\Http;

use Fungku\HubSpot\Contracts\HttpClient;
use GuzzleHttp\Client;

class GuzzleClient implements HttpClient
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * steven's most favourite constructor.
     */
    function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param string $url
     * @param array  $options
     */
    public function get($url, array $options = [])
    {
        return $this->client->get($url, $options)->json();
    }

    /**
     * @param string $url
     * @param array  $options
     */
    public function post($url, array $options = [])
    {
        return $this->client->post($url, $options);
    }

    /**
     * @param string $url
     * @param array  $options
     */
    public function put($url, array $options = [])
    {
        return $this->client->put($url, $options);
    }

    /**
     * @param string $url
     * @param array  $options
     */
    public function delete($url, array $options = [])
    {
        return $this->client->delete($url, $options);
    }
}