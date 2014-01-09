<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title($language->get('Add User'));

if ($auth->get('user_level') != 2) {
	header('Location: ' . $config->get('address') . '/');
	exit;
}

if (isset($_POST['add'])) {
	if (!empty($_POST['name'])) {
		if (!empty($_POST['username'])) {
			if (!$users->check_username_taken(array('username' => $_POST['username']))) {
				if (empty($_POST['email']) || check_email_address($_POST['email'])) {
					if (!empty($_POST['password']) && (int) $_POST['authentication_id'] == 1) {
						if ($_POST['password'] == $_POST['password2']) {
							$add_array = array(
									'name' 					=> $_POST['name'], 
									'email' 				=> $_POST['email'],
									'authentication_id'		=> 1,
									'allow_login'			=> 1,
									'username'				=> $_POST['username'],
									'password'				=> $_POST['password'],
									'address'				=> $_POST['address'],
									'phone_number'			=> $_POST['phone_number'],
									'user_level'			=> (int) $_POST['user_level'],
									'email_notifications'	=> $_POST['email_notifications'] ? 1 : 0,
									'welcome_email'			=> $_POST['welcome_email'] ? 1 : 0
							);
							
							if ($config->get('pushover_enabled') && isset($_POST['pushover_key'])) {
								$add_array['pushover_key']	= $_POST['pushover_key'];
							}
							
							$id = $users->add($add_array);
							
							if (isset($_POST['departments']) && !empty($_POST['departments'])) {
								foreach($_POST['departments'] as $department) {
									$users_to_departments->add(array('user_id' => $id, 'department_id' => (int) $department));
								}
							}
							
							header('Location: ' . $config->get('address') . '/users/view/' . $id . '/');
							exit;
						}
						else {
							$message = $language->get('Passwords Do Not Match');
						}
					}
					else if((int) $_POST['authentication_id'] == 2) {
						$add_array = 
							array(
								'name' 					=> $_POST['name'], 
								'email' 				=> $_POST['email'],
								'authentication_id' 	=> 2,
								'allow_login'			=> 1,
								'username'				=> $_POST['username'],
								'address'				=> $_POST['address'],
								'phone_number'			=> $_POST['phone_number'],
								'user_level'			=> (int) $_POST['user_level'],
								'email_notifications'	=> $_POST['email_notifications'] ? 1 : 0,
								'welcome_email'			=> $_POST['welcome_email'] ? 1 : 0
							);
						if ($config->get('pushover_enabled') && isset($_POST['pushover_key'])) {
							$add_array['pushover_key']	= $_POST['pushover_key'];
						}
						$id = $users->add($add_array);
						
						
						if (isset($_POST['departments']) && !empty($_POST['departments'])) {
							foreach($_POST['departments'] as $department) {
								$users_to_departments->add(array('user_id' => $id, 'department_id' => (int) $department));
							}
						}
						
						header('Location: ' . $config->get('address') . '/users/view/' . $id . '/');
						exit;		
					}
					else {
						$message = $language->get('Password Empty');
					}
				}
				else {
					$message = $language->get('Email Address Invalid');
				}
			}
			else {
				$message = $language->get('Username In Use');
			}
		}
		else {
			$message = $language->get('Username Empty');
		}
	}
	else {
		$message = $language->get('Name Empty');
	}
}

$departments 	= $ticket_departments->get(array('enabled' => 1));


