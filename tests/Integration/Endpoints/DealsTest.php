<?php

namespace SevenShores\Hubspot\Tests\Integration\Endpoints;

use SevenShores\Hubspot\Endpoints\Deals;
use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Tests\Integration\Abstraction\EntityTestCase;

/**
 * Class DealsTest.
 *
 * @group deals
 *
 * @internal
 * @coversNothing
 */
class DealsTest extends EntityTestCase
{
    /**
     * @var Deals
     */
    protected $endpoint;

    /**
     * @var Deals::class
     */
    protected $endpointClass = Deals::class;

    /**
     * @test
     */
    public function create()
    {
        $this->assertEquals(200, $this->entity->getStatusCode());
        $this->assertSame('Cool Deal', $this->entity->properties->dealname->value);
        $this->assertSame('60000', $this->entity->properties->amount->value);
    }

    /**
     * @test
     */
    public function update()
    {
        $response = $this->endpoint->update($this->entity->dealId, [
            [
                'name' => 'amount',
                'value' => '70000',
            ],
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertSame('70000', $response->properties->amount->value);
    }

    /**
     * @test
     */
    public function updateBatch()
    {
        $deal = $this->createEntity();

        $response = $this->endpoint->updateBatch([
            [
                'objectId' => $this->entity->dealId,
                'properties' => [
                    ['name' => 'dealname', 'value' => 'Even cooler Deal'],
                    ['name' => 'amount', 'value' => '59999'],
                ],
            ],
            [
                'objectId' => $deal->dealId,
                'properties' => [
                    ['name' => 'dealname', 'value' => 'Still ok Deal'],
                ],
            ],
        ]);

        $this->assertEquals(202, $response->getStatusCode());

        $this->endpoint->delete($deal->dealId);
    }

    /**
     * @test
     */
    public function all()
    {
        $response = $this->endpoint->all([
            'offset' => 1,
            'limit' => 1,
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(1, count($response->deals));
    }

    /**
     * @test
     */
    public function getRecentlyModified()
    {
        $this->endpoint->update($this->entity->dealId, [
            [
                'name' => 'amount',
                'value' => '70000',
            ],
        ]);

        $response = $this->endpoint->getRecentlyModified([
            'offset' => 0,
            'count' => 1,
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function getRecentlyCreated()
    {
        $response = $this->endpoint->getRecentlyCreated([
            'offset' => 0,
            'count' => 1,
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function delete()
    {
        $response = $this->deleteEntity();
        $this->assertEquals(204, $response->getStatusCode());

        $this->entity = null;
    }

    /**
     * @test
     */
    public function getById()
    {
        $response = $this->endpoint->getById($this->entity->dealId);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertSame('Cool Deal', $response->properties->dealname->value);
        $this->assertSame('60000', $response->properties->amount->value);
    }

    protected function createEntity()
    {
        return $this->endpoint->create([
            [
                'value' => 'Cool Deal',
                'name' => 'dealname',
            ],
            [
                'value' => '60000',
                'name' => 'amount',
            ],
        ]);
    }

    protected function deleteEntity()
    {
        return $this->endpoint->delete($this->entity->dealId);
    }
}
