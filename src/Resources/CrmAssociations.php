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
