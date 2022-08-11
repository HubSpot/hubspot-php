<?php

namespace SevenShores\Hubspot\Endpoints;

class Integration extends Endpoint
{
    /**
     * Get account details.
     *
     * @return \SevenShores\Hubspot\Http\Response
     *
     * @see https://developers.hubspot.com/docs/methods/get-account-details
     */
    public function getAccountDetails()
    {
        $endpoint = 'https://api.hubapi.com/integrations/v1/me';

        return $this->client->request('get', $endpoint);
    }

    /**
     * Check daily API usage.
     *
     * @return \SevenShores\Hubspot\Http\Response
     *
     * @see https://developers.hubspot.com/docs/methods/check-daily-api-usage
     */
    public function getDailyUsage()
    {
        $endpoint = 'https://api.hubapi.com/integrations/v1/limit/daily';

        return $this->client->request('get', $endpoint);
    }
}
