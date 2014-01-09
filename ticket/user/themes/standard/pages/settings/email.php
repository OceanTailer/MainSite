<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title($language->get('Email Settings'));

if ($auth->get('user_level') != 2) {
	header('Location: ' . $config->get('address') . '/');
	exit;
}

if (isset($_POST['save'])) {

	$config->set('default_smtp_account', (int) $_POST['default_smtp_account']);
	
	$config->set('notification_new_ticket_subject', $_POST['notification_new_ticket_subject']);
	$config->set('notification_new_ticket_body', $_POST['notification_new_ticket_body']);
	$config->set('notification_new_ticket_note_subject', $_POST['notification_new_ticket_note_subject']);
	$config->set('notification_new_ticket_note_body', $_POST['notification_new_ticket_note_body']);	
	$config->set('notification_new_user_subject', $_POST['notification_new_user_subject']);
	$config->set('notification_new_user_body', $_POST['notification_new_user_body']);
	
	$log_array['event_severity'] 		= 'notice';
	$log_array['event_number'] 			= E_USER_NOTICE;
	$log_array['event_description'] 	= 'Email Settings Edited';
	$log_array['event_file'] 			= __FILE__;
	$log_array['event_file_line'] 		= __LINE__;
	$log_array['event_type'] 			= 'edit';
	$log_array['event_source'] 			= 'email_settings';
	$log_array['event_version'] 		= '1';
	$log_array['log_backtrace'] 		= false;	
			
	$log->add($log_array);
	
	$message = $language->get('Settings Saved');
}

if (isset($_POST['test_cron'])) {
	$cron->run();
	
	$message = $language->get('Cron has been run.');
}

if (isset($_POST['test'])) {
	if (!empty($_POST['test_email'])) {
		$test_array['subject']			= $config->get('name') . ' - Test Email';
		$test_array['body']				= 'This is a test email.';
		$test_array['to']['to']			= $_POST['test_email'];
		$test_array['to']['to_name']	= 'Test';
		
		if (!empty($_POST['test_smtp_account_id'])) {
			$test_array['smtp_account_id']	= (int) $_POST['test_smtp_account_id'];
		}
			
		if ($mailer->send_email($test_array)) {
			$message =  $language->get('Test Email Sent');
		}
		else {
			$message =  $language->get('Test Email Failed. View the logs for more details.');
		}
	}
	else {
		$message =  $language->get('Test Email Failed. Email address was empty.');
	}

}

$pop_array 			= $pop_accounts->get(array('get_other_data' => true));
$smtp_array 		= $smtp_accounts->get();


