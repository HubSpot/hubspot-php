<?php

namespace SevenShores\Hubspot\Utils;

use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\OAuth2 as OAuthResource;

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
        return self::AUTHORIZE_URL . '?' . http_build_query([
            'client_id' => $clientId,
            'redirect_uri' => $redirectURI,
            'scope' => implode(' ', $scopesArray),
            'optional_scope' => implode(' ', $optionalScopesArray),
        ], null, '&', PHP_QUERY_RFC3986);
    }

    /**
     * Get OAuth 2.0 Access Token and Refresh Tokens by using a one-time code
     *
     * @param string $clientId The Client ID of your app.
     * @param string $clientSecret The Client Secret of your app.
     * @param string $redirectURI The redirect URI that was used when the user authorized your app. This must exactly match the redirect_uri used when initiating the OAuth 2.0 connection.
     * @param string $tokenCode The code parameter returned to your redirect URI when the user authorized your app. Or a refresh token.
     * @return Response
     * @throws BadRequest
     */
    public static function getTokensByCode($clientId, $clientSecret, $redirectURI, $tokenCode)
    {
        $oauth = new OAuthResource(new Client());
        return $oauth->getTokensByCode($clientId, $clientSecret, $redirectURI, $tokenCode);
    }

    /**
     * Get OAuth 2.0 Access Token and Refresh Tokens by using a refresh token
     * Note: Contrary to HubSpot documentation, $redirectURI is NOT required.
     *
     * @param string $clientId The Client ID of your app.
     * @param string $clientSecret The Client Secret of your app.
     * @param string $refreshToken The refresh token.
     * @return Response
     * @throws BadRequest
     */
    public static function getTokensByRefresh($clientId, $clientSecret, $refreshToken)
    {
        $oauth = new OAuthResource(new Client());
        return $oauth->getTokensByRefresh($clientId, $clientSecret, $refreshToken);
    }

    /**
     * Get Information for OAuth 2.0 Access Token
     *
     * @param int $token The access token that you want to get the information for.
     * @return Response
     * @throws BadRequest
     */
    public static function getAccessTokenInfo($token)
    {
        $oauth = new OAuthResource(new Client());
        return $oauth->getAccessTokenInfo($token);
    }

    /**
     * Get Information for OAuth 2.0 Refresh Token
     *
     * @param int $token The refresh token that you want to get the information for.
     * @return Response
     * @throws BadRequest
     */
    public static function getRefreshTokenInfo($token)
    {
        $oauth = new OAuthResource(new Client());
        return $oauth->getRefreshTokenInfo($token);
    }

    /**
     * Delete OAuth 2.0 Refresh Token
     *
     * @param int $token The refresh token that you want to delete.
     * @return Response
     * @throws BadRequest
     */
    public static function deleteRefreshToken($token)
    {
        $oauth = new OAuthResource(new Client());
        return $oauth->deleteRefreshToken($token);
    }
}
