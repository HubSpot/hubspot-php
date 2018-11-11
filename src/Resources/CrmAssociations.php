<?php
namespace SevenShores\Hubspot\Resources;

use SevenShores\Hubspot\Exceptions\HubspotException;

class CrmAssociations extends Resource
{
    /**
     * @param array $ticket Array of deal properties.
     * @return mixed
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     */
    function create(array $data)
    {
        $endpoint = "https://api.hubapi.com/crm-associations/v1/associations";

        $options['json'] = $data;

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * @param int $id The deal id.
     * @param array $ticket The deal properties to update.
     * @return mixed
     */
    function delete(array $data)
    {
        $endpoint = "https://api.hubapi.com/crm-associations/v1/associations/delete";

        $options['json'] = $data;

        return $this->client->request('put', $endpoint, $options);
    }

}
