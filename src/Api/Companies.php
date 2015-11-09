<?php

namespace Fungku\HubSpot\Api;

class Companies extends Api
{

    /**
     * Create a company
     * @param array $properties Array of company properties.
     *
     * @return \Fungku\HubSpot\Http\Response
     */
    public function create($properties)
    {
        $endpoint = '/companies/v2/companies/';
        $options['json'] = ['properties' => $properties];

        return $this->request('post', $endpoint, $options);
    }

    /**
     * Updates a company
     * @param int $id The company id.
     * @param array $properties The company properties to update.
     *
     * @return \Fungku\HubSpot\Http\Response
     */
    public function update($id, $properties)
    {
        $endpoint = "/companies/v2/companies/{$id}";
        $options['json'] = ['properties' => $properties];

        return $this->request('put', $endpoint, $options);
    }

    /**
     * Deletes a company
     * @param int $id The company id
     *
     * @return \Fungku\HubSpot\Http\Response
     */
    public function delete($id)
    {
        $endpoint = "/companies/v2/companies/{$id}";

        return $this->request('delete', $endpoint);
    }


}
