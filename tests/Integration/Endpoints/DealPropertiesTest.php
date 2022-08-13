<?php

namespace SevenShores\Hubspot\Tests\Integration\Endpoints;

use SevenShores\Hubspot\Endpoints\DealProperties;
use SevenShores\Hubspot\Tests\Integration\Abstraction\PropertiesTestCase;

/**
 * @internal
 * @coversNothing
 */
class DealPropertiesTest extends PropertiesTestCase
{
    /**
     * @var null|SevenShores\Hubspot\Endpoints\Endpoint
     */
    protected $endpointClass = DealProperties::class;

    /**
     * @var string
     */
    protected $groupName = 'dealinformation';
}
