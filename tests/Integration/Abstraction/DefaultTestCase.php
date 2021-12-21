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
     * @var null|SevenShores\Hubspot\Resources\Resource
     */
    protected $resource;

    /**
     * @var null|SevenShores\Hubspot\Resources\Resource::class
     */
    protected $resourceClass;

    /**
     * @var string
     */
    protected $key = 'HUBSPOT_TEST_API_KEY';

    public function setUp(): void
    {
        parent::setUp();

        if (empty($this->resource)) {
            $this->resource = new $this->resourceClass($this->getClient());
        }
        sleep(1);
    }

    protected function getClient(): Client
    {
        return new Client(['key' => getenv($this->key)]);
    }
}
