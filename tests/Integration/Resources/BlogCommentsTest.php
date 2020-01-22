<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Resources\Comments;
use SevenShores\Hubspot\Tests\Integration\Abstraction\EntityTestCase;

/**
 * @internal
 * @coversNothing
 */
class BlogCommentsTest extends EntityTestCase
{
    /**
     * @var Comments
     */
    protected $resource;

    /**
     * @var Comments:class
     */
    protected $resourceClass = Comments::class;

    /** @test */
    public function all()
    {
        $response = $this->resource->all();

        $this->assertEquals(200, $response->getStatusCode());
    }

    protected function createEntity()
    {
        
    }

    protected function deleteEntity()
    {
        
    }

}
