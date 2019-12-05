<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Resources\ContactProperties;

/**
 * @internal
 * @coversNothing
 */
class ContactPropertiesTest extends Properties
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
