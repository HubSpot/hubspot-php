<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\Pages;

/**
 * @internal
 * @coversNothing
 */
class PagesTest extends \PHPUnit_Framework_TestCase
{
    private $pages;

    public function setUp()
    {
        parent::setUp();
        $this->pages = new Pages(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        sleep(1);
    }

    /** @test */
    public function clonePage()
    {
        $post = $this->createPage();
        $response = $this->pages->clonePage($post->id, 'New page name');
        $this->assertEquals(201, $response->getStatusCode());
    }

    // Lots of tests need an existing object to modify.
    private function createPage()
    {
        sleep(1);

        $response = $this->pages->create([
            'name' => 'My Super Awesome Post '.uniqid(),
            'content_group_id' => 351076997,
        ]);

        $this->assertEquals(201, $response->getStatusCode());

        return $response;
    }
}
