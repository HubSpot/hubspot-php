<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use Exception;
use SevenShores\Hubspot\Resources\CalendarEvents;
use SevenShores\Hubspot\Resources\Owners;
use SevenShores\Hubspot\Tests\Integration\Abstraction\EntityTestCase;

/**
 * @internal
 * @coversNothing
 */
class CalendarEventsTest extends EntityTestCase
{
    /**
     * @var CalendarEvents
     */
    protected $resource;

    /**
     * @var CalendarEvents::class
     */
    protected $resourceClass = CalendarEvents::class;

    /**
     * @var Owners
     */
    protected $ownersResource;

    /**
     * @var stdClass
     */
    protected $owner;

    public function setUp()
    {
        $this->ownersResource = new Owners($this->getClient());
        $response = $this->ownersResource->all(['email' => getenv('HUBSPOT_TEST_EMAIL')]);
        if (empty($response->getData())) {
            throw new Exception('Invalid Email (HUBSPOT_TEST_EMAIL)');
        }
        $this->owner = $response->getData()[0];
        sleep(1);

        parent::setUp();
    }

    /**
     * @test
     */
    public function createTask()
    {
        $this->assertSame(200, $this->entity->getStatusCode());
    }

    /**
     * @test
     */
    public function updateTask()
    {
        $response = $this->resource->updateTask($this->entity->id, [
            'name' => 'Another name',
            'description' => 'Another description',
        ]);

        $this->assertSame(200, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function getTaskById()
    {
        $response = $this->resource->getTaskById($this->entity->id);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($this->entity->name, $response->name);
        $this->assertEquals($this->entity->description, $response->description);
        $this->assertEquals($this->entity->ownerId, $response->ownerId);
    }

    /** @test */
    public function deleteTask()
    {
        $response = $this->deleteEntity();

        $this->assertEquals(204, $response->getStatusCode());

        $this->entity = null;
    }

    /** @test */
    public function all()
    {
        sleep(5);
        $startDate = $this->entity->eventDate - 60 * 60 * 1000;
        $endDate = $this->entity->eventDate + 60 * 60 * 1000;

        $response = $this->resource->all($startDate, $endDate);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, count($response->getData()));
    }

    /** @test */
    public function allTasks()
    {
        sleep(5);
        $startDate = $this->entity->eventDate - 60 * 60 * 1000;
        $endDate = $this->entity->eventDate + 60 * 60 * 1000;

        $response = $this->resource->allTasks($startDate, $endDate);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, count($response->toArray()));
    }

    protected function createEntity()
    {
        return $this->resource->createTask([
            'eventDate' => strtotime('+1 day') * 1000, //timestamp in milliseconds
            'eventType' => 'PUBLISHING_TASK',
            'category' => 'EMAIL',
            'state' => 'TODO',
            'name' => 'Some task',
            'description' => 'Very important task',
            'ownerId' => $this->owner->ownerId,
        ]);
    }

    protected function deleteEntity()
    {
        return $this->resource->deleteTask($this->entity->id);
    }
}
