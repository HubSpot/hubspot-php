<?php

namespace SevenShores\Hubspot\Tests\Integration\Endpoints;

use SevenShores\Hubspot\Endpoints\ContactLists;
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
    protected $endpoint;

    /**
     * @var ContactLists::class
     */
    protected $endpointClass = ContactLists::class;

    /** @test */
    public function allWithNoParams()
    {
        $response = $this->endpoint->all();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getAllStatic()
    {
        $response = $this->endpoint->getAllStatic();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function update()
    {
        $response = $this->endpoint->update($this->entity->listId, [
            'name' => 'New test name '.uniqid(),
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getById()
    {
        $response = $this->endpoint->getById($this->entity->listId);

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

        $response = $this->endpoint->getBatchByIds($ids);

        $this->assertEquals(200, $response->getStatusCode());

        $this->endpoint->delete($list->listId);
    }

    /** @test */
    public function contacts()
    {
        $response = $this->endpoint->contacts($this->entity->listId);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function recentContacts()
    {
        $response = $this->endpoint->recentContacts($this->entity->listId);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function delete()
    {
        $response = $this->endpoint->delete($this->entity->listId);

        $this->assertEquals(204, $response->getStatusCode());

        $this->entity = null;
    }
}
