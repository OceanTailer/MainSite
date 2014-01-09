<?php
include('common.php');

if (isset($_SESSION['install_data'])) {

}
else {
	$_SESSION['install_data']['stage'] = 1;
}

?>