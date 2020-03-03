<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Resources\BlogPosts;
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
    protected $resourceClass = BlogPosts::class;

    /**
     * @var BlogPosts
     */
    protected $resource;

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
    public function getById()
    {
        $response = $this->resource->getById($this->entity->id);

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
        $response = $this->resource->update($this->entity->id, [
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
        $response = $this->resource->clonePost($this->entity->id, 'Cloned post name');

        $this->assertEquals(201, $response->getStatusCode());

        $this->resource->delete($response->id);
    }

    /** @test */
    public function publishAction()
    {
        $response = $this->resource->publishAction($this->entity->id, 'schedule-publish');

        $this->assertEquals(204, $response->getStatusCode());
    }

    /** @test */
    public function getAutoSaveBufferContents()
    {
        $response = $this->resource->getAutoSaveBufferContents($this->entity->id);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function updateAutoSaveBuffer()
    {
        $response = $this->resource->updateAutoSaveBuffer($this->entity->id, [
            'post_body' => '<p>Hey! It is a test!</p>',
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function hasBufferedChanges()
    {
        $response = $this->resource->hasBufferedChanges($this->entity->id);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertFalse($response->has_changes);
    }

    /** @test */
    public function validateBuffer()
    {
        $response = $this->resource->validateBuffer($this->entity->id);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($response->succeeded);
    }

    /** @test */
    public function pushBufferLive()
    {
        $response = $this->resource->pushBufferLive($this->entity->id);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function restoreDeleted()
    {
        $this->deleteEntity();
        $response = $this->resource->restoreDeleted($this->entity->id);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function versions()
    {
        $response = $this->resource->versions($this->entity->id);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getVersion()
    {
        $this->resource->update($this->entity->id, [
            'post_body' => '<p>Hey! It is a test!</p>',
        ]);

        $listResponse = $this->resource->versions($this->entity->id);

        $versionId = $listResponse->getData()[1]->id;

        $response = $this->resource->getVersion($this->entity->id, $versionId);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function restoreVersion()
    {
        $this->resource->update($this->entity->id, [
            'post_body' => '<p>Hey! It is a test!</p>',
        ]);

        $listResponse = $this->resource->versions($this->entity->id);

        $versionId = $listResponse->getData()[1]->id;

        $response = $this->resource->restoreVersion($this->entity->id, $versionId);

        $this->assertEquals(200, $response->getStatusCode());
    }

    protected function createEntity()
    {
        return $this->createPost($this->resource);
    }

    protected function deleteEntity()
    {
        return $this->resource->delete($this->entity->id);
    }
}
