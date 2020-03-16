<?php

namespace SevenShores\Hubspot\Resources;

/**
 * @see https://developers.hubspot.com/docs/methods/pipelines/pipelines_overview
 */
class CrmPipelines extends Resource
{
    /**
     * Get all of the pipelines for the specified object type.
     * This currently supports pipelines for deals and tickets.
     *
     * @param string $objectType | Currently supports tickets or deals only
     * @param array  $params     | Array of optional parameter ['includeInactive' => 'EXCLUDE_DELETED' (default) | 'INCLUDE_DELETED']
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @see https://developers.hubspot.com/docs/methods/pipelines/get_pipelines_for_object_type
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function all(string $objectType, array $params = [])
    {
        $endpoint = "https://api.hubapi.com/crm-pipelines/v1/pipelines/{$objectType}";

        $query = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $query);
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
    public function create(string $objectType, array $properties)
    {
        $endpoint = "https://api.hubapi.com/crm-pipelines/v1/pipelines/{$objectType}";

        $options['json'] = $properties;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Update an existing pipeline.
     *
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     *
     * @see https://developers.hubspot.com/docs/methods/pipelines/update_pipeline
     */
    public function update(string $objectType, string $id, array $properties)
    {
        $endpoint = "https://api.hubapi.com/crm-pipelines/v1/pipelines/{$objectType}/{$id}";

        $options['json'] = $properties;

        return $this->client->request('put', $endpoint, $options);
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
    public function delete(string $objectType, string $id)
    {
        $endpoint = "https://api.hubapi.com/crm-pipelines/v1/pipelines/{$objectType}/{$id}";

        return $this->client->request('delete', $endpoint);
    }
}
