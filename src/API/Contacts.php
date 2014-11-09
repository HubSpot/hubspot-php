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

class Contacts extends BaseClient {
	//Client for HubSpot Contacts API

	//Define required client variables
	protected $API_PATH = 'contacts';
	protected $API_VERSION = 'v1';

    /**
    * Create a Contact
    *
    *@param params: array of properties and property values for new contact, email is required
    *
    * @return Response body with JSON object 
    * for created Contact from HTTP POST request
    *
    * @throws HubSpotException
    **/
    public function create_contact($params){
    	$endpoint = 'contact';
    	$properties = array();
    	foreach ($params as $key => $value) {
    		array_push($properties, array("property"=>$key,"value"=>$value));
    	}
    	$properties = json_encode(array("properties"=>$properties));
    	try{
    		return json_decode($this->execute_JSON_post_request($this->get_request_url($endpoint,null),$properties));
    	} catch (HubSpotException $e) {
    		throw new HubSpotException('Unable to create contact: ' . $e);
    	}
    }

    /**
    * Update a Contact
    *
    *@param params: array of properties and property values for contact
    *
    * @return Response body from HTTP POST request
    *
    * @throws HubSpotException
    **/
    public function update_contact($vid, $params){
    	$endpoint = 'contact/vid/'.$vid.'/profile';
    	$properties = array();
    	foreach ($params as $key => $value) {
    		array_push($properties, array("property"=>$key,"value"=>$value));
    	}
    	$properties = json_encode(array("properties"=>$properties));
    	try{
			return json_decode($this->execute_JSON_post_request($this->get_request_url($endpoint,null),$properties));
    	} catch (HubSpotException $e) {
    		throw new HubSpotException('Unable to update contact: ' . $e);
    	}
    }

    /**
	* Delete a Contact
	*
	*@param vid: Unique ID for the contact
	*
	* @return Response body from HTTP POST request
	*
	* @throws HubSpotException
    **/
    public function delete_contact($vid){
    	$endpoint = 'contact/vid/'.$vid;
    	try{
    		return json_decode($this->execute_delete_request($this->get_request_url($endpoint,null),null));
    	}
    	catch (HubSpotException $e) {
    		throw new HubSpotException('Unable to delete contact: ' . $e);
    	}
    }

    /**
	* Get all Contacts
	*
	*@param params: array of 'count' or 'vid-offset' for results
	*
	* @return JSON objects for all Contacts in portal
	*
	* @throws HubSpotException
    **/
    public function get_all_contacts($params){
    	$endpoint = 'lists/all/contacts/all';
    	try{
    		return json_decode($this->execute_get_request($this->get_request_url($endpoint,$params)));
    	}
    	catch(HubSpotException $e){
    		throw new HubSpotException('Unable to get contacts: '.$e);
    	}
    }

    /**
	* Get recently updated Contacts
	*
	*@param params: array of 'count', 'time-offset', or 'vid-offset' for results	
	*
	* @return JSON objects for recently updated Contacts in portal
	*
	* @throws HubSpotException
    **/
    public function get_recent_contacts($params){
    	$endpoint = 'lists/recently_updated/contacts/recent';
    	try{
    		return json_decode($this->execute_get_request($this->get_request_url($endpoint,$params)));
    	}
    	catch(HubSpotException $e){
    		throw new HubSpotException('Unable to get contacts: '.$e);
    	}
    }

    /**
	* Get Contact by ID
	*
	*@param vid: Unique ID for contact
	*
	* @return JSON object for requested Contact
	*
	* @throws HubSpotException
    **/
    public function get_contact_by_id($vid){
    	$endpoint = 'contact/vid/'.$vid.'/profile';
    	try{
    		return json_decode($this->execute_get_request($this->get_request_url($endpoint,null)));
    	}
    	catch(HubSpotException $e){
    		throw new HubSpotException('Unable to get contact: '.$e);
    	}
    }

    /**
	* Get Contact by email address
	*
	*@param email: Email address for Contact
	*
	* @return JSON object for requested contact
	*
	* @throws HubSpotException
    **/
    public function get_contact_by_email($email){
    	$endpoint = 'contact/email/'.$email.'/profile';
    	try{
    		return json_decode($this->execute_get_request($this->get_request_url($endpoint,null)));
    	}
    	catch(HubSpotException $e){
    		throw new HubSpotException('Unable to get contact: '.$e);
    	}
    }

    /**
	* Get Contact by usertoken
	*
	*@param token: Usertoken for contact
	*
	* @return JSON object for requested contact
	*
	* @throws HubSpotException
    **/
    public function get_contact_by_usertoken($token){
    	$endpoint = 'contact/utk/'.$token.'/profile';
    	try{
    		return json_decode($this->execute_get_request($this->get_request_url($endpoint,null)));
    	}
    	catch(HubSpotException $e){
    		throw new HubSpotException('Unable to get contact: '.$e);
    	}
    }

    /**
	* Search for Contacts
	*
	*@param params: q: string to use in query.  count: number of results to return
	*
	* @return JSON object for requested contact
	*
	* @throws HubSpotException
    **/
    public function search_contacts($params){
    	$endpoint = 'search/query';
    	try{
    		return json_decode($this->execute_get_request($this->get_request_url($endpoint,$params)));
    	}
    	catch(HubSpotException $e){
    		throw new HubSpotException("Unable to search contacts: ".$e);
    		
    	}
    }

    /**
	* Get Contacts statistics
	*
	*
	* @return JSON object with Contacts statistics
	*
	* @throws HubSpotException
    **/
    public function get_contacts_statistics(){
    	$endpoint = 'contacts/statistics';
    	try{
    		return json_decode($this->execute_get_request($this->get_request_url($endpoint,null)));
    	}
    	catch(HubSpotException $e){
    		throw new HubSpotException('Unable to get contact: '.$e);
    	}

    }


}

?>