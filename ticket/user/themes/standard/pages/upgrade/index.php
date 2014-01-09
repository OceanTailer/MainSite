<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title($language->get('Upgrade'));

if ($auth->get('user_level') != 2) {
	header('Location: ' . $config->get('address') . '/');
	exit;
}

$upgrade 		= new upgrade();

include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_header.php');
?>
	<div id="sidebar">
		<div id="upgrade-details" class="widget">
			<h2><?php echo safe_output($language->get('Upgrade')); ?></h2>
			<p><?php echo safe_output($language->get('This page upgrades the database to the latest version.')); ?></p>
		</div>
	</div>

	<div id="box">
		<div id="content">		
					
			<?php
			if ($config->get('database_version') == $upgrade->get_db_version() && $config->get('program_version') == $upgrade->get_program_version() ) {
				echo message($language->get('Your database is currently up to date and does not need upgrading.'));
			}
			elseif (isset($_GET['run']) && $_GET['run'] == 'upgrade') {
				$upgrade->do_upgrade();
				
				echo message($language->get('Upgrade Complete.'));				
			}
			else {
				echo message($language->get('Please ensure you have a full database backup before continuing.'));
				?>
				<br />
				<div class="right">
					<p><a href="<?php echo safe_output($config->get('address')); ?>/upgrade/?run=upgrade" class="button"><?php echo safe_output($language->get('Start Upgrade')); ?></a></p>
				</div>
				<div class="clear"></div>
				<?php
			}
			?>

			<div class="clear"></div>

		</div>
	</div>

<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>