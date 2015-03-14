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
    private $apiKey;
    private $apiClasses = [
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
     * @param string|null $apiKey
     * @throws HubSpotException
     */
    protected function __construct($apiKey = null)
    {
        $this->apiKey = $apiKey ?: getenv('HUBSPOT_API_KEY');

        if (empty($this->apiKey)) {
            throw new HubSpotException("You must provide a HubSpot api key.");
        }
    }

    /**
     * @param string $apiKey
     * @return static
     */
    public static function make($apiKey = null)
    {
        return new static($apiKey);
    }

    /**
     * The class name for an existing provider.
     *
     * @param string $name
     * @return string
     * @throws HubSpotException
     */
    protected function getApiClassName($name)
    {
        if (! in_array($name, $this->apiClasses)) {
            throw new HubSpotException("Api Class not found.");
        }

        return 'Fungku\\HubSpot\\Api\\' . ucfirst($name);
    }

    /**
     * @param string $name
     * @param null $arguments
     * @return mixed
     */
    public function __call($name, $arguments = null)
    {
        $apiClass = $this->getApiClassName($name);

        return new $apiClass($this->apiKey);
    }
}
