<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Resources\Contacts;
use SevenShores\Hubspot\Resources\Engagements;
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
    protected $resource;

    /**
     * @var Engagements::class
     */
    protected $resourceClass = Engagements::class;

    /**
     * @var Contacts
     */
    protected $contactsResource;

    /**
     * @var \SevenShores\Hubspot\Http\Response
     */
    protected $contact;

    public function setUp()
    {
        $this->contactsResource = new Contacts($this->getClient());

        $this->contact = $this->createContact();
        sleep(1);

        parent::setUp();
    }

    public function tearDown()
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
        $response = $this->resource->update($this->entity->engagement->id, [
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
        $response = $this->resource->get($this->entity->engagement->id);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function all()
    {
        $response = $this->resource->all();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function recent()
    {
        $response = $this->resource->recent();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getCallDispositions()
    {
        $response = $this->resource->getCallDispositions();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertCount(6, $response->getData());
    }

    protected function createEntity()
    {
        return $this->resource->create([
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
        return $this->resource->delete($this->entity->engagement->id);
    }

    protected function createContact()
    {
        return $this->contactsResource->create([
            ['property' => 'email',     'value' => 'rw_test'.uniqid().'@hubspot.com'],
            ['property' => 'firstname', 'value' => 'joe'],
            ['property' => 'lastname',  'value' => 'user'],
        ]);
    }

    protected function deleteContact()
    {
        return $this->contactsResource->delete($this->contact->vid);
    }
}
