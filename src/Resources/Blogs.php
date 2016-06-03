<?php

namespace SevenShores\Hubspot\Resources;

class Blogs extends Resource
{
    /**
     * Get all blogs.
     *
     * @param array $params Optional parameters ['limit', 'offset', 'created', 'deleted_at', 'name']
     * @return \SevenShores\Hubspot\Http\Response
     */
    function all($params = [])
    {
        $endpoint = 'https://api.hubapi.com/content/api/v2/blogs';

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Get information about a specific blog.
     *
     * @param string $id
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getById($id)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/blogs/{$id}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Get previous versions of the blog.
     *
     * @param string $id     Blog id.
     * @return \SevenShores\Hubspot\Http\Response
     */
    function versions($id)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/blogs/{$id}/versions";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Get a previous version of the blog.
     *
     * @param string $id         Blog id.
     * @param string $version_id Version id.
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getVersion($id, $version_id)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/blogs/{$id}/versions/{$version_id}";

        return $this->client->request('get', $endpoint);
    }
}
