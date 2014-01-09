<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title($language->get('Edit Status'));

if ($auth->get('user_level') != 2) {
	header('Location: ' . $config->get('address') . '/');
	exit;
}

$id = (int) $url->get_item();

$status		= $ticket_status->get(array('id' => $id));
	
if (empty($status)) {
	header('Location: ' . $config->get('address') . '/settings/tickets/#status');
	exit;
}

$status_item = $status[0];

if (isset($_POST['delete'])) {
	if ($status_item['id'] != 1 && $status_item['id'] != 2) {
		$ticket_status->delete(array('id' => $status_item['id']));
		header('Location: ' . $config->get('address') . '/settings/tickets/#status');
		exit;
	}
}

if (isset($_POST['save'])) {
	if (!empty($_POST['name'])) {
		$add_array['colour']			= $_POST['colour'];
		$add_array['name']				= $_POST['name'];
		$add_array['id']				= $id;
		$add_array['active']			= $_POST['active'] ? 1 : 0;

		$ticket_status->edit($add_array);
		
		
		header('Location: ' . $config->get('address') . '/settings/tickets/#status');
		exit;
		//$message = $language->get('Saved');
		
	}
	else {
		$message = $language->get('Name empty');
	}
	$status		= $ticket_status->get(array('id' => $id));
	$status_item = $status[0];
}



include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_header.php');
?>
<link rel="stylesheet" href="<?php echo $config->get('address'); ?>/system/libraries/colorpicker/css/colorpicker.css" type="text/css" />	
<script type="text/javascript" src="<?php echo $config->get('address'); ?>/system/libraries/colorpicker/js/colorpicker.js"></script>
<script type="text/javascript" src="<?php echo $config->get('address'); ?>/system/libraries/colorpicker/js/eye.js"></script>
<script type="text/javascript" src="<?php echo $config->get('address'); ?>/system/libraries/colorpicker/js/utils.js"></script>
<script type="text/javascript" src="<?php echo $config->get('address'); ?>/system/libraries/colorpicker/js/layout.js?ver=1.0.2"></script>
<script type="text/javascript" src="<?php echo $config->get('address'); ?>/system/js/colourpicker.js"></script>

	<script type="text/javascript">
		$(document).ready(function () {
			$('#delete').click(function () {
				if (confirm("<?php echo safe_output($language->get('Are you sure you wish to delete this Status?')); ?>")){
					return true;
				}
				else{
					return false;
				}
			});
		});
	</script>

<form method="post" action="<?php echo safe_output($_SERVER['REQUEST_URI']); ?>">

	<div id="sidebar">
		<div id="login-details" class="widget">
			<div class="left">
				<h2><?php echo safe_output($language->get('Status')); ?></h2>
			</div>
		
			
			<div class="right">
				<p>
					<button type="submit" name="save"><?php echo safe_output($language->get('Save')); ?></button>
					<a href="<?php echo $config->get('address'); ?>/settings/tickets/#status" class="button grey"><?php echo safe_output($language->get('Cancel')); ?></a>
				</p>
			</div>
				
			<div class="clear"></div>	
			
			<?php if ($status_item['id'] != 1 && $status_item['id'] != 2) { ?>
				<br />
				<div class="right"><button type="submit" id="delete" name="delete" class="red"><?php echo safe_output($language->get('Delete')); ?></button></div>
				<div class="clear"></div>
			<?php } ?>

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
			
			<p><?php echo $language->get('Name'); ?><br /><input type="text" name="name" value="<?php echo safe_output($status_item['name']); ?>" size="30" /></p>

		
			<p><?php echo $language->get('HEX Colour'); ?><br /><input type="text" class="colourpicker" name="colour" value="<?php echo safe_output($status_item['colour']); ?>" maxlength="6" size="6"  /></p>
			
			<p><?php echo $language->get('Type'); ?><br />
				<select name="active">
					<option value="1"<?php if ($status_item['active'] == '1') { echo ' selected="selected"'; } ?>><?php echo $language->get('Open'); ?></option>
					<option value="0"<?php if ($status_item['active'] == '0') { echo ' selected="selected"'; } ?>><?php echo $language->get('Closed'); ?></option>
				</select>
			</p>


		</div>
			
		<div class="clear"></div>

	</div>

</form>
<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>