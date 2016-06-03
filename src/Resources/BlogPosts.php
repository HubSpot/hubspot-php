<?php

namespace SevenShores\Hubspot\Resources;

class BlogPosts extends Resource
{
    /**
     * Create a new blog post.
     *
     * @param  array $params Optional Parameters.
     * @return \SevenShores\Hubspot\Http\Response
     */
    function create($params = [])
    {
        $endpoint = 'https://api.hubapi.com/content/api/v2/blog-posts';

        $options['json'] = $params;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Get all blog posts.
     *
     * @param  array $params Optional parameters.
     * @return \SevenShores\Hubspot\Http\Response
     */
    function all($params = [])
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/blog-posts";

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Update a blog post.
     *
     * @param  int   $id     The blog post id.
     * @param  array $params The blog post fields to update.
     * @return \SevenShores\Hubspot\Http\Response
     */
    function update($id, $params = [])
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/blog-posts/{$id}";

        $options['json'] = $params;

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * Delete a blog post.
     *
     * @param  int $id
     * @return \SevenShores\Hubspot\Http\Response
     */
    function delete($id)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/blog-posts/{$id}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Get a specific blog post.
     *
     * @param  int $id
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getById($id)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/blog-posts/{$id}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Updates the auto-save buffer. Live objects will not be impacted.
     *
     * @see http://developers.hubspot.com/docs/methods/blogv2/put_blog_posts_blog_post_id_buffer
     *
     * @param  int   $id     The blog post ID.
     * @param  array $params Allowed parameters.
     * @return \SevenShores\Hubspot\Http\Response
     */
    function updateAutoSaveBuffer($id, $params = [])
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/blog-posts/{$id}/buffer";

        $options['json'] = $params;

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * Gets the current contents of the auto-save buffer.
     *
     * @param  int $id The blog post ID
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getAutoSaveBufferContents($id)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/blog-posts/{$id}/buffer";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Clone the blog post.
     *
     * @param  int $id The blog post ID
     * @return \SevenShores\Hubspot\Http\Response
     */
    function clonePost($id)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/blog-posts/{$id}/clone";

        return $this->client->request('post', $endpoint);
    }

    /**
     * Determine if the auto-save buffer differs from the live blog post.
     *
     * @param  int $id The blog post ID
     * @return \SevenShores\Hubspot\Http\Response
     */
    function hasBufferedChanges($id)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/blog-posts/{$id}/has-buffered-changes";

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
     * @param  int    $id     The blog post ID
     * @param  string $action The publish action
     * @return \SevenShores\Hubspot\Http\Response
     */
    function publishAction($id, $action)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/blog-posts/{$id}/publish-action";

        $options['json'] = ['action' => $action];

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Copies the contents of the auto-save buffer into the live blog post.
     *
     * @param  int $id The blog post ID
     * @return \SevenShores\Hubspot\Http\Response
     */
    function pushBufferLive($id)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/blog-posts/{$id}/push-buffer-live";

        return $this->client->request('post', $endpoint);
    }

    /**
     * Restores a previously deleted blog post.
     *
     * @param  int $id The blog post ID
     * @return \SevenShores\Hubspot\Http\Response
     */
    function restoreDeleted($id)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/blog-posts/{$id}/restore-deleted";

        return $this->client->request('post', $endpoint);
    }

    /**
     * Validates the auto-save buffer version of the blog post.
     *
     * @param  int $id The blog post ID
     * @return \SevenShores\Hubspot\Http\Response
     */
    function validateBuffer($id)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/blog-posts/{$id}/validate-buffer";

        return $this->client->request('post', $endpoint);
    }

    /**
     * List previous versions of the blog post.
     *
     * @param  int $id The blog post ID
     * @return \SevenShores\Hubspot\Http\Response
     */
    function versions($id)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/blog-posts/{$id}/versions";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Get a previous version of the blog post.
     *
     * @param int $post_id    The blog post ID
     * @param int $version_id The version ID
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getVersion($post_id, $version_id)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/blog-posts/{$post_id}/versions/{$version_id}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Restore a previous version of the blog post.
     *
     * @param int $post_id    The blog post ID
     * @param int $version_id The version ID
     * @return \SevenShores\Hubspot\Http\Response
     */
    function restoreVersion($post_id, $version_id)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/blog-posts/{$post_id}/versions/restore";

        $options['json'] = compact('version_id');

        return $this->client->request('post', $endpoint, $options);
    }
}
