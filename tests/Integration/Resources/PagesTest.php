<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Tests\Integration\Abstraction\EntityTestCase;

/**
 * @internal
 * @coversNothing
 */
class PagesTest extends EntityTestCase
{
    /**
     * @var null|SevenShores\Hubspot\Resources\Resource::class
     */
    protected $resourceClass = 'SevenShores\Hubspot\Resources\Pages';

    /** @test */
    public function create()
    {
        $this->assertEquals(201, $this->entity->getStatusCode());
    }

    /** @test */
    public function update()
    {
        $response = $this->resource->update(
            $this->entity->id,
            ['name' => 'Updated '.$this->entity->name]
        );

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getById()
    {
        $response = $this->resource->getById($this->entity->id);

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
    public function all()
    {
        $response = $this->resource->all();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function clonePage()
    {
        $response = $this->resource->clonePage($this->entity->id, 'New page name');

        $this->assertEquals(201, $response->getStatusCode());

        $this->resource->delete($response->id);
    }

    protected function createEntity()
    {
        return $this->resource->create([
            'name' => 'My Super Awesome Post(AutoTest)',
        ]);
    }

    protected function deleteEntity()
    {
        return $this->resource->delete($this->entity->id);
    }
}
