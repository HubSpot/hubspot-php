<?php

namespace SevenShores\Hubspot\Resources;

class CalendarEvents extends Resource
{
    /**
     * @return \SevenShores\Hubspot\Http\Response
     *
     * @see https://developers.hubspot.com/docs/methods/calendar/create-task
     */
    public function createTask(array $properties)
    {
        $endpoint = 'https://api.hubapi.com/calendar/v1/events/task';
        $options['json'] = $properties;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * @param int   $id         the task id
     * @param array $properties the task properties to update
     *
     * @return \SevenShores\Hubspot\Http\Response
     *
     * @see https://developers.hubspot.com/docs/methods/calendar/update-task
     */
    public function updateTask($id, array $properties)
    {
        $endpoint = "https://api.hubapi.com/calendar/v1/events/task/{$id}";

        $options['json'] = $properties;

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * @param int $id
     *
     * @return \SevenShores\Hubspot\Http\Response
     *
     * @see https://developers.hubspot.com/docs/methods/calendar/get-calendar-task-by-id
     */
    public function getTaskById($id)
    {
        $endpoint = "https://api.hubapi.com/calendar/v1/events/task/{$id}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * @param int $id
     *
     * @return \SevenShores\Hubspot\Http\Response
     *
     * @see https://developers.hubspot.com/docs/methods/calendar/delete-task
     */
    public function deleteTask($id)
    {
        $endpoint = "https://api.hubapi.com/calendar/v1/events/task/{$id}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Get an aggregation for all calendar event types.
     *
     * @see https://developers.hubspot.com/docs/methods/calendar/list-events
     *
     * @param int   $startDate The beginning value of the query range, in UTC, in milliseconds
     * @param int   $endDate   The end value of the query range, in UTC, in milliseconds
     * @param array $params    Array of optional parameters:
     *                         limit, type, campaignGuid, contentCategory, includeNoCampaigns
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function all($startDate, $endDate, array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/calendar/v1/events';

        $queryString = build_query_string(
            array_merge(compact('startDate', 'endDate'), $params)
        );

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Retrieve task events for Calendar.
     * A shortcut of the standard events call for finer-grained control.
     *
     * @see https://developers.hubspot.com/docs/methods/calendar/list-tasks
     *
     * @param int   $startDate The beginning value of the query range, in UTC, in milliseconds
     * @param int   $endDate   The end value of the query range, in UTC, in milliseconds
     * @param array $params    Array of optional parameters:
     *                         limit, campaignGuid, includeNoCampaigns
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function allTasks($startDate, $endDate, array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/calendar/v1/events/task';

        $queryString = build_query_string(
            array_merge(compact('startDate', 'endDate'), $params)
        );

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Retrieve social events for Calendar.
     * A shortcut of the standard events call for finer-grained control.
     *
     * @see https://developers.hubspot.com/docs/methods/calendar/list-social-events
     *
     * @param int   $startDate The beginning value of the query range, in UTC, in milliseconds
     * @param int   $endDate   The end value of the query range, in UTC, in milliseconds
     * @param array $params    Array of optional parameters:
     *                         limit, offset, campaignGuid, includeNoCampaigns
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function allSocialEvents($startDate, $endDate, array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/calendar/v1/events/social';

        $queryString = build_query_string(
            array_merge(compact('startDate', 'endDate'), $params)
        );

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * List content events.
     * Get events from the calendar.
     *
     * @see https://developers.hubspot.com/docs/methods/calendar/list-content-events
     *
     * @param int   $startDate The beginning value of the query range, in UTC, in milliseconds
     * @param int   $endDate   The end value of the query range, in UTC, in milliseconds
     * @param array $params    Array of optional parameters:
     *                         limit, offset, contentCategory, campaignGuid, includeNoCampaigns
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function allContentEvents($startDate, $endDate, array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/calendar/v1/events/content';

        $queryString = build_query_string(
            array_merge(compact('startDate', 'endDate'), $params)
        );

        return $this->client->request('get', $endpoint, [], $queryString);
    }
}
