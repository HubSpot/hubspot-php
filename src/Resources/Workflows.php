<?php

namespace SevenShores\Hubspot\Resources;

class Workflows extends Resource
{
    /**
     * Get all workflows.
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function all()
    {
        $endpoint = 'https://api.hubapi.com/automation/v3/workflows';

        return $this->client->request('get', $endpoint);
    }

    /**
     * Get a specific workflow.
     *
     * @param int $id
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getById($id)
    {
        $endpoint = "https://api.hubapi.com/automation/v3/workflows/{$id}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Enroll a contact in a workflow.
     *
     * @param int    $workflow_id
     * @param string $email
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function enrollContact($workflow_id, $email)
    {
        $endpoint = "https://api.hubapi.com/automation/v2/workflows/{$workflow_id}/enrollments/contacts/{$email}";

        return $this->client->request('post', $endpoint);
    }

    /**
     * Unenroll a contact from a workflow.
     *
     * @param int    $workflow_id
     * @param string $email
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function unenrollContact($workflow_id, $email)
    {
        $endpoint = "https://api.hubapi.com/automation/v2/workflows/{$workflow_id}/enrollments/contacts/{$email}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Create a new workflow.
     *
     * @param array $workflow The workflow properties
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function create($workflow)
    {
        $endpoint = 'https://api.hubapi.com/automation/v3/workflows';

        $options['json'] = $workflow;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Delete a workflow.
     *
     * @param int $id
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function delete($id)
    {
        $endpoint = "https://api.hubapi.com/automation/v3/workflows/{$id}";

        return $this->client->request('delete', $endpoint, []);
    }

    /**
     * Get current enrollments for a contact.
     *
     * @param int $contact_id
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function enrollmentsForContact($contact_id)
    {
        $endpoint = "https://api.hubapi.com/automation/v2/workflows/enrollments/contacts/{$contact_id}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Get a history of events for a specific workflow, filtered for a
     * specific contact and/or event type(s).
     *
     * @param int   $workflow_id
     * @param array $filter
     * @param array $params       Optional parameters.
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function logEvents($workflow_id, $filter, $params = [])
    {
        $endpoint = "https://api.hubapi.com/automation/v3/logevents/workflows/{$workflow_id}/filter";

        $options['json'] = $filter;

        $queryString = build_query_string($params);

        return $this->client->request('put', $endpoint, $options, $queryString);
    }
}
