<?php

namespace SevenShores\Hubspot\Utils;

class Webhooks
{
    /**
     * Validation of Hubspot Signature
     * @param string $signature     Hubspot signarute.
     * @param string $secret        The Secret of your app.
     * @param string $requestBody   A set of scopes that your app will need access to.
     *
     * @return bool
     */
    public static function isHubspotSignatureValid($signature, $secret, $requestBody)
    {
        return ($signature == hash('sha256', $secret.$requestBody));
    }
}
