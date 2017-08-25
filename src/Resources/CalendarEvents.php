<?php

namespace SevenShores\Hubspot\Resources;

class CalendarEvents extends Resource
{
    /**
     * @param array $properties
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function createTask($properties)
    {
        $endpoint = 'https://api.hubapi.com/calendar/v1/events/task';
        $options['json'] = $properties;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * @param int   $id         The task id.
     * @param array $properties The task properties to update.
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function updateTask($id, $properties)
    {
        $endpoint = "https://api.hubapi.com/calendar/v1/events/task/{$id}";

        $options['json'] = $properties;

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * @param int $id
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getTaskById($id)
    {
        $endpoint = "https://api.hubapi.com/calendar/v1/events/task/{$id}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * @param int $id
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function deleteTask($id)
    {
        $endpoint = "https://api.hubapi.com/calendar/v1/events/task/{$id}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Get an aggregation for all calendar event types.
     *
     *
     * @see https://developers.hubspot.com/docs/methods/calendar/list-events
     *
     * @param int $startDate    The beginning value of the query range, in UTC, in milliseconds
     * @param int $endDate      The end value of the query range, in UTC, in milliseconds
     * @param array $params     Array of optional parameters:
     *                          limit, type, campaignGuid, contentCategory, includeNoCampaigns
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function all($startDate, $endDate, $params = [])
    {
        $endpoint = "https://api.hubapi.com/calendar/v1/events";
        $params = array_merge(compact('startDate', 'endDate'), $params);

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Retrieve task events for Calendar.
     * A shortcut of the standard events call for finer-grained control.
     *
     * @see https://developers.hubspot.com/docs/methods/calendar/list-tasks
     *
     * @param int $startDate    The beginning value of the query range, in UTC, in milliseconds
     * @param int $endDate      The end value of the query range, in UTC, in milliseconds
     * @param array $params     Array of optional parameters:
     *                          limit, campaignGuid, includeNoCampaigns
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function allTasks($startDate, $endDate, $params = [])
    {
        $endpoint = "https://api.hubapi.com/calendar/v1/events/task";
        $params = array_merge(compact('startDate', 'endDate'), $params);

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Retrieve social events for Calendar.
     * A shortcut of the standard events call for finer-grained control.
     *
     * @see https://developers.hubspot.com/docs/methods/calendar/list-social-events
     *
     * @param int $startDate    The beginning value of the query range, in UTC, in milliseconds
     * @param int $endDate      The end value of the query range, in UTC, in milliseconds
     * @param array $params     Array of optional parameters:
     *                          limit, offset, campaignGuid, includeNoCampaigns
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function allSocialEvents($startDate, $endDate, $params = [])
    {
        $endpoint = "https://api.hubapi.com/calendar/v1/events/social";
        $params = array_merge(compact('startDate', 'endDate'), $params);

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * List content events.
     * Get events from the calendar.
     *
     * @see https://developers.hubspot.com/docs/methods/calendar/list-content-events
     *
     * @param int $startDate    The beginning value of the query range, in UTC, in milliseconds
     * @param int $endDate      The end value of the query range, in UTC, in milliseconds
     * @param array $params     Array of optional parameters:
     *                          limit, offset, contentCategory, campaignGuid, includeNoCampaigns
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function allContentEvents($startDate, $endDate, $params = [])
    {
        $endpoint = "https://api.hubapi.com/calendar/v1/events/content";
        $params = array_merge(compact('startDate', 'endDate'), $params);

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }
}
