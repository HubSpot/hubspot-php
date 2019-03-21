<?php

namespace SevenShores\Hubspot\Resources;

class CrmAssociations extends Resource
{
    /**
     * @param array $ticket Array of deal properties.
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @return mixed
     */
    public function create(array $data)
    {
        $endpoint = 'https://api.hubapi.com/crm-associations/v1/associations';

        $options['json'] = $data;

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * @param array $data Array of objectId, definitionId, and optional category.
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @return mixed
     */
    public function get(array $data)
    {
        // default category to HUBSPOT_DEFINED
        if (!array_key_exists('category', $data)) {
            $data['category'] = 'HUBSPOT_DEFINED';
        }

        $endpoint = "https://api.hubapi.com/crm-associations/v1/associations/{$data['objectId']}/{$data['category']}/{$data['definitionId']}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * @param int   $id     The deal id.
     * @param array $ticket The deal properties to update.
     *
     * @return mixed
     */
    public function delete(array $data)
    {
        $endpoint = 'https://api.hubapi.com/crm-associations/v1/associations/delete';

        $options['json'] = $data;

        return $this->client->request('put', $endpoint, $options);
    }
}
