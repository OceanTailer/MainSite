<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

if ($auth->get('user_level') != 2) {
	exit;
}

$id = (int) $url->get_item();

if (isset($_POST['delete'])) {
	$current_pushover_users = $config->get('pushover_notify_users');
	
	$key = array_search($id, $current_pushover_users);
	
	if ($key != NULL || $key !== FALSE) {
		unset($current_pushover_users[$key]);
	}
	
	$config->set('pushover_notify_users', $current_pushover_users);
}
?>
