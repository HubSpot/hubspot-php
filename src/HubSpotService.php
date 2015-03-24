<?php namespace Fungku\HubSpot;

use Fungku\HubSpot\Exceptions\HubSpotException;
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
 */
class HubSpotService
{
    /**
     * @var string
     */
    private $apiKey;

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
     * @param string $name
     * @param null $arguments
     * @return mixed
     * @throws HubSpotException
     */
    public function __call($name, $arguments = null)
    {
        $apiClass = $this->getApiClassName($name);

        if (! (new \ReflectionClass($apiClass))->isInstantiable()) {
            throw new HubSpotException("Target [$apiClass] is not instantiable.");
        }

        return new $apiClass($this->apiKey, new Client);
    }

    /**
     * @param string $name
     * @return string
     */
    protected function getApiClassName($name)
    {
        return 'Fungku\\HubSpot\\Api\\' . ucfirst($name);
    }
}
