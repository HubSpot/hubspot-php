<?php namespace Fungku\HubSpot;

class Endpoint
{
    private $baseUrl = "https://api.hubapi.com";

    private $method;

    private $endpoint;

    private $requiredParams;

    private $optionalParams;

    private function __construct(array $endpoint)
    {
        $this->method         = $endpoint['method'];
        $this->endpoint       = $endpoint['endpoint'];
        $this->requiredParams = $endpoint['required_params'];
        $this->optionalParams = $endpoint['optional_params'];
    }

    public static function make(array $endpoint)
    {
        return new static($endpoint);
    }

    public function method()
    {
        return $this->method;
    }

    public function url()
    {
        return $this->baseUrl . $this->endpoint;
    }

    public function params()
    {
        return array_merge($this->requiredParams, $this->optionalParams);
    }
} 