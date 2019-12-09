<?php

namespace SevenShores\Hubspot\Resources;

use SevenShores\Hubspot\Http\Client;

/**
 * Class DealPipelinesTest.
 *
 * @internal
 * @coversNothing
 */
class DealPipelinesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DealPipelines
     */
    protected $dealPipelines;
    /**
     * @var null|\SevenShores\Hubspot\Http\Response
     */
    protected $pipeline;

    public function setUp()
    {
        parent::setUp();
        $this->dealPipelines = new DealPipelines(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        sleep(1);
        $this->pipeline = $this->dealPipelines->create([
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

    public function tearDown()
    {
        parent::tearDown();
        if (!empty($this->pipeline)) {
            $this->dealPipelines->delete($this->pipeline->pipelineId);
        }
    }

    /**
     * @test
     */
    public function create()
    {
        $this->assertEquals(200, $this->pipeline->getStatusCode());
        $this->assertCount(1, $this->pipeline->stages);
    }

    /**
     * @test
     */
    public function getAllPipelines()
    {
        $response = $this->dealPipelines->getAllPipelines();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, count($response->getData()));
    }

    /**
     * @test
     */
    public function getPipeline()
    {
        $response = $this->dealPipelines->getPipeline($this->pipeline->pipelineId);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($this->pipeline->label, $response->label);
        $this->assertCount(1, $response->stages);
    }

    /**
     * @test
     */
    public function update()
    {
        $newLabel = 'Updated pipeline'.uniqid();
        $response = $this->dealPipelines->update($this->pipeline->pipelineId, [
            'label' => $newLabel,
            'pipelineId' => $this->pipeline->pipelineId,
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
        $response = $this->dealPipelines->delete($this->pipeline->pipelineId);
        $this->assertSame(204, $response->getStatusCode());
        $this->pipeline = null;
    }
}
