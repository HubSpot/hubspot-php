<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Resources\ContactProperties;
use SevenShores\Hubspot\Tests\Integration\Abstraction\PropertiesTestCase;

/**
 * @internal
 * @coversNothing
 */
class ContactPropertiesTest extends PropertiesTestCase
{
    /**
     * @var null|SevenShores\Hubspot\Resources\Resource
     */
    protected $resourceClass = ContactProperties::class;

    /**
     * @var string
     */
    protected $groupName = 'contactinformation';
}
