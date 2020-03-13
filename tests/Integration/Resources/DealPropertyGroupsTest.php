<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Resources\DealProperties;
use SevenShores\Hubspot\Tests\Integration\Abstraction\PropertyGroupsTestCase;

/**
 * @internal
 * @coversNothing
 */
class DealPropertyGroupsTest extends PropertyGroupsTestCase
{
    /**
     * @var bool
     */
    protected $getGroup = true;

    /**
     * @var DealProperties
     */
    protected $resourceClass = DealProperties::class;
}
