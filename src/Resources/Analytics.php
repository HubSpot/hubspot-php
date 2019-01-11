<?php

namespace SevenShores\Hubspot\Resources;

class Analytics extends Resource
{
    /**
     * Get analytics data broken down by the specified category.
     *
     * @see https://developers.hubspot.com/docs/methods/analytics/get-analytics-data-breakdowns
     *
     * @param string $breakdown_by
     * @param string $time_period
     * @param string $startDate (YYYYMMDD)
     * @param string $endDate (YYYYMMDD)
     * @param array $params Array of optional parameters ['filterId', 'sort', 'sortDir','limit', 'offset']
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getByCategory($breakdown_by, $time_period, $startDate, $endDate, $params = [])
    {
        $endpoint = "https://api.hubapi.com/analytics/v2/reports/{$breakdown_by}/{$time_period}";
        $params = array_merge(compact('startDate', 'endDate'), $params);

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Get analytics data for specific objects, based on the type of object.
     *
     * @see https://developers.hubspot.com/docs/methods/analytics/get-analytics-data-by-object
     *
     * @param string $object_type
     * @param string $time_period
     * @param string $startDate (YYYYMMDD)
     * @param string $endDate (YYYYMMDD)
     * @param array $params Array of optional parameters ['filterId', 'sort', 'sortDir','limit', 'offset']
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getByType($object_type, $time_period, $startDate, $endDate, $params = [])
    {
        $endpoint = "https://api.hubapi.com/analytics/v2/reports/{$object_type}/{$time_period}";
        $params = array_merge(compact('startDate', 'endDate'), $params);

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Get analytics data for your HubSpot hosted content.
     *
     * @see https://developers.hubspot.com/docs/methods/analytics/get-data-for-hubspot-content
     *
     * @param string $content_type
     * @param string $time_period
     * @param string $startDate (YYYYMMDD)
     * @param string $endDate (YYYYMMDD)
     * @param array $params Array of optional parameters ['filterId', 'sort', 'sortDir','limit', 'offset']
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getHosted($content_type, $time_period, $startDate, $endDate, $params = [])
    {
        $endpoint = "https://api.hubapi.com/analytics/v2/reports/{$content_type}/{$time_period}";
        $params = array_merge(compact('startDate', 'endDate'), $params);

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Get Events.
     *
     * @see https://developers.hubspot.com/docs/methods/events/get_events
     *
     * @param array $params Array of optional parameters ['includeDeletes']
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getEvents($params = [])
    {
        $endpoint = "https://api.hubapi.com/reports/v2/events";

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Get all analytics views
     *
     * @see https://developers.hubspot.com/docs/methods/analytics-views/get-views
     *
     * @param array $params Array of optional parameters
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getViews($params = [])
    {
        $endpoint = "https://api.hubapi.com/analytics/v2/views";

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Get a Group of Events by ID
     *
     * @see https://developers.hubspot.com/docs/methods/events/get_events_by_id
     *
     * @param string $id Can be included multiple times to pull multiple events.
     * @param array $params Array of optional parameters ['includeDeletes']
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getEventsById($id, $params = [])
    {
        $endpoint = "https://api.hubapi.com/analytics/v2/views";

        $queryString = build_query_string($params);

        $params['id'] = $id;

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Check for the existence of analytics data for an object type
     *
     * @see https://developers.hubspot.com/docs/methods/analytics/check_for_analytics_data_existence
     *
     * @param string $id
     * @param array $params Array of optional parameters
     * @return \SevenShores\Hubspot\Http\Response
     */
    function checkForExistence($objectType, $params = [])
    {
        $endpoint = "https://api.hubapi.com/analytics/v2/reports/{$objectType}/exists";

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }
}
