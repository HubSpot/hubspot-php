<?php

namespace Fungku\HubSpot\Api;

class Companies extends Api
{

    /**
     * Create a company
     * @param $properties
     *
     * @return \Fungku\HubSpot\Http\Response
     */
    public function create($properties)
    {
        $endpoint = '/companies/v2/companies/';
        $options['json'] = ['properties' => $properties];

        return $this->request('post', $endpoint, $options);
    }


}
