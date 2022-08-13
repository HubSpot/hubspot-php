<?php

namespace SevenShores\Hubspot\Tests\integration\Endpoints;

use SevenShores\Hubspot\Endpoints\EcommerceBridge;
use SevenShores\Hubspot\Tests\Integration\Abstraction\DefaultTestCase;

/**
 * Class EcommerceBridgeTest.
 *
 * @group ecommerceBridge
 *
 * @internal
 * @coversNothing
 */
class EcommerceBridgeTest extends DefaultTestCase
{
    public const STORE_ID = 'ecommercebridge-test-store';

    /**
     * @var EcommerceBridge
     */
    protected $endpoint;

    /**
     * @var EcommerceBridge::class
     */
    protected $endpointClass = EcommerceBridge::class;

    /**
     * @var int
     */
    protected $timestamp;

    /** @test */
    public function upsertSettings()
    {
        $response = $this->endpoint->upsertSettings($this->getData());

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getSettings()
    {
        $response = $this->endpoint->getSettings();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArrayHasKey('mappings', $response->toArray());
    }

    /** @test */
    public function createOrUpdateStore()
    {
        $response = $this->endpoint->createOrUpdateStore([
            'id' => static::STORE_ID,
            'label' => 'Ecommerce Bridge Test Store '.uniqid(),
            'adminUri' => 'https://ecommercebridge-test-store.myshopify.com',
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function allStores()
    {
        $response = $this->endpoint->allStores();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, count($response->getData()->results));
    }

    /** @test */
    public function getStore()
    {
        $response = $this->endpoint->getStore(static::STORE_ID);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains(static::STORE_ID, $response->toArray());
    }

    /** @test */
    public function sendSyncMessages()
    {
        $response = $this->endpoint->sendSyncMessages(
            static::STORE_ID,
            'CONTACT',
            [
                [
                    'action' => 'UPSERT',
                    'changedAt' => $this->getTimestamp(),
                    'externalObjectId' => '12345',
                    'properties' => [
                        'firstname' => 'Jeff'.uniqid(),
                        'lastname' => 'David',
                        'customer_email' => 'test@example.com',
                    ],
                ],
            ]
        );

        $this->assertEquals(204, $response->getStatusCode());
        sleep(1);
    }

    /** @test */
    public function getAllSyncErrorsAccount()
    {
        $response = $this->endpoint->getAllSyncErrorsAccount();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArrayHasKey('results', $response->toArray());
    }

    /** @test */
    public function checkSyncStatus()
    {
        $response = $this->endpoint->checkSyncStatus(
            static::STORE_ID,
            'CONTACT',
            '12345'
        );

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function importData()
    {
        $this->markTestSkipped();
        $response = $this->endpoint->importData(
            $this->getTimestamp(),
            1,
            [
                [
                    'externalObjectId' => 'deal1',
                    'properties' => [
                        'firstname' => 'ever',
                        'phone_number' => '+375441234567',
                        'familyname' => 'greatest',
                        'customer_email' => 'testingapis@hubspot.com',
                        //                            'firstname' => 'Jeff' . uniqid(),
                        //                            'mobilephone' => '+375441234567',
                        //                            'lastname' => 'David',
                        //                            'email' => 'test1@example.com',
                    ],
                    'assocations' => [
                        'CONTACT' => ['123456'],
                    ],
                ],
            ],
            static::STORE_ID,
            'DEAL'
        );

        $this->assertEquals(204, $response->getStatusCode());
    }

    /** @test */
    public function signalImportEnd()
    {
        $this->markTestSkipped();
        $response = $this->endpoint->signalImportEnd(
            $this->getTimestamp(),
            1,
            1,
            static::STORE_ID,
            'DEAL'
        );

        $this->assertEquals(204, $response->getStatusCode());
    }

    /** @test */
    public function deleteSettings()
    {
        $response = $this->endpoint->deleteSettings();

        $this->assertEquals(204, $response->getStatusCode());
    }

    protected function getTimestamp()
    {
        if (is_null($this->timestamp)) {
            $this->timestamp = time();
        }

        return $this->timestamp;
    }

    protected function getData()
    {
        return [
            'enabled' => true,
            'importOnInstall' => true,
            'webhookUri' => null,
            'mappings' => [
                'CONTACT' => [
                    'properties' => [
                        [
                            'externalPropertyName' => 'firstname',
                            'hubspotPropertyName' => 'firstname',
                            'dataType' => 'STRING',
                        ],
                        [
                            'externalPropertyName' => 'phone_number',
                            'hubspotPropertyName' => 'mobilephone',
                            'dataType' => 'STRING',
                        ],
                        [
                            'externalPropertyName' => 'familyname',
                            'hubspotPropertyName' => 'lastname',
                            'dataType' => 'STRING',
                        ],
                        [
                            'externalPropertyName' => 'customer_email',
                            'hubspotPropertyName' => 'email',
                            'dataType' => 'STRING',
                        ],
                    ],
                ],
                'DEAL' => [
                    'properties' => [
                        [
                            'externalPropertyName' => 'purchase_date',
                            'hubspotPropertyName' => 'closedate',
                            'dataType' => 'STRING',
                        ],
                        [
                            'externalPropertyName' => 'name',
                            'hubspotPropertyName' => 'dealname',
                            'dataType' => 'STRING',
                        ],
                        [
                            'externalPropertyName' => 'stage',
                            'hubspotPropertyName' => 'dealstage',
                            'dataType' => 'STRING',
                        ],
                        [
                            'externalPropertyName' => 'abandoned_cart_url',
                            'hubspotPropertyName' => 'ip__ecomm_bride__abandoned_cart_url',
                            'dataType' => 'STRING',
                        ],
                    ],
                ],
                'PRODUCT' => [
                    'properties' => [
                        [
                            'externalPropertyName' => 'product_name',
                            'hubspotPropertyName' => 'name',
                            'dataType' => 'STRING',
                        ],
                        [
                            'externalPropertyName' => 'product_description',
                            'hubspotPropertyName' => 'description',
                            'dataType' => 'STRING',
                        ],
                        [
                            'externalPropertyName' => 'price',
                            'hubspotPropertyName' => 'price',
                            'dataType' => 'NUMBER',
                        ],
                    ],
                ],
                'LINE_ITEM' => [
                    'properties' => [
                        [
                            'externalPropertyName' => 'discount_amount',
                            'hubspotPropertyName' => 'discount',
                            'dataType' => 'NUMBER',
                        ],
                        [
                            'externalPropertyName' => 'num_items',
                            'hubspotPropertyName' => 'quantity',
                            'dataType' => 'NUMBER',
                        ],
                        [
                            'externalPropertyName' => 'price',
                            'hubspotPropertyName' => 'price',
                            'dataType' => 'NUMBER',
                        ],
                        [
                            'externalPropertyName' => 'tax_amount',
                            'hubspotPropertyName' => 'tax',
                            'dataType' => 'NUMBER',
                        ],
                    ],
                ],
            ],
        ];
    }
}
