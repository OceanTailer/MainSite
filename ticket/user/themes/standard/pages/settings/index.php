<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title($language->get('Settings'));

if ($auth->get('user_level') != 2) {
	header('Location: ' . $config->get('address') . '/');
	exit;
}


if (isset($_POST['save'])) {

	if (!DEMO_MODE) {
		$config->set('name', $_POST['name']);
		$config->set('domain', $_POST['domain']);
		$config->set('script_path', $_POST['script_path']);
		$config->set('port_number', (int) $_POST['port_number']);
		$config->set('https', $_POST['https'] ? 1 : 0);
		$config->set('lockout_enabled', $_POST['lockout_enabled'] ? 1 : 0);
		$config->set('login_message', $_POST['login_message']);

		$config->set('gravatar_enabled', $_POST['gravatar_enabled'] ? 1 : 0);
		$config->set('registration_enabled', $_POST['registration_enabled'] ? 1 : 0);
		$config->set('html_enabled', $_POST['html_enabled'] ? 1 : 0);
		$config->set('captcha_enabled', $_POST['captcha_enabled'] ? 1 : 0);
		
		$config->set('storage_enabled', $_POST['storage_enabled'] ? 1 : 0);
		$config->set('storage_path', $_POST['storage_path']);

		$config->set('default_timezone', $_POST['default_timezone']);
		$config->set('default_language', $_POST['default_language']);
		
		$config->set('pushover_enabled', $_POST['pushover_enabled'] ? 1 : 0);
		$config->set('pushover_user_enabled', $_POST['pushover_user_enabled'] ? 1 : 0);
		$config->set('pushover_token', $_POST['pushover_token']);
		
		if (isset($_POST['pushover_user_id']) && !empty($_POST['pushover_user_id'])) {
			$current_pushover_users = $config->get('pushover_notify_users');
			if (!in_array($_POST['pushover_user_id'], $current_pushover_users)) {
				$current_pushover_users[] = (int) $_POST['pushover_user_id'];
				$config->set('pushover_notify_users', $current_pushover_users);
			}
		}

	}
	
	$log_array['event_severity'] = 'notice';
	$log_array['event_number'] = E_USER_NOTICE;
	$log_array['event_description'] = 'Settings Edited';
	$log_array['event_file'] = __FILE__;
	$log_array['event_file_line'] = __LINE__;
	$log_array['event_type'] = 'edit';
	$log_array['event_source'] = 'settings';
	$log_array['event_version'] = '1';
	$log_array['log_backtrace'] = false;	
			
	$log->add($log_array);
	
	$message = $language->get('Settings Saved');
}

$upgrade 		= new upgrade();
$langs 			= $language->get_system_languages();
$user_langs	 	= $language->get_user_languages();
$timezones		= get_timezones();
$pushover_users = $config->get('pushover_notify_users'); 

