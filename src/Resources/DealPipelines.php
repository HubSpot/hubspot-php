<?php

namespace SevenShores\Hubspot\Resources;

class DealPipelines extends Resource {

    /**
     * Get all pipelines
     *
     * @return mixed
     */
    public function getAllPipelines()
    {
        $endpoint = 'https://api.hubapi.com/deals/v1/pipelines';

        return $this->client->request('get', $endpoint);
    }

    /**
     * Get single pipeline by id
     *
     * @param  int $id
     *
     * @return mixed
     */
    public function getPipeline($id)
    {
        $endpoint = "https://api.hubapi.com/deals/v1/pipelines/{$id}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Create a pipeline
     *
     * @param  array $pipeline
     *
     * @return mixed
     */
    public function create(array $pipeline)
    {
        $endpoint = "https://api.hubapi.com/deals/v1/pipelines";

        $options['json'] = $pipeline;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Update a pipeline
     *
     * @param  int $id
     * @param  array $pipeline
     *
     * @return mixed
     */
    public function update($id, array $pipeline)
    {
        $endpoint = "https://api.hubapi.com/deals/v1/pipelines/{$id}";

        $options['json'] = $pipeline;

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * Delete a pipeline
     *
     * @param  int $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        $endpoint = "https://api.hubapi.com/deals/v1/pipelines/{$id}";

        return $this->client->request('delete', $endpoint);
    }
}