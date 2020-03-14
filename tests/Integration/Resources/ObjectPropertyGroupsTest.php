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
     * @var bool
     */
    protected $getGroup = true;

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
}
