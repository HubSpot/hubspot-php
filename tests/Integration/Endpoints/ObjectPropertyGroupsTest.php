<?php

namespace SevenShores\Hubspot\Tests\Integration\Endpoints;

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

    public function setUp(): void
    {
        $this->endpoint = Factory::create(getenv('HUBSPOT_TEST_API_KEY'))->objectProperties('products');
        sleep(1);
        $this->entity = $this->createEntity();
    }
}
