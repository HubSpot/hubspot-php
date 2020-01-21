<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Tests\Integration\Abstraction\DefaultTestCase;
use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\BlogPosts;
use SevenShores\Hubspot\Resources\Blogs;

/**
 * @internal
 * @coversNothing
 */
class BlogPostsTest extends DefaultTestCase
{
    /**
     * @var BlogPosts::class
     */
    protected $resourceClass = BlogPosts::class;
    
    /**
     * @var BlogPosts
     */
    protected $resource;
    
    private $blogId;

    public function setUp()
    {
        parent::setUp();
        $client = new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]);
        $this->blogId = (new Blogs($client))->all(['limit' => 1])->objects[0]->id;
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
        $response = $this->resource->all([
            'limit' => 2,
            'offset' => 3,
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertLessThanOrEqual(2, count($response->objects));
        $this->assertGreaterThanOrEqual(3, $response->offset);
    }

    /** @test */
    public function allWithParamsAndArrayAccess()
    {
        $response = $this->resource->all([
            'limit' => 2,
            'offset' => 3,
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertLessThanOrEqual(2, count($response['objects']));
        $this->assertGreaterThanOrEqual(3, $response['offset']);
    }

    /** @test */
    public function update()
    {
        $post = $this->createBlogPost();

        $response = $this->resource->update($post->id, [
            'post_body' => '<p>Hey man!</p>',
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getById()
    {
        $post = $this->createBlogPost();

        $response = $this->resource->getById($post->id);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function updateAutoSaveBuffer()
    {
        $post = $this->createBlogPost();

        $response = $this->resource->updateAutoSaveBuffer($post->id, [
            'post_body' => '<p>Hey! It is a test!</p>',
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getAutoSaveBufferContents()
    {
        $post = $this->createBlogPost();

        $response = $this->resource->getAutoSaveBufferContents($post->id);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function clonePost()
    {
        $post = $this->createBlogPost();

        $response = $this->resource->clonePost($post->id, 'Cloned post name');

        $this->assertEquals(201, $response->getStatusCode());
    }

    /** @test */
    public function hasBufferedChanges()
    {
        $post = $this->createBlogPost();

        $response = $this->resource->hasBufferedChanges($post->id);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertFalse($response->has_changes);
    }

    /** @test */
    public function publishAction()
    {
        $this->markTestSkipped(); // TODO: fix test

        $post = $this->createBlogPost();

        $response = $this->resource->publishAction($post->id, 'schedule-publish');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function pushBufferLive()
    {
        $post = $this->createBlogPost();

        $response = $this->resource->pushBufferLive($post->id);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function deleteRestoreDeleted()
    {
        $this->markTestSkipped(); // TODO: fix test

        $post = $this->createBlogPost();

        $deleteResponse = $this->resource->delete($post->id);
        $response = $this->resource->restoreDeleted($post->id);

        $this->assertEquals(200, $deleteResponse->getStatusCode());
        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function validateBuffer()
    {
        $post = $this->createBlogPost();

        $response = $this->resource->validateBuffer($post->id);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($response->succeeded);
    }

    /** @test */
    public function versionsGetVersionRestoreVersion()
    {
        $this->markTestSkipped(); // TODO: fix test

        $post = $this->createBlogPost();

        // versions()
        $listResponse = $this->resource->versions($post->id);
        $versions = $listResponse->getData();

        // getVersion()
        $getResponse = $this->resource->getVersion($post->id, $versions[0]->version_id);

        // restoreVersion()
        $restoreResponse = $this->resource->restoreVersion($post->id, $versions[0]->version_id);

        $this->assertEquals(200, $listResponse->getStatusCode());
        $this->assertEquals(200, $getResponse->getStatusCode());
        $this->assertEquals(200, $restoreResponse->getStatusCode());
    }

    // Lots of tests need an existing object to modify.
    private function createBlogPost()
    {
        sleep(1);

        $response = $this->resource->create([
            'name' => 'My Super Awesome Post '.uniqid(),
            'content_group_id' => $this->blogId,
        ]);

        $this->assertEquals(201, $response->getStatusCode());

        return $response;
    }
}
