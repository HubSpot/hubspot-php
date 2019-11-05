<?php

namespace SevenShores\Hubspot\Utils;

class OAuth2
{
    const AUTHORIZE_URL = "https://app.hubspot.com/oauth/authorize";

    /**
     * Initiate an Integration with OAuth 2.0
     *
     * @param string $clientId      The Client ID of your app.
     * @param string $redirectURI   The URL that you want the visitor redirected to after granting access to your app. For security reasons, this URL must use https.
     * @param array  $scopesArray   A set of scopes that your app will need access to.
     * @param array  $optionalScopesArray   A set of optional scopes that your app will need access to.
     * @return string
     */
    public static function getAuthUrl($clientId, $redirectURI, $scopesArray = array(), $optionalScopesArray = array())
    {
        return self::AUTHORIZE_URL.'?'.http_build_query([
            'client_id' => $clientId,
            'redirect_uri' => $redirectURI,
            'scope' => implode(' ', $scopesArray),
            'optional_scope' => implode(' ', $optionalScopesArray)
        ]);
    }
}
