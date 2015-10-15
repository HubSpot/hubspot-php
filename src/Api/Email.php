<?php

namespace Fungku\HubSpot\Api;

class Email extends Api
{
    /**
     * Get email subscription types for a portal.
     *
     * @param int $portalId Portal ID
     *
     * @return mixed
     */
    public function subscriptionDefinitions($portalId)
    {
        $endpoint = "/email/public/v1/subscriptions";

        $options['query'] = array('portalId' => $portalId);

        return $this->request('get', $endpoint, $options);
    }

    /**
     * View subscriptions timeline for a portal.
     *
     * @param array $params Optional parameters
     *
     * @return mixed
     */
    public function subscriptionsTimeline($params)
    {
        $endpoint = "/email/public/v1/subscriptions/timeline";

        $options['query'] = $this->getQuery($params);

        return $this->request('get', $endpoint, $options);
    }

    /**
     * Get email subscription status for an email address.
     *
     * @param int    $portalId Portal ID
     * @param string $email    Email address
     *
     * @return mixed
     */
    public function getSubscriptionStatus($portalId, $email)
    {
        $endpoint = "/email/public/v1/subscriptions/{$email}";

        $options['query'] = array('portalId' => $portalId);

        return $this->request('get', $endpoint, $options);
    }

    /**
     * Update email subscription status for an email address.
     *
     * @param int    $portalId Portal ID
     * @param string $email    Email Address
     * @param array  $params   Extra params
     *
     * @return mixed
     */
    public function updateSubscription($portalId, $email, $params)
    {
        $endpoint = "/email/public/v1/subscriptions/{$email}";

        $options['query'] = array('portalId' => $portalId);
        $options['json'] = $params;

        return $this->request('put', $endpoint, $options);
    }
}
