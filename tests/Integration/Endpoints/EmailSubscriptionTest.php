<?php

namespace SevenShores\Hubspot\Tests\Integration\Endpoints;

use SevenShores\Hubspot\Endpoints\EmailSubscription;
use SevenShores\Hubspot\Http\Client;

/**
 * @internal
 * @coversNothing
 */
class EmailSubscriptionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Email
     */
    protected $endpoint;

    public function setUp(): void
    {
        parent::setUp();

        $this->endpoint = new EmailSubscription(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        sleep(1);
    }

    /** @test */
    public function subscriptions()
    {
        $response = $this->endpoint->subscriptions();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function subscriptionsTimeline()
    {
        $response = $this->endpoint->subscriptionsTimeline(['limit' => 2]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function subscriptionStatus()
    {
        $response = $this->endpoint->subscriptionStatus('test@hubspot.com');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function updateSubscription()
    {
        $response = $this->endpoint->updateSubscription('test@hubspot.com', ['unsubscribeFromAll' => true]);

        $this->assertEquals(200, $response->getStatusCode());
    }
}
