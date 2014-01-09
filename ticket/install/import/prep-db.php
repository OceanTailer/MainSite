<?php
/*
	This code allows you to import a database from a different application.
	Please sign up to the portal website (portal.dalegroup.net) to get more information.
	You will probably require help running this, it is alpha code.
*/
include('../common.php');

if (!isset($_SESSION['install_data']) || ($_SESSION['install_data']['stage'] < 4)) {
	header('Location: ../index.php');
	exit;
}

$ipm_install->connect_db();
if (!$ipm_install->is_installed()) {
	$ipm_install->install_import_db();
	$ipm_install->write_htaccess();
	$ipm_install->write_config();
	session_destroy();
	
	echo 'Tickets Prep Done!!';
	echo '<br />Now you need to run the application importer.';
	
	
}
else {
	echo 'Database Not Empty';
}

?>