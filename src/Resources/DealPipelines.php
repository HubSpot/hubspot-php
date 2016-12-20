<?php
namespace SevenShores\Hubspot\Resources;

class DealPipelines extends Resource {

    public function getAllPipelines()
    {
        $endpoint = 'https://api.hubapi.com/deals/v1/pipelines';

        return $this->client->request('get', $endpoint);

    }

    public function getPipeline($id)
    {
        $endpoint = "https://api.hubapi.com/deals/v1/pipelines/{$id}";

        return $this->client->request('get', $endpoint);
    }

    public function create(array $pipeline)
    {
        $endpoint = "https://api.hubapi.com/deals/v1/pipelines";

        $options['json'] = $pipeline;

        return $this->client->request('post', $endpoint, $options);
    }

    public function update($id, array $pipeline)
    {
        $endpoint = "https://api.hubapi.com/deals/v1/pipelines/{$id}";

        $options['json'] = $pipeline;

        return $this->client->request('put', $endpoint, $options);
    }

    public function delete($id)
    {
        $endpoint = "https://api.hubapi.com/deals/v1/pipelines/{$id}";

        return $this->client->request('delete', $endpoint);
    }
}