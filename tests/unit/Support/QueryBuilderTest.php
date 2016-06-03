<?php

namespace SevenShores\Hubspot\Tests\Unit\Support;

class QueryBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function build()
    {
        $query = [
            'firstname' => 'joe',
            'lastname'  => 'blo'
        ];

        $queryString = build_query_string($query);

        $this->assertEquals('&firstname=joe&lastname=blo', $queryString);
    }

    /** @test */
    public function build_with_batch()
    {
        $query = [
            'property' => [
                'firstname',
                'lastname'
            ]
        ];

        $queryString = build_query_string($query);

        $this->assertEquals('&property=firstname&property=lastname', $queryString);
    }

    /** @test */
    public function buildBatch()
    {
        $ids = [10, 11, 12, 13, 14, 15];

        $queryString = build_batch_query_string('id', $ids);

        $this->assertEquals('&id=10&id=11&id=12&id=13&id=14&id=15', $queryString);
    }

    /** @test */
    public function build_nested_batch_with_encoding_RFC3986()
    {
        $query = [
            'email' => 'test@test.com',
            'description' => 'two words',
            'property' => [
                'firstname',
                'lastname'
            ]
        ];

        $queryString = build_query_string($query);

        $this->assertEquals(
            '&email=test%40test.com&description=two%20words&property=firstname&property=lastname',
            $queryString
        );
    }

    /** @test */
    public function build_nested_batch_with_encoding_RFC1738()
    {
        $query = [
            'email' => 'test@test.com',
            'description' => 'two words',
            'property' => [
                'firstname',
                'lastname'
            ]
        ];

        $queryString = build_query_string($query, PHP_QUERY_RFC1738);

        $this->assertEquals(
            '&email=test%40test.com&description=two+words&property=firstname&property=lastname',
            $queryString
        );
    }

    /** @test */
    public function encode()
    {
        $string = "I wan't this encoded!";

        $queryString = url_encode($string);

        $this->assertEquals(
            'I%20wan%27t%20this%20encoded%21',
            $queryString
        );
    }

    /** @test */
    public function encode_false()
    {
        $string = "I wan't this encoded!";

        $queryString = url_encode($string, false);

        $this->assertEquals($string, $queryString);
    }
}
