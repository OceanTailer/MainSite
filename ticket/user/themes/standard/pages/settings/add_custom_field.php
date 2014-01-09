<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title($language->get('Custom Fields'));

if ($auth->get('user_level') != 2) {
	header('Location: ' . $config->get('address') . '/');
	exit;
}

if (isset($_POST['add'])) {
	if (!empty($_POST['name'])) {
		$add_array['type']				= $_POST['type'];
		$add_array['name']				= $_POST['name'];
		$add_array['client_modify']		= 1;
		$add_array['enabled']			= $_POST['enabled'] ? 1 : 0;

		$id = $ticket_custom_fields->add_group($add_array);
		
		if ($add_array['type'] == 'dropdown') {
			foreach($_POST['dropdown_field'] as $index => $value){
				if (!empty($value)) {
					$ticket_custom_fields->add_field(array('ticket_field_group_id' => $id, 'value' => $value));
				}
			}
		}
		
		header('Location: ' . $config->get('address') . '/settings/tickets/#custom_fields');
		
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
				<h2><?php echo safe_output($language->get('Custom Fields')); ?></h2>
			</div>
		
			
			<div class="right">
				<p>
				<button type="submit" name="add"><?php echo safe_output($language->get('Add')); ?></button>
				<a href="<?php echo $config->get('address'); ?>/settings/tickets/#custom_fields" class="button grey"><?php echo safe_output($language->get('Cancel')); ?></a>
				</p>
			</div>
				
			<div class="clear"></div>	
			
			<p><?php echo $language->get('Custom Fields allow you to add extra global fields to your tickets.'); ?></p>
			<h3><?php echo $language->get('Input Options'); ?></h3>
			<ul>
				<li><?php echo $language->get('Text Input (single line of text).'); ?></li>
				<li><?php echo $language->get('Text Area (multiple lines of text).'); ?></li>
				<li><?php echo $language->get('Dropdown box with options.'); ?></li>
			</ul>

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
			
			<p><?php echo $language->get('Enabled'); ?><br />
				<select name="enabled">
					<option value="0"<?php if (isset($_POST['enabled']) && $_POST['enabled'] == '0') { echo ' selected="selected"'; } ?>><?php echo $language->get('No'); ?></option>
					<option value="1"<?php if (isset($_POST['enabled']) && $_POST['enabled'] == '1') { echo ' selected="selected"'; } ?>><?php echo $language->get('Yes'); ?></option>
				</select>
			</p>
			
			<p><?php echo $language->get('Input Type'); ?><br />
				<select name="type" id="custom_field_type">
					<option value="textinput"<?php if (isset($_POST['type']) && $_POST['type'] == 'textinput') { echo ' selected="selected"'; } ?>><?php echo $language->get('Text Input'); ?></option>
					<option value="textarea"<?php if (isset($_POST['type']) && $_POST['type'] == 'textarea') { echo ' selected="selected"'; } ?>><?php echo $language->get('Text Area'); ?></option>
					<option value="dropdown"<?php if (isset($_POST['type']) && $_POST['type'] == 'dropdown') { echo ' selected="selected"'; } ?>><?php echo $language->get('Drop Down'); ?></option>
				</select>
			</p>
			
			<div id="dropdown_fields">
				<br />
				<h3><a name="add_dropdown"></a><?php echo $language->get('Dropdown Fields'); ?> <a id="add_dropdown_field" href="#add_dropdown" class="button"><?php echo $language->get('Add'); ?></a></h3>
				<div class="dropdown_field">
					<p><?php echo $language->get('Option'); ?><br /><input type="text" name="dropdown_field[]" value="" size="30" /></p>
				</div>
				<div class="extra_dropdown_field"></div>
			</div>

		</div>
			
		<div class="clear"></div>

	</div>

</form>
<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>