<?php

namespace Fungku\HubSpot\Api;

class Pages extends Api
{
    /**
     * Create a new page.
     *
     * @param array $params Optional Parameters.
     *
     * @return mixed
     */
    public function create($params)
    {
        $endpoint = '/content/api/v2/pages';

        $options['json'] = $params;

        return $this->request('post', $endpoint, $options);
    }

    /**
     * Get all pages.
     *
     * @param array $params Optional parameters.
     *
     * @return mixed
     */
    public function all($params )
    {
        $endpoint = "/content/api/v2/pages";

        $options['query'] = $this->getQuery($params);

        return $this->request('get', $endpoint, $options);
    }

    /**
     * Update a page.
     *
     * @param int   $page_id The page id.
     * @param array $params  The page fields to update.
     *
     * @return mixed
     */
    public function update($page_id, array $params)
    {
        $endpoint = "/content/api/v2/pages/{$page_id}";

        $options['json'] = $params;

        return $this->request('put', $endpoint, $options);
    }

    /**
     * Delete a page.
     *
     * @param int $page_id Page ID
     *
     * @return mixed
     */
    public function delete($page_id)
    {
        $endpoint = "/content/api/v2/pages/{$page_id}";

        return $this->request('delete', $endpoint);
    }

    /**
     * Get a specific page.
     *
     * @param int $page_id Page ID
     *
     * @return mixed
     */
    public function getById($page_id)
    {
        $endpoint = "/content/api/v2/pages/{$page_id}";

        return $this->request('get', $endpoint);
    }

    /**
     * Updates the auto-save buffer.
     *
     * @param in $page_id The page ID
     *
     * @return mixed
     */
    public function updateAutoSaveBuffer($page_id)
    {
        $endpoint = "/content/api/v2/pages/{$page_id}/buffer";

        return $this->request('put', $endpoint);
    }

    /**
     * Gets the current contents of the auto-save buffer.
     *
     * @param int $page_id The page ID
     *
     * @return mixed
     */
    public function getAutoSaveBufferContents($page_id)
    {
        $endpoint = "/content/api/v2/pages/{$page_id}/buffer";

        return $this->request('get', $endpoint);
    }

    /**
     * Clone the page.
     *
     * @param int $page_id The page ID
     *
     * @return mixed
     */
    public function clonePage($page_id)
    {
        $endpoint = "/content/api/v2/pages/{$page_id}/clone";

        return $this->request('post', $endpoint);
    }

    /**
     * Determine if the auto-save buffer differs from the live page.
     *
     * @param int $page_id The page ID
     *
     * @return mixed
     */
    public function hasBufferedChanges($page_id)
    {
        $endpoint = "/content/api/v2/pages/{$page_id}/has-buffered-changes";

        return $this->request('get', $endpoint);
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
     *
     * @return mixed
     */
    public function publishAction($page_id, $action)
    {
        $endpoint = "/content/api/v2/pages/{$page_id}/publish-action";

        $options['json'] = array('action' => $action);

        return $this->request('post', $endpoint, $options);
    }

    /**
     * Copies the contents of the auto-save buffer into the live page.
     *
     * @param int $page_id The page ID
     *
     * @return mixed
     */
    public function pushBufferLive($page_id)
    {
        $endpoint = "/content/api/v2/pages/{$page_id}/push-buffer-live";

        return $this->request('post', $endpoint);
    }

    /**
     * Restores a previously deleted page.
     *
     * @param int $page_id The page ID
     *
     * @return mixed
     */
    public function restoreDeleted($page_id)
    {
        $endpoint = "/content/api/v2/pages/{$page_id}/restore-deleted";

        return $this->request('post', $endpoint);
    }

    /**
     * Validates the auto-save buffer version of the page.
     *
     * @param int $page_id The page ID
     *
     * @return mixed
     */
    public function validateBuffer($page_id)
    {
        $endpoint = "/content/api/v2/pages/{$page_id}/validate-buffer";

        return $this->request('post', $endpoint);
    }

    /**
     * List previous versions of the page.
     *
     * @param int $page_id The page ID
     *
     * @return mixed
     */
    public function versions($page_id)
    {
        $endpoint = "/content/api/v2/pages/{$page_id}/versions";

        return $this->request('get', $endpoint);
    }

    /**
     * Restore a previous version of the page.
     *
     * @param int $page_id    The page ID
     * @param int $version_id The version ID
     *
     * @return mixed
     */
    public function restoreVersion($page_id, $version_id)
    {
        $endpoint = "/content/api/v2/pages/{$page_id}/versions/restore";

        $options['json'] = compact('version_id');

        return $this->request('post', $endpoint, $options);
    }
}
