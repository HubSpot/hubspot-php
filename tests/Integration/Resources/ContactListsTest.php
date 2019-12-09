<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\ContactLists;
use SevenShores\Hubspot\Resources\Contacts;

/**
 * @internal
 * @coversNothing
 */
class ContactListsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ContactLists
     */
    protected $contactLists;

    /**
     * @var Contacts
     */
    protected $contacts;

    public function setUp()
    {
        parent::setUp();
        $this->contactLists = new ContactLists(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        $this->contacts = new Contacts(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        sleep(1);
    }

    /** @test */
    public function allWithNoParams()
    {
        $response = $this->contactLists->all();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function allWithParams()
    {
        $response = $this->contactLists->all([
            'count' => 2,
            'offset' => 1,
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(2, count($response->lists));
        $this->assertNotNull($response->lists[0]->name);
        $this->assertNotNull($response->lists[1]->name);
        $this->assertGreaterThanOrEqual(1, $response->offset);
    }

    /** @test */
    public function allWithParamsAndArrayAccess()
    {
        $response = $this->contactLists->all([
            'count' => 2,
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
            'name' => 'New test name '.uniqid(),
        ]);

        $this->assertEquals(200, $response->getStatusCode());

        $this->contactLists->delete($list->listId);
    }

    /** @test */
    public function getById()
    {
        $list = $this->createList();

        $response = $this->contactLists->getById($list->listId);

        $this->assertEquals(200, $response->getStatusCode());

        $this->contactLists->delete($list->listId);
    }

    /** @test */
    public function getBatchByIds()
    {
        $lists = [
            $this->createList(),
            $this->createList(),
        ];

        $ids = array_reduce($lists, function ($listIds, $list) {
            $listIds[] = $list->listId;

            return $listIds;
        }, []);

        $response = $this->contactLists->getBatchByIds($ids);

        $this->assertEquals(200, $response->getStatusCode());

        foreach ($ids as $id) {
            $this->contactLists->delete($id);
        }
    }

    /** @test */
    public function contacts()
    {
        $list = $this->createList();

        $response = $this->contactLists->contacts($list->listId);

        $this->assertEquals(200, $response->getStatusCode());

        $this->contactLists->delete($list->listId);
    }

    /** @test */
    public function recentContacts()
    {
        $list = $this->createList();

        $response = $this->contactLists->recentContacts($list->listId);

        $this->assertEquals(200, $response->getStatusCode());

        $this->contactLists->delete($list->listId);
    }

    /** @test */
    public function delete()
    {
        $list = $this->createList();

        $response = $this->contactLists->delete($list->listId);

        $this->assertEquals(204, $response->getStatusCode());
    }

    /** @test */
    public function addContact()
    {
        $list = $this->createList(false);
        $contact = $this->createContact();

        $response = $this->contactLists->addContact($list->listId, [$contact->vid]);

        $this->assertEquals(200, $response->getStatusCode());

        $this->contactLists->removeContact($list->listId, [$contact->vid]);
        $this->contactLists->delete($list->listId);
        $this->contacts->delete($contact->vid);
    }

    /** @test */
    public function removeContact()
    {
        $list = $this->createList(false);
        $contact = $this->createContact();

        $this->contactLists->addContact($list->listId, [$contact->vid]);
        $response = $this->contactLists->removeContact($list->listId, [$contact->vid]);

        $this->assertEquals(200, $response->getStatusCode());

        $this->contactLists->delete($list->listId);
        $this->contacts->delete($contact->vid);
    }

    /**
     * Creates a new contact with the HubSpotApi.
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    protected function createContact()
    {
        $contactResponse = $this->contacts->create([
            ['property' => 'email', 'value' => 'ContactListsTest'.uniqid().'@hubspot.com'],
            ['property' => 'firstname', 'value' => 'joe'],
            ['property' => 'lastname', 'value' => 'user'],
        ]);

        sleep(1);

        return $contactResponse;
    }

    // Lots of tests need an existing object to modify.
    protected function createList($dynamic = true)
    {
        sleep(1);

        $response = $this->contactLists->create([
            'name' => 'Test '.uniqid(),
            'dynamic' => $dynamic,
            'portalId' => 62515,
            'filters' => [
                [
                    [
                        'operator' => 'EQ',
                        'value' => '@hubspot',
                        'property' => 'twitterhandle',
                        'type' => 'string',
                    ],
                ],
            ],
        ]);

        $this->assertEquals(200, $response->getStatusCode());

        return $response;
    }
}
