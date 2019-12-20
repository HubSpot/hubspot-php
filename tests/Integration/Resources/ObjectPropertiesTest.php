<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Tests\Integration\Abstraction\PropertiesTestCase;
use SevenShores\Hubspot\Factory;

/**
 * @internal
 * @coversNothing
 */
class ObjectPropertiesTest extends PropertiesTestCase
{
    /**
     * @var string
     */
    protected $groupName = 'productinformation';
    
    public function setUp()
    {
        $this->resource = Factory::create(getenv('HUBSPOT_TEST_API_KEY'))->objectProperties('products');
        sleep(1);
        $this->entity = $this->createEntity();
    }
}
