<?php

namespace SevenShores\Hubspot\Endpoints;

abstract class Endpoint
{
    /**
     * @var \SevenShores\Hubspot\Http\Client
     */
    protected $client;

    /**
     * Makin' a good old endpoint.
     *
     * @param \SevenShores\Hubspot\Http\Client $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Convert a time, DateTime, or string to a millisecond timestamp.
     *
     * @param null|\DateTime|int $time
     *
     * @return null|int
     */
    protected function timestamp($time)
    {
        return ms_timestamp($time);
    }
}
