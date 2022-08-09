<?php

namespace SevenShores\Hubspot\Endpoints;

/**
 * @see https://developers.hubspot.com/docs/methods/workflows/v3/get_workflows
 */
class Workflows extends Endpoint
{
    /**
     * Get all workflows.
     *
     * @see https://developers.hubspot.com/docs/methods/workflows/v3/get_workflows
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
     * @see https://developers.hubspot.com/docs/methods/workflows/v3/get_workflow
     *
     * @param int $id
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getById($id, array $params = [])
    {
        $endpoint = "https://api.hubapi.com/automation/v3/workflows/{$id}";

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Enroll a contact in a workflow.
     *
     * @see https://developers.hubspot.com/docs/methods/workflows/add_contact
     *
     * @param int    $workflowId
     * @param string $email
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function enrollContact($workflowId, $email)
    {
        $endpoint = "https://api.hubapi.com/automation/v2/workflows/{$workflowId}/enrollments/contacts/{$email}";

        return $this->client->request('post', $endpoint);
    }

    /**
     * Create a new workflow.
     *
     * @see https://developers.hubspot.com/docs/methods/workflows/v3/create_workflow
     *
     * @param array $workflow The workflow properties
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function create(array $workflow, array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/automation/v3/workflows';

        return $this->client->request(
            'post',
            $endpoint,
            ['json' => $workflow],
            build_query_string($params)
        );
    }

    /**
     * Delete a workflow.
     *
     * @see https://developers.hubspot.com/docs/methods/workflows/v3/delete_workflow
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
     * Unenroll a contact from a workflow.
     *
     * @see https://developers.hubspot.com/docs/methods/workflows/remove_contact
     *
     * @param int    $workflowId
     * @param string $email
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function unenrollContact($workflowId, $email)
    {
        $endpoint = "https://api.hubapi.com/automation/v2/workflows/{$workflowId}/enrollments/contacts/{$email}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Get current enrollments for a contact.
     *
     * @see https://developers.hubspot.com/docs/methods/workflows/current_enrollments
     *
     * @param int $contactId
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function currentEnrollments($contactId)
    {
        $endpoint = "https://api.hubapi.com/automation/v2/workflows/enrollments/contacts/{$contactId}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Get performance statistics for a workflow.
     *
     * @see https://developers.hubspot.com/docs/methods/workflows/get_performance_statistics
     *
     * @param int    $workflowId
     * @param int    $startDate  The start date for the data you want. Must be specified as a millisecond timestamp.
     * @param int    $endDate    The end date for the data you want. Must be specified as a millisecond timestamp.
     * @param string $bucket     The time period used to group the data. Must be one of DAY, WEEK, or MONTH
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getPerformanceStatistics($workflowId, $startDate, $endDate, $bucket = 'DAY')
    {
        $endpoint = "https://api.hubapi.com/automation/v3/performance/workflow/{$workflowId}";

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string([
                'start' => $startDate,
                'end' => $endDate,
                'bucket' => $bucket,
            ])
        );
    }
}
