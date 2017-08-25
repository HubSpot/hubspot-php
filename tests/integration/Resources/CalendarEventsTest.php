<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Resources\CalendarEvents;
use SevenShores\Hubspot\Resources\Owners;
use SevenShores\Hubspot\Http\Client;

class CalendarEventsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Owners
     */
    private $owners;

    /**
     * @var EventsTask
     */
    private $calendarEvents;


    public function setUp()
    {
        parent::setUp();
        $this->owners = new Owners(new Client(['key' => 'demo']));
        $this->calendarEvents = new CalendarEvents(new Client(['key' => 'demo']));
        sleep(1);
    }

    /*
     * Lots of tests need an existing task to modify.
     */
    private function createTask()
    {
        $email = uniqid('test_email').'@hubspot.com';
        $owner = $this->createOwner($email);
        $ownerData = $owner->toArray();
        $eventData = [
            'eventDate' => strtotime('+1 day') * 1000, #timestamp in milliseconds
            'eventType' => 'PUBLISHING_TASK',
            'category' => 'EMAIL',
            'state' => 'TODO',
            'name' => 'Some task',
            'description' => 'Very important task',
            'ownerId' => $ownerData['ownerId'],
        ];
        $response = $this->calendarEvents->createTask($eventData);
        $this->assertSame(200, $response->getStatusCode());

        sleep(1);

        return $response;
    }

    /**
     * Creates an Owner with the HubSpotApi
     * @param string $email
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    private function createOwner($email = 'test@owner.com')
    {
        $response = $this->owners->create([
            'type' => 'PERSON',
            'portalId' => 62515, //demo portal id (http://developers.hubspot.com/docs/overview)
            'firstName' => 'Testing',
            'lastName' => 'Owner',
            'email' => $email,
            'remoteList' => [
                [
                    'portalId' => 62515,
                    'remoteType' => 'EMAIL',
                    'remoteId' => 'dev_'.$email,
                    'active' => true,
                ],
            ],
        ]);

        sleep(1);

        return $response;
    }

    /**
     * @test
     */
    public function updateTask()
    {
        $task = $this->createTask();

        $response = $this->calendarEvents->updateTask($task->id, [
            'name' => 'Another name',
            'description' => 'Another description'
        ]);

        $this->assertSame(200, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function getTaskById()
    {
        $task = $this->createTask();

        $response = $this->calendarEvents->getTaskById($task->id);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($task->name, $response->name);
        $this->assertEquals($task->description, $response->description);
        $this->assertEquals($task->ownerId, $response->ownerId);
    }

    /** @test */
    public function deleteTask()
    {
        $task = $this->createTask();

        $response = $this->calendarEvents->deleteTask($task->id);
        $this->assertEquals(204, $response->getStatusCode()); #return no content
    }

    /** @test */
    public function all()
    {
        $task = $this->createTask();
        $startDate = $task['eventDate'] - 60*60*1000;
        $endDate = $task['eventDate'] + 60*60*1000;

        $response = $this->calendarEvents->all($startDate, $endDate);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, count($response->toArray()));
    }

    /** @test */
    public function allTasks()
    {
        $task = $this->createTask();
        $startDate = $task['eventDate'] - 60*60*1000;
        $endDate = $task['eventDate'] + 60*60*1000;

        $response = $this->calendarEvents->allTasks($startDate, $endDate);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, count($response->toArray()));
    }
}
