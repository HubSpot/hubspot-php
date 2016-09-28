<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\Timeline;

class TimelineTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Demo application to be used for testing.
     *
     * @see https://app.hubspot.com/developers/62515/application/36472
     */
    const APP_ID = 36472;

    /**
     * @var Timeline
     */
    protected $timeline;

    /**
     * @var int
     */
    private $eventTypeId;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->timeline = new Timeline(new Client([
            'key'    => 'demo',
            'userId' => '215482',
        ]));

        sleep(1);
    }

    /**
     * Create an event type if one doesn't exist for our APP_ID.
     */
    private function setupEventType()
    {
        if (!$this->eventTypeId) {
            $response = $this->createEventType();
        }
    }

    /**
     * @test
     */
    public function createOrUpdate()
    {
        // @todo
    }

    /**
     * @test
     */
    public function getEventTypes()
    {
        // Create a new event type so we have at least one to get info from.
        $this->setupEventType();

        $response = $this->timeline->getEventTypes(self::APP_ID);
        $this->assertEquals(200, $response->getStatusCode());

        return $response;
    }

    /**
     * @test
     */
    public function createEventType()
    {
        $name = 'Event name';
        $headerTemplate = 'Event header template';
        $detailTemplate = 'Event detail template';
        $objectType = 'CONTACT';

        $response = $this->timeline->createEventType(
            self::APP_ID,
            $name,
            $headerTemplate,
            $detailTemplate,
            $objectType
        );

        $eventType = json_decode((string) $response->getBody());

        $this->assertEquals($name, $eventType->name);
        $this->assertEquals($headerTemplate, $eventType->headerTemplate);
        $this->assertEquals($detailTemplate, $eventType->detailTemplate);
        $this->assertEquals($objectType, $eventType->objectType);
        $this->assertEquals(200, $response->getStatusCode());

        // Set this for future tests
        if ($id = $eventType->id) {
            $this->eventTypeId = $id;
        }

        return $response;
    }

    /**
     * @test
     */
    public function updateEventType()
    {
        // @todo
    }

    /**
     * @test
     */
    public function deleteEventType()
    {
        // Create a new event type so we have at least one to delete.
        $this->setupEventType();

        $response = $this->timeline->deleteEventType(self::APP_ID, $this->eventTypeId);
        $this->assertEquals(204, $response->getStatusCode());

        // Remove event type id from class since we just deleted it.
        $this->eventTypeId = null;

        return $response;
    }

    /**
     * @test
     */
    public function getEventTypeProperties()
    {
        // @todo
    }

    /**
     * @test
     */
    public function createEventTypeProperty()
    {
        // @todo
    }

    /**
     * @test
     */
    public function updateEventTypeProperty()
    {
        // @todo
    }

    /**
     * @test
     */
    public function deleteEventTypeProperty()
    {
        // @todo
    }
}
