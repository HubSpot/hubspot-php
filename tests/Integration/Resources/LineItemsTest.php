<?php

namespace SevenShores\Hubspot\Tests\Integration\Resources;

use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\LineItems;
use SevenShores\Hubspot\Resources\Products;
use SevenShores\Hubspot\Tests\Integration\Abstraction\EntityTestCase;

/**
 * @internal
 * @coversNothing
 */
class LineItemsTest extends EntityTestCase
{
    use \SevenShores\Hubspot\Tests\Integration\Abstraction\ProductData { getData as getProductData; }

    /**
     * @var LineItems
     */
    protected $resource;

    /**
     * @var LineItems::class
     */
    protected $resourceClass = LineItems::class;

    /**
     * $var Products.
     */
    protected $resourceProducts;

    /**
     * $var \SevenShores\Hubspot\Http\Response.
     */
    protected $product;

    public function setUp()
    {
        $this->product = $this->createProduct();

        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();

        if (!empty($this->product)) {
            $this->deleteProduct();
        }
    }

    /** @test */
    public function all()
    {
        $response = $this->resource->all();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(1, count($response->objects));
    }

    /** @test */
    public function getById()
    {
        $response = $this->resource->getById($this->entity->objectId);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function getBatchByIds()
    {
        $lineItem = $this->createEntity();

        $ids = [
            $this->entity->objectId,
            $lineItem->objectId,
        ];

        $response = $this->resource->getBatchByIds($ids);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertCount(2, $response->toArray());

        $this->resource->delete($lineItem->objectId);
    }

    /** @test */
    public function create()
    {
        $this->assertEquals(200, $this->entity->getStatusCode());
    }

    /** @test */
    public function createBatch()
    {
        $response = $this->resource->createBatch([
            $this->getData(),
            $this->getData(),
        ]);

        $this->assertEquals(200, $response->getStatusCode());

        sleep(1);

        $this->resource->deleteBatch(array_map(function ($lineItem) {
            return $lineItem->objectId;
        }, array_values($response->getData())));
    }

    /** @test */
    public function update()
    {
        $response = $this->resource->update($this->entity->objectId, [
            ['name' => 'name', 'value' => 'An updated custom name for the product for this line item. Discounting 5% on bulk purchase.'],
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function updateBatch()
    {
        $lineItem = $this->createEntity();

        $response = $this->resource->updateBatch([
            [
                'objectId' => $this->entity->objectId,
                'properties' => [
                    [
                        'name' => 'price',
                        'value' => 55.00,
                    ],
                    [
                        'name' => 'description',
                        'value' => 'This is an updated description for this item, it\'s getting a price change.',
                    ],
                ],
            ],
            [
                'objectId' => $lineItem->objectId,
                'properties' => [
                    [
                        'name' => 'name',
                        'value' => 'Updated name, new quantity',
                    ],
                    [
                        'name' => 'quantity',
                        'value' => 20,
                    ],
                ],
            ],
        ]);

        $this->assertEquals(200, $response->getStatusCode());

        $this->resource->delete($lineItem->objectId);
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
        $response = $this->resource->createBatch([
            $this->getData(),
            $this->getData(),
        ]);

        sleep(1);

        $deleteResponse = $this->resource->deleteBatch(array_map(function ($lineItem) {
            return $lineItem->objectId;
        }, array_values($response->getData())));

        $this->assertEquals(204, $deleteResponse->getStatusCode());
    }

    /** @test */
    public function getLineItemChanges()
    {
        $response = $this->resource->getLineItemChanges();

        $this->assertEquals(200, $response->getStatusCode());
    }

    protected function createEntity()
    {
        return $this->resource->create($this->getData());
    }

    protected function deleteEntity()
    {
        return $this->resource->delete($this->entity->objectId);
    }

    protected function getData(): array
    {
        return [
            ['name' => 'hs_product_id', 'value' => $this->product->objectId],
            ['name' => 'quantity', 'value' => 50],
            ['name' => 'price',  'value' => 9.50],
            ['name' => 'name',  'value' => 'A custom name for the product for this line item. Discounting 5% on bulk purchase.'],
        ];
    }

    protected function getProducts()
    {
        if (empty($this->resourceProducts)) {
            $this->resourceProducts = new Products(new Client(['key' => getenv('HUBSPOT_TEST_API_KEY')]));
        }

        return $this->resourceProducts;
    }

    protected function createProduct()
    {
        return $this->getProducts()->create($this->getProductData());
    }

    protected function deleteProduct()
    {
        return $this->getProducts()->delete($this->product->objectId);
    }
}
