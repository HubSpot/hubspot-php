<?php

namespace SevenShores\Hubspot\Endpoints;

class Blogs extends Endpoint
{
    /**
     * Get all blogs.
     *
     * @param array $params Optional parameters ['limit', 'offset', 'created', 'deleted_at', 'name']
     *
     * @see https://developers.hubspot.com/docs/methods/blogv2/get_blogs
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function all(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/content/api/v2/blogs';

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Get information about a specific blog.
     *
     * @param int $id
     *
     * @see https://developers.hubspot.com/docs/methods/blogv2/get_blogs_blog_id
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getById($id)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/blogs/{$id}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Get previous versions of the blog.
     *
     * @param int $id blog id
     *
     * @see https://developers.hubspot.com/docs/methods/blogv2/get_blogs_blog_id_versions
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function versions($id)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/blogs/{$id}/versions";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Get a previous version of the blog.
     *
     * @param int $id         blog id
     * @param int $version_id version id
     *
     * @see https://developers.hubspot.com/docs/methods/blogv2/get_blogs_blog_id_versions_version_id
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getVersion($id, $version_id)
    {
        $endpoint = "https://api.hubapi.com/content/api/v2/blogs/{$id}/versions/{$version_id}";

        return $this->client->request('get', $endpoint);
    }
}
