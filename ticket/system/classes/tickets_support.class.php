<?php
/**
 * 	Tickets Support Class
 *	Copyright Dalegroup Pty Ltd 2012
 *	support@dalegroup.net
 *
 *
 * @package     dgx
 * @author      Michael Dale <mdale@dalegroup.net>
 */

 
namespace sts;

class tickets_support {

	function __construct() {

	}
	
	/*
	 *	Check if a user can access the current ticket
	 */
	function can($array) {
	
		if (!isset($array['action'])) return false;
		
		switch($array['action']) {
			case 'view':
				$return = $this->can_view(array('id' => $array['id']));
			break;
			
			default:
				$return = false;
			break;
		}
		
		return $return;

	}
	
	private function can_view($array){
		$auth 				=	&singleton::get(__NAMESPACE__ . '\auth');	
		$tickets 			=	&singleton::get(__NAMESPACE__ . '\tickets');
		
		$user_level			= (int) $auth->get('user_level');
		
		switch($user_level) {
		
			case 6:
				//admin
			break;
			
			case 5:
				//moderator
				$get_array['department_or_assigned_or_user_id']		= $auth->get('id');
			break;
			
			case 4:
				//staff member
				$get_array['department_or_assigned_or_user_id']		= $auth->get('id');
			break;
			
			case 3:
				//user
				$get_array['assigned_or_user_id'] 					= $auth->get('id');
			break;
			
			case 2:
				//global moderator
			break;
			
			default:
				//sub
				$get_array['user_id'] 								= $auth->get('id');
			break;			
			
		}
		
		$get_array['count']		= true;		
		$get_array['id']		= (int) $array['id'];

		$result = $tickets->get($get_array);
				
		if (!empty($result) && ($result[0]['count'] != 0)) {
			return true;
		}
		else {
			return false;
		}	
	}
	
	
}


?>