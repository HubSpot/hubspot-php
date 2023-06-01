<?php

namespace SevenShores\Hubspot;

use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class RetryMiddlewareFactory
{
    public static function createInternalErrorsMiddleware(
        callable $delayFunction = null,
        int $maxRetries = 5
    ) {
        return static::createMiddlewareByHttpCodeRange(500, 504, $delayFunction, $maxRetries);
    }

    public static function createRateLimitMiddleware(
        callable $delayFunction = null,
        int $maxRetries = 5
    ) {
        return static::createMiddlewareByHttpCodes([429], $delayFunction, $maxRetries);
    }

    /**
     * @param string $delayType Currently supports сonstant delay, exponential delay,
     *                          linear delay or null
     */
    public static function createMiddlewareByHttpCodes(
        array $codes,
        callable $delayFunction,
        int $maxRetries = 5
    ): callable {
        return Middleware::retry(
            static::getRetryFunction($codes, $maxRetries),
            $delayFunction
        );
    }

    /**
     * @param string $delayType Currently supports сonstant delay, exponential delay,
     *                          linear delay or null
     */
    public static function createMiddlewareByHttpCodeRange(
        int $from,
        int $to,
        callable $delayFunction,
        int $maxRetries = 5
    ): callable {
        return Middleware::retry(
            static::getRetryFunctionByRange($from, $to, $maxRetries),
            $delayFunction
        );
    }

    public static function getRetryFunctionByRange(
        int $from,
        int $to,
        int $maxRetries = 5
    ) {
        return function (
            $retries,
            Request $request,
            Response $response = null
        ) use ($from, $to, $maxRetries) {
            if ($retries >= $maxRetries) {
                return false;
            }

            if ($response instanceof Response) {
                if (($response->getStatusCode() >= $from) && ($response->getStatusCode() <= $to)) {
                    return true;
                }
            }

            return false;
        };
    }

    public static function getRetryFunction(array $codes, int $maxRetries = 5)
    {
        return function (
            $retries,
            Request $request,
            Response $response = null
        ) use ($codes, $maxRetries) {
            if ($retries >= $maxRetries) {
                return false;
            }

            if (($response instanceof Response) && in_array($response->getStatusCode(), $codes)) {
                return true;
            }

            return false;
        };
    }
}
