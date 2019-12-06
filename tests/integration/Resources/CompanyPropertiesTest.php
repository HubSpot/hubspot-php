<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Resources\CompanyProperties;
use SevenShores\Hubspot\Tests\Integration\Abstraction\PropertyGroups;

/**
 * @internal
 * @coversNothing
 */
class CompanyPropertiesTest extends PropertyGroups
{
    /**
     * @var null|SevenShores\Hubspot\Resources\Resource
     */
    protected $resourceClass = CompanyProperties::class;

    /**
     * @var string
     */
    //protected $groupName = 'companyinformation';
}
