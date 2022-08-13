<?php

namespace SevenShores\Hubspot\Tests\Integration\Abstraction;

use Exception;
use SevenShores\Hubspot\Endpoints\ContactLists;

abstract class ContactListsTestCase extends EntityTestCase
{
    /**
     * @var ContactLists
     */
    protected $endpoint;

    /**
     * @var ContactLists::class
     */
    protected $endpointClass = ContactLists::class;

    /**
     * @var bool
     */
    protected $dynamic = true;

    public function setUp(): void
    {
        if (empty(getenv('HUBSPOT_TEST_PORTAL_ID'))) {
            throw new Exception('Invalid Portal Id (HUBSPOT_TEST_PORTAL_ID)');
        }

        parent::setUp();
    }

    protected function createEntity()
    {
        return $this->endpoint->create(
            [
                'name' => 'Test '.uniqid(),
                'dynamic' => $this->dynamic,
                'portalId' => getenv('HUBSPOT_TEST_PORTAL_ID'),
                'filters' => [
                    [
                        [
                            'operator' => 'EQ',
                            'value' => '@hubspot',
                            'property' => 'twitterhandle',
                            'type' => 'string',
                        ],
                    ],
                ],
            ]
        );
    }

    protected function deleteEntity()
    {
        return $this->endpoint->delete($this->entity->listId);
    }
}
