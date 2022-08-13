<?php

namespace SevenShores\Hubspot\Tests\Integration\Endpoints;

use SevenShores\Hubspot\Tests\Integration\Abstraction\HubDBRowTestCase;

/**
 * @internal
 * @coversNothing
 */
class HubDBRowTest extends HubDBRowTestCase
{
    /**
     * @var \SevenShores\Hubspot\Http\Response
     */
    protected $row;

    public function setUp(): void
    {
        parent::setUp();
        $this->row = $this->createRow();
    }

    /**
     * @test
     */
    public function getRows()
    {
        $response = $this->endpoint->getRows($this->entity->id, $this->portalId, true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, $response->totalCount);
    }

    /**
     * @test
     */
    public function addRow()
    {
        $this->assertEquals(200, $this->row->getStatusCode());
    }

    /**
     * @test
     */
    public function cloneRow()
    {
        $response = $this->endpoint->cloneRow($this->entity->id, $this->row->id);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Test name', $response->toArray());
    }

    /**
     * @test
     */
    public function updateRow()
    {
        $response = $this->endpoint->updateRow(
            $this->entity->id,
            $this->row->id,
            [
                $this->entity->columns[0]->id => 'Updated Test name',
            ]
        );

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Updated Test name', $response->toArray());
    }

    /**
     * @test
     */
    public function deleteRow()
    {
        $response = $this->endpoint->deleteRow(
            $this->entity->id,
            $this->row->id
        );

        $this->assertEquals(204, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function updateCell()
    {
        $response = $this->endpoint->updateCell(
            $this->entity->id,
            $this->row->id,
            $this->entity->columns[0]->id,
            [
                'value' => 'Updated Test name',
            ]
        );

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Updated Test name', $response->toArray());
    }

    /**
     * @test
     */
    public function deleteCell()
    {
        $response = $this->endpoint->deleteCell(
            $this->entity->id,
            $this->row->id,
            $this->entity->columns[0]->id
        );

        $this->assertEquals(204, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function publishDraftTable()
    {
        $response = $this->endpoint->publishDraftTable($this->entity->id);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains($this->entity->name, $response->toArray());
    }

    /**
     * @test
     */
    public function revertDraftTable()
    {
        $response = $this->endpoint->revertDraftTable($this->entity->id);

        $this->assertEquals(200, $response->getStatusCode());
    }

    protected function createRow()
    {
        return $this->endpoint->addRow($this->entity->id, [
            $this->entity->columns[0]->id => 'Test name',
            $this->entity->columns[1]->id => 10,
        ]);
    }
}
