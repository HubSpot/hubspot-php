<?php

namespace Fungku\HubSpot\API;

/**
* Copyright 2013 HubSpot, Inc.
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

class Workflows extends BaseClient {
	protected $API_PATH = 'automation';
	protected $API_VERSION = 'v2';


	/**
	* Get all Workflows
	*
	*
	*
	* @return JSON objects for all workflows
	*
	* @throws HubSpotException
	**/
	public function get_all_workflows(){
		$endpoint = 'workflows';
		try{
			return json_decode($this->execute_get_request($this->get_request_url($endpoint,null)));
		}
		catch(HubSpotException $e){
			throw new HubSpotException('Unable to get workflows: '.$e);
		}
	}

	/**
	* Get Workflow by ID
	*
	*@param id: Unique ID for Workflow
	*
	* @return JSON object for requested Workflow
	*
	* @throws HubSpotException
	**/
	public function get_workflow_by_ID($id){
		$endpoint = 'workflows/'.$id;
		try{
			return json_decode($this->execute_get_request($this->get_request_url($endpoint,null)));
		}
		catch(HubSpotException $e){
			throw new HubSpotException('Unable to get workflow: '.$e);
		}
	}

	/**
	* Enroll Contact in Workflow
	*
	*@param wfID: Unique ID for workflow
	*		email: Email address of Contact
	*
	* @return Response body from HTTP POST request
	*
	* @throws HubSpotException
	**/
	public function enroll_contact_in_workflow($wfID, $email){
		$endpoint = 'workflows/'.$wfID.'/enrollments/contacts/'.$email;
		try{
			return $this->execute_post_request($this->get_request_url($endpoint,null),null);
		}
		catch(HubSpotException $e){
			print_r('Unable to enroll contact: '.$e);
		}
	}

	/**
	* Unenroll Contact from Workflow
	*
	*@param wfID: Unique ID for workflow
	*		email: Email address of Contact
	*
	* @return Response body from HTTP POST request
	*
	* @throws HubSpotException
	**/
	public function unenroll_contact_from_workflow($wfID, $email){
		$endpoint = 'workflows/'.$wfID.'/enrollments/contacts/'.$email;
		try {
			return $this->execute_delete_request($this->get_request_url($endpoint,null),null);
		} catch (HubSpotException $e) {
			print_r('Unable to unenroll contact: '.$e);
		}
	}

	/**
	* Get current Workflow enrollments from Contact vid
	*
	*@param vid: Unique ID for Contact
	*
	* @return Response body from HTTP GET request
	*
	* @throws HubSpotException
	**/
	public function get_current_enrollments($vid){
		$endpoint = 'workflows/enrollments/contacts/'.$vid;
		try{
			return json_decode($this->execute_get_request($this->get_request_url($endpoint,null)));
		}
		catch(HubSpotException $e){
			throw new HubSpotException('Unable get enrollments for contact: '.$e);
		}
	}

	/**
	* Get log events for Contact in given Workflow
	*
	*@param wfID: Unique ID for Workflow
	*		vid: Unique ID for contact
	*		params: offset: timestamp from which results should start
	*				limitDate: timstamp for which events should not be past				
	*
	* @return Response body from HTTP GET request
	*
	* @throws HubSpotException
	**/
	public function get_log_events($wfID, $vid, $params){
		$endpoint = 'workflows/'.$wfID.'/logevents/contacts/'.$vid.'/past';
		try{
			return json_decode($this->execute_get_request($this->get_request_url($endpoint,$params)));
		}
		catch(HubSpotException $e){
			throw new HubSpotException('Unable get log events for contact: '.$e);
		}
	}	

	/**
	* Get upcoming(scheduled) events for Contact in given Workflow
	*
	*@param wfID: Unique ID for Workflow
	*		vid: Unique ID for contact
	*		params: offset: timestamp from which results should start
	*				limitDate: timstamp for which events should not be past		
	*
	* @return Response body from HTTP GET request
	*
	* @throws HubSpotException
	**/
	public function get_upcoming_events($wfID, $vid, $params){
		$endpoint = 'workflows/'.$wfID.'/logevents/contacts/'.$vid.'/upcoming';
		try{
			return json_decode($this->execute_get_request($this->get_request_url($endpoint,$params)));
		}
		catch(HubSpotException $e){
			throw new HubSpotException('Unable get upcoming events for contact: '.$e);
		}
	}

}






?>