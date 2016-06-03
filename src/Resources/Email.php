<?php

namespace SevenShores\Hubspot\Resources;

class Email extends Resource
{
    /**
     * Get email subscription types for a portal.
     *
     * @param int $portal_id
     * @return \SevenShores\Hubspot\Http\Response
     */
    function subscriptions($portal_id)
    {
        $endpoint = "https://api.hubapi.com/email/public/v1/subscriptions";

        $queryString = build_query_string(['portalId' => $portal_id]);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * View subscriptions timeline for a portal.
     *
     * @param array $params Optional parameters
     * @return \SevenShores\Hubspot\Http\Response
     */
    function subscriptionsTimeline($params = [])
    {
        $endpoint = "https://api.hubapi.com/email/public/v1/subscriptions/timeline";

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Get email subscription status for an email address.
     *
     * @param int    $portal_id
     * @param string $email
     * @return \SevenShores\Hubspot\Http\Response
     */
    function subscriptionStatus($portal_id, $email)
    {
        $endpoint = "https://api.hubapi.com/email/public/v1/subscriptions/{$email}";

        $queryString = build_query_string(['portalId' => $portal_id]);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Update email subscription status for an email address.
     *
     * @param int    $portal_id
     * @param string $email
     * @param array  $params
     * @return \SevenShores\Hubspot\Http\Response
     */
    function updateSubscription($portal_id, $email, $params = [])
    {
        $endpoint = "https://api.hubapi.com/email/public/v1/subscriptions/{$email}";

        $queryString = build_query_string(['portalId' => $portal_id]);
        $options['json'] = $params;

        return $this->client->request('put', $endpoint, $options, $queryString);
    }

}
