<?php

if (! function_exists('build_query_string')) {
    /**
     * Generate a query string.
     *
     * @param  array $params
     * @param  int   $encoding
     * @return string
     */
    function build_query_string($params = [], $encoding = PHP_QUERY_RFC3986)
    {
        if (empty($params)) {
            return '';
        }

        $query = '';
        foreach ($params as $key => $value) {
            if (is_array($value)) {
                $query .= build_batch_query_string($key, $value, $encoding);
            } elseif (!empty($value)) {
                $query .= '&' . url_encode($key, $encoding) . '=' . url_encode($value, $encoding);
            }
        }

        return $query ?: '';
    }
}

if (! function_exists('build_batch_query_string')) {
    /**
     * Generate a query string for batch requests.
     *
     * @param  string $key   The name of the query variable.
     * @param  array  $items An array of item values for the variable.
     * @param  int    $encoding
     * @return string
     */
    function build_batch_query_string($key, $items, $encoding = PHP_QUERY_RFC3986)
    {
        return array_reduce($items, function ($query, $item) use ($key, $encoding) {
            return $query . "&" . url_encode($key, $encoding) . '=' . url_encode($item, $encoding);
        }, '');
    }
}

if (! function_exists('url_encode')) {
    /**
     * Url encode a string.
     *
     * @param  string $value
     * @param  int    $encoding
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

if (! function_exists('ms_timestamp')) {
    /**
     * Get a millisecond timestamp from a date or time.
     *
     * @param  mixed $time
     * @return int
     */
    function ms_timestamp($time)
    {
        switch (true) {
            case $time instanceof \DateTime:
                return $time->getTimestamp() * 1000;
            case is_numeric($time) && strlen((string) $time) === 10:
                return $time * 1000;
            case is_string($time):
                return strtotime($time) * 1000;
            default:
                return $time;
        }
    }
}
