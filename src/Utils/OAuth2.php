<?php

namespace SevenShores\Hubspot\Utils;

class OAuth2
{
    const AUTHORIZE_URL = 'https://app.hubspot.com/oauth/authorize';

    /**
     * Initiate an Integration with OAuth 2.0.
     *
     * @param string $clientId            the Client ID of your app
     * @param string $redirectURI         The URL that you want the visitor redirected to after granting access to your app. For security reasons, this URL must use https.
     * @param array  $scopesArray         a set of scopes that your app will need access to
     * @param array  $optionalScopesArray a set of optional scopes that your app will need access to
     *
     * @return string
     */
    public static function getAuthUrl($clientId, $redirectURI, array $scopesArray = [], array $optionalScopesArray = [])
    {
        return self::AUTHORIZE_URL.'?'.http_build_query([
            'client_id' => $clientId,
            'redirect_uri' => $redirectURI,
            'scope' => implode(' ', $scopesArray),
            'optional_scope' => implode(' ', $optionalScopesArray),
        ], null, '&', PHP_QUERY_RFC3986);
    }
}
