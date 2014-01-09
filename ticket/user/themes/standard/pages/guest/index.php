<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title($language->get('Guest Portal'));

include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_header.php');
?>
	
	<div id="sidebar">
		<div id="users-details" class="widget">
			<div class="left">
				<h2><?php echo safe_output($language->get('Guest Portal')); ?></h2>
			</div>
			<div class="right">
			<p><a href="<?php echo safe_output($config->get('address')); ?>/guest/ticket_add/" class="button grey"><?php echo safe_output($language->get('Create a Support Ticket')); ?></a></p>
			</div>
			<div class="clear"></div>
			<br />
			<div class="clear"></div>

		</div>
	</div>

	<div id="box">
		<div id="content">		
			
			<?php if ($config->get('html_enabled') == 1) { ?>
				<?php echo html_output($config->get('guest_portal_index_html')); ?>
			<?php } else { ?>
				<p><?php echo nl2br(safe_output($config->get('guest_portal_index_html'))); ?></p>
			<?php } ?>
			
			<div class="clear"></div>

		</div>
	</div>
		
<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>