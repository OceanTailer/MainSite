<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

if ($auth->get('user_level') == 2 || $auth->get('user_level') == 5 || $auth->get('user_level') == 6) {

	if (isset($_GET['department_id']) && !empty($_GET['department_id'])) {
			
		$allowed = false;
		
		if ($auth->get('user_level') == 2 || $auth->get('user_level') == 6) {
			$allowed = true;
		}
		else {
			$allowed_user = $users->get(array('department_id' => (int) $_GET['department_id'], 'id' => $auth->get('id')));
			if (!empty($allowed_user)) {
				$allowed = true;
			}
		}
		
		if ($allowed) {
		
			$get_array = array();
			
			$get_array['department_id']	= (int) $_GET['department_id'];
			
			if (isset($_GET['assigned_users']) && ($_GET['assigned_users'] == true)) {
				//all users except subs
				$get_array['user_levels']	= array(2,3,4,5,6);
			}

			$users = $users->get($get_array);

			$output = array();
			foreach($users as $user) {
				$output[] = array(
							'name'	=> safe_output(ucwords($user['name'])),
							'id'	=> (int) $user['id']
						);
			}

			echo json_encode($output);
		}
		else {
			echo json_encode(array());
		}

	}
	else {
		$get_array = array();
		if ($auth->get('user_level') == 2 || $auth->get('user_level') == 6) {

		}
		else {
			$departments 	= $ticket_departments->get(array('get_other_data' => true, 'user_id_is_member' => $auth->get('id')));
			
			$d_ids			= array();
			foreach($departments as $d_id) {
				$d_ids[]	= $d_id['id'];
			}
						
			$get_array['department_ids']	= $d_ids;
			
			if (empty($d_ids)) {
				echo json_encode(array());
				exit;
			}
		}
		
		if (isset($_GET['assigned_users']) && ($_GET['assigned_users'] == true)) {
			//all users except subs
			$get_array['user_levels']	= array(2,3,4,5,6);
		}
		
				
		$users = $users->get($get_array);

		$output = array();
		foreach($users as $user) {
			$output[] = array(
						'name'	=> safe_output(ucwords($user['name'])),
						'id'	=> (int) $user['id']
					);
		}

		echo json_encode($output);
	}
}
else {
	echo json_encode(array());
}
?>