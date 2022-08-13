<?php

namespace SevenShores\Hubspot\Tests\Integration\Endpoints;

use SevenShores\Hubspot\Endpoints\BlogComments;
use SevenShores\Hubspot\Endpoints\BlogPosts;
use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Tests\Integration\Abstraction\BlogPostTestCase;

/**
 * @internal
 * @coversNothing
 */
class BlogCommentsTest extends BlogPostTestCase
{
    /**
     * @var BlogComments
     */
    protected $endpoint;

    /**
     * @var BlogComments:class
     */
    protected $endpointClass = BlogComments::class;

    /**
     * @var BlogPosts
     */
    protected $blogPostsEndpoint;

    /**
     * @var null\SevenShores\Hubspot\Http\Response
     */
    protected $post;

    public function setUp(): void
    {
        $this->blogPostsEndpoint = new BlogPosts(new Client(['key' => getenv($this->key)]));

        parent::setUp();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        if (!empty($this->post)) {
            $this->deletePost();
        }
    }

    /** @test */
    public function all()
    {
        $response = $this->endpoint->all();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getById()
    {
        $response = $this->endpoint->getById($this->entity->id);

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

        $response = $this->endpoint->restore($this->entity->id);

        $this->assertEquals(204, $response->getStatusCode());
    }

    protected function createEntity()
    {
        $this->post = $this->createPost($this->blogPostsEndpoint);

        sleep(1);

        return $this->endpoint->create([
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
        return $this->endpoint->delete($this->entity->id);
    }

    protected function deletePost()
    {
        return $this->blogPostsEndpoint->delete($this->post->id);
    }
}
