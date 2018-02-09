<?php

namespace SevenShores\Hubspot\Resources;

class Integration extends Resource
{

    /**
     * Check daily API usage
     *
     * @return \SevenShores\Hubspot\Http\Response
     *
     * @see https://developers.hubspot.com/docs/methods/check-daily-api-usage
     */
    public function getDailyUsage()
    {
        $endpoint = "https://api.hubapi.com/integrations/v1/limit/daily";
        return $this->client->request('get', $endpoint);
    }
}
