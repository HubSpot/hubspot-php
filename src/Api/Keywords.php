<?php

namespace Fungku\HubSpot\Api;

class Keywords extends Api
{
    /**
     * Get all keywords.
     *
     * @param string $search Optional search query.
     * @return \Fungku\HubSpot\Http\Response
     */
    public function all($search = null)
    {
        $endpoint = '/keywords/v1/keywords';

        $queryString = $this->buildQueryString(['search' => $search]);

        return $this->request('get', $endpoint, [], $queryString);
    }

    /**
     * Get a keyword.
     *
     * @param string $keyword_guid
     * @return \Fungku\HubSpot\Http\Response
     */
    public function getById($keyword_guid)
    {
        $endpoint = "/keywords/v1/keywords/{$keyword_guid}";

        return $this->request('get', $endpoint);
    }

    /**
     * Create a new keyword.
     *
     * @param array $keyword
     * @return \Fungku\HubSpot\Http\Response
     */
    public function create($keyword)
    {
        $endpoint = "/keywords/v1/keywords";

        $options['json'] = $keyword;

        return $this->request('put', $endpoint, $options);
    }

    /**
     * Delete a keyword.
     *
     * @param string $keyword_guid
     * @return \Fungku\HubSpot\Http\Response
     */
    public function delete($keyword_guid)
    {
        $endpoint = "/keywords/v1/keywords/{$keyword_guid}";

        return $this->request('delete', $endpoint);
    }

}
