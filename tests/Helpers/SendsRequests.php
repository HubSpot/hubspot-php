<?php

namespace Fungku\HubSpot\Tests\Helpers;

use Fungku\HubSpot\Support\QueryBuilder;

trait SendsRequests
{
    protected $client;

    protected $baseUrl = 'https://api.hubapi.com';

    protected $auth = '?hapikey=demo';

    protected $apiKey = 'demo';

    protected $headers = [
        'User-Agent' => 'Fungku_HubSpot_PHP/0.9 (https://github.com/ryanwinchester/hubspot-php)',
    ];

    protected function buildQuery($query = [])
    {
        return QueryBuilder::build($query);
    }

    protected function buildUrl($endpoint, $queryString = null)
    {
        return $this->baseUrl . $endpoint . $this->auth . $queryString;
    }
}
