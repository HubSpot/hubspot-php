<?php

namespace SevenShores\Hubspot\Endpoints;

/**
 * @see https://developers.hubspot.com/docs/methods/analytics/analytics-overview
 */
class Analytics extends Endpoint
{
    /**
     * Get analytics data broken down by the specified category.
     *
     * @param string $start  (YYYYMMDD)
     * @param string $end    (YYYYMMDD)
     * @param array  $params Array of optional parameters ['filterId', 'sort', 'sortDir','limit', 'offset']
     *
     * @see https://developers.hubspot.com/docs/methods/analytics/get-analytics-data-breakdowns
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getByCategory(
        string $breakdown_by,
        string $time_period,
        string $start,
        string $end,
        array $params = []
    ) {
        $endpoint = "https://api.hubapi.com/analytics/v2/reports/{$breakdown_by}/{$time_period}";

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string(
                array_merge(compact('start', 'end'), $params)
            )
        );
    }

    /**
     * Get analytics data for specific objects, based on the type of object.
     *
     * @param string $start  (YYYYMMDD)
     * @param string $end    (YYYYMMDD)
     * @param array  $params Array of optional parameters ['filterId', 'sort', 'sortDir','limit', 'offset']
     *
     * @see https://developers.hubspot.com/docs/methods/analytics/get-analytics-data-by-object
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getByType(
        string $object_type,
        string $time_period,
        string $start,
        string $end,
        array $params = []
    ) {
        $endpoint = "https://api.hubapi.com/analytics/v2/reports/{$object_type}/{$time_period}";

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string(
                array_merge(compact('start', 'end'), $params)
            )
        );
    }

    /**
     * Get analytics data for your HubSpot hosted content.
     *
     * @param string $start  (YYYYMMDD)
     * @param string $end    (YYYYMMDD)
     * @param array  $params Array of optional parameters ['filterId', 'sort', 'sortDir','limit', 'offset']
     *
     * @see https://developers.hubspot.com/docs/methods/analytics/get-data-for-hubspot-content
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getHosted(
        string $content_type,
        string $time_period,
        string $start,
        string $end,
        array $params = []
    ) {
        $endpoint = "https://api.hubapi.com/analytics/v2/reports/{$content_type}/{$time_period}";

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string(
                array_merge(compact('start', 'end'), $params)
            )
        );
    }

    /**
     * Check for the existence of analytics data for an object type.
     *
     * @param array $params Array of optional parameters
     *
     * @see https://developers.hubspot.com/docs/methods/analytics/check_for_analytics_data_existence
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function checkForExistence(string $objectType, array $params = [])
    {
        $endpoint = "https://api.hubapi.com/analytics/v2/reports/{$objectType}/exists";

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Get Events.
     *
     * @param array $params Array of optional parameters ['includeDeletes']
     *
     * @see https://developers.hubspot.com/docs/methods/events/get_events
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getEvents(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/reports/v2/events';

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Get a Group of Events by ID.
     *
     * @param mixed $id     can be included multiple times to pull multiple events
     * @param array $params Array of optional parameters ['includeDeletes']
     *
     * @see https://developers.hubspot.com/docs/methods/events/get_events_by_id
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getEventsById($id, array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/analytics/v2/views';

        $params['id'] = $id;

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Get all analytics views.
     *
     * @param array $params Array of optional parameters
     *
     * @see https://developers.hubspot.com/docs/methods/analytics-views/get-views
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getViews(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/analytics/v2/views';

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }
}
