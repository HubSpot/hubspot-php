<?php

namespace Fungku\HubSpot\Tests\Integration\Api;

use Fungku\HubSpot\Api\Email;
use Fungku\HubSpot\Http\Client;

class EmailTest extends \PHPUnit_Framework_TestCase
{
    private $email;

    public function setUp()
    {
        parent::setUp();
        $this->email = new Email('demo', new Client());
    }

    /** @test */
    public function subscriptions()
    {
        $response = $this->email->subscriptions(62515);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function subscriptionsTimeline()
    {
        $response = $this->email->subscriptionsTimeline(['limit' => 2]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function subscriptionStatus()
    {
        $response = $this->email->subscriptionStatus(62515, 'test@hubspot.com');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function updateSubscription()
    {
        $response = $this->email->updateSubscription(62515, 'test@hubspot.com', ['unsubscribeFromAll' => true]);

        $this->assertEquals(200, $response->getStatusCode());
    }
}
