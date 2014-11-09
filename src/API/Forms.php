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

class Forms extends BaseClient{

	protected $API_PATH = 'contacts';
	protected $API_VERSION = 'v1';

	/**
	* Submit form data
	*
	*@param portalId: The ID # for your portal
	*		guid: The unique ID for the form (found in Forms tool in your HubSpot account)
	*		form_fields: A key-value array of the form fields submitted by the end user. 
	*					 The key should match the key for the contact property in HubSpot. 
	*		hs_context: A key-value array of the contextual info for the submission 
	*					This includes: IP address, Page URL, tracking cookie, etc.
	*
	*		Note: The fields submitted via the API do not need to match the fields available on the actual form
	**/
	public function submit_form($portalId, $guid, $form_fields, $hs_context){
		$url_base = 'https://forms.hubspot.com/uploads/form/v2/'.$portalId.'/'.$guid;
		$form_fields['hs_context'] = json_encode($hs_context);
		$param_string = '&'.http_build_query($form_fields,'','&');
		try{
			return json_decode($this->execute_post_request($this->get_forms_request_url($url_base,null),$param_string,TRUE));
		}
		catch(HubSpotException $e){
			print_r("Unable to submit form: ".$e);
		}

	}

	/**
	* Get all forms
	*
	*
	*
	*@return returns JSON objects for all forms in portal
	*@throws HubSpotException
	**/
	public function get_forms(){
		$endpoint = 'forms';
		try{
			return json_decode($this->execute_get_request($this->get_request_url($endpoint,null)));
		}
		catch(HubSpotException $e){
			print_r("Unable to retrieve forms: ".$e);
		}
	}

	/**
	* Get single form by ID
	*
	*@param guid: the unique ID for the Form
	*
	*@return returns JSON objects for all forms in portal
	*@throws HubSpotException
	**/
	public function get_form_by_id($guid){
		$endpoint = 'forms/'.$guid;
		try{
			return json_decode($this->execute_get_request($this->get_request_url($endpoint,null)));
		}
		catch(HubSpotException $e){
			print_r("Unable to retrieve form: ".$e);
		}
	}

	/**
	* Create a Form	
	*
	*@param form_data: Data in array format for the form being created.
	*		fields: Array of arrays for fields to be added to the form.
	*				These arrays will be added to the form_data array, 
	*				no need to include a 'fields' entry in the form_data array passed to function
	*
	*@return Response body from HTTP POST request
	*@throws HubSpotException
	**/
	public function create_form($form_data, $fields){
		$endpoint = 'forms';
		$form_data['fields'] = $fields;
		try{
			return json_decode($this->execute_JSON_post_request($this->get_request_url($endpoint,null),json_encode($form_data)));
		}
		catch(HubSpotException $e){
			print_r("Unable to create form: ".$e);
		}
	}

	/**
	* Create a Form	
	*
	*@param guid: Unique ID for the form
	*		form_data: Data in array format for the form being created.
	*		fields: Array of arrays for fields to be added to the form.
	*				These arrays will be added to the form_data array, 
	*				no need to include a 'fields' entry in the form_data array passed to function
	*
	*@return Response body from HTTP POST request
	*@throws HubSpotException
	**/
	public function update_form($guid, $form_data, $fields){
		$endpoint = 'forms/'.$guid;
		$form_data['fields'] = $fields;
		try{
			return json_decode($this->execute_JSON_post_request($this->get_request_url($endpoint,null),json_encode($form_data)));
		}
		catch(HubSpotException $e){
			print_r("Unable to update form: ".$e);
		}
	}

	/**
	* Delete a form by ID
	*
	*@param guid: the unique ID for the Form
	*
	*@return Response body from HTTP POST request
	*@throws HubSpotException
	**/
	public function delete_form($guid){
		$endpoint = 'forms/'.$guid;
		try{
			return json_decode($this->execute_delete_request($this->get_request_url($endpoint,null),null));
		}
		catch(HubSpotException $e){
			print_r("Unable to delete form: ".$e);
		}
	}

	/**
	* Get fields for a specific Form
	*
	*@param guid: the unique ID for the Form
	*
	*@return JSON formatted array of fields
	*@throws HubSpotException
	**/
	public function get_form_fields($guid){
		$endpoint = 'fields/'.$guid;
		try{
			return json_decode($this->execute_get_request($this->get_request_url($endpoint,null)));
		}
		catch(HubSpotException $e){
			print_r("Unable to retrieve fields: ".$e);
		}
	}

	/**
	* Get a specific field for a specific Form
	*
	*@param guid: the unique ID for the Form
	*		field_name: the key for the field
	*
	*@return JSON formatted array of fields
	*@throws HubSpotException
	**/
	public function get_single_form_field($guid, $field_name){
		$endpoint = 'fields/'.$guid.'/'.$field_name;
		try{
			return json_decode($this->execute_get_request($this->get_request_url($endpoint,null)));
		}
		catch(HubSpotException $e){
			print_r("Unable to retrieve field: ".$e);
		}
	}


}




?>
