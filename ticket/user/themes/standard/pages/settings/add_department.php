<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title($language->get('Add Department'));

if ($auth->get('user_level') != 2) {
	header('Location: ' . $config->get('address') . '/');
	exit;
}

if (isset($_POST['add'])) {
	if (!empty($_POST['name'])) {		
		$add_array['name']				= $_POST['name'];
		$add_array['enabled']			= 1;
		$add_array['public_view'] 		= $_POST['public_view'] ? 1 : 0;
			
		$id = $ticket_departments->add($add_array);
	
		header('Location: ' . $config->get('address') . '/settings/tickets/#departments');
		
	}
	else {
		$message = $language->get('Name Empty');
	}
}

include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_header.php');
?>
	
<form method="post" action="<?php echo safe_output($_SERVER['REQUEST_URI']); ?>">

	<div id="sidebar">
		<div id="login-details" class="widget">
			<div class="left">
				<h2><?php echo safe_output($language->get('Department')); ?></h2>
			</div>
		
			
			<div class="right">
				<p>
				<button type="submit" name="add"><?php echo safe_output($language->get('Add')); ?></button>
				<a href="<?php echo $config->get('address'); ?>/settings/tickets/#departments" class="button grey"><?php echo safe_output($language->get('Cancel')); ?></a>
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

			<p><?php echo safe_output($language->get('Public')); ?><br />
			<select name="public_view">
				<option value="0"><?php echo safe_output($language->get('No')); ?></option>
				<option value="1"<?php if (isset($_POST['public_view']) && ($_POST['public_view'] == 1)) { echo ' selected="selected"'; } ?>><?php echo safe_output($language->get('Yes')); ?></option>
			</select></p>	

			
	
		</div>
			
		<div class="clear"></div>

	</div>

</form>
<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>