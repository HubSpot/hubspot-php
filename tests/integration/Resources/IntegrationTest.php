<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Resources\Integration;
use SevenShores\Hubspot\Http\Client;

/**
 * Class IntegrationTest
 * @package SevenShores\Hubspot\Tests\Integration\Resources
 * @group integration
 */
class IntegrationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Integration
     */
    private $integration;

    public function setUp()
    {
        parent::setUp();
        $this->integration = new Integration(new Client(['key' => 'demo']));
        sleep(1);
    }

    /** @test */
    public function getDailyUsage()
    {
        $response = $this->integration->getDailyUsage();

        $this->assertEquals(200, $response->getStatusCode());
        $data = $response->toArray();
        $this->assertNotEmpty($data);
        $data = reset($data);
        $this->assertNotEmpty($data['usageLimit']);
        $this->assertNotEmpty($data['currentUsage']);
    }

}
