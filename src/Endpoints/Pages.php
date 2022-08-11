<?php

namespace SevenShores\Hubspot\Endpoints;

class Pages extends Endpoint
{
    /**
     * Create a new page.
     *
     * @param array $params optional Parameters
     *
     * @see https://legacydocs.hubspot.com/docs/methods/pages/post_pages
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function create(array $params)
    {
        $endpoint = 'https://api.hubapi.com/content/api/v2/pages';

        return $this->client->request('post', $endpoint, ['json' => $params]);
    }

    /**
     * Get all pages.
     *
     * @param array $params optional parameters
     *
     * @see https://legacydocs.hubspot.com/docs/methods/pages/get_pages
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function all(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/content/api/v2/pages';

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Update a page.
     *
     * @param int   $pageId the page id
     * @param array $params the page fields to update
     *
     * @see https://legacydocs.hubspot.com/docs/methods/pages/put_pages_page_id
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function update($pageId, array $params)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/pages/{$pageId}";

        return $this->client->request('put', $endpoint, ['json' => $params]);
    }

    /**
     * Delete a page.
     *
     * @param int $pageId
     *
     * @see https://legacydocs.hubspot.com/docs/methods/pages/delete_pages_page_id
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function delete($pageId)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/pages/{$pageId}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Get a Page by ID.
     *
     * @param int $pageId
     *
     * @see https://legacydocs.hubspot.com/docs/methods/pages/get_pages_page_id
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getById($pageId)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/pages/{$pageId}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Clone the page.
     *
     * @param int    $pageId The page ID
     * @param string $name   The cloned page name
     *
     * @see https://legacydocs.hubspot.com/docs/methods/pages/post_pages_page_id_clone
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function clonePage($pageId, $name)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/pages/{$pageId}/clone";

        return $this->client->request('post', $endpoint, ['json' => ['name' => $name]]);
    }

    /**
     * Either publishes or cancels publishing based on the POSTed JSON.
     *
     * Allowable actions are: "push-buffer-live", "schedule-publish", "cancel-publish".
     * "push-buffer-live": copies the current contents of the auto-save buffer into the live object.
     * "schedule-publish": which pushes the buffer live and then sets up the content for publishing at
     *     the existing publish_date time.
     * "cancel-publish": cancels a previous schedule-publish action.
     *
     * @param int    $pageId The page ID
     * @param string $action The publish action
     *
     * @see https://legacydocs.hubspot.com/docs/methods/pages/post_pages_page_id_publish_action
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function publishAction($pageId, string $action)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/pages/{$pageId}/publish-action";

        return $this->client->request(
            'post',
            $endpoint,
            ['json' => ['action' => $action]]
        );
    }

    /**
     * Gets the current contents of the auto-save buffer.
     *
     * @param int $pageId The page ID
     *
     * @see https://legacydocs.hubspot.com/docs/methods/pages/get_pages_page_id_buffer
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getAutoSaveBufferContents($pageId)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/pages/{$pageId}/buffer";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Updates the auto-save buffer.
     *
     * @param int   $pageId The page ID
     * @param array $params the auto-save buffer fields to update
     *
     * @see https://legacydocs.hubspot.com/docs/methods/pages/put_pages_page_id_buffer
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function updateAutoSaveBuffer($pageId, array $params = [])
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/pages/{$pageId}/buffer";

        return $this->client->request('put', $endpoint, ['json' => $params]);
    }

    /**
     * Determine if the auto-save buffer differs from the live page.
     *
     * @param int $pageId The page ID
     *
     * @see https://legacydocs.hubspot.com/docs/methods/pages/get_pages_page_id_has_buffered_changes
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function hasBufferedChanges($pageId)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/pages/{$pageId}/has-buffered-changes";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Copies the contents of the auto-save buffer into the live page.
     *
     * @param int $pageId The page ID
     *
     * @see https://legacydocs.hubspot.com/docs/methods/pages/post_pages_page_id_push_buffer_live
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function pushBufferLive($pageId)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/pages/{$pageId}/push-buffer-live";

        return $this->client->request('post', $endpoint);
    }

    /**
     * Validates the auto-save buffer version of the page.
     *
     * @param int $pageId The page ID
     *
     * @see https://legacydocs.hubspot.com/docs/methods/pages/post_pages_page_id_validate_buffer
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function validateBuffer($pageId)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/pages/{$pageId}/validate-buffer";

        return $this->client->request('post', $endpoint);
    }

    /**
     * Restores a previously deleted page.
     *
     * @param int $pageId The page ID
     *
     * @see https://legacydocs.hubspot.com/docs/methods/pages/post_pages_page_id_restore_deleted
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function restoreDeleted($pageId)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/pages/{$pageId}/restore-deleted";

        return $this->client->request('post', $endpoint);
    }

    /**
     * List previous versions of the page.
     *
     * @param int $pageId The page ID
     *
     * @see https://legacydocs.hubspot.com/docs/methods/pages/get_pages_page_id_versions
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function versions($pageId)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/pages/{$pageId}/versions";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Restore a previous version of the page.
     *
     * @param int $pageId    The page ID
     * @param int $versionId The version ID
     *
     * @see https://legacydocs.hubspot.com/docs/methods/pages/post_pages_page_id_versions_restore
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function restoreVersion($pageId, $versionId)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/pages/{$pageId}/versions/restore";

        return $this->client->request(
            'post',
            $endpoint,
            ['json' => ['version_id' => $versionId]]
        );
    }
}
