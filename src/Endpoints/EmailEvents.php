<?php

namespace SevenShores\Hubspot\Endpoints;

/**
 * @see https://developers.hubspot.com/docs/methods/email/email_events_overview
 */
class EmailEvents extends Endpoint
{
    /**
     * Get campaign IDs with recent activity for a portal.
     *
     * @see https://developers.hubspot.com/docs/methods/email/get_campaigns_by_id
     *
     * @param array $params Optional parameters
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getCampaignIds(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/email/public/v1/campaigns/by-id';

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Get campaign IDs with recent activity for a portal.
     *
     * @see https://developers.hubspot.com/docs/methods/email/get_campaigns
     *
     * @param array $params Optional parameters
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getCampaignIdsWithRecentActivity(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/email/public/v1/campaigns';

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Get campaign data for a given campaign.
     *
     * @see https://developers.hubspot.com/docs/methods/email/get_campaign_data
     *
     * @param int $campaignId
     * @param int $applicationId
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getCampaignById($campaignId, $applicationId)
    {
        $endpoint = "https://api.hubapi.com/email/public/v1/campaigns/{$campaignId}";

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string(['appId' => $applicationId])
        );
    }

    /**
     * Get email events for a campaign or recipient.
     *
     * @see https://developers.hubspot.com/docs/methods/email/get_events
     *
     * @param array $params Optional parameters
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function all(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/email/public/v1/events';

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Get event data for a specific event.
     *
     * @see https://developers.hubspot.com/docs/methods/email/get_event_by_id
     *
     * @param int $id      The event ID
     * @param int $created Timestamp (milliseconds) when the event was created
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getById($id, $created)
    {
        $endpoint = "https://api.hubapi.com/email/public/v1/events/{$created}/{$id}";

        return $this->client->request('get', $endpoint);
    }
}
