<?php

namespace Fungku\HubSpot\Api;

class Events extends Api
{
    const BASE_URL = "http://track.hubspot.com/v1";

    /**
     * Trigger a custom event.
     *
     * This only works for enterprise accounts.
     *
     * @param string $hubId             Your HubSpot portal ID ("Hub ID"). You can find your Hub ID in the
     *                                  footer of the HubSpot UI, or in the URL. For example, in this URL:
     *                                  "https://app.hubspot.com/reports/56043/events/" your Hub ID is "56043".
     * @param string $eventId           Required - Event ID.
     * @param string $contactEmail      Optional.
     * @param float  $contactRevenue    Optional - the monetary value this event means to you.
     * @param array  $contactProperties Optional - array of new contact properties.
     *
     * @return void
     */
    public function trigger(
        $hubId,
        $eventId,
        $contactEmail = null,
        $contactRevenue = null,
        array $contactProperties 
    ) {
        $endpoint = sprintf(
            '/event?_a=%s&_n=%s',
            urlencode($hubId),
            urlencode($eventId)
        );

        if ($contactEmail !== null) {
            $endpoint .= '&email=' . urlencode($contactEmail);
        }

        if ($contactRevenue !== null) {
            $endpoint .= '&_m=' . urlencode($contactRevenue);
        }

        if (is_array($contactProperties) && count($contactProperties) > 0) {
            foreach ($contactProperties as $contactPropertyKey => $contactPropertyValue) {
                $endpoint .= '&' . $contactPropertyKey . '=' . urlencode($contactPropertyValue);
            }
        }

        $this->request('get', $endpoint);
    }
}
