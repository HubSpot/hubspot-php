<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Resources\Keywords;
use SevenShores\Hubspot\Http\Client;

class KeywordsTest extends \PHPUnit_Framework_TestCase
{
    private $keywords;

    public function setUp()
    {
        parent::setUp();
        $this->keywords = new Keywords(new Client(['key' => 'demooooo-oooo-oooo-oooo-oooooooooooo', 'oauth' => true]));
        sleep(1);
    }

    /*
     * Lots of tests need an existing object to modify.
     */
    private function createKeyword()
    {
        $response = $this->keywords->create([
            "keyword" => "k " . uniqid(),
        ]);

        $this->assertEquals(201, $response->getStatusCode());

        sleep(1);

        return $response;
    }

    /** @test */
    public function all()
    {
        $response = $this->keywords->all();

        sleep(1);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, count($response->getData()));
    }

    /** @test */
    public function all_with_search()
    {
        $response = $this->keywords->all('marketing');

        sleep(1);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getById()
    {
        $keyword = $this->createKeyword();

        $response = $this->keywords->getById($keyword->keywords[0]->keyword_guid);

        sleep(1);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function delete()
    {
        $keyword = $this->createKeyword();

        $response = $this->keywords->delete($keyword->keywords[0]->keyword_guid);

        sleep(1);

        $this->assertEquals(204, $response->getStatusCode());
    }
}
