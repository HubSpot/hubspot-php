<?php

namespace SevenShores\Hubspot\Tests\Integration;

use SevenShores\Hubspot\Http\Client;

abstract class PropertyGroups extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    protected $allGroupsMethod = 'getAllGroups';

    /**
     * @var null|SevenShores\Hubspot\Resources\Resource
     */
    protected $resource;

    /**
     * @var null|SevenShores\Hubspot\Resources\Resource
     */
    protected $resourceClass;

    /**
     * @var null|\SevenShores\Hubspot\Http\Response
     */
    protected $group;

    public function setUp()
    {
        parent::setUp();
        $this->resource = new $this->resourceClass(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        sleep(1);
        $this->group = $this->createPropertyGroup();
    }

    public function tearDown()
    {
        parent::tearDown();
        if (!empty($this->group)) {
            $this->resource->deleteGroup($this->group->name);
        }
    }

    /** @test */
    public function all()
    {
        $response = $this->resource->{$this->allGroupsMethod}();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, count($response->getData()));
        $this->assertObjectNotHasAttribute('properties', $response->getData()[0]);
    }

    /** @test */
    public function allWithProperties()
    {
        $response = $this->resource->{$this->allGroupsMethod}(true);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, count($response->getData()));
        $this->assertObjectHasAttribute('properties', $response->getData()[0]);
    }

    /** @test */
    public function create()
    {
        $this->assertEquals(200, $this->group->getStatusCode());
        $this->assertEquals('A New Property Group', $this->group->displayName);
    }

    /** @test */
    public function update()
    {
        $group = [
            'displayName' => 'An Updated Property Group',
            'displayOrder' => 7,
        ];

        $response = $this->resource->updateGroup($this->group->name, $group);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('An Updated Property Group', $response->displayName);
    }

    /** @test */
    public function delete()
    {
        $response = $this->resource->deleteGroup($this->group->name);

        $this->assertEquals(204, $response->getStatusCode());

        $this->group = null;
    }

    /**
     * Creates a new contact property group.
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    protected function createPropertyGroup()
    {
        $data = [
            'name' => 'group'.uniqid(),
            'displayName' => 'A New Property Group',
            'displayOrder' => 7,
        ];

        return $this->resource->createGroup($data);
    }
}
