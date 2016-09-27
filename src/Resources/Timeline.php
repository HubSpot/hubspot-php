<?php

namespace SevenShores\Hubspot\Resources;

class Timeline extends Resource
{
    /**
     * @param string $appId
     *
     * @see http://developers.hubspot.com/docs/methods/timeline/create-or-update-event
     */
    public function createOrUpdate($appId)
    {
        $endpoint = "https://api.hubapi.com/integrations/v1/{$appId}/timeline/event";
    }

    /**
     * @param string $appId
     *
     * @see http://developers.hubspot.com/docs/methods/timeline/get-event-types
     */
    public function getEventTypes($appId)
    {
        $endpoint = "https://api.hubapi.com/integrations/v1/{$appId}/timeline/event-types";
    }

    /**
     * @param string $appId
     *
     * @see http://developers.hubspot.com/docs/methods/timeline/create-event-type
     */
    public function createEventType($appId)
    {
        $endpoint = "https://api.hubapi.com/integrations/v1/{$appId}/timeline/event-types";
    }

    /**
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
     * @param string $appId
     * @param string $eventTypeId
     *
     * @see http://developers.hubspot.com/docs/methods/timeline/delete-timeline-event-type-property
     */
    public function updateEventTypeProperty($appId, $eventTypeId)
    {
        $endpoint = "https://api.hubapi.com/integrations/v1/{$appId}/timeline/event-types/{$eventTypeId}/properties";
    }

    /**
     * @param string $appId
     * @param string $eventTypeId
     *
     * @see http://developers.hubspot.com/docs/methods/timeline/delete-timeline-event-type-property
     */
    public function deleteEventTypeProperty($appId, $eventTypeId)
    {
        $endpoint = "https://api.hubapi.com/integrations/v1/{$appId}/timeline/event-types/{$eventTypeId}/properties";
    }
}
