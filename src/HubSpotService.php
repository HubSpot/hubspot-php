<?php namespace Fungku\HubSpot;

use Fungku\Hubspot\Contracts\HttpClient;
use Fungku\HubSpot\Exceptions\HubSpotException;

/**
 * Class HubSpotService
 * @package Fungku\HubSpot
 *
 * @method blog()
 * @method contacts()
 * @method forms()
 * @method keywords()
 * @method leadNurturing()
 * @method leads()
 * @method lists()
 * @method marketPlace()
 * @method properties()
 * @method settings()
 * @method socialMedia()
 * @method workflows()
 */
class HubSpotService
{
    const DEFAULT_USER_AGENT = 'FungkuHubSpotPHP/2.0 (https://github.com/fungku/hubspot-php)';

    /**
     * @var array
     */
    protected $apiClasses = [
        'blog',
        'contacts',
        'forms',
        'keywords',
        'leadNurturing',
        'leads',
        'lists',
        'marketPlace',
        'properties',
        'settings',
        'socialMedia',
        'workflows',
    ];

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var string
     */
    protected $userAgent;

    /**
     * @var HttpClient
     */
    protected $client;

    /**
     * @param string     $apiKey
     * @param string     $userAgent
     * @param HttpClient $client
     */
    protected function __construct($apiKey = null, $userAgent = null, HttpClient $client = null)
    {
        $this->apiKey = $this->checkApiKey($apiKey);
        $this->userAgent = $userAgent ?: static::DEFAULT_USER_AGENT;
        $this->client = $client;
    }

    /**
     * @param string     $apiKey
     * @param string     $userAgent
     * @param HttpClient $client
     * @return static
     */
    public static function create($apiKey = null, $userAgent = null, HttpClient $client = null)
    {
        return new static($apiKey, $userAgent, $client);
    }

    /**
     * @param string $apiKey
     * @return string
     */
    protected function checkApiKey($apiKey)
    {
        $apiKey = $apiKey ?: getenv('HUBSPOT_API_KEY');

        if ( ! $apiKey) {
            throw new \InvalidArgumentException("You must provide a HubSpot api key.");
        }

        return $apiKey;
    }

    /**
     * The class name for an existing provider.
     *
     * @param string $name
     * @return string
     * @throws HubSpotException
     */
    protected function providerClassName($name)
    {
        if ( ! in_array($name, $this->apiClasses)) {
            throw new HubSpotException("Api Class not found.");
        }

        return 'Fungku\\HubSpot\\Api\\' . ucfirst($name);
    }

    /**
     * @param string $name
     * @param null   $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        $providerClass = $this->providerClassName($name);

        return new $providerClass($this->apiKey, $this->userAgent, $this->client);
    }
}
