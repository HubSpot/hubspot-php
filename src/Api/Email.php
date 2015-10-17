<?php

namespace Fungku\HubSpot\Api;

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

       $queryString = $this->buildQueryString(['portalId' => $portal_id]);

       return $this->request('get', $endpoint, [], $queryString);
   }

    /**
     * View subscriptions timeline for a portal.
     *
     * @param array $params Optional parameters
     * @return mixed
     */
    public function subscriptionsTimeline($params = [])
    {
        $endpoint = "/email/public/v1/subscriptions/timeline";

        $queryString = $this->buildQueryString($params);

        return $this->request('get', $endpoint, [], $queryString);
    }

    /**
     * Get email subscription status for an email address.
     *
     * @param int $portal_id
     * @param string $email
     * @return mixed
     */
    public function getSubscriptionStatus($portal_id, $email)
    {
        $endpoint = "/email/public/v1/subscriptions/{$email}";

        $queryString = $this->buildQueryString(['portalId' => $portal_id]);

        return $this->request('get', $endpoint, [], $queryString);
    }

    /**
     * Update email subscription status for an email address.
     *
     * @param int $portal_id
     * @param string $email
     * @param array $params
     * @return mixed
     */
    public function updateSubscription($portal_id, $email, $params = [])
    {
        $endpoint = "/email/public/v1/subscriptions/{$email}";

        $queryString = $this->buildQueryString(['portalId' => $portal_id]);
        $options['json'] = $params;

        return $this->request('put', $endpoint, $options, $queryString);
    }

}
