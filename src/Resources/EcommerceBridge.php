<?php

namespace SevenShores\Hubspot\Resources;

/**
 * Ecommerce Bridge.
 *
 * @see https://developers.hubspot.com/docs/methods/ecomm-bridge/v2/ecommerce-bridge-overview
 */
class EcommerceBridge extends Resource
{
    /**
     * Create or update ecommerce settings.
     *
     * @see https://developers.hubspot.com/docs/methods/ecommerce/v2/upsert-settings
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function upsertSettings(array $settings = [], array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/extensions/ecomm/v2/settings';

        return $this->client->request(
            'put',
            $endpoint,
            ['json' => $settings],
            build_query_string($params)
        );
    }

    /**
     * Get Ecommerce Settings.
     *
     * @see https://developers.hubspot.com/docs/methods/ecommerce/v2/get-settings
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getSettings(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/extensions/ecomm/v2/settings';

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Delete ecommerce settings.
     * Note: This action cannot be undone. If you want to disable sync messages from being applied, it is recommended that you disable the settings rather than deleting them.
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function deleteSettings(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/extensions/ecomm/v2/settings';

        return $this->client->request(
            'delete',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Create or update a store.
     *
     * @see https://developers.hubspot.com/docs/methods/ecomm-bridge/v2/create-or-update-store
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function createOrUpdateStore(array $store = [])
    {
        $endpoint = 'https://api.hubapi.com/extensions/ecomm/v2/stores';

        return $this->client->request('put', $endpoint, ['json' => $store]);
    }

    /**
     * Get all stores.
     *
     * @see https://developers.hubspot.com/docs/methods/ecomm-bridge/v2/get-all-stores
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function allStores()
    {
        $endpoint = 'https://api.hubapi.com/extensions/ecomm/v2/stores';

        return $this->client->request('get', $endpoint);
    }

    /**
     * Get a store.
     *
     * @see https://developers.hubspot.com/docs/methods/ecomm-bridge/v2/get-a-store
     *
     * @param string $storeId
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getStore($storeId)
    {
        $endpoint = "https://api.hubapi.com/extensions/ecomm/v2/stores/{$storeId}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Send a group of sync messages for a specific object type. Sync messages would be notifications of creates, updates, or deletes of ecommerce objects.
     *
     * @param string $storeId
     * @param string $objectType - The object type that the updates are for. One of CONTACT, DEAL, PRODUCT, or LINE_ITEM.
     *
     * @see https://developers.hubspot.com/docs/methods/ecommerce/v2/send-sync-messages
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function sendSyncMessages($storeId, $objectType, array $messages = [])
    {
        $endpoint = 'https://api.hubapi.com/extensions/ecomm/v2/sync/messages';

        $options = ['json' => [
            'storeId' => $storeId,
            'objectType' => $objectType,
            'messages' => $messages,
        ],
        ];

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * Get all sync errors for an app.
     *
     * @param int $appId
     *
     * @see https://developers.hubspot.com/docs/methods/ecommerce/v2/get-all-sync-errors-for-an-app
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getAllSyncErrorsForApp($appId, array $params = [])
    {
        $endpoint = "https://api.hubapi.com/extensions/ecomm/v2/sync/errors/app/{$appId}";

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Get all sync errors for a specific account.
     *
     * @see https://developers.hubspot.com/docs/methods/ecommerce/v2/get-all-sync-errors-for-a-specific-account
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getAllSyncErrorsAccount(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/extensions/ecomm/v2/sync/errors/portal';

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Get all sync errors for a specific account from a specific app.
     *
     * @see https://developers.hubspot.com/docs/methods/ecommerce/v2/get-all-sync-errors-for-an-app-and-account
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getAllSyncErrorsForAppAndAccount(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/extensions/ecomm/v2/sync/errors';

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Check the sync status of an object.
     *
     * @param string $storeId
     * @param string $objectType       - The object type that the updates are for. One of CONTACT, DEAL, PRODUCT, or LINE_ITEM.
     * @param int    $externalObjectId
     *
     * @see https://developers.hubspot.com/docs/methods/ecommerce/v2/check-sync-status
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function checkSyncStatus($storeId, $objectType, $externalObjectId)
    {
        $endpoint = "https://api.hubapi.com/extensions/ecomm/v2/sync/status/{$storeId}/{$objectType}/{$externalObjectId}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Import ecommerce data.
     *
     * @param int    $importStartedAt - Timestamp from the webhook when the customer requested imported in HubSpot UI
     * @param int    $pageNumber      - Integer starting at zero of the page number for that objectType
     * @param array  $messages        - Array of sync messages for this page of imports. Up to 200 messages can be included.
     * @param string $storeId         - The key of the store for this import
     * @param string $objectType      - The HubSpot object this page of imports is for. Must be one of CONTACT, DEAL, LINE_ITEM or PRODUCT.
     *
     * @see https://developers.hubspot.com/docs/methods/ecommerce/v2/import-data
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function importData($importStartedAt, $pageNumber, array $messages, $storeId, $objectType)
    {
        $endpoint = 'https://api.hubapi.com/extensions/ecomm/v2/imports/page';

        $options = [
            'json' => [
                'importStartedAt' => $importStartedAt,
                'pageNumber' => $pageNumber,
                'messages' => $messages,
                'storeId' => $storeId,
                'objectType' => $objectType,
            ],
        ];

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Signal End of an Import.
     *
     * @see https://developers.hubspot.com/docs/methods/ecommerce/v2/end-import
     *
     * @param int    $importStartedAt - Timestamp from the webhook when the customer requested imported in HubSpot UI
     * @param int    $pageCount       - The total number of pages imported for this objectType
     * @param int    $itemCount       - The total number of messages for this objecType
     * @param string $storeId         - The key of the store for this import
     * @param string $objectType      - The HubSpot object this page of imports is for. Must be one of CONTACT, DEAL, LINE_ITEM or PRODUCT
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function signalImportEnd($importStartedAt, $pageCount, $itemCount, $storeId, $objectType)
    {
        $endpoint = 'https://api.hubapi.com/extensions/ecomm/v2/imports/end';

        $options['json'] = [
            'importStartedAt' => $importStartedAt,
            'pageCount' => $pageCount,
            'itemCount' => $itemCount,
            'storeId' => $storeId,
            'objectType' => $objectType,
        ];

        return $this->client->request('post', $endpoint, $options);
    }
}
