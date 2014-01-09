<?php 
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$pm_unread_count = 0;
if ($config->get('database_version') > 9) {
	$pm_unread_count = $messages->unread_count(array('user_id' => $auth->get('id')));
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?php echo safe_output($site->get_title()); ?></title>
	<!--[if lte IE 7]>
	<link rel="stylesheet" type="text/css" href="<?php echo $config->get('address'); ?>/user/themes/<?php echo safe_output(CURRENT_THEME); ?>/css/ie.css" media="screen" />
	<![endif]-->
	
	<!--<meta name="viewport" content="width=device-width, initial-scale=1.0" />-->
			
	<link rel="stylesheet" type="text/css" href="<?php echo $config->get('address'); ?>/user/themes/<?php echo safe_output(CURRENT_THEME); ?>/css/reset-min.css" />
	<link type="text/css" media="screen" href="<?php echo $config->get('address'); ?>/user/themes/<?php echo safe_output(CURRENT_THEME); ?>/css/suckerfish.css" rel="stylesheet" />
	<link type="text/css" media="screen" href="<?php echo $config->get('address'); ?>/user/themes/<?php echo safe_output(CURRENT_THEME); ?>/css/default.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="<?php echo $config->get('address'); ?>/user/themes/<?php echo safe_output(CURRENT_THEME); ?>/css/style.css" />
	<link rel="shortcut icon" href="<?php echo $config->get('address'); ?>/favicon.ico" />
	
	<script type="text/javascript" src="<?php echo $config->get('address'); ?>/system/libraries/js/jquery.js"></script>
	
	<script type="text/javascript">
		var sts_base_url = "<?php echo safe_output($config->get('address')); ?>";
	</script>

	<?php if ($auth->logged_in()) { ?>
		<script type="text/javascript" src="<?php echo $config->get('address'); ?>/system/js/priorities.js"></script>
		<script type="text/javascript" src="<?php echo $config->get('address'); ?>/system/js/departments.js"></script>
		<script type="text/javascript" src="<?php echo $config->get('address'); ?>/system/js/tickets.js"></script>
		<script type="text/javascript" src="<?php echo $config->get('address'); ?>/system/js/add_ticket.js"></script>
		<script type="text/javascript" src="<?php echo $config->get('address'); ?>/system/js/custom_fields.js"></script>
		<script type="text/javascript" src="<?php echo $config->get('address'); ?>/system/js/settings.js"></script>
		<script type="text/javascript" src="<?php echo $config->get('address'); ?>/system/js/user_selector.js"></script>
	<?php } ?>
	
	<?php if ($config->get('html_enabled')) { ?>
		<script type="text/javascript" src="<?php echo $config->get('address'); ?>/system/libraries/redactor/redactor.min.js"></script>
		<link rel="stylesheet" href="<?php echo $config->get('address'); ?>/system/libraries/redactor/css/redactor.css" />

		<script type="text/javascript"> 
		$(document).ready(
			function()
			{
				$('.wysiwyg_enabled').redactor({
					focus: false, 
					buttons: [
						'html', '|', 'formatting', '|', 'bold', 'italic', 'deleted', '|',
						'unorderedlist', 'orderedlist', 'outdent', 'indent', '|',
						'image', 'table', 'link', '|',
						'fontcolor', 'backcolor', '|',
						'alignleft', 'aligncenter', 'alignright', 'justify', '|',
						'horizontalrule'
					]
				});
			}
		);
		</script>
	<?php } ?>
	

	
	<?php $plugins->run('html_header'); ?>
</head>

<body>
	<div class="left-border">
		<div class="right-border">
			<div class="page-wrapper">
				<div id="header">
					
					<div id="header-design">

						<div id="logo-image">
							<a href="#" class='logo-class'></a>
							<h1><?php echo $site->get_title(); ?></h1>
						</div>
						<?php if ($auth->logged_in()) { ?>
						<div id="header-right">
							<p id="welcome-text"><?php echo safe_output($language->get('Welcome')); ?> <?php echo safe_output(ucwords(substr($auth->get('name'), 0, 16))); ?></p>
							<a href="<?php echo $config->get('address'); ?>/logout/" class="button logout"><?php echo safe_output($language->get('Logout')); ?></a>
							<?php if ($pm_unread_count > 0) { ?>
							<div class="small-text white-text">
								<a href="<?php echo $config->get('address'); ?>/profile/">
								<?php echo $pm_unread_count; ?>
								</a>
							</div>
							<?php } ?>
							<div class="clear"></div>
						</div>
						
						<?php } ?>
						<div class="clear"></div>
						
					</div>
					
				</div>
				
				<div id="menu">
					<ul id="nav">
						<?php $plugins->run('html_header_nav_start'); ?>

						<?php if ($auth->logged_in()) { ?>
							<li><a href="<?php echo $config->get('address'); ?>/tickets/"><span><?php echo safe_output($language->get('Tickets')); ?></span></a>
								<ul>
									<li><a href="<?php echo $config->get('address'); ?>/tickets/add/"><span><?php echo safe_output($language->get('Add')); ?></span></a></li>
								</ul>
							</li>

							<li><a href="<?php echo $config->get('address'); ?>/profile/"><span><?php echo safe_output($language->get('Profile')); ?></span></a></li>

							<?php if ($auth->get('user_level') == 2) { ?>
								<li><a href="<?php echo $config->get('address'); ?>/users/"><span><?php echo safe_output($language->get('Users')); ?></span></a></li>
								<li><a href="<?php echo $config->get('address'); ?>/settings/"><span><?php echo safe_output($language->get('Settings')); ?></span></a>
									<ul>
										<li><a href="<?php echo $config->get('address'); ?>/settings/tickets/"><span><?php echo safe_output($language->get('Tickets')); ?></span></a></li>
										<li><a href="<?php echo $config->get('address'); ?>/settings/email/"><span><?php echo safe_output($language->get('Email')); ?></span></a></li>
										<li><a href="<?php echo $config->get('address'); ?>/settings/plugins/"><span><?php echo safe_output($language->get('Plugins')); ?></span></a></li>
										<li><a href="<?php echo $config->get('address'); ?>/settings/ad/"><span><?php echo safe_output($language->get('AD')); ?></span></a></li>
										<li><a href="<?php echo $config->get('address'); ?>/logs/"><span><?php echo safe_output($language->get('Logs')); ?></span></a></li>
										<?php $plugins->run('html_header_nav_settings'); ?>
									</ul>
								</li>
							<?php } ?>
						<?php } else { ?>	
							<li><a href="<?php echo $config->get('address'); ?>/"><span><?php echo safe_output($language->get('Home')); ?></span></a></li>
							<?php if ($config->get('guest_portal')) { ?>
							<li><a href="<?php echo $config->get('address'); ?>/guest/"><span><?php echo safe_output($language->get('Guest Portal')); ?></span></a></li>
							
							<?php } ?>
						<?php } ?> 
						<?php $plugins->run('html_header_nav_finish'); ?>
					</ul>
					<div class="clear"></div>
					
				</div>
				
				<div id="page-body">