include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_header.php');
?>
<form method="post" action="<?php echo safe_output($_SERVER['REQUEST_URI']); ?>">

	<div id="sidebar">
		<div id="users-details" class="widget">
			<div class="left">
				<h2><?php echo safe_output($language->get('New User')); ?></h2>
			</div>
			
			<div class="right">
				<p><button type="submit" name="add"><?php echo safe_output($language->get('Add')); ?></button></p>
			</div>
			
			<div class="clear"></div>
			
			<p><?php echo safe_output($language->get('If email address is present notifications can be emailed to the user.')); ?></p>
			
			<h3><?php echo safe_output($language->get('Authentication Type')); ?></h3>
			<p><?php echo safe_output($language->get('Local: The password is stored in the local database.')); ?></p>
			<p><?php echo safe_output($language->get('Active Directory: The password is stored in Active Directory, password fields are ignored.')); ?></p>
			<p><?php echo safe_output($language->get('Note: Active Directory must be enabled and connected to an Active Directory server in the settings page.')); ?></p>
			<h3><?php echo safe_output($language->get('Permissions')); ?></h3>
			<p><?php echo safe_output($language->get('Submitters: Can create and view their own tickets.')); ?></p>
			<p><?php echo safe_output($language->get('Users: Can create and view their own tickets and view assigned tickets.')); ?></p>
			<p><?php echo safe_output($language->get('Staff: Can create and view their own tickets, view assigned tickets and view tickets within assigned departments.')); ?></p>
			<p><?php echo safe_output($language->get('Moderators: Can create and view tickets, assign tickets and create tickets for other users within assigned departments.')); ?></p>
			<p><?php echo safe_output($language->get('Global Moderators: Can create and view all tickets, assign tickets and create tickets for other users.')); ?></p>
			<p><?php echo safe_output($language->get('Administrators: The same as Global Moderators but can add users and change System Settings.')); ?></p>
			
		</div>
	</div>

	<div id="box">
	
		<?php if (isset($message)) { ?>
			<div id="content">
				<?php echo message($message); ?>
				<div class="clear"></div>
			</div>
		<?php } ?>
		
		<div id="content">		

			<p><?php echo safe_output($language->get('Full Name')); ?><br /><input type="text" name="name" size="20" value="<?php if (isset($_POST['name'])) { echo safe_output($_POST['name']); } else if (isset($_GET['name'])) { echo safe_output($_GET['name']); } ?>" /></p>
			<p><?php echo safe_output($language->get('Username')); ?><br /><input type="text" name="username" value="<?php if (isset($_POST['username'])) echo safe_output($_POST['username']); ?>" /></p>
			<p><?php echo safe_output($language->get('Email (recommended)')); ?><br /><input type="text" name="email" size="30" value="<?php if (isset($_POST['email'])) { echo safe_output($_POST['email']); } else if (isset($_GET['email'])) { echo safe_output($_GET['email']); } ?>" /></p>

			<p><?php echo safe_output($language->get('Password')); ?><br /><input type="password" name="password" value="" autocomplete="off" /></p>
			<p><?php echo safe_output($language->get('Password Again')); ?><br /><input type="password" name="password2" value="" autocomplete="off" /></p>
			
			<p><?php echo safe_output($language->get('Phone (optional)')); ?><br /><input type="text" name="phone_number" size="20" value="<?php if (isset($_POST['phone_number'])) { echo safe_output($_POST['phone_number']); } ?>" /></p>

			<p><?php echo safe_output($language->get('Address (optional)')); ?><br />
				<textarea id="address" name="address" cols="30" rows="5"><?php if (isset($_POST['address'])) echo safe_output($_POST['address']); ?></textarea>
			</p>
			
			<p><?php echo safe_output($language->get('Authentication Type')); ?><br />
			<select name="authentication_id">
				<option value="1"><?php echo safe_output($language->get('Local')); ?></option>
				<option value="2"<?php if (isset($_POST['authentication_id']) && ($_POST['authentication_id'] == 2)) echo ' selected="selected"'; ?>><?php echo safe_output($language->get('Active Directory')); ?></option>
			</select></p>

			<p><?php echo safe_output($language->get('Permissions')); ?><br />
			<select name="user_level">
				<option value="1"><?php echo safe_output($language->get('Submitter')); ?></option>
				<option value="3"<?php if (isset($_POST['user_level']) && ($_POST['user_level'] == 3)) echo ' selected="selected"'; ?>><?php echo safe_output($language->get('User')); ?></option>
				<option value="4"<?php if (isset($_POST['user_level']) && ($_POST['user_level'] == 4)) echo ' selected="selected"'; ?>><?php echo safe_output($language->get('Staff')); ?></option>
				<option value="5"<?php if (isset($_POST['user_level']) && ($_POST['user_level'] == 5)) echo ' selected="selected"'; ?>><?php echo safe_output($language->get('Moderator')); ?></option>
				<option value="6"<?php if (isset($_POST['user_level']) && ($_POST['user_level'] == 6)) echo ' selected="selected"'; ?>><?php echo safe_output($language->get('Global Moderator')); ?></option>
				<option value="2"<?php if (isset($_POST['user_level']) && ($_POST['user_level'] == 2)) echo ' selected="selected"'; ?>><?php echo safe_output($language->get('Administrator')); ?></option>
			</select></p>
			
			<p><?php echo safe_output($language->get('Notifications')); ?><br />
			<select name="email_notifications">
				<option value="1"<?php if (isset($_POST['email_notifications']) && ($_POST['email_notifications'] == 1)) { echo ' selected="selected"'; } ?>><?php echo safe_output($language->get('On')); ?></option>
				<option value="0"><?php echo safe_output($language->get('Off')); ?></option>
			</select></p>
			
			<?php if ($config->get('pushover_enabled')) { ?>
				<p><?php echo $language->get('Pushover Key'); ?><br /><input type="text" name="pushover_key" size="35" value="<?php if (isset($_POST['pushover_key'])) { echo safe_output($_POST['pushover_key']); } ?>" /></p>
			<?php } ?>
			
			<p><?php echo safe_output($language->get('Send Welcome Email')); ?><br />
			<select name="welcome_email">
				<option value="1"<?php if (isset($_POST['welcome_email']) && ($_POST['welcome_email'] == 1)) { echo ' selected="selected"'; } ?>><?php echo safe_output($language->get('Yes')); ?></option>
				<option value="0"><?php echo safe_output($language->get('No')); ?></option>
			</select>		
			</p>				
			
			<p><?php echo safe_output($language->get('Departments')); ?><br />
			<?php foreach ($departments as $department) { ?>
				<input type="checkbox" name="departments[]" value="<?php echo (int) $department['id']; ?>" /> <?php echo safe_output($department['name']); ?><br />					
			<?php } ?>
			</p>
			

				
			<div class="clear"></div>
			
		</div>
	</div>
</form>


<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>