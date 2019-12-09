<?php

namespace SevenShores\Hubspot\Tests\Integration\Abstraction;

use PHPUnit_Framework_TestCase;
use SevenShores\Hubspot\Http\Client;

abstract class EntityTestCase extends PHPUnit_Framework_TestCase
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
     * @var null|\SevenShores\Hubspot\Http\Response
     */
    protected $entity;

    public function setUp()
    {
        parent::setUp();
        $this->resource = new $this->resourceClass(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        sleep(1);
        $this->entity = $this->createEntity();
    }

    public function tearDown()
    {
        parent::tearDown();
        if (!empty($this->entity)) {
            $this->deleteEntity();
        }
    }

    abstract protected function deleteEntity();

    abstract protected function createEntity();
}
