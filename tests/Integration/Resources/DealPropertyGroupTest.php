<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Resources\DealProperties;
use SevenShores\Hubspot\Tests\Integration\Abstraction\PropertyGroupsTestCase;

/**
 * @internal
 * @coversNothing
 */
class DealPropertiesGroupTest extends PropertyGroupsTestCase
{
    /**
     * @var DealProperties
     */
    protected $resourceClass = DealProperties::class;
}
