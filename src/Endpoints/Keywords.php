<?php

namespace SevenShores\Hubspot\Endpoints;

class Keywords extends Endpoint
{
    /**
     * Get all keywords.
     *
     * @param string $search optional search query
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function all($search = null)
    {
        $endpoint = 'https://api.hubapi.com/keywords/v1/keywords';

        $queryString = build_query_string(['search' => $search]);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Get a keyword.
     *
     * @param string $keyword_guid
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getById($keyword_guid)
    {
        $endpoint = "https://api.hubapi.com/keywords/v1/keywords/{$keyword_guid}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Create a new keyword.
     *
     * @param array $keyword
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function create($keyword)
    {
        $endpoint = 'https://api.hubapi.com/keywords/v1/keywords';

        $options['json'] = $keyword;

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * Delete a keyword.
     *
     * @param string $keyword_guid
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function delete($keyword_guid)
    {
        $endpoint = "https://api.hubapi.com/keywords/v1/keywords/{$keyword_guid}";

        return $this->client->request('delete', $endpoint);
    }
}
