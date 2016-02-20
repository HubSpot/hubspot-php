<?php

namespace Fungku\HubSpot\Api;

class Engagements extends Api
{
    /**
     * @param array $engagement Array of engagement engagement.
     * @param array $associations Array of engagement associations.
     * @param array $metadata Array of engagement metadata.
     * @return \Fungku\HubSpot\Http\Response
     */
    public function create($engagement, $associations, $metadata)
    {
        $endpoint = "/engagements/v1/engagements";

        $options['json'] = [
            'engagement' => $engagement,
            'associations' => $associations,
            'metadata' => $metadata,
        ];

        return $this->request('post', $endpoint, $options);
    }

    /**
     * @param int   $id         The engagement id.
     * @param array $engagement The engagement engagement to update.
     * @param array $metadata The engagement metadata to update.
     * @return \Fungku\HubSpot\Http\Response
     */
    public function update($id, $engagement, $metadata)
    {
        $endpoint = "/engagements/v1/engagements/{$id}";

        $options['json'] = [
            'engagement' => $engagement,
            'metadata' => $metadata,
        ];

        return $this->request('put', $endpoint, $options);
    }

    /**
     * @param int $id
     * @return \Fungku\HubSpot\Http\Response
     */
    public function delete($id)
    {
        $endpoint = "/engagements/v1/engagements/{$id}";

        return $this->request('delete', $endpoint);
    }

    /**
     * @param int $id
     * @return \Fungku\HubSpot\Http\Response
     */
    public function get($id)
    {
        $endpoint = "/engagements/v1/engagements/{$id}";

        return $this->request('get', $endpoint);
    }

    /**
     * @param int $id
     * @param string $object_type
     * @param int $object_id
     * @return \Fungku\HubSpot\Http\Response
     **/
    public function associate($id, $object_type, $object_id)
    {
        $endpoint = "/engagements/v1/engagements/{$id}/associations/{$object_type}/{$object_id}";

        return $this->request('put', $endpoint);
    }
}
