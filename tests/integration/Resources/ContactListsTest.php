<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Resources\ContactLists;
use SevenShores\Hubspot\Http\Client;

class ContactListsTest extends \PHPUnit_Framework_TestCase
{
    private $contactLists;

    public function setUp()
    {
        parent::setUp();
        $this->contactLists = new ContactLists(new Client(['key' => 'demo']));
        sleep(1);
    }

    /*
     * Lots of tests need an existing object to modify.
     */
    private function createList()
    {
        sleep(1);

        $response = $this->contactLists->create([
            'name'     => 'Test ' . uniqid(),
            'dynamic'  => true,
            'portalId' => 62515,
            'filters'  => [
                [
                    [
                        'operator' => 'EQ',
                        'value'    => '@hubspot',
                        'property' => 'twitterhandle',
                        'type'     => 'string',
                    ],
                ],
            ],
        ]);

        $this->assertEquals(200, $response->getStatusCode());

        return $response;
    }

    /** @test */
    public function all_with_no_params()
    {
        $response = $this->contactLists->all();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function all_with_params()
    {
        $response = $this->contactLists->all([
            'count'  => 2,
            'offset' => 1,
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(2, count($response->lists));
        $this->assertNotNull($response->lists[0]->name);
        $this->assertNotNull($response->lists[1]->name);
        $this->assertGreaterThanOrEqual(1, $response->offset);
    }

    /** @test */
    public function all_with_params_and_array_access()
    {
        $response = $this->contactLists->all([
            'count'  => 2,
            'offset' => 1,
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(2, count($response['lists']));
        $this->assertNotNull($response['lists'][0]['name']);
        $this->assertNotNull($response['lists'][1]['name']);
        $this->assertGreaterThanOrEqual(1, $response['offset']);
    }

    /** @test */
    public function getAllStatic()
    {
        $response = $this->contactLists->getAllStatic();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getAllDynamic()
    {
        $response = $this->contactLists->getAllStatic();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function update()
    {
        $list = $this->createList();

        $response = $this->contactLists->update($list->listId, [
            'name' => 'New test name ' . uniqid(),
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getById()
    {
        $list = $this->createList();

        $response = $this->contactLists->getById($list->listId);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getBatchByIds()
    {
        $lists = [
            $this->createList(),
            $this->createList(),
        ];

        $ids = array_reduce($lists, function($listIds, $list) {
            $listIds[] = $list->listId;
            return $listIds;
        }, []);

        $response = $this->contactLists->getBatchByIds($ids);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function contacts()
    {
        $list = $this->createList();

        $response = $this->contactLists->contacts($list->listId);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function recentContacts()
    {
        $list = $this->createList();

        $response = $this->contactLists->recentContacts($list->listId);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function refresh()
    {
        $list = $this->createList();

        $response = $this->contactLists->refresh($list->listId);

        $this->assertEquals(204, $response->getStatusCode());
    }

    /** @test */
    public function delete()
    {
        $list = $this->createList();

        $response = $this->contactLists->delete($list->listId);

        $this->assertEquals(204, $response->getStatusCode());
    }

    public function addContact()
    {
        $list = $this->createList();

        // TODO - add additional test for vid based contact add.
        $response = $this->addContact($list, [], 'test@test.com');

        $this->assertEquals(204, $response->getStatusCode());
    }

    public function removeContact()
    {
        // TODO
    }
}
