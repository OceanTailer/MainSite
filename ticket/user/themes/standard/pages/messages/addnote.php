<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$id = (int) $url->get_item();

$items = $messages->get(array('id' => $id, 'to_from_user_id' => $auth->get('id')));


if (count($items) == 1) {
	$item = $items[0];
	
	if (!empty($_POST['message'])) {
	
		$add_array['message'] 		= $_POST['message'];
		$add_array['message_id']	= $item['id'];
		$add_array['user_id']		= $auth->get('id');
		
		$note_id = $message_notes->add($add_array);
		if ($item['user_id'] == $auth->get('id')) {
			$messages->add_unread(array('message_id' => $item['id'], 'message_note_id' => $note_id, 'user_id' => $item['from_user_id']));
		}
		else {
			$messages->add_unread(array('message_id' => $item['id'], 'message_note_id' => $note_id, 'user_id' => $item['user_id']));		
		}
	}
		
	header('Location: ' . $config->get('address') . '/messages/view/' . (int) $item['id'] . '/#addnote');
	exit;
}
else {
	header('Location: ' . $config->get('address') . '/profile/');
	exit;
}




?>