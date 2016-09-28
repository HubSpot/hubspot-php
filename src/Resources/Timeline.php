<?php

namespace SevenShores\Hubspot\Resources;

class Timeline extends Resource
{
    /**
     * Create or Update Timeline Event
     *
     * @param int         $appId
     * @param string      $eventTypeId
     * @param string      $id
     * @param int|null    $objectId
     * @param string|null $email
     * @param string|null $utk
     *
     * @return mixed
     *
     * @see http://developers.hubspot.com/docs/methods/timeline/create-or-update-event
     */
    public function createOrUpdate(
        $appId,
        $eventTypeId,
        $id,
        $objectId = null,
        $email = null,
        $utk = null
    ) {
        $endpoint = "https://api.hubapi.com/integrations/v1/{$appId}/timeline/event";

        $options['json'] = [
            'eventTypeId' => $eventTypeId,
            'id'          => $id,
            'objectId'    => $objectId,
            'email'       => $email,
            'utk'         => $utk,
        ];

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * Get Timeline Event Types
     *
     * @param int $appId
     *
     * @return mixed
     *
     * @see http://developers.hubspot.com/docs/methods/timeline/get-event-types
     */
    public function getEventTypes($appId)
    {
        $endpoint = "https://api.hubapi.com/integrations/v1/{$appId}/timeline/event-types";
        return $this->client->request('get', $endpoint);
    }

    /**
     * Create Timeline Event Type
     *
     * @param int         $appId
     * @param string      $name
     * @param string|null $headerTemplate
     * @param string|null $detailTemplate
     * @param string|null $objectType
     *
     * @return mixed
     *
     * @see http://developers.hubspot.com/docs/methods/timeline/create-event-type
     */
    public function createEventType(
        $appId,
        $name,
        $headerTemplate = null,
        $detailTemplate = null,
        $objectType = null
    ) {
        $endpoint = "https://api.hubapi.com/integrations/v1/{$appId}/timeline/event-types";

        $options['json'] = [
            'applicationId'  => $appId,
            'name'           => $name,
            'headerTemplate' => $headerTemplate,
            'detailTemplate' => $detailTemplate,
            'objectType'     => $objectType,
        ];

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Update Timeline Event Type
     *
     * @param int         $appId
     * @param string      $eventTypeId
     * @param string|null $name
     * @param string|null $headerTemplate
     * @param string|null $detailTemplate
     * @param string|null $objectType
     *
     * @return mixed
     *
     * @see http://developers.hubspot.com/docs/methods/timeline/update-event-type
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

        $options['json'] = [
            'applicationId'  => $appId,
            'name'           => $name,
            'headerTemplate' => $headerTemplate,
            'detailTemplate' => $detailTemplate,
            'objectType'     => $objectType,
        ];

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * Delete Timeline Event Type
     *
     * @param int    $appId
     * @param string $eventTypeId
     *
     * @return mixed
     *
     * @see http://developers.hubspot.com/docs/methods/timeline/delete-event-type
     */
    public function deleteEventType($appId, $eventTypeId)
    {
        $endpoint = "https://api.hubapi.com/integrations/v1/{$appId}/timeline/event-types/{$eventTypeId}";
        return $this->client->request('delete', $endpoint);
    }

    /**
     * Get Properties for Timeline Event Type
     *
     * @param int    $appId
     * @param string $eventTypeId
     *
     * @return mixed
     *
     * @see http://developers.hubspot.com/docs/methods/timeline/get-timeline-event-type-properties
     */
    public function getEventTypeProperties($appId, $eventTypeId)
    {
        $endpoint = "https://api.hubapi.com/integrations/v1/{$appId}/timeline/event-types/{$eventTypeId}/properties";
        return $this->client->request('get', $endpoint);
    }

    /**
     * Create Property for Timeline Event Type
     *
     * @param int         $appId
     * @param string      $eventTypeId
     * @param string      $name
     * @param string      $label
     * @param string      $propertyType
     * @param string|null $objectProperty
     * @param array       $options
     *
     * @return mixed
     *
     * @see http://developers.hubspot.com/docs/methods/timeline/create-timeline-event-type-property
     */
    public function createEventTypeProperty(
        $appId,
        $eventTypeId,
        $name,
        $label,
        $propertyType,
        $objectProperty = null,
        $options = []
    ) {
        $endpoint = "https://api.hubapi.com/integrations/v1/{$appId}/timeline/event-types/{$eventTypeId}/properties";

        $options['json'] = [
            'name'           => $name,
            'label'          => $label,
            'propertyType'   => $propertyType,
            'objectProperty' => $objectProperty,
            'options'        => $options,
        ];

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Update Property for Timeline Event Type
     *
     * @param int         $appId
     * @param string      $eventTypeId
     * @param string      $id
     * @param string|null $propertyType
     * @param string|null $label
     * @param array|null  $options
     *
     * @return mixed
     *
     * @see http://developers.hubspot.com/docs/methods/timeline/udpate-timeline-event-type-property
     */
    public function updateEventTypeProperty(
        $appId,
        $eventTypeId,
        $eventTypePropertyId,
        $label = null,
        $propertyType = null,
        $options = null
    ) {
        $endpoint = "https://api.hubapi.com/integrations/v1/{$appId}/timeline/event-types/{$eventTypeId}/properties";

        $options['json'] = [
            'id' => $eventTypePropertyId,
        ];

        if (isset($label)) {
            $options['json']['label'] = $label;
        }

        if (isset($propertyType)) {
            $options['json']['propertyType'] = $propertyType;
        }

        if (isset($options)) {
            $options['json']['options'] = $options;
        }

        var_dump($options);

        $options['debug'] = true;

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * Delete Property for Timeline Event Type
     *
     * @param int $appId
     * @param int $eventTypeId
     * @param int $eventTypePropertyId
     *
     * @return mixed
     *
     * @see http://developers.hubspot.com/docs/methods/timeline/delete-timeline-event-type-property
     */
    public function deleteEventTypeProperty($appId, $eventTypeId, $eventTypePropertyId)
    {
        $endpoint = "https://api.hubapi.com/integrations/v1/{$appId}/timeline/event-types/{$eventTypeId}/properties/{$eventTypePropertyId}";
        return $this->client->request('delete', $endpoint);
    }
}
