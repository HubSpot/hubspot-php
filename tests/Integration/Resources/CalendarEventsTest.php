<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use Exception;
use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\CalendarEvents;
use SevenShores\Hubspot\Resources\Owners;

/**
 * @internal
 * @coversNothing
 */
class CalendarEventsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Owners
     */
    protected $owners;

    /**
     * @var stdClass
     */
    protected $owner;

    /**
     * @var \SevenShores\Hubspot\Http\Response
     */
    protected $task;

    /**
     * @var EventsTask
     */
    protected $calendarEvents;

    public function setUp()
    {
        parent::setUp();
        $this->owners = new Owners(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        $this->calendarEvents = new CalendarEvents(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        sleep(1);
        $response = $this->owners->all(['email' => getenv('HUBSPOT_TEST_EMAIL')]);
        if (empty($response->getData())) {
            throw new Exception('Invalid Email (HUBSPOT_TEST_EMAIL)');
        }
        $this->owner = $response->getData()[0];
        $this->task = $this->createTestTask();
        sleep(1);
    }

    public function tearDown()
    {
        parent::tearDown();
        if (!empty($this->task)) {
            $this->calendarEvents->deleteTask($this->task->id);
        }
    }

    /**
     * @test
     */
    public function createTask()
    {
        $this->assertSame(200, $this->task->getStatusCode());
    }

    /**
     * @test
     */
    public function updateTask()
    {
        $response = $this->calendarEvents->updateTask($this->task->id, [
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
        $response = $this->calendarEvents->getTaskById($this->task->id);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($this->task->name, $response->name);
        $this->assertEquals($this->task->description, $response->description);
        $this->assertEquals($this->task->ownerId, $response->ownerId);
    }

    /** @test */
    public function deleteTask()
    {
        $response = $this->calendarEvents->deleteTask($this->task->id);
        $this->assertEquals(204, $response->getStatusCode());
        $this->task = null;
    }

    /** @test */
    public function all()
    {
        sleep(5);
        $startDate = $this->task->eventDate - 60 * 60 * 1000;
        $endDate = $this->task->eventDate + 60 * 60 * 1000;

        $response = $this->calendarEvents->all($startDate, $endDate);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, count($response->getData()));
    }

    /** @test */
    public function allTasks()
    {
        sleep(5);
        $startDate = $this->task->eventDate - 60 * 60 * 1000;
        $endDate = $this->task->eventDate + 60 * 60 * 1000;

        $response = $this->calendarEvents->allTasks($startDate, $endDate);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, count($response->toArray()));
    }

    protected function createTestTask()
    {
        $eventData = [
            'eventDate' => strtotime('+1 day') * 1000, //timestamp in milliseconds
            'eventType' => 'PUBLISHING_TASK',
            'category' => 'EMAIL',
            'state' => 'TODO',
            'name' => 'Some task',
            'description' => 'Very important task',
            'ownerId' => $this->owner->ownerId,
        ];

        return $this->calendarEvents->createTask($eventData);
    }
}
