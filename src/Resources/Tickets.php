<?php

namespace SevenShores\Hubspot\Resources;

class Tickets extends Resource
{
    /**
     * @param array $ticket Array of deal properties.
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @return mixed
     */
    public function create(array $ticket)
    {
        $endpoint = 'https://api.hubapi.com/crm-objects/v1/objects/tickets';

        $options['json'] = $ticket;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * @param int   $id     The deal id.
     * @param array $ticket The deal properties to update.
     *
     * @return mixed
     */
    public function update($id, array $ticket)
    {
        $endpoint = "https://api.hubapi.com/crm-objects/v1/objects/tickets/{$id}";

        $options['json'] = $ticket;

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * @param array $params
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function getAll(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/crm-objects/v1/objects/tickets/paged';

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        $endpoint = "https://api.hubapi.com/crm-objects/v1/objects/tickets/{$id}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function getById($id)
    {
        $endpoint = "https://api.hubapi.com/crm-objects/v1/objects/tickets/{$id}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * @param array $params Optional parameters ['timestamp', 'changeType', 'objectId']
     *
     * @return mixed
     */
    public function getChangelog(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/crm-objects/v1/change-log/tickets';
        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }
}
