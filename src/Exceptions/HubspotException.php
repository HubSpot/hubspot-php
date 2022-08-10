<?php

namespace SevenShores\Hubspot\Exceptions;

use Exception;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;

class HubspotException extends Exception
{
    /** @var null|Response */
    protected $response;

    /**
     * @return null|Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    public static function create(RequestException $guzzleException): self
    {
        $e = new static(
            static::sanitizeResponseMessage($guzzleException->getMessage()),
            $guzzleException->getCode(),
            $guzzleException
        );

        $e->response = $guzzleException->getResponse();

        return $e;
    }

    protected static function sanitizeResponseMessage(string $message): string
    {
        return preg_replace('/(hapikey|access_token)=[a-z0-9-]+/i', '$1=***', $message);
    }
}
