<?php namespace Fungku\HubSpot\Api;

class Email extends Api
{
    /**
     * Get email subscription types for a portal.
     *
     * @param int $portal_id
     * @return mixed
     */
    public function subscriptionDefinitions($portal_id)
   {
       $endpoint = "/email/public/v1/subscriptions";

       $options['query'] = ['portalId' => $portal_id];

       return $this->request('get', $endpoint, $options);
   }

    /**
     * View subscriptions timeline for a portal.
     *
     * @param array $params Optional parameters
     * @return mixed
     */
    public function subscriptionsTimeline(array $params = [])
    {
        $endpoint = "/email/public/v1/subscriptions/timeline";

        $options['query'] = $params;

        return $this->request('get', $endpoint, $options);
    }

    /**
     * Get email subscription status for an email address.
     *
     * @param int $portal_id
     * @param string $email
     * @return mixed
     */
    public function subscriptionStatus($portal_id, $email)
    {
        $endpoint = "/email/public/v1/subscriptions/{$email}";

        $options['query'] = ['portalId' => $portal_id];

        return $this->request('get', $endpoint, $options);
    }

    /**
     * Update email subscription status for an email address.
     *
     * @param int $portal_id
     * @param string $email
     * @param array $params
     * @return mixed
     */
    public function updateSubscription($portal_id, $email, array $params = [])
    {
        $endpoint = "/email/public/v1/subscriptions/{$email}";

        $options['query'] = ['portalId' => $portal_id];
        $options['json'] = $params;

        return $this->request('put', $endpoint, $options);
    }

    /**
     * Get campaign IDs for a portal.
     *
     * @param array $params Optional parameters
     * @return mixed
     */
    public function campaignIds(array $params = [])
    {
        $endpoint = "/email/public/v1/campaigns";

        $options['query'] = $params;

        return $this->request('get', $endpoint, $options);
    }

    /**
     * Get campaign data for a given campaign.
     *
     * @param int $campaign_id
     * @param int $application_id
     * @return mixed
     */
    public function campaign($campaign_id, $application_id)
    {
        $endpoint = "/email/public/v1/campaigns/{$campaign_id}";

        $options['query'] = ['appId' => $application_id];

        return $this->request('get', $endpoint, $options);
    }

    /**
     * Get email events for a campaign or recipient.
     *
     * @param array $params Optional parameters
     * @return mixed
     */
    public function events(array $params = [])
    {
        $endpoint = "/email/public/v1/events";

        $options['query'] = $params;

        return $this->request('get', $endpoint, $options);
    }

    /**
     * Get event data for a specific event.
     *
     * @param int $id The event ID
     * @param int $created Timestamp (milliseconds) when the event was created
     * @return mixed
     */
    public function event($id, $created)
    {
        $endpoint = "/email/public/v1/events/{$created}/{$id}";

        return $this->request('get', $endpoint);
    }

}
