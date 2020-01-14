<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\Blogs;

/**
 * @internal
 * @coversNothing
 */
class BlogsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Blogs
     */
    protected $resource;

    public function setUp()
    {
        parent::setUp();
        $this->resource = new Blogs(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        sleep(1);
    }

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

    /** @test */
    public function versionsGetVersion()
    {
        $blogs = $this->resource->all(['limit' => 1]);

        $listResponse = $this->resource->versions($blogs->objects[0]->id);

        $this->assertEquals(200, $listResponse->getStatusCode());

        $getResponse = $this->resource->getVersion(
            $blogs->objects[0]->id,
            $listResponse->getData()[0]->version_id
        );

        $this->assertEquals(200, $getResponse->getStatusCode());
    }
}
