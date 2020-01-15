<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Resources\BlogAuthors;
use SevenShores\Hubspot\Tests\Integration\Abstraction\EntityTestCase;

/**
 * @internal
 * @coversNothing
 */
class BlogAuthorsTest extends EntityTestCase
{
    protected $resourceClass = BlogAuthors::class;

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
        $response = $this->resource->search();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function searchWithQueryAndWithoutParams()
    {
        $response = $this->resource->search('john-smith');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function searchWithQueryAndParams()
    {
        $response = $this->resource->search('john-smith', [
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
            'bio' => 'Lorem ipsum dolor sit amet.',
            'website' => 'http://example.com',
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function delete()
    {
        $response = $this->resource->delete($this->entity->id);

        $this->assertEquals(204, $response->getStatusCode());

        $this->entity = null;
    }

    protected function createEntity()
    {
        return $this->resource->create([
            'fullName' => 'John Smith '.uniqid(),
            'email' => 'john.smith'.uniqid().'@example.com',
            'username' => 'john-smith',
        ]);
    }

    protected function deleteEntity()
    {
        $this->resource->delete($this->entity->id);
    }
}
