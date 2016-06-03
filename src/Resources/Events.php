<?php

namespace SevenShores\Hubspot\Resources;

class Events extends Resource
{
    /**
     * Trigger a custom event.
     *
     * This only works for enterprise accounts.
     *
     * @param  string $hubId               Your HubSpot portal ID ("Hub ID"). You can find your Hub ID in the
     *                                     footer of the HubSpot UI, or in the URL. For example, in this URL:
     *                                     "https://app.hubspot.com/reports/56043/events/" your Hub ID is "56043".
     * @param  string $eventId
     * @param  string $contactEmail        Optional - contact email.
     * @param  float  $contactRevenue      Optional - the monetary value this event means to you.
     * @param  array  $contactProperties   Optional - array of new contact properties.
     * @return \SevenShores\Hubspot\Http\Response
     */
    function trigger(
        $hubId,
        $eventId,
        $contactEmail = null,
        $contactRevenue = null,
        $contactProperties = []
    ) {
        $endpoint = sprintf(
            "http://track.hubspot.com/v1/event?_a=%s&_n=%s",
            url_encode($hubId),
            url_encode($eventId)
        );

        $contactProperties['email'] = $contactEmail;
        $contactProperties['_m'] = $contactRevenue;

        $query_string = build_query_string($contactProperties);

        return $this->client->request('get', $endpoint, [], $query_string);
    }
}
