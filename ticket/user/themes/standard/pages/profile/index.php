<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title($language->get('Profile'));

$items = $messages->get(array('to_from_user_id' => $auth->get('id')));

include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_header.php');
?>
<div id="sidebar">
	<div id="users-details" class="widget">
		<div class="left">
			<h2><?php echo safe_output($language->get('Profile')); ?></h2>
		</div>
		<div class="right">
			<p><a href="<?php echo safe_output($config->get('address')); ?>/profile/edit/" class="button grey"><?php echo safe_output($language->get('Edit')); ?></a></p>
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
		<div class="left">
			<h3><?php echo safe_output($language->get('Private Messages')); ?></h3>
		</div>
		
		<div class="right">
			<?php if ($auth->get('user_level') == 2 || $auth->get('user_level') == 5 || $auth->get('user_level') == 3 || $auth->get('user_level') == 4 || $auth->get('user_level') == 6) { ?>
				<p><a href="<?php echo safe_output($config->get('address')); ?>/messages/add/" class="button grey"><?php echo safe_output($language->get('Add')); ?></a></p>
			<?php } ?>
		</div>
		
		<div class="clear"></div>

		
		<?php if (!empty($items)) { ?>
			<table class="data-table">
				<thead>
					<tr>
						<th><?php echo safe_output($language->get('Subject')); ?></th>
						<th><?php echo safe_output($language->get('To')); ?></th>
						<th><?php echo safe_output($language->get('From')); ?></th>
						<th><?php echo safe_output($language->get('Date')); ?></th>
						<th><?php echo safe_output($language->get('Unread')); ?></th>
					</tr>
				</thead>
				
				<tbody>
					
					<?php 
					$i = 0;
					foreach ($items as $item) {
					?>
					<tr <?php if ($i % 2 == 0 ) { echo 'class="switch-1"'; } else { echo 'class="switch-2"'; }; ?>>
						<td class="centre"><a href="<?php echo $config->get('address'); ?>/messages/view/<?php echo safe_output($item['id']); ?>/"><?php echo safe_output(ucfirst($item['subject'])); ?></a></td>
						<td class="centre"><?php echo safe_output(ucfirst($item['to_name'])); ?></td>
						<td class="centre"><?php echo safe_output(ucfirst($item['from_name'])); ?></td>
						<td class="centre"><?php echo safe_output(date('D, d M Y g:i A', strtotime($item['date_added']))); ?></td>
						<td class="centre"><?php echo (int) $item['unread_count']; ?></td>
					</tr>
					<?php $i++; } ?>
					
				</tbody>
			</table>
		<?php } else {
			echo message($language->get('No Messages'));
		} ?>

		<div class="clear"></div>

	</div>
	
	<?php $plugins->run('profile_content_finish'); ?>
</div>
<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>