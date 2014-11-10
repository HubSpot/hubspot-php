<?php namespace Fungku\HubSpot\Http;

use Fungku\Hubspot\Contracts\HttpClient;
use GuzzleHttp\Client;

/**
 * Class GuzzleClient
 * @package Fungku\HubSpot
 *
 * @method get     get($url, $options)
 * @method post    post($url, $options)
 * @method head    head($url, $options)
 * @method put     put($url, $options)
 * @method delete  delete($url, $options)
 * @method options options($url, $options)
 * @method patch   patch($url, $options)
 */
class GuzzleClient implements HttpClient
{
    /**
     * @var array
     */
    protected $calls = array('get', 'post', 'head', 'put', 'delete', 'options', 'patch');

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
        if ( ! in_array($name, $this->$calls)) {
            throw new \InvalidArgumentException("");
        }

        $options = isset($arguments['options']) ? $arguments['options'] : null;

        return $this->client->$name($arguments['url'], $options);
    }
}