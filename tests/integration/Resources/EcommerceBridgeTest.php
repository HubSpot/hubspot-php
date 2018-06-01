<?php

namespace SevenShores\Hubspot\Tests\integration\Resources;

use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\EcommerceBridge;

/**
 * Class EcommerceBridgeTest
 * @package SevenShores\Hubspot\Tests\Integration\Resources
 * @group ecommerceBridge
 */
class EcommerceBridgeTest extends \PHPUnit_Framework_TestCase
{
    /** @var EcommerceBridge */
    private $ecommerceBridge;

    public function setUp()
    {
        parent::setUp();
        $this->ecommerceBridge = new EcommerceBridge(new Client(['key' => 'demo']));
        sleep(1);
    }

    public function testInstall()
    {
        $response = $this->ecommerceBridge->install();

        $this->assertEquals(204, $response->getStatusCode());
    }

//    TODO: add back in once hubspot stops throwing 500 errors
//    public function testCheckInstall()
//    {
//        $response = $this->ecommerceBridge->checkInstall();
//
//        $this->assertEquals(200, $response->getStatusCode());
//        $this->assertContains([
//            'installCompleted' => true
//        ], $response->toArray());
//    }

    public function testUninstallSettings()
    {
        $response = $this->ecommerceBridge->uninstall();

        $this->assertEquals(204, $response->getStatusCode());
    }

    public function testUpsertSettings()
    {
        $settings = [
            'enabled' => false,
            'importOnInstall' => false,
            'productSyncSettings' => [
                'properties' => [
                    ['propertyName' => 'test_name', 'dataType' => 'STRING', 'targetHubspotProperty' => 'name']
                ]
            ],
            'dealSyncSettings' => [
                'properties' => []
            ],
            'lineItemSyncSettings' => [
                'properties' => []
            ],
            'contactSyncSettings' => [
                'properties' => []
            ]
        ];

        $response = $this->ecommerceBridge->upsertSettings($settings);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($settings, $response->toArray());
    }

    public function testDeleteSettings()
    {
        $response = $this->ecommerceBridge->deleteSettings();

        $this->assertEquals(204, $response->getStatusCode());
    }

    public function testSyncErrors()
    {
        $response = $this->ecommerceBridge->getSyncErrors();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArrayHasKey('results', $response->toArray());
    }
}