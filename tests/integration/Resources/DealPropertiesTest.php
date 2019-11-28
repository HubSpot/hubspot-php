<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\DealProperties;

/**
 * @internal
 * @coversNothing
 */
class DealPropertiesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DealProperties
     */
    private $dealProperties;

    public function setUp()
    {
        parent::setUp();
        $this->dealProperties = new DealProperties(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        sleep(1);
    }
    
    /** @test */
    public function all()
    {
        $response = $this->dealProperties->all();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(2, count($response->getData()));
    }
    
    /** @test */
    public function getByName()
    {
        $response = $this->createDealProperty();
        
        $deal = $this->dealProperties->get($response->name);
        
        $this->assertEquals(200, $deal->getStatusCode());
        $this->assertEquals('Custom property', $deal->label);
        
        $this->dealProperties->delete($deal->name);   
    }

    /** @test */
    public function create()
    {
        $response = $this->createDealProperty();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Custom property', $response->label);
        
        $this->dealProperties->delete($response->name);
    }
    
    /** @test */
    public function update()
    {

        $response = $this->createDealProperty();
        $properties = $this->getData();
        $properties['label'] = 'Updated custom property';
        
        $updateResponse = $this->dealProperties->update($response->name, $properties);
        $this->assertEquals(200, $updateResponse->getStatusCode());
        $this->assertEquals('Updated custom property', $updateResponse->label);
        
        $this->dealProperties->delete($response->name);
    }

    /** @test */
    public function delete()
    {
        $deletedPropertyResponse = $this->createDealProperty();
        $response = $this->dealProperties->delete($deletedPropertyResponse->name);

        $this->assertEquals(204, $response->getStatusCode());
    }

    /** @test */
    public function getAllGroups()
    {
        $response = $this->dealProperties->getAllGroups();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(2, count($response->getData()));
        $this->assertObjectNotHasAttribute('properties', $response->getData()[0]);

        $withPropertiesResponse = $this->dealProperties->getAllGroups(true);
        $this->assertEquals(200, $withPropertiesResponse->getStatusCode());
        $this->assertGreaterThanOrEqual(2, count($withPropertiesResponse->getData()));
        $this->assertObjectHasAttribute('properties', $withPropertiesResponse->getData()[0]);
    }
    
    /** @test */
    public function getGroup()
    {
        $createdGroupResponse = $this->createDealPropertyGroup();
        
        $response = $this->dealProperties->getGroup($createdGroupResponse->name);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('A New Custom Group', $response->displayName);
        $this->assertObjectNotHasAttribute('properties', $response->getData());

        $withPropertiesResponse = $this->dealProperties->getGroup($createdGroupResponse->name, true);
        $this->assertEquals(200, $withPropertiesResponse->getStatusCode());
        $this->assertEquals('A New Custom Group', $withPropertiesResponse->displayName);
        $this->assertObjectHasAttribute('properties', $withPropertiesResponse->getData());
        
        $this->dealProperties->deleteGroup($createdGroupResponse->name);
    }
    
    /** @test */
    public function createGroup()
    {
        $response = $this->createDealPropertyGroup();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('A New Custom Group', $response->displayName);
        
        $this->dealProperties->deleteGroup($response->name);
    }

    /** @test */
    public function updateGroup()
    {
        $createdGroupResponse = $this->createDealPropertyGroup();

        $group = [
            'displayName' => 'An Updated Deal Property Group',
            'displayOrder' => 6,
        ];

        $response = $this->dealProperties->updateGroup($createdGroupResponse->name, $group);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('An Updated Deal Property Group', $response['displayName']);
        
        $this->dealProperties->deleteGroup($createdGroupResponse->name);
    }

    /** @test */
    public function deleteGroup()
    {
        $createdGroupResponse = $this->createDealPropertyGroup();
        $response = $this->dealProperties->deleteGroup($createdGroupResponse->name);

        $this->assertEquals(204, $response->getStatusCode());
    }

    /**
     * Creates a new deal property.
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    protected function createDealProperty()
    {
        $property = $this->getData();
        $property['name'] = 't'.uniqid();

        return $this->dealProperties->create($property);
    }
    
    protected function getData()
    {
        return $property = [
            'label' => 'Custom property',
            'description' => 'An Awesome Custom property',
            'groupName' => 'dealinformation',
            'type' => 'string',
            'fieldType' => 'text',
            'formField' => true,
            'displayOrder' => 6,
            'options' => [],
        ];;
    }

    /**
     * Creates a new deal property group.
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    protected function createDealPropertyGroup()
    {
        $group = [
            'name' => 't'.uniqid(),
            'displayName' => 'A New Custom Group',
            'displayOrder' => 6,
        ];

        return $this->dealProperties->createGroup($group);
    }
}
