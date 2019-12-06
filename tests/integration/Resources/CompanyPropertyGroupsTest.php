<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Resources\CompanyProperties;
use SevenShores\Hubspot\Tests\Integration\PropertyGroups;

/**
 * @internal
 * @coversNothing
 */
class CompanyPropertyGroupsTest extends PropertyGroups
{
    /**
     * @var DealProperties
     */
    protected $resourceClass = CompanyProperties::class;
}
