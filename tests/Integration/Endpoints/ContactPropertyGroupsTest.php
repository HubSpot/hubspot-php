<?php

namespace SevenShores\Hubspot\Tests\Integration\Endpoints;

use SevenShores\Hubspot\Endpoints\ContactProperties;
use SevenShores\Hubspot\Tests\Integration\Abstraction\PropertyGroupsTestCase;

/**
 * @internal
 * @coversNothing
 */
class ContactPropertyGroupsTest extends PropertyGroupsTestCase
{
    /**
     * @var bool
     */
    protected $getGroup = true;

    /**
     * @var ContactProperties
     */
    protected $endpointClass = ContactProperties::class;
}
