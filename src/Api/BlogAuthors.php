<?php

namespace Fungku\HubSpot\Api;

class BlogAuthors extends Api
{
    /**
     * Create a new blog author.
     *
     * @param  array $params Optional Parameters.
     * @return \Fungku\HubSpot\Http\Response
     */
    public function create($params = [])
    {
        $endpoint = '/blogs/v3/blog-authors';

        $options['json'] = $params;

        return $this->request('post', $endpoint, $options);
    }

    /**
     * Get all blog authors.
     *
     * @param  array $params Optional parameters.
     * @return \Fungku\HubSpot\Http\Response
     */
    public function all($params = [])
    {
        $endpoint = '/blogs/v3/blog-authors';

        $queryString = $this->buildQueryString($params);

        return $this->request('get', $endpoint, [], $queryString);
    }

    /**
     * Search blog authors.
     *
     * @param string $query     Search query
     * @param array $params     Optional parameters.
     * @return \Fungku\HubSpot\Http\Response
     */
    public function search($q = '', $params = [])
    {
        $endpoint = '/blogs/v3/blog-authors/search';

        $params['q'] = $q;

        $queryString = $this->buildQueryString($params);

        return $this->request('get', $endpoint, [], $queryString);
    }

    /**
     * Update a blog author.
     *
     * @param  int   $id     Unique identifier for a blog author.
     * @param  array $params Fields to update.
     * @return \Fungku\HubSpot\Http\Response
     */
    public function update($id, $params = [])
    {
        $endpoint = "/blogs/v3/blog-authors/{$id}";

        $options['json'] = $params;

        return $this->request('put', $endpoint, $options);
    }

    /**
     * Delete a blog author.
     *
     * @param  int $id  Unique identifier for the blog author to delete.
     * @return \Fungku\HubSpot\Http\Response
     */
    public function delete($id)
    {
        $endpoint = "/blogs/v3/blog-authors/{$id}";

        return $this->request('delete', $endpoint);
    }

    /**
     * Get a specific blog author.
     *
     * @param  int $id  Unique identifier for a blog author.
     * @return \Fungku\HubSpot\Http\Response
     */
    public function getById($id)
    {
        $endpoint = "/blogs/v3/blog-authors/{$id}";

        return $this->request('get', $endpoint);
    }

}
