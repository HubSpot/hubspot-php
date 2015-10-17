<?php

namespace Fungku\HubSpot\Api;

class Blogs extends Api
{
    /**
     * Get all blogs.
     *
     * @param array $params Optional parameters ['limit', 'offset', 'created', 'deleted_at', 'name']
     * @return \Fungku\HubSpot\Http\Response
     */
    public function all($params = [])
    {
        $endpoint = '/content/api/v2/blogs';

        $queryString = $this->buildQueryString($params);

        return $this->request('get', $endpoint, [], $queryString);
    }

    /**
     * Get information about a specific blog.
     *
     * @param string $id
     * @return \Fungku\HubSpot\Http\Response
     */
    public function getById($id)
    {
        $endpoint = "/content/api/v2/blogs/{$id}";

        return $this->request('get', $endpoint);
    }

    /**
     * Get previous versions of the blog.
     *
     * @param string $id     Blog id.
     * @return \Fungku\HubSpot\Http\Response
     */
    public function versions($id)
    {
        $endpoint = "/content/api/v2/blogs/{$id}/versions";

        return $this->request('get', $endpoint);
    }

    /**
     * Get a previous version of the blog.
     *
     * @param string $id         Blog id.
     * @param string $version_id Version id.
     * @return \Fungku\HubSpot\Http\Response
     */
    public function getVersion($id, $version_id)
    {
        $endpoint = "/content/api/v2/blogs/{$id}/versions/{$version_id}";

        return $this->request('get', $endpoint);
    }
}
