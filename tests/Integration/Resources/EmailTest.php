<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use Exception;
use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\Email;

/**
 * @internal
 * @coversNothing
 */
class EmailTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Email
     */
    protected $resource;

    /**
     * @var string
     */
    protected $portalId;

    public function setUp()
    {
        if (empty(getenv('HUBSPOT_TEST_PORTAL_ID'))) {
            throw new Exception('Invalid Portal Id (HUBSPOT_TEST_PORTAL_ID)');
        }
        $this->portalId = getenv('HUBSPOT_TEST_PORTAL_ID');

        parent::setUp();

        $this->resource = new Email(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        sleep(1);
    }

    /** @test */
    public function subscriptions()
    {
        $response = $this->resource->subscriptions($this->portalId);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function subscriptionsTimeline()
    {
        $response = $this->resource->subscriptionsTimeline(['limit' => 2]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function subscriptionStatus()
    {
        $response = $this->resource->subscriptionStatus($this->portalId, 'test@hubspot.com');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function updateSubscription()
    {
        $response = $this->resource->updateSubscription($this->portalId, 'test@hubspot.com', ['unsubscribeFromAll' => true]);

        $this->assertEquals(200, $response->getStatusCode());
    }
}
