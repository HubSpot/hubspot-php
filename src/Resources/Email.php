<?php

namespace SevenShores\Hubspot\Resources;

/**
 * @see https://developers.hubspot.com/docs/methods/email/email_subscriptions_overview
 */
class Email extends Resource
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
    public function subscriptions($portalId)
    {
        $endpoint = 'https://api.hubapi.com/email/public/v1/subscriptions';

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string(['portalId' => $portalId])
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
     * @param int    $portal_id
     * @param string $email
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function subscriptionStatus($portal_id, $email)
    {
        $endpoint = "https://api.hubapi.com/email/public/v1/subscriptions/{$email}";

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string(['portalId' => $portal_id])
        );
    }

    /**
     * Update email subscription status for an email address.
     *
     * @see https://developers.hubspot.com/docs/methods/email/update_status
     * 
     * @param int    $portal_id
     * @param string $email
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function updateSubscription($portal_id, $email, array $params = [])
    {
        $endpoint = "https://api.hubapi.com/email/public/v1/subscriptions/{$email}";

        return $this->client->request(
            'put',
            $endpoint,
            ['json' => $params],
            build_query_string(['portalId' => $portal_id])
        );
    }
}
