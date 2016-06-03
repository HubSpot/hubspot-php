<?php

namespace SevenShores\Hubspot\Resources;

abstract class Resource
{
    /**
     * @var \SevenShores\Hubspot\Http\Client
     */
    protected $client;

    /**
     * Makin' a good ole resource
     *
     * @param \SevenShores\Hubspot\Http\Client $client
     */
    function __construct($client)
    {
        $this->client = $client;
    }
}