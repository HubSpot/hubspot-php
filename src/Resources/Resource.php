<?php

namespace SevenShores\Hubspot\Resources;

use SevenShores\Hubspot\Http\Client;

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
    function __construct(Client $client)
    {
        $this->client = $client;
    }
}