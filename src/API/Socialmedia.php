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

class SocialMedia extends BaseClient{

	protected $API_PATH = 'broadcast';
	protected $API_VERSION = 'v1';

	/**
	* Get Publishing Channels
	*
	*
	*
	*@return returns objects for each publishing channel
	*
	*@throws HubSpotException
	**/
	public function get_publishing_channels(){
		$endpoint = 'channels/setting/publish/current';

		try{
			return json_decode($this->execute_get_request($this->get_request_url($endpoint,null)));
		}
		catch(HubSpotException $e){
			print_r('Unable to retrieve channels: '.$e);
		}
	}

	/**
	* Get specific Publishing Channel
	*
	*@param guid: Unique ID for the channel
	*
	*@return returns object for requested publishing channel
	*
	*@throws HubSpotException
	**/
	public function get_publishing_channel($guid){
		$endpoint = 'channels/'.$guid;

		try{
			return json_decode($this->execute_get_request($this->get_request_url($endpoint,null)));
		}
		catch(HubSpotException $e){
			print_r('Unable to retrieve channel: '.$e);
		}

	}

	/**
	* Get Broadcast Messages
	*
	*@param params: Optional query parameters to search for specific types of broadcasts.
	*				This includes status, since, channelGuid, count
	*
	*@return returns objects for requested broadcasts
	*
	*@throws HubSpotException
	**/
	public function get_broadcasts($params){
		$endpoint = 'broadcasts';

		try{
			return json_decode($this->execute_get_request($this->get_request_url($endpoint,$params)));
		}
		catch(HubSpotException $e){
			print_r('Unable to retrieve broadcasts: '.$e);
		}
	}

	/**
	* Get specific Broadcast Message
	*
	*@param guid: Unique ID for the broadcast
	*
	*@return returns object for requested broadcast message
	*
	*@throws HubSpotException
	**/
	public function get_broadcast($guid){
		$endpoint = 'broadcasts/'.$guid;

		try{
			return json_decode($this->execute_get_request($this->get_request_url($endpoint,null)));
		}
		catch(HubSpotException $e){
			print_r('Unable to retrieve broadcast: '.$e);
		}

	}	

	/**
	* Create a Broadcast Message
	*
	* @param broadcast: Array containing the info for the message. This includes:
	*					channelGuid: the unique ID for the channel to post to
	*					triggerAt: Timestamp at which the broadcast should be sent
	*					content: An array with the content of the message
	*
	*@return returns object for the created broadcast message
	*
	*@throws HubSpotException
	**/
	public function create_broadcast($broadcast){
		$endpoint = 'broadcasts';

		try{
			return json_decode($this->execute_JSON_post_request($this->get_request_url($endpoint,null),json_encode($broadcast)));
		}
		catch(HubSpotException $e){
			print_r('Unable to create broadcast: '.$e);
		}
	}


	/**
	* Delete specific Broadcast Message
	*
	*@param guid: Unique ID for the broadcast
	*
	*@return returns response body for DELETE request
	*
	*@throws HubSpotException
	**/
	public function delete_broadcast($guid){
		$endpoint = 'broadcasts/'.$guid;

		try{
			return json_decode($this->execute_delete_request($this->get_request_url($endpoint,null),null));
		}
		catch(HubSpotException $e){
			print_r('Unable to delete broadcast: '.$e);
		}

	}	



}

?>
