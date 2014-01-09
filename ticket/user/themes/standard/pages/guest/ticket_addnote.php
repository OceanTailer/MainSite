<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$id = (int) $url->get_item();

$access_key 	= '';
if (isset($_GET['access_key'])) {
	$access_key	= $_GET['access_key'];
}

if ($id == 0 && !empty($access_key)) {
	header('Location: ' . $config->get('address') . '/guest/');
	exit;
}


$t_array['id']				= $id;
$t_array['limit']			= 1;
$t_array['access_key']		= $access_key;

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

	
	header('Location: ' . $config->get('address') . '/guest/ticket_view/' . $ticket['id'] . '/?access_key='. safe_output($ticket['access_key']).'#addnote');
}
else {
	header('Location: ' . $config->get('address') . '/guest/');
}




?>