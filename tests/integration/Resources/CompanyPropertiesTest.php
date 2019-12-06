<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Resources\CompanyProperties;

/**
 * @internal
 * @coversNothing
 */
class CompanyPropertiesTest extends \SevenShores\Hubspot\Tests\Integration\Abstraction\Properties
{
    /**
     * @var null|SevenShores\Hubspot\Resources\Resource
     */
    protected $resourceClass = CompanyProperties::class;

    /**
     * @var string
     */
    protected $groupName = 'companyinformation';
}
