<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title('Reset Password');

$reset_form	= false;

if (isset($_GET['key']) && !empty($_GET['key']) && isset($_GET['username']) && !empty($_GET['username'])) {

	$users_array = $users->get(array('username' => $_GET['username'], 'allow_login' => 1, 'authentication_id' => 1));

	if (count($users_array) == 1) {
		$user = $users_array[0];

		if (isset($user['reset_key']) && $_GET['key'] === $user['reset_key'] && datetime() < $user['reset_expiry']) {
			$reset_form	= true;
			
			if (isset($_POST['reset'])) {
				if (!empty($_POST['password']) && ($_POST['password'] == $_POST['password2'])) {
					
					$users->edit(
						array(
							'id'				=> $user['id'],
							'password'			=> $_POST['password'],
							'reset_expiry'		=> '',
							'reset_key'			=> ''
						)
					);
					
					$reset_form	= false;
					header('Location: ' . $config->get('address') . '/');
					exit;
				}
				else {
					$message = 'Passwords do not match.';
				}
			}
		}
	}
	
}
else {
	header('Location: ' . $config->get('address') . '/');
	exit;
}

include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_header.php');
?>
<form method="post" action="<?php echo safe_output($_SERVER['REQUEST_URI']); ?>">

	<div id="sidebar">
		<div id="users-details" class="widget">
			<div class="left">
				<h2>Reset Password</h2>
			</div>
			
			<?php if ($reset_form) { ?>
			<div class="right">
				<p><button type="submit" name="reset">Reset Password</button></p>
			</div>
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
		
			<?php if ($reset_form) { ?>
					<p>New Password<br /><input type="password" name="password" value="<?php if (isset($_POST['username'])) echo safe_output($_POST['username']); ?>" /></p>
					<p>New Password Again<br /><input type="password" name="password2" value="<?php if (isset($_POST['username'])) echo safe_output($_POST['username']); ?>" /></p>
			<?php } else { ?>
				<?php echo message('Sorry a reset request was not found or it has expired.'); ?>
			<?php } ?>

			<div class="clear"></div>

		</div>
	</div>
</form>
<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>