<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\BlogAuthors;

/**
 * @internal
 * @coversNothing
 */
class BlogAuthorsTest extends \PHPUnit_Framework_TestCase
{
    private $blogAuthors;

    public function setUp()
    {
        parent::setUp();
        $this->blogAuthors = new BlogAuthors(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        sleep(1);
    }

    /** @test */
    public function allWithNoParams()
    {
        $response = $this->blogAuthors->all();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function allWithParams()
    {
        $response = $this->blogAuthors->all([
            'limit' => 2,
            'offset' => 3,
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertLessThanOrEqual(2, count($response->objects));
        $this->assertGreaterThanOrEqual(3, $response->offset);
    }

    /** @test */
    public function searchWithoutQueryAndParams()
    {
        $response = $this->blogAuthors->search();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function searchWithQueryAndWithoutParams()
    {
        $response = $this->blogAuthors->search('john-smith');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function searchWithQueryAndParams()
    {
        $response = $this->blogAuthors->search('john-smith', [
            'limit' => 5,
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertLessThanOrEqual(5, count($response->objects));
    }

    /** @test */
    public function getById()
    {
        $author = $this->createBlogAuthor();

        $response = $this->blogAuthors->getById($author->id);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function create()
    {
        $response = $this->blogAuthors->create([
            'fullName' => 'John Smith '.uniqid(),
            'email' => 'john.smith'.uniqid().'@example.com',
            'username' => 'john-smith',
        ]);

        $this->assertEquals(201, $response->getStatusCode());
    }

    /** @test */
    public function update()
    {
        $author = $this->createBlogAuthor();

        $response = $this->blogAuthors->update($author->id, [
            'bio' => 'Lorem ipsum dolor sit amet.',
            'website' => 'http://example.com',
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function delete()
    {
        $author = $this->createBlogAuthor();

        $response = $this->blogAuthors->delete($author->id);

        $this->assertEquals(204, $response->getStatusCode());
    }

    // Lots of tests need an existing object to modify.
    private function createBlogAuthor()
    {
        sleep(1);

        $response = $this->blogAuthors->create([
            'fullName' => 'John Smith '.uniqid(),
            'email' => 'john.smith'.uniqid().'@example.com',
            'username' => 'john-smith',
        ]);

        $this->assertEquals(201, $response->getStatusCode());

        return $response;
    }
}
