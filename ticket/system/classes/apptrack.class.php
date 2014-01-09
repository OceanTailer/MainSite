<?php
/**
 * 	AppTrack Class
 *	Copyright Dalegroup Pty Ltd 2012
 *	support@dalegroup.net
 *
 *  This class is used to check for software updates from Dalegroup Pty Ltd.
 *
 * @package     dgx
 * @author      Michael Dale <mdale@dalegroup.net>
 */

namespace sts;

class apptrack {

	private $api_version 	= 1;
	private $api_url 		= 'http://api.apptrack.com.au/api/'; 

	public function set_url($url) {
		$this->api_url 		= $url; 	
	}

	/**
	 * Converts the submitted array into a json array and submits to the apptrack server
	 *
	 * @param   array   	$data 		The array of data to send
	 * @return  array					The response from the apptrack server
	 */	
	public function send($data) {
	
		$data['api_version'] 	= $this->api_version;
		$json_array 			= json_encode($data);
		$post_data 				= http_build_query(array('data' => $json_array));
		
		$options = array(
			'http' => array(
				'user_agent'    => 'AppTrack/1.0',
				'timeout'       => 5,
				'method'		=> 'POST',
				'header'		=> 'Content-type: application/x-www-form-urlencoded',
				'content'		=> $post_data
			)
		);
		
		$context 				= stream_context_create($options);
		$result 				= @file_get_contents($this->api_url, false, $context);
		
		if ($result) {
			$return_data = json_decode($result, true);
		}
		else {
			$return_data = array();
		}
		
		return $return_data;
	
	}

}

?>