<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title('Plugins');

if ($auth->get('user_level') != 2) {
	header('Location: ' . $config->get('address') . '/');
	exit;
}

if (isset($_GET['action'])) {
	if ($_GET['action'] == 'enable') {
		$plugins->enable($_GET['name']);
	}
	if ($_GET['action'] == 'disable') {
		$plugins->disable($_GET['name']);
	}
	
}
header('Location: ' . $config->get('address') . '/settings/plugins/');
exit;
?>