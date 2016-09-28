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
        // @todo
    }

    /**
     * @test
     */
    public function createEventType()
    {
        // @todo
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
        // @todo
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
