<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$id = (int) $url->get_item();

if ($auth->get('user_level') == 2 || $auth->get('user_level') == 6) {
	//all tickets
}
else if ($auth->get('user_level') == 5) {
	$t_array['department_or_assigned_or_user_id']	= $auth->get('id');
}
else if ($auth->get('user_level') == 4) {
	//staff
	$t_array['department_or_assigned_or_user_id']	= $auth->get('id');
}
else if ($auth->get('user_level') == 3) {
	//select assigned tickets or personal tickets
	$t_array['assigned_or_user_id'] 		= $auth->get('id');
}
else {
	//just personal tickets
	$t_array['user_id'] 					= $auth->get('id');
}

$t_array['id']				= $id;

$tickets_array = $tickets->get($t_array);

$close_ticket = false;
if (isset($_POST['close_ticket']) && ($_POST['close_ticket'] == 1)) {
	$close_ticket = true;
}

if (count($tickets_array) == 1) {
	$ticket = $tickets_array[0];
		
	//add note!
	if (!empty($_POST['description'])) {
		//reopen ticket if submitter
		if (!$close_ticket && ($auth->get('id') == $ticket['user_id'])) {
			$open_array['state_id']				= 1;
			$open_array['id']					= (int) $ticket['id'];
			$open_array['date_state_changed']	= datetime();
			
			$tickets->edit($open_array);
		}
		
		//close ticket
		if ($close_ticket) {
			$open_array['state_id']				= 2;
			$open_array['id']					= (int) $ticket['id'];
			$open_array['date_state_changed']	= datetime();
			$tickets->edit($open_array);
		}
		
		//assign ticket if not assigned
		if (empty($ticket['assigned_user_id']) && ($auth->get('id') != $ticket['user_id'])) {
			$ticket_array['id']					= (int) $ticket['id'];
			$ticket_array['assigned_user_id']	= $auth->get('id');
			
			$tickets->edit($ticket_array);
		}
		
		if ($config->get('storage_enabled')) {
			if (isset($_FILES['file'])) {
				if ($_FILES['file']['size'] > 0) {
					$file_array['file']			= $_FILES['file'];
					$file_array['name']			= $_FILES['file']['name'];
					
					$file_id = $storage->upload($file_array);
					
					if ($file_id) {
						$storage->add_file_to_ticket(array('file_id' => $file_id, 'ticket_id' => (int) $ticket['id']));
					}
				}
			}
		}
	
		$note['description'] 	= $_POST['description'];
		$note['ticket_id'] 		= (int) $ticket['id'];
		$note['html']			= 0;
		
		if ($config->get('html_enabled')) {
			$note['html'] 		= 1;
		}	
		
		$ticket_notes->add($note);
		
		
	}

	
	header('Location: ' . $config->get('address') . '/tickets/view/' . $ticket['id'] . '/#addnote');
}
else {
	header('Location: ' . $config->get('address') . '/tickets/');
}




?>