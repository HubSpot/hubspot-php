<?php

namespace Fungku\HubSpot\Tests\Integration\Api;

use Fungku\HubSpot\Api\Contacts;
use Fungku\HubSpot\Http\Client;

class ContactsTest extends \PHPUnit_Framework_TestCase
{
    private $contacts;

    public function setUp()
    {
        parent::setUp();
        $this->contacts = new Contacts('demo', new Client());
    }

    /** @test */
    public function all_with_no_params()
    {
        $response = $this->contacts->all();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function all_with_params()
    {
        $response = $this->contacts->all([
            'count'     => 2,
            'property'  => ['firstname', 'lastname'],
            'vidOffset' => 1234,
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(2, count($response->contacts));
        $this->assertNotNull($response->contacts[0]->properties->firstname->value);
        $this->assertNotNull($response->contacts[0]->properties->lastname->value);
        $this->assertGreaterThanOrEqual(1234, $response->{'vid-offset'});
    }

    /** @test */
    public function all_with_params_and_array_access()
    {
        $response = $this->contacts->all([
            'count'     => 2,
            'property'  => ['firstname', 'lastname'],
            'vidOffset' => 1234,
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(2, count($response['contacts']));
        $this->assertNotNull($response['contacts'][0]['properties']['firstname']['value']);
        $this->assertNotNull($response['contacts'][0]['properties']['lastname']['value']);
        $this->assertGreaterThanOrEqual(1234, $response['vid-offset']);
    }

    /** @test */
    public function create()
    {
        $response = $this->contacts->create([
            ['property' => 'firstname', 'value' => 'joe'],
            ['property' => 'lastname', 'value'  => 'user'],
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function update()
    {
        $response = $this->contacts->all(['count' => 1, 'property' => 'email', 'vidOffset' => 1]);
        $id = $response->contacts[0]->vid;

        $response = $this->contacts->update($id, [
            ['property' => 'firstname', 'value' => 'joe'],
            ['property' => 'lastname', 'value'  => 'user'],
        ]);

        $this->assertEquals(204, $response->getStatusCode());
    }

    /** @test */
    public function createOrUpdate()
    {
        $response = $this->contacts->createOrUpdate('test@hubspot.com', [
            ['property' => 'firstname', 'value' => 'joe'],
            ['property' => 'lastname', 'value'  => 'user'],
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function createOrUpdateBatch()
    {
        $response = $this->contacts->createOrUpdateBatch([
            [
                'email' => 'test1@hubspot.com',
                'properties' => [
                    ['property' => 'firstname', 'value' => 'joe'],
                    ['property' => 'lastname', 'value'  => 'user'],
                ],
            ],
            [
                'email' => 'test2@hubspot.com',
                'properties' => [
                    ['property' => 'firstname', 'value' => 'jane'],
                    ['property' => 'lastname', 'value'  => 'user'],
                ],
            ]
        ]);

        $this->assertEquals(202, $response->getStatusCode());
    }

    /** @test */
    public function delete()
    {
        $response = $this->contacts->all(['count' => 1, 'property' => 'email', 'vidOffset' => 1]);
        $id = $response->contacts[0]->vid;

        $response = $this->contacts->delete($id);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function recent()
    {
        $response = $this->contacts->recent(['count' => 2]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getById()
    {
        $response = $this->contacts->all(['count' => 1, 'property' => 'email', 'vidOffset' => 1]);
        $id = $response->contacts[0]->vid;

        $response = $this->contacts->getById($id);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getBatchByIds()
    {
        $response = $this->contacts->all(['count' => 3, 'property' => 'firstname', 'vidOffset' => 1]);

        $ids = array_reduce($response['contacts'], function($vids, $contact) {
            $vids[] = $contact['vid'];
            return $vids;
        }, []);

        $response = $this->contacts->getBatchByIds($ids);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(3, count((array) $response->getData()));
    }

    /** @test */
    public function getByEmail()
    {
        $response = $this->contacts->all(['count' => 1, 'property' => 'email', 'vidOffset' => 1]);
        $email = $response->contacts[0]->properties->email->value;

        $response = $this->contacts->getByEmail($email);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getBatchByEmails()
    {
        $response = $this->contacts->all(['count' => 3, 'property' => 'email', 'vidOffset' => 1]);

        $emails = array_reduce($response['contacts'], function($values, $contact) {
            $values[] = $contact['properties']['email']['value'];
            return $values;
        }, []);

        $response = $this->contacts->getBatchByEmails($emails);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(3, count((array) $response->getData()));
    }

    /**
     * I don't know how to make this work... without doing a lot of work.
     */
    public function getByToken()
    {
        $response = $this->contacts->all(['count' => 1, 'vidOffset' => 1]);
        $utk = $response->contacts[0]->properties->usertoken->value;

        $response = $this->contacts->getByToken($utk);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * Same with this one...
     */
    public function getBatchByTokens()
    {
        $response = $this->contacts->getByBatchByTokens($id);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function search()
    {
        $response = $this->contacts->search('hub', ['count' => 2]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function statistics()
    {
        $response = $this->contacts->statistics();

        $this->assertEquals(200, $response->getStatusCode());
    }
}