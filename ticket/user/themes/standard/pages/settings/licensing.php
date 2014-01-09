<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title($language->get('Licensing'));

if ($auth->get('user_level') != 2) {
	header('Location: ' . $config->get('address') . '/');
	exit;
}


if (isset($_POST['save'])) {

	$config->set('license_key', $_POST['license_key']);
	
	$message = $language->get('Settings Saved');
}


include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_header.php');
?>
	<form method="post" action="<?php echo safe_output($_SERVER['REQUEST_URI']); ?>">

		<div id="sidebar">
			<div id="login-details" class="widget">
				<div class="left">
					<h2><?php echo safe_output($language->get('Licensing')); ?></h2>
				</div>
				
				<div class="right">
					<p><button type="submit" name="save"><?php echo safe_output($language->get('Save')); ?></button></p>
				</div>
				<div class="clear"></div>	
				<br />
				<p><?php echo safe_output($language->get('Your License Key can be found in your CodeCanyon account. Select Downloads and then select "License Certificate", inside this file is a key called "Item Purchase Code", this is your License Key.')); ?></p>
				<div class="clear"></div>	

			</div>
		</div>

		<div id="box">

			<?php if (isset($message)) { ?>
				<div id="content">
					<?php echo message($message); ?>
				</div>
			<?php } ?>
		
			<div id="content">		
				<p><?php echo safe_output($language->get('License Key')); ?><br /><input type="text" name="license_key" size="30" value="<?php echo safe_output($config->get('license_key')); ?>" /></p>

				<div class="clear"></div>


			</div>
		</div>
	</form>

<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>