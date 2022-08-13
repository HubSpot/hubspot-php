<?php

namespace SevenShores\Hubspot\Tests\Integration\Endpoints;

use SevenShores\Hubspot\Endpoints\CompanyProperties;
use SevenShores\Hubspot\Tests\Integration\Abstraction\PropertiesTestCase;

/**
 * @internal
 * @coversNothing
 */
class CompanyPropertiesTest extends PropertiesTestCase
{
    /**
     * @var null|SevenShores\Hubspot\Endpoints\Endpoint
     */
    protected $endpointClass = CompanyProperties::class;

    /**
     * @var string
     */
    protected $groupName = 'companyinformation';
}
