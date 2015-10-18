<?php

namespace Fungku\HubSpot\Tests\Integration\Api;

use Fungku\HubSpot\Api\Events;
use Fungku\HubSpot\Http\Client;

class EventsTest extends \PHPUnit_Framework_TestCase
{
    private $events;

    public function setUp()
    {
        parent::setUp();
        $this->events = new Events('demo', new Client());
    }

    /** @test */
    public function trigger()
    {
        $response = $this->events->trigger(56043, 000000001625);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function trigger_with_email()
    {
        $response = $this->events->trigger(56043, 000000001625, 'test@hubspot.com');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function trigger_with_revenue()
    {
        $response = $this->events->trigger(56043, 000000001625, 'test@hubspot.com', 50);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function trigger_with_properties()
    {
        $response = $this->events->trigger(56043, 000000001625, 'test@hubspot.com', 50, [
            'firstname' => 'Joe',
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }
}
