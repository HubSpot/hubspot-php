<?php

namespace Fungku\HubSpot\API;

/**
* Copyright 2011 HubSpot, Inc.
*
*   Licensed under the Apache License, Version 2.0 (the
* "License"); you may not use this file except in compliance
* with the License.
*   You may obtain a copy of the License at
*
*       http://www.apache.org/licenses/LICENSE-2.0
*
*   Unless required by applicable law or agreed to in writing,
* software distributed under the License is distributed on an
* "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND,
* either express or implied.  See the License for the specific
* language governing permissions and limitations under the
* License.
*/

class Prospects extends BaseClient {
    //Client for HubSpot Prospects API.

    //Define required client variables
    protected $API_PATH = 'prospects';
    protected $API_VERSION = 'v1';

    /**
    * Get a listing of the prospects timeline
    *
    * @param params: Array of query parameters
    * @returns Array of Prospects as stdObjects
    *
    * @throws HubSpotException
    **/
    public function get_timeline($params) {
        $endpoint = 'timeline';
        try {
            return json_decode($this->execute_get_request($this->get_request_url($endpoint,$params)));
        } catch (HubSpotException $e) {
            throw new HubSpotException('Unable to retrieve timeline: ' . $e);
        }
    }

    /**
    * Get details about a specific organization
    *
    * @param organization: Organization to retrieve
    * @returns Array of Organization details as stdObjects
    *
    * @throws HubSpotException
    **/
    public function get_organization_details($organization) {
        $endpoint = 'timeline/' . $organization;
        try {
            return json_decode($this->execute_get_request($this->get_request_url($endpoint,null)));
        } catch (HubSpotException $e) {
            throw new HubSpotException('Unable to retrieve organization details: ' . $e);
        }
    }

    /**
    * Get typeahead information
    *
    * @param query: Query string
    * @returns Array of typeahead results
    *
    * @throws HubSpotException
    **/
    public function get_typeahead($query) {
        $endpoint = 'typeahead';
        $params = array('q'=>$query);
        try {
            return json_decode($this->execute_get_request($this->get_request_url($endpoint,$params)));
        } catch (HubSpotException $e) {
            throw new HubSpotException('Unable to retrieve typeahead information: ' . $e);
        }
    }

    /**
    * Get search results
    *
    * @param type: Type of search: city, region, or country
    * @param query: Query string
    * @returns Array of search results
    *
    * @throws HubSpotException
    **/
    public function get_search_results($type, $query) {
        if (($type != 'city')&&($type!='region')&&($type!='country')) {
            throw new HubSpotException('Invalid type: ' . $type . ' Type must be equal to city, region, or country');
        }
        $endpoint = 'search/' . $type;
        $params = array('q'=>$query);
        try {
            return json_decode($this->execute_get_request($this->get_request_url($endpoint,$params)));
        } catch (HubSpotException $e) {
            throw new HubSpotException('Unable to retrieve search results: ' . $e);
        }
    }

    /**
    * Get a list of existing filters
    *
    * @returns Array of filters as stdObjects
    *
    * @throws HubSpotException
    **/
    public function get_filters() {
        $endpoint = 'filters';
        try {
            return json_decode($this->execute_get_request($this->get_request_url($endpoint,null)));
        } catch (HubSpotException $e) {
            throw new HubSpotException('Unable to retrieve filters: ' . $e);
        }
    }

    /**
    * Add a filter
    *
    * @param organization: String value of the name of the organization to hide
    *
    * @returns Body of POST request
    *
    * @throws HubSpotException
    **/
    public function add_filter($organization) {
        $endpoint = 'filters';

        if ($this->isBlank($organization)) {
            throw new HubSpotException('Organization is required');
        }

        $params = array('organization'=>$organization);

        $body = $this->array_to_params($params);
        try {
            return $this->execute_post_request($this->get_request_url($endpoint,null), $body);
        } catch (HubSpotException $e) {
            throw new HubSpotException('Unable to add filter: ' . $e);
        }
    }

    /**
    * Delete a filter
    *
    * @param organization: String value of the name of the organization to unhide
    *
    * @returns Body of POST request
    *
    * @throws HubSpotException
    **/
    public function delete_filter($organization) {
        $endpoint = 'filters';

        if ($this->isBlank($organization)) {
            throw new HubSpotException('Organization is required');
        }

        $params = array('organization'=>$organization);

        $body = $this->array_to_params($params);
        try {
            return $this->execute_delete_request($this->get_request_url($endpoint,null), $body);
        } catch (HubSpotException $e) {
            throw new HubSpotException('Unable to delete filter: ' . $e);
        }
    }

}