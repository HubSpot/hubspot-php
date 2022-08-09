<?php

namespace SevenShores\Hubspot\Endpoints;

class CalendarEvents extends Endpoint
{
    /**
     * List content events.
     * Get events from the calendar.
     *
     * @param int   $startDate The beginning value of the query range, in UTC, in milliseconds
     * @param int   $endDate   The end value of the query range, in UTC, in milliseconds
     * @param array $params    Array of optional parameters:
     *                         limit, offset, contentCategory, campaignGuid, includeNoCampaigns
     *
     * @see https://developers.hubspot.com/docs/methods/calendar/list-content-events
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

    /**
     * List social events.
     * Retrieve social events for Calendar.
     * A shortcut of the standard events call for finer-grained control.
     *
     * @param int   $startDate The beginning value of the query range, in UTC, in milliseconds
     * @param int   $endDate   The end value of the query range, in UTC, in milliseconds
     * @param array $params    Array of optional parameters:
     *                         limit, offset, campaignGuid, includeNoCampaigns
     *
     * @see https://developers.hubspot.com/docs/methods/calendar/list-social-events
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
     * List Calendar tasks.
     * Retrieve task events for Calendar.
     * A shortcut of the standard events call for finer-grained control.
     *
     * @param int   $startDate The beginning value of the query range, in UTC, in milliseconds
     * @param int   $endDate   The end value of the query range, in UTC, in milliseconds
     * @param array $params    Array of optional parameters:
     *                         limit, campaignGuid, includeNoCampaigns
     *
     * @see https://developers.hubspot.com/docs/methods/calendar/list-tasks
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
     * List events.
     * Get an aggregation for all calendar event types.
     *
     * @param int   $startDate The beginning value of the query range, in UTC, in milliseconds
     * @param int   $endDate   The end value of the query range, in UTC, in milliseconds
     * @param array $params    Array of optional parameters:
     *                         limit, type, campaignGuid, contentCategory, includeNoCampaigns
     *
     * @see https://developers.hubspot.com/docs/methods/calendar/list-events
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
     * Create a new calendar task.
     *
     * @see https://developers.hubspot.com/docs/methods/calendar/create-task
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function createTask(array $properties)
    {
        $endpoint = 'https://api.hubapi.com/calendar/v1/events/task';

        return $this->client->request('post', $endpoint, ['json' => $properties]);
    }

    /**
     * Get calendar task by ID.
     *
     * @param int $id
     *
     * @see https://developers.hubspot.com/docs/methods/calendar/get-calendar-task-by-id
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getTaskById($id)
    {
        $endpoint = "https://api.hubapi.com/calendar/v1/events/task/{$id}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Update a calendar task.
     *
     * @param int   $id         the task id
     * @param array $properties the task properties to update
     *
     * @see https://developers.hubspot.com/docs/methods/calendar/update-task
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function updateTask($id, array $properties)
    {
        $endpoint = "https://api.hubapi.com/calendar/v1/events/task/{$id}";

        return $this->client->request('put', $endpoint, ['json' => $properties]);
    }

    /**
     * Delete Calendar Task.
     *
     * @param int $id
     *
     * @see https://developers.hubspot.com/docs/methods/calendar/delete-task
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function deleteTask($id)
    {
        $endpoint = "https://api.hubapi.com/calendar/v1/events/task/{$id}";

        return $this->client->request('delete', $endpoint);
    }
}
