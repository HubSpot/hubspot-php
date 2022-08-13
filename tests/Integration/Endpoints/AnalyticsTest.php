<?php

namespace SevenShores\Hubspot\Tests\Integration\Endpoints;

use SevenShores\Hubspot\Endpoints\Analytics;
use SevenShores\Hubspot\Tests\Integration\Abstraction\DefaultTestCase;

/**
 * @internal
 * @coversNothing
 */
class AnalyticsTest extends DefaultTestCase
{
    /**
     * @var Analytics
     */
    protected $endpoint;

    /**
     * @var Analytics:class
     */
    protected $endpointClass = Analytics::class;

    /** @test */
    public function getByCategory()
    {
        $response = $this->endpoint->getByCategory('totals', 'total', '20180101', '20180301');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getByType()
    {
        $response = $this->endpoint->getByType('forms', 'total', '20180101', '20180301');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getHosted()
    {
        $response = $this->endpoint->getHosted('standard-pages', 'total', '20180101', '20180301');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function checkForExistence()
    {
        $response = $this->endpoint->checkForExistence('event-completions');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getEvents()
    {
        $response = $this->endpoint->getEvents();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getViews()
    {
        $response = $this->endpoint->getViews();

        $this->assertEquals(200, $response->getStatusCode());
    }
}
