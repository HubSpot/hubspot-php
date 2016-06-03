<?php

namespace SevenShores\Hubspot;

use SevenShores\Hubspot\Http\Client;

/**
 * Class HubspotService
 * @package SevenShores\Hubspot
 *
 * @method \SevenShores\Hubspot\Resources\Blogs blogs()
 * @method \SevenShores\Hubspot\Resources\BlogPosts blogPosts()
 * @method \SevenShores\Hubspot\Resources\Companies companies()
 * @method \SevenShores\Hubspot\Resources\CompanyProperties companyProperties()
 * @method \SevenShores\Hubspot\Resources\ContactLists contactLists()
 * @method \SevenShores\Hubspot\Resources\ContactProperties contactProperties()
 * @method \SevenShores\Hubspot\Resources\Contacts contacts()
 * @method \SevenShores\Hubspot\Resources\Email email()
 * @method \SevenShores\Hubspot\Resources\EmailEvents emailEvents()
 * @method \SevenShores\Hubspot\Resources\Files files()
 * @method \SevenShores\Hubspot\Resources\Forms forms()
 * @method \SevenShores\Hubspot\Resources\Keywords keywords()
 * @method \SevenShores\Hubspot\Resources\MarketPlace marketPlace()
 * @method \SevenShores\Hubspot\Resources\Pages pages()
 * @method \SevenShores\Hubspot\Resources\SocialMedia socialMedia()
 * @method \SevenShores\Hubspot\Resources\Workflows workflows()
 * @method \SevenShores\Hubspot\Resources\Events events()
 * @method \SevenShores\Hubspot\Resources\Deals deals()
 * @method \SevenShores\Hubspot\Resources\Owners owners()
 */
class Factory
{
    /**
     * C O N S T R U C T O R ( ^_^)y
     *
     * @param  array   $config  An array of configurations. You need at least the 'key'.
     * @param  Client  $client
     */
    function __construct($config = [], $client = null)
    {
        $this->client = $client ?: new Client($config);
    }

    /**
     * Create an instance of the service with an API key.
     *
     * @param  string  $api_key  Hubspot API key.
     * @param  Client  $client   An Http client.
     * @return static
     */
    static function create($api_key = null, $client = null)
    {
        return new static(['key' => $api_key], $client);
    }

    /**
     * Create an instance of the service with an Oauth token.
     *
     * @param  string  $token   Hubspot oauth access token.
     * @param  Client  $client  An Http client.
     * @return static
     */
    static function createWithToken($token, $client = null)
    {
        return new static(['key' => $token, 'oauth' => true], $client);
    }

    /**
     * Return an instance of a Resource based on the method called.
     *
     * @param  string  $name
     * @param  array   $arguments
     * @return \SevenShores\Hubspot\Resources\Resource
     */
    function __call($name, $arguments = null)
    {
        $resource = 'SevenShores\\Hubspot\\Resource\\' . ucfirst($name);

        return new $resource($this->client);
    }
}
