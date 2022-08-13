<?php

namespace SevenShores\Hubspot\Tests\Integration\Endpoints;

use SevenShores\Hubspot\Endpoints\Products;
use SevenShores\Hubspot\Tests\Integration\Abstraction\EntityTestCase;

/**
 * @internal
 * @coversNothing
 */
class ProductsTest extends EntityTestCase
{
    use \SevenShores\Hubspot\Tests\Integration\Abstraction\ProductData;

    /**
     * @var SevenShores\Hubspot\Endpoints\Products
     */
    protected $endpoint;

    /**
     * @var SevenShores\Hubspot\Endpoints\Products::class
     */
    protected $endpointClass = Products::class;

    /** @test */
    public function all()
    {
        $response = $this->endpoint->all();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, count($response->objects));
    }

    /** @test */
    public function getById()
    {
        $response = $this->endpoint->getById($this->entity->objectId);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getBatchByIds()
    {
        $product = $this->createEntity();

        $ids = [
            $this->entity->objectId,
            $product->objectId,
        ];

        $response = $this->endpoint->getBatchByIds($ids);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertCount(2, $response->toArray());

        $this->endpoint->delete($product->objectId);
    }

    /** @test */
    public function create()
    {
        $this->assertEquals(200, $this->entity->getStatusCode());
    }

    /** @test */
    public function createBatch()
    {
        $response = $this->endpoint->createBatch([
            $this->getData(),
            $this->getData(),
        ]);

        $this->assertEquals(200, $response->getStatusCode());

        sleep(1);

        $this->endpoint->deleteBatch(array_map(function ($product) {
            return $product->objectId;
        }, array_values($response->getData())));
    }

    /** @test */
    public function update()
    {
        $response = $this->endpoint->update($this->entity->objectId, [
            ['name' => 'name', 'value' => 'An updated product'],
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function updateBatch()
    {
        $product = $this->createEntity();

        $response = $this->endpoint->updateBatch([
            [
                'objectId' => $this->entity->objectId,
                'properties' => [
                    [
                        'name' => 'price',
                        'value' => 85.00,
                    ],
                    [
                        'name' => 'description',
                        'value' => 'This is an updated product, it\'s getting a price change.',
                    ],
                ],
            ],
            [
                'objectId' => $product->objectId,
                'properties' => [
                    [
                        'name' => 'description',
                        'value' => 'Updated product name now with discount',
                    ],
                    [
                        'name' => 'discount',
                        'value' => 20,
                    ],
                ],
            ],
        ]);

        $this->assertEquals(200, $response->getStatusCode());

        $this->endpoint->delete($product->objectId);
    }

    /** @test */
    public function delete()
    {
        $response = $this->deleteEntity();

        $this->assertEquals(204, $response->getStatusCode());

        $this->entity = null;
    }

    /** @test */
    public function deleteBatch()
    {
        $response = $this->endpoint->createBatch([
            $this->getData(),
            $this->getData(),
        ]);

        sleep(1);

        $deleteResponse = $this->endpoint->deleteBatch(array_map(function ($product) {
            return $product->objectId;
        }, array_values($response->getData())));

        $this->assertEquals(204, $deleteResponse->getStatusCode());
    }

    /** @test */
    public function getProductChanges()
    {
        $response = $this->endpoint->getProductChanges();

        $this->assertEquals(200, $response->getStatusCode());
    }

    protected function createEntity()
    {
        return $this->endpoint->create($this->getData());
    }

    protected function deleteEntity()
    {
        return $this->endpoint->delete($this->entity->objectId);
    }
}
