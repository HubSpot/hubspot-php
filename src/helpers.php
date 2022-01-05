<?php

if (!function_exists('build_query_string')) {
    /**
     * Generate a query string.
     *
     * @param int $encoding
     */
    function build_query_string(array $params = [], $encoding = PHP_QUERY_RFC3986): string
    {
        if (empty($params)) {
            return '';
        }

        $query = '';
        foreach ($params as $key => $value) {
            if (empty($value)) {
                continue;
            }

            if (is_array($value)) {
                $query .= build_batch_query_string($key, $value, $encoding);

                continue;
            }

            $parameter = url_encode($key, $encoding);
            $propertyValue = is_bool($value) ? 'true' : url_encode($value, $encoding);
            $query .= "&{$parameter}={$propertyValue}";
        }

        return $query ?: '';
    }
}

if (!function_exists('build_batch_query_string')) {
    /**
     * Generate a query string for batch requests.
     *
     * @param string $key      the name of the query variable
     * @param array  $items    an array of item values for the variable
     * @param int    $encoding
     */
    function build_batch_query_string($key, array $items, $encoding = PHP_QUERY_RFC3986): string
    {
        return array_reduce($items, function ($query, $item) use ($key, $encoding) {
            return $query.'&'.url_encode($key, $encoding).'='.url_encode($item, $encoding);
        }, '');
    }
}

if (!function_exists('url_encode')) {
    /**
     * Url encode a string.
     *
     * @param string $value
     * @param int    $encoding
     *
     * @return string
     */
    function url_encode($value, $encoding = PHP_QUERY_RFC3986)
    {
        switch ($encoding) {
            case false:
                return $value;

            case PHP_QUERY_RFC3986:
                return rawurlencode($value);

            case PHP_QUERY_RFC1738:
                return urlencode($value);

            default:
                throw new \InvalidArgumentException('Invalid type');
        }
    }
}

if (!function_exists('ms_timestamp')) {
    /**
     * Get a millisecond timestamp from a date or time.
     *
     * @param mixed $time
     *
     * @return int
     */
    function ms_timestamp($time)
    {
        switch (true) {
            case $time instanceof \DateTime:
                return $time->getTimestamp() * 1000;

            case is_numeric($time) && 10 === strlen((string) $time):
                return $time * 1000;

            case is_string($time):
                return strtotime($time) * 1000;

            default:
                return $time;
        }
    }
}
