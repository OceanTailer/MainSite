<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

if ($auth->get('user_level') != 2) {
	exit;
}

$id = (int) $url->get_item();

if (isset($_POST['delete'])) {
	$ticket_priorities->delete(array('id' => $id));
	exit;	
}
?>
