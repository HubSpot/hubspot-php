<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\Companies;
use SevenShores\Hubspot\Resources\Contacts;

/**
 * Class CompaniesTest.
 *
 * @group companies
 *
 * @internal
 * @coversNothing
 */
class CompaniesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Companies $companies
     */
    protected $companies;
    
    /**
     * @var Contacts $contacts
     */
    protected $contacts;

    public function setUp()
    {
        parent::setUp();
        $this->companies = new Companies(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        $this->contacts = new Contacts(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        sleep(1);
    }
    
    /** @test */
    public function create()
    {
        $response = $this->createCompany();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('A company name', $response['properties']['name']['value']);
        $this->assertEquals('A company description', $response['properties']['description']['value']);
        $this->assertEquals('example.com', $response['properties']['domain']['value']);
        
        $this->companies->delete($response->companyId);
    }

    /** @test */
    public function update()
    {
        $newCompanyResponse = $this->createCompany();

        $companyDescription = 'A far better description than before';
        $properties = [
            'name' => 'description',
            'value' => $companyDescription,
        ];

        $response = $this->companies->update($newCompanyResponse->companyId, $properties);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($newCompanyResponse->companyId, $response->companyId);
        $this->assertEquals($companyDescription, $response['properties']['description']['value']);
        
        $this->companies->delete($response->companyId);
    }

    /** @test */
    public function updateBatch()
    {
        $newCompanyResponse = $this->createCompany();

        $companyDescription = 'A far better description than before';

        $companies = [
            [
                'objectId' => $newCompanyResponse->companyId,
                'properties' => [
                    [
                        'name' => 'description',
                        'value' => $companyDescription,
                    ],
                ],
            ],
        ];

        $response = $this->companies->updateBatch($companies);

        $this->assertEquals(202, $response->getStatusCode());
        
        $this->companies->delete($newCompanyResponse->companyId);
    }

    /** @test */
    public function delete()
    {
        $newCompanyResponse = $this->createCompany();

        $response = $this->companies->delete($newCompanyResponse->companyId);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($newCompanyResponse->companyId, $response->companyId);
        $this->assertTrue($response['deleted']);
    }

    /** @test */
    public function getAll()
    {
        $response = $this->companies->all();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThan(0, count($response->data->companies));
    }

    /** @test */
    public function getRecentlyModified()
    {
        $response = $this->companies->getRecentlyModified();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThan(2, $response['results']);
    }

    /** @test */
    public function getRecentlyModifiedWithCountAndOffset()
    {
        $params = ['count' => 2, 'offset' => 1];
        $response = $this->companies->getRecentlyModified($params);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertCount(2, $response['results']);
        $this->assertEquals(3, $response['offset']);
    }

    /** @test */
    public function getRecentlyCreated()
    {
        $response = $this->companies->getRecentlyCreated();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThan(2, $response['results']);
    }

    /** @test */
    public function getRecentlyCreatedWithCountAndOffset()
    {
        $params = ['count' => 2, 'offset' => 1];
        $response = $this->companies->getRecentlyCreated($params);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertCount(2, $response['results']);
        $this->assertEquals(3, $response['offset']);
    }

    /** @test */
    public function getById()
    {
        //Ensure that we have a company to fetch
        $newCompanyResponse = $this->createCompany();

        $response = $this->companies->getById($newCompanyResponse->companyId);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($newCompanyResponse->companyId, $response->companyId);
        
        $this->companies->delete($newCompanyResponse->companyId);
    }

    /** @test */
    public function getAssociatedContacts()
    {
        $newCompanyResponse = $this->createCompany();
        list($contactId) = $this->createAssociatedContact($newCompanyResponse->companyId);

        $response = $this->companies->getAssociatedContacts($newCompanyResponse->companyId);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertCount(1, $response['contacts']);
        $this->assertEquals($contactId, $response['contacts'][0]['vid']);
        
        $this->deleteCompanyWithContacts($newCompanyResponse->companyId, [$contactId]);
    }

    /** @test */
    public function getAssociatedContactsWithCountAndOffset()
    {
        $newCompanyResponse = $this->createCompany();
        $companyId = $newCompanyResponse->companyId;
        list($contactId) = $this->createAssociatedContact($companyId);
        list($contactId2) = $this->createAssociatedContact($companyId);

        $response = $this->companies->getAssociatedContacts($companyId, ['count' => 1]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertCount(1, $response->contacts);

        $offsetResponse = $this->companies->getAssociatedContacts($companyId, ['count' => 1, 'vidOffset' => $contactId]);
        $this->assertEquals(200, $offsetResponse->getStatusCode());
        $this->assertGreaterThanOrEqual($contactId2, $offsetResponse->vidOffset);
        
        $this->deleteCompanyWithContacts($companyId, [$contactId, $contactId2]);
    }

    /** @test */
    public function getAssociatedContactIds()
    {
        $newCompanyResponse = $this->createCompany();
        $companyId = $newCompanyResponse['companyId'];
        list($contactId1) = $this->createAssociatedContact($companyId);
        list($contactId2) = $this->createAssociatedContact($companyId);

        $response = $this->companies->getAssociatedContactIds($companyId);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, $response->vids);
        $this->assertContains($contactId1, $response->vids);
        $this->assertContains($contactId2, $response->vids);
        
        $this->deleteCompanyWithContacts($newCompanyResponse->companyId, $response->vids);
    }

    /** @test */
    public function getAssociatedContactIdsWithCountAndOffset()
    {
        $newCompanyResponse = $this->createCompany();
        $companyId = $newCompanyResponse->companyId;
        list($contactId1) = $this->createAssociatedContact($companyId);
        list($contactId2) = $this->createAssociatedContact($companyId);

        $response = $this->companies->getAssociatedContactIds($companyId, ['count' => 1]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertCount(1, $response->vids);
        
        $offsetResponse = $this->companies->getAssociatedContactIds($companyId, ['count' => 1, 'vidOffset' => $contactId1]);
        $this->assertEquals(200, $offsetResponse->getStatusCode());
        $this->assertGreaterThanOrEqual($contactId2, $offsetResponse->vidOffset);
        
        $this->deleteCompanyWithContacts($companyId, [$contactId1, $contactId2]);
    }

    /** @test */
    public function removeContact()
    {
        $newCompanyResponse = $this->createCompany();
        list($contactId) = $this->createAssociatedContact($newCompanyResponse->companyId);

        $response = $this->companies->removeContact($contactId, $newCompanyResponse->companyId);

        $this->assertEquals(204, $response->getStatusCode());
        
        $this->companies->delete($newCompanyResponse->companyId);
        $this->contacts->delete($contactId);
    }

    /**
     * @test
     */
    public function searchCompanyByDomain()
    {
        $newCompanyResponse = $this->createCompany();
        
        $response = $this->companies->searchByDomain('example.com', ['name', 'domain']);
        $this->assertEquals(200, $response->getStatusCode());
        $results = $response->getData()->results;
        $this->assertEquals('example.com', current($results)->properties->domain->value);
        
        $this->companies->delete($newCompanyResponse->companyId);
    }

    /**
     * Creates a Company with the HubSpotApi.
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    protected function createCompany()
    {
        $companyName = 'A company name';
        $companyDescription = 'A company description';
        $properties = [
            [
                'name' => 'name',
                'value' => $companyName,
            ],
            [
                'name' => 'description',
                'value' => $companyDescription,
            ],
            [
                'name' => 'domain',
                'value' => 'example.com',
            ],
        ];

        $response = $this->companies->create($properties);

        sleep(1);

        return $response;
    }

    /**
     * Creates a new contact with the HubSpotApi.
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    protected function createContact()
    {

        $contactResponse = $this->contacts->create([
            ['property' => 'email', 'value' => 'rw_test'.uniqid().'@hubspot.com'],
            ['property' => 'firstname', 'value' => 'joe'],
            ['property' => 'lastname', 'value' => 'user'],
        ]);

        sleep(1);

        return $contactResponse;
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
        $newContactResponse = $this->createContact();
        $contactId = $newContactResponse['vid'];

        $response = $this->companies->addContact($contactId, $companyId);

        sleep(1);

        return [$contactId, $response];
    }
    
    protected function deleteCompanyWithContacts($companyId, $contactIds = []) {
        foreach ($contactIds as $contactId) {
            $this->companies->removeContact($contactId, $companyId);
            $this->contacts->delete($contactId);
        }
        
        $this->companies->delete($companyId);
    }
}
