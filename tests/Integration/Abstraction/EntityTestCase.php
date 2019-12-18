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

    /**
     * @var string
     */
    protected $key = 'HUBSPOT_TEST_API_KEY';

    public function setUp()
    {
        parent::setUp();
        if (empty($this->resource)) {
            $this->resource = new $this->resourceClass(new Client(['key' => getenv($this->key)]));
        }

        $this->entity = $this->createEntity();
        sleep(1);
    }

    public function tearDown()
    {
        parent::tearDown();
        if (!empty($this->entity)) {
            $this->deleteEntity();
        }
    }

    abstract protected function createEntity();

    abstract protected function deleteEntity();
}
