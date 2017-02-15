<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Resources\Contacts;
use SevenShores\Hubspot\Http\Client;

class ContactsTest extends \PHPUnit_Framework_TestCase
{
    private $contacts;

    public function setUp()
    {
        parent::setUp();
        $this->contacts = new Contacts(new Client(['key' => 'demo']));
        sleep(1);
    }

    /*
     * Lots of tests need an existing object to modify.
     */
    private function createContact()
    {
        sleep(1);

        $response = $this->contacts->create([
            ['property' => 'email',     'value' => 'rw_test'.uniqid().'@hubspot.com'],
            ['property' => 'firstname', 'value' => 'joe'],
            ['property' => 'lastname',  'value' => 'user'],
        ]);

        $this->assertEquals(200, $response->getStatusCode());

        return $response;
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
        // $this->assertNotNull($response->contacts[0]->properties->email->value);
        // $this->assertNotNull($response->contacts[0]->properties->lastname->value);
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
        // $this->assertNotNull($response['contacts'][0]['properties']['firstname']['value']);
        // $this->assertNotNull($response['contacts'][0]['properties']['lastname']['value']);
        $this->assertGreaterThanOrEqual(1234, $response['vid-offset']);
    }

    /** @test */
    public function update()
    {
        $contact = $this->createContact();

        $response = $this->contacts->update($contact->vid, [
            ['property' => 'firstname', 'value' => 'joe'],
            ['property' => 'lastname', 'value'  => 'user'],
        ]);

        $this->assertEquals(204, $response->getStatusCode());
    }

    /** @test */
    public function updateByEmail()
    {
        $contact = $this->createContact();

        $response = $this->contacts->updateByEmail($contact->properties->email->value, [
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
        $contact = $this->createContact();

        $response = $this->contacts->delete($contact->vid);

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
        $contact = $this->createContact();

        $response = $this->contacts->getById($contact->vid);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getBatchByIds()
    {
        $contacts = [
            $this->createContact(),
            $this->createContact(),
        ];

        $ids = array_reduce($contacts, function($vids, $contact) {
            $vids[] = $contact->vid;
            return $vids;
        }, []);

        $response = $this->contacts->getBatchByIds($ids);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getByEmail()
    {
        $contact = $this->createContact();

        $response = $this->contacts->getByEmail($contact->properties->email->value);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getBatchByEmails()
    {
        $contacts = [
            $this->createContact(),
            $this->createContact(),
        ];

        $emails = array_reduce($contacts, function($values, $contact) {
            $values[] = $contact->properties->email->value;
            return $values;
        }, []);

        $response = $this->contacts->getBatchByEmails($emails);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function getByToken()
    {
        // TODO: This is harder...
    }

    public function getBatchByTokens()
    {
        // TODO: ... and so is this one
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
