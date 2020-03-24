<?php

namespace SevenShores\Hubspot;

use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\Resource;

class HubspotClient implements HubspotClientInterface
{
    /** @var Client */
    protected $client;

    /**
     * @param array  $config        An array of configurations. You need at least the 'key'.
     * @param Client $client        the Http Client (defaults to Guzzle)
     * @param array  $clientOptions options to be send with each request
     * @param bool   $wrapResponse  wrap request response in own Response object
     */
    public function __construct(array $config = [], Client $client = null, array $clientOptions = [], $wrapResponse = true)
    {
        if (null === $client) {
            $client = new Client($config, null, $clientOptions, $wrapResponse);
        }

        $this->client = $client;
    }

    /**
     * Returns an instance of a Resource based on the method called.
     *
     * @param mixed $args
     */
    public function __call(string $name, $args): Resource
    {
        $resource = 'SevenShores\\Hubspot\\Resources\\'.ucfirst($name);

        return new $resource($this->client, ...$args);
    }
}
