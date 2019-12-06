<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\BlogTopics;

/**
 * @internal
 * @coversNothing
 */
class BlogTopicsTest extends \PHPUnit_Framework_TestCase
{
    private $blogTopics;

    public function setUp()
    {
        parent::setUp();
        $this->blogTopics = new BlogTopics(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        sleep(1);
    }

    /** @test */
    public function allWithNoParams()
    {
        $response = $this->blogTopics->all();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function allWithParams()
    {
        $response = $this->blogTopics->all([
            'limit' => 2,
            'offset' => 3,
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertLessThanOrEqual(2, count($response->objects));
        $this->assertGreaterThanOrEqual(3, $response->offset);
    }

    /** @test */
    public function searchWithoutQueryAndParams()
    {
        $response = $this->blogTopics->search('');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function searchWithQueryAndWithoutParams()
    {
        $response = $this->blogTopics->search('Test');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function searchWithQueryAndParams()
    {
        $response = $this->blogTopics->search('Test', [
            'limit' => 5,
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertLessThanOrEqual(5, count($response->objects));
    }

    /** @test */
    public function getById()
    {
        $topic = $this->createBlogTopic();

        $response = $this->blogTopics->getById($topic->id);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function create()
    {
        $response = $this->blogTopics->create('Topic Test '.uniqid(), [
            'description' => 'Topic Test '.uniqid().' Description',
        ]);

        $this->assertEquals(201, $response->getStatusCode());
    }

    /** @test */
    public function update()
    {
        $topic = $this->createBlogTopic();

        $response = $this->blogTopics->update($topic->id, [
            'name' => 'Topic Test '.uniqid().' Updated',
            'description' => 'Topic Test '.uniqid().' Description Updated',
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function delete()
    {
        $topic = $this->createBlogTopic();

        $response = $this->blogTopics->delete($topic->id);

        $this->assertEquals(204, $response->getStatusCode());
    }

    // Lots of tests need an existing object to modify.
    private function createBlogTopic()
    {
        sleep(1);

        $response = $this->blogTopics->create('Topic Test '.uniqid(), [
            'description' => 'Topic Test '.uniqid().' Description',
        ]);

        $this->assertEquals(201, $response->getStatusCode());

        return $response;
    }
}
