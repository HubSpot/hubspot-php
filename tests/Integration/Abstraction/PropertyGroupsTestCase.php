<?php

namespace SevenShores\Hubspot\Tests\Integration\Abstraction;

abstract class PropertyGroupsTestCase extends EntityTestCase
{
    /**
     * @var string
     */
    protected $allGroupsMethod = 'getAllGroups';

    /**
     * @var bool
     */
    protected $getGroup = false;

    /** @test */
    public function all()
    {
        $response = $this->resource->{$this->allGroupsMethod}();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, \count($response->getData()));
        $this->assertObjectNotHasAttribute('properties', $response->getData()[0]);
    }

    /** @test */
    public function allWithProperties()
    {
        $response = $this->resource->{$this->allGroupsMethod}(true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, \count($response->getData()));
        $this->assertObjectHasAttribute('properties', $response->getData()[0]);
    }

    /** @test */
    public function getGroup()
    {
        if (!$this->getGroup) {
            return true;
        }
        $response = $this->resource->getGroup($this->entity->name);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function create()
    {
        $this->assertEquals(200, $this->entity->getStatusCode());
        $this->assertEquals('A New Property Group', $this->entity->displayName);
    }

    /** @test */
    public function update()
    {
        $group = [
            'displayName' => 'An Updated Property Group',
            'displayOrder' => 7,
        ];

        $response = $this->resource->updateGroup($this->entity->name, $group);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('An Updated Property Group', $response->displayName);
    }

    /** @test */
    public function delete()
    {
        $response = $this->resource->deleteGroup($this->entity->name);

        $this->assertEquals(204, $response->getStatusCode());

        $this->entity = null;
    }

    /**
     * Delete a new property group.
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    protected function deleteEntity()
    {
        return $this->resource->deleteGroup($this->entity->name);
    }

    /**
     * Creates a new property group.
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    protected function createEntity()
    {
        $data = [
            'name' => 'group'.uniqid(),
            'displayName' => 'A New Property Group',
            'displayOrder' => 7,
        ];

        return $this->resource->createGroup($data);
    }
}
