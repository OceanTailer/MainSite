<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title($language->get('Profile'));


if (isset($_POST['save'])) {
			
	if (!empty($_POST['name'])) {

		$array = array(
			'id'					=> $auth->get('id'),
			'name'					=> $_POST['name'],
			'email_notifications'	=> $_POST['email_notifications'] ? 1 : 0,
		);
		
		if ($config->get('pushover_enabled') && $config->get('pushover_user_enabled')) {
			if (isset($_POST['pushover_key'])) {
				$array['pushover_key'] = $_POST['pushover_key'];
			}
		}
	
		$users->edit($array);
		
		$auth->load();
		
		$message = $language->get('Profile Updated');
	}
	else {
		$message = $language->get('Name Empty');
	}

	if ($auth->get('authentication_id') == 1) {
		
		if (!empty($_POST['current_password']) && !empty($_POST['password']) && !empty($_POST['password2'])) {
		
			if ($auth->test_password(array('id' => $auth->get('id'), 'password' => $_POST['current_password']))) {
				
				if ($_POST['password'] === $_POST['password2']) {
				
					$array = array(
						'id'					=> $auth->get('id'),
						'name'					=> $_POST['name'],
						'email_notifications'	=> $_POST['email_notifications'] ? 1 : 0,
						'password'				=> $_POST['password'],
					);
				
					if ($config->get('pushover_enabled') && $config->get('pushover_user_enabled')) {
						if (isset($_POST['pushover_key'])) {
							$array['pushover_key'] = $_POST['pushover_key'];
						}
					}
				
					$users->edit($array);
				
					$message = 'Password Changed';
				}
				else {
					$message = 'New Passwords Do Not Match';
				}
				
			}
			else {
				$message = 'Current Password Incorrect';
			}
		
		}
	}
}


include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_header.php');
?>
<form method="post" action="<?php echo safe_output($_SERVER['REQUEST_URI']); ?>">

	<div id="sidebar">
		<div id="users-details" class="widget">
			<div class="left">
				<h2><?php echo safe_output($language->get('Profile')); ?></h2>
			</div>
			<div class="right">
				<p>
					<button type="submit" name="save"><?php echo safe_output($language->get('Save')); ?></button>
					<a href="<?php echo safe_output($config->get('address')); ?>/profile/" class="button grey"><?php echo safe_output($language->get('Cancel')); ?></a>
				</p>
			</div>		
		
			<div class="clear"></div>
			<p class="label short"><?php echo safe_output($language->get('Name')); ?></p>
			<p class="result">
				<?php echo safe_output(ucwords($auth->get('name'))); ?>
			</p>	
			<div class="clear"></div>
			<p class="label short"><?php echo safe_output($language->get('Username')); ?></p>
			<p class="result">
				<?php echo safe_output($auth->get('username')); ?>
			</p>					
			<div class="clear"></div>
			<p class="label short"><?php echo safe_output($language->get('Email')); ?></p>
			<p class="result">
				<?php echo safe_output($auth->get('email')); ?>
			</p>	

			<div class="clear"></div>
			<?php if ($config->get('gravatar_enabled')) { ?>
			<p class="label short"><?php echo safe_output($language->get('Gravatar')); ?></p>
			<p class="result">
				<?php $gravatar->setEmail($auth->get('email')); ?>
				<img src="<?php echo $gravatar->getUrl(); ?>" alt="Gravatar" />
			</p>
			<?php } ?>
	

			<div class="clear"></div>
		
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
		
			<p><?php echo safe_output($language->get('Name')); ?><br /><input type="text" name="name" size="20" value="<?php echo safe_output($auth->get('name')); ?>" /></p>
		
			<p><?php echo safe_output($language->get('Notifications')); ?><br />
			<select name="email_notifications">
				<option value="0"><?php echo safe_output($language->get('Off')); ?></option>
				<option value="1"<?php if ($auth->get('email_notifications') == 1) { echo ' selected="selected"'; } ?>><?php echo safe_output($language->get('On')); ?></option>
			</select></p>
			
			<?php if ($config->get('pushover_enabled') && $config->get('pushover_user_enabled')) { ?>
				<p><?php echo $language->get('Pushover Key'); ?> (<a href="https://pushover.net/">Pushover Website</a>)<br /><input type="text" name="pushover_key" size="35" value="<?php echo safe_output($auth->get('pushover_key')); ?>" /></p>
			<?php } ?>

			<h3><?php echo safe_output($language->get('Change Password')); ?></h3>			
			<?php if ($auth->get('authentication_id') == 1) { ?>
				<p><?php echo safe_output($language->get('Current Password')); ?><br /><input type="password" name="current_password" value="" autocomplete="off" /></p>
				<p><?php echo safe_output($language->get('New Password')); ?><br /><input type="password" name="password" value="" autocomplete="off" /></p>
				<p><?php echo safe_output($language->get('New Password Again')); ?><br /><input type="password" name="password2" value="" autocomplete="off" /></p>
			<?php } else { ?>
				<?php echo message($language->get('You cannot change the password for this account.')); ?>
			<?php } ?>
			
			<div class="clear"></div>

		</div>
	</div>
</form>
<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>