<?php

namespace SevenShores\Hubspot\Utils;

use UnexpectedValueException;

class Signature
{
    /**
     * Reject the request if the timestamp is older than 5 minutes. Otherwise, proceed with validating the signature.
     * 5 minutes in milliseconds.
     */
    public const MAX_ALLOWED_TIMESTAMP = 300000;

    /**
     * Validation of Hubspot Signature.
     *
     * @param array<signature: string, secret: string, requestBody: string, httpUri: string, httpMethod: string, timestamp?: string, signatureVersion?: string, checkTimestamp?: string> $options
     * @param string $secret['signature']        hubspot signarute
     * @param string $secret['secret']           the Secret of your app
     * @param string $secret['requestBody']      the request body include the payload of the request as a JSON string
     * @param string $secret['httpUri']          the full URL of the incoming request, including the http:// prefix, the path of your endpoint, and any query parameters
     * @param string $secret['httpMethod']       the method of the incoming request, such as GET or POST
     * @param string $secret['timestamp']        a unix timestamp of the request, provided in the X-HubSpot-Request-Timestamp header (Reject the request if the timestamp is older than 5 minutes)
     * @param string $secret['signatureVersion'] signature version (V1, V2 or V3)
     * @param bool   $secret['checkTimestamp']   check timestamp or not (default value true)
     */
    public static function isValid(
        array $options
    ): bool {
        $signatureVersion = static::getOptionOrThrow($options, 'signatureVersion', 'v1');

        if ('v3' === $signatureVersion && static::getOptionOrThrow($options, 'checkTimestamp', true)) {
            $currentTimestamp = Timestamp::getCurrentTimestampWithMilliseconds();
            $timestamp = (int) static::getOptionOrThrow($options, 'timestamp');
            if (($currentTimestamp - $timestamp) > static::MAX_ALLOWED_TIMESTAMP) {
                return false;
            }
        }

        $hash = static::getHashedSignature($signatureVersion, $options);

        return hash_equals(static::getOptionOrThrow($options, 'signature'), $hash);
    }

    /**
     * Get hashed signature.
     *
     * @param string $signatureVersion signature version (V1, V2 or V3)
     * @param array<signature: string, secret: string, requestBody: string, httpUri: string, httpMethod: string, timestamp?: string, signatureVersion: string> $options
     * @param string $secret['secret']      the Secret of your app
     * @param string $secret['requestBody'] the request body include the payload of the request as a JSON string
     * @param string $secret['httpUri']     the full URL of the incoming request, including the http:// prefix, the path of your endpoint, and any query parameters
     * @param string $secret['httpMethod']  the method of the incoming request, such as GET or POST
     * @param string $secret['timestamp']   a unix timestamp of the request, provided in the X-HubSpot-Request-Timestamp header
     */
    public static function getHashedSignature(
        string $signatureVersion,
        array $options
    ): string {
        switch ($signatureVersion) {
            case 'v1':
                $sourceString = static::getOptionOrThrow($options, 'secret').static::getOptionOrThrow($options, 'requestBody');

                return hash('sha256', $sourceString);

            case 'v2':
                $sourceString = static::getOptionOrThrow($options, 'secret').static::getOptionOrThrow($options, 'httpMethod').static::getOptionOrThrow($options, 'httpUri').static::getOptionOrThrow($options, 'requestBody');

                return hash('sha256', $sourceString);

            case 'v3':
                $sourceString = static::getOptionOrThrow($options, 'httpMethod').static::getOptionOrThrow($options, 'httpUri').static::getOptionOrThrow($options, 'requestBody').static::getOptionOrThrow($options, 'timestamp');

                return base64_encode(hash_hmac('sha256', $sourceString, static::getOptionOrThrow($options, 'secret'), true));

            default:
                throw new UnexpectedValueException("Not supported signature version: {$signatureVersion}");
        }
    }

    protected static function getOptionOrThrow(array $options, string $name, $default = null)
    {
        if (array_key_exists($name, $options)) {
            return $options[$name];
        }

        if (null !== $default) {
            return $default;
        }

        throw new UnexpectedValueException("Not provided {$name}");
    }
}
