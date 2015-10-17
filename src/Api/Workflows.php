<?php

namespace Fungku\HubSpot\Api;

class Workflows extends Api
{
    /**
     * Get all workflows.
     *
     * @return \Fungku\HubSpot\Http\Response
     */
    public function all()
    {
        $endpoint = "/automation/v2/workflows";

        return $this->request('get', $endpoint);
    }

    /**
     * Get a specific workflow.
     *
     * @param int $id
     * @return \Fungku\HubSpot\Http\Response
     */
    public function getById($id)
    {
        $endpoint = "/automation/v2/workflows/{$id}";

        return $this->request('get', $endpoint);
    }

    /**
     * Enroll a contact in a workflow.
     *
     * @param int    $workflow_id
     * @param string $email
     * @return \Fungku\HubSpot\Http\Response
     */
    public function enrollContact($workflow_id, $email)
    {
        $endpoint = "/automation/v2/workflows/{$workflow_id}/enrollments/contacts/{$email}";

        return $this->request('get', $endpoint);
    }

    /**
     * Unenroll a contact from a workflow.
     *
     * @param int    $workflow_id
     * @param string $email
     * @return \Fungku\HubSpot\Http\Response
     */
    public function unenrollContact($workflow_id, $email)
    {
        $endpoint = "/automation/v2/workflows/{$workflow_id}/enrollments/contacts/{$email}";

        return $this->request('delete', $endpoint);
    }

    /**
     * Create a new workflow.
     *
     * @param array $workflow The workflow properties
     * @return \Fungku\HubSpot\Http\Response
     */
    public function create($workflow)
    {
        $endpoint = "/automation/v2/workflows";

        $options['json'] = $workflow;

        return $this->request('post', $endpoint, $options);
    }

    /**
     * Delete a workflow.
     *
     * @param int $id
     * @return \Fungku\HubSpot\Http\Response
     */
    public function delete($id)
    {
        $endpoint = "/automation/v2/workflows/{$id}";

        $queryString = $this->buildQueryString(['updatedAt' => time()]);

        return $this->request('delete', $endpoint, [], $queryString);
    }

    /**
     * Get current enrollments for a contact.
     *
     * @param int $contact_id
     * @return \Fungku\HubSpot\Http\Response
     */
    public function enrollmentsForContact($contact_id)
    {
        $endpoint = "/automation/v2/workflows/enrollments/contacts/{$contact_id}";

        return $this->request('get', $endpoint);
    }

    /**
     * Get past events for contact from a workflow.
     *
     * @param int   $workflow_id
     * @param int   $contact_id
     * @param array $params Optional parameters.
     * @return \Fungku\HubSpot\Http\Response
     */
    public function pastEventsForContact($workflow_id, $contact_id, $params = [])
    {
        $endpoint = " /automation/v2/workflows/{$workflow_id}/logevents/contacts/{$contact_id}/past";

        $queryString = $this->buildQueryString($params);

        return $this->request('get', $endpoint, [], $queryString);
    }

    /**
     * Get upcoming (scheduled) events for a contact in a workflow.
     *
     * @param int   $workflow_id
     * @param int   $contact_id
     * @param array $params
     * @return \Fungku\HubSpot\Http\Response
     */
    public function upcomingEventsForContact($workflow_id, $contact_id, $params = [])
    {
        $endpoint = "/automation/v2/workflows/{$workflow_id}/logevents/contacts/{$contact_id}/upcoming";

        $queryString = $this->buildQueryString($params);

        return $this->request('get', $endpoint, [], $queryString);
    }

}