include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_header.php');
?>
	<form method="post" action="<?php echo safe_output($_SERVER['REQUEST_URI']); ?>">

		<div id="sidebar">
			<div id="email-details" class="widget">
				<div class="left">
					<h2><?php echo safe_output($language->get('Email Settings')); ?></h2>
				</div>
				
				<div class="right">
					<p><button type="submit" name="save"><?php echo safe_output($language->get('Save')); ?></button></p>
				</div>
				<div class="clear"></div>	
				<br />
				<p><?php echo safe_output($language->get('Please ensure that you have the cron system setup, otherwise emails will not be sent or downloaded.')); ?></p>
				<div class="right">
					<p><button type="submit" name="test_cron"><?php echo safe_output($language->get('Run Cron Manually')); ?></button></p>
				</div>
				<div class="clear"></div>

			</div>
			
			<?php if (!empty($smtp_array)) { ?>
				<div id="email-test" class="widget">
					<div class="left">
						<h2><?php echo safe_output($language->get('Test Email')); ?></h2>
					</div>
					
					<div class="right">
						<p><button type="submit" name="test"><?php echo safe_output($language->get('Send Test')); ?></button></p>
					</div>
					
					<div class="clear"></div>	
					
					<p><?php echo safe_output($language->get('Select SMTP Account')); ?><br />
						<select name="test_smtp_account_id">
							<option value=""><?php echo safe_output($language->get('Default SMTP Account')); ?></option>
							<?php foreach ($smtp_array as $item) { ?>
								<option value="<?php echo safe_output($item['id']); ?>"><?php echo safe_output($item['name']); ?></option>
							<?php } ?>
						</select>
						</p>
					
					<p><?php echo safe_output($language->get('Email Address')); ?><br /><input type="text" name="test_email" size="20" value="" /></p>		
			
				</div>
			<?php } ?>
			
		</div>

		<div id="box">
			<?php if (isset($message)) { ?>
				<div id="content">
					<?php echo message($message); ?>
				</div>
			<?php } ?>
					
			<div id="content">		
				
				<a name="smtp_accounts"></a>
				
				<div class="left">
					<h3><?php echo safe_output($language->get('SMTP Accounts')); ?></h3>
				</div>

				<div class="right">
					<p><a href="<?php echo safe_output($config->get('address')); ?>/settings/add_smtp_account/" class="button grey"><?php echo safe_output($language->get('Add')); ?></a></p>
				</div>
				
				<div class="clear"></div>

				<?php if (!empty($smtp_array)) { ?>
					<table class="data-table">
						<thead>
							<tr>
								<th><?php echo safe_output($language->get('Default SMTP Account')); ?></th>
								<th><?php echo safe_output($language->get('Name')); ?></th>
								<th><?php echo safe_output($language->get('Hostname')); ?></th>
								<th><?php echo safe_output($language->get('Email Address')); ?></th>
								<th><?php echo safe_output($language->get('Enabled')); ?></th>
							</tr>
						</thead>
						
						<tbody>
							<?php
							$i = 0;
							foreach ($smtp_array as $item) {
							?>
							<tr <?php if ($i % 2 == 0 ) { echo 'class="switch-1"'; } else { echo 'class="switch-2"'; }; ?>>
								<td class="centre"><input type="radio" name="default_smtp_account" value="<?php echo (int) $item['id']; ?>" <?php if ($config->get('default_smtp_account') == $item['id']) { echo ' checked="checked"'; } ?> /></td>
								<td class="centre"><a href="<?php echo safe_output($config->get('address')); ?>/settings/edit_smtp_account/<?php echo (int) $item['id']; ?>/"><?php echo safe_output($item['name']); ?></a></td>
								<td class="centre"><?php echo safe_output($item['hostname']); ?></td>
								<td class="centre"><?php echo safe_output($item['email_address']); ?></td>
								<td class="centre"><?php if ($item['enabled'] == 1) { ?><?php echo safe_output($language->get('Yes')); ?><?php } else { ?><?php echo safe_output($language->get('No')); ?><?php } ?></td>
							</tr>
							<?php $i++; } ?>
						</tbody>
					</table>
				<?php } else { ?>
					<?php echo message($language->get('No SMTP Accounts Are Setup.')); ?>
				<?php } ?>
									
				<div class="clear"></div>
			</div>
			
			<div id="content">		
				<a name="pop3_accounts"></a>
				
				<div class="left">
					<h3><?php echo safe_output($language->get('POP3 Accounts')); ?></h3>
				</div>

				<div class="right">
					<p><a href="<?php echo safe_output($config->get('address')); ?>/settings/add_pop_account/" class="button grey"><?php echo safe_output($language->get('Add')); ?></a></p>
				</div>
				
				<div class="clear"></div>

				<?php if (!empty($pop_array)) { ?>
					<table class="data-table">
						<thead>
							<tr>
								<th><?php echo safe_output($language->get('Name')); ?></th>
								<th><?php echo safe_output($language->get('Hostname')); ?></th>
								<th><?php echo safe_output($language->get('Username')); ?></th>
								<th><?php echo safe_output($language->get('Department')); ?></th>
								<th><?php echo safe_output($language->get('Enabled')); ?></th>
							</tr>
						</thead>
						
						<tbody>
							<?php
							$i = 0;
							foreach ($pop_array as $item) {
							?>
							<tr <?php if ($i % 2 == 0 ) { echo 'class="switch-1"'; } else { echo 'class="switch-2"'; }; ?>>
								<td class="centre"><a href="<?php echo safe_output($config->get('address')); ?>/settings/edit_pop_account/<?php echo (int) $item['id']; ?>/"><?php echo safe_output($item['name']); ?></a></td>
								<td class="centre"><?php echo safe_output($item['hostname']); ?></td>
								<td class="centre"><?php echo safe_output($item['username']); ?></td>
								<td class="centre"><?php echo safe_output($item['department_name']); ?></td>
								<td class="centre"><?php if ($item['enabled'] == 1) { ?><?php echo safe_output($language->get('Yes')); ?><?php } else { ?><?php echo safe_output($language->get('No')); ?><?php } ?></td>
							</tr>
							<?php $i++; } ?>
						</tbody>
					</table>
				<?php } else { ?>
					<?php echo message($language->get('No POP3 Accounts Are Setup.')); ?>
				<?php } ?>
									
				<div class="clear"></div>

			</div>
			
			<div id="content">
				<h3><?php echo safe_output($language->get('Email Notification Templates')); ?></h3>
				<br />
				
				<p><b><?php echo safe_output($language->get('New Ticket')); ?></b></p>
				
				<p><?php echo safe_output($language->get('Subject')); ?><br /><input type="text" name="notification_new_ticket_subject" size="50" value="<?php echo safe_output($config->get('notification_new_ticket_subject')); ?>" /></p>

				<div id="no_underline">
					<p><?php echo safe_output($language->get('Body')); ?><br />
						<textarea class="wysiwyg_enabled" name="notification_new_ticket_body" cols="80" rows="12">
							<?php echo safe_output($config->get('notification_new_ticket_body')); ?>
						</textarea>
					</p>
				</div>
				
				<br />
				
				<p><b><?php echo safe_output($language->get('New Ticket Note')); ?></b></p>
				
				<p><?php echo safe_output($language->get('Subject')); ?><br /><input type="text" name="notification_new_ticket_note_subject" size="50" value="<?php echo safe_output($config->get('notification_new_ticket_note_subject')); ?>" /></p>
				
				<div id="no_underline">
					<p><?php echo safe_output($language->get('Body')); ?><br />
						<textarea class="wysiwyg_enabled" name="notification_new_ticket_note_body" cols="80" rows="12">
							<?php echo safe_output($config->get('notification_new_ticket_note_body')); ?>
						</textarea>
					</p>
				</div>
				
				<br />
				
				<p><b><?php echo safe_output($language->get('New User (Welcome Email)')); ?></b></p>
				
				<p><?php echo safe_output($language->get('Subject')); ?><br /><input type="text" name="notification_new_user_subject" size="50" value="<?php echo safe_output($config->get('notification_new_user_subject')); ?>" /></p>
				
				<div id="no_underline">
					<p><?php echo safe_output($language->get('Body')); ?><br />
						<textarea class="wysiwyg_enabled" name="notification_new_user_body" cols="80" rows="12">
							<?php echo safe_output($config->get('notification_new_user_body')); ?>
						</textarea>
					</p>
				</div>
			</div>
		</div>
	</form>
	
<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>