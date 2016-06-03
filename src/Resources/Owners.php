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
     * @return \SevenShores\Hubspot\Response
     */
    function create($properties)
    {
        $endpoint = '/owners/v2/owners/';
        $options['json'] = $properties;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * @param int $id
     * @param array $properties
     * @return \SevenShores\Hubspot\Response
     */
    function update($id, $properties)
    {
        $endpoint = "/owners/v2/owners/{$id}";
        $options['json'] = $properties;

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * @param int $id
     * @return \SevenShores\Hubspot\Response
     */
    function getById($id)
    {
        $endpoint = '/owners/v2/owners/'.$id;

        return $this->client->request('get', $endpoint);
    }

    /**
     * @param array $params
     * @return \SevenShores\Hubspot\Response
     */
    function all($params = [])
    {
        $endpoint = '/owners/v2/owners';

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }
}
