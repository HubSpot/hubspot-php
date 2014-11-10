<?php namespace Fungku\Hubspot\Contracts;

interface HttpClient
{
    public function get($url);

    public function post($url, $params, $optionsß);
}