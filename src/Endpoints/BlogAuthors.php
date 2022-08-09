<?php

namespace SevenShores\Hubspot\Endpoints;

class BlogAuthors extends Endpoint
{
    /**
     * Get all blog authors.
     *
     * @param array $params optional parameters
     *
     * @see https://developers.hubspot.com/docs/methods/blog/v3/list-blog-authors
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function all(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/blogs/v3/blog-authors';

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Search blog authors.
     *
     * @param string $q      Search query
     * @param array  $params optional parameters
     *
     * @see https://developers.hubspot.com/docs/methods/blog/v3/search-blog-authors
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function search($q = '', array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/blogs/v3/blog-authors/search';

        $params['q'] = $q;

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Get a specific blog author.
     *
     * @param int $id unique identifier for a blog author
     *
     * @see https://developers.hubspot.com/docs/methods/blog/v3/get-blog-author-by-id
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getById($id, array $params = [])
    {
        $endpoint = "https://api.hubapi.com/blogs/v3/blog-authors/{$id}";

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Create a new blog author.
     *
     * @param array $options optional Parameters
     *
     * @see https://developers.hubspot.com/docs/methods/blog/v3/create-blog-author
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function create(array $options = [], array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/blogs/v3/blog-authors';

        return $this->client->request(
            'post',
            $endpoint,
            ['json' => $options],
            build_query_string($params)
        );
    }

    /**
     * Update a blog author.
     *
     * @param int   $id     unique identifier for a blog author
     * @param array $params fields to update
     *
     * @see https://developers.hubspot.com/docs/methods/blog/v3/update-blog-author
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function update($id, array $params = [])
    {
        $endpoint = "https://api.hubapi.com/blogs/v3/blog-authors/{$id}";

        return $this->client->request('put', $endpoint, ['json' => $params]);
    }

    /**
     * Delete a blog author.
     *
     * @param int $id unique identifier for the blog author to delete
     *
     * @see https://developers.hubspot.com/docs/methods/blog/v3/delete-blog-author
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function delete($id)
    {
        $endpoint = "https://api.hubapi.com/blogs/v3/blog-authors/{$id}";

        return $this->client->request('delete', $endpoint);
    }
}
