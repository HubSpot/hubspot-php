<?php

namespace SevenShores\Hubspot\Tests\Integration\Abstraction;

abstract class TimelineWithProprtyTestCase extends TimelineTestCase
{
    /**
     * @var null|\SevenShores\Hubspot\Http\Response
     */
    protected $property;

    public function setUp(): void
    {
        parent::setUp();
        $this->property = $this->createProperty();
    }

    public function tearDown(): void
    {
        if (!empty($this->property)) {
            $this->deleteProperty();
        }

        parent::tearDown();
    }

    public function deleteProperty()
    {
        return $this->endpoint->deleteEventTypeProperty(
            $this->appId,
            $this->entity->id,
            $this->property->id
        );
    }

    protected function createProperty()
    {
        return $this->endpoint->createEventTypeProperty(
            $this->appId,
            $this->entity->id,
            'test_property',
            'Property',
            'String'
        );
    }
}
