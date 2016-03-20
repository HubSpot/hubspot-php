<?php

namespace Fungku\HubSpot\Api;

/**
 * Class Owners
 * @package Fungku\HubSpot\Api
 */
class Owners extends Api
{
    /**
     * @param array $properties
     * @return \Fungku\HubSpot\Http\Response
     */
    public function create($properties)
    {
        $endpoint = '/owners/v2/owners/';
        $options['json'] = $properties;

        return $this->request('post', $endpoint, $options);
    }

    /**
     * @param int $id
     * @param array $properties
     * @return \Fungku\HubSpot\Http\Response
     */
    public function update($id, $properties)
    {
        $endpoint = "/owners/v2/owners/{$id}";
        $options['json'] = $properties;

        return $this->request('put', $endpoint, $options);
    }

    /**
     * @param int $id
     * @return \Fungku\HubSpot\Http\Response
     */
    public function getById($id)
    {
        $endpoint = '/owners/v2/owners/'.$id;

        return $this->request('get', $endpoint);
    }

    /**
     * @param array $params
     * @return \Fungku\HubSpot\Http\Response
     */
    public function all($params = [])
    {
        $endpoint = '/owners/v2/owners';

        $queryString = $this->buildQueryString($params);

        return $this->request('get', $endpoint, [], $queryString);
    }
}
