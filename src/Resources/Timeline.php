<?php

namespace SevenShores\Hubspot\Resources;

class Timeline extends Resource
{
    /**
     * Create or Update Timeline Event
     *
     * @param string $appId
     *
     * @see http://developers.hubspot.com/docs/methods/timeline/create-or-update-event
     */
    public function createOrUpdate($appId)
    {
        $endpoint = "https://api.hubapi.com/integrations/v1/{$appId}/timeline/event";
    }

    /**
     * Get Timeline Event Types
     *
     * @param string $appId
     *
     * @see http://developers.hubspot.com/docs/methods/timeline/get-event-types
     */
    public function getEventTypes($appId)
    {
        $endpoint = "https://api.hubapi.com/integrations/v1/{$appId}/timeline/event-types";
    }

    /**
     * Create Timeline Event Type
     *
     * @param string $appId
     *
     * @see http://developers.hubspot.com/docs/methods/timeline/create-event-type
     */
    public function createEventType($appId)
    {
        $endpoint = "https://api.hubapi.com/integrations/v1/{$appId}/timeline/event-types";
    }

    /**
     * Update Timeline Event Type
     *
     * @param string $appId
     * @param string $eventTypeId
     *
     * @see http://developers.hubspot.com/docs/methods/timeline/update-event-type
     */
    public function updateEventType($appId, $eventTypeId)
    {
        $endpoint = "https://api.hubapi.com/integrations/v1/{$appId}/timeline/event-types/{$eventTypeId}";
    }

    /**
     * Delete Timeline Event Type
     *
     * @param string $appId
     * @param string $eventTypeId
     *
     * @see http://developers.hubspot.com/docs/methods/timeline/delete-event-type
     */
    public function deleteEventType($appId, $eventTypeId)
    {
        $endpoint = "https://api.hubapi.com/integrations/v1/{$appId}/timeline/event-types/{$eventTypeId}";
    }

    /**
     * Get Properties for Timeline Event Type
     *
     * @param string $appId
     * @param string $eventTypeId
     *
     * @see http://developers.hubspot.com/docs/methods/timeline/get-timeline-event-type-properties
     */
    public function getEventTypeProperties($appId, $eventTypeId)
    {
        $endpoint = "https://api.hubapi.com/integrations/v1/{$appId}/timeline/event-types/{$eventTypeId}/properties";
    }

    /**
     * Create Property for Timeline Event Type
     *
     * @param string $appId
     * @param string $eventTypeId
     *
     * @see http://developers.hubspot.com/docs/methods/timeline/create-timeline-event-type-property
     */
    public function createEventTypeProperty($appId, $eventTypeId)
    {
        $endpoint = "https://api.hubapi.com/integrations/v1/{$appId}/timeline/event-types/{$eventTypeId}/properties";
    }

    /**
     * Update Property for Timeline Event Type
     *
     * @param string $appId
     * @param string $eventTypeId
     *
     * @see http://developers.hubspot.com/docs/methods/timeline/udpate-timeline-event-type-property
     */
    public function updateEventTypeProperty($appId, $eventTypeId)
    {
        $endpoint = "https://api.hubapi.com/integrations/v1/{$appId}/timeline/event-types/{$eventTypeId}/properties";
    }

    /**
     * Delete Property for Timeline Event Type
     *
     * @param string $appId
     * @param string $eventTypeId
     *
     * @return mixed
     *
     * @see http://developers.hubspot.com/docs/methods/timeline/delete-timeline-event-type-property
     */
    public function deleteEventTypeProperty($appId, $eventTypeId)
    {
        $endpoint = "https://api.hubapi.com/integrations/v1/{$appId}/timeline/event-types/{$eventTypeId}/properties";
        return $this->client->request('delete', $endpoint);
    }
}
