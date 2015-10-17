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
}
