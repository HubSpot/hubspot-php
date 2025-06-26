<?php

namespace SevenShores\Hubspot\Endpoints;

/**
 * Class Owners.
 *
 * @see https://developers.hubspot.com/docs/methods/owners/owners_overview
 */
class Owners extends Endpoint
{

    /**
     * @param int $id
     *
     * @return \SevenShores\Hubspot\Http\Response
     *
     * @see https://developers.hubspot.com/docs/methods/owners/get_an_owner
     */
    public function getById($id)
    {
        $endpoint = 'https://api.hubapi.com/owners/v2/owners/'.$id;

        return $this->client->request('get', $endpoint);
    }

    /**
     * @return \SevenShores\Hubspot\Http\Response
     *
     * @see https://developers.hubspot.com/docs/methods/owners/get_owners
     */
    public function all(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/owners/v2/owners';

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }
}
