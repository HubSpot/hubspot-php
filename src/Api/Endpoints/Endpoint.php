<?php namespace Fungku\HubSpot\Endpoints;

abstract class Endpoint
{
    private function __construct()
    {
        //
    }

    public static function endpoint($endpoint)
    {
        return new static::$$endpoint;
    }
}