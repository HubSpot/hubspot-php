<?php

namespace SevenShores\Hubspot\Tests\Integration\Endpoints;

use SevenShores\Hubspot\Endpoints\Contacts;
use SevenShores\Hubspot\Tests\Integration\Abstraction\EntityTestCase;

/**
 * @internal
 * @coversNothing
 */
class ContactsTest extends EntityTestCase
{
    /**
     * @var SevenShores\Hubspot\Endpoints\Contacts
     */
    protected $endpoint;

    /**
     * @var SevenShores\Hubspot\Endpoints\Contacts::class
     */
    protected $endpointClass = Contacts::class;

    /** @test */
    public function allWithNoParams()
    {
        $response = $this->endpoint->all();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, count($response->contacts));
    }

    /** @test */
    public function allWithParams()
    {
        $response = $this->endpoint->all([
            'property' => ['firstname', 'lastname'],
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, count($response->contacts));
    }

    /** @test */
    public function allWithParamsAndArrayAccess()
    {
        $response = $this->endpoint->all([
            'property' => ['firstname', 'lastname'],
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, count($response->contacts));
    }

    /** @test */
    public function create()
    {
        $this->assertEquals(200, $this->entity->getStatusCode());
    }

    /** @test */
    public function update()
    {
        $response = $this->endpoint->update($this->entity->vid, [
            ['property' => 'firstname', 'value' => 'joe'],
            ['property' => 'lastname', 'value' => 'user'],
        ]);

        $this->assertEquals(204, $response->getStatusCode());
    }

    /** @test */
    public function updateByEmail()
    {
        $response = $this->endpoint->updateByEmail($this->entity->properties->email->value, [
            ['property' => 'firstname', 'value' => 'joe'],
            ['property' => 'lastname', 'value' => 'user'],
        ]);

        $this->assertEquals(204, $response->getStatusCode());
    }

    /** @test */
    public function createOrUpdate()
    {
        sleep(2);
        $response = $this->endpoint->createOrUpdate($this->entity->properties->email->value, [
            ['property' => 'firstname', 'value' => 'joe'],
            ['property' => 'lastname', 'value' => 'user'],
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function createOrUpdateBatch()
    {
        $secondEmail = 'test2@hubspot.com';
        $response = $this->endpoint->createOrUpdateBatch([
            [
                'email' => $this->entity->properties->email->value,
                'properties' => [
                    ['property' => 'firstname', 'value' => 'joe'],
                    ['property' => 'lastname', 'value' => 'user'],
                ],
            ],
            [
                'email' => $secondEmail,
                'properties' => [
                    ['property' => 'firstname', 'value' => 'jane'],
                    ['property' => 'lastname', 'value' => 'user'],
                ],
            ],
        ]);
        $this->assertEquals(202, $response->getStatusCode());

        sleep(1);
        $contact = $this->endpoint->getByEmail($secondEmail)->getData();
        $this->endpoint->delete($contact->vid);
    }

    /** @test */
    public function createOrUpdateBatchWithAuditId()
    {
        $emails = ['testWithAuditId3@hubspot.com', 'testWithAuditId4@hubspot.com'];
        $response = $this->endpoint->createOrUpdateBatch([
            [
                'email' => $emails[0],
                'properties' => [
                    ['property' => 'firstname', 'value' => 'joe'],
                    ['property' => 'lastname', 'value' => 'user'],
                ],
            ],
            [
                'email' => $emails[1],
                'properties' => [
                    ['property' => 'firstname', 'value' => 'jane'],
                    ['property' => 'lastname', 'value' => 'user'],
                ],
            ],
        ], ['auditId' => 'TEST_CHANGE_SOURCE']);
        $this->assertEquals(202, $response->getStatusCode());

        foreach ($this->endpoint->getBatchByEmails($emails)->getData() as $contact) {
            $this->endpoint->delete($contact->vid);
        }
    }

    /** @test */
    public function delete()
    {
        $response = $this->deleteEntity();

        $this->assertEquals(200, $response->getStatusCode());

        $this->entity = null;
    }

    /** @test */
    public function recent()
    {
        $response = $this->endpoint->recent(['count' => 2]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getById()
    {
        $response = $this->endpoint->getById($this->entity->vid);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getBatchByIds()
    {
        $contact = $this->createEntity();

        $ids = [
            $this->entity->vid,
            $contact->vid,
        ];

        $response = $this->endpoint->getBatchByIds($ids);

        $this->assertEquals(200, $response->getStatusCode());

        $this->endpoint->delete($contact->vid);
    }

    /** @test */
    public function getByEmail()
    {
        $response = $this->endpoint->getByEmail($this->entity->properties->email->value);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getBatchByEmails()
    {
        $contact = $this->createEntity();

        $emails = [
            $this->entity->properties->email->value,
            $contact->properties->email->value,
        ];

        $response = $this->endpoint->getBatchByEmails($emails);

        $this->assertEquals(200, $response->getStatusCode());

        $this->endpoint->delete($contact->vid);
    }

    /** @test */
    public function search()
    {
        $response = $this->endpoint->search('hub', ['count' => 2]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function statistics()
    {
        $response = $this->endpoint->statistics();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function addSecondaryEmail()
    {
        $secondaryEmail = 'rw_test'.uniqid().'@hubspot.com';

        $response = $this->endpoint->addSecondaryEmail($this->entity->vid, $secondaryEmail);
        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function deleteSecondaryEmail()
    {
        $secondaryEmail = 'rw_test'.uniqid().'@hubspot.com';

        $response = $this->endpoint->addSecondaryEmail($this->entity->vid, $secondaryEmail);
        $this->assertEquals(200, $response->getStatusCode());

        sleep(1);

        $response = $this->endpoint->deleteSecondaryEmail($this->entity->vid, $secondaryEmail);
        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getLifecycleStageMetrics()
    {
        $response = $this->endpoint->getLifecycleStageMetrics();

        $this->assertEquals(200, $response->getStatusCode());
    }

    protected function createEntity()
    {
        return $this->endpoint->create([
            ['property' => 'email',     'value' => 'rw_test'.uniqid().'@hubspot.com'],
            ['property' => 'firstname', 'value' => 'joe'],
            ['property' => 'lastname',  'value' => 'user'],
        ]);
    }

    protected function deleteEntity()
    {
        return $this->endpoint->delete($this->entity->vid);
    }
}
