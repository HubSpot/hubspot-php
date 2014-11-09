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

class LeadNurturing extends BaseClient {
    //Client for HubSpot Lead Nurturing API.

    //Define required client variables
    protected $API_PATH = 'nurture';
    protected $API_VERSION = 'v1';

    /**
    * Get a list of campaigns
    *
    * @param excludeInactive: Boolean that excludes inactive campaigns when true
    * @returns Array of Campaigns as stdObjects
    *
    * @throws HubSpotException
    **/
    public function get_campaigns($excludeInactive) {
        $endpoint = 'campaigns';
        if ($excludeInactive) {
            $params = array('excludeInactive'=>1);
        } else {
            $params = array('excludeInactive'=>0);
        }
        try {
            return json_decode($this->execute_get_request($this->get_request_url($endpoint,$params)));
        } catch (HubSpotException $e) {
            throw new HubSpotException('Unable to retrieve campaigns: ' . $e);
        }
    }

    /**
    * Get a list of leads in a campaign
    *
    * @param campaignGuid: String value of guid of campaign to list
    * @returns Array of Campaign Members as stdObjects
    *
    * @throws HubSpotException
    **/
    public function get_campaign_members($campaignGuid) {
        $endpoint = 'campaign/' . $campaignGuid . '/list';
        try {
            return json_decode($this->execute_get_request($this->get_request_url($endpoint,null)));
        } catch (HubSpotException $e) {
            throw new HubSpotException('Unable to retrieve campaign members: ' . $e);
        }
    }

    /**
    * Get campaign history for a lead
    *
    * @param leadGuid: String value of guid of lead to list
    * @returns Array of Campaign Members as stdObjects
    *
    * @throws HubSpotException
    **/
    public function get_campaign_history($leadGuid) {
        $endpoint = 'lead/' . $leadGuid;
        try {
            return json_decode($this->execute_get_request($this->get_request_url($endpoint,null)));
        } catch (HubSpotException $e) {
            throw new HubSpotException('Unable to retrieve campaign history: ' . $e);
        }
    }

    /**
    * Enroll a lead in a campaign
    *
    * @param campaignGuid: String value of guid of campaign to add lead to
    * @param leadGuid: String value of guid of lead to add to campaign
    * @returns POST request body
    *
    * @throws HubSpotException
    **/
    public function enroll_lead_in_campaign($campaignGuid, $leadGuid) {
        $endpoint = 'campaign/' . $campaignGuid . '/add';
        $body = $leadGuid;
        try {
            return $this->execute_post_request($this->get_request_url($endpoint,null), $body);
        } catch (HubSpotException $e) {
            throw new HubSpotException('Unable to add lead to campaign: ' . $e);
        }
    }

    /**
    * Remove a lead from a campaign
    *
    * @param campaignGuid: String value of guid of campaign to remove lead from
    * @param leadGuid: String value of guid of lead to remove from campaign
    * @returns POST request body
    *
    * @throws HubSpotException
    **/
    public function remove_lead_from_campaign($campaignGuid, $leadGuid) {
        $endpoint = 'campaign/' . $campaignGuid . '/remove';
        $body = $leadGuid;
        try {
            return $this->execute_post_request($this->get_request_url($endpoint,null), $body);
        } catch (HubSpotException $e) {
            throw new HubSpotException('Unable to remove lead to campaign: ' . $e);
        }
    }

}