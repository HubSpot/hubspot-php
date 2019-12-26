<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Factory;
use SevenShores\Hubspot\Tests\Integration\Abstraction\PropertyGroupsTestCase;

/**
 * @internal
 * @coversNothing
 */
class ObjectPropertyGroupsTest extends PropertyGroupsTestCase
{
    /**
     * @var string
     */
    protected $allGroupsMethod = 'getGroups';

    public function setUp()
    {
        $this->resource = Factory::create(getenv('HUBSPOT_TEST_API_KEY'))->objectProperties('products');
        sleep(1);
        $this->entity = $this->createEntity();
    }

    /** @test */
    public function get()
    {
        $response = $this->resource->getGroup($this->entity->name);

        $this->assertEquals(200, $response->getStatusCode());
    }
}
