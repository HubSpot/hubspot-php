<?php
namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Tests\Integration\Abstraction\DefaultTestCase;
use SevenShores\Hubspot\Resources\Comments;

class BlogCommentsTest extends DefaultTestCase
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
}
