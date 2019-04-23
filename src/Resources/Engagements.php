<?php

namespace SevenShores\Hubspot\Resources;

use SevenShores\Hubspot\Exceptions\BadRequest;

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
     * Returns all recently created or updated engagements.
     *
     * @param array $params Array of optional parameters ['count', 'offset', 'since]
     *
     * @see https://developers.hubspot.com/docs/methods/engagements/get-recent-engagements
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    function recent($params = [])
    {
        $endpoint = 'https://api.hubapi.com/engagements/v1/engagements/recent/modified';

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * @param int $id The engagement id.
     * @param array $engagement The engagement engagement to update.
     * @param array $metadata The engagement metadata to update.
     * @param string $method
     * @return \SevenShores\Hubspot\Http\Response
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     */
    function update($id, $engagement, $metadata, $method = 'patch')
    {
        $availableMethods = ['put', 'patch'];

        if (! \in_array($method, $availableMethods)) {
            throw new BadRequest('Method name '.$method.' is invalid', 400);
        }
        $endpoint = "https://api.hubapi.com/engagements/v1/engagements/{$id}";

        $options['json'] = [
            'engagement' => $engagement,
            'metadata' => $metadata,
        ];

        return $this->client->request($method, $endpoint, $options);
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
     * Returns all engagements.
     *
     * @param array $params Array of optional parameters ['limit', 'offset']
     *
     * @see http://developers.hubspot.com/docs/methods/engagements/get-all-engagements
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function all($params = [])
    {
        $endpoint = 'https://api.hubapi.com/engagements/v1/engagements/paged';

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
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

    /**
     * @param string $object_type
     * @param int $object_id
     * @param array $params Array of optional parameters ['limit', 'offset']
     * @return \SevenShores\Hubspot\Http\Response
     **/
    function associated($object_type, $object_id, $params = [])
    {
        $endpoint = "https://api.hubapi.com/engagements/v1/engagements/associated/{$object_type}/{$object_id}/paged";
        $queryString = build_query_string($params);
        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * @return \SevenShores\Hubspot\Http\Response
     */
    function activityTypes()
    {
        $endpoint = "https://api.hubapi.com/engagements/v1/activity-types";

        return $this->client->request('get', $endpoint);
    }
}
