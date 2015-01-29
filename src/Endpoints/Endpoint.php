<?php namespace Fungku\HubSpot\Endpoints;

abstract class Endpoint
{
    /**
     * @var string
     */
    protected $baseUrl = "https://api.hubapi.com";

    private function __construct()
    {
        //
    }

    public static function endpoint($endpoint)
    {
        return new static::$$endpoint;
    }

    protected function endpoint(array $vars = [])
    {
        $endpoint_key = $this->getEndpointKey();

        return $this->generateEndpoint($endpoint_key, $vars);
    }

    private function getEndpointKey()
    {
        $callers = debug_backtrace();

        return $callers[2]['function'];
    }

    private function generateEndpoint($key, array $vars = [])
    {
        if (count($vars)) {
            return array_walk($vars, replace($key, $vars, $this->endpoints[$key]));
        }

        return $this->endpoints[$key];

    }

    private function replace($key, $var, $string)
    {

    }
}