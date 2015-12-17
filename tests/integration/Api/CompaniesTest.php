<?php


namespace Fungku\HubSpot\Tests\Integration\Api;


use Fungku\HubSpot\Api\Companies;
use Fungku\HubSpot\Api\Contacts;
use Fungku\HubSpot\Http\Client;

class CompaniesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Companies
     */
    private $companies;

    public function setUp()
    {
        parent::setUp();
        $this->companies = new Companies('demo', new Client());
    }

    /** @test */
    public function create()
    {
        $response = $this->createCompany();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('A company name', $response['properties']['name']['value']);
        $this->assertEquals('A company description', $response['properties']['description']['value']);
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
    public function getRecentlyModified()
    {
        $response = $this->companies->getRecentlyModified();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThan(2, $response['results']);
    }

    /** @test */
    public function getRecentlyCreated()
    {
        $response = $this->companies->getRecentlyCreated();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThan(2, $response['results']);
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
         * @var \Fungku\HubSpot\Http\Response $response
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
    public function getAssociatedContactIds()
    {
        $newCompanyResponse = $this->createCompany();
        $companyId = $newCompanyResponse['companyId'];
        list($contactId1) = $this->createAssociatedContact($companyId);
        list($contactId2) = $this->createAssociatedContact($companyId);

        $response = $this->companies->getAssociatedContactIds($companyId);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, $response['vids']);
        // $this->assertContains($contactId1, $response['vids']);
//        $this->assertContains($contactId2, $response['vids']);

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
     * @return \Fungku\HubSpot\Http\Response
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
            ]
        ];

        $response = $this->companies->create($properties);

        return $response;
    }

    /**
     * Creates a new contact with the HubSpotApi
     *
     * @return \Fungku\HubSpot\Http\Response
     */
    private function createContact()
    {
        $contactsClient = new Contacts('demo', new Client());

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
