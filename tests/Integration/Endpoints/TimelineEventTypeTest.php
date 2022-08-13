<?php

namespace SevenShores\Hubspot\Tests\Integration\Endpoints;

use SevenShores\Hubspot\Tests\Integration\Abstraction\TimelineTestCase;

/**
 * @internal
 * @coversNothing
 */
class TimelineEventTypeTest extends TimelineTestCase
{
    /**
     * @test
     */
    public function getEventTypes()
    {
        $response = $this->endpoint->getEventTypes($this->appId);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, count($response->toArray()));
    }

    /**
     * @test
     */
    public function getEventTypeById()
    {
        $response = $this->endpoint->getEventTypeById($this->appId, $this->entity->id);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains($this->entity->id, $response->toArray());
    }

    /**
     * @test
     */
    public function createEventType()
    {
        $this->assertEquals(200, $this->entity->getStatusCode());
        $this->assertEquals('Test Event Name', $this->entity->name);
    }

    /**
     * @test
     */
    public function updateEventType()
    {
        $response = $this->endpoint->updateEventType(
            $this->appId,
            $this->entity->id,
            'Updated Test Event Name',
            'Updated Test Event header template',
            'Updated Test Event detail template'
        );

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Updated Test Event Name', $response->name);
    }

    /**
     * @test
     */
    public function deleteEventType()
    {
        $response = $this->deleteEntity();

        $this->assertEquals(204, $response->getStatusCode());

        $this->entity = null;
    }
}
