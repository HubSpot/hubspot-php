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

        $response = $this->createEventType();
        $eventType = json_decode((string) $response->getBody());

        // Set this for future tests
        if ($id = $eventType->id) {
            $this->eventTypeId = $id;
        }

        sleep(1);
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        parent::tearDown();

        // Make sure that everything still exists
        if (!$this->timeline || !$this->eventTypeId) {
            return false;
        }

        $this->deleteEventType();
    }

    /**
     * @test
     */
    public function createOrUpdate()
    {
        $response = $this->createEventTypeProperty();
        $eventTypeProperty = json_decode((string) $response->getBody());

        $timestamp = new \DateTime();
        $timestamp->setDate(2016, 6, 11);

        $response = $this->timeline->createOrUpdate(
            self::APP_ID,
            $this->eventTypeId,
            'TEST-PHP-HUBSPOT-'.substr(md5(microtime()),rand(0,26),16),
            null,
            'demo@demo.com',
            null,
            [
                $eventTypeProperty->name => 'BAM',
            ],
            $timestamp
        );
    }

    /**
     * @test
     */
    public function createOrUpdateBatch()
    {
        $response = $this->createEventTypeProperty();
        $eventTypeProperty = json_decode((string) $response->getBody());

        $timestamp = new \DateTime();
        $timestamp->setDate(2016, 6, 11);

        $events = [
            [
                'eventTypeId'            => $this->eventTypeId,
                'id'                     => substr(md5(microtime()),rand(0,26),16),
                'email'                  => 'demo@demo.com',
                'extraData'              => [
                    $eventTypeProperty->name => 'BAM',
                ],
                'timestamp'              => ms_timestamp($timestamp)
            ],
            [
                'eventTypeId'            => $this->eventTypeId,
                'id'                     => substr(md5(microtime()),rand(0,26),16),
                'email'                  => 'demo2@demo.com',
                'extraData'              => [
                    $eventTypeProperty->name => 'WAM',
                ],
                'timestamp'              => ms_timestamp($timestamp)
            ]
        ];

        $response = $this->timeline->createOrUpdateBatch(
            self::APP_ID,
            $events
        );

        $this->assertEquals(204, $response->getStatusCode());

    }

    /**
     * @test
     */
    public function getEventTypes()
    {
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

        return $response;
    }

    /**
     * @test
     */
    public function updateEventType()
    {
        $name = 'New Event Name';
        $headerTemplate = 'New event header template';
        $detailTemplate = 'New event detail template';

        $response = $this->timeline->updateEventType(
            self::APP_ID,
            $this->eventTypeId,
            $name,
            $headerTemplate,
            $detailTemplate
        );

        $eventType = json_decode((string) $response->getBody());
        $this->assertEquals($name, $eventType->name);
        $this->assertEquals($headerTemplate, $eventType->headerTemplate);
        $this->assertEquals($detailTemplate, $eventType->detailTemplate);
        $this->assertEquals(200, $response->getStatusCode());

        return $response;
    }

    /**
     * @test
     */
    public function deleteEventType()
    {
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
        $this->createEventTypeProperty();
        $response = $this->timeline->getEventTypeProperties(self::APP_ID, $this->eventTypeId);
        $this->assertEquals(200, $response->getStatusCode());

        return $response;
    }

    /**
     * @test
     */
    public function createEventTypeProperty()
    {
        $name = 'property-' . substr(md5(microtime()),rand(0,26),5);
        $label = 'Property';
        $propertyType = 'String';

        $response = $this->timeline->createEventTypeProperty(
            self::APP_ID,
            $this->eventTypeId,
            $name,
            $label,
            $propertyType
        );

        $eventTypeProperty = json_decode((string) $response->getBody());
        $this->assertEquals($name, $eventTypeProperty->name);
        $this->assertEquals($label, $eventTypeProperty->label);
        $this->assertEquals($propertyType, $eventTypeProperty->propertyType);
        $this->assertEquals(200, $response->getStatusCode());

        return $response;
    }

    /**
     * @test
     */
    public function updateEventTypeProperty()
    {
        $response = $this->createEventTypeProperty();
        $eventTypeProperty = json_decode((string) $response->getBody());

        $label = 'New Property Label';
        $propertyType = 'String';

        $response = $this->timeline->updateEventTypeProperty(
            self::APP_ID,
            $this->eventTypeId,
            $eventTypeProperty->id,
            $eventTypeProperty->name,
            $label,
            $propertyType
        );

        $eventTypeProperty = json_decode((string) $response->getBody());
        $this->assertEquals($label, $eventTypeProperty->label);
        $this->assertEquals($propertyType, $eventTypeProperty->propertyType);
        $this->assertEquals(200, $response->getStatusCode());

        return $response;
    }

    /**
     * @test
     */
    public function deleteEventTypeProperty()
    {
        $response = $this->createEventTypeProperty();
        $eventTypeProperty = json_decode((string) $response->getBody());
        $response = $this->timeline->deleteEventTypeProperty(
            self::APP_ID,
            $this->eventTypeId,
            $eventTypeProperty->id
        );

        $this->assertEquals(204, $response->getStatusCode());

        return $response;
    }
}
