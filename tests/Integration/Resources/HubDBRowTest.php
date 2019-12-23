<?php
namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Tests\Integration\Abstraction\HubDBRowTestCase;

class HubDBTest extends HubDBRowTestCase
{
    /**
     * @var \SevenShores\Hubspot\Http\Response
     */
    protected $row;

    public function setUp()
    {
        parent::setUp();
        $this->row = $this->createRow();
    }
    
    /**
     * @test
     */
    public function getRows()
    {
        $response = $this->resource->getRows($this->portalId, $this->entity->id);
        
        $this->assertEquals(200, $response->getStatusCode());
        
    }

    protected function createRow()
    {
        return $this->resource->addRow($this->entity->id, [
            $this->entity->columns[0]->id => 'Test name',
        ]);
    }
}
