<?php

namespace SevenShores\Hubspot\Tests\Integration\Endpoints;

use SevenShores\Hubspot\Endpoints\Integration;
use SevenShores\Hubspot\Http\Client;

/**
 * Class IntegrationTest.
 *
 * @group integration
 *
 * @internal
 * @coversNothing
 */
class IntegrationTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Integration
     */
    private $integration;

    public function setUp(): void
    {
        parent::setUp();
        $this->integration = new Integration(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
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
