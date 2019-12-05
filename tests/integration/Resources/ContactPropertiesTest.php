<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\ContactProperties;

/**
 * @internal
 * @coversNothing
 */
class ContactPropertiesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ContactProperties
     */
    protected $contactProperties;

    /**
     * @var null|\SevenShores\Hubspot\Http\Response
     */
    protected $property;

    public function setUp()
    {
        parent::setUp();
        $this->contactProperties = new ContactProperties(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        sleep(1);
        $this->property = $this->createProperty();
        sleep(1);
    }

    public function tearDown()
    {
        parent::tearDown();
        if (!empty($this->property)) {
            $this->contactProperties->delete($this->property->name);
        }
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
        $response = $this->contactProperties->get($this->property->name);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function create()
    {
        $this->assertEquals(200, $this->property->getStatusCode());
    }

    /** @test */
    public function update()
    {
        $response = $this->contactProperties->update($this->property->name, [
            'label' => 'A New Custom Property',
            'description' => 'A new property for you',
            'groupName' => 'contactinformation',
            'type' => 'string',
            'fieldType' => 'text',
            'formField' => false,
            'displayOrder' => 1,
            'options' => [],
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function delete()
    {
        $response = $this->contactProperties->delete($this->property->name);

        $this->assertEquals(204, $response->getStatusCode());

        $this->property = null;
    }

    // Lots of tests need an existing object to modify.
    protected function createProperty()
    {
        return $this->contactProperties->create([
            'name' => 't'.uniqid(),
            'label' => 'A New Custom Property',
            'description' => 'A new property for you',
            'groupName' => 'contactinformation',
            'type' => 'string',
            'fieldType' => 'text',
            'formField' => false,
            'displayOrder' => 6,
            'options' => [],
        ]);
    }
}
