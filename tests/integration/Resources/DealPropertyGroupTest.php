<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Resources\DealProperties;
use SevenShores\Hubspot\Tests\Integration\Abstraction\PropertyGroups;

/**
 * @internal
 * @coversNothing
 */
class DealPropertiesGroupTest extends PropertyGroups
{
    /**
     * @var DealProperties
     */
    protected $resourceClass = DealProperties::class;
}
