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

class Settings extends BaseClient {
    //Client for HubSpot Settings API.

    //Define required client variables
    protected $API_PATH = 'settings';
    protected $API_VERSION = 'v1';

    /**
    * Get a list of settings
    *
    * @returns Array of Settings as stdObjects
    *
    * @throws HubSpotException
    **/
    public function get_settings() {
        $endpoint = 'settings';
        try {
            return json_decode($this->execute_get_request($this->get_request_url($endpoint,null)));
        } catch (HubSpotException $e) {
            throw new HubSpotException('Unable to retrieve settings: ' . $e);
        }
    }

    /**
    * Get a specific setting
    *
    * @param settingName: String value of setting name to be retrieved
    *
    * @returns Setting as stdObject
    *
    * @throws HubSpotException
    **/
    public function get_setting($settingName) {
        $endpoint = 'settings';
        $params = array('name'=>$settingName);
        try {
            return json_decode($this->execute_get_request($this->get_request_url($endpoint,$params)));
        } catch (HubSpotException $e) {
            throw new HubSpotException('Unable to retrieve setting: ' . $e);
        }
    }

    /**
    * Update a setting value
    *
    * @param settingName: String name of the setting to be updated
    * @param value: String value that setting should be valued to
    *
    * @returns Body of POST request
    *
    * @throws HubSpotException
    **/
    public function update_setting($settingName, $value) {
        $endpoint = 'settings';
        $params = array('name'=>$settingName, 'value'=>$value);
        $body = $this->array_to_params($params);
        try {
            return $this->execute_post_request($this->get_request_url($endpoint,null), $body);
        } catch (HubSpotException $e) {
            throw new HubSpotException('Unable to update setting: ' . $e);
        }

    }

    /**
    * Delete a setting
    *
    * @param settingName: String name of the setting to be deleted
    *
    * @returns Body of DELETE request
    *
    * @throws HubSpotException
    **/
    public function delete_setting($settingName) {
        $endpoint = 'settings';
        $params = array('name'=>$settingName);
        $body = $this->array_to_params($params);
        try {
            return $this->execute_delete_request($this->get_request_url($endpoint,null), $body);
        } catch (HubSpotException $e) {
            throw new HubSpotException('Unable to delete setting: ' . $e);
        }
    }
}