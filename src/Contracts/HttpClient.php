<?php

namespace Fungku\HubSpot\Contracts;

interface HttpClient
{
    /**
     * @param  string  $url
     * @param  array   $options
     * @return \Fungku\HubSpot\Http\Response
     */
    public function get($url, $options = []);

    /**
     * @param  string  $url
     * @param  array   $options
     * @return \Fungku\HubSpot\Http\Response
     */
    public function post($url, $options = []);

    /**
     * @param  string  $url
     * @param  array   $options
     * @return \Fungku\HubSpot\Http\Response
     */
    public function delete($url, $options = []);

    /**
     * @param  string  $url
     * @param  array   $options
     * @return \Fungku\HubSpot\Http\Response
     */
    public function put($url, $options = []);
}
