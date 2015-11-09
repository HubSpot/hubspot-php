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
        $companyName = 'A company name';
        $companyDescription = 'A company description';
        $properties = [
            [
                'name'  => 'name',
                'value' => $companyName
            ],
            [
                'name' => 'description',
                'value' => $companyDescription
            ]
        ];

        $response = $this->companies->create($properties);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($companyName, $response['properties']['name']['value']);
        $this->assertEquals($companyDescription, $response['properties']['description']['value']);
    }
}