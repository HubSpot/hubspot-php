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

class Keywords extends BaseClient {
    //Client for HubSpot Keywords API.

    //Define required client variables
    protected $API_PATH = 'keywords';
    protected $API_VERSION = 'v1';

    /**
    * Get a list of keywords
    *
    * @returns Array of Keywords as stdObjects
    *
    * @throws HubSpotException
    **/
    public function get_keywords() {
        $endpoint = 'keywords';
        try {
            return json_decode($this->execute_get_request($this->get_request_url($endpoint,null)));
        } catch (HubSpotException $e) {
            throw new HubSpotException('Unable to retrieve keywords: ' . $e);
        }
    }

    /**
    * Get a specific keyword
    *
    * @param keywordGuid: String value of guid of keyword to be retrieved
    *
    * @returns Keyword as stdObject
    *
    * @throws HubSpotException
    **/
    public function get_keyword($keywordGuid) {
        $endpoint = 'keywords/' . $keywordGuid;
        try {
            return json_decode($this->execute_get_request($this->get_request_url($endpoint,null)));
        } catch (HubSpotException $e) {
            throw new HubSpotException('Unable to retrieve keyword: ' . $e);
        }
    }

    /**
    * Add a single keyword
    *
    * @param keyword
    *
    * @returns Body of PUT request
    *
    * @throws HubSpotException
    **/
    public function add_keyword($keyword) {
        $endpoint = 'keywords';
        $params = array('keyword'=>$keyword);
        $body = '{"keyword":"' . $keyword . '"}';
        try {
            return $this->execute_put_request($this->get_request_url($endpoint,null), $body);
        } catch (HubSpotException $e) {
            throw new HubSpotException('Unable to add keyword: ' . $e);
        }

    }

    /**
    * Delete a keyword
    *
    * @param keywordGuid: String value of guid of keyword to be deleted
    *
    * @returns Body of DELETE request
    *
    * @throws HubSpotException
    **/
    public function delete_keyword($keywordGuid) {
        $endpoint = 'keywords/' . $keywordGuid;
        try {
            return $this->execute_delete_request($this->get_request_url($endpoint,null), null);
        } catch (HubSpotException $e) {
            throw new HubSpotException('Unable to delete keyword: ' . $e);
        }
    }
}