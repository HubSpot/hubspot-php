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

class Lists extends BaseClient {

	protected $API_PATH = 'contacts';
	protected $API_VERSION = 'v1';

	/**
	* Create a new List
	*
	*@param params: Array of required and optional parameters for the list.
	*				This will include: name, dynamic (true/false), portalID, and an array of filters
	*
	* @return Response body from HTTP POST request
	*
	* @throws HubSpotException
	**/
	public function create_list($params){
		$endpoint = 'lists';

		try{
			return json_decode($this->execute_JSON_post_request($this->get_request_url($endpoint,null),json_encode($params)));
		}
		catch(HubSpotException $e){
			print_r("Unable to create list: ".$e);
		}
	}

	/**
	* Update a List
	*
	*@param params: Array of required and optional parameters for the list.
	*				This will include: name, dynamic (true/false), portalID, and an array of filters
	*		id: Unique ID of the list to update
	*
	* @return Response body from HTTP POST request
	*
	* @throws HubSpotException
	**/
	public function update_list($id, $params){
		$endpoint = 'lists/'.$id;
		try{
			return json_decode($this->execute_JSON_post_request($this->get_request_url($endpoint,null),json_encode($params)));
		}
		catch(HubSpotException $e){
			print_r("Unable to update list: ".$e);
		}
	}

	/**
	* Delete a List
	*
	*@param id: Unique ID of the list to delete
	*		
	*
	* @return Response body from HTTP POST request
	*
	* @throws HubSpotException
	**/
	public function delete_list($id){
		$endpoint = 'lists/'.$id;
		try{
			return json_decode($this->execute_delete_request($this->get_request_url($endpoint,null)));
		}
		catch(HubSpotException $e){
			print_r("Unable to delete list: ".$e);
		}
	}

	/**
	* Get a contact List by ID
	*
	*@param id: Unique ID of the list to retrieve
	*		
	*
	* @return JSON object for the requested List
	*
	* @throws HubSpotException
	**/
	public function get_list($id){
		$endpoint = 'lists/'.$id;
		try{
			return json_decode($this->execute_get_request($this->get_request_url($endpoint,null)));
		}
		catch(HubSpotException $e){
			print_r('Unable to retrieve list: '.$e);
		}
	}

	/**
	* Get all Lists
	*
	*@param params: Array of parameters for request URL
	*				count: number of lists to return
	*				offset: offset number at which to start the list query
	*				The list results will have a 'has-more' field which will indicate 
	*				if there are more lists to be returned, as well as an 'offset' field
	*				to indicate where to start the next query if there are more results
	*		
	*
	* @return JSON objects for the requested Lists
	*
	* @throws HubSpotException
	**/
	public function get_lists($params){
		$endpoint = 'lists';
		try{
			return json_decode($this->execute_get_request($this->get_request_url($endpoint,$params)));
		}
		catch(HubSpotException $e){
			print_r('Unable to get lists: '.$e);
		}
	}

	/**
	* Get static Lists
	*
	*@param params: Array of parameters for request URL
	*				count: number of lists to return
	*				offset: offset number at which to start the list query
	*				The list results will have a 'has-more' field which will indicate 
	*				if there are more lists to be returned, as well as an 'offset' field
	*				to indicate where to start the next query if there are more results
	*		
	*
	* @return JSON objects for the requested Lists
	*
	* @throws HubSpotException
	**/
	public function get_static_lists($params){
		$endpoint = 'lists/static';
		try{
			return json_decode($this->execute_get_request($this->get_request_url($endpoint,$params)));
		}
		catch(HubSpotException $e){
			print_r('Unable to get lists: '.$e);
		}
	}

