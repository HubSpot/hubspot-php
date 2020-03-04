<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Resources\BlogTopics;
use SevenShores\Hubspot\Tests\Integration\Abstraction\EntityTestCase;

/**
 * @internal
 * @coversNothing
 */
class BlogTopicsTest extends EntityTestCase
{
    /**
     * @var BlogTopics::class
     */
    protected $resourceClass = BlogTopics::class;

    /**
     * @var BlogTopics
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
    public function searchWithoutQueryAndParams()
    {
        $response = $this->resource->search('');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function searchWithQueryAndWithoutParams()
    {
        $response = $this->resource->search('Test');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function searchWithQueryAndParams()
    {
        $response = $this->resource->search('Test', [
            'limit' => 5,
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertLessThanOrEqual(5, count($response->objects));
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
            'name' => 'Topic Test '.uniqid().' Updated',
            'description' => 'Topic Test '.uniqid().' Description Updated',
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

    protected function createEntity()
    {
        return $this->resource->create('Topic Test '.uniqid(), [
            'description' => 'Topic Test '.uniqid().' Description',
        ]);
    }

    protected function deleteEntity()
    {
        return $this->resource->delete($this->entity->id);
    }
}
