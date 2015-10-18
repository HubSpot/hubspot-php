<?php

namespace Fungku\HubSpot\Api;

class Events extends Api
{
    /**
     * @var string
     */
    protected $baseUrl = "http://track.hubspot.com";

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
     * @return \Fungku\HubSpot\Http\Response
     */
    public function trigger(
        $hubId,
        $eventId,
        $contactEmail = null,
        $contactRevenue = null,
        $contactProperties = []
    ) {
        $endpoint = sprintf(
            "/v1/event?_a=%s&_n=%s",
            $this->urlEncode($hubId),
            $this->urlEncode($eventId)
        );

        $contactProperties['email'] = $contactEmail;
        $contactProperties['_m'] = $contactRevenue;

        $url = $this->baseUrl . $endpoint . $this->buildQueryString($contactProperties);

        return $this->requestUrl('get', $url);
    }
}
