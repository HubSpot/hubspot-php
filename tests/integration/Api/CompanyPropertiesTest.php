<?php


namespace Fungku\HubSpot\Tests\Integration\Api;


use Fungku\HubSpot\Api\CompanyProperties;
use Fungku\HubSpot\Http\Client;

class CompanyPropertiesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CompanyProperties
     */
    private $companyProperties;

    public function setUp()
    {
        parent::setUp();
        $this->companyProperties = new CompanyProperties('demo', new Client());
    }

    /** @test */
    public function create()
    {
        $response = $this->createCompanyProperty();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Custom property', $response['label']);
    }
    
    /** @test */
    public function update()
    {
        $createdPropertyResponse = $this->createCompanyProperty();
        $property = [
            "label" => "Custom property Changed",
            "description" => "An Awesome Custom property that changed",
            "groupName" => "companyinformation",
            "type" => "string",
            "fieldType" => "text",
            "formField" => true,
            "displayOrder" => 6,
            "options" => []
        ];

        $response = $this->companyProperties->update($createdPropertyResponse->name, $property);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Custom property Changed', $response->label);
    }

    /** @test */
    public function delete()
    {
        $createdPropertyResponse = $this->createCompanyProperty();
        $response = $this->companyProperties->delete($createdPropertyResponse->name);

        $this->assertEquals(204, $response->getStatusCode());
    }

    /** @test */
    public function get()
    {
        $createdPropertyResponse = $this->createCompanyProperty();
        $response = $this->companyProperties->get($createdPropertyResponse->name);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Custom property', $response->label);
    }


    /**
     * Creates a new company property
     * @return \Fungku\HubSpot\Http\Response
     */
    private function createCompanyProperty()
    {
        $property = [
            "name" => "t" . uniqid(),
            "label" => "Custom property",
            "description" => "An Awesome Custom property",
            "groupName" => "companyinformation",
            "type" => "string",
            "fieldType" => "text",
            "formField" => true,
            "displayOrder" => 6,
            "options" => []
        ];

        $response = $this->companyProperties->create($property);

        return $response;
    }
}