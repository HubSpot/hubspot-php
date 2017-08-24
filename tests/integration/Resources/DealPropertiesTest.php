<?php


namespace SevenShores\Hubspot\Tests\Integration\Resources;


use SevenShores\Hubspot\Resources\DealProperties;
use SevenShores\Hubspot\Http\Client;

class DealPropertiesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DealProperties
     */
    private $dealProperties;

    public function setUp()
    {
        parent::setUp();
        $this->dealProperties = new DealProperties(new Client(['key' => 'demo']));
        sleep(1);
    }

    /** @test */
    public function create()
    {
        sleep(1);

        $response = $this->createDealProperty();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Custom property', $response['label']);
    }

    /**
     * Creates a new deal property
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    private function createDealProperty()
    {
        $property = [
            "name" => "t" . uniqid(),
            "label" => "Custom property",
            "description" => "An Awesome Custom property",
            "groupName" => "dealinformation",
            "type" => "string",
            "fieldType" => "text",
            "formField" => true,
            "displayOrder" => 6,
            "options" => []
        ];

        $response = $this->dealProperties->create($property);

        return $response;
    }

    /**
     * Creates a new deal property group.
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    private function createDealPropertyGroup()
    {
        $group = [
            "name" => "t" . uniqid(),
            "displayName" => "A New Custom Group",
            "displayOrder" => 6,
        ];

        $response = $this->dealProperties->createGroup($group);

        return $response;
    }

    /** @test */
    public function delete()
    {
        $deletedPropertyResponse = $this->createDealProperty();
        $response = $this->dealProperties->delete($deletedPropertyResponse->name);

        $this->assertEquals(204, $response->getStatusCode());
    }

    /** @test */
    public function all()
    {
        $response = $this->dealProperties->all();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(2, count($response->getData()));
    }

    /** @test */
    public function createGroup()
    {
        $response = $this->createDealPropertyGroup();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('A New Custom Group', $response['displayName']);
    }

    /** @test */
    public function updateGroup()
    {
        $createdGroupResponse = $this->createDealPropertyGroup();

        $group = [
            "displayName" => "An Updated Deal Property Group",
            "displayOrder" => 6,
        ];

        $response = $this->dealProperties->updateGroup($createdGroupResponse->name, $group);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('An Updated Deal Property Group', $response['displayName']);
    }

    /** @test */
    public function deleteGroup()
    {
        $createdGroupResponse = $this->createDealPropertyGroup();
        $response = $this->dealProperties->deleteGroup($createdGroupResponse->name);

        $this->assertEquals(204, $response->getStatusCode());
    }

    /** @test */
    public function getGroup()
    {
        $createdGroupResponse = $this->createDealPropertyGroup();
        $response = $this->dealProperties->getGroup($createdGroupResponse->name);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('A New Custom Group', $response['displayName']);
        $this->assertObjectNotHasAttribute('properties', $response->getData());

        $response = $this->dealProperties->getGroup($createdGroupResponse->name, true);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('A New Custom Group', $response['displayName']);
        $this->assertObjectHasAttribute('properties', $response->getData());
    }

    /** @test */
    public function getAllGroups()
    {
        $response = $this->dealProperties->getAllGroups();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(2, count($response->getData()));
        $this->assertObjectNotHasAttribute('properties', $response->getData()[0]);

        $response = $this->dealProperties->getAllGroups(true);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(2, count($response->getData()));
        $this->assertObjectHasAttribute('properties', $response->getData()[0]);
    }
}
