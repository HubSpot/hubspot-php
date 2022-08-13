<?php

namespace SevenShores\Hubspot\Tests\Integration\Endpoints;

use SevenShores\Hubspot\Endpoints\ContactProperties;
use SevenShores\Hubspot\Tests\Integration\Abstraction\PropertiesTestCase;

/**
 * @internal
 * @coversNothing
 */
class ContactPropertiesTest extends PropertiesTestCase
{
    /**
     * @var null|SevenShores\Hubspot\Endpoints\Endpoint
     */
    protected $endpointClass = ContactProperties::class;

    /**
     * @var string
     */
    protected $groupName = 'contactinformation';
}