include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_header.php');
?>
	<form method="post" action="<?php echo safe_output($_SERVER['REQUEST_URI']); ?>">

		<div id="sidebar">
			<div id="login-details" class="widget">
				<div class="left">
					<h2><?php echo safe_output($language->get('Settings')); ?></h2>
				</div>
				
				<div class="right">
					<p><button type="submit" name="save"><?php echo safe_output($language->get('Save')); ?></button></p>
				</div>
				
				<div class="clear"></div>

				<p class="label short"><?php echo safe_output($language->get('Program Version')); ?></p>
				<p class="result">
					<?php echo safe_output($config->get('program_version')); ?>
				</p>
				<div class="clear"></div>

				<p class="label short"><?php echo safe_output($language->get('Database Version')); ?></p>
				<p class="result">
					<?php echo safe_output($config->get('database_version')); ?>
				</p>
				<div class="clear"></div>					
					
			</div>
		</div>
		<div id="box">
			<?php if (($config->get('database_version') !== $upgrade->get_db_version()) || ($config->get('program_version') !== $upgrade->get_program_version())) { ?>
				<div id="content">
					<?php echo message($language->get('The database needs upgrading before you continue.')); ?>
					<br />
					<div class="right">
						<p><a href="<?php echo safe_output($config->get('address')); ?>/upgrade/" class="button grey"><?php echo safe_output($language->get('Upgrade')); ?></a></p>
					</div>
					<div class="clear"></div>
				</div>
			<?php } ?>
			<?php if ($upgrade->update_available()) { ?>
				<div id="content">
					<?php echo message($language->get('There is a software update available.')); ?>
					<br />
					<div class="right">
						<p><a href="<?php echo safe_output($config->get('address')); ?>/update/info/" class="button grey"><?php echo safe_output($language->get('More Information')); ?></a></p>
					</div>
					<div class="clear"></div>
				</div>
			<?php } ?>
			
			<?php if (DEMO_MODE) { ?>
				<div id="content">
					<?php echo message('Demo Mode: Changing the settings on this page is disabled.'); ?>
				</div>
			<?php } ?>

			<?php if (isset($message)) { ?>
				<div id="content">
					<?php echo message($message); ?>
					<div class="clear"></div>
				</div>
			<?php } ?>
			
			<div id="content">		

				<h3><?php echo safe_output($language->get('Site Settings')); ?></h3>
				
				<p><?php echo safe_output($language->get('Site Name')); ?><br /><input type="text" name="name" value="<?php echo safe_output($config->get('name')); ?>" /></p>
					
				<p><?php echo safe_output($language->get('Domain Name (e.g example.com)')); ?><br /><input type="text" size="30" name="domain" value="<?php echo safe_output($config->get('domain')); ?>" /></p>
				<p><?php echo safe_output($language->get('Script Path (e.g /sts)')); ?><br /><input type="text" name="script_path" value="<?php echo safe_output($config->get('script_path')); ?>" /></p>
				<p><?php echo safe_output($language->get('Port Number (80 for HTTP and 443 for Secure HTTP are the norm)')); ?><br /><input type="text" name="port_number" value="<?php echo (int)($config->get('port_number')); ?>" /></p>
				<p><?php echo safe_output($language->get('Secure HTTP (recommended, requires SSL certificate)')); ?><br />
				<select name="https">
					<option value="0"><?php echo safe_output($language->get('No')); ?></option>
					<option value="1"<?php if ($config->get('https') == 1) { echo ' selected="selected"'; } ?>><?php echo safe_output($language->get('Yes')); ?></option>
				</select></p>

				<p><?php echo safe_output($language->get('Default Timezone')); ?><br />
				<select name="default_timezone">
					<?php foreach ($timezones as $timezone) { ?>
					<option value="<?php echo safe_output($timezone); ?>"<?php if ($config->get('default_timezone') == $timezone) { echo ' selected="selected"'; } ?>><?php echo safe_output($timezone); ?></option>
					<?php } ?>
				</select>
				</p>
				
				<p><?php echo safe_output($language->get('Default Language')); ?><br />
				<select name="default_language">
					<optgroup label="System Languages">
						<?php foreach ($langs as $lang) { ?>
						<option value="<?php echo safe_output($lang['name']); ?>"<?php if ($config->get('default_language') == $lang['name']) { echo ' selected="selected"'; } ?>><?php echo safe_output($lang['nice_name']); ?></option>
						<?php } ?>
					</optgroup>
					<optgroup label="User Languages">
						<?php foreach ($user_langs as $lang) { ?>
						<option value="<?php echo safe_output($lang['name']); ?>"<?php if ($config->get('default_language') == $lang['name']) { echo ' selected="selected"'; } ?>><?php echo safe_output($lang['nice_name']); ?></option>
						<?php } ?>
					</optgroup>
				</select>
				</p>
								
			</div>

			<div id="content">
				<h3><?php echo safe_output($language->get('Site Options')); ?></h3>
				
				<p><?php echo safe_output($language->get('HTML & WYSIWYG Editor')); ?><br />
				<select name="html_enabled">
					<option value="0"><?php echo safe_output($language->get('No')); ?></option>
					<option value="1"<?php if ($config->get('html_enabled') == 1) { echo ' selected="selected"'; } ?>><?php echo safe_output($language->get('Yes')); ?></option>
				</select></p>
				
				<p><?php echo safe_output($language->get('Account Protection (user accounts are locked for 15 minutes after 5 failed logins)')); ?><br />
				<select name="lockout_enabled">
					<option value="0"><?php echo safe_output($language->get('No')); ?></option>
					<option value="1"<?php if ($config->get('lockout_enabled') == 1) { echo ' selected="selected"'; } ?>><?php echo safe_output($language->get('Yes')); ?></option>
				</select></p>
		
				<p><?php echo safe_output($language->get('Login Message')); ?><br /><input type="text" name="login_message" size="50" value="<?php echo safe_output($config->get('login_message')); ?>" /></p>

				<p><?php echo safe_output($language->get('Account Registration Enabled')); ?><br />
				<select name="registration_enabled">
					<option value="0"><?php echo safe_output($language->get('No')); ?></option>
					<option value="1"<?php if ($config->get('registration_enabled') == 1) { echo ' selected="selected"'; } ?>><?php echo safe_output($language->get('Yes')); ?></option>
				</select></p>
				
				<p><?php echo safe_output($language->get('Anti-Spam Captcha Enabled (helps protect the guest portal and user registration from bots)')); ?><br />
				<select name="captcha_enabled">
					<option value="0"><?php echo safe_output($language->get('No')); ?></option>
					<option value="1"<?php if ($config->get('captcha_enabled') == 1) { echo ' selected="selected"'; } ?>><?php echo safe_output($language->get('Yes')); ?></option>
				</select></p>
				
				<p><?php echo safe_output($language->get('File Storage Enabled (for file attachments)')); ?><br />
				<select name="storage_enabled">
					<option value="0"><?php echo safe_output($language->get('No')); ?></option>
					<option value="1"<?php if ($config->get('storage_enabled') == 1) { echo ' selected="selected"'; } ?>><?php echo safe_output($language->get('Yes')); ?></option>
				</select></p>
			
				<p><?php echo safe_output($language->get('File Storage Path (must be outside the public web folder e.g./home/sts/files/ or C:\sts\files\)')); ?><br /><input type="text" name="storage_path" size="50" value="<?php echo safe_output($config->get('storage_path')); ?>" /></p>
				
				
				<div class="clear"></div>

			</div>
			
			<div id="content">
				<h3><?php echo safe_output($language->get('External Services')); ?></h3>
				
				<p><?php echo safe_output($language->get('Gravatar Enabled')); ?><br />
				<select name="gravatar_enabled">
					<option value="0"><?php echo safe_output($language->get('No')); ?></option>
					<option value="1"<?php if ($config->get('gravatar_enabled') == 1) { echo ' selected="selected"'; } ?>><?php echo safe_output($language->get('Yes')); ?></option>
				</select></p>	
				
				<p><?php echo safe_output($language->get('Pushover Enabled')); ?><br />
				<select id="pushover_enabled" name="pushover_enabled">
					<option value="0"><?php echo safe_output($language->get('No')); ?></option>
					<option value="1"<?php if ($config->get('pushover_enabled') == 1) { echo ' selected="selected"'; } ?>><?php echo safe_output($language->get('Yes')); ?></option>
				</select></p>

				<div id="pushover_extra">
					<p><?php echo safe_output($language->get('Pushover for all Users')); ?><br />
					<select name="pushover_user_enabled">
						<option value="0"><?php echo safe_output($language->get('No')); ?></option>
						<option value="1"<?php if ($config->get('pushover_user_enabled') == 1) { echo ' selected="selected"'; } ?>><?php echo safe_output($language->get('Yes')); ?></option>
					</select></p>				
					
					<p><?php echo safe_output($language->get('Pushover Application Token')); ?><br /><input type="text" name="pushover_token" size="35" value="<?php echo safe_output($config->get('pushover_token')); ?>" /></p>
											
					<p><?php echo safe_output($language->get('Below is a list of the users who will receive pushover notifications whenever a new ticket or ticket note is added.')); ?></p>
										
					<div id="no_underline">
					<?php if (!empty($pushover_users)) { ?>
						<?php foreach ($pushover_users as $pushover_user_id) { ?>
							<?php $user = $users->get(array('id' => $pushover_user_id)); ?>
							<?php if (!empty($user)) { ?>
								<div class="current_pushover_users_field" id="pushover_existing-<?php echo (int) $user[0]['id']; ?>">
									<p><input type="text" size="25" name="pushover_existing-<?php echo (int) $user[0]['id']; ?>" value="<?php echo safe_output($user[0]['name']); ?>" disabled="disabled" /> <a href="#pushover_users" id="delete_existing_pushover_user"><img src="<?php echo $config->get('address'); ?>/user/themes/<?php echo safe_output(CURRENT_THEME); ?>/images/icons/delete.png" alt="Delete Pushover User" /></a></p>
								</div>
							<?php } ?>
						<?php } ?>
					<?php } ?>
					</div>
				
					<?php $users_array 	= $users->get(); ?>
						
					<p><?php echo safe_output($language->get('Add User')); ?><br />
					<select name="pushover_user_id">
						<option value=""></option>
						<?php foreach ($users_array as $user) { ?>
						<option value="<?php echo (int) $user['id']; ?>"><?php echo safe_output($user['name']); ?></option>
						<?php } ?>
					</select></p>	

				</div>	
				
				<div class="clear"></div>

	
			</div>
			
	
		</div>
	
	</form>

<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>