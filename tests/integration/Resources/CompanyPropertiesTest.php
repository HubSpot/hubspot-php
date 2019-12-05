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
    protected $companyProperties;

    /**
     * @var null|\SevenShores\Hubspot\Http\Response
     */
    protected $property;

    public function setUp()
    {
        parent::setUp();
        $this->companyProperties = new CompanyProperties(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        sleep(1);
        $this->property = $this->createCompanyProperty();
    }

    public function tearDown()
    {
        parent::tearDown();
        if (!empty($this->property)) {
            $this->companyProperties->delete($this->property->name);
        }
    }

    /** @test */
    public function all()
    {
        $response = $this->companyProperties->all();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, count($response->getData()));
    }

    /** @test */
    public function get()
    {
        $response = $this->companyProperties->get($this->property->name);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($this->property->label, $response->label);
    }

    /** @test */
    public function create()
    {
        $this->assertEquals(200, $this->property->getStatusCode());
        $this->assertEquals('Custom property', $this->property->label);
    }

    /** @test */
    public function update()
    {
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

        $response = $this->companyProperties->update($this->property->name, $property);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Custom property Changed', $response->label);
    }

    /** @test */
    public function delete()
    {
        $response = $this->companyProperties->delete($this->property->name);

        $this->assertEquals(204, $response->getStatusCode());

        $this->property = null;
    }

    /**
     * Creates a new company property.
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    protected function createCompanyProperty()
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
}
