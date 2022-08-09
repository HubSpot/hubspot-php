<?php

namespace SevenShores\Hubspot\Endpoints;

/**
 * @see https://developers.hubspot.com/docs/methods/deal-pipelines/overview
 * @see CrmPipelines Please use CrmPipelines to manage deal pipelines.
 * @deprecated
 */
class DealPipelines extends Endpoint
{
    /**
     * Get all pipelines.
     *
     * @see https://developers.hubspot.com/docs/methods/deal-pipelines/get-all-deal-pipelines
     * @see CrmPipelines->all
     * @deprecated
     *
     * @return mixed
     */
    public function getAllPipelines()
    {
        $endpoint = 'https://api.hubapi.com/deals/v1/pipelines';

        return $this->client->request('get', $endpoint);
    }

    /**
     * Get single pipeline by id.
     *
     * @param int $id
     *
     * @see https://developers.hubspot.com/docs/methods/deal-pipelines/get-deal-pipeline
     * @see CrmPipelines->all
     * @deprecated
     *
     * @return mixed
     */
    public function getPipeline($id)
    {
        $endpoint = "https://api.hubapi.com/deals/v1/pipelines/{$id}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Create a pipeline.
     *
     * @see https://developers.hubspot.com/docs/methods/deal-pipelines/create-deal-pipeline
     * @see CrmPipelines->create
     * @deprecated
     *
     * @return mixed
     */
    public function create(array $pipeline)
    {
        $endpoint = 'https://api.hubapi.com/deals/v1/pipelines';

        return $this->client->request('post', $endpoint, ['json' => $pipeline]);
    }

    /**
     * Update a pipeline.
     *
     * @param int $id
     *
     * @see https://developers.hubspot.com/docs/methods/deal-pipelines/update-deal-pipeline
     * @see CrmPipelines->update
     * @deprecated
     *
     * @return mixed
     */
    public function update($id, array $pipeline)
    {
        $endpoint = "https://api.hubapi.com/deals/v1/pipelines/{$id}";

        return $this->client->request('put', $endpoint, ['json' => $pipeline]);
    }

    /**
     * Delete a pipeline.
     *
     * @param int $id
     *
     * @see https://developers.hubspot.com/docs/methods/deals/delete_deal_pipeline
     * @see CrmPipelines->delete
     * @deprecated
     *
     * @return mixed
     */
    public function delete($id)
    {
        $endpoint = "https://api.hubapi.com/deals/v1/pipelines/{$id}";

        return $this->client->request('delete', $endpoint);
    }
}
