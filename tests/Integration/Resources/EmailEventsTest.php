<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\EmailEvents;

/**
 * @internal
 * @coversNothing
 */
class EmailEventsTest extends \PHPUnit_Framework_TestCase
{
    protected $resource;

    public function setUp()
    {
        parent::setUp();
        $this->resource = new EmailEvents(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        sleep(1);
    }

    /** @test */
    public function all()
    {
        $response = $this->resource->all();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getById()
    {
        $list = $this->resource->all(['limit' => 2]);

        if (count($list->events) > 0) {
            $response = $this->resource->getById(
                $list->events[0]->id,
                $list->events[0]->created
            );

            $this->assertEquals(200, $response->getStatusCode());
        }
    }

    /** @test */
    public function getCampaignIds()
    {
        $response = $this->resource->getCampaignIds(['limit' => 2]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getCampaignIdsWithRecentActivity()
    {
        $response = $this->resource->getCampaignIdsWithRecentActivity(['limit' => 2]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getCampaignById()
    {
        $list = $this->resource->getCampaignIds(['limit' => 2]);

        if (count($list->campaigns) > 0) {
            $response = $this->resource->getCampaignById(
                $list->campaigns[0]->id,
                $list->campaigns[0]->appId
            );

            $this->assertEquals(200, $response->getStatusCode());
        }
    }
}
