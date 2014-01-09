<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title($language->get('Plugins'));

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

$plugins_array = $plugins->get();

//print_r($plugins_array);

include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_header.php');
?>
	<form method="post" action="<?php echo safe_output($_SERVER['REQUEST_URI']); ?>">

		<div id="sidebar">
			<div id="login-details" class="widget">
				<div class="left">
					<h2><?php echo safe_output($language->get('Plugins')); ?></h2>
					<p><?php echo safe_output($language->get('Plugins can be used to add extra functionality to Tickets.')); ?></p>
					<p><?php echo safe_output($language->get('Please ensure that you only install trusted plugins.')); ?></p>
				</div>
				
				<div class="clear"></div>

			</div>
		</div>
		<div id="box">
			<?php if (DEMO_MODE) { ?>
				<div id="content">
					<?php echo message('Demo Mode: Plugins must be purchased separately.'); ?>
				</div>
			<?php } ?>
		
			<div id="content">		
				<table class="data-table">
					<tr>
						<th><?php echo safe_output($language->get('Name')); ?></th>
						<th><?php echo safe_output($language->get('Version')); ?></th>
						<th><?php echo safe_output($language->get('Description')); ?></th>
						<th><?php echo safe_output($language->get('Status')); ?></th>
					</tr>
					<?php
						$i = 0;
						foreach ($plugins_array as $plugin) {
					?>
					<tr <?php if ($i % 2 == 0 ) { echo 'class="switch-1"'; } else { echo 'class="switch-2"'; }; ?>>
						<td class="centre"><?php echo safe_output($plugin['name']); ?></td>
						<td class="centre"><?php echo safe_output($plugin['version']); ?></td>
						<td class="centre"><?php echo html_output($plugin['description']); ?></td>
						<td class="centre">
							<?php if ($plugins->loaded($plugin['file_name'])) { ?>
								<a href="<?php echo safe_output($config->get('address')); ?>/settings/plugin_action/?action=disable&amp;name=<?php echo safe_output($plugin['file_name']); ?>"><?php echo safe_output($language->get('Enabled')); ?></a>
							<?php } else { ?>
								<a href="<?php echo safe_output($config->get('address')); ?>/settings/plugin_action/?action=enable&amp;name=<?php echo safe_output($plugin['file_name']); ?>"><?php echo safe_output($language->get('Disabled')); ?></a>
							<?php } ?>
						</td>
					</tr>
					<?php $i++; } ?>
				</table>

			</div>
		</div>
	
	</form>

<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>