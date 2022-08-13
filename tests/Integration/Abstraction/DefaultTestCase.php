<?php

namespace SevenShores\Hubspot\Tests\Integration\Abstraction;

use PHPUnit\Framework\TestCase;
use SevenShores\Hubspot\Http\Client;

/**
 * @internal
 * @coversNothing
 */
class DefaultTestCase extends TestCase
{
    /**
     * @var null|SevenShores\Hubspot\Endpoints\Endpoint
     */
    protected $endpoint;

    /**
     * @var null|SevenShores\Hubspot\Endpoints\Endpoint::class
     */
    protected $endpointClass;

    /**
     * @var string
     */
    protected $key = 'HUBSPOT_TEST_API_KEY';

    public function setUp(): void
    {
        parent::setUp();

        if (empty($this->endpoint)) {
            $this->endpoint = new $this->endpointClass($this->getClient());
        }
        sleep(1);
    }

    protected function getClient(): Client
    {
        return new Client(['key' => getenv($this->key)]);
    }
}
