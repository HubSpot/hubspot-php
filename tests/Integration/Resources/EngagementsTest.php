<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\Contacts;
use SevenShores\Hubspot\Resources\Engagements;

/**
 * @internal
 * @coversNothing
 */
class EngagementsTest extends \PHPUnit_Framework_TestCase
{
    private $engagements;

    public function setUp()
    {
        parent::setUp();
        $this->markTestSkipped(); // TODO: fix test
        $this->contacts = new Contacts(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        $this->engagements = new Engagements(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        sleep(1);
    }

    /** @test */
    public function update()
    {
        $engagement = $this->createEngagement();
        $contact = $this->contacts->create([]);
        $response = $this->engagements->update($engagement->engagement->id, [
            'active' => true,
            'ownerId' => 1,
            'type' => 'NOTE',
            'timestamp' => 1409172644778,
        ], [
            'body' => 'note body',
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function delete()
    {
        $engagement = $this->createEngagement();

        $response = $this->engagements->delete($engagement->engagement->id);

        $this->assertEquals(204, $response->getStatusCode());
    }

    /** @test */
    public function get()
    {
        $engagement = $this->createEngagement();

        $response = $this->engagements->get($engagement->engagement->id);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function associate()
    {
        $engagement = $this->createEngagement();
        $contact = $this->contacts->create([]);
        $response = $this->engagements->associate($engagement->engagement->id, 'contact', $contact->vid);

        $this->assertEquals(204, $response->getStatusCode());
    }

    /** @test */
    public function getCallDispositions()
    {
        $response = $this->engagements->getCallDispositions();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertCount(6, $response->getData());
    }

    // Lots of tests need an existing object to modify.
    private function createEngagement()
    {
        sleep(1);
        $contact = $this->contacts->create([]);
        $response = $this->engagements->create([
            'active' => true,
            'ownerId' => 1,
            'type' => 'NOTE',
            'timestamp' => 1409172644778,
        ], [
            'contactIds' => [$contact->vid],
            'companyIds' => [],
            'dealIds' => [],
            'ownerIds' => [],
        ], [
            'body' => 'note body',
        ]);

        $this->assertEquals(200, $response->getStatusCode());

        return $response;
    }
}
