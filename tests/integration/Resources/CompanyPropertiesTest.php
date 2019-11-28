<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\CompanyProperties;

/**
 * @internal
 * @coversNothing
 */
class CompanyPropertiesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CompanyProperties
     */
    private $companyProperties;

    public function setUp()
    {
        parent::setUp();
        $this->companyProperties = new CompanyProperties(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        sleep(1);
    }

    /** @test */
    public function all()
    {
        $response = $this->companyProperties->all();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(2, count($response->getData()));
    }
    
    /** @test */
    public function get()
    {
        $createdPropertyResponse = $this->createCompanyProperty();
        $response = $this->companyProperties->get($createdPropertyResponse->name);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Custom property', $response->label);
        
        $this->companyProperties->delete($createdPropertyResponse->name);
    }

    /** @test */
    public function create()
    {
        $response = $this->createCompanyProperty();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Custom property', $response->label);
        
        $this->companyProperties->delete($response->name);
    }

    /** @test */
    public function update()
    {
        $createdPropertyResponse = $this->createCompanyProperty();
        $property = [
            'label' => 'Custom property Changed',
            'description' => 'An Awesome Custom property that changed',
            'groupName' => 'companyinformation',
            'type' => 'string',
            'fieldType' => 'text',
            'formField' => true,
            'displayOrder' => 6,
            'options' => [],
        ];

        $response = $this->companyProperties->update($createdPropertyResponse->name, $property);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Custom property Changed', $response->label);
        
        $this->companyProperties->delete($createdPropertyResponse->name);
    }

    /** @test */
    public function delete()
    {
        $createdPropertyResponse = $this->createCompanyProperty();
        $response = $this->companyProperties->delete($createdPropertyResponse->name);

        $this->assertEquals(204, $response->getStatusCode());
    }
    
     /** @test */
    public function getAllGroups()
    {
        $response = $this->companyProperties->getAllGroups();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(2, count($response->getData()));
        $this->assertObjectNotHasAttribute('properties', $response->getData()[0]);

        $includedPropertiesResponse = $this->companyProperties->getAllGroups(true);
        $this->assertEquals(200, $includedPropertiesResponse->getStatusCode());
        $this->assertGreaterThanOrEqual(2, count($includedPropertiesResponse->getData()));
        $this->assertObjectHasAttribute('properties', $includedPropertiesResponse->getData()[0]);
    }

    /** @test */
    public function createGroup()
    {
        $response = $this->createCompanyPropertyGroup();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('A New Custom Group', $response->displayName);
        
        $this->companyProperties->deleteGroup($response->name);
    }

    /** @test */
    public function updateGroup()
    {
        $createdGroupResponse = $this->createCompanyPropertyGroup();

        $group = [
            'displayName' => 'An Updated Company Property Group',
            'displayOrder' => 6,
        ];

        $response = $this->companyProperties->updateGroup($createdGroupResponse->name, $group);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('An Updated Company Property Group', $response->displayName);
        
        $this->companyProperties->deleteGroup($createdGroupResponse->name);
    }

    /** @test */
    public function deleteGroup()
    {
        $createdGroupResponse = $this->createCompanyPropertyGroup();
        $response = $this->companyProperties->deleteGroup($createdGroupResponse->name);

        $this->assertEquals(204, $response->getStatusCode());
    }

    /**
     * Creates a new company property.
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    private function createCompanyProperty()
    {
        $property = [
            'name' => 't'.uniqid(),
            'label' => 'Custom property',
            'description' => 'An Awesome Custom property',
            'groupName' => 'companyinformation',
            'type' => 'string',
            'fieldType' => 'text',
            'formField' => true,
            'displayOrder' => 6,
            'options' => [],
        ];

        return $this->companyProperties->create($property);
    }

    /**
     * Creates a new company property group.
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    private function createCompanyPropertyGroup()
    {
        $group = [
            'name' => 't'.uniqid(),
            'displayName' => 'A New Custom Group',
            'displayOrder' => 6,
        ];

        return $this->companyProperties->createGroup($group);
    }
}
