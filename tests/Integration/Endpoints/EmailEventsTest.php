<?php

namespace SevenShores\Hubspot\Tests\Integration\Endpoints;

use SevenShores\Hubspot\Endpoints\EmailEvents;
use SevenShores\Hubspot\Http\Client;

/**
 * @internal
 * @coversNothing
 */
class EmailEventsTest extends \PHPUnit\Framework\TestCase
{
    protected $endpoint;

    public function setUp(): void
    {
        parent::setUp();
        $this->endpoint = new EmailEvents(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        sleep(1);
    }

    /** @test */
    public function all()
    {
        $response = $this->endpoint->all();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getById()
    {
        $list = $this->endpoint->all(['limit' => 2]);

        if (count($list->events) > 0) {
            $response = $this->endpoint->getById(
                $list->events[0]->id,
                $list->events[0]->created
            );

            $this->assertEquals(200, $response->getStatusCode());
        }
    }

    /** @test */
    public function getCampaignIds()
    {
        $response = $this->endpoint->getCampaignIds(['limit' => 2]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getCampaignIdsWithRecentActivity()
    {
        $response = $this->endpoint->getCampaignIdsWithRecentActivity(['limit' => 2]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getCampaignById()
    {
        $list = $this->endpoint->getCampaignIds(['limit' => 2]);

        if (count($list->campaigns) > 0) {
            $response = $this->endpoint->getCampaignById(
                $list->campaigns[0]->id,
                $list->campaigns[0]->appId
            );

            $this->assertEquals(200, $response->getStatusCode());
        }
    }
}
