<?php
namespace sts;
use sts as core;

$site->set_title('Dashboard');

//Level 2 is Admin
if ($auth->get('user_level') == 2) {
	$users_count 		= $users->count();
}

$upgrade 		= new upgrade();

include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_header.php');
?>
	<div id="sidebar">
		<div id="login-details" class="widget">
			<h2>Dashboard</h2>
			<p>Welcome to <?php echo safe_output($config->get('name')); ?>.</p>
		</div>
	</div>

	<div id="box">
		<div id="content">		
			<?php
			if (($auth->get('user_level') == 2) && (($config->get('database_version') !== $upgrade->get_db_version()) || ($config->get('program_version') !== $upgrade->get_program_version()))) {
				echo message('Your database needs upgrading, please click <a href="'.safe_output($config->get('address')).'/upgrade/" class="button">here</a> to continue.');
			}
			?>
			
			
			
		</div>
	</div>

<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>