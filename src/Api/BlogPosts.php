<?php

namespace Fungku\HubSpot\Api;

class BlogPosts extends Api
{
    /**
     * Create a new blog post.
     *
     * @param  array $params Optional Parameters.
     * @return \Fungku\HubSpot\Http\Response
     */
    public function create($params = [])
    {
        $endpoint = '/content/api/v2/blog-posts';

        $options['json'] = $params;

        return $this->request('post', $endpoint, $options);
    }

    /**
     * Get all blog posts.
     *
     * @param  array $params Optional parameters.
     * @return \Fungku\HubSpot\Http\Response
     */
    public function all($params = [])
    {
        $endpoint = "/content/api/v2/blog-posts";

        $queryString = $this->buildQueryString($params);

        return $this->request('get', $endpoint, [], $queryString);
    }

    /**
     * Update a blog post.
     *
     * @param  int   $id     The blog post id.
     * @param  array $params The blog post fields to update.
     * @return \Fungku\HubSpot\Http\Response
     */
    public function update($id, $params = [])
    {
        $endpoint = "/content/api/v2/blog-posts/{$id}";

        $options['json'] = $params;

        return $this->request('put', $endpoint, $options);
    }

    /**
     * Delete a blog post.
     *
     * @param  int $id
     * @return \Fungku\HubSpot\Http\Response
     */
    public function delete($id)
    {
        $endpoint = "/content/api/v2/blog-posts/{$id}";

        return $this->request('delete', $endpoint);
    }

    /**
     * Get a specific blog post.
     *
     * @param  int $id
     * @return \Fungku\HubSpot\Http\Response
     */
    public function getById($id)
    {
        $endpoint = "/content/api/v2/blog-posts/{$id}";

        return $this->request('get', $endpoint);
    }

    /**
     * Updates the auto-save buffer.
     *
     * @param  int $id The blog post ID
     * @return \Fungku\HubSpot\Http\Response
     */
    public function updateAutoSaveBuffer($id)
    {
        $endpoint = "/content/api/v2/blog-posts/{$id}/buffer";

        return $this->request('put', $endpoint);
    }

    /**
     * Gets the current contents of the auto-save buffer.
     *
     * @param  int $id The blog post ID
     * @return \Fungku\HubSpot\Http\Response
     */
    public function getAutoSaveBufferContents($id)
    {
        $endpoint = "/content/api/v2/blog-posts/{$id}/buffer";

        return $this->request('get', $endpoint);
    }

    /**
     * Clone the blog post.
     *
     * @param  int $id The blog post ID
     * @return \Fungku\HubSpot\Http\Response
     */
    public function clonePost($id)
    {
        $endpoint = "/content/api/v2/blog-posts/{$id}/clone";

        return $this->request('post', $endpoint);
    }

    /**
     * Determine if the auto-save buffer differs from the live blog post.
     *
     * @param  int $id The blog post ID
     * @return \Fungku\HubSpot\Http\Response
     */
    public function hasBufferedChanges($id)
    {
        $endpoint = "/content/api/v2/blog-posts/{$id}/has-buffered-changes";

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
     * @param  int    $id     The blog post ID
     * @param  string $action The publish action
     * @return \Fungku\HubSpot\Http\Response
     */
    public function publishAction($id, $action)
    {
        $endpoint = "/content/api/v2/blog-posts/{$id}/publish-action";

        $options['json'] = ['action' => $action];

        return $this->request('post', $endpoint, $options);
    }

    /**
     * Copies the contents of the auto-save buffer into the live blog post.
     *
     * @param  int $id The blog post ID
     * @return \Fungku\HubSpot\Http\Response
     */
    public function pushBufferLive($id)
    {
        $endpoint = "/content/api/v2/blog-posts/{$id}/push-buffer-live";

        return $this->request('post', $endpoint);
    }

    /**
     * Restores a previously deleted blog post.
     *
     * @param  int $id The blog post ID
     * @return \Fungku\HubSpot\Http\Response
     */
    public function restoreDeleted($id)
    {
        $endpoint = "/content/api/v2/blog-posts/{$id}/restore-deleted";

        return $this->request('post', $endpoint);
    }

    /**
     * Validates the auto-save buffer version of the blog post.
     *
     * @param  int $id The blog post ID
     * @return \Fungku\HubSpot\Http\Response
     */
    public function validateBuffer($id)
    {
        $endpoint = "/content/api/v2/blog-posts/{$id}/validate-buffer";

        return $this->request('post', $endpoint);
    }

    /**
     * List previous versions of the blog post.
     *
     * @param  int $id The blog post ID
     * @return \Fungku\HubSpot\Http\Response
     */
    public function versions($id)
    {
        $endpoint = "/content/api/v2/blog-posts/{$id}/versions";

        return $this->request('get', $endpoint);
    }

    /**
     * Get a previous version of the blog post.
     *
     * @param int $post_id    The blog post ID
     * @param int $version_id The version ID
     * @return \Fungku\HubSpot\Http\Response
     */
    public function getVersion($post_id, $version_id)
    {
        $endpoint = "/content/api/v2/blog-posts/{$post_id}/versions/{$version_id}";

        return $this->request('get', $endpoint);
    }

    /**
     * Restore a previous version of the blog post.
     *
     * @param int $post_id    The blog post ID
     * @param int $version_id The version ID
     * @return \Fungku\HubSpot\Http\Response
     */
    public function restoreVersion($post_id, $version_id)
    {
        $endpoint = "/content/api/v2/blog-posts/{$post_id}/versions/restore";

        $options['json'] = compact('version_id');

        return $this->request('post', $endpoint, $options);
    }
}
