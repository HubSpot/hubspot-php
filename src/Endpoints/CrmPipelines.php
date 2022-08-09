<?php

namespace SevenShores\Hubspot\Endpoints;

/**
 * @see https://developers.hubspot.com/docs/methods/pipelines/pipelines_overview
 */
class CrmPipelines extends Endpoint
{
    /**
     * @var string
     */
    protected $objectType;

    public function __construct($client, string $objectType)
    {
        parent::__construct($client);

        $this->objectType = $objectType;
    }

    /**
     * Get all of the pipelines for the specified object type.
     * This currently supports pipelines for deals and tickets.
     *
     * @param array $params | Array of optional parameter ['includeInactive' => 'EXCLUDE_DELETED' (default) | 'INCLUDE_DELETED']
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @see https://developers.hubspot.com/docs/methods/pipelines/get_pipelines_for_object_type
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function all(array $params = [])
    {
        $endpoint = "https://api.hubapi.com/crm-pipelines/v1/pipelines/{$this->objectType}";

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }

    /**
     * Create a new pipeline.
     *
     * @param array $properties Array of pipeline properties
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @see https://developers.hubspot.com/docs/methods/pipelines/create_new_pipeline
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function create(array $properties)
    {
        $endpoint = "https://api.hubapi.com/crm-pipelines/v1/pipelines/{$this->objectType}";

        return $this->client->request('post', $endpoint, ['json' => $properties]);
    }

    /**
     * Update an existing pipeline.
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @see https://developers.hubspot.com/docs/methods/pipelines/update_pipeline
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function update(string $id, array $properties)
    {
        $endpoint = "https://api.hubapi.com/crm-pipelines/v1/pipelines/{$this->objectType}/{$id}";

        return $this->client->request('put', $endpoint, ['json' => $properties]);
    }

    /**
     * Delete an existing pipeline.
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @see https://developers.hubspot.com/docs/methods/pipelines/delete_pipeline
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function delete(string $id)
    {
        $endpoint = "https://api.hubapi.com/crm-pipelines/v1/pipelines/{$this->objectType}/{$id}";

        return $this->client->request('delete', $endpoint);
    }
}
