<?php

namespace SevenShores\Hubspot\Tests\Integration\Endpoints;

use SevenShores\Hubspot\Tests\Integration\Abstraction\TimelineWithProprtyTestCase;

/**
 * @internal
 * @coversNothing
 */
class TimelineEventTypePropertyTest extends TimelineWithProprtyTestCase
{
    /**
     * @test
     */
    public function getEventTypeProperties()
    {
        $response = $this->endpoint->getEventTypeProperties($this->appId, $this->entity->id);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, count($response->toArray()));
    }

    /**
     * @test
     */
    public function createEventTypeProperty()
    {
        $this->assertEquals(200, $this->property->getStatusCode());
        $this->assertEquals('test_property', $this->property->name);
    }

    /**
     * @test
     */
    public function updateEventTypeProperty()
    {
        $response = $this->endpoint->updateEventTypeProperty(
            $this->appId,
            $this->entity->id,
            $this->property->id,
            $this->property->name,
            'Updated Property',
            'String'
        );

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Updated Property', $response->label);
    }

    /**
     * @test
     */
    public function deleteEventTypeProperty()
    {
        $response = $this->deleteProperty();

        $this->assertEquals(204, $response->getStatusCode());

        $this->property = null;
    }
}
