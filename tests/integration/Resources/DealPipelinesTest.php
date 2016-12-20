<?php

namespace SevenShores\Hubspot\Resources;

use SevenShores\Hubspot\Http\Client;

/**
 * Class DealPipelinesTest
 * @package SevenShores\Hubspot\Resources
 * group dealPipelines
 */
class DealPipelinesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DealPipelines
     */
    private $dealPipelines;

    public function setUp()
    {
        parent::setUp();
        $this->dealPipelines = new DealPipelines(new Client(['key' => 'demo']));
        sleep(1);
    }

    /**
     * @test
     */
    public function getAllPipelines()
    {
        $response = $this->dealPipelines->getAllPipelines();
        $data = $response->getData();

        // this is the default pipeline, always returned as first item.
        // more results might be included, that depends on the following tests
        // in order to get a reliable result, no other items are tested
        $expected = [
            [
                'label' => 'Sales pipeline',
                'stages' => 6,
            ],
        ];
        $this->assertEquals($expected[0]['label'], $data[0]->label);
        $this->assertCount($expected[0]['stages'], $data[0]->stages);
    }

    /**
     * @test
     */
    public function getPipeline()
    {
        $response = $this->dealPipelines->getPipeline('6da7f576-4dc7-4cba-a049-bc5cd0f4e105');
        $data = $response->getData();
        $this->assertEquals('Another pipeline', $data->label);
        $this->assertCount(10, $data->stages);
    }

    /**
     * @test
     */
    public function create()
    {
        $this->markTestSkipped('Test works only once, then return code 409 is given');
        $response = $this->dealPipelines->create([
            'label' => 'New Business Pipeline',
            'displayOrder' => 5,
            'stages' => [
                [
                    'label' => 'Initial Stage',
                    'displayOrder' => 0,
                    'probability' => 0.3,
                ]
            ]
        ]);
        $data = $response->getData();
        $this->assertEquals('New Business Pipeline', $data->label);
        $this->assertCount(3, $data->stages);
    }

    /**
     * @test
     */
    public function update()
    {
        $pipelines = $this->dealPipelines->getAllPipelines();
        $pipelineData = $pipelines->getData();
        // lets use the second returned pipeline
        $id = $pipelineData[1]->pipelineId;
        $newLabel = 'My shiny new updated pipeline';
        $response = $this->dealPipelines->update($id, [
            'label' => $newLabel,
            'pipelineId' => $id,
            'stages' => [
                [
                    'label' => 'new stage',
                ]
            ],
        ]);
        $data = $response->getData();
        $this->assertSame($newLabel, $data->label);
    }

    /**
     * @test
     */
    public function delete()
    {
        $pipelines = $this->dealPipelines->getAllPipelines();
        $pipelineData = $pipelines->getData();
        $id = $pipelineData[1]->pipelineId;
        $response = $this->dealPipelines->delete($id);
        $this->assertSame(204, $response->getStatusCode());
    }

}
