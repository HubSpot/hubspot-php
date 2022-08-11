<?php

namespace SevenShores\Hubspot\Endpoints;

/**
 * @see https://developers.hubspot.com/docs/methods/line-items/line-items-overview
 */
class LineItems extends Endpoint
{
    /**
     * Get all line items.
     *
     * @see https://developers.hubspot.com/docs/methods/line-items/get-all-line-items
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function all(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/crm-objects/v1/objects/line_items/paged';

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Get a line item by ID.
     *
     * @param int $id
     *
     * @see https://developers.hubspot.com/docs/methods/line-items/get_line_item_by_id
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getById($id, array $params = [])
    {
        $endpoint = "https://api.hubapi.com/crm-objects/v1/objects/line_items/{$id}";

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Get a group of line items by ID.
     *
     * @see https://developers.hubspot.com/docs/methods/line-items/batch-get-line-items
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getBatchByIds(array $ids, array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/crm-objects/v1/objects/line_items/batch-read';

        return $this->client->request(
            'post',
            $endpoint,
            ['json' => ['ids' => $ids]],
            build_query_string($params)
        );
    }

    /**
     * Create a line item.
     *
     * @see https://developers.hubspot.com/docs/methods/line-items/create-line-item
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function create(array $properties)
    {
        $endpoint = 'https://api.hubapi.com/crm-objects/v1/objects/line_items';

        return $this->client->request(
            'post',
            $endpoint,
            ['json' => $properties]
        );
    }

    /**
     * Create a group of line items.
     *
     * @see https://developers.hubspot.com/docs/methods/line-items/batch-create-line-items
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function createBatch(array $lineItems)
    {
        $endpoint = 'https://api.hubapi.com/crm-objects/v1/objects/line_items/batch-create';

        return $this->client->request(
            'post',
            $endpoint,
            ['json' => $lineItems]
        );
    }

    /**
     * Update a line item.
     *
     * @param int $id
     *
     * @see https://developers.hubspot.com/docs/methods/line-items/update-line-item
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function update($id, array $properties)
    {
        $endpoint = "https://api.hubapi.com/crm-objects/v1/objects/line_items/{$id}";

        return $this->client->request(
            'put',
            $endpoint,
            ['json' => $properties]
        );
    }

    /**
     * Update a group of line items.
     *
     * @see https://developers.hubspot.com/docs/methods/line-items/batch-update-line-items
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function updateBatch(array $lineItems)
    {
        $endpoint = 'https://api.hubapi.com/crm-objects/v1/objects/line_items/batch-update';

        return $this->client->request(
            'post',
            $endpoint,
            ['json' => $lineItems]
        );
    }

    /**
     * Delete a line item.
     *
     * @param int $id
     *
     * @see https://developers.hubspot.com/docs/methods/line-items/delete-line-item
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function delete($id)
    {
        $endpoint = "https://api.hubapi.com/crm-objects/v1/objects/line_items/{$id}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Delete a group of line items.
     *
     * @see https://developers.hubspot.com/docs/methods/line-items/batch-delete-line-items
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function deleteBatch(array $ids)
    {
        $endpoint = 'https://api.hubapi.com/crm-objects/v1/objects/line_items/batch-delete';

        return $this->client->request(
            'post',
            $endpoint,
            ['json' => ['ids' => $ids]]
        );
    }

    /**
     * Get a log of changes for line items.
     *
     * @see https://developers.hubspot.com/docs/methods/line-items/get-line-item-changes
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getLineItemChanges(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/crm-objects/v1/change-log/line_items';

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }
}
