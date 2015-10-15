<?php

namespace Fungku\HubSpot;

use Fungku\HubSpot\Exceptions\HubSpotException;
use Fungku\HubSpot\Contracts\HttpClient;

/**
 * Class HubSpotService
 *
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
     * Api Key or OAuth token
     *
     * @var string
     */
    private $apiKey;

    /**
     * Use Oauth?
     *
     * @var bool
     */
    private $oauth;

    /**
     * Setup the service with required information
     *
     * @param string|null $apiKey ApiKey/Oauth token
     * @param bool        $oauth  Use Oauth?
     * @param HttpClient  $client Http client implementation
     *
     * @throws HubSpotException
     */
    protected function __construct($apiKey = null, $oauth = false, HttpClient $client)
    {
        $this->oauth = $oauth;
        $this->apiKey = $apiKey ?: getenv('HUBSPOT_API_KEY');
        $this->client = $client;

        if (empty($this->apiKey)) {
            throw new HubSpotException("You must provide a HubSpot api key.");
        }
    }

    /**
     * Get an instance isomg hapikey option
     *
     * @param string     $apiKey HubSpot Api key
     * @param HttpClient $client An HttpClient implementation
     *
     * @return static
     */
    public static function make($apiKey = null, HttpClient $client = null)
    {
        return new static($apiKey, false, $client);
    }

    /**
     * Get an instance using an OAuth token
     *
     * @param string     $access_token HubSpot oauth access token
     * @param HttpClient $client       An HttpClient implementation
     *
     * @return static
     */
    public static function makeWithToken($access_token, HttpClient $client = null)
    {
        return new static($access_token, true, $client);
    }

    /**
     * Magic method to get an API class instance
     *
     * @param string $name      Api class name e.g. Contacts
     * @param array  $arguments Method args
     *
     * @return mixed
     *
     * @throws HubSpotException
     */
    public function __call($name, array $arguments = array())
    {
        $apiClass = $this->getApiClassName($name);

        $reflection = new \ReflectionClass($apiClass);
        if (! $reflection->isInstantiable()) {
            throw new HubSpotException("Target [$apiClass] is not instantiable.");
        }

        return new $apiClass($this->apiKey, $this->client, $this->oauth);
    }

    /**
     * Get the fully qualified class name
     *
     * @param string $name Class name
     *
     * @return string
     */
    protected function getApiClassName($name)
    {
        return 'Fungku\\HubSpot\\Api\\' . ucfirst($name);
    }
}
