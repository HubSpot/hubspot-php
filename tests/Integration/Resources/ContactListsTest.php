<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Resources\ContactLists;
use SevenShores\Hubspot\Tests\Integration\Abstraction\ContactListsTestCase;

/**
 * @internal
 * @coversNothing
 */
class ContactListsTest extends ContactListsTestCase
{
    /**
     * @var ContactLists
     */
    protected $resource;

    /**
     * @var ContactLists::class
     */
    protected $resourceClass = ContactLists::class;

    /** @test */
    public function allWithNoParams()
    {
        $response = $this->resource->all();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getAllStatic()
    {
        $response = $this->resource->getAllStatic();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function update()
    {
        $response = $this->resource->update($this->entity->listId, [
            'name' => 'New test name '.uniqid(),
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getById()
    {
        $response = $this->resource->getById($this->entity->listId);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getBatchByIds()
    {
        $list = $this->createEntity();

        $ids = [
            $this->entity->listId,
            $list->listId,
        ];

        $response = $this->resource->getBatchByIds($ids);

        $this->assertEquals(200, $response->getStatusCode());

        $this->resource->delete($list->listId);
    }

    /** @test */
    public function contacts()
    {
        $response = $this->resource->contacts($this->entity->listId);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function recentContacts()
    {
        $response = $this->resource->recentContacts($this->entity->listId);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function delete()
    {
        $response = $this->resource->delete($this->entity->listId);

        $this->assertEquals(204, $response->getStatusCode());

        $this->entity = null;
    }
}
