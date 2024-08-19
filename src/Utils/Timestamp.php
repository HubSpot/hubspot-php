<?php

namespace SevenShores\Hubspot\Utils;

class Timestamp
{
    public static function getCurrentTimestampWithMilliseconds(): int
    {
        return intval(microtime(true) * 1000);
    }
}
