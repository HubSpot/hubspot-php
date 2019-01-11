<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Resources\Analytics;
use SevenShores\Hubspot\Http\Client;

class AnalyticsTest extends \PHPUnit_Framework_TestCase
{
    private $analytics;

    public function setUp()
    {
        parent::setUp();
        $this->analytics = new Blogs(new Client(['key' => 'demo']));
        sleep(1);
    }

    /** @test */
    public function get_by_category()
    {
        $response = $this->analytics->getByCategory('totals', 'total', '20180101', '20180301');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function get_by_type()
    {
        $response = $this->analytics->getByType('forms', 'total', '20180101', '20180301');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function get_hosted()
    {
        $response = $this->analytics->getHosted('standard-pages', 'total', '20180101', '20180301');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function get_views()
    {
        $response = $this->analytics->getViews();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function get_events_by_id()
    {
        $response = $this->analytics->getEventById('000000142311');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function get_event_by_id_with_params()
    {
        $response = $this->analytics->getEventById('000000142311', ['id' => '000000142312']);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function check_for_analytics_data_existence()
    {
        $response = $this->analytics->checkForExistence('event-completions');

        $this->assertEquals(200, $response->getStatusCode());
    }
}
