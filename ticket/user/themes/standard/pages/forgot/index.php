<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title($language->get('Forgot Password'));

if (isset($_POST['reset'])) {
	if (!empty($_POST['username'])) {
		$users_array = $users->get(array('username' => $_POST['username'], 'allow_login' => 1, 'authentication_id' => 1));
		
		if (count($users_array) == 1) {
			$user = $users_array[0];
			
			if (!empty($user['email'])) {
			
				$users->create_reset_key(array('username' => $_POST['username']));
			
				$message = $language->get('An email with a reset link has been sent to your account.');
			}
			else {
				$message = $language->get('Unable to reset password.');
			}
		}
		else {
			$message = $language->get('Unable to reset password.');
		}
	}
	else {
		$message = $language->get('Unable to reset password.');
	}
}

include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_header.php');
?>
	<form method="post" action="<?php echo safe_output($_SERVER['REQUEST_URI']); ?>">

		<div id="sidebar">
			<div id="users-details" class="widget">
				<div class="left">
					<h2><?php echo safe_output($language->get('Forgot Password')); ?></h2>
				</div>
				<div class="right">
					<p><button type="submit" name="reset"><?php echo safe_output($language->get('Request Reset')); ?></button></p>
				</div>
				
				<div class="clear"></div>
	
				<p><?php echo safe_output($language->get('If you have forgotten your password you can reset it here.')); ?></p>
				<p><?php echo safe_output($language->get('An email will be sent to your account with a reset password link. Please follow this link to complete the password reset process.')); ?></p>
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
				<p><?php echo safe_output($language->get('Username')); ?><br /><input type="text" name="username" value="<?php if (isset($_POST['username'])) echo safe_output($_POST['username']); ?>" /></p>
					
				<div class="clear"></div>

			</div>
		</div>
	</form>


<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>