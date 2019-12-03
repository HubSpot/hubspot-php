<?php

namespace SevenShores\Hubspot\Resources;

class EcommerceBridge extends Resource
{
    /**
     * Installs the ecommerce bridge into a portal.
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @return \SevenShores\Hubspot\Http\Response
     *
     * @see https://developers.hubspot.com/docs/methods/ecommerce/install-settings
     */
    public function install()
    {
        $endpoint = 'https://api.hubapi.com/extensions/ecomm/v1/installs';

        return $this->client->request('post', $endpoint);
    }

    /**
     * Check the status of the ecommerce bridge.
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function checkInstall()
    {
        $endpoint = 'https://api.hubapi.com/extensions/ecomm/v1/installs/status';

        return $this->client->request('get', $endpoint);
    }

    /**
     * Uninstall the ecommerce settings from a portal.
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function uninstall()
    {
        $endpoint = 'https://api.hubapi.com/extensions/ecomm/v1/installs/uninstall';

        return $this->client->request('post', $endpoint);
    }

    /**
     * Create or update the ecommerce settings.
     *
     * @param array $settings
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function upsertSettings($settings = [])
    {
        $endpoint = 'https://api.hubapi.com/extensions/ecomm/v1/settings';

        $options['json'] = $settings;

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * Delete the ecommerce settings for your app or portal.
     * Note: This action cannot be undone. If you want to disable sync messages from being applied, it is recommended that you disable the settings rather than deleting them.
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function deleteSettings()
    {
        $endpoint = 'https://api.hubapi.com/extensions/ecomm/v1/settings';

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Send a group of sync messages for a specific object type. Sync messages would be notifications of creates, updates, or deletes of ecommerce objects.
     *
     * @param string $objectType - The object type that the updates are for. One of CONTACT, DEAL, PRODUCT, or LINE_ITEM.
     * @param array  $messages
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function sendSyncMessages($objectType, $messages = [])
    {
        $endpoint = "https://api.hubapi.com/extensions/ecomm/v1/sync-messages/{$objectType}";

        $options['json'] = $messages;

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * Get errors from previously processed sync messages.
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getSyncErrors()
    {
        $endpoint = 'https://api.hubapi.com/extensions/ecomm/v1/sync-errors';

        return $this->client->request('get', $endpoint);
    }

    /**
     * Set the URI for the import initialization webhook.
     *
     * @param string $importTriggerUri - The URI that will be hit with the import webhook
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function setImportUri($importTriggerUri)
    {
        $endpoint = 'https://api.hubapi.com/extensions/ecomm/v1/import-settings';

        $options['json'] = [
            'importTriggerUri' => $importTriggerUri,
        ];

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * Retrieve the ecommerce import settings for an app.
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getImportSettings()
    {
        $endpoint = 'https://api.hubapi.com/extensions/ecomm/v1/import-settings';

        return $this->client->request('get', $endpoint);
    }

    /**
     * @param int    $importStartedAt - Timestamp from the import initialization request
     * @param string $objectType      - The object type this data corresponds to. Must be one of CONTACT, DEAL, LINE_ITEM, or PRODUCT.
     * @param int    $pageNumber      - A numeric page number that identifies this page of data
     * @param array  $messages        - The import messages
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function importObjects($importStartedAt, $objectType, $pageNumber, $messages)
    {
        $endpoint = "https://api.hubapi.com/import-pages/{$importStartedAt}/{$objectType}/{$pageNumber}";

        $options['json'] = $messages;

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * @param int    $importStartedAt - Timestamp from the import initialization request
     * @param string $objectType      - The object type this data corresponds to. Must be one of CONTACT, DEAL, LINE_ITEM, or PRODUCT.
     * @param int    $pageCount       - The total number of pages sent via the import pages endpoint
     * @param int    $itemCount       - The total number of items sent via the import pages endpoint
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function signalImportEnd($importStartedAt, $objectType, $pageCount, $itemCount)
    {
        $endpoint = "https://api.hubapi.com/import-pages/{$importStartedAt}/{$objectType}/end";

        $options['json'] = [
            'pageCount' => $pageCount,
            'itemCount' => $itemCount,
        ];

        return $this->client->request('put', $endpoint, $options);
    }
}
