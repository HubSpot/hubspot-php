<?php

namespace SevenShores\Hubspot\Resources;

class OAuth2 extends Resource
{
	protected $endpoint = 'https://api.hubapi.com/oauth/v1';

	/**
	 * Initiate an Integration with OAuth 2.0
	 *
	 * @param string $clientId      The Client ID of your app.
	 * @param string $redirectURI   The URL that you want the visitor redirected to after granting access to your app. For security reasons, this URL must use https.
	 * @param array  $scopesArray   A set of scopes that your app will need access to.
	 * @return \SevenShores\Hubspot\Http\Response
	 */
	function getAuthUrl($clientId, $redirectURI, $scopesArray=array())
	{
		$scopeString = '';
		if(count($scopesArray)>0)
		{
			$scopeString = '';
			foreach($scopesArray as $_index => $scopeStr)
			{
				if($_index>0)
					$scopeString .= "%20";

				$scopeString .= $scopeStr;
			}
		}

		return "https://app.hubspot.com/oauth/authorize?client_id={$clientId}&scope={$scopeString}&redirect_uri=".urlencode($redirectURI);
	}

	/**
	 * Get OAuth 2.0 Access Token and Refresh Tokens by using a one-time code
	 *
	 * @param string $clientId      The Client ID of your app.
	 * @param string $clientSecret  The Client Secret of your app.
	 * @param string $redirectURI   The redirect URI that was used when the user authorized your app. This must exactly match the redirect_uri used when initiating the OAuth 2.0 connection.
	 * @param string $tokenCode     The code parameter returned to your redirect URI when the user authorized your app. Or a refresh token.
	 * @return \SevenShores\Hubspot\Http\Response
	 */
	function getTokensByCode($clientId, $clientSecret, $redirectURI, $tokenCode)
	{
		$options['form_params'] = [
			'grant_type' => 'authorization_code',
			'client_id' => $clientId,
			'client_secret' => $clientSecret,
			'redirect_uri' => $redirectURI,
			'code' => $tokenCode
		];

		$options['headers']['content-type'] = 'application/x-www-form-urlencoded';

		return $this->client->request('post', $this->endpoint.'/token', $options);
	}

	/**
	 * Get OAuth 2.0 Access Token and Refresh Tokens by using a refresh token
	 * Note: Contrary to HubSpot documentation, $redirectURI is NOT required.
	 *
	 * @param string $clientId      The Client ID of your app.
	 * @param string $clientSecret  The Client Secret of your app.
	 * @param string $refreshToken  The refresh token.
	 * @return \SevenShores\Hubspot\Http\Response
	 */
	function getTokensByRefresh($clientId, $clientSecret, $refreshToken)
	{
		$options['form_params'] = [
			'grant_type' => 'refresh_token',
			'client_id' => $clientId,
			'client_secret' => $clientSecret,
			'refresh_token' => $refreshToken
		];

		$options['headers']['content-type'] = 'application/x-www-form-urlencoded';

		return $this->client->request('post', $this->endpoint.'/token', $options);
	}

	/**
	 * Get Information for OAuth 2.0 Access Token
	 *
	 * @param  int $token The access token that you want to get the information for.
	 * @return \SevenShores\Hubspot\Http\Response
	 */
	function getAccessTokenInfo($token)
	{
		return $this->client->request('get', $this->endpoint."/access-tokens/{$token}");
	}

	/**
	 * Get Information for OAuth 2.0 Refresh Token
	 *
	 * @param  int $token The refresh token that you want to get the information for.
	 * @return \SevenShores\Hubspot\Http\Response
	 */
	function getRefreshTokenInfo($token)
	{
		return $this->client->request('get', $this->endpoint."/refresh-tokens/{$token}");
	}

	/**
	 * Delete OAuth 2.0 Refresh Token
	 *
	 * @param  int $token The refresh token that you want to delete.
	 * @return \SevenShores\Hubspot\Http\Response
	 */
	function deleteRefreshToken($token)
	{
		return $this->client->request('delete', $this->endpoint."/refresh-tokens/{$token}");
	}

}
