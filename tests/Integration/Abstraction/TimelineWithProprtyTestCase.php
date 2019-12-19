<?php

namespace SevenShores\Hubspot\Tests\Integration\Abstraction;

abstract class TimelineWithProprtyTestCase extends TimelineTestCase
{
    /**
     * @var null|\SevenShores\Hubspot\Http\Response
     */
    protected $property;

    public function setUp()
    {
        parent::setUp();
        $this->property = $this->createProperty();
    }

    public function tearDown()
    {
        if (!empty($this->property)) {
            $this->deleteProperty();
        }

        parent::tearDown();
    }

    public function deleteProperty()
    {
        return $this->resource->deleteEventTypeProperty(
            $this->appId,
            $this->entity->id,
            $this->property->id
        );
    }

    protected function createProperty()
    {
        return $this->resource->createEventTypeProperty(
            $this->appId,
            $this->entity->id,
            'test_property',
            'Property',
            'String'
        );
    }
}
