<?php namespace Fungku\HubSpot;

use Fungku\HubSpot\Exceptions\HubSpotException;

/**
 * Class HubSpotService
 * @package Fungku\HubSpot
 *
 * @method blogs()
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
    /**
     * @var array
     */
    protected $apiClasses = [
        'blogs',
        'contacts',
        'contactLists',
        'contactProperties',
        'forms',
        'keywords',
        'leadNurturing',
        'leads',
        'marketPlace',
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
     * @type string
     */
    const DEFAULT_USER_AGENT = 'Fungku_HubSpot_PHP/0.1 (https://github.com/fungku/hubspot-php)';

    /**
     * @param string     $apiKey
     * @param string     $userAgent
     */
    protected function __construct($apiKey = null, $userAgent = null)
    {
        $this->apiKey = $this->checkForApiKey($apiKey);
        $this->userAgent = $userAgent ?: static::DEFAULT_USER_AGENT;
    }

    /**
     * @param string     $apiKey
     * @param string     $userAgent
     * @return static
     */
    public static function create($apiKey = null, $userAgent = null)
    {
        return new static($apiKey, $userAgent);
    }

    /**
     * @param string $apiKey
     * @return string
     */
    protected function checkForApiKey($apiKey)
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
    protected function getApiRepositoryName($name)
    {
        if ( ! in_array($name, $this->apiClasses)) {
            throw new HubSpotException("Api Class not found.");
        }

        return 'Fungku\\HubSpot\\Repositories\\' . ucfirst($name);
    }

    /**
     * @param string $name
     * @param null   $arguments
     * @return mixed
     */
    public function __call($name, $arguments = null)
    {
        $repositoryClass = $this->getApiRepositoryName($name);

        return new $repositoryClass($this->apiKey, $this->userAgent);
    }
}
