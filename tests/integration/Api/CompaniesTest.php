<?php


namespace Fungku\HubSpot\Tests\Integration\Api;


use Fungku\HubSpot\Api\Companies;
use Fungku\HubSpot\Http\Client;

class CompaniesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Companies
     */
    private $companies;

    public function setUp()
    {
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
        //Create a new company
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
        //Create a new company
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
}