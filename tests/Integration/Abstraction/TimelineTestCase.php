<?php

namespace SevenShores\Hubspot\Tests\Integration\Abstraction;

use Exception;
use SevenShores\Hubspot\Endpoints\Timeline;

abstract class TimelineTestCase extends EntityTestCase
{
    /**
     * @var null|Timeline
     */
    protected $endpoint;

    /**
     * @var null|Timeline::class
     */
    protected $endpointClass = Timeline::class;

    /**
     * @var string
     */
    protected $key = 'HUBSPOT_TEST_DEVELOPER_API_KEY';

    /**
     * @var string
     */
    protected $appId;

    public function setUp(): void
    {
        if (empty(getenv('HUBSPOT_TEST_APP_ID'))) {
            throw new Exception('Invalid Application Id (HUBSPOT_TEST_APP_ID)');
        }

        $this->appId = getenv('HUBSPOT_TEST_APP_ID');

        parent::setUp();
    }

    public function deleteEntity()
    {
        return $this->endpoint->deleteEventType(
            $this->appId,
            $this->entity->id
        );
    }

    protected function createEntity()
    {
        return $this->endpoint->createEventType(
            $this->appId,
            'Test Event Name',
            'Test Event header template',
            'Test Event detail template',
            'CONTACT'
        );
    }
}
