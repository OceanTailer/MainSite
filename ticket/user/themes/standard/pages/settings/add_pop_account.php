<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title($language->get('Add POP Account'));

if ($auth->get('user_level') != 2) {
	header('Location: ' . $config->get('address') . '/');
	exit;
}

if (isset($_POST['add'])) {

	if (!empty($_POST['name'])) {
	
		//pop3
		$account_array['name']				= $_POST['name'];
		$account_array['hostname']			= $_POST['hostname'];
		$account_array['username']			= $_POST['username'];
		$account_array['password']			= $_POST['password'];
		
		$account_array['enabled']			= $_POST['enabled'] ? 1 : 0;
		$account_array['tls']				= $_POST['tls'] ? 1 : 0;
		$account_array['download_files']	= $_POST['download_files'] ? 1 : 0;
		$account_array['leave_messages']	= $_POST['leave_messages'] ? 1 : 0;
		
		$account_array['port']				= (int) $_POST['port'];
		$account_array['department_id']		= (int) $_POST['department_id'];
		$account_array['priority_id']		= (int) $_POST['priority_id'];
		
		if (isset($_POST['smtp_account_id']) && !empty($_POST['smtp_account_id'])) {
			$account_array['smtp_account_id']	= (int) $_POST['smtp_account_id'];
		}
		
		$pop_accounts->add($account_array);
			
		header('Location: ' . $config->get('address') . '/settings/email/#pop3_accounts');
		exit;
	}
	else {
		$message = $language->get('Name Empty');
	}
	
}

$priorities 	= $ticket_priorities->get(array('enabled' => 1));
$departments	= $ticket_departments->get(array('enabled' => 1));
$smtp_array 	= $smtp_accounts->get();


include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_header.php');
?>
	<form method="post" action="<?php echo safe_output($_SERVER['REQUEST_URI']); ?>">

		<div id="sidebar">
			<div id="login-details" class="widget">
				<div class="left">
					<h2><?php echo safe_output($language->get('Add Account')); ?></h2>
				</div>
				
				<div class="right">
					<p>
					<button type="submit" name="add"><?php echo safe_output($language->get('Add')); ?></button>
					<a href="<?php echo $config->get('address'); ?>/settings/email/#pop3_accounts" class="button grey"><?php echo safe_output($language->get('Cancel')); ?></a>
					</p>
				</div>
				<div class="clear"></div>
				<p><?php echo safe_output($language->get('Adding a POP account allows the system to download emails from the POP account and convert them into Tickets.')); ?></p>
				<br />
				<p><?php echo safe_output($language->get('The system will match email address to existing users and attach emails to ticket notes if the email is part of an existing ticket.')); ?></p>
				<br />
				<p><?php echo safe_output($language->get('The Department and Priority options are only used when creating a new ticket and not when attaching an email to an existing ticket.')); ?></p>
				
			</div>
		</div>

		<div id="box">
			
			<?php if (isset($message)) { ?>
			<div id="content">
				<?php echo message($message); ?>
			</div>
			<?php } ?>
			
			<div id="content">		
									
				<p><?php echo safe_output($language->get('Enabled')); ?><br />
				<select name="enabled">
					<option value="0"><?php echo safe_output($language->get('No')); ?></option>
					<option value="1"<?php if (isset($_POST['enabled']) && $_POST['enabled'] == 1) { echo ' selected="selected"'; } ?>><?php echo safe_output($language->get('Yes')); ?></option>
				</select></p>
				
				<p><?php echo safe_output($language->get('Name (nickname for this account)')); ?><br /><input type="text" name="name" size="30" value="<?php if (isset($_POST['name'])) echo safe_output($_POST['name']); ?>" /></p>

				<p><?php echo safe_output($language->get('Hostname (i.e mail.example.com)')); ?><br /><input type="text" name="hostname" size="30" value="<?php if (isset($_POST['hostname'])) echo safe_output($_POST['hostname']); ?>" /></p>
				
				<p><?php echo safe_output($language->get('Port (default 110)')); ?><br /><input type="text" name="port" size="5" value="<?php if (isset($_POST['hostname'])) { echo (int) ($_POST['port']); } else { echo '110'; } ?>" /></p>
	
				<p><?php echo safe_output($language->get('TLS (required for gmail and other servers that use SSL)')); ?><br />
				<select name="tls">
					<option value="0"><?php echo safe_output($language->get('No')); ?></option>
					<option value="1"<?php if (isset($_POST['tls']) && $_POST['tls'] == 1) { echo ' selected="selected"'; } ?>><?php echo safe_output($language->get('Yes')); ?></option>
				</select></p>

				<p><?php echo safe_output($language->get('Download File Attachments')); ?><br />
				<select name="download_files">
					<option value="1"><?php echo safe_output($language->get('Yes')); ?></option>
					<option value="0"<?php if (isset($_POST['download_files']) && $_POST['download_files'] == 0) { echo ' selected="selected"'; } ?>><?php echo safe_output($language->get('No')); ?></option>
				</select></p>
				
				<p><?php echo safe_output($language->get('Leave Message on Server')); ?><br />
				<select name="leave_messages">
					<option value="0"><?php echo safe_output($language->get('No')); ?></option>
					<option value="1"<?php if (isset($_POST['leave_messages']) && $_POST['leave_messages'] == 1) { echo ' selected="selected"'; } ?>><?php echo safe_output($language->get('Yes')); ?></option>
				</select></p>
	
				<p><?php echo safe_output($language->get('Username')); ?><br /><input type="text" name="username" size="30" value="<?php if (isset($_POST['username'])) echo safe_output($_POST['username']); ?>" /></p>
				<p><?php echo safe_output($language->get('Password')); ?><br /><input type="password" name="password" size="30" value="<?php if (isset($_POST['password'])) echo safe_output($_POST['password']); ?>" /></p>

				<p><?php echo safe_output($language->get('Department')); ?><br />
				<select name="department_id">
					<?php foreach ($departments as $department) { ?>
					<option value="<?php echo (int) $department['id']; ?>"<?php if (isset($_POST['department_id']) && $_POST['department_id'] == $department['id']) { echo ' selected="selected"'; } ?>><?php echo safe_output($department['name']); ?></option>
					<?php } ?>
				</select></p>
				
				<p><?php echo safe_output($language->get('Priority')); ?><br />
				<select name="priority_id">
					<?php foreach ($priorities as $priority) { ?>
					<option value="<?php echo (int) $priority['id']; ?>"<?php if (isset($_POST['priority_id']) && $_POST['priority_id'] == $priority['id']) { echo ' selected="selected"'; } ?>><?php echo safe_output($priority['name']); ?></option>
					<?php } ?>
				</select></p>				
				
				<p><?php echo safe_output($language->get('SMTP Account')); ?><br />
				<select name="smtp_account_id">
					<option value=""><?php echo safe_output($language->get('Default SMTP Account')); ?></option>
					<?php foreach ($smtp_array as $smtp) { ?>
						<option value="<?php echo safe_output($smtp['id']); ?>"<?php if (isset($_POST['smtp_account_id']) && $smtp['id'] == $_POST['smtp_account_id']) { echo ' selected="selected"'; } ?>><?php echo safe_output($smtp['name']); ?></option>
					<?php } ?>
				</select>
				</p>		
				
				<div class="clear"></div>

			</div>
		</div>
	</form>
	
<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>