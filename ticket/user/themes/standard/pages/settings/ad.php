<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title($language->get('Active Directory'));

if ($auth->get('user_level') != 2) {
	header('Location: ' . $config->get('address') . '/');
	exit;
}


if (isset($_POST['save'])) {

	$config->set('ad_server', $_POST['ad_server']);
	$config->set('ad_account_suffix', $_POST['ad_account_suffix']);
	$config->set('ad_base_dn', $_POST['ad_base_dn']);
	$config->set('ad_create_accounts', $_POST['ad_create_accounts'] ? 1 : 0);
	$config->set('ad_enabled', $_POST['ad_enabled'] ? 1 : 0);

	
	$log_array['event_severity'] = 'notice';
	$log_array['event_number'] = E_USER_NOTICE;
	$log_array['event_description'] = 'Active Directory Settings Edited';
	$log_array['event_file'] = __FILE__;
	$log_array['event_file_line'] = __LINE__;
	$log_array['event_type'] = 'edit';
	$log_array['event_source'] = 'ad_settings';
	$log_array['event_version'] = '1';
	$log_array['log_backtrace'] = false;	
			
	$log->add($log_array);
	
	$message = $language->get('Settings Saved');
}


include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_header.php');
?>
	<form method="post" action="<?php echo safe_output($_SERVER['REQUEST_URI']); ?>">

		<div id="sidebar">
			<div id="login-details" class="widget">
				<div class="left">
					<h2><?php echo safe_output($language->get('Active Directory')); ?></h2>
				</div>
				
				<div class="right">
					<p><button type="submit" name="save"><?php echo safe_output($language->get('Save')); ?></button></p>
				</div>
				<div class="clear"></div>	

			</div>
		</div>

		<div id="box">

			<?php if (!extension_loaded('ldap')) { ?>
				<div id="content">
					<?php echo message($language->get('Note: LDAP is required for this function to work.')); ?>
				</div>
			<?php } ?>
		
			<?php if (isset($message)) { ?>
				<div id="content">
					<?php echo message($message); ?>
				</div>
			<?php } ?>
		
			<div id="content">		
			
				<p><?php echo safe_output($language->get('Enabled')); ?><br />
				<select name="ad_enabled">
					<option value="0"><?php echo safe_output($language->get('No')); ?></option>
					<option value="1"<?php if ($config->get('ad_enabled') == 1) { echo ' selected="selected"'; } ?>><?php echo safe_output($language->get('Yes')); ?></option>
				</select></p>
				<p><?php echo safe_output($language->get('Server (e.g. dc.example.local or 192.168.1.1)')); ?><br /><input type="text" name="ad_server" size="30" value="<?php echo safe_output($config->get('ad_server')); ?>" /></p>				
				<p><?php echo safe_output($language->get('Account Suffix (e.g. @example.local)')); ?><br /><input type="text" name="ad_account_suffix" size="30" value="<?php echo safe_output($config->get('ad_account_suffix')); ?>" /></p>
				<p><?php echo safe_output($language->get('Base DN (e.g. DC=example,DC=local)')); ?><br /><input type="text" name="ad_base_dn" size="30" value="<?php echo safe_output($config->get('ad_base_dn')); ?>" /></p>

				<p><?php echo safe_output($language->get('Create user on valid login')); ?><br />
				<select name="ad_create_accounts">
					<option value="0"><?php echo safe_output($language->get('No')); ?></option>
					<option value="1"<?php if ($config->get('ad_create_accounts') == 1) { echo ' selected="selected"'; } ?>><?php echo safe_output($language->get('Yes')); ?></option>
				</select></p>				
									
				<div class="clear"></div>


			</div>
		</div>
	</form>

<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>