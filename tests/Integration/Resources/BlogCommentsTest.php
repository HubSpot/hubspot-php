<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\BlogPosts;
use SevenShores\Hubspot\Resources\Comments;
use SevenShores\Hubspot\Tests\Integration\Abstraction\BlogPostTestCase;

/**
 * @internal
 * @coversNothing
 */
class BlogCommentsTest extends BlogPostTestCase
{
    /**
     * @var Comments
     */
    protected $resource;

    /**
     * @var Comments:class
     */
    protected $resourceClass = Comments::class;

    /**
     * @var BlogPosts
     */
    protected $blogPostsResource;

    /**
     * @var null\SevenShores\Hubspot\Http\Response
     */
    protected $post;

    public function setUp()
    {
        $this->blogPostsResource = new BlogPosts(new Client(['key' => getenv($this->key)]));

        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
        if (!empty($this->post)) {
            $this->deletePost();
        }
    }

    /** @test */
    public function all()
    {
        $response = $this->resource->all();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getById()
    {
        $response = $this->resource->getById($this->entity->id);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function create()
    {
        $this->assertEquals(200, $this->entity->getStatusCode());
    }

    /** @test */
    public function delete()
    {
        $response = $this->deleteEntity();

        $this->assertEquals(204, $response->getStatusCode());

        $this->entity = null;
    }

    /** @test */
    public function restore()
    {
        $this->deleteEntity();

        $response = $this->resource->restore($this->entity->id);

        $this->assertEquals(204, $response->getStatusCode());
    }

    protected function createEntity()
    {
        $this->post = $this->createPost($this->blogPostsResource);

        sleep(1);

        return $this->resource->create([
            'comment' => 'This is a test blog comment',
            'contentId' => $this->post->id,
            'collectionId' => $this->blogId,
            'contentTitle' => 'This is a test blog title',
            'userEmail' => 'tester@gmail.com',
            'userName' => 'tester',
        ]);
    }

    protected function deleteEntity()
    {
        return $this->resource->delete($this->entity->id);
    }

    protected function deletePost()
    {
        return $this->blogPostsResource->delete($this->post->id);
    }
}
