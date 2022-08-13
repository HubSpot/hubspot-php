<?php

namespace SevenShores\Hubspot\Tests\Integration\Endpoints;

use SevenShores\Hubspot\Endpoints\CompanyProperties;
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
    protected $endpointClass = CompanyProperties::class;
}
