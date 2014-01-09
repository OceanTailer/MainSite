<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title($language->get('Add Status'));

if ($auth->get('user_level') != 2) {
	header('Location: ' . $config->get('address') . '/');
	exit;
}

if (isset($_POST['add'])) {
	if (!empty($_POST['name'])) {
		$add_array['name']				= $_POST['name'];
		$add_array['colour']			= $_POST['colour'];
		$add_array['active']			= $_POST['active'] ? 1 : 0;
		$add_array['enabled']			= 1;

		$id = $ticket_status->add($add_array);
	
		header('Location: ' . $config->get('address') . '/settings/tickets/#status');
		
	}
	else {
		$message = $language->get('Name Empty');
	}
}



include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_header.php');
?>
<link rel="stylesheet" href="<?php echo $config->get('address'); ?>/system/libraries/colorpicker/css/colorpicker.css" type="text/css" />	
<script type="text/javascript" src="<?php echo $config->get('address'); ?>/system/libraries/colorpicker/js/colorpicker.js"></script>
<script type="text/javascript" src="<?php echo $config->get('address'); ?>/system/libraries/colorpicker/js/eye.js"></script>
<script type="text/javascript" src="<?php echo $config->get('address'); ?>/system/libraries/colorpicker/js/utils.js"></script>
<script type="text/javascript" src="<?php echo $config->get('address'); ?>/system/libraries/colorpicker/js/layout.js?ver=1.0.2"></script>
<script type="text/javascript" src="<?php echo $config->get('address'); ?>/system/js/colourpicker.js"></script>
	
<form method="post" action="<?php echo safe_output($_SERVER['REQUEST_URI']); ?>">

	<div id="sidebar">
		<div id="login-details" class="widget">
			<div class="left">
				<h2><?php echo safe_output($language->get('Status')); ?></h2>
			</div>
		
			
			<div class="right">
				<p>
				<button type="submit" name="add"><?php echo safe_output($language->get('Add')); ?></button>
				<a href="<?php echo $config->get('address'); ?>/settings/tickets/#status" class="button grey"><?php echo safe_output($language->get('Cancel')); ?></a>
				</p>
			</div>
				
			<div class="clear"></div>	
			


		</div>
	</div>

	<div id="box">

		<?php if (isset($message)) { ?>
			<div id="content">
				<?php echo message($message); ?>
			</div>
		<?php } ?>

		<div id="content">	

			<div class="clear"></div>
			
			<p><?php echo $language->get('Name'); ?><br /><input type="text" name="name" value="<?php if (isset($_POST['name'])) echo safe_output($_POST['name']); ?>" size="30" /></p>

			<p><?php echo $language->get('HEX Colour'); ?><br /><input type="text" class="colourpicker" name="colour" value="<?php if (isset($_POST['colour'])) echo safe_output($_POST['colour']); ?>" maxlength="6" size="6" /></p>

			
			<p><?php echo $language->get('Type'); ?><br />
				<select name="active">
					<option value="1"<?php if (isset($_POST['active']) && $_POST['active'] == '1') { echo ' selected="selected"'; } ?>><?php echo $language->get('Open'); ?></option>
					<option value="0"<?php if (isset($_POST['active']) && $_POST['active'] == '0') { echo ' selected="selected"'; } ?>><?php echo $language->get('Closed'); ?></option>
				</select>
			</p>
			

		</div>
			
		<div class="clear"></div>

	</div>

</form>
<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>