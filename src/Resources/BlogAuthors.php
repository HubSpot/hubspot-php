<?php

namespace SevenShores\Hubspot\Resources;

class BlogAuthors extends Resource
{
    /**
     * Create a new blog author.
     *
     * @param  array $params Optional Parameters.
     * @return \SevenShores\Hubspot\Http\Response
     */
    function create($params = [])
    {
        $endpoint = 'https://api.hubapi.com/blogs/v3/blog-authors';

        $options['json'] = $params;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Get all blog authors.
     *
     * @param  array $params Optional parameters.
     * @return \SevenShores\Hubspot\Http\Response
     */
    function all($params = [])
    {
        $endpoint = 'https://api.hubapi.com/blogs/v3/blog-authors';

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Search blog authors.
     *
     * @param string $q         Search query
     * @param array $params     Optional parameters.
     * @return \SevenShores\Hubspot\Http\Response
     */
    function search($q = '', $params = [])
    {
        $endpoint = 'https://api.hubapi.com/blogs/v3/blog-authors/search';

        $params['q'] = $q;

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Update a blog author.
     *
     * @param  int   $id     Unique identifier for a blog author.
     * @param  array $params Fields to update.
     * @return \SevenShores\Hubspot\Http\Response
     */
    function update($id, $params = [])
    {
        $endpoint = "https://api.hubapi.com/blogs/v3/blog-authors/{$id}";

        $options['json'] = $params;

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * Delete a blog author.
     *
     * @param  int $id  Unique identifier for the blog author to delete.
     * @return \SevenShores\Hubspot\Http\Response
     */
    function delete($id)
    {
        $endpoint = "https://api.hubapi.com/blogs/v3/blog-authors/{$id}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Get a specific blog author.
     *
     * @param  int $id  Unique identifier for a blog author.
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getById($id)
    {
        $endpoint = "https://api.hubapi.com/blogs/v3/blog-authors/{$id}";

        return $this->client->request('get', $endpoint);
    }

}
