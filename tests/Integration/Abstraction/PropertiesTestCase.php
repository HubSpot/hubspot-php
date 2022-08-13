<?php

namespace SevenShores\Hubspot\Tests\Integration\Abstraction;

abstract class PropertiesTestCase extends EntityTestCase
{
    /**
     * @var string
     */
    protected $groupName;

    /** @test */
    public function all()
    {
        $response = $this->endpoint->all();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, count($response->getData()));
    }

    /** @test */
    public function get()
    {
        $response = $this->endpoint->get($this->entity->name);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($this->entity->label, $response->label);
    }

    /** @test */
    public function create()
    {
        $this->assertEquals(200, $this->entity->getStatusCode());
        $this->assertEquals($this->getData()['label'], $this->entity->label);
    }

    /** @test */
    public function update()
    {
        $property = $this->getDataForUpdate();

        $response = $this->endpoint->update($this->entity->name, $property);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($property['label'], $response->label);
    }

    /** @test */
    public function delete()
    {
        $response = $this->deleteEntity();

        $this->assertEquals(204, $response->getStatusCode());

        $this->entity = null;
    }

    /**
     * Creates a new company property.
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    protected function createEntity()
    {
        return $this->endpoint->create($this->getData());
    }

    /**
     * Delete a new company property.
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    protected function deleteEntity()
    {
        return $this->endpoint->delete($this->entity->name);
    }

    protected function getData()
    {
        return [
            'name' => 'property'.uniqid(),
            'label' => 'Custom property',
            'description' => 'An Awesome Custom property',
            'groupName' => $this->groupName,
            'type' => 'string',
            'fieldType' => 'text',
            'formField' => true,
            'displayOrder' => 6,
            'options' => [],
        ];
    }

    protected function getDataForUpdate()
    {
        $data = $this->getData();

        unset($data['name']);
        $data['label'] = 'Updated '.$data['label'];

        return $data;
    }
}
