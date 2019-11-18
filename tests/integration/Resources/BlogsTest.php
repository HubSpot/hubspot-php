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
    private $blogs;

    public function setUp()
    {
        parent::setUp();
        $this->blogs = new Blogs(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        sleep(1);
    }

    /** @test */
    public function allWithNoParams()
    {
        $response = $this->blogs->all();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function allWithParams()
    {
        $response = $this->blogs->all(['limit' => 1]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotNull($response->objects[0]->created);
    }

    /** @test */
    public function allWithParamsAndArrayAccess()
    {
        $response = $this->blogs->all(['limit' => 1]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotNull($response['objects'][0]['created']);
    }

    /** @test */
    public function getById()
    {
        $blogs = $this->blogs->all(['limit' => 1]);

        $response = $this->blogs->getById($blogs->objects[0]->id);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function versionsGetVersion()
    {
        $this->markTestSkipped(); // TODO: fix test
        $blogs = $this->blogs->all(['limit' => 1]);

        $listResponse = $this->blogs->versions($blogs->objects[0]->id);
        $getResponse = $this->blogs->getVersion(
            $blogs->objects[0]->id,
            $listResponse->getData()[0]->version_id
        );

        $this->assertEquals(200, $listResponse->getStatusCode());
        $this->assertEquals(200, $getResponse->getStatusCode());
    }
}
