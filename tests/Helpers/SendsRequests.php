<?php

namespace SevenShores\Hubspot\Tests\Helpers;

trait SendsRequests
{
    protected $client;
    protected $base_url = 'https://api.hubapi.com';
    protected $auth = '?hapikey=demo';
    protected $api_key = 'demo';
    protected $headers = [
        'User-Agent' => 'SevenShores_Hubspot_PHP/1.0 (https://github.com/ryanwinchester/hubspot-php)',
    ];

    protected function buildQuery($query = [])
    {
        return build_query_string($query);
    }

    protected function buildUrl($endpoint, $query_string = null)
    {
        return $this->base_url.$endpoint.$this->auth.$query_string;
    }
}
