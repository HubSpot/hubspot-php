<?php

namespace Fungku\HubSpot;

use Fungku\HubSpot\Exceptions\HubSpotException;
use Fungku\HubSpot\Contracts\HttpClient;
use Fungku\HubSpot\Http\Client;

/**
 * Class HubSpotService
 * @package Fungku\HubSpot
 *
 * @method \Fungku\HubSpot\Api\Blogs blogs()
 * @method \Fungku\HubSpot\Api\BlogPosts blogPosts()
 * @method \Fungku\HubSpot\Api\ContactLists contactLists()
 * @method \Fungku\HubSpot\Api\ContactProperties contactProperties()
 * @method \Fungku\HubSpot\Api\Contacts contacts()
 * @method \Fungku\HubSpot\Api\Email email()
 * @method \Fungku\HubSpot\Api\EmailEvents emailEvents()
 * @method \Fungku\HubSpot\Api\Files files()
 * @method \Fungku\HubSpot\Api\Forms forms()
 * @method \Fungku\HubSpot\Api\Keywords keywords()
 * @method \Fungku\HubSpot\Api\MarketPlace marketPlace()
 * @method \Fungku\HubSpot\Api\Pages pages()
 * @method \Fungku\HubSpot\Api\SocialMedia socialMedia()
 * @method \Fungku\HubSpot\Api\Workflows workflows()
 * @method \Fungku\HubSpot\Api\Events events()
 */
class HubSpotService
{
    /**
     * The HubSpot API key or Oauth token.
     *
     * @var string
     */
    private $apiKey;

    /**
     * Using Oauth?
     *
     * @var bool
     */
    private $oauth;

    /**
     * C O N S T R U C T
     *
     * @param  string|null  $apiKey
     * @param  bool         $oauth
     * @param  HttpClient   $client
     * @throws HubSpotException
     */
    protected function __construct($apiKey = null, $oauth = false, HttpClient $client = null)
    {
        $this->oauth = $oauth;
        $this->apiKey = $apiKey ?: getenv('HUBSPOT_API_KEY');

        if (empty($this->apiKey)) {
            throw new HubSpotException("You must provide a HubSpot api key.");
        }
        $this->client = $client ?: new Client();
    }

    /**
     * Make an instance of the service with an API key.
     *
     * @param  string      $apiKey  HubSpot Api key
     * @param  HttpClient  $client  An HttpClient implementation
     * @return static
     */
    public static function make($apiKey = null, HttpClient $client = null)
    {
        return new static($apiKey, false, $client);
    }

    /**
     * Make an instance of the service with an Oauth token.
     *
     * @param  string      $access_token  HubSpot oauth access token
     * @param  HttpClient  $client        An HttpClient implementation
     * @return static
     */
    public static function makeWithToken($access_token, HttpClient $client = null)
    {
        return new static($access_token, true, $client);
    }

    /**
     * Return an instance of an API class based on the method called.
     *
     * @param  string  $name
     * @param  array   $arguments
     * @return mixed
     * @throws HubSpotException
     */
    public function __call($name, $arguments = null)
    {
        $apiClass = $this->getApiClassName($name);

        if (! (new \ReflectionClass($apiClass))->isInstantiable()) {
            throw new HubSpotException("Target [$apiClass] is not instantiable.");
        }

        return new $apiClass($this->apiKey, $this->client, $this->oauth);
    }

    /**
     * Get the API Class name from the method name.
     *
     * @param  string  $name
     * @return string
     */
    protected function getApiClassName($name)
    {
        return 'Fungku\\HubSpot\\Api\\' . ucfirst($name);
    }
}
