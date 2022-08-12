<?php

namespace SevenShores\Hubspot\Utils;

class Webhooks
{
    /**
     * Validation of Hubspot Signature.
     *
     * @deprecated
     *
     * @param string $signature   hubspot signarute
     * @param string $secret      the Secret of your app
     * @param string $requestBody a set of scopes that your app will need access to
     */
    public static function isHubspotSignatureValid($signature, $secret, $requestBody): bool
    {
        return $signature == hash('sha256', $secret.$requestBody);
    }
}
