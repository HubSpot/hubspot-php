<?php

namespace SevenShores\Hubspot\Resources;

use SevenShores\Hubspot\Tests\Integration\Abstraction\EntityTestCase;

/**
 * Class DealPipelinesTest.
 *
 * @internal
 * @coversNothing
 */
class DealPipelinesTest extends EntityTestCase
{
    /**
     * @var DealPipelines
     */
    protected $resource;

    /**
     * @var DealPipelines::class
     */
    protected $resourceClass = DealPipelines::class;

    /**
     * @var null|\SevenShores\Hubspot\Http\Response
     */
    protected $pipeline;

    /**
     * @test
     */
    public function create()
    {
        $this->assertEquals(200, $this->entity->getStatusCode());
        $this->assertCount(1, $this->entity->stages);
    }

    /**
     * @test
     */
    public function getAllPipelines()
    {
        $response = $this->resource->getAllPipelines();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, count($response->getData()));
    }

    /**
     * @test
     */
    public function getPipeline()
    {
        $response = $this->resource->getPipeline($this->entity->pipelineId);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($this->entity->label, $response->label);
        $this->assertCount(1, $response->stages);
    }

    /**
     * @test
     */
    public function update()
    {
        $newLabel = 'Updated pipeline'.uniqid();
        $response = $this->resource->update($this->entity->pipelineId, [
            'label' => $newLabel,
            'pipelineId' => $this->entity->pipelineId,
            'stages' => [
                [
                    'label' => 'new stage',
                ],
            ],
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertSame($newLabel, $response->label);
    }

    /** @test */
    public function delete()
    {
        $response = $this->deleteEntity();

        $this->assertSame(204, $response->getStatusCode());

        $this->entity = null;
    }

    protected function createEntity()
    {
        return $this->resource->create([
            'label' => 'New Business Pipeline'.uniqid(),
            'displayOrder' => 5,
            'stages' => [
                [
                    'label' => 'Initial Stage',
                    'displayOrder' => 0,
                    'probability' => 0.3,
                ],
            ],
        ]);
    }

    protected function deleteEntity()
    {
        return $this->resource->delete($this->entity->pipelineId);
    }
}
