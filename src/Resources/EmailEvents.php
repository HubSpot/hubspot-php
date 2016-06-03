<?php

namespace SevenShores\Hubspot\Resources;

class EmailEvents extends Resource
{
    /**
     * Get campaign IDs for a portal.
     *
     * @param array $params Optional parameters
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getCampaignIds($params = [])
    {
        $endpoint = "https://api.hubapi.com/email/public/v1/campaigns";

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Get campaign data for a given campaign.
     *
     * @param int $campaign_id
     * @param int $application_id
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getCampaignById($campaign_id, $application_id)
    {
        $endpoint = "https://api.hubapi.com/email/public/v1/campaigns/{$campaign_id}";

        $queryString = build_query_string(['appId' => $application_id]);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Get email events for a campaign or recipient.
     *
     * @param array $params Optional parameters
     * @return \SevenShores\Hubspot\Http\Response
     */
    function all($params = [])
    {
        $endpoint = "https://api.hubapi.com/email/public/v1/events";

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Get event data for a specific event.
     *
     * @param int $id      The event ID
     * @param int $created Timestamp (milliseconds) when the event was created
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getById($id, $created)
    {
        $endpoint = "https://api.hubapi.com/email/public/v1/events/{$created}/{$id}";

        return $this->client->request('get', $endpoint);
    }
}
