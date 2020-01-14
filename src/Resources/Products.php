<?php

namespace SevenShores\Hubspot\Resources;

/**
 * @see https://developers.hubspot.com/docs/methods/products/products-overview
 */
class Products extends Resource
{
    /**
     * Get all products.
     *
     * @see https://developers.hubspot.com/docs/methods/products/get-all-products
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function all(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/crm-objects/v1/objects/products/paged';

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Get a product by ID.
     *
     * @param int $id
     *
     * @see https://developers.hubspot.com/docs/methods/products/get_product_by_id
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getById($id, array $params = [])
    {
        $endpoint = "https://api.hubapi.com/crm-objects/v1/objects/products/{$id}";

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Get a group of products by ID.
     *
     * @see https://developers.hubspot.com/docs/methods/products/batch-get-products
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getBatchByIds(array $ids, array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/crm-objects/v1/objects/products/batch-read';

        return $this->client->request(
            'post',
            $endpoint,
            ['json' => ['ids' => $ids]],
            build_query_string($params)
        );
    }

    /**
     * Create a product.
     *
     * @see https://developers.hubspot.com/docs/methods/products/create-product
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function create(array $properties)
    {
        $endpoint = 'https://api.hubapi.com/crm-objects/v1/objects/products';

        return $this->client->request(
            'post',
            $endpoint,
            ['json' => $properties]
        );
    }

    /**
     * Create a group of products.
     *
     * @see https://developers.hubspot.com/docs/methods/products/batch-create-products
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function createBatch(array $contacts)
    {
        $endpoint = 'https://api.hubapi.com/crm-objects/v1/objects/products/batch-create';

        return $this->client->request(
            'post',
            $endpoint,
            ['json' => $contacts]
        );
    }

    /**
     * Update a product.
     *
     * @param int $id
     *
     * @see https://developers.hubspot.com/docs/methods/products/update-products
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function update($id, array $properties)
    {
        $endpoint = "https://api.hubapi.com/crm-objects/v1/objects/products/{$id}";

        return $this->client->request(
            'put',
            $endpoint,
            ['json' => $properties]
        );
    }

    /**
     * Update a group of products.
     *
     * @see https://developers.hubspot.com/docs/methods/products/batch-update-products
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function updateBatch(array $products)
    {
        $endpoint = 'https://api.hubapi.com/crm-objects/v1/objects/products/batch-update';

        return $this->client->request(
            'post',
            $endpoint,
            ['json' => $products]
        );
    }

    /**
     * Delete a product.
     *
     * @param int $id
     *
     * @see https://developers.hubspot.com/docs/methods/products/delete-product
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function delete($id)
    {
        $endpoint = "https://api.hubapi.com/crm-objects/v1/objects/products/{$id}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Delete a group of products.
     *
     * @see https://developers.hubspot.com/docs/methods/products/batch-delete-products
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function deleteBatch(array $ids)
    {
        $endpoint = 'https://api.hubapi.com/crm-objects/v1/objects/products/batch-delete';

        return $this->client->request(
            'post',
            $endpoint,
            ['json' => ['ids' => $ids]]
        );
    }

    /**
     * Get a log of changes for products.
     *
     * @see https://developers.hubspot.com/docs/methods/products/get-product-changes
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getProductChanges(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/crm-objects/v1/change-log/products';

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }
}
