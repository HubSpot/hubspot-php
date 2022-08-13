<?php

namespace SevenShores\Hubspot\Tests\Integration\Abstraction;

use Exception;
use SevenShores\Hubspot\Endpoints\HubDB;

abstract class HubDBRowTestCase extends EntityTestCase
{
    /**
     * @var null|Timeline
     */
    protected $endpoint;

    /**
     * @var null|Timeline::class
     */
    protected $endpointClass = HubDB::class;

    /**
     * @var string
     */
    protected $portalId;

    public function setUp(): void
    {
        if (empty(getenv('HUBSPOT_TEST_PORTAL_ID'))) {
            throw new Exception('Invalid Portal Id (HUBSPOT_TEST_PORTAL_ID)');
        }
        $this->portalId = getenv('HUBSPOT_TEST_PORTAL_ID');

        parent::setUp();
    }

    protected function createEntity()
    {
        return $this->endpoint->createTable('Test Table'.uniqid(), [
            [
                'name' => 'Name',
                'type' => 'TEXT',
            ],
            [
                'name' => 'Count',
                'type' => 'NUMBER',
            ],
        ]);
    }

    protected function deleteEntity()
    {
        return $this->endpoint->deleteTable($this->entity->id);
    }
}
