<?php namespace Fungku\Hubspot\Contracts;

interface HttpClient
{
    public function get();

    public function post();
}