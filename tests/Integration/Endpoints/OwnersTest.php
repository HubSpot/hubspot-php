<?php

namespace SevenShores\Hubspot\Tests\Integration\Endpoints;

use SevenShores\Hubspot\Endpoints\Owners;
use SevenShores\Hubspot\Http\Client;

/**
 * Class OwnersTest.
 *
 * @group owners
 *
 * @internal
 * @coversNothing
 */
class OwnersTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Owners
     */
    protected $owners;

    public function setUp(): void
    {
        parent::setUp();
        $this->owners = new Owners(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        sleep(1);
    }

    /**
     * @test
     */
    public function get()
    {
        $owner = $this->owners->all(['email' => getenv('HUBSPOT_TEST_EMAIL')])->getData()[0];

        $response = $this->owners->getById($owner->ownerId);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame($owner->email, $response->email);
    }

    /**
     * @test
     */
    public function findByEmail()
    {
        $response = $this->owners->all(['email' => getenv('HUBSPOT_TEST_EMAIL')]);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(getenv('HUBSPOT_TEST_EMAIL'), $response->getData()[0]->email);
    }

    /**
     * @test
     */
    public function all()
    {
        $response = $this->owners->all();
        $this->assertSame(200, $response->getStatusCode());
    }
}
