<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Http\Client;

abstract class Properties extends \PHPUnit_Framework_TestCase
{
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
    protected $property;

    /**
     * @var string
     */
    protected $groupName;

    public function setUp()
    {
        parent::setUp();
        $this->resource = new $this->resourceClass(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        sleep(1);
        $this->property = $this->createProperty();
    }

    public function tearDown()
    {
        parent::tearDown();
        if (!empty($this->property)) {
            $this->resource->delete($this->property->name);
        }
    }

    /** @test */
    public function all()
    {
        $response = $this->resource->all();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, count($response->getData()));
    }

    /** @test */
    public function get()
    {
        $response = $this->resource->get($this->property->name);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($this->property->label, $response->label);
    }

    /** @test */
    public function create()
    {
        $this->assertEquals(200, $this->property->getStatusCode());
        $this->assertEquals($this->getData()['label'], $this->property->label);
    }

    /** @test */
    public function update()
    {
        $property = $this->getDataForUpdate();

        $response = $this->resource->update($this->property->name, $property);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($property['label'], $response->label);
    }

    /** @test */
    public function delete()
    {
        $response = $this->resource->delete($this->property->name);

        $this->assertEquals(204, $response->getStatusCode());

        $this->property = null;
    }

    /**
     * Creates a new company property.
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    protected function createProperty()
    {
        return $this->resource->create($this->getData());
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
