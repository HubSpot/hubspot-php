<?php

namespace Fungku\HubSpot\Api;

class Workflows extends Api
{
    /**
     * Get all workflows.
     *
     * @return mixed
     */
    public function all()
    {
        $endpoint = "/automation/v2/workflows";

        return $this->request('get', $endpoint);
    }

    /**
     * Get a specific workflow.
     *
     * @param int $id Workflow ID
     *
     * @return mixed
     */
    public function getById($id)
    {
        $endpoint = "/automation/v2/workflows/{$id}";

        return $this->request('get', $endpoint);
    }

    /**
     * Enroll a contact in a workflow.
     *
     * @param int    $workflow_id Workflow ID
     * @param string $email       Email address
     *
     * @return mixed
     */
    public function enrollContact($workflow_id, $email)
    {
        $endpoint = "/automation/v2/workflows/{$workflow_id}/enrollments/contacts/{$email}";

        return $this->request('get', $endpoint);
    }

    /**
     * Unenroll a contact from a workflow.
     *
     * @param int    $workflow_id Workflow ID
     * @param string $email       Email address
     *
     * @return mixed
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
     *
     * @return mixed
     */
    public function create(array $workflow)
    {
        $endpoint = "/automation/v2/workflows";

        $options['json'] = $workflow;

        return $this->request('post', $endpoint, $options);
    }

    /**
     * Delete a workflow.
     *
     * @param int $id Workflow ID
     *
     * @return mixed
     */
    public function delete($id)
    {
        $endpoint = "/automation/v2/workflows/{$id}";

        $options['query'] = array('updatedAt' => time());

        return $this->request('delete', $endpoint, $options);
    }

    /**
     * Get current enrollments for a contact.
     *
     * @param int $contact_id Contact Id
     *
     * @return mixed
     */
    public function enrollmentsForContact($contact_id)
    {
        $endpoint = "/automation/v2/workflows/enrollments/contacts/{$contact_id}";

        return $this->request('get', $endpoint);
    }

    /**
     * Get past events for contact from a workflow.
     *
     * @param int   $workflow_id Wofkflow Id
     * @param int   $contact_id  Contact Id
     * @param array $params      Optional parameters.
     *
     * @return mixed
     */
    public function pastEventsForContact($workflow_id, $contact_id, $params)
    {
        $endpoint = " /automation/v2/workflows/{$workflow_id}/logevents/contacts/{$contact_id}/past";

        $options['query'] = $this->getQuery($params);

        return $this->request('get', $endpoint, $options);
    }

    /**
     * Get upcoming (scheduled) events for a contact in a workflow.
     *
     * @param int   $workflow_id Workflow ID
     * @param int   $contact_id  Contact ID
     * @param array $params      Parameters
     *
     * @return mixed
     */
    public function upcomingEventsForContact($workflow_id, $contact_id, $params)
    {
        $endpoint = "/automation/v2/workflows/{$workflow_id}/logevents/contacts/{$contact_id}/upcoming";

        $options['query'] = $this->getQuery($params);

        return $this->request('get', $endpoint, $options);
    }
}
