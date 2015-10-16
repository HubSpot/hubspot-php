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
     * @param string $url
     * @param array $options
     * @return mixed
     */
    public function get($url, array $options = [])
    {
        $contents = $this->client->request('GET', $url, $options)
            ->getBody()
            ->getContents();

        return json_decode($contents);
    }

    /**
     * @param string $url
     * @param array $options
     * @return mixed
     */
    public function post($url, array $options = [])
    {
        $contents = $this->client->request('POST', $url, $options)
            ->getBody()
            ->getContents();

        return json_decode($contents);
    }

    /**
     * @param string $url
     * @param array $options
     * @return mixed
     */
    public function put($url, array $options = [])
    {
        $contents = $this->client->request('PUT', $url, $options)
            ->getBody()
            ->getContents();

        return json_decode($contents);
    }

    /**
     * @param string $url
     * @param array $options
     * @return mixed
     */
    public function delete($url, array $options = [])
    {
        $contents = $this->client->request('DELETE', $url, $options)
            ->getBody()
            ->getContents();

        return json_decode($contents);
    }
}
