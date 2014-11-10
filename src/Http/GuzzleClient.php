<?php namespace Fungku\HubSpot\Http;

use Fungku\Hubspot\Contracts\HttpClient;
use GuzzleHttp\Client;

/**
 * Class GuzzleClient
 * @package Fungku\HubSpot
 *
 * @method get($url, $options)
 * @method post($url, $options)
 * @method put($url, $options)
 * @method delete($url, $options)
 */
class GuzzleClient implements HttpClient
{
    /**
     * HTTP requests.
     *
     * @var array
     */
    protected $requests = array('get', 'post', 'put', 'delete');

    /**
     * Constructor.
     */
    function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if ( ! in_array($name, $this->requests)) {
            throw new \InvalidArgumentException("");
        }

        $options = isset($arguments['options']) ? $arguments['options'] : null;

        return $this->client->$name($arguments['url'], $options);
    }
}