	/**
	* Get dynamic Lists
	*
	*@param params: Array of parameters for request URL
	*				count: number of lists to return
	*				offset: offset number at which to start the list query
	*				The list results will have a 'has-more' field which will indicate 
	*				if there are more lists to be returned, as well as an 'offset' field
	*				to indicate where to start the next query if there are more results
	*		
	*
	* @return JSON objects for the requested Lists
	*
	* @throws HubSpotException
	**/
	public function get_dynamic_lists($params){
		$endpoint = 'lists/dynamic';
		try{
			return json_decode($this->execute_get_request($this->get_request_url($endpoint,$params)));
		}
		catch(HubSpotException $e){
			print_r('Unable to get lists: '.$e);
		}
	}

	/**
	* Get Contacts in a List
	*
	*@param params: Array of parameters for request URL
	*				count: number of lists to return
	*				vidOffset: offset contact vid at which to start the query
	*				The results will have a 'has-more' field which will indicate 
	*				if there are more contacts to be returned, as well as a 'vid-offset' field
	*				to indicate where to start the next query if there are more results
	*				property: Use this to return only one contact property in the results
	*		id: ID of the list to return
	*		
	*
	* @return JSON objects for the requested Contacts
	*
	* @throws HubSpotException
	**/
	public function get_contacts_in_list($params, $id){
		$endpoint = 'lists/'.$id.'/contacts/all';
		try{
			return json_decode($this->execute_get_request($this->get_request_url($endpoint,$params)));
		}
		catch(HubSpotException $e){
			print_r('Unable to get contacts: '.$e);
		}
	}

	/**
	* Get recently updated Contacts in a List
	*
	*@param params: Array of parameters for request URL
	*				count: number of lists to return
	*				timeOffset: time offset at which to start the query
	*				The results will have a 'has-more' field which will indicate 
	*				if there are more contacts to be returned, as well as a 'time-offset' field
	*				to indicate where to start the next query if there are more results
	*				property: Use this to return only one contact property in the results
	*				id: ID of the list to return
	*		
	*
	* @return JSON objects for the requested Contacts
	*
	* @throws HubSpotException
	**/
	public function get_recent_contacts_in_list($params, $id){
		$endpoint = 'lists/'.$id.'/contacts/recent';
		try{
			return json_decode($this->execute_get_request($this->get_request_url($endpoint,$params)));
		}
		catch(HubSpotException $e){
			print_r('Unable to get contacts: '.$e);
		}
	}


	/**
	* Refresh a Contact List
	*
	*@param id: Unique ID of the list to refresh
	*		
	*
	* @return Resonse body from HTTP POST request
	*
	* @throws HubSpotException
	**/
	public function refresh_list($id){
		$endpoint = 'lists/'.$id.'/refresh';
		try{
			return $this->execute_post_request($this->get_request_url($endpoint,null),null);
		}
		catch(HubSpotException $e){
			print_r("Unable to refresh list: ".$e);
		}
	}

	/**
	* Add Contacts to static List
	*
	*@param vids: Unassociated array of vids for contacts to add to list
	*		id: ID of list to add contacts to
	*		
	*
	* @return Resonse body from HTTP POST request
	*
	* @throws HubSpotException
	**/
	public function add_contacts_to_list($vids,$id){
		$endpoint = 'lists/'.$id.'/add';
		$request_body = array('vids'=>$vids);
		try{
			return $this->execute_JSON_post_request($this->get_request_url($endpoint,null),json_encode($request_body));
		}
		catch(HubSpotException $e){
			print_r("Unable to add contacts: ".$e);
		}
	}

	/**
	* Remove Contacts from static List
	*
	*@param vids: Unassociated array of vids for contacts to remove from
	*		id: ID of list to remove contacts from
	*		
	*
	* @return Resonse body from HTTP POST request
	*
	* @throws HubSpotException
	**/
	public function remove_contacts_from_list($vids,$id){
		$endpoint = 'lists/'.$id.'/remove';
		$request_body = array('vids'=>$vids);
		try{
			return $this->execute_JSON_post_request($this->get_request_url($endpoint,null),json_encode($request_body));
		}
		catch(HubSpotException $e){
			print_r("Unable to add contacts: ".$e);
		}
	}


}

?>
