<?php namespace Fungku\HubSpot\Api;

use Fungku\HubSpot\Exceptions\HubSpotException;
use Fungku\HubSpot\Endpoint;

abstract class Api
{
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
     * @param string     $apiKey    HubSpot api key.
     * @param string     $userAgent Client user agent.
     */
    function __construct($apiKey, $userAgent)
    {
        $this->apiKey = $apiKey;
        $this->userAgent = $userAgent;
    }

    public function __call($endpoint, array $params = [])
    {
        if ( ! isset($this->$endpoint)) {
            throw new HubSpotException('Endpoint does not exist.');
        }

        $endpoint = Endpoint::make($this->$endpoint);

        return Request::make($endpoint, $params);
    }

    private function replaceKeys($endpoint, array $keys)
    {
        foreach ($keys as $key => $value) {
            $endpoint = str_replace('{' . $key . '}', $value, $endpoint);
        }

        return $endpoint;
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

    protected function makeRequest($endpoint, array $args = [])
    {
        $endpoint = Endpoint::contacts($endpoint);

        $params = array_pop($args['params']);

        $vars = $args;

        return Request::make($endpoint, $vars, $params);

    }
}