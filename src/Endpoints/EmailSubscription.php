<?php

namespace SevenShores\Hubspot\Endpoints;

/**
 * @see https://developers.hubspot.com/docs/methods/email/email_subscriptions_overview
 */
class EmailSubscription extends Endpoint
{
    /**
     * Get email subscription types for a portal.
     *
     * @see https://developers.hubspot.com/docs/methods/email/get_subscriptions
     *
     * @param int $portalId
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function subscriptions($portalId = null)
    {
        $endpoint = 'https://api.hubapi.com/email/public/v1/subscriptions';

        return $this->client->request(
            'get',
            $endpoint,
            [],
            $this->getQueryString($portalId)
        );
    }

    /**
     * View subscriptions timeline for a portal.
     *
     * @see https://developers.hubspot.com/docs/methods/email/get_subscriptions_timeline
     *
     * @param array $params Optional parameters
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function subscriptionsTimeline(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/email/public/v1/subscriptions/timeline';

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Get email subscription status for an email address.
     *
     * @see https://developers.hubspot.com/docs/methods/email/get_status
     *
     * @param string $email
     * @param int    $portalId
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function subscriptionStatus($email, $portalId = null)
    {
        $endpoint = "https://api.hubapi.com/email/public/v1/subscriptions/{$email}";

        return $this->client->request(
            'get',
            $endpoint,
            [],
            $this->getQueryString($portalId)
        );
    }

    /**
     * Update email subscription status for an email address.
     *
     * @see https://developers.hubspot.com/docs/methods/email/update_status
     *
     * @param string $email
     * @param int    $portalId
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function updateSubscription($email, array $data = [], $portalId = null)
    {
        $endpoint = "https://api.hubapi.com/email/public/v1/subscriptions/{$email}";

        return $this->client->request(
            'put',
            $endpoint,
            ['json' => $data],
            $this->getQueryString($portalId)
        );
    }

    /**
     * @param int $portalId
     *
     * @return string
     */
    protected function getQueryString($portalId)
    {
        if (!empty($portalId)) {
            return build_query_string(['portalId' => $portalId]);
        }

        return null;
    }
}
