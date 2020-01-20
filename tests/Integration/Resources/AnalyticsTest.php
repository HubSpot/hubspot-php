<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Resources\Analytics;
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
    protected $resource;

    /**
     * @var Analytics:class
     */
    protected $resourceClass = Analytics::class;

    /** @test */
    public function getByCategory()
    {
        $response = $this->resource->getByCategory('totals', 'total', '20180101', '20180301');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getByType()
    {
        $response = $this->resource->getByType('forms', 'total', '20180101', '20180301');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getHosted()
    {
        $response = $this->resource->getHosted('standard-pages', 'total', '20180101', '20180301');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function checkForExistence()
    {
        $response = $this->resource->checkForExistence('event-completions');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getEvents()
    {
        $response = $this->resource->getEvents();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getViews()
    {
        $response = $this->resource->getViews();

        $this->assertEquals(200, $response->getStatusCode());
    }
}
