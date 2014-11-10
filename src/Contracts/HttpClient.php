<?php namespace Fungku\Hubspot\Contracts;

interface HttpClient
{
    public function get($url, $options);

    public function post($url, $options);
}