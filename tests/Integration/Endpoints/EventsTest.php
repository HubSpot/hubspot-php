<?php

namespace SevenShores\Hubspot\Tests\Integration\Endpoints;

use SevenShores\Hubspot\Endpoints\Events;
use SevenShores\Hubspot\Http\Client;

/**
 * @internal
 * @coversNothing
 */
class EventsTest extends \PHPUnit\Framework\TestCase
{
    private $events;

    public function setUp(): void
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
