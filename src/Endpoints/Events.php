<?php

namespace SevenShores\Hubspot\Endpoints;

class Events extends Endpoint
{
    /**
     * Trigger a custom event.
     *
     * This only works for enterprise accounts.
     *
     * @param string $hubId             Your HubSpot portal ID ("Hub ID"). You can find your Hub ID in the
     *                                  footer of the HubSpot UI, or in the URL. For example, in this URL:
     *                                  "https://app.hubspot.com/reports/56043/events/" your Hub ID is "56043".
     * @param string $eventId
     * @param string $contactEmail      contact email triggering the event
     * @param float  $contactRevenue    optional - the monetary value this event means to you
     * @param array  $contactProperties optional - array of new contact properties
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function trigger(
        $hubId,
        $eventId,
        $contactEmail = null,
        $contactRevenue = null,
        $contactProperties = []
    ) {
        $endpoint = 'https://track.hubspot.com/v1/event';

        $required['_a'] = $hubId;
        $required['_n'] = $eventId;
        $required['email'] = $contactEmail;

        $parameters = array_merge(
            $required,
            ['_m' => $contactRevenue],
            $contactProperties
        );

        $query_string = build_query_string($parameters);

        return $this->client->request('get', $endpoint, [], $query_string, false);
    }
}
