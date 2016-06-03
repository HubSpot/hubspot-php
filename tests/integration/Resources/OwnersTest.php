<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Resources\Owners;
use SevenShores\Hubspot\Http\Client;

/**
 * Class OwnersTest
 * @package SevenShores\Hubspot\Tests\Integration\Resources
 * @group owners
 */
class OwnersTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Owners
     */
    private $owners;

    public function setUp()
    {
        parent::setUp();
        $this->owners = new Owners(new Client(['key' => 'demo']));
        sleep(1);
    }

    /**
     * @test
     */
    public function create()
    {
        $email = uniqid('test_email').'@hubspot.com';
        $response = $this->createOwner($email);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Testing', $response['firstName']);
        $this->assertEquals('Owner', $response['lastName']);
        $this->assertEquals($email, $response['email']);
        $this->assertEquals(62515, $response['portalId']);
    }

    /**
     * @test
     */
    public function get()
    {
        $email = uniqid('test_email').'@hubspot.com';
        $response = $this->createOwner($email);

        $response = $this->owners->getById($response->ownerId);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame($email, $response->email);
    }

    /**
     * @test
     */
    public function findByEmail()
    {
        $email = uniqid('test_email').'@hubspot.com';
        $this->createOwner($email);

        $response = $this->owners->all(['email' => $email]);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame($email, $response->toArray()[0]['email']);
    }

    /**
     * @test
     */
    public function all()
    {
        $this->createOwner(uniqid('test_email').'@hubspot.com');
        $this->createOwner(uniqid('test_email').'@hubspot.com');
        $this->createOwner(uniqid('test_email').'@hubspot.com');

        $response = $this->owners->all();
        $this->assertSame(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(3, count($response->toArray()));
    }

    /**
     * @test
     */
    public function update()
    {
        $email = uniqid('test_email').'@hubspot.com';

        $owner = $this->createOwner($email);
        $ownerData = $owner->toArray();

        //update email
        $email = 'new_'.$email;
        $ownerData['email'] = $email;
        $response = $this->owners->update($owner->ownerId, $ownerData);
        $this->assertEquals(204, $response->getStatusCode());

        //request again to ensure its updated
        $response = $this->owners->getById($owner->ownerId);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame($email, $response->email);
    }

    /**
     * Creates an Owner with the HubSpotApi
     * @param string $email
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    private function createOwner($email = 'test@owner.com')
    {
        $response = $this->owners->create([
            'type' => 'PERSON',
            'portalId' => 62515, //demo portal id (http://developers.hubspot.com/docs/overview)
            'firstName' => 'Testing',
            'lastName' => 'Owner',
            'email' => $email,
            'remoteList' => [
                [
                    'portalId' => 62515,
                    'remoteType' => 'EMAIL',
                    'remoteId' => 'dev_'.$email,
                    'active' => true,
                ],
            ],
        ]);

        sleep(1);

        return $response;
    }
}
