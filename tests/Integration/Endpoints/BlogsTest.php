<?php

namespace SevenShores\Hubspot\Tests\Integration\Endpoints;

use SevenShores\Hubspot\Endpoints\Blogs;
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
    protected $endpoint;

    /**
     * @var Blogs::class
     */
    protected $endpointClass = Blogs::class;

    /** @test */
    public function allWithNoParams()
    {
        $response = $this->endpoint->all();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function allWithParams()
    {
        $response = $this->endpoint->all(['limit' => 1]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotNull($response->objects[0]->created);
    }

    /** @test */
    public function allWithParamsAndArrayAccess()
    {
        $response = $this->endpoint->all(['limit' => 1]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotNull($response['objects'][0]['created']);
    }

    /** @test */
    public function getById()
    {
        $blogs = $this->endpoint->all(['limit' => 1]);

        $response = $this->endpoint->getById($blogs->objects[0]->id);

        $this->assertEquals(200, $response->getStatusCode());
    }
}
