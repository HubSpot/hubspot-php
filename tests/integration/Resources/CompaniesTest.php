<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Resources\Companies;
use SevenShores\Hubspot\Resources\Contacts;
use SevenShores\Hubspot\Http\Client;

/**
 * Class CompaniesTest
 * @package SevenShores\Hubspot\Tests\Integration\Resources
 * @group companies
 */
class CompaniesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Companies
     */
    private $companies;

    public function setUp()
    {
        parent::setUp();
        $this->companies = new Companies(new Client(['key' => 'demo']));
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
    }

    /** @test */
    public function update()
    {
        $newCompanyResponse = $this->createCompany();

        $id = $newCompanyResponse['companyId'];
        $companyDescription = 'A far better description than before';
        $properties = [
            'name' => 'description',
            'value' => $companyDescription
        ];

        $response = $this->companies->update($id, $properties);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($id, $response['companyId']);
        $this->assertEquals($companyDescription, $response['properties']['description']['value']);
    }

    /** @test */
    public function delete()
    {
        $newCompanyResponse = $this->createCompany();
        $id = $newCompanyResponse['companyId'];

        $response = $this->companies->delete($id);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($id, $response['companyId']);
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
    public function getByDomain()
    {
        $domain = 'example.com';
        $response = $this->companies->getByDomain($domain);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($domain, $response[0]['properties']['domain']['value']);
    }

    /** @test */
    public function getById()
    {
        //Ensure that we have a company to fetch
        $newCompanyResponse = $this->createCompany();
        $id = $newCompanyResponse['companyId'];

        $response = $this->companies->getById($id);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($id, $response['companyId']);
    }

    /** @test */
    public function addContact()
    {
        //Ensure a new company
        $newCompanyResponse = $this->createCompany();
        $companyId = $newCompanyResponse['companyId'];

        /**
         * @var \SevenShores\Hubspot\Http\Response $response
         */
        list($contactId, $response) = $this->createAssociatedContact($companyId);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($companyId, $response['companyId']);
    }

    /** @test */
    public function getAssociatedContacts()
    {
        $newCompanyResponse = $this->createCompany();
        $companyId = $newCompanyResponse['companyId'];
        list($contactId) = $this->createAssociatedContact($companyId);

        $response = $this->companies->getAssociatedContacts($companyId);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertCount(1, $response['contacts']);
        $this->assertEquals($contactId, $response['contacts'][0]['vid']);
    }

    /** @test */
    public function getAssociatedContactsWithCountAndOffset()
    {
        $newCompanyResponse = $this->createCompany();
        $companyId = $newCompanyResponse['companyId'];
        list($contactId) = $this->createAssociatedContact($companyId);
        list($contactId2) = $this->createAssociatedContact($companyId);

        $response = $this->companies->getAssociatedContacts($companyId, ['count' => 1, 'vidOffset' => $contactId ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertCount(1, $response['contacts']);

        $offsetResponse = $this->companies->getAssociatedContacts($companyId, ['count' => 1, 'vidOffset' => $contactId2 + 1 ]);
        $this->assertEquals(200, $offsetResponse->getStatusCode());
        $this->assertGreaterThanOrEqual($contactId2 + 1, $offsetResponse['vidOffset']);
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
        $this->assertGreaterThanOrEqual(1, $response['vids']);
        $this->assertContains($contactId1, $response['vids']);
        $this->assertContains($contactId2, $response['vids']);

    }

    /** @test */
    public function getAssociatedContactIdsWithCountAndOffset()
    {
        $newCompanyResponse = $this->createCompany();
        $companyId = $newCompanyResponse['companyId'];
        list($contactId1) = $this->createAssociatedContact($companyId);
        list($contactId2) = $this->createAssociatedContact($companyId);

        $response = $this->companies->getAssociatedContactIds($companyId, ['count' => 1]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertCount(1, $response['vids']);

        $offsetResponse = $this->companies->getAssociatedContactIds($companyId, ['count' => 1, 'vidOffset' => $contactId2 + 1]);
        $this->assertEquals(200, $offsetResponse->getStatusCode());
        $this->assertGreaterThanOrEqual($contactId2 + 1, $offsetResponse['vidOffset']);
    }

    /** @test */
    public function removeContact()
    {
        $newCompanyResponse = $this->createCompany();
        $companyId = $newCompanyResponse['companyId'];
        list($contactId) = $this->createAssociatedContact($companyId);

        $response = $this->companies->removeContact($contactId, $companyId);

        $this->assertEquals(204, $response->getStatusCode());
    }

    /**
     * Creates a Company with the HubSpotApi
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    private function createCompany()
    {
        $companyName = 'A company name';
        $companyDescription = 'A company description';
        $properties = [
            [
                'name' => 'name',
                'value' => $companyName
            ],
            [
                'name' => 'description',
                'value' => $companyDescription
            ],
            [
                'name' => 'domain',
                'value' => 'example.com'
            ],
        ];

        $response = $this->companies->create($properties);

        sleep(1);

        return $response;
    }

    /**
     * Creates a new contact with the HubSpotApi
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    private function createContact()
    {
        $contactsClient = new Contacts(new Client(['key' => 'demo']));

        $contactResponse = $contactsClient->create([
            ['property' => 'email', 'value' => 'rw_test' . uniqid() . '@hubspot.com'],
            ['property' => 'firstname', 'value' => 'joe'],
            ['property' => 'lastname', 'value' => 'user'],
        ]);

        sleep(1);

        return $contactResponse;
    }

    /**
     * Creates an associated contact for a new company with the HubSpotApi
     *
     * @param int $companyId The id of the company where to create the new contact.
     *
     * @return array
     */
    private function createAssociatedContact($companyId)
    {
        $newContactResponse = $this->createContact();
        $contactId = $newContactResponse['vid'];

        $response = $this->companies->addContact($contactId, $companyId);

        sleep(1);

        return [$contactId, $response];
    }

}
