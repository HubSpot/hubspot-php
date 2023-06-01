<?php

namespace SevenShores\Hubspot;

use SevenShores\Hubspot\Endpoints\Endpoint;
use SevenShores\Hubspot\Http\Client;

/**
 * Class Factory.
 *
 * @method \SevenShores\Hubspot\Endpoints\Analytics          analytics()
 * @method \SevenShores\Hubspot\Endpoints\BlogAuthors        blogAuthors()
 * @method \SevenShores\Hubspot\Endpoints\Blogs              blogs()
 * @method \SevenShores\Hubspot\Endpoints\BlogPosts          blogPosts()
 * @method \SevenShores\Hubspot\Endpoints\BlogTopics         blogTopics()
 * @method \SevenShores\Hubspot\Endpoints\Companies          companies()
 * @method \SevenShores\Hubspot\Endpoints\CompanyProperties  companyProperties()
 * @method \SevenShores\Hubspot\Endpoints\CalendarEvents     calendarEvents()
 * @method \SevenShores\Hubspot\Endpoints\ContactLists       contactLists()
 * @method \SevenShores\Hubspot\Endpoints\ContactProperties  contactProperties()
 * @method \SevenShores\Hubspot\Endpoints\Contacts           contacts()
 * @method \SevenShores\Hubspot\Endpoints\CrmAssociations    crmAssociations()
 * @method \SevenShores\Hubspot\Endpoints\CrmPipelines       crmPipelines()
 * @method \SevenShores\Hubspot\Endpoints\EmailSubscription  emailSubscription()
 * @method \SevenShores\Hubspot\Endpoints\EmailEvents        emailEvents()
 * @method \SevenShores\Hubspot\Endpoints\Engagements        engagements()
 * @method \SevenShores\Hubspot\Endpoints\Files              files()
 * @method \SevenShores\Hubspot\Endpoints\Forms              forms()
 * @method \SevenShores\Hubspot\Endpoints\HubDB              hubDB()
 * @method \SevenShores\Hubspot\Endpoints\Keywords           keywords()
 * @method \SevenShores\Hubspot\Endpoints\LineItems          lineItems()
 * @method \SevenShores\Hubspot\Endpoints\Pages              pages()
 * @method \SevenShores\Hubspot\Endpoints\Products           products()
 * @method \SevenShores\Hubspot\Endpoints\SocialMedia        socialMedia()
 * @method \SevenShores\Hubspot\Endpoints\Tickets            tickets()
 * @method \SevenShores\Hubspot\Endpoints\Timeline           timeline()
 * @method \SevenShores\Hubspot\Endpoints\Workflows          workflows()
 * @method \SevenShores\Hubspot\Endpoints\Events             events()
 * @method \SevenShores\Hubspot\Endpoints\DealPipelines      dealPipelines()
 * @method \SevenShores\Hubspot\Endpoints\DealProperties     dealProperties()
 * @method \SevenShores\Hubspot\Endpoints\Deals              deals()
 * @method \SevenShores\Hubspot\Endpoints\Owners             owners()
 * @method \SevenShores\Hubspot\Endpoints\TransactionalEmail transactionalEmail()
 * @method \SevenShores\Hubspot\Endpoints\Integration        integration()
 * @method \SevenShores\Hubspot\Endpoints\EcommerceBridge    ecommerceBridge()
 * @method \SevenShores\Hubspot\Endpoints\Webhooks           webhooks()
 * @method \SevenShores\Hubspot\Endpoints\OAuth2             oAuth2()
 * @method \SevenShores\Hubspot\Endpoints\ObjectProperties   objectProperties()
 */
class Factory
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * C O N S T R U C T O R ( ^_^)y.
     *
     * @param array  $config        An array of configurations. You need at least the 'key'.
     * @param Client $client
     * @param array  $clientOptions options to be send with each request
     * @param bool   $wrapResponse  wrap request response in own Response object
     */
    public function __construct(array $config = [], Client $client = null, array $clientOptions = [], bool $wrapResponse = true)
    {
        if (is_null($client)) {
            $client = new Client($config, null, $clientOptions, $wrapResponse);
        }
        $this->client = $client;
    }

    /**
     * Return an instance of a Endpoint based on the method called.
     *
     * @param mixed $args
     */
    public function __call(string $name, $args): Endpoint
    {
        $endpoint = 'SevenShores\\Hubspot\\Endpoints\\'.ucfirst($name);

        return new $endpoint($this->client, ...$args);
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Create an instance of the service with an API key.
     *
     * @param string $api_key       hubspot API key
     * @param Client $client        an Http client
     * @param array  $clientOptions options to be send with each request
     * @param bool   $wrapResponse  wrap request response in own Response object
     *
     * @return static
     */
    public static function create(string $api_key = null, Client $client = null, array $clientOptions = [], bool $wrapResponse = true): self
    {
        return new static(['key' => $api_key], $client, $clientOptions, $wrapResponse);
    }

    /**
     * Create an instance of the service with an access token.
     *
     * @param string $token         hubspot oauth access token
     * @param Client $client        an Http client
     * @param array  $clientOptions options to be send with each request
     * @param bool   $wrapResponse  wrap request response in own Response object
     *
     * @deprecated
     *
     * @return static
     */
    public static function createWithToken(string $token, Client $client = null, array $clientOptions = [], bool $wrapResponse = true): self
    {
        return new static(['key' => $token, 'oauth' => true], $client, $clientOptions, $wrapResponse);
    }

    /**
     * Create an instance of the service with an OAuth2 token.
     *
     * @param string $token         hubspot OAuth2 access token
     * @param Client $client        an Http client
     * @param array  $clientOptions options to be send with each request
     * @param bool   $wrapResponse  wrap request response in own Response object
     *
     * @deprecated
     *
     * @return static
     */
    public static function createWithOAuth2Token(string $token, Client $client = null, array $clientOptions = [], bool $wrapResponse = true): self
    {
        return new static(['key' => $token, 'oauth2' => true], $client, $clientOptions, $wrapResponse);
    }

    /**
     * Create an instance of the service with an access token.
     *
     * @param string $token         Hubspot access token
     * @param Client $client        an Http client
     * @param array  $clientOptions options to be send with each request
     * @param bool   $wrapResponse  wrap request response in own Response object
     *
     * @return static
     */
    public static function createWithAccessToken(string $token, Client $client = null, array $clientOptions = [], bool $wrapResponse = true): self
    {
        return new static(['key' => $token, 'oauth2' => true], $client, $clientOptions, $wrapResponse);
    }
}
