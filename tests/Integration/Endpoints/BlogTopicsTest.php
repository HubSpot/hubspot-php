<?php

namespace SevenShores\Hubspot\Tests\Integration\Endpoints;

use SevenShores\Hubspot\Endpoints\BlogTopics;
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
    protected $endpointClass = BlogTopics::class;

    /**
     * @var BlogTopics
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
    public function searchWithoutQueryAndParams()
    {
        $response = $this->endpoint->search('');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function searchWithQueryAndWithoutParams()
    {
        $response = $this->endpoint->search('Test');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function searchWithQueryAndParams()
    {
        $response = $this->endpoint->search('Test', [
            'limit' => 5,
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertLessThanOrEqual(5, count($response->objects));
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
        return $this->endpoint->create([
            'name' => 'Topic Test '.uniqid(),
            'description' => 'Topic Test '.uniqid().' Description',
        ]);
    }

    protected function deleteEntity()
    {
        return $this->endpoint->delete($this->entity->id);
    }
}
