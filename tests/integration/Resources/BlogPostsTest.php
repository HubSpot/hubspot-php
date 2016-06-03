<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Resources\BlogPosts;
use SevenShores\Hubspot\Http\Client;

class BlogPostsTest extends \PHPUnit_Framework_TestCase
{
    private $blogPosts;

    public function setUp()
    {
        parent::setUp();
        $this->blogPosts = new BlogPosts(new Client(['key' => 'demo']));
        sleep(1);
    }

    /*
     * Lots of tests need an existing object to modify.
     */
    private function createBlogPost()
    {
        sleep(1);

        $response = $this->blogPosts->create([
            'name'             => 'My Super Awesome Post ' . uniqid(),
            'content_group_id' => 351076997,
        ]);

        $this->assertEquals(201, $response->getStatusCode());

        return $response;
    }

    /** @test */
    public function all_with_no_params()
    {
        $response = $this->blogPosts->all();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function all_with_params()
    {
        $response = $this->blogPosts->all([
            'limit'  => 2,
            'offset' => 3,
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertLessThanOrEqual(2, count($response->objects));
        $this->assertGreaterThanOrEqual(3, $response->offset);
    }

    /** @test */
    public function all_with_params_and_array_access()
    {
        $response = $this->blogPosts->all([
            'limit'  => 2,
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

        $response = $this->blogPosts->update($post->id, [
            'post_body' => '<p>Hey man!</p>',
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getById()
    {
        $post = $this->createBlogPost();

        $response = $this->blogPosts->getById($post->id);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function updateAutoSaveBuffer()
    {
        $post = $this->createBlogPost();

        $response = $this->blogPosts->updateAutoSaveBuffer($post->id, [
            'post_body' => '<p>Hey! It is a test!</p>',
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getAutoSaveBufferContents()
    {
        $post = $this->createBlogPost();

        $response = $this->blogPosts->getAutoSaveBufferContents($post->id);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function clonePost()
    {
        $post = $this->createBlogPost();

        $response = $this->blogPosts->clonePost($post->id);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function hasBufferedChanges()
    {
        $post = $this->createBlogPost();

        $response = $this->blogPosts->hasBufferedChanges($post->id);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertFalse($response->has_changes);
    }

    /** @test */
    public function publishAction()
    {
        $post = $this->createBlogPost();

        $response = $this->blogPosts->publishAction($post->id, "push-buffer-live");

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function pushBufferLive()
    {
        $post = $this->createBlogPost();

        $response = $this->blogPosts->pushBufferLive($post->id);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function delete_restoreDeleted()
    {
        $post = $this->createBlogPost();

        $deleteResponse = $this->blogPosts->delete($post->id);
        $response = $this->blogPosts->restoreDeleted($post->id);

        $this->assertEquals(200, $deleteResponse->getStatusCode());
        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function validateBuffer()
    {
        $post = $this->createBlogPost();

        $response = $this->blogPosts->validateBuffer($post->id);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($response->succeeded);
    }

    /** @test */
    public function versions_getVersion_restoreVersion()
    {
        $post = $this->createBlogPost();

        // versions()
        $listResponse = $this->blogPosts->versions($post->id);
        $versions = $listResponse->getData();

        // getVersion()
        $getResponse = $this->blogPosts->getVersion($post->id, $versions[0]->version_id);

        // restoreVersion()
        $restoreResponse = $this->blogPosts->restoreVersion($post->id, $versions[0]->version_id);

        $this->assertEquals(200, $listResponse->getStatusCode());
        $this->assertEquals(200, $getResponse->getStatusCode());
        $this->assertEquals(200, $restoreResponse->getStatusCode());
    }
}
