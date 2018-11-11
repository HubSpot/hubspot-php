<?php
namespace SevenShores\Hubspot\Resources;

use SevenShores\Hubspot\Exceptions\HubspotException;

class Tickets extends Resource
{
    /**
     * @param array $ticket Array of deal properties.
     * @return mixed
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     */
    function create(array $ticket)
    {
        $endpoint = "https://api.hubapi.com/crm-objects/v1/objects/tickets";

        $options['json'] = $ticket;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * @param int $id The deal id.
     * @param array $ticket The deal properties to update.
     * @return mixed
     */
    function update($id, array $ticket)
    {
        $endpoint = "https://api.hubapi.com/crm-objects/v1/objects/tickets/{$id}";

        $options['json'] = $ticket;

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * @param array $params
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     */
    function getAll(array $params = []){
        $endpoint = "https://api.hubapi.com/crm-objects/v1/objects/tickets/paged";

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }


    /**
     * @param int $id
     * @return mixed
     */
    function delete($id)
    {
        $endpoint = "https://api.hubapi.com/crm-objects/v1/objects/tickets/{$id}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * @param int $id
     * @return mixed
     */
    function getById($id)
    {
        $endpoint = "https://api.hubapi.com/crm-objects/v1/objects/tickets/{$id}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * @param array $params Optional parameters ['timestamp', 'changeType', 'objectId']
     * @return mixed
     */
    function getChangelog(array $params = [])
    {
        $endpoint = "https://api.hubapi.com/crm-objects/v1/change-log/tickets";
        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

}
