<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Resources\Contacts;
use SevenShores\Hubspot\Tests\Integration\Abstraction\EntityTestCase;

/**
 * @internal
 * @coversNothing
 */
class ContactsTest extends EntityTestCase
{
    /**
     * @var SevenShores\Hubspot\Resources\Contacts
     */
    protected $resource;

    /**
     * @var SevenShores\Hubspot\Resources\Contacts::class
     */
    protected $resourceClass = Contacts::class;

    /** @test */
    public function allWithNoParams()
    {
        $response = $this->resource->all();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, count($response->contacts));
    }

    /** @test */
    public function allWithParams()
    {
        $response = $this->resource->all([
            'property' => ['firstname', 'lastname'],
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, count($response->contacts));
    }

    /** @test */
    public function allWithParamsAndArrayAccess()
    {
        $response = $this->resource->all([
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
        $response = $this->resource->update($this->entity->vid, [
            ['property' => 'firstname', 'value' => 'joe'],
            ['property' => 'lastname', 'value' => 'user'],
        ]);

        $this->assertEquals(204, $response->getStatusCode());
    }

    /** @test */
    public function updateByEmail()
    {
        $response = $this->resource->updateByEmail($this->entity->properties->email->value, [
            ['property' => 'firstname', 'value' => 'joe'],
            ['property' => 'lastname', 'value' => 'user'],
        ]);

        $this->assertEquals(204, $response->getStatusCode());
    }

    /** @test */
    public function createOrUpdate()
    {
        sleep(1);
        $response = $this->resource->createOrUpdate($this->entity->properties->email->value, [
            ['property' => 'firstname', 'value' => 'joe'],
            ['property' => 'lastname', 'value' => 'user'],
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function createOrUpdateBatch()
    {
        $secondEmail = 'test2@hubspot.com';
        $response = $this->resource->createOrUpdateBatch([
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
        $contact = $this->resource->getByEmail($secondEmail)->getData();
        $this->resource->delete($contact->vid);
    }

    /** @test */
    public function createOrUpdateBatchWithAuditId()
    {
        $emails = ['testWithAuditId3@hubspot.com', 'testWithAuditId4@hubspot.com'];
        $response = $this->resource->createOrUpdateBatch([
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

        foreach ($this->resource->getBatchByEmails($emails)->getData() as  $contact) {
            $this->resource->delete($contact->vid);
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
        $response = $this->resource->recent(['count' => 2]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getById()
    {
        $response = $this->resource->getById($this->entity->vid);

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

        $response = $this->resource->getBatchByIds($ids);

        $this->assertEquals(200, $response->getStatusCode());

        $this->resource->delete($contact->vid);
    }

    /** @test */
    public function getByEmail()
    {
        $response = $this->resource->getByEmail($this->entity->properties->email->value);

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

        $response = $this->resource->getBatchByEmails($emails);

        $this->assertEquals(200, $response->getStatusCode());

        $this->resource->delete($contact->vid);
    }

    /** @test */
    public function search()
    {
        $response = $this->resource->search('hub', ['count' => 2]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function statistics()
    {
        $response = $this->resource->statistics();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getLifecycleStageMetrics()
    {
        $response = $this->resource->getLifecycleStageMetrics();

        $this->assertEquals(200, $response->getStatusCode());
    }

    protected function createEntity()
    {
        return $this->resource->create([
            ['property' => 'email',     'value' => 'rw_test'.uniqid().'@hubspot.com'],
            ['property' => 'firstname', 'value' => 'joe'],
            ['property' => 'lastname',  'value' => 'user'],
        ]);
    }

    protected function deleteEntity()
    {
        return $this->resource->delete($this->entity->vid);
    }
}
