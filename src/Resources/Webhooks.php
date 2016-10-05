<?php

namespace SevenShores\Hubspot\Resources;

class Webhooks extends Resource
{
    /**
     * Get list of subscriptions.
     *
     * @param int $app_id
     * @return \SevenShores\Hubspot\Http\Response
     */    
    function getSubscription($app_id)
    {
        $endpoint = "https://api.hubapi.com/webhooks/v1/{$app_id}/subscriptions";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Create a new subscription.
     *
     * @param int   $app_id
     * @param array $subscription
     * @return \SevenShores\Hubspot\Http\Response
     */    
    function createSubscription($app_id, $subscription)
    {
        $endpoint = "https://api.hubapi.com/webhooks/v1/{$app_id}/subscriptions";

        $options['json'] = $subscription;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Update a subscription.
     *
     * @param int   $app_id
     * @param int   $subscription_id
     * @param array $subscription
     * @return \SevenShores\Hubspot\Http\Response
     */    
    function updateSubscription($app_id, $subscription_id, $subscription)
    {
        $endpoint = "https://api.hubapi.com/webhooks/v1/{$app_id}/subscriptions/{$subscription_id}";

        $options['json'] = $subscription;

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * Delete a subscription.
     *
     * @param int $app_id
     * @param int $subscription_id
     * @return \SevenShores\Hubspot\Http\Response
     */    
    function deleteSubscription($app_id, $subscription_id)
    {
        $endpoint = "https://api.hubapi.com/webhooks/v1/{$app_id}/subscriptions/{$subscription_id}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Get webhook settings.
     *
     * @param int $app_id
     * @return \SevenShores\Hubspot\Http\Response
     */    
    function viewSettings($app_id)
    {
        $endpoint = "https://api.hubapiqa.com/webhooks/v1/{$app_id}/settings";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Update webhook settings.
     *
     * @param int   $app_id
     * @param array $settings
     * @return \SevenShores\Hubspot\Http\Response
     */    
    function updateSettings($app_id, $settings)
    {
        $endpoint = "https://api.hubapiqa.com/webhooks/v1/{$app_id}/settings";

        $options['json'] = $settings;

        return $this->client->request('put', $endpoint, $options);
    }

}