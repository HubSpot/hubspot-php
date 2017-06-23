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
}
