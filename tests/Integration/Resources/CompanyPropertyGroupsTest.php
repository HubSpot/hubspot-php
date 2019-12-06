<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Resources\CompanyProperties;
use SevenShores\Hubspot\Tests\Integration\Abstraction\PropertyGroupsTestCase;

/**
 * @internal
 * @coversNothing
 */
class CompanyPropertyGroupsTest extends PropertyGroupsTestCase
{
    /**
     * @var CompanyProperties
     */
    protected $resourceClass = CompanyProperties::class;
}
