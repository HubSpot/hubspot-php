<?php

namespace SevenShores\Hubspot\Tests\Integration\Endpoints;

use SevenShores\Hubspot\Endpoints\Contacts;
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
    protected $contactsEndpoint;

    public function setUp(): void
    {
        parent::setUp();

        $this->contactsEndpoint = new Contacts($this->getClient());
    }

    /** @test */
    public function getAllDynamic()
    {
        $response = $this->endpoint->getAllStatic();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function addContact()
    {
        $contact = $this->createContact();

        $response = $this->endpoint->addContact($this->entity->listId, [$contact->vid]);

        $this->assertEquals(200, $response->getStatusCode());

        $this->endpoint->removeContact($this->entity->listId, [$contact->vid]);

        $this->contactsEndpoint->delete($contact->vid);
    }

    /** @test */
    public function removeContact()
    {
        $contact = $this->createContact();

        $this->endpoint->addContact($this->entity->listId, [$contact->vid]);

        $response = $this->endpoint->removeContact($this->entity->listId, [$contact->vid]);

        $this->assertEquals(200, $response->getStatusCode());

        $this->contactsEndpoint->delete($contact->vid);
    }

    /**
     * Creates a new contact.
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    protected function createContact()
    {
        $contactResponse = $this->contactsEndpoint->create([
            ['property' => 'email', 'value' => 'ContactListsTest'.uniqid().'@hubspot.com'],
            ['property' => 'firstname', 'value' => 'joe'],
            ['property' => 'lastname', 'value' => 'user'],
        ]);

        sleep(1);

        return $contactResponse;
    }
}
