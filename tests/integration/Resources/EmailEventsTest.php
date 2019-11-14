<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\EmailEvents;

class EmailEventsTest extends \PHPUnit_Framework_TestCase
{
    private $emailEvents;

    public function setUp()
    {
        parent::setUp();
        $this->emailEvents = new EmailEvents(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        sleep(1);
    }

    /** @test */
    public function all()
    {
        $response = $this->emailEvents->all();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getById()
    {
        $this->markTestSkipped(); // TODO: fix test
        $list = $this->emailEvents->all(['limit' => 2]);

        $response = $this->emailEvents->getById(
            $list->events[0]->id,
            $list->events[0]->created
        );

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getCampaignIds()
    {
        $response = $this->emailEvents->getCampaignIds(['limit' => 2]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getCampaignById()
    {
        $this->markTestSkipped(); // TODO: fix test
        $list = $this->emailEvents->getCampaignIds(['limit' => 2]);

        $response = $this->emailEvents->getCampaignById(
            $list->campaigns[0]->id,
            $list->campaigns[0]->appId
        );

        $this->assertEquals(200, $response->getStatusCode());
    }
}
