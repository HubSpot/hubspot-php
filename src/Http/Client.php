<?php namespace Fungku\HubSpot\Http;

use Fungku\HubSpot\Contracts\HttpClient;
use Fungku\HubSpot\Http\Response;
use GuzzleHttp\Client as GuzzleClient;

class Client implements HttpClient
{
    /**
     * @var GuzzleClient
     */
    protected $client;

    /**
     * steven's most favourite constructor.
     */
    public function __construct()
    {
        $this->client = new GuzzleClient();
    }

    /**
     * @param string $url
     * @param array $options
     * @return Response
     */
    public function get($url, array $options = [])
    {
        return new Response($this->client->get($url, $options));
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
