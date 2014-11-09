<?php namespace Fungku\HubSpot;

/**
 * Class HubSpotService
 * @package Fungku\HubSpot
 *
 * @method static blog
 * @method static contacts
 * @method static forms
 * @method static keywords
 * @method static leadNurturing
 * @method static leads
 * @method static lists
 * @method static marketPlace
 * @method static properties
 * @method static settings
 * @method static socialMedia
 * @method static workflows
 */
class HubSpotService
{
    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $userAgent;

    /**
     * The default userAgent string.
     */
    const DEFAULT_USER_AGENT = 'FungkuHubSpotPHP/2.0 (https://github.com/fungku/hubspot-php)';

    protected static $defaultProviders = [
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
     * @param string $apiKey
     * @param string $userAgent
     *
     * @throws \InvalidArgumentException
     */
    protected function __construct($apiKey = null, $userAgent = null)
    {
        // If an api key is not provided, check for an environment variable.
        $this->apiKey = $apiKey ?: getenv('HUBSPOT_API_KEY');

        // If a user agent is not provided, use the default.
        $this->userAgent = $userAgent ?: static::DEFAULT_USER_AGENT;

        // If we still do not have an api key, throw an exception.
        if ( ! $this->apiKey) {
            throw new \InvalidArgumentException("A HubSpot api key must be provided.");
        }
    }

    /**
     * @param $name
     * @param $arguments
     */
    public static function __callStatic($name, array $arguments = [])
    {
        $apiKey = isset($arguments['apiKey']) ? $arguments['apiKey'] : null;
        $userAgent = isset($arguments['userAgent']) ? $arguments['userAgent'] : null;

        $hubspot = static::instance($apiKey, $userAgent);

        $providerClassName = static::getProviderClassName($name);

        return new $providerClassName($hubspot->apiKey, $hubspot->userAgent);
    }

    /**
     * @param string $apiKey
     * @param string $userAgent
     * @return static
     */
    protected static function instance($apiKey, $userAgent)
    {
        static $instance = null;

        if (is_null($instance)) {
            $instance = new static($apiKey, $userAgent);
        }

        return $instance;
    }

    /**
     * @param string $name
     * @return string|null
     */
    protected static function getProviderClassName($name)
    {
        if ( ! in_array($name, static::$defaultProviders)) {
            // throw exception? class or method does not exist...
            return null;
        }

        return 'Fungku\\HubSpot\\API\\' . ucfirst($name);
    }

    /**
     * Private clone method to prevent cloning of the instance.
     *
     * @return void
     */
    private function __clone() {}

    /**
     * Private unserialize method to prevent unserializing of the singleton.
     *
     * @return void
     */
    private function __wakeup() {}
}
