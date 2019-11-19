<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\Analytics;

/**
 * @internal
 * @coversNothing
 */
class AnalyticsTest extends \PHPUnit_Framework_TestCase
{
    private $analytics;

    public function setUp()
    {
        parent::setUp();
        $this->analytics = new Analytics(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        sleep(1);
    }

    /** @test */
    public function getByCategory()
    {
        $response = $this->analytics->getByCategory('totals', 'total', '20180101', '20180301');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getByType()
    {
        $response = $this->analytics->getByType('forms', 'total', '20180101', '20180301');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getHosted()
    {
        $response = $this->analytics->getHosted('standard-pages', 'total', '20180101', '20180301');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getViews()
    {
        $response = $this->analytics->getViews();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function checkForAnalyticsDataExistence()
    {
        $response = $this->analytics->checkForExistence('event-completions');

        $this->assertEquals(200, $response->getStatusCode());
    }
}
