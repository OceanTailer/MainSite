<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title($language->get('Login'));

if (isset($_POST['submit'])) {
	if ($auth->login(array('username' => $_POST['username'], 'password' => $_POST['password']))) {
		if (isset($_SESSION['page'])) {
			header('Location: ' . safe_output($_SESSION['page']));
		}
		else {
			header('Location: ' . $config->get('address') . '/');
		}
		exit;
	}
	else {
		$message = $language->get('Login Failed');
	}
}

$login_message = $config->get('login_message');

include(ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_header.php');
?>
	<form method="post" action="<?php echo safe_output($_SERVER['REQUEST_URI']); ?>">

		<div id="sidebar">
			<div id="login-details" class="widget">
				<div class="left">
					<h2><?php echo safe_output($config->get('name')); ?> - <?php echo safe_output($language->get('Login')); ?></h2>
				</div>
				<div class="right">
							
				</div>
				<div class="clear"></div>

				<p><?php echo safe_output($language->get('All login attempts are logged.')); ?></p>
				<br />
				<div class="clear"></div>

				<div class="right">
					<p><a href="<?php echo safe_output($config->get('address')) . '/forgot/'; ?>" class="button grey"><?php echo safe_output($language->get('Forgot Password')); ?></a>
					<?php if ($config->get('registration_enabled')) { ?>
						<a href="<?php echo safe_output($config->get('address')) . '/register/'; ?>" class="button grey"><?php echo safe_output($language->get('Create Account')); ?></a>
					<?php } ?>
					</p>
				</div>
				<div class="clear"></div>

			</div>
		</div>
		
		<div id="box">
			<?php if (!empty($login_message)) { ?>
			<div id="content">
				<?php echo message($login_message); ?>
				<div class="clear"></div>
			</div>
			<?php } ?>
			
			<?php if (isset($message)) { ?>
			<div id="content">
				<?php echo message($message); ?>
				<div class="clear"></div>
			</div>
			<?php } ?>
		
			<div id="content" class='clearfix' >
				<div class='login-cont clearfix fl'>
				<h2>Login to Ticketing System:</h2>
					<p><?php echo safe_output($language->get('Username')); ?><br /><input type="text" name="username" /></p>
					<p><?php echo safe_output($language->get('Password')); ?> <br /><input type="password" name="password" /></p>
					<p class='fr'><button type="submit" name="submit"><?php echo safe_output($language->get('Login')); ?></button></p>	
				</div>
			</div>
		</div>
	</form>

<?php include(ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>