<?php

namespace SevenShores\Hubspot\Resources;

class Engagements extends Resource
{
    /**
     * @param array $engagement Array of engagement engagement.
     * @param array $associations Array of engagement associations.
     * @param array $metadata Array of engagement metadata.
     * @param array $attachments Array of engagement attachments.
     * @return \SevenShores\Hubspot\Http\Response
     */
    function create($engagement, $associations, $metadata, $attachments = array())
    {
        $endpoint = "https://api.hubapi.com/engagements/v1/engagements";

        $options['json'] = [
            'engagement' => $engagement,
            'associations' => $associations,
            'metadata' => $metadata,
            'attachments' => $attachments
        ];

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * @param int   $id         The engagement id.
     * @param array $engagement The engagement engagement to update.
     * @param array $metadata The engagement metadata to update.
     * @return \SevenShores\Hubspot\Http\Response
     */
    function update($id, $engagement, $metadata)
    {
        $endpoint = "https://api.hubapi.com/engagements/v1/engagements/{$id}";

        $options['json'] = [
            'engagement' => $engagement,
            'metadata' => $metadata,
        ];

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * @param int $id
     * @return \SevenShores\Hubspot\Http\Response
     */
    function delete($id)
    {
        $endpoint = "https://api.hubapi.com/engagements/v1/engagements/{$id}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * @param int $id
     * @return \SevenShores\Hubspot\Http\Response
     */
    function get($id)
    {
        $endpoint = "https://api.hubapi.com/engagements/v1/engagements/{$id}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * @param int $id
     * @param string $object_type
     * @param int $object_id
     * @return \SevenShores\Hubspot\Http\Response
     **/
    function associate($id, $object_type, $object_id)
    {
        $endpoint = "https://api.hubapi.com/engagements/v1/engagements/{$id}/associations/{$object_type}/{$object_id}";

        return $this->client->request('put', $endpoint);
    }
}
