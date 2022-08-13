<?php

namespace SevenShores\Hubspot\Tests\Integration\Endpoints;

use SevenShores\Hubspot\Endpoints\Contacts;
use SevenShores\Hubspot\Endpoints\Engagements;
use SevenShores\Hubspot\Tests\Integration\Abstraction\EntityTestCase;

/**
 * @internal
 * @coversNothing
 */
class EngagementsTest extends EntityTestCase
{
    /**
     * @var Engagements
     */
    protected $endpoint;

    /**
     * @var Engagements::class
     */
    protected $endpointClass = Engagements::class;

    /**
     * @var Contacts
     */
    protected $contactsEndpoint;

    /**
     * @var \SevenShores\Hubspot\Http\Response
     */
    protected $contact;

    public function setUp(): void
    {
        $this->contactsEndpoint = new Contacts($this->getClient());

        $this->contact = $this->createContact();
        sleep(1);

        parent::setUp();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        if (!empty($this->contact)) {
            $this->deleteContact();
        }
    }

    /** @test */
    public function create()
    {
        $this->assertEquals(200, $this->entity->getStatusCode());
    }

    /** @test */
    public function update()
    {
        $response = $this->endpoint->update($this->entity->engagement->id, [
            'active' => true,
            'ownerId' => 1,
            'type' => 'NOTE',
            'timestamp' => time(),
        ], [
            'body' => 'note body1',
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
    public function get()
    {
        $response = $this->endpoint->get($this->entity->engagement->id);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function all()
    {
        $response = $this->endpoint->all();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function recent()
    {
        $response = $this->endpoint->recent();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getCallDispositions()
    {
        $response = $this->endpoint->getCallDispositions();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertCount(6, $response->getData());
    }

    protected function createEntity()
    {
        return $this->endpoint->create([
            'active' => true,
            'ownerId' => 1,
            'type' => 'NOTE',
            'timestamp' => time(),
        ], [
            'contactIds' => [$this->contact->vid],
            'companyIds' => [],
            'dealIds' => [],
            'ownerIds' => [],
        ], [
            'body' => 'note body',
        ]);
    }

    protected function deleteEntity()
    {
        return $this->endpoint->delete($this->entity->engagement->id);
    }

    protected function createContact()
    {
        return $this->contactsEndpoint->create([
            ['property' => 'email',     'value' => 'rw_test'.uniqid().'@hubspot.com'],
            ['property' => 'firstname', 'value' => 'joe'],
            ['property' => 'lastname',  'value' => 'user'],
        ]);
    }

    protected function deleteContact()
    {
        return $this->contactsEndpoint->delete($this->contact->vid);
    }
}
