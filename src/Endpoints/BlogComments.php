<?php

namespace SevenShores\Hubspot\Endpoints;

class BlogComments extends Endpoint
{
    /**
     * Get all comments.
     *
     * @param array $params Optional parameters ['limit', 'offset', 'portalId', 'state', 'contentId', 'reverse']
     *
     * @see https://developers.hubspot.com/docs/methods/comments/get_comments
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function all(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/comments/v3/comments';

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Get information about a specific comment.
     *
     * @param mixed $id
     *
     * @see https://developers.hubspot.com/docs/methods/comments/get_comments_comment_id
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getById($id)
    {
        $endpoint = "https://api.hubapi.com/comments/v3/comments/{$id}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Create a new comment.
     *
     * @see https://developers.hubspot.com/docs/methods/comments/post_comments
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function create(array $properties)
    {
        $endpoint = 'https://api.hubapi.com/comments/v3/comments';

        return $this->client->request('post', $endpoint, ['json' => $properties]);
    }

    /**
     * Delete the comment.
     *
     * @param mixed $id
     *
     * @see https://developers.hubspot.com/docs/methods/comments/delete_comments_comment_id
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function delete($id)
    {
        $endpoint = "https://api.hubapi.com/comments/v3/comments/{$id}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Restores a previously deleted comment.
     *
     * @param mixed $id
     *
     * @see https://developers.hubspot.com/docs/methods/comments/post_comments_comment_id_restore_deleted
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function restore($id)
    {
        $endpoint = "https://api.hubapi.com/comments/v3/comments/{$id}/restore";

        return $this->client->request('post', $endpoint);
    }
}
