<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\Timeline;

class TimelineTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Timeline
     */
    protected $timeline;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();
        $this->timeline = new Timeline(new Client(['key' => 'demo']));
        sleep(1);
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
