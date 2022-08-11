<?php

namespace SevenShores\Hubspot\Endpoints;

class Timeline extends Endpoint
{
    /**
     * Create or Update Timeline Event.
     *
     * @param int         $appId
     * @param int         $eventTypeId
     * @param string      $id
     * @param null|int    $objectId
     * @param null|string $email
     * @param null|string $utk
     * @param mixed       $timestamp
     *
     * @return mixed
     *
     * @see https://developers.hubspot.com/docs/methods/timeline/create-or-update-event
     */
    public function createOrUpdate(
        $appId,
        $eventTypeId,
        $id,
        $objectId = null,
        $email = null,
        $utk = null,
        array $extraData = [],
        $timestamp = null,
        array $eventTypeData = []
    ) {
        $endpoint = "https://api.hubapi.com/integrations/v1/{$appId}/timeline/event";

        $data = ['json' => array_merge([
            'eventTypeId' => $eventTypeId,
            'id' => $id,
            'objectId' => $objectId,
            'email' => $email,
            'utk' => $utk,
            'extraData' => $extraData,
            'timestamp' => $this->timestamp($timestamp),
        ], $eventTypeData),
        ];

        return $this->client->request('put', $endpoint, $data);
    }

    /**
     * Get Timeline Event.
     *
     * @param int    $appId
     * @param int    $eventTypeId
     * @param string $eventId
     *
     * @return mixed
     *
     * @see https://developers.hubspot.com/docs/methods/timeline/get-event
     */
    public function getEvent(
        $appId,
        $eventTypeId,
        $eventId
    ) {
        $endpoint = "https://api.hubapi.com/integrations/v1/{$appId}/timeline/event/{$eventTypeId}/{$eventId}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Batch Create or Update Timeline Events.
     *
     * @param int $appId
     *
     * @return mixed
     *
     * @see https://developers.hubspot.com/docs/methods/timeline/batch-create-or-update-events
     */
    public function createOrUpdateBatch($appId, array $events = [])
    {
        $endpoint = "https://api.hubapi.com/integrations/v1/{$appId}/timeline/event/batch";

        return $this->client->request(
            'put',
            $endpoint,
            ['json' => ['eventWrappers' => $events]]
        );
    }

    /**
     * Get Timeline Event Types.
     *
     * @param int $appId
     *
     * @return mixed
     *
     * @see https://developers.hubspot.com/docs/methods/timeline/get-event-types
     */
    public function getEventTypes($appId)
    {
        $endpoint = "https://api.hubapi.com/integrations/v1/{$appId}/timeline/event-types";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Get Timeline Event Type by id.
     *
     * @param int $appId
     * @param int $eventTypeId
     *
     * @return mixed
     *
     * @see https://developers.hubspot.com/docs/methods/timeline/get-event-type-by-id
     */
    public function getEventTypeById($appId, $eventTypeId)
    {
        $endpoint = "https://api.hubapi.com/integrations/v1/{$appId}/timeline/event-types/{$eventTypeId}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Create Timeline Event Type.
     *
     * @param int         $appId
     * @param string      $name
     * @param null|string $headerTemplate
     * @param null|string $detailTemplate
     * @param null|string $objectType
     *
     * @return mixed
     *
     * @see https://developers.hubspot.com/docs/methods/timeline/create-event-type
     */
    public function createEventType(
        $appId,
        $name,
        $headerTemplate = null,
        $detailTemplate = null,
        $objectType = null
    ) {
        $endpoint = "https://api.hubapi.com/integrations/v1/{$appId}/timeline/event-types";

        $data = ['json' => [
            'applicationId' => $appId,
            'name' => $name,
            'headerTemplate' => $headerTemplate,
            'detailTemplate' => $detailTemplate,
            'objectType' => $objectType,
        ],
        ];

        return $this->client->request('post', $endpoint, $data);
    }

    /**
     * Update Timeline Event Type.
     *
     * @param int         $appId
     * @param int         $eventTypeId
     * @param null|string $name
     * @param null|string $headerTemplate
     * @param null|string $detailTemplate
     * @param null|string $objectType
     *
     * @return mixed
     *
     * @see https://developers.hubspot.com/docs/methods/timeline/update-event-type
     */
    public function updateEventType(
        $appId,
        $eventTypeId,
        $name = null,
        $headerTemplate = null,
        $detailTemplate = null,
        $objectType = null
    ) {
        $endpoint = "https://api.hubapi.com/integrations/v1/{$appId}/timeline/event-types/{$eventTypeId}";

        $data = ['json' => [
            'applicationId' => $appId,
            'name' => $name,
            'headerTemplate' => $headerTemplate,
            'detailTemplate' => $detailTemplate,
            'objectType' => $objectType,
        ],
        ];

        return $this->client->request('put', $endpoint, $data);
    }

    /**
     * Delete Timeline Event Type.
     *
     * @param int $appId
     * @param int $eventTypeId
     *
     * @return mixed
     *
     * @see https://developers.hubspot.com/docs/methods/timeline/delete-event-type
     */
    public function deleteEventType($appId, $eventTypeId)
    {
        $endpoint = "https://api.hubapi.com/integrations/v1/{$appId}/timeline/event-types/{$eventTypeId}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Get Properties for Timeline Event Type.
     *
     * @param int $appId
     * @param int $eventTypeId
     *
     * @return mixed
     *
     * @see https://developers.hubspot.com/docs/methods/timeline/get-timeline-event-type-properties
     */
    public function getEventTypeProperties($appId, $eventTypeId)
    {
        $endpoint = "https://api.hubapi.com/integrations/v1/{$appId}/timeline/event-types/{$eventTypeId}/properties";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Create Property for Timeline Event Type.
     *
     * @param int         $appId
     * @param int         $eventTypeId
     * @param string      $name
     * @param string      $label
     * @param string      $propertyType
     * @param null|string $objectProperty
     *
     * @return mixed
     *
     * @see https://developers.hubspot.com/docs/methods/timeline/create-timeline-event-type-property
     */
    public function createEventTypeProperty(
        $appId,
        $eventTypeId,
        $name,
        $label,
        $propertyType,
        $objectProperty = null,
        array $options = []
    ) {
        $endpoint = "https://api.hubapi.com/integrations/v1/{$appId}/timeline/event-types/{$eventTypeId}/properties";

        $data = ['json' => [
            'name' => $name,
            'label' => $label,
            'propertyType' => $propertyType,
            'objectProperty' => $objectProperty,
            'options' => $options,
        ],
        ];

        return $this->client->request('post', $endpoint, $data);
    }

    /**
     * Update Property for Timeline Event Type.
     *
     * @param int    $appId
     * @param int    $eventTypeId
     * @param int    $eventTypePropertyId
     * @param string $name
     * @param string $label
     * @param string $propertyType
     *
     * @return mixed
     *
     * @see https://developers.hubspot.com/docs/methods/timeline/udpate-timeline-event-type-property
     */
    public function updateEventTypeProperty(
        $appId,
        $eventTypeId,
        $eventTypePropertyId,
        $name,
        $label,
        $propertyType,
        array $options = []
    ) {
        $endpoint = "https://api.hubapi.com/integrations/v1/{$appId}/timeline/event-types/{$eventTypeId}/properties";

        $data['json'] = [
            'id' => $eventTypePropertyId,
            'name' => $name,
            'label' => $label,
            'propertyType' => $propertyType,
        ];

        if (isset($options)) {
            $data['json']['options'] = $options;
        }

        return $this->client->request('put', $endpoint, $data);
    }

    /**
     * Delete Property for Timeline Event Type.
     *
     * @param int $appId
     * @param int $eventTypeId
     * @param int $eventTypePropertyId
     *
     * @return mixed
     *
     * @see https://developers.hubspot.com/docs/methods/timeline/delete-timeline-event-type-property
     */
    public function deleteEventTypeProperty($appId, $eventTypeId, $eventTypePropertyId)
    {
        $endpoint = "https://api.hubapi.com/integrations/v1/{$appId}/timeline/event-types/{$eventTypeId}/properties/{$eventTypePropertyId}";

        return $this->client->request('delete', $endpoint);
    }
}
