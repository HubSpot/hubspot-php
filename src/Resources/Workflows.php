<?php

namespace SevenShores\Hubspot\Resources;

/**
 * @see https://developers.hubspot.com/docs/methods/workflows/v3/get_workflows
 */
class Workflows extends Resource
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
    public function create($workflow)
    {
        $endpoint = 'https://api.hubapi.com/automation/v3/workflows';
        $options['json'] = $workflow;
        return $this->client->request('post', $endpoint, $options);
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
     * @param int $contactId
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function enrollmentsForContact($contactId)
    {
        $endpoint = "https://api.hubapi.com/automation/v2/workflows/enrollments/contacts/{$contactId}";
        
        return $this->client->request('get', $endpoint);
    }
    
    /**
     * Get a history of events for a specific workflow, filtered for a
     * specific contact and/or event type(s).
     *
     * @param int   $workflowId
     * @param array $filter
     * @param array $params      Optional parameters.
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function logEvents($workflowId, $filter, $params = [])
    {
        $endpoint = "https://api.hubapi.com/automation/v3/logevents/workflows/{$workflowId}/filter";
        
        $options['json'] = $filter;
        $queryString = build_query_string($params);
        
        return $this->client->request('put', $endpoint, $options, $queryString);
    }
}