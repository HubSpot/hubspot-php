<?php

namespace SevenShores\Hubspot\Resources;

class Workflows extends Resource
{
    /**
     * Get all workflows.
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    function all()
    {
        $endpoint = "https://api.hubapi.com/automation/v2/workflows";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Get a specific workflow.
     *
     * @param int $id
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getById($id)
    {
        $endpoint = "https://api.hubapi.com/automation/v2/workflows/{$id}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Enroll a contact in a workflow.
     *
     * @param int    $workflow_id
     * @param string $email
     * @return \SevenShores\Hubspot\Http\Response
     */
    function enrollContact($workflow_id, $email)
    {
        $endpoint = "https://api.hubapi.com/automation/v2/workflows/{$workflow_id}/enrollments/contacts/{$email}";

        return $this->client->request('post', $endpoint);
    }

    /**
     * Unenroll a contact from a workflow.
     *
     * @param int    $workflow_id
     * @param string $email
     * @return \SevenShores\Hubspot\Http\Response
     */
    function unenrollContact($workflow_id, $email)
    {
        $endpoint = "https://api.hubapi.com/automation/v2/workflows/{$workflow_id}/enrollments/contacts/{$email}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Create a new workflow.
     *
     * @param array $workflow The workflow properties
     * @return \SevenShores\Hubspot\Http\Response
     */
    function create($workflow)
    {
        $endpoint = "https://api.hubapi.com/automation/v2/workflows";

        $options['json'] = $workflow;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Delete a workflow.
     *
     * @param int $id
     * @return \SevenShores\Hubspot\Http\Response
     */
    function delete($id)
    {
        $endpoint = "https://api.hubapi.com/automation/v2/workflows/{$id}";

        $queryString = build_query_string(['updatedAt' => time()]);

        return $this->client->request('delete', $endpoint, [], $queryString);
    }

    /**
     * Get current enrollments for a contact.
     *
     * @param int $contact_id
     * @return \SevenShores\Hubspot\Http\Response
     */
    function enrollmentsForContact($contact_id)
    {
        $endpoint = "https://api.hubapi.com/automation/v2/workflows/enrollments/contacts/{$contact_id}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Get past events for contact from a workflow.
     *
     * @param int   $workflow_id
     * @param int   $contact_id
     * @param array $params Optional parameters.
     * @return \SevenShores\Hubspot\Http\Response
     */
    function pastEventsForContact($workflow_id, $contact_id, $params = [])
    {
        $endpoint = " /automation/v2/workflows/{$workflow_id}/logevents/contacts/{$contact_id}/past";

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Get upcoming (scheduled) events for a contact in a workflow.
     *
     * @param int   $workflow_id
     * @param int   $contact_id
     * @param array $params
     * @return \SevenShores\Hubspot\Http\Response
     */
    function upcomingEventsForContact($workflow_id, $contact_id, $params = [])
    {
        $endpoint = "https://api.hubapi.com/automation/v2/workflows/{$workflow_id}/logevents/contacts/{$contact_id}/upcoming";

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

}
