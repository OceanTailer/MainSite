<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title($language->get('View User'));

if ($auth->get('user_level') != 2) {
	header('Location: ' . $config->get('address') . '/');
	exit;
}

$user_id = (int) $url->get_item();

if ($user_id == 0) {
	header('Location: ' . $config->get('address') . '/users/');
	exit;
}

$users_array = $users->get(array('id' => $user_id));

if (count($users_array) == 1) {
	$user = $users_array[0];
}
else {
	header('Location: ' . $config->get('address') . '/users/');
	exit;
}

$departments 	= $users_to_departments->get(array('user_id' => $user_id, 'get_other_data' => true));

include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_header.php');
?>
	<div id="sidebar">
		<div id="user-details" class="widget">
			<div class="left">
				<h2><?php echo safe_output($language->get('User')); ?></h2>
			</div>
			<div class="right">
				<p><a href="<?php echo $config->get('address'); ?>/users/edit/<?php echo (int) $user['id']; ?>/" class="button grey"><?php echo safe_output($language->get('Edit')); ?></a></p>
			</div>	
			
			<div class="clear"></div>
		
		</div>
		
		<?php $plugins->run('view_user_sidebar_finish'); ?>

	</div>
	
	<div id="box">
		<div id="content">		

			<table class="data-table">
				<tr>
					<th><?php echo safe_output($language->get('Item')); ?></th>
					<th><?php echo safe_output($language->get('Value')); ?></th>
				</tr>
				<?php $i = 0; ?>
				<tr <?php if ($i % 2 == 0 ) { echo 'class="switch-1"'; } else { echo 'class="switch-2"'; }; ?>>
					<td class="centre"><?php echo safe_output($language->get('Name')); ?></td>
					<td class="centre"><?php echo safe_output($user['name']); ?></td>
				</tr>
				<?php $i++; ?>
				<tr <?php if ($i % 2 == 0 ) { echo 'class="switch-1"'; } else { echo 'class="switch-2"'; }; ?>>
					<td class="centre"><?php echo safe_output($language->get('Username')); ?></td>
					<td class="centre"><?php echo safe_output($user['username']); ?></td>
				</tr>
				<?php $i++; ?>
				<tr <?php if ($i % 2 == 0 ) { echo 'class="switch-1"'; } else { echo 'class="switch-2"'; }; ?>>
					<td class="centre"><?php echo safe_output($language->get('Email')); ?></td>
					<td class="centre"><?php echo safe_output($user['email']); ?></td>
				</tr>
				<?php $i++; ?>
				<tr <?php if ($i % 2 == 0 ) { echo 'class="switch-1"'; } else { echo 'class="switch-2"'; }; ?>>
					<td class="centre"><?php echo safe_output($language->get('Phone')); ?></td>
					<td class="centre"><?php echo safe_output($user['phone_number']); ?></td>
				</tr>
				<?php $i++; ?>
				<tr <?php if ($i % 2 == 0 ) { echo 'class="switch-1"'; } else { echo 'class="switch-2"'; }; ?>>
					<td class="centre"><?php echo safe_output($language->get('Address')); ?></td>
					<td class="centre" id="address"><?php echo nl2br(safe_output($user['address'])); ?></td>
				</tr>
				<?php $i++; ?>
				<tr <?php if ($i % 2 == 0 ) { echo 'class="switch-1"'; } else { echo 'class="switch-2"'; }; ?>>
					<td class="centre"><?php echo safe_output($language->get('Authentication Type')); ?></td>
					<td class="centre"><?php if ($user['authentication_id'] == 2) { echo safe_output($language->get('Active Directory')); } else { echo safe_output($language->get('Local')); } ?></td>
				</tr>
				<?php $i++; ?>
				<tr <?php if ($i % 2 == 0 ) { echo 'class="switch-1"'; } else { echo 'class="switch-2"'; }; ?>>
					<td class="centre"><?php echo safe_output($language->get('Permissions')); ?></td>
					<td class="centre">
					<?php switch($user['user_level']) {
					
						case 1:
							echo safe_output($language->get('Submitter'));
						break;
						case 2:
							echo safe_output($language->get('Administrator'));
						break;
						case 3:
							echo safe_output($language->get('User'));
						break;
						case 4:
							echo safe_output($language->get('Staff'));
						break;
						case 5:
							echo safe_output($language->get('Moderator'));
						break;
						case 6:
							echo safe_output($language->get('Global Moderator'));
						break;					
					}
					?>
				</tr>
				<?php $i++; ?>
				<tr <?php if ($i % 2 == 0 ) { echo 'class="switch-1"'; } else { echo 'class="switch-2"'; }; ?>>
					<td class="centre"><?php echo safe_output($language->get('Email Notifications')); ?></td>
					<td class="centre"><?php if ($user['email_notifications'] == 1) { echo safe_output($language->get('On')); } else { echo safe_output($language->get('Off')); } ?></td>
				</tr>

			</table>

			<div class="clear"></div>
			<?php $plugins->run('view_user_details_finish'); ?>

		</div>
		
		<div id="content">	

			<a name="departments"></a>

			<div class="left">
				<h3><?php echo safe_output($language->get('Departments')); ?></h3>
			</div>
				
			<div class="clear"></div>
		
			<table class="data-table">
				<thead>
					<tr>
						<th><?php echo $language->get('Name'); ?></th>
					</tr>
				</thead>
				
				<tbody>
					<?php $i = 0; 
						foreach($departments as $department) { ?>
						<tr <?php if ($i % 2 == 0 ) { echo 'class="switch-1"'; } else { echo 'class="switch-2"'; }; ?>>
							<td class="centre"><a href="<?php echo safe_output($config->get('address')); ?>/settings/edit_department/<?php echo (int) $department['department_id']; ?>"><?php echo safe_output($department['department_name']); ?></a></td>
						</tr>
					<?php $i++; } ?>
				</tbody>
			</table>
			
			<div class="clear"></div>

		</div>
		
		<?php $plugins->run('view_user_content_finish'); ?>
	</div>

<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>