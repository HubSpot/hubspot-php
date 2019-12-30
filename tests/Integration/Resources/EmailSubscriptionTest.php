<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\EmailSubscription;

/**
 * @internal
 * @coversNothing
 */
class EmailSubscriptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Email
     */
    protected $resource;

    public function setUp()
    {
        parent::setUp();

        $this->resource = new EmailSubscription(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        sleep(1);
    }

    /** @test */
    public function subscriptions()
    {
        $response = $this->resource->subscriptions();

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
        $response = $this->resource->subscriptionStatus('test@hubspot.com');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function updateSubscription()
    {
        $response = $this->resource->updateSubscription('test@hubspot.com', ['unsubscribeFromAll' => true]);

        $this->assertEquals(200, $response->getStatusCode());
    }
}
