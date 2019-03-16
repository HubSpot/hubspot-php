<?php

namespace SevenShores\Hubspot\Tests\integration\Resources;


use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\CrmPipelines;

class CrmPipelinesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CrmPipelines
     */
    private $pipelines;

    public function setUp()
    {
        parent::setUp();
        $this->pipelines = new CrmPipelines(new Client(['key' => 'demo']));
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
        $data = $response->getData();

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
        $data = $response->getData();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function createTicketsPipeline()
    {
        $data = [
            'label' => 'Demo Ticket Pipeline ' . uniqid(),
            'displayOrder' => 1,
            'active' => true,
            'stages' => [
                [
                    'label' => 'Demo Stage',
                    'displayOrder' => 1
                ]
            ]
        ];

        $response = $this->pipelines->create('tickets', $data);

        $this->assertEquals(200, $response->getStatusCode());

        return $response;
    }

    /** @test */
    public function createDealsPipeline()
    {
        $data = [
            'label' => 'Demo Deal Pipeline ' . uniqid(),
            'displayOrder' => 1,
            'active' => true,
            'stages' => [
                [
                    'label' => 'Demo Stage',
                    'displayOrder' => 1,
                    'metadata' => [
                        'probability' => 0.5
                    ]
                ]
            ]
        ];

        $response = $this->pipelines->create('deals', $data);

        $this->assertEquals(200, $response->getStatusCode());

        return $response;
    }

    /** @test */
    public function updateTicketsPipeline()
    {
        $pipeline = $this->createTicketsPipeline();

        $data = [
            'label' => 'Updated Ticket Pipeline ' . uniqid(),
            'displayOrder' => 1,
            'active' => true,
            'stages' => [
                [
                    'label' => 'Demo Stage',
                    'displayOrder' => 1,
                ]
            ]
        ];

        $response = $this->pipelines->update('tickets', $pipeline->pipelineId, $data);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function updateDealsPipeline()
    {
        $pipeline = $this->createDealsPipeline();

        $data = [
            'label' => 'Updated Deals Pipeline ' . uniqid(),
            'displayOrder' => 1,
            'active' => true,
            'stages' => [
                [
                    'label' => 'Demo Stage',
                    'displayOrder' => 1,
                    'metadata' => [
                        'probability' => 0.5
                    ]
                ]
            ]
        ];

        $response = $this->pipelines->update('deals', $pipeline->pipelineId, $data);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function deleteTicketsPipeline()
    {
        $pipeline = $this->createTicketsPipeline();

        $response = $this->pipelines->delete('tickets', $pipeline->pipelineId);
    }

    /** @test */
    public function deleteDealsPipeline()
    {
        $pipeline = $this->createDealsPipeline();

        $response = $this->pipelines->delete('deals', $pipeline->pipelineId);
    }
}