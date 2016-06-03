<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Resources\ContactProperties;
use SevenShores\Hubspot\Http\Client;

class ContactPropertiesTest extends \PHPUnit_Framework_TestCase
{
    private $contactProperties;

    public function setUp()
    {
        parent::setUp();
        $this->contactProperties = new ContactProperties(new Client(['key' => 'demo']));
        sleep(1);
    }

    /*
     * Lots of tests need an existing object to modify.
     */
    private function createProperty()
    {
        sleep(1);

        $response = $this->contactProperties->create([
            "name"         => "t" . uniqid(),
            "label"        => "A New Custom Property",
            "description"  => "A new property for you",
            "groupName"    => "contactinformation",
            "type"         => "string",
            "fieldType"    => "text",
            "formField"    => false,
            "displayOrder" => 6,
            "options"      => [],
        ]);

        $this->assertEquals(200, $response->getStatusCode());

        return $response;
    }

    /** @test */
    public function all()
    {
        $response = $this->contactProperties->all();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, count($response->getData()));
    }

    /** @test */
    public function get()
    {
        $property = $this->createProperty();

        $response = $this->contactProperties->get($property->name);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function update()
    {
        $property = $this->createProperty();

        $response = $this->contactProperties->update($property->name, [
            "label"        => "A New Custom Property",
            "description"  => "A new property for you",
            "groupName"    => "contactinformation",
            "type"         => "string",
            "fieldType"    => "text",
            "formField"    => false,
            "displayOrder" => 1,
            "options"      => [],
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function delete()
    {
        $property = $this->createProperty();

        $response = $this->contactProperties->delete($property->name);

        $this->assertEquals(204, $response->getStatusCode());
    }

    /** @test */
    public function getGroups()
    {
        $response = $this->contactProperties->getGroups(true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, count($response->getData()));
    }

    /** @test */
    public function createGroup_updateGroup_deleteGroup()
    {
        $group = [
            "name"         => "g".uniqid(),
            "displayName"  => "A New Custom Group",
            "displayOrder" => 5,
        ];

        $create = $this->contactProperties->createGroup($group);
        $update = $this->contactProperties->updateGroup($group['name'], ['displayOrder' => 1]);
        $delete = $this->contactProperties->deleteGroup($group['name']);

        $this->assertEquals(200, $create->getStatusCode());
        $this->assertEquals(200, $update->getStatusCode());
        $this->assertEquals(204, $delete->getStatusCode());
    }
}
