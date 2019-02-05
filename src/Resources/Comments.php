<?php

namespace SevenShores\Hubspot\Resources;

class Comments extends Resource
{
    /**
     * Get all comments.
     *
     * @param array $params Optional parameters ['limit', 'offset', 'portalId', 'state', 'contentId', 'reverse']
     * @return \SevenShores\Hubspot\Http\Response
     */
    function all($params = [])
    {
        $endpoint = 'https://api.hubapi.com/comments/v3/comments';

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Get information about a specific comment.
     *
     * @param string $id
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getById($id)
    {
        $endpoint = "https://api.hubapi.com/comments/v3/comments/{$id}";

        return $this->client->request('get', $endpoint);
    }


}
