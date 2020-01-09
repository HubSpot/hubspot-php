<?php

namespace SevenShores\Hubspot\Resources;

use SevenShores\Hubspot\Exceptions\BadRequest;

class Engagements extends Resource
{
    /**
     * @param array $engagement   array of engagement engagement
     * @param array $associations array of engagement associations
     * @param array $metadata     array of engagement metadata
     * @param array $attachments  array of engagement attachments
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function create($engagement, $associations, $metadata, $attachments = [])
    {
        $endpoint = 'https://api.hubapi.com/engagements/v1/engagements';

        $options['json'] = [
            'engagement' => $engagement,
            'associations' => $associations,
            'metadata' => $metadata,
            'attachments' => $attachments,
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
    public function recent($params = [])
    {
        $endpoint = 'https://api.hubapi.com/engagements/v1/engagements/recent/modified';

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * @param int    $id         the engagement id
     * @param array  $engagement the engagement engagement to update
     * @param array  $metadata   the engagement metadata to update
     * @param string $method
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function update($id, $engagement, $metadata, $method = 'patch')
    {
        $availableMethods = ['put', 'patch'];

        if (!\in_array($method, $availableMethods)) {
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
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function delete($id)
    {
        $endpoint = "https://api.hubapi.com/engagements/v1/engagements/{$id}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * @param int $id
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function get($id)
    {
        $endpoint = "https://api.hubapi.com/engagements/v1/engagements/{$id}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Returns all engagements.
     *
     * @param array $params Array of optional parameters ['limit', 'offset']
     *
     * @see https://developers.hubspot.com/docs/methods/engagements/get-all-engagements
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
     * @param int    $id
     * @param string $object_type
     * @param int    $object_id
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function associate($id, $object_type, $object_id)
    {
        $endpoint = "https://api.hubapi.com/engagements/v1/engagements/{$id}/associations/{$object_type}/{$object_id}";

        return $this->client->request('put', $endpoint);
    }

    /**
     * @param string $object_type
     * @param int    $object_id
     * @param array  $params      Array of optional parameters ['limit', 'offset']
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function associated($object_type, $object_id, $params = [])
    {
        $endpoint = "https://api.hubapi.com/engagements/v1/engagements/associated/{$object_type}/{$object_id}/paged";
        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function activityTypes()
    {
        $endpoint = 'https://api.hubapi.com/engagements/v1/activity-types';

        return $this->client->request('get', $endpoint);
    }

    /**
     * Get the possible dispositions for sales calls (stored as engagements), listed as
     * the outcome when viewing the call's outcome when viewing
     * the call in the timeline in HubSpot.
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function getCallDispositions()
    {
        $endpoint = 'https://api.hubapi.com/calling/v1/dispositions';

        return $this->client->request('get', $endpoint);
    }
}
