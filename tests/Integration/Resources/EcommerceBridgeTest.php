<?php

namespace SevenShores\Hubspot\Tests\integration\Resources;

use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\EcommerceBridge;

/**
 * Class EcommerceBridgeTest.
 *
 * @group ecommerceBridge
 *
 * @internal
 * @coversNothing
 */
class EcommerceBridgeTest extends \PHPUnit_Framework_TestCase
{
    /** @var EcommerceBridge */
    protected $resource;
    
    protected $timestamp;

    public function setUp()
    {
        parent::setUp();
        $this->resource = new EcommerceBridge(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        sleep(1);
    }
    
    /** @test */
    public function upsertSettings()
    {
        $response = $this->resource->upsertSettings($this->getData());

        $this->assertEquals(200, $response->getStatusCode());
    }
    
    /** @test */
    public function getSettings()
    {
        $response = $this->resource->getSettings();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArrayHasKey('mappings', $response->toArray());
    }
    
    /** @test */
    public function createOrUpdateStore() {
        $response = $this->resource->createOrUpdateStore([
            'id' => 'ecommercebridge-test-store',
            'label' => 'Ecommerce Bridge Test Store',
            'adminUri' => 'https://ecommercebridge-test-store.myshopify.com'
        ]);
        
        $this->assertEquals(200, $response->getStatusCode());
    }
    
    /** @test */
    public function allStores()
    {
        $response = $this->resource->allStores();
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, count($response->getData()->results));
    }
    
    /** @test */
    public function getStore()
    {
        $response = $this->resource->getStore('ecommercebridge-test-store');
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('ecommercebridge-test-store', $response->toArray());
    }
    
    /** @test */
    public function sendSyncMessages()
    {
        $response = $this->resource->sendSyncMessages(
                'ecommercebridge-test-store',
                'CONTACT',
                [
                    [
                        'action' => 'UPSERT',
                        'changedAt' => $this->getTimestamp(),
                        'externalObjectId' => '1234',
                        'properties' => [
                            'firstname' => 'Jeff' . uniqid(),
                            'lastname' => 'David',
                            'email' => 'test@example.com'
                        ]
                    ]
                ]
            );
        
        $this->assertEquals(204, $response->getStatusCode());
    }
    
    /** @test */
    public function getAllSyncErrorsAccount()
    {
        $response = $this->resource->getAllSyncErrorsAccount();
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArrayHasKey('results', $response->toArray());
    }
    
    /** @test */
    public function checkSyncStatus()
    {
        $response = $this->resource->checkSyncStatus(
                'ecommercebridge-test-store',
                'CONTACT',
                '1234'
            );
        
        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function deleteSettings()
    {
        $response = $this->resource->deleteSettings();

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
            'webhookUri' => null,
            'mappings' => [
                'CONTACT' => [
                    'properties' =>  [
                        [
                            'externalPropertyName' => 'firstname',
                            'hubspotPropertyName'  => 'firstname',
                            'dataType' => 'STRING',
                        ],
                        [
                            'externalPropertyName' => 'phone_number',
                            'hubspotPropertyName' => 'mobilephone',
                            'dataType' => 'STRING'
                        ],
                        [
                            'externalPropertyName' => 'familyname',
                            'hubspotPropertyName' => 'lastname',
                            'dataType' => 'STRING'
                        ],
                        [
                            'externalPropertyName' => 'customer_email',
                            'hubspotPropertyName' => 'email',
                            'dataType' => 'STRING'
                        ],
                    ]
                ],
                'DEAL' => [
                    'properties' =>  [
                        [
                            'externalPropertyName' => 'purchase_date',
                            'hubspotPropertyName' => 'closedate',
                            'dataType' => 'STRING'
                        ],
                        [
                            'externalPropertyName' => 'name',
                            'hubspotPropertyName' => 'dealname',
                            'dataType' => 'STRING'
                        ],
                        [
                            'externalPropertyName' => 'stage',
                            'hubspotPropertyName' => 'dealstage',
                            'dataType' => 'STRING'
                        ],
                        [
                            'externalPropertyName' => 'abandoned_cart_url',
                            'hubspotPropertyName' => 'ip__ecomm_bride__abandoned_cart_url',
                            'dataType' => 'STRING'
                        ]
                    ],
                ],
                'PRODUCT' => [
                    'properties' =>  [
                        [
                            'externalPropertyName' => 'product_name',
                            'hubspotPropertyName' => 'name',
                            'dataType' => 'STRING'
                        ],
                        [
                            'externalPropertyName' => 'product_description',
                            'hubspotPropertyName' => 'description',
                            'dataType' => 'STRING'
                        ],
                        [
                            'externalPropertyName' => 'price',
                            'hubspotPropertyName' => 'price',
                            'dataType' => 'NUMBER'
                        ]
                    ],
                ],
                'LINE_ITEM' => [
                    'properties' =>  [
                        [
                            'externalPropertyName' => 'discount_amount',
                            'hubspotPropertyName' => 'discount',
                            'dataType' => 'NUMBER'
                        ],
                        [
                            'externalPropertyName' => 'num_items',
                            'hubspotPropertyName' => 'quantity',
                            'dataType' => 'NUMBER'
                        ],
                        [
                            'externalPropertyName' => 'price',
                            'hubspotPropertyName' => 'price',
                            'dataType' => 'NUMBER'
                        ],
                        [
                            'externalPropertyName' => 'tax_amount',
                            'hubspotPropertyName' => 'tax',
                            'dataType' => 'NUMBER'
                        ]
                    ],
                ],
            ]
        ];
    }
}
