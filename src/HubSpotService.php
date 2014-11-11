<?php namespace Fungku\HubSpot;

use Fungku\HubSpot\Exceptions\HubSpotException;

/**
 * Class HubSpotService
 * @package Fungku\HubSpot
 *
 * @method static blog($apiKey, $userAgent = null, $client = null)
 * @method static contacts($apiKey, $userAgent = null, $client = null)
 * @method static forms($apiKey, $userAgent = null, $client = null)
 * @method static keywords($apiKey, $userAgent = null, $client = null)
 * @method static leadNurturing($apiKey, $userAgent = null, $client = null)
 * @method static leads($apiKey, $userAgent = null, $client = null)
 * @method static lists($apiKey, $userAgent = null, $client = null)
 * @method static marketPlace($apiKey, $userAgent = null, $client = null)
 * @method static properties($apiKey, $userAgent = null, $client = null)
 * @method static settings($apiKey, $userAgent = null, $client = null)
 * @method static socialMedia($apiKey, $userAgent = null, $client = null)
 * @method static workflows($apiKey, $userAgent = null, $client = null)
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
    protected static $apiClasses = array(
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
     */
    public static function __callStatic($name, array $arguments = array())
    {
        $apiKey = static::getApiKey($arguments);
        $userAgent = isset($arguments['userAgent']) ? $arguments['userAgent'] : static::DEFAULT_USER_AGENT;
        $client = isset($arguments['client']) ? $arguments['client'] : null;
        $providerClass = static::providerClassName($name);

        return new $providerClass($apiKey, $userAgent, $client);
    }

    /**
     * @param $arguments
     * @return string
     */
    private static function getApiKey($arguments)
    {
        $apiKey = isset($arguments['apiKey']) ? $arguments['apiKey'] : getenv('HUBSPOT_API_KEY');

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
    protected static function providerClassName($name)
    {
        if ( ! in_array($name, static::$apiClasses)) {
            throw new HubSpotException("Api Class not found.");
        }

        return 'Fungku\\HubSpot\\Api\\' . ucfirst($name);
    }
}
