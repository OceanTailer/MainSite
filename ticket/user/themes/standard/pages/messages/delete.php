<?php
namespace sts;
use sts as core;

if (isset($_POST['delete'])) {

	$id = (int) $url->get_item();

	$items = $messages->get(array('id' => $id, 'to_from_user_id' => $auth->get('id')));

	if (count($items) == 1) {
		$item = $items[0];
		
		$messages->delete(array('id' => $item['id'], 'user_id' => $auth->get('id')));
	}
}
header('Location: ' . $config->get('address') . '/profile/');
exit;

?>