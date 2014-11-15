<?php namespace Fungku\Hubspot\Contracts;

interface HttpClient
{
    public function get($url, array $options);

    /**
     * @return \GuzzleHttp\Message\ResponseInterface
     */
    public function post($url, array $options);

    /**
     * @return \GuzzleHttp\Message\ResponseInterface
     */
    public function delete($url, array $options);

    /**
     * @return \GuzzleHttp\Message\ResponseInterface
     */
    public function put($url, array $options);
}
