<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\Companies;
use SevenShores\Hubspot\Resources\Contacts;
use SevenShores\Hubspot\Resources\Deals;
use SevenShores\Hubspot\Tests\Integration\Abstraction\EntityTestCase;

/**
 * Class DealsTest.
 *
 * @group deals
 *
 * @internal
 * @coversNothing
 */
class DealsTest extends EntityTestCase
{
    /**
     * @var Deals::class
     */
    protected $resourceClass = Deals::class;

    /**
     * @var Contacts
     */
    protected $resourceContacts;

    /**
     * @var Companies
     */
    protected $resourceCompanies;

    /**
     * @test
     */
    public function create()
    {
        $this->assertEquals(200, $this->entity->getStatusCode());
        $this->assertSame('Cool Deal', $this->entity->properties->dealname->value);
        $this->assertSame('60000', $this->entity->properties->amount->value);
    }

    /**
     * @test
     */
    public function update()
    {
        $response = $this->resource->update($this->entity->dealId, [
            'properties' => [
                [
                    'name' => 'amount',
                    'value' => '70000',
                ],
            ],
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertSame('70000', $response->properties->amount->value);
    }

    /**
     * @test
     */
    public function updateBatch()
    {
        $deal = $this->createEntity();

        $response = $this->resource->updateBatch([
            [
                'objectId' => $this->entity->dealId,
                'properties' => [
                    ['name' => 'dealname', 'value' => 'Even cooler Deal'],
                    ['name' => 'amount', 'value' => '59999'],
                ],
            ],
            [
                'objectId' => $deal->dealId,
                'properties' => [
                    ['name' => 'dealname', 'value' => 'Still ok Deal'],
                ],
            ],
        ]);

        $this->assertEquals(202, $response->getStatusCode());

        $this->resource->delete($deal->dealId);
    }

    /**
     * @test
     */
    public function all()
    {
        $response = $this->resource->all([
            'offset' => 1,
            'limit' => 1,
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(1, count($response->deals));
    }

    /**
     * @test
     */
    public function getRecentlyModified()
    {
        $this->resource->update($this->entity->dealId, [
            'properties' => [
                [
                    'name' => 'amount',
                    'value' => '70000',
                ],
            ],
        ]);

        $response = $this->resource->getRecentlyModified([
            'offset' => 0,
            'count' => 1,
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function getRecentlyCreated()
    {
        $response = $this->resource->getRecentlyCreated([
            'offset' => 0,
            'count' => 1,
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function delete()
    {
        $response = $this->deleteEntity();
        $this->assertEquals(204, $response->getStatusCode());

        $this->entity = null;
    }

    /**
     * @test
     */
    public function getById()
    {
        $response = $this->resource->getById($this->entity->dealId);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertSame('Cool Deal', $response->properties->dealname->value);
        $this->assertSame('60000', $response->properties->amount->value);
    }

    /**
     * @test
     */
    public function associateAndDisassociateWithCompany()
    {
        $firstCompanyId = $this->createCompany();
        $secondCompanyId = $this->createCompany();
        $thirdCompanyId = $this->createCompany();

        $associateResponse = $this->resource->associateWithCompany($this->entity->dealId, [
            $firstCompanyId,
            $secondCompanyId,
            $thirdCompanyId,
        ]);
        $this->assertEquals(204, $associateResponse->getStatusCode());

        //Check what was associated
        $byIdResponse = $this->resource->getById($this->entity->dealId);

        $associatedCompanies = $byIdResponse->associations->associatedCompanyIds;
        $expectedAssociatedCompanies = [$firstCompanyId, $secondCompanyId, $thirdCompanyId];

        sort($associatedCompanies);
        sort($expectedAssociatedCompanies);

        $this->assertEquals($expectedAssociatedCompanies, $associatedCompanies);

        //Now disassociate
        $response = $this->resource->disassociateFromCompany($this->entity->dealId, [
            $firstCompanyId,
            $secondCompanyId,
            $thirdCompanyId,
        ]);
        $this->assertSame(204, $response->getStatusCode());

        foreach ($expectedAssociatedCompanies as $id) {
            $this->deleteCompany($id);
        }
    }

    /**
     * @test
     */
    public function associateAndDisassociateWithContact()
    {
        $firstContactId = $this->createContact();
        $secondContactId = $this->createContact();
        $thirdContactId = $this->createContact();

        $associateResponse = $this->resource->associateWithContact($this->entity->dealId, [
            $firstContactId,
            $secondContactId,
            $thirdContactId,
        ]);
        $this->assertSame(204, $associateResponse->getStatusCode());

        //Check what was associated
        $byIdResponse = $this->resource->getById($this->entity->dealId);

        $associatedContacts = $byIdResponse->associations->associatedVids;
        $expectedAssociatedContacts = [$firstContactId, $secondContactId, $thirdContactId];

        sort($associatedContacts);
        sort($expectedAssociatedContacts);

        $this->assertEquals($expectedAssociatedContacts, $associatedContacts);

        //Now disassociate
        $response = $this->resource->disassociateFromContact($this->entity->dealId, [
            $firstContactId,
            $secondContactId,
            $thirdContactId,
        ]);
        $this->assertSame(204, $response->getStatusCode());

        foreach ($expectedAssociatedContacts as $id) {
            $this->deleteContact($id);
        }
    }

    /**
     * @test
     */
    public function getAssociatedDealsByCompany()
    {
        $companyId = $this->createCompany();

        $deal = $this->createEntity()->dealId;

        $this->resource->associateWithCompany($this->entity->dealId, [
            $companyId,
        ]);

        $this->resource->associateWithCompany($deal, [
            $companyId,
        ]);

        $response = $this->resource->getAssociatedDeals('company', $companyId);
        $this->assertCount(2, $response->deals);

        $this->resource->delete($deal);

        $this->deleteCompany($companyId);
    }

    /**
     * @test
     */
    public function getAssociatedDealsByContact()
    {
        $contactId = $this->createContact();

        $deal = $this->createEntity()->dealId;

        $this->resource->associateWithContact($this->entity->dealId, [
            $contactId,
        ]);

        $this->resource->associateWithContact($deal, [
            $contactId,
        ]);

        $response = $this->resource->getAssociatedDeals('contact', $contactId);
        $this->assertCount(2, $response->deals);

        $this->resource->delete($deal);
        $this->deleteContact($contactId);
    }

    protected function createCompany()
    {
        return $this->getCompanies()
            ->create(['name' => 'name', 'value' => 'dl_test_company'.uniqid()])
            ->companyId;
    }

    protected function createContact()
    {
        return $this->getContacts()->create([
            ['property' => 'email', 'value' => 'dl_test_contact'.uniqid().'@hubspot.com'],
        ])->vid;
    }

    protected function deleteCompany($id)
    {
        return $this->getCompanies()->delete($id);
    }

    protected function deleteContact($id)
    {
        return $this->getContacts()->delete($id);
    }

    protected function createEntity()
    {
        return $this->resource->create([
            'properties' => [
                [
                    'value' => 'Cool Deal',
                    'name' => 'dealname',
                ],
                [
                    'value' => '60000',
                    'name' => 'amount',
                ],
            ],
        ]);
    }

    protected function deleteEntity()
    {
        return $this->resource->delete($this->entity->dealId);
    }

    protected function getContacts()
    {
        if (empty($this->resourceContacts)) {
            $this->resourceContacts = new Contacts(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        }

        return $this->resourceContacts;
    }

    protected function getCompanies()
    {
        if (empty($this->resourceCompanies)) {
            $this->resourceCompanies = new Companies(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        }

        return $this->resourceCompanies;
    }
}
