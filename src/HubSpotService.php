<?php namespace Fungku\HubSpot;

use Fungku\HubSpot\Exceptions\ProviderNotFoundException;

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
     * The default userAgent string.
     */
    const DEFAULT_USER_AGENT = 'FungkuHubSpotPHP/2.0 (https://github.com/fungku/hubspot-php)';

    /**
     * The available API provider classes.
     *
     * @var array
     */
    protected static $providers = array(
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
    );

    /**
     * @param string $name
     * @param array  $arguments
     * @return mixed
     * @throws ProviderNotFoundException
     */
    public static function __callStatic($name, array $arguments = array())
    {
        // If the api key is not included, check for an environment variable.
        $apiKey = isset($arguments['apiKey']) ? $arguments['apiKey'] : getenv('HUBSPOT_API_KEY');

        // If we still don't have an api key, throw an exception.
        if ( ! $apiKey) {
            throw new \InvalidArgumentException("You must provide a HubSpot api key.");
        }

        // If the userAgent is not provided, use the default.
        $userAgent = isset($arguments['userAgent']) ? $arguments['userAgent'] : static::DEFAULT_USER_AGENT;

        // Find the Api provider class.
        $providerClass = static::providerClassName($name);

        // Return a new instance of an api class.
        return new $providerClass($apiKey, $userAgent);
    }

    /**
     * The class name for an existing provider.
     *
     * @param string $name
     * @return string
     * @throws ProviderNotFoundException
     */
    protected static function providerClassName($name)
    {
        // Throw an exception if the method called is not defined in the providers array.
        if ( ! in_array($name, static::$providers)) {
            throw new ProviderNotFoundException("That provider does not exist.");
        }

        // Return the full class name.
        return 'Fungku\\HubSpot\\API\\' . ucfirst($name);
    }
}
