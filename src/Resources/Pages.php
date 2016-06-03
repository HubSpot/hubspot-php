<?php

namespace SevenShores\Hubspot\Resources;

class Pages extends Resource
{
    /**
     * Create a new page.
     *
     * @param array $params Optional Parameters.
     * @return \SevenShores\Hubspot\Http\Response
     */
    function create($params)
    {
        $endpoint = 'https://api.hubapi.com/content/api/v2/pages';

        $options['json'] = $params;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Get all pages.
     *
     * @param array $params Optional parameters.
     * @return \SevenShores\Hubspot\Http\Response
     */
    function all($params = [])
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/pages";

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Update a page.
     *
     * @param int   $page_id The page id.
     * @param array $params  The page fields to update.
     * @return \SevenShores\Hubspot\Http\Response
     */
    function update($page_id, $params)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/pages/{$page_id}";

        $options['json'] = $params;

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * Delete a page.
     *
     * @param int $page_id
     * @return \SevenShores\Hubspot\Http\Response
     */
    function delete($page_id)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/pages/{$page_id}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Get a specific page.
     *
     * @param int $page_id
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getById($page_id)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/pages/{$page_id}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Updates the auto-save buffer.
     *
     * @param in $page_id The page ID
     * @return \SevenShores\Hubspot\Http\Response
     */
    function updateAutoSaveBuffer($page_id)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/pages/{$page_id}/buffer";

        return $this->client->request('put', $endpoint);
    }

    /**
     * Gets the current contents of the auto-save buffer.
     *
     * @param int $page_id The page ID
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getAutoSaveBufferContents($page_id)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/pages/{$page_id}/buffer";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Clone the page.
     *
     * @param int $page_id The page ID
     * @return \SevenShores\Hubspot\Http\Response
     */
    function clonePage($page_id)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/pages/{$page_id}/clone";

        return $this->client->request('post', $endpoint);
    }

    /**
     * Determine if the auto-save buffer differs from the live page.
     *
     * @param int $page_id The page ID
     * @return \SevenShores\Hubspot\Http\Response
     */
    function hasBufferedChanges($page_id)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/pages/{$page_id}/has-buffered-changes";

        return $this->client->request('get', $endpoint);
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
     * @param int    $page_id The page ID
     * @param string $action  The publish action
     * @return \SevenShores\Hubspot\Http\Response
     */
    function publishAction($page_id, $action)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/pages/{$page_id}/publish-action";

        $options['json'] = ['action' => $action];

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Copies the contents of the auto-save buffer into the live page.
     *
     * @param int $page_id The page ID
     * @return \SevenShores\Hubspot\Http\Response
     */
    function pushBufferLive($page_id)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/pages/{$page_id}/push-buffer-live";

        return $this->client->request('post', $endpoint);
    }

    /**
     * Restores a previously deleted page.
     *
     * @param int $page_id The page ID
     * @return \SevenShores\Hubspot\Http\Response
     */
    function restoreDeleted($page_id)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/pages/{$page_id}/restore-deleted";

        return $this->client->request('post', $endpoint);
    }

    /**
     * Validates the auto-save buffer version of the page.
     *
     * @param int $page_id The page ID
     * @return \SevenShores\Hubspot\Http\Response
     */
    function validateBuffer($page_id)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/pages/{$page_id}/validate-buffer";

        return $this->client->request('post', $endpoint);
    }

    /**
     * List previous versions of the page.
     *
     * @param int $page_id The page ID
     * @return \SevenShores\Hubspot\Http\Response
     */
    function versions($page_id)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/pages/{$page_id}/versions";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Restore a previous version of the page.
     *
     * @param int $page_id    The page ID
     * @param int $version_id The version ID
     * @return \SevenShores\Hubspot\Http\Response
     */
    function restoreVersion($page_id, $version_id)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/pages/{$page_id}/versions/restore";

        $options['json'] = compact('version_id');

        return $this->client->request('post', $endpoint, $options);
    }
}
