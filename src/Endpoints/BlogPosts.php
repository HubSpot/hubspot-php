<?php

namespace SevenShores\Hubspot\Endpoints;

class BlogPosts extends Endpoint
{
    /**
     * Get all blog posts.
     *
     * @param array $params optional parameters
     *
     * @see https://developers.hubspot.com/docs/methods/blogv2/get_blog_posts
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function all(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/content/api/v2/blog-posts';

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Get a blog post by ID.
     *
     * @param mixed $id
     *
     * @see https://developers.hubspot.com/docs/methods/blogv2/get_blog_posts_blog_post_id
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getById($id)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/blog-posts/{$id}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Create a new blog post.
     *
     * @param array $fields a blog post fields to create
     *
     * @see https://developers.hubspot.com/docs/methods/blogv2/post_blog_posts
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function create(array $fields = [])
    {
        $endpoint = 'https://api.hubapi.com/content/api/v2/blog-posts';

        return $this->client->request('post', $endpoint, ['json' => $fields]);
    }

    /**
     * Update a blog post.
     *
     * @param int   $id     the blog post id
     * @param array $fields the blog post fields to update
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function update($id, array $fields = [])
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/blog-posts/{$id}";

        $options['json'] = $fields;

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * Delete a blog post.
     *
     * @param mixed $id
     *
     * @see https://developers.hubspot.com/docs/methods/blogv2/delete_blog_posts_blog_post_id
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function delete($id)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/blog-posts/{$id}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Clone the blog post.
     * Requires including a request body of {"name": "New Page Name"}.
     *
     * @param mixed  $id   The blog post ID
     * @param string $name The cloned post name
     *
     * @see https://developers.hubspot.com/docs/methods/blogv2/post_blog_posts_blog_post_id_clone
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function clone($id, string $name)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/blog-posts/{$id}/clone";

        return $this->client->request(
            'post',
            $endpoint,
            ['json' => ['name' => $name]]
        );
    }

    /**
     * Either publishes or cancels publishing based on the POSTed JSON.
     *
     * Allowable actions are: "schedule-publish", "cancel-publish".
     * "schedule-publish":  sets up the content for publishing at the publish_date already set on the post.
     * "cancel-publish": cancels a previously scheduled blog post publish.
     *
     * @param mixed  $id     The blog post ID
     * @param string $action The publish action
     *
     * @see https://developers.hubspot.com/docs/methods/blogv2/post_blog_posts_blog_post_id_publish_action
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function publishAction($id, string $action)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/blog-posts/{$id}/publish-action";

        return $this->client->request('post', $endpoint, ['json' => ['action' => $action]]);
    }

    /**
     * Gets the current contents of the auto-save buffer.
     *
     * @param mixed $id The blog post ID
     *
     * @see https://developers.hubspot.com/docs/methods/blogv2/get_blog_posts_blog_post_id_buffer
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getAutoSaveBufferContents($id)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/blog-posts/{$id}/buffer";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Updates the auto-save buffer. Live objects will not be impacted.
     *
     * @param mixed $id     the blog post ID
     * @param array $params allowed parameters
     *
     * @see https://developers.hubspot.com/docs/methods/blogv2/put_blog_posts_blog_post_id_buffer
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function updateAutoSaveBuffer($id, array $params = [])
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/blog-posts/{$id}/buffer";

        return $this->client->request('put', $endpoint, ['json' => $params]);
    }

    /**
     * Determine if the auto-save buffer differs from the live blog post.
     *
     * @param mixed $id The blog post ID
     *
     * @see https://developers.hubspot.com/docs/methods/blogv2/get_blog_posts_blog_post_id_has_buffered_changes
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function hasBufferedChanges($id)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/blog-posts/{$id}/has-buffered-changes";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Validates the auto-save buffer version of the blog post.
     *
     * @param mixed $id The blog post ID
     *
     * @see https://developers.hubspot.com/docs/methods/blogv2/post_blog_posts_blog_post_id_validate_buffer
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function validateBuffer($id)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/blog-posts/{$id}/validate-buffer";

        return $this->client->request('post', $endpoint);
    }

    /**
     * Copies the contents of the auto-save buffer into the live blog post.
     *
     * @param mixed $id The blog post ID
     *
     * @see https://developers.hubspot.com/docs/methods/blogv2/post_blog_posts_blog_post_id_push_buffer_live
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function pushBufferLive($id)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/blog-posts/{$id}/push-buffer-live";

        return $this->client->request('post', $endpoint);
    }

    /**
     * Restores a previously deleted blog post.
     *
     * @param mixed $id The blog post ID
     *
     * @see https://developers.hubspot.com/docs/methods/blogv2/post_blog_posts_blog_post_id_restore_deleted
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function restoreDeleted($id)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/blog-posts/{$id}/restore-deleted";

        return $this->client->request('put', $endpoint);
    }

    /**
     * List previous versions of the blog post.
     *
     * @param mixed $id The blog post ID
     *
     * @see https://developers.hubspot.com/docs/methods/blogv2/get_blog_posts_blog_post_id_versions
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function versions($id)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/blog-posts/{$id}/versions";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Get a previous version of the blog post.
     *
     * @param mixed $postId    The blog post ID
     * @param mixed $versionId The version ID
     *
     * @see https://developers.hubspot.com/docs/methods/blogv2/get_blog_posts_blog_post_id_versions_version_id
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getVersion($postId, $versionId)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/blog-posts/{$postId}/versions/{$versionId}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Restore a previous version of the blog post.
     *
     * @param mixed $postId    The blog post ID
     * @param mixed $versionId The version ID
     *
     * @see https://developers.hubspot.com/docs/methods/blogv2/post_blog_posts_blog_post_id_versions_restore
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function restoreVersion($postId, $versionId)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/blog-posts/{$postId}/versions/restore";

        return $this->client->request(
            'post',
            $endpoint,
            ['json' => ['version_id' => $versionId]]
        );
    }
}
