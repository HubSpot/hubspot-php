<?php

namespace Fungku\HubSpot\Api;

class EmailEvents extends Api
{
    /**
     * Get campaign IDs for a portal.
     *
     * @param array $params Optional parameters
     * @return \Fungku\HubSpot\Http\Response
     */
    public function getCampaignIds($params = [])
    {
        $endpoint = "/email/public/v1/campaigns";

        $queryString = $this->buildQueryString($params);

        return $this->request('get', $endpoint, [], $queryString);
    }

    /**
     * Get campaign data for a given campaign.
     *
     * @param int $campaign_id
     * @param int $application_id
     * @return \Fungku\HubSpot\Http\Response
     */
    public function getCampaignById($campaign_id, $application_id)
    {
        $endpoint = "/email/public/v1/campaigns/{$campaign_id}";

        $queryString = $this->buildQueryString(['appId' => $application_id]);

        return $this->request('get', $endpoint, [], $queryString);
    }

    /**
     * Get email events for a campaign or recipient.
     *
     * @param array $params Optional parameters
     * @return \Fungku\HubSpot\Http\Response
     */
    public function get($params = [])
    {
        $endpoint = "/email/public/v1/events";

        $queryString = $this->buildQueryString($params);

        return $this->request('get', $endpoint, [], $queryString);
    }

    /**
     * Get event data for a specific event.
     *
     * @param int $id      The event ID
     * @param int $created Timestamp (milliseconds) when the event was created
     * @return \Fungku\HubSpot\Http\Response
     */
    public function getById($id, $created)
    {
        $endpoint = "/email/public/v1/events/{$created}/{$id}";

        return $this->request('get', $endpoint);
    }

}
