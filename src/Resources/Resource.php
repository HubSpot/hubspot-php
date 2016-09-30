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

    /**
     * Convert a timestamp or DateTime to a millisecond timestamp.
     *
     * @param \DateTime|int|null $timestamp
     * @return int|null
     */
    protected function timestamp($timestamp)
    {
        switch (true) {
            case $timestamp instanceof \DateTime:
                return $timestamp->getTimestamp() * 1000;
            case is_numeric($timestamp) && strlen((string)$timestamp) == 10:
                return $timestamp * 1000;
            default:
                return $timestamp;
        }
    }
}