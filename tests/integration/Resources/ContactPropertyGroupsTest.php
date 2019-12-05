<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\ContactProperties;

/**
 * @internal
 * @coversNothing
 */
class ContactPropertyGroupsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ContactProperties
     */
    protected $contactProperties;

    /**
     * @var null|\SevenShores\Hubspot\Http\Response
     */
    protected $group;

    public function setUp()
    {
        parent::setUp();
        $this->contactProperties = new ContactProperties(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        sleep(1);
        $this->group = $this->createContactPropertyGroup();
    }

    public function tearDown()
    {
        parent::tearDown();
        if (!empty($this->group)) {
            $this->contactProperties->deleteGroup($this->group->name);
        }
    }

    /** @test */
    public function all()
    {
        $response = $this->contactProperties->getGroups();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, count($response->getData()));
        $this->assertObjectNotHasAttribute('properties', $response->getData()[0]);
    }

    /** @test */
    public function allWithProperties()
    {
        $response = $this->contactProperties->getGroups(true);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, count($response->getData()));
        $this->assertObjectHasAttribute('properties', $response->getData()[0]);
    }

    /** @test */
    public function create()
    {
        $this->assertEquals(200, $this->group->getStatusCode());
        $this->assertEquals('A New Contact Property Group', $this->group->displayName);
    }

    /** @test */
    public function update()
    {
        $group = [
            'displayName' => 'An Updated Contact Property Group',
            'displayOrder' => 7,
        ];

        $response = $this->contactProperties->updateGroup($this->group->name, $group);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('An Updated Contact Property Group', $response->displayName);
    }

    /** @test */
    public function delete()
    {
        $response = $this->contactProperties->deleteGroup($this->group->name);

        $this->assertEquals(204, $response->getStatusCode());

        $this->group = null;
    }

    /**
     * Creates a new contact property group.
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    protected function createContactPropertyGroup()
    {
        $data = [
            'name' => 'group'.uniqid(),
            'displayName' => 'A New Contact Property Group',
            'displayOrder' => 5,
        ];

        return $this->contactProperties->createGroup($data);
    }
}
