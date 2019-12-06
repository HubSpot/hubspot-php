<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\Events;

/**
 * @internal
 * @coversNothing
 */
class EventsTest extends \PHPUnit_Framework_TestCase
{
    private $events;

    public function setUp()
    {
        parent::setUp();
        $this->events = new Events(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        sleep(1);
    }

    /** @test */
    public function trigger()
    {
        $response = $this->events->trigger(56043, 000000001625);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function triggerWithEmail()
    {
        $response = $this->events->trigger(56043, 000000001625, 'test@hubspot.com');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function triggerWithRevenue()
    {
        $response = $this->events->trigger(56043, 000000001625, 'test@hubspot.com', 50);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function triggerWithProperties()
    {
        $response = $this->events->trigger(56043, 000000001625, 'test@hubspot.com', 50, [
            'firstname' => 'Joe',
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }
}
