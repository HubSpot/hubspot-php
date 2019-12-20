<?php

namespace SevenShores\Hubspot\Tests\Integration\Abstraction;

use Exception;
use SevenShores\Hubspot\Resources\Timeline;

abstract class TimelineTestCase extends EntityTestCase
{
    /**
     * @var null|Timeline
     */
    protected $resource;

    /**
     * @var null|Timeline::class
     */
    protected $resourceClass = Timeline::class;

    /**
     * @var string
     */
    protected $key = 'HUBSPOT_TEST_DEVELOPER_API_KEY';

    /**
     * @var string
     */
    protected $appId;

    public function setUp()
    {
        if (empty(getenv('HUBSPOT_TEST_APP_ID'))) {
            throw new Exception('Invalid Application Id (HUBSPOT_TEST_APP_ID)');
        }

        $this->appId = getenv('HUBSPOT_TEST_APP_ID');

        parent::setUp();
    }

    public function deleteEntity()
    {
        return $this->resource->deleteEventType(
            $this->appId,
            $this->entity->id
        );
    }

    protected function createEntity()
    {
        return $this->resource->createEventType(
            $this->appId,
            'Test Event Name',
            'Test Event header template',
            'Test Event detail template',
            'CONTACT'
        );
    }
}
