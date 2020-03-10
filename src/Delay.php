<?php

namespace SevenShores\Hubspot;

class Delay
{
    public static function getConstantDelayFunction(int $secondsDelay = 10)
    {
        return function ($retries) use ($secondsDelay) {
            return 1000 * $secondsDelay;
        };
    }

    public static function getLinearDelayFunction()
    {
        return function ($retries) {
            return 1000 * $retries;
        };
    }

    public static function getExponentialDelayFunction(int $base)
    {
        return function ($retries) use ($base) {
            return 1000 * pow($base, $retries);
        };
    }
}
