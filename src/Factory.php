<?php

namespace SevenShores\Hubspot;

use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\Resource;

/**
 * Class Factory.
 *
 * @method \SevenShores\Hubspot\Resources\Analytics          analytics()
 * @method \SevenShores\Hubspot\Resources\BlogAuthors        blogAuthors()
 * @method \SevenShores\Hubspot\Resources\Blogs              blogs()
 * @method \SevenShores\Hubspot\Resources\BlogPosts          blogPosts()
 * @method \SevenShores\Hubspot\Resources\BlogTopics         blogTopics()
 * @method \SevenShores\Hubspot\Resources\Companies          companies()
 * @method \SevenShores\Hubspot\Resources\CompanyProperties  companyProperties()
 * @method \SevenShores\Hubspot\Resources\CalendarEvents     calendarEvents()
 * @method \SevenShores\Hubspot\Resources\ContactLists       contactLists()
 * @method \SevenShores\Hubspot\Resources\ContactProperties  contactProperties()
 * @method \SevenShores\Hubspot\Resources\Contacts           contacts()
 * @method \SevenShores\Hubspot\Resources\CrmAssociations    crmAssociations()
 * @method \SevenShores\Hubspot\Resources\CrmPipelines       crmPipelines()
 * @method \SevenShores\Hubspot\Resources\EmailSubscription  emailSubscription()
 * @method \SevenShores\Hubspot\Resources\EmailEvents        emailEvents()
 * @method \SevenShores\Hubspot\Resources\Engagements        engagements()
 * @method \SevenShores\Hubspot\Resources\Files              files()
 * @method \SevenShores\Hubspot\Resources\Forms              forms()
 * @method \SevenShores\Hubspot\Resources\HubDB              hubDB()
 * @method \SevenShores\Hubspot\Resources\Keywords           keywords()
 * @method \SevenShores\Hubspot\Resources\LineItems          lineItems()
 * @method \SevenShores\Hubspot\Resources\Pages              pages()
 * @method \SevenShores\Hubspot\Resources\Products           products()
 * @method \SevenShores\Hubspot\Resources\SocialMedia        socialMedia()
 * @method \SevenShores\Hubspot\Resources\Tickets            tickets()
 * @method \SevenShores\Hubspot\Resources\Timeline           timeline()
 * @method \SevenShores\Hubspot\Resources\Workflows          workflows()
 * @method \SevenShores\Hubspot\Resources\Events             events()
 * @method \SevenShores\Hubspot\Resources\DealPipelines      dealPipelines()
 * @method \SevenShores\Hubspot\Resources\DealProperties     dealProperties()
 * @method \SevenShores\Hubspot\Resources\Deals              deals()
 * @method \SevenShores\Hubspot\Resources\Owners             owners()
 * @method \SevenShores\Hubspot\Resources\TransactionalEmail transactionalEmail()
 * @method \SevenShores\Hubspot\Resources\Integration        integration()
 * @method \SevenShores\Hubspot\Resources\EcommerceBridge    ecommerceBridge()
 * @method \SevenShores\Hubspot\Resources\Webhooks           webhooks()
 * @method \SevenShores\Hubspot\Resources\OAuth2             oAuth2()
 * @method \SevenShores\Hubspot\Resources\ObjectProperties   objectProperties()
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
    public function __construct(array $config = [], Client $client = null, array $clientOptions = [], $wrapResponse = true)
    {
        if (is_null($client)) {
            $client = new Client($config, null, $clientOptions, $wrapResponse);
        }
        $this->client = $client;
    }

    /**
     * Return an instance of a Resource based on the method called.
     *
     * @param array $arguments
     * @param mixed $args
     */
    public function __call(string $name, $args): Resource
    {
        $resource = 'SevenShores\\Hubspot\\Resources\\'.ucfirst($name);

        return new $resource($this->client, ...$args);
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
     * Create an instance of the service with an OAuth token.
     *
     * @param string $token         hubspot oauth access token
     * @param Client $client        an Http client
     * @param array  $clientOptions options to be send with each request
     * @param bool   $wrapResponse  wrap request response in own Response object
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
     * @return static
     */
    public static function createWithOAuth2Token(string $token, Client $client = null, array $clientOptions = [], bool $wrapResponse = true): self
    {
        return new static(['key' => $token, 'oauth2' => true], $client, $clientOptions, $wrapResponse);
    }
}
