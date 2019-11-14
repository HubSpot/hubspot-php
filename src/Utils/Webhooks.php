<?php

namespace SevenShores\Hubspot\Utils;

class Webhooks
{
    /**
     * Validation of Hubspot Signature.
     *
     * @param string $signature   hubspot signarute
     * @param string $secret      the Secret of your app
     * @param string $requestBody a set of scopes that your app will need access to
     *
     * @return bool
     */
    public static function isHubspotSignatureValid($signature, $secret, $requestBody)
    {
        return $signature == hash('sha256', $secret.$requestBody);
    }
}
