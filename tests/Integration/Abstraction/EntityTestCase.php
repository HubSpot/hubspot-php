<?php

namespace SevenShores\Hubspot\Tests\Integration\Abstraction;

abstract class EntityTestCase extends DefaultTestCase
{
    /**
     * @var null|\SevenShores\Hubspot\Http\Response
     */
    protected $entity;

    public function setUp(): void
    {
        parent::setUp();

        $this->entity = $this->createEntity();
        sleep(1);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        if (!empty($this->entity)) {
            $this->deleteEntity();
        }
    }

    abstract protected function createEntity();

    abstract protected function deleteEntity();
}
