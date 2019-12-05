<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Resources\ContactProperties;

/**
 * @internal
 * @coversNothing
 */
class ContactPropertyGroupsTest extends PropertyGroups
{
    /**
     *
     * @var string
     */
    protected $allGroupsMethod = 'getGroups';
    
    /**
     * @var ContactProperties
     */
    protected $resourceClass = ContactProperties::class;
}
