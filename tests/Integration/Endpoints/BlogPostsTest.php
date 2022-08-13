<?php

namespace SevenShores\Hubspot\Tests\Integration\Endpoints;

use SevenShores\Hubspot\Endpoints\BlogPosts;
use SevenShores\Hubspot\Tests\Integration\Abstraction\BlogPostTestCase;

/**
 * @internal
 * @coversNothing
 */
class BlogPostsTest extends BlogPostTestCase
{
    /**
     * @var BlogPosts::class
     */
    protected $endpointClass = BlogPosts::class;

    /**
     * @var BlogPosts
     */
    protected $endpoint;

    /** @test */
    public function allWithNoParams()
    {
        $response = $this->endpoint->all();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function allWithParams()
    {
        $response = $this->endpoint->all([
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
        $response = $this->endpoint->all([
            'limit' => 2,
            'offset' => 3,
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertLessThanOrEqual(2, count($response['objects']));
        $this->assertGreaterThanOrEqual(3, $response['offset']);
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
        $this->assertEquals(201, $this->entity->getStatusCode());
    }

    /** @test */
    public function update()
    {
        $response = $this->endpoint->update($this->entity->id, [
            'post_body' => '<p>Hey man!</p>',
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function delete()
    {
        $response = $this->deleteEntity();

        $this->assertEquals(204, $response->getStatusCode());

        $this->entity = null;
    }

    /** @test */
    public function clonePost()
    {
        $response = $this->endpoint->clone($this->entity->id, 'Cloned post name');

        $this->assertEquals(201, $response->getStatusCode());

        $this->endpoint->delete($response->id);
    }

    /** @test */
    public function publishAction()
    {
        $response = $this->endpoint->publishAction($this->entity->id, 'schedule-publish');

        $this->assertEquals(204, $response->getStatusCode());
    }

    /** @test */
    public function getAutoSaveBufferContents()
    {
        $response = $this->endpoint->getAutoSaveBufferContents($this->entity->id);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function updateAutoSaveBuffer()
    {
        $response = $this->endpoint->updateAutoSaveBuffer($this->entity->id, [
            'post_body' => '<p>Hey! It is a test!</p>',
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function hasBufferedChanges()
    {
        $response = $this->endpoint->hasBufferedChanges($this->entity->id);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertFalse($response->has_changes);
    }

    /** @test */
    public function validateBuffer()
    {
        $response = $this->endpoint->validateBuffer($this->entity->id);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($response->succeeded);
    }

    /** @test */
    public function pushBufferLive()
    {
        $response = $this->endpoint->pushBufferLive($this->entity->id);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function restoreDeleted()
    {
        $this->deleteEntity();
        $response = $this->endpoint->restoreDeleted($this->entity->id);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function versions()
    {
        $response = $this->endpoint->versions($this->entity->id);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getVersion()
    {
        $this->endpoint->update($this->entity->id, [
            'post_body' => '<p>Hey! It is a test!</p>',
        ]);

        $listResponse = $this->endpoint->versions($this->entity->id);

        $versionId = $listResponse->getData()[1]->id;

        $response = $this->endpoint->getVersion($this->entity->id, $versionId);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function restoreVersion()
    {
        $this->endpoint->update($this->entity->id, [
            'post_body' => '<p>Hey! It is a test!</p>',
        ]);

        $listResponse = $this->endpoint->versions($this->entity->id);

        $versionId = $listResponse->getData()[1]->id;

        $response = $this->endpoint->restoreVersion($this->entity->id, $versionId);

        $this->assertEquals(200, $response->getStatusCode());
    }

    protected function createEntity()
    {
        return $this->createPost($this->endpoint);
    }

    protected function deleteEntity()
    {
        return $this->endpoint->delete($this->entity->id);
    }
}
