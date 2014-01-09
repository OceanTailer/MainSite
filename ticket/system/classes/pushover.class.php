<?php
/**
 * 	Pushover Class
 *	Copyright Dalegroup Pty Ltd 2012
 *	support@dalegroup.net
 *
 *
 * @package     dgx
 * @author      Michael Dale <mdale@dalegroup.net>
 */

namespace sts;

class pushover {

	var $app_key = NULL;
	var $api_url = 'https://api.pushover.net/1/messages.json';

	function __construct() {
	
		$config 	= &singleton::get(__NAMESPACE__ . '\config');

		$this->app_key = $config->get('pushover_token');
	}
	
	//add an email to the email queue
	public function queue($array) {
		$queue =	&singleton::get(__NAMESPACE__ . '\queue');
				
		$queue->add(array('data' => $array, 'type' => 'pushover'));

		return true;
	}
	
	//this kicks off the email processing
	public function run_queue() {

		$queue =	&singleton::get(__NAMESPACE__ . '\queue');
		
		$queue->run('pushover');

	}
	
	public function process_queue(&$queue) {
		
		$log =	&singleton::get(__NAMESPACE__ . '\log');
	
		//get the queue data
		$array = $queue['data'];
		
		if ($this->send($array)) {
			$queue['processed'] = true;
		}
		else {		
			if ($queue['retry'] >= 3) {
				//this means the email will be deleted from the queue (full fail)
				$queue['processed'] = true;
				
				$larray['event_severity'] = 'error';
				$larray['event_number'] = E_USER_ERROR;
				$larray['event_description'] = 'Unable to send pushover message, removing from queue after 3 retries';
				$larray['event_file'] = __FILE__;
				$larray['event_file_line'] = __LINE__;
				$larray['event_type'] = 'process_queue';
				$larray['event_source'] = 'pushover';
				$larray['event_version'] = '1';
				$larray['log_backtrace'] = true;	
				
				$log->add($larray);
				
			} else {
				$queue['retry']++;
			}
		}
	
	}
	
	public function send($array) {
	
		$log =	&singleton::get(__NAMESPACE__ . '\log');

		$array['token']			= $this->app_key;
		
		/*
			Limit to 512 chars as per pushover limit.
		*/
		$remove = 0;
		if (isset($array['title'])) {
			$remove = (int) strlen($array['title']);
		}
		
		if (isset($array['message'])) {
			$array['message']	= substr($array['message'], 0, 512 - $remove);
		}
						
		$options = array(
			'http' => array(
				'user_agent'    => user_agent(),
				'timeout'       => 5,
				'method'		=> 'POST',
				'header'		=> 'Content-type: application/x-www-form-urlencoded',
				'content'		=> http_build_query($array)
			)
		);
		
		$context 				= stream_context_create($options);
		$result 				= @file_get_contents($this->api_url, false, $context);
				
		if ($result) {
			$return_data = json_decode($result, true);

			if ($return_data['status'] == 1) {
				return true;
			}
			else {				
				$larray['event_severity'] = 'error';
				$larray['event_number'] = E_USER_ERROR;
				$larray['event_description'] = 'Unable to send pushover message.';
				$larray['event_file'] = __FILE__;
				$larray['event_file_line'] = __LINE__;
				$larray['event_type'] = 'send';
				$larray['event_source'] = 'pushover';
				$larray['event_version'] = '1';
				$larray['log_backtrace'] = true;	
				
				$log->add($larray);	
			}
		}
		else {
			$larray['event_severity'] = 'error';
			$larray['event_number'] = E_USER_ERROR;
			$larray['event_description'] = 'Unable to send pushover message.';
			$larray['event_file'] = __FILE__;
			$larray['event_file_line'] = __LINE__;
			$larray['event_type'] = 'send';
			$larray['event_source'] = 'pushover';
			$larray['event_version'] = '1';
			$larray['log_backtrace'] = true;	
			
			$log->add($larray);			
		}

		return false;

	}
	
	
}

?>