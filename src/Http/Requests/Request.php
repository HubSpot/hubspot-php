<?php Fungku\HubSpot\Requests;

use Fungku\HubSpot\Contracts\Endpoint;
use Fungku\Hubspot\Contracts\HttpClient;
use Fungku\HubSpot\Contracts\HttpRequest;

class Request implements HttpRequest
{
    /**
     * @var HttpClient
     */
    private $client;

    /**
     * @var Endpoint
     */
    private $endpoint;

    /**
     * @var array
     */
    private $params;

    /**
     * @param Endpoint   $endpoint
     * @param HttpClient $client
     * @param array      $params
     */
    protected function __construct(Endpoint $endpoint, HttpClient $client, array $params = [])
    {
        $this->client = $client;
        $this->endpoint = $endpoint;
        $this->params = $params;
    }

    public static function make(Endpoint $endpoint, HttpClient $client, array $params = [])
    {
        return new static($endpoint, $client, $params);
    }

    public function send()
    {
        $method = $this->endpoint->method();

        return $this->client->$method($this->endpoint->url(), $$this->params);
    }
}
