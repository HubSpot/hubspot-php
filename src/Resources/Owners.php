<?php

namespace SevenShores\Hubspot\Resources;

/**
 * Class Owners
 * @package SevenShores\Hubspot\Resources
 */
class Owners extends Resource
{
    /**
     * @param array $properties
     * @return \SevenShores\Hubspot\Http\Response
     */
    function create($properties)
    {
        $endpoint = 'https://api.hubapi.com/owners/v2/owners/';
        $options['json'] = $properties;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * @param int $id
     * @param array $properties
     * @return \SevenShores\Hubspot\Http\Response
     */
    function update($id, $properties)
    {
        $endpoint = "https://api.hubapi.com/owners/v2/owners/{$id}";
        $options['json'] = $properties;

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * @param int $id
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getById($id)
    {
        $endpoint = 'https://api.hubapi.com/owners/v2/owners/'.$id;

        return $this->client->request('get', $endpoint);
    }

    /**
     * @param array $params
     * @return \SevenShores\Hubspot\Http\Response
     */
    function all($params = [])
    {
        $endpoint = 'https://api.hubapi.com/owners/v2/owners';

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }
}
