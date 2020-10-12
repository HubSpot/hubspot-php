<?php

namespace SevenShores\Hubspot\Tests\Integration\Abstraction;

use SevenShores\Hubspot\Resources\CrmPipelines;

/**
 * @internal
 * @coversNothing
 */
class CrmPipelinesTestCase extends EntityTestCase
{
    /**
     * @var string
     */
    protected $type = 'deals';

    /**
     * @var SevenShores\Hubspot\Resources\CrmPipelines
     */
    protected $resource;

    /**
     * @var SevenShores\Hubspot\Resources\CrmPipelines::class
     */
    protected $resourceClass = CrmPipelines::class;

    public function setUp()
    {
        if (empty($this->resource)) {
            $this->resource = new $this->resourceClass($this->getClient(), $this->type);
        }
        sleep(1);

        parent::setUp();
    }

    /** @test */
    public function getAllPipelinesTest()
    {
        $response = $this->resource->all();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getAllPipelinesIncludingDeleted()
    {
        $response = $this->resource->all(['includeInactive' => 'INCLUDE_DELETED']);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function createPipeline()
    {
        $this->assertEquals(200, $this->entity->getStatusCode());
    }

    /** @test */
    public function updatePipeline()
    {
        $response = $this->resource->update(
            $this->entity->pipelineId,
            $this->getData('Updated '.$this->type.' Pipeline')
        );

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function deletePipeline()
    {
        $response = $this->deleteEntity();

        $this->assertEquals(204, $response->getStatusCode());

        $this->entity = null;
    }

    protected function createEntity()
    {
        return $this->resource->create($this->getData());
    }

    protected function deleteEntity()
    {
        return $this->resource->delete($this->entity->pipelineId);
    }

    protected function getData(string $label = null)
    {
        if (is_null($label)) {
            $label = 'Demo '.$this->type.' Pipeline';
        }

        return [
            'label' => $label.' '.uniqid(),
            'displayOrder' => 1,
            'active' => true,
            'stages' => [
                [
                    'label' => 'Demo Stage',
                    'displayOrder' => 1,
                    'metadata' => [
                        'probability' => 0.5,
                    ],
                ],
            ],
        ];
    }
}
