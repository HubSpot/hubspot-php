<?php

namespace SevenShores\Hubspot\Tests\Integration\Abstraction;

use SevenShores\Hubspot\Endpoints\CrmPipelines;

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
     * @var SevenShores\Hubspot\Endpoints\CrmPipelines
     */
    protected $endpoint;

    /**
     * @var SevenShores\Hubspot\Endpoints\CrmPipelines::class
     */
    protected $endpointClass = CrmPipelines::class;

    public function setUp(): void
    {
        if (empty($this->endpoint)) {
            $this->endpoint = new $this->endpointClass($this->getClient(), $this->type);
        }
        sleep(1);

        parent::setUp();
    }

    /** @test */
    public function getAllPipelinesTest()
    {
        $response = $this->endpoint->all();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getAllPipelinesIncludingDeleted()
    {
        $response = $this->endpoint->all(['includeInactive' => 'INCLUDE_DELETED']);

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
        $response = $this->endpoint->update(
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
        return $this->endpoint->create($this->getData());
    }

    protected function deleteEntity()
    {
        return $this->endpoint->delete($this->entity->pipelineId);
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
