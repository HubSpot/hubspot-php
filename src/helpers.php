<?php

namespace Fungku\HubSpot;

/**
 * Borrowed from GuzzleHttp\Psr7:
 *
 * Build a query string from an array of key value pairs.
 *
 * This function can use the return value of parseQuery() to build a query
 * string. This function does not modify the provided keys when an array is
 * encountered (like http_build_query would).
 *
 * @param array     $params   Query string parameters.
 * @param int|false $encoding Set to false to not encode, PHP_QUERY_RFC3986
 *                            to encode using RFC3986, or PHP_QUERY_RFC1738
 *                            to encode using RFC1738.
 * @return string
 */
function build_query($params = [], $encoding = PHP_QUERY_RFC3986)
{
    if (empty($params)) {
        return '';
    }

    if ($encoding === false) {
        $encoder = function ($str) { return $str; };
    } elseif ($encoding == PHP_QUERY_RFC3986) {
        $encoder = 'rawurlencode';
    } elseif ($encoding == PHP_QUERY_RFC1738) {
        $encoder = 'urlencode';
    } else {
        throw new \InvalidArgumentException('Invalid type');
    }

    $qs = '';
    foreach ($params as $k => $v) {
        $k = $encoder($k);
        if (!is_array($v)) {
            $qs .= $k;
            if ($v !== null) {
                $qs .= '=' . $encoder($v);
            }
            $qs .= '&';
        } else {
            foreach ($v as $vv) {
                $qs .= $k;
                if ($vv !== null) {
                    $qs .= '=' . $encoder($vv);
                }
                $qs .= '&';
            }
        }
    }

    return $qs ? (string) substr($qs, 0, -1) : '';
}
