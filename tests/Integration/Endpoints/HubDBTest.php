<?php

namespace SevenShores\Hubspot\Tests\Integration\Endpoints;

use SevenShores\Hubspot\Tests\Integration\Abstraction\HubDBRowTestCase;

/**
 * @internal
 * @coversNothing
 */
class HubDBTest extends HubDBRowTestCase
{
    /**
     * @test
     */
    public function tables()
    {
        $response = $this->endpoint->tables();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, count($response->objects));
    }

    /**
     * @test
     */
    public function getTable()
    {
        $response = $this->endpoint->getTable($this->entity->id, $this->portalId);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains($this->entity->id, $response->toArray());
    }

    /**
     * @test
     */
    public function createTable()
    {
        $this->assertEquals(200, $this->entity->getStatusCode());
    }

    /**
     * @test
     */
    public function cloneTable()
    {
        $response = $this->endpoint->cloneTable($this->entity->id, 'Cloned Table');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Cloned Table', $response->toArray());

        $this->endpoint->deleteTable($response->id);
    }

    /**
     * @test
     */
    public function updateTable()
    {
        $response = $this->endpoint->updateTable($this->entity->id, 'Updated Table');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Updated Table', $response->toArray());
    }

    /**
     * @test
     */
    public function deleteTable()
    {
        $response = $this->deleteEntity();

        $this->assertEquals(204, $response->getStatusCode());

        $this->entity = null;
    }

    /**
     * @test
     */
    public function import()
    {
        $response = $this->endpoint->import(
            $this->entity->id,
            __DIR__.'/../../data/hubdb.csv',
            [
                'resetTable' => false,
                'skipRows' => 1,
                'format' => 'csv',
                'columnMappings' => [
                    [
                        'source' => 1,
                        'target' => 1,
                    ],
                    [
                        'source' => 2,
                        'target' => 2,
                    ],
                ],
            ]
        );

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(2, $response->rowsImported);
    }
}
