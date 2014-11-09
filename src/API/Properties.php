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

class Properties extends BaseClient{

	protected $API_PATH = 'contacts';
	protected $API_VERSION = 'v1';	

	/**
	* Get all Properties
	*
	*
	* @return Array of all properties in portal
	*
	* @throws HubSpotException
	**/
	public function get_all_properties(){
		$endpoint = 'properties';

		try{
			return json_decode($this->execute_get_request($this->get_request_url($endpoint,null)));
		}
		catch(HubSpotException $e){
			print_r('Unable to retrieve properties: '.$e);
		}
	}

	/**
	* Create a new Property
	*
	*@param name: Name for the new property
	*		params: Array of info for the new property. Example of fields to include:
	*		
    *            "name": "newcustomproperty",
    *            "label": "A New Custom Property",
    *            "description": "A new property for you",
    *            "groupName": "contactinformation",
    *            "type": "string",
    *            "fieldType": "text",
    *            "formField": true,
    *            "displayOrder": 6,
    *            "options": []
    *    					
	*
	* @return Response body from HTTP PUT request
	*
	* @throws HubSpotException
	**/
	public function create_property($name,$params){
		$endpoint = 'properties/'.$name;

		try{
			return json_decode($this->execute_put_request($this->get_request_url($endpoint,null),json_encode($params)));
		}
		catch(HubSpotException $e){
			print_r('Unable to create property: '.$e);
		}
	}

	/**
	* Update a Property
	*
	*@param name: Name for the new property
	*		params: Array of info for the property. Example of fields to include:
	*		
    *            "name": "newcustomproperty",
    *            "label": "A New Custom Property",
    *            "description": "A new property for you",
    *            "groupName": "contactinformation",
    *            "type": "string",
    *            "fieldType": "text",
    *            "formField": true,
    *            "displayOrder": 6,
    *            "options": []
    *    					
	*
	* @return Response body of HTTP POST request
	*
	* @throws HubSpotException
	**/
	public function update_property($name,$params){
		$endpoint = 'properties/'.$name;

		try{
			return json_decode($this->execute_JSON_post_request($this->get_request_url($endpoint,null),json_encode($params)));
		}
		catch(HubSpotException $e){
			print_r('Unable to update property: '.$e);
		}
	}


	/**
	* Delete a Property
	*	
	* @param name: Name of property to delete
	*
	* @return Response body from HTTP DELETE request
	*
	* @throws HubSpotException
	**/
	public function delete_property($name){
		$endpoint = 'properties/'.$name;

		try{
			return $this->new_execute_delete_request($this->get_request_url($endpoint,null));
		}
		catch(HubSpotException $e){
			print_r('Unable to delete property: '.$e);
		}
	}

	/**
	* Get all Properties Groups
	*
	*
	* @return Array of all property groups in portal
	*
	* @throws HubSpotException
	**/
	public function get_property_groups(){
		$endpoint = 'groups';
		try{
			return json_decode($this->execute_get_request($this->get_request_url($endpoint,null)));
		}
		catch(HubSpotException $e){
			print_r('Unable to retrieve property groups: '.$e);
		}

	}

	/**
	* Get specific Property Group
	*
	*@param name: Name of property group to retrieve
	*
	* @return Array containing requested property group
	*
	* @throws HubSpotException
	**/
	public function get_property_group($name){
		$endpoint = 'groups/'.$name;
		try{
			return json_decode($this->execute_get_request($this->get_request_url($endpoint,null)));
		}
		catch(HubSpotException $e){
			print_r('Unable to retrieve property group: '.$e);
		}

	}

	/**
	* Create a Property Group
	*
	*@param name: Name of property group to retrieve
	*		params: Array for the fields to create the Group. Ex:
	*		{
    *        	"name": "newcustomgroup",
    *        	"displayName": "A New Custom Group",
    *        	"displayOrder": 5
    *    	}
	*
	* @return Array containing requested property group
	*
	* @throws HubSpotException
	**/
	public function create_property_group($name,$params){
		$endpoint = 'groups/'.$name;

		try{
			return json_decode($this->execute_put_request($this->get_request_url($endpoint,null),json_encode($params)));
		}
		catch(HubSpotException $e){
			print_r('Unable to create property group: '.$e);
		}
	}

	/**
	* Update a Property Group
	*
	*@param name: Name of property group to retrieve
	*		params: Array for the fields to create the Group. Ex:
	*		{
    *        	"name": "newcustomgroup",
    *        	"displayName": "A New Custom Group",
    *        	"displayOrder": 5
    *    	}
	*
	* @return Array containing requested property group
	*
	* @throws HubSpotException
	**/
	public function update_property_group($name,$params){
		$endpoint = 'groups/'.$name;

		try{
			return json_decode($this->execute_JSON_post_request($this->get_request_url($endpoint,null),json_encode($params)));
		}
		catch(HubSpotException $e){
			print_r('Unable to update property group: '.$e);
		}
	}

	/**
	* Delete a Property Group
	*
	*@param name: Name of property group to retrieve
	*
	* @return Array containing requested property group
	*
	* @throws HubSpotException
	**/
	public function delete_property_group($name){
		$endpoint = 'groups/'.$name;
		try{
			return json_decode($this->execute_delete_request($this->get_request_url($endpoint,null),null));
		}
		catch(HubSpotException $e){
			print_r('Unable to delete property group: '.$e);
		}

	}


}

?>
