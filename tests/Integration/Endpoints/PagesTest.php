<?php

namespace SevenShores\Hubspot\Tests\Integration\Endpoints;

use SevenShores\Hubspot\Tests\Integration\Abstraction\EntityTestCase;

/**
 * @internal
 * @coversNothing
 */
class PagesTest extends EntityTestCase
{
    /**
     * @var null|SevenShores\Hubspot\Endpoints\Endpoint::class
     */
    protected $endpointClass = 'SevenShores\Hubspot\Endpoints\Pages';

    /** @test */
    public function create()
    {
        $this->assertEquals(201, $this->entity->getStatusCode());
    }

    /** @test */
    public function update()
    {
        $response = $this->endpoint->update(
            $this->entity->id,
            ['name' => 'Updated '.$this->entity->name]
        );

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getById()
    {
        $response = $this->endpoint->getById($this->entity->id);

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
        $response = $this->endpoint->all();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function clonePage()
    {
        $response = $this->endpoint->clonePage($this->entity->id, 'New page name');

        $this->assertEquals(201, $response->getStatusCode());

        $this->endpoint->delete($response->id);
    }

    protected function createEntity()
    {
        return $this->endpoint->create([
            'name' => 'My Super Awesome Post(AutoTest)',
        ]);
    }

    protected function deleteEntity()
    {
        return $this->endpoint->delete($this->entity->id);
    }
}
