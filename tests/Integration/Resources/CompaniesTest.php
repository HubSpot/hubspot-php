<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Resources\Companies;
use SevenShores\Hubspot\Resources\Contacts;
use SevenShores\Hubspot\Tests\Integration\Abstraction\EntityTestCase;

/**
 * Class CompaniesTest.
 *
 * @group companies
 *
 * @internal
 * @coversNothing
 */
class CompaniesTest extends EntityTestCase
{
    /**
     * @var Companies
     */
    protected $resource;

    /**
     * @var Companies::class
     */
    protected $resourceClass = Companies::class;

    /**
     * @var Contacts
     */
    protected $contactsResource;

    public function setUp()
    {
        $this->contactsResource = new Contacts($this->getClient());
        parent::setUp();
    }

    /** @test */
    public function create()
    {
        $this->assertEquals(200, $this->entity->getStatusCode());
        $this->assertEquals('A company name', $this->entity->properties->name->value);
        $this->assertEquals('A company description', $this->entity->properties->description->value);
        $this->assertEquals('example.com', $this->entity->properties->domain->value);
    }

    /** @test */
    public function update()
    {
        $companyDescription = 'A far better description than before';
        $properties = [
            'name' => 'description',
            'value' => $companyDescription,
        ];

        $response = $this->resource->update($this->entity->companyId, $properties);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($this->entity->companyId, $response->companyId);
        $this->assertEquals($companyDescription, $response->properties->description->value);
    }

    /** @test */
    public function updateBatch()
    {
        $companyDescription = 'A far better description than before';

        $companies = [
            [
                'objectId' => $this->entity->companyId,
                'properties' => [
                    [
                        'name' => 'description',
                        'value' => $companyDescription,
                    ],
                ],
            ],
        ];

        $response = $this->resource->updateBatch($companies);

        $this->assertEquals(202, $response->getStatusCode());
    }

    /** @test */
    public function delete()
    {
        $response = $this->deleteEntity();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($this->entity->companyId, $response->companyId);
        $this->assertTrue($response['deleted']);

        $this->entity = null;
    }

    /** @test */
    public function getAll()
    {
        $response = $this->resource->all();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThan(0, \count($response->data->companies));
    }

    /** @test */
    public function getRecentlyModified()
    {
        $response = $this->resource->getRecentlyModified();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThan(2, $response['results']);
    }

    /** @test */
    public function getRecentlyModifiedWithCountAndOffset()
    {
        $params = ['count' => 2, 'offset' => 1];
        $response = $this->resource->getRecentlyModified($params);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertCount(2, $response['results']);
        $this->assertEquals(3, $response['offset']);
    }

    /** @test */
    public function getRecentlyCreated()
    {
        $response = $this->resource->getRecentlyCreated();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThan(2, $response['results']);
    }

    /** @test */
    public function getRecentlyCreatedWithCountAndOffset()
    {
        $params = ['count' => 2, 'offset' => 1];
        $response = $this->resource->getRecentlyCreated($params);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getById()
    {
        $response = $this->resource->getById($this->entity->companyId);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($this->entity->companyId, $response->companyId);
    }

    /** @test */
    public function getAssociatedContacts()
    {
        list($contactId) = $this->createAssociatedContact($this->entity->companyId);

        $response = $this->resource->getAssociatedContacts($this->entity->companyId);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertCount(1, $response->contacts);
        $this->assertEquals($contactId, $response->contacts[0]->vid);

        $this->deleteAssociatedContacts($this->entity->companyId, [$contactId]);
    }

    /** @test */
    public function getAssociatedContactsWithCountAndOffset()
    {
        list($contactId) = $this->createAssociatedContact($this->entity->companyId);
        list($contactId2) = $this->createAssociatedContact($this->entity->companyId);

        $response = $this->resource->getAssociatedContacts($this->entity->companyId, ['count' => 1]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertCount(1, $response->contacts);

        $offsetResponse = $this->resource->getAssociatedContacts($this->entity->companyId, ['count' => 1, 'vidOffset' => $contactId]);
        $this->assertEquals(200, $offsetResponse->getStatusCode());
        $this->assertGreaterThanOrEqual($contactId2, $offsetResponse->vidOffset);

        $this->deleteAssociatedContacts($this->entity->companyId, [$contactId, $contactId2]);
    }

    /** @test */
    public function getAssociatedContactIds()
    {
        list($contactId1) = $this->createAssociatedContact($this->entity->companyId);
        list($contactId2) = $this->createAssociatedContact($this->entity->companyId);

        $response = $this->resource->getAssociatedContactIds($this->entity->companyId);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, $response->vids);
        $this->assertContains($contactId1, $response->vids);
        $this->assertContains($contactId2, $response->vids);

        $this->deleteAssociatedContacts($this->entity->companyId, $response->vids);
    }

    /** @test */
    public function getAssociatedContactIdsWithCountAndOffset()
    {
        list($contactId1) = $this->createAssociatedContact($this->entity->companyId);
        list($contactId2) = $this->createAssociatedContact($this->entity->companyId);

        $response = $this->resource->getAssociatedContactIds($this->entity->companyId, ['count' => 1]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertCount(1, $response->vids);

        $offsetResponse = $this->resource->getAssociatedContactIds($this->entity->companyId, ['count' => 1, 'vidOffset' => $contactId1]);
        $this->assertEquals(200, $offsetResponse->getStatusCode());
        $this->assertGreaterThanOrEqual($contactId2, $offsetResponse->vidOffset);

        $this->deleteAssociatedContacts($this->entity->companyId, [$contactId1, $contactId2]);
    }

    /** @test */
    public function removeContact()
    {
        list($contactId) = $this->createAssociatedContact($this->entity->companyId);

        $response = $this->resource->removeContact($contactId, $this->entity->companyId);

        $this->assertEquals(204, $response->getStatusCode());

        $this->contactsResource->delete($contactId);
    }

    /**
     * @test
     */
    public function searchCompanyByDomain()
    {
        $response = $this->resource->searchByDomain('example.com', ['name', 'domain']);
        $this->assertEquals(200, $response->getStatusCode());
        $results = $response->getData()->results;
        $this->assertEquals('example.com', current($results)->properties->domain->value);
    }

    /**
     * Creates a new contact with the HubSpotApi.
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    protected function createContact()
    {
        $response = $this->contactsResource->create([
            ['property' => 'email', 'value' => 'rw_test'.uniqid().'@hubspot.com'],
            ['property' => 'firstname', 'value' => 'joe'],
            ['property' => 'lastname', 'value' => 'user'],
        ]);

        sleep(1);

        return $response;
    }

    /**
     * Creates an associated contact for a new company with the HubSpotApi.
     *
     * @param int $companyId the id of the company where to create the new contact
     *
     * @return array
     */
    protected function createAssociatedContact($companyId)
    {
        $contact = $this->createContact();

        $response = $this->resource->addContact($contact->vid, $companyId);

        sleep(1);

        return [$contact->vid, $response];
    }

    protected function deleteAssociatedContacts($companyId, $contactIds = [])
    {
        foreach ($contactIds as $contactId) {
            $this->resource->removeContact($contactId, $companyId);
            $this->contactsResource->delete($contactId);
        }
    }

    protected function createEntity()
    {
        return $this->resource->create([
            [
                'name' => 'name',
                'value' => 'A company name',
            ],
            [
                'name' => 'description',
                'value' => 'A company description',
            ],
            [
                'name' => 'domain',
                'value' => 'example.com',
            ],
        ]);
    }

    protected function deleteEntity()
    {
        return $this->resource->delete($this->entity->companyId);
    }
}
