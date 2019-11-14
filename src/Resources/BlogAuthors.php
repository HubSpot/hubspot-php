<?php

namespace SevenShores\Hubspot\Resources;

class BlogAuthors extends Resource
{
    /**
     * Create a new blog author.
     *
     * @param array $params optional Parameters
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function create($params = [])
    {
        $endpoint = 'https://api.hubapi.com/blogs/v3/blog-authors';

        $options['json'] = $params;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Get all blog authors.
     *
     * @param array $params optional parameters
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function all($params = [])
    {
        $endpoint = 'https://api.hubapi.com/blogs/v3/blog-authors';

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Search blog authors.
     *
     * @param string $q      Search query
     * @param array  $params optional parameters
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function search($q = '', $params = [])
    {
        $endpoint = 'https://api.hubapi.com/blogs/v3/blog-authors/search';

        $params['q'] = $q;

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Update a blog author.
     *
     * @param int   $id     unique identifier for a blog author
     * @param array $params fields to update
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function update($id, $params = [])
    {
        $endpoint = "https://api.hubapi.com/blogs/v3/blog-authors/{$id}";

        $options['json'] = $params;

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * Delete a blog author.
     *
     * @param int $id unique identifier for the blog author to delete
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function delete($id)
    {
        $endpoint = "https://api.hubapi.com/blogs/v3/blog-authors/{$id}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Get a specific blog author.
     *
     * @param int $id unique identifier for a blog author
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getById($id)
    {
        $endpoint = "https://api.hubapi.com/blogs/v3/blog-authors/{$id}";

        return $this->client->request('get', $endpoint);
    }
}
