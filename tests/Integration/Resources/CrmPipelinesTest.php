<?php

namespace SevenShores\Hubspot\Tests\integration\Resources;

use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\CrmPipelines;

/**
 * @internal
 * @coversNothing
 */
class CrmPipelinesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CrmPipelines
     */
    protected $pipelines;

    public function setUp()
    {
        parent::setUp();
        $this->pipelines = new CrmPipelines(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        sleep(1);
    }

    /** @test */
    public function getAllTicketsPipelinesTest()
    {
        $response = $this->pipelines->all('tickets');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getAllTicketsPipelinesIncludingDeleted()
    {
        $response = $this->pipelines->all('tickets', ['includeInactive' => 'INCLUDE_DELETED']);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getAllDealsPipelinesTest()
    {
        $response = $this->pipelines->all('deals');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getAllDealsPipelinesIncludingDeleted()
    {
        $response = $this->pipelines->all('deals', ['includeInactive' => 'INCLUDE_DELETED']);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function createTicketsPipeline()
    {
        $response = $this->createPipeline('tickets', $this->getTicketsData());

        $this->assertEquals(200, $response->getStatusCode());

        $this->deletePipeline('tickets', $response->pipelineId);
    }

    /** @test */
    public function createDealsPipeline()
    {
        $response = $this->createPipeline('deals', $this->getDealsData());

        $this->assertEquals(200, $response->getStatusCode());

        $this->deletePipeline('deals', $response->pipelineId);
    }

    /** @test */
    public function updateTicketsPipeline()
    {
        $data = $this->getTicketsData();
        $pipeline = $this->createPipeline('tickets', $data);

        $data['label'] = 'Updated Ticket Pipeline '.uniqid();

        $response = $this->pipelines->update('tickets', $pipeline->pipelineId, $data);

        $this->assertEquals(200, $response->getStatusCode());

        $this->deletePipeline('tickets', $response->pipelineId);
    }

    /** @test */
    public function updateDealsPipeline()
    {
        $data = $this->getDealsData();
        $pipeline = $this->createPipeline('deals', $data);

        $data['label'] = 'Updated Deals Pipeline '.uniqid();

        $response = $this->pipelines->update('deals', $pipeline->pipelineId, $data);

        $this->assertEquals(200, $response->getStatusCode());

        $this->deletePipeline('deals', $response->pipelineId);
    }

    /** @test */
    public function deleteTicketsPipeline()
    {
        $pipeline = $this->createPipeline('tickets', $this->getTicketsData());

        $response = $this->deletePipeline('tickets', $pipeline->pipelineId);

        $this->assertEquals(204, $response->getStatusCode());
    }

    /** @test */
    public function deleteDealsPipeline()
    {
        $pipeline = $this->createPipeline('deals', $this->getDealsData());

        $response = $this->deletePipeline('deals', $pipeline->pipelineId);

        $this->assertEquals(204, $response->getStatusCode());
    }

    protected function createPipeline($objectType, array $data)
    {
        return $this->pipelines->create($objectType, $data);
    }

    protected function deletePipeline($objectType, $id)
    {
        return $this->pipelines->delete($objectType, $id);
    }

    protected function getDealsData()
    {
        return [
            'label' => 'Demo Deal Pipeline '.uniqid(),
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

    protected function getTicketsData()
    {
        return [
            'label' => 'Demo Ticket Pipeline '.uniqid(),
            'displayOrder' => 1,
            'active' => true,
            'stages' => [
                [
                    'label' => 'Demo Stage',
                    'displayOrder' => 1,
                ],
            ],
        ];
    }
}
