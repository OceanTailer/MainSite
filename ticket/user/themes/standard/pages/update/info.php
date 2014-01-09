<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title($language->get('Update Info'));

if ($auth->get('user_level') != 2) {
	header('Location: ' . $config->get('address') . '/');
	exit;
}

$upgrade 				= new upgrade();

$update_available 		= false;
if ($upgrade->update_available()) {
	$update_available 	= true;
	$update_info 		= $upgrade->get_update_info();
}

include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_header.php');
?>
	<div id="sidebar">
		<div id="upgrade-details" class="widget">
			<div class="left">
				<h2><?php echo safe_output($language->get('Update Information')); ?></h2>
			</div>
			<?php if ($update_available) { ?>
				<div class="clear"></div>
				
				<p class="label short"><?php echo safe_output($language->get('Installed Version')); ?></p>
				<p class="result">
					<?php echo safe_output($config->get('program_version')); ?>
				</p>
				<div class="clear"></div>
				
				<p class="label short"><?php echo safe_output($language->get('Available Version')); ?></p>
				<p class="result">
					<?php echo safe_output($update_info['version']); ?>
				</p>
				<div class="clear"></div>
				
				<?php if (isset($update_info['download_url']) && !empty($update_info['download_url'])) { ?>
					<div class="right">
						<p><a href="<?php echo safe_output($update_info['download_url']); ?>" class="button grey"><?php echo safe_output($language->get('Download')); ?></a></p>
					</div>
					<div class="clear"></div>
				<?php } ?>

			<?php } ?>	
			
			<div class="clear"></div>

		</div>
	</div>

	<div id="box">
		<div id="content">		
			<?php 
				if ($update_available) { 
					if (isset($update_info['message']) && !empty($update_info['message'])) {
						echo message($update_info['message']) . '<br />';
					}
					if (isset($update_info['release_notes']) && !empty($update_info['release_notes'])) {
						echo html_output($update_info['release_notes']);
					}
				} else {
					echo message($language->get('No updates found.'));
				}
			?>
			<div class="clear"></div>

		</div>
	</div>

<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>