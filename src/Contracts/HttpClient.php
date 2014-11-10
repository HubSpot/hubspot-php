<?php namespace Fungku\Hubspot\Contracts;

interface HttpClient
{
    public function get($url, $options);

    public function post($url, $options);

    public function delete($url, $options);

    public function put($url, $options);
}