<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Resources\DealProperties;
use SevenShores\Hubspot\Tests\Integration\Abstraction\Properties;

/**
 * @internal
 * @coversNothing
 */
class DealPropertiesTest extends Properties
{
    /**
     * @var null|SevenShores\Hubspot\Resources\Resource
     */
    protected $resourceClass = DealProperties::class;

    /**
     * @var string
     */
    protected $groupName = 'dealinformation';
}
