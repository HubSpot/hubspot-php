<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Resources\Contacts;
use SevenShores\Hubspot\Tests\Integration\Abstraction\ContactListsTestCase;

/**
 * @internal
 * @coversNothing
 */
class ContactDinamicListsTest extends ContactListsTestCase
{
    /**
     * @var bool
     */
    protected $dynamic = false;

    /**
     * @var Contacts
     */
    protected $contactsResource;

    public function setUp()
    {
        parent::setUp();

        $this->contactsResource = new Contacts($this->getClient());
    }

    /** @test */
    public function getAllDynamic()
    {
        $response = $this->resource->getAllStatic();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function addContact()
    {
        $contact = $this->createContact();

        $response = $this->resource->addContact($this->entity->listId, [$contact->vid]);

        $this->assertEquals(200, $response->getStatusCode());

        $this->resource->removeContact($this->entity->listId, [$contact->vid]);

        $this->contactsResource->delete($contact->vid);
    }

    /** @test */
    public function removeContact()
    {
        $contact = $this->createContact();

        $this->resource->addContact($this->entity->listId, [$contact->vid]);

        $response = $this->resource->removeContact($this->entity->listId, [$contact->vid]);

        $this->assertEquals(200, $response->getStatusCode());

        $this->contactsResource->delete($contact->vid);
    }

    /**
     * Creates a new contact.
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    protected function createContact()
    {
        $contactResponse = $this->contactsResource->create([
            ['property' => 'email', 'value' => 'ContactListsTest'.uniqid().'@hubspot.com'],
            ['property' => 'firstname', 'value' => 'joe'],
            ['property' => 'lastname', 'value' => 'user'],
        ]);

        sleep(1);

        return $contactResponse;
    }
}
