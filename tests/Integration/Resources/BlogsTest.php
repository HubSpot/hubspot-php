<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Resources\Blogs;
use SevenShores\Hubspot\Tests\Integration\Abstraction\DefaultTestCase;

/**
 * @internal
 * @coversNothing
 */
class BlogsTest extends DefaultTestCase
{
    /**
     * @var Blogs
     */
    protected $resource;

    /**
     * @var Blogs::class
     */
    protected $resourceClass = Blogs::class;

    /** @test */
    public function allWithNoParams()
    {
        $response = $this->resource->all();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function allWithParams()
    {
        $response = $this->resource->all(['limit' => 1]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotNull($response->objects[0]->created);
    }

    /** @test */
    public function allWithParamsAndArrayAccess()
    {
        $response = $this->resource->all(['limit' => 1]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotNull($response['objects'][0]['created']);
    }

    /** @test */
    public function getById()
    {
        $blogs = $this->resource->all(['limit' => 1]);

        $response = $this->resource->getById($blogs->objects[0]->id);

        $this->assertEquals(200, $response->getStatusCode());
    }
}
