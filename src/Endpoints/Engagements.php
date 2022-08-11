<?php

namespace SevenShores\Hubspot\Endpoints;

use SevenShores\Hubspot\Exceptions\BadRequest;

/**
 * @see https://developers.hubspot.com/docs/methods/engagements/engagements-overview
 */
class Engagements extends Endpoint
{
    /**
     * Create an engagement.
     *
     * @see https://developers.hubspot.com/docs/methods/engagements/create_engagement
     *
     * @param array $engagement   array of engagement engagement
     * @param array $associations array of engagement associations
     * @param array $metadata     array of engagement metadata
     * @param array $attachments  array of engagement attachments
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function create(array $engagement, array $associations, array $metadata, array $attachments = [])
    {
        $endpoint = 'https://api.hubapi.com/engagements/v1/engagements';

        return $this->client->request(
            'post',
            $endpoint,
            [
                'json' => [
                    'engagement' => $engagement,
                    'associations' => $associations,
                    'metadata' => $metadata,
                    'attachments' => $attachments,
                ],
            ]
        );
    }

    /**
     * Update an Engagement.
     *
     * @see https://developers.hubspot.com/docs/methods/engagements/update_engagement-patch
     *
     * @param int   $id         the engagement id
     * @param array $engagement the engagement engagement to update
     * @param array $metadata   the engagement metadata to update
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function update($id, array $engagement, array $metadata, string $method = 'patch')
    {
        $availableMethods = ['put', 'patch'];

        if (!in_array($method, $availableMethods)) {
            throw new BadRequest('Method name '.$method.' is invalid', 400);
        }
        $endpoint = "https://api.hubapi.com/engagements/v1/engagements/{$id}";

        return $this->client->request(
            $method,
            $endpoint,
            [
                'json' => [
                    'engagement' => $engagement,
                    'metadata' => $metadata,
                ],
            ]
        );
    }

    /**
     * Get an engagement.
     *
     * @see https://developers.hubspot.com/docs/methods/engagements/get_engagement
     *
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
     * Get all engagements.
     *
     * @see https://developers.hubspot.com/docs/methods/engagements/get-all-engagements
     *
     * @param array $params Array of optional parameters ['limit', 'offset']
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function all(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/engagements/v1/engagements/paged';

        return $this->client->request('get', $endpoint, [], build_query_string($params));
    }

    /**
     * Returns all recently created or updated engagements.
     *
     * @see https://developers.hubspot.com/docs/methods/engagements/get-recent-engagements
     *
     * @param array $params Array of optional parameters ['count', 'offset', 'since]
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function recent(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/engagements/v1/engagements/recent/modified';

        return $this->client->request('get', $endpoint, [], build_query_string($params));
    }

    /**
     * Delete an Engagement.
     *
     * @see https://developers.hubspot.com/docs/methods/engagements/delete-engagement
     *
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
     * Associate Engagement with CRM object.
     *
     * @see https://developers.hubspot.com/docs/methods/engagements/associate_engagement
     * @see CrmAssociations::create is used to create associations between objects
     * @deprecated
     *
     * @param int $id
     * @param int $object_id
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function associate($id, string $object_type, $object_id)
    {
        $endpoint = "https://api.hubapi.com/engagements/v1/engagements/{$id}/associations/{$object_type}/{$object_id}";

        return $this->client->request('put', $endpoint);
    }

    /**
     * Get Associated Engagements.
     *
     * @see https://developers.hubspot.com/docs/methods/engagements/get_associated_engagements
     * @see CrmAssociations::get is used to get associations between objects
     * @deprecated
     *
     * @param int   $object_id
     * @param array $params    Array of optional parameters ['limit', 'offset']
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function associated(string $object_type, $object_id, array $params = [])
    {
        $endpoint = "https://api.hubapi.com/engagements/v1/engagements/associated/{$object_type}/{$object_id}/paged";

        return $this->client->request('get', $endpoint, [], build_query_string($params));
    }

    /**
     * @deprecated
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function activityTypes()
    {
        $endpoint = 'https://api.hubapi.com/engagements/v1/activity-types';

        return $this->client->request('get', $endpoint);
    }

    /**
     * Get call engagement dispositions.
     *
     * Get the possible dispositions for sales calls (stored as engagements), listed as
     * the outcome when viewing the call's outcome when viewing
     * the call in the timeline in HubSpot.
     *
     * @see https://developers.hubspot.com/docs/methods/engagements/get-call-dispositions
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function getCallDispositions()
    {
        $endpoint = 'https://api.hubapi.com/calling/v1/dispositions';

        return $this->client->request('get', $endpoint);
    }
}
