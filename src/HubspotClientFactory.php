<?php

namespace SevenShores\Hubspot;

use SevenShores\Hubspot\Http\Client;

class HubspotClientFactory
{
    /**
     * Creates an instance of the service with an API key.
     *
     * @param string $api_key       hubspot API key
     * @param Client $client        an Http client
     * @param array  $clientOptions options to be send with each request
     * @param bool   $wrapResponse  wrap request response in own Response object
     *
     * @return static
     */
    public static function create(string $api_key = null, Client $client = null, array $clientOptions = [], bool $wrapResponse = true): HubspotClientInterface
    {
        return new HubspotClient(['key' => $api_key], $client, $clientOptions, $wrapResponse);
    }

    /**
     * Creates an instance of the service with an OAuth token.
     *
     * @param string $token         hubspot oauth access token
     * @param Client $client        an Http client
     * @param array  $clientOptions options to be send with each request
     * @param bool   $wrapResponse  wrap request response in own Response object
     *
     * @return static
     */
    public static function createWithToken(string $token, Client $client = null, array $clientOptions = [], bool $wrapResponse = true): HubspotClientInterface
    {
        return new HubspotClient(['key' => $token, 'oauth' => true], $client, $clientOptions, $wrapResponse);
    }

    /**
     * Creates an instance of the service with an OAuth2 token.
     *
     * @param string $token         hubspot OAuth2 access token
     * @param Client $client        an Http client
     * @param array  $clientOptions options to be send with each request
     * @param bool   $wrapResponse  wrap request response in own Response object
     *
     * @return static
     */
    public static function createWithOAuth2Token(string $token, Client $client = null, array $clientOptions = [], bool $wrapResponse = true): HubspotClientInterface
    {
        return new HubspotClient(['key' => $token, 'oauth2' => true], $client, $clientOptions, $wrapResponse);
    }
}
