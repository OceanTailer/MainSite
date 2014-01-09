<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title($language->get('Ticket Settings'));

if ($auth->get('user_level') != 2) {
	header('Location: ' . $config->get('address') . '/');
	exit;
}


if (isset($_POST['save'])) {

	$config->set('anonymous_tickets_reply', $_POST['anonymous_tickets_reply'] ? 1 : 0);
	$config->set('guest_portal', $_POST['guest_portal'] ? 1 : 0);
	$config->set('guest_portal_index_html', $_POST['guest_portal_index_html']);
	
	//add new priorities
	$i = 0;
	foreach ($_POST['pitem_name'] as $name) {
		if (!empty($name)) {
			$item_array['name']			= $name;
			$item_array['enabled']		= 1;
			$ticket_priorities->add($item_array);
		}
		$i++;
	}
		
	//update existing priorities
	foreach($_POST as $index => $value){
		if(strncasecmp($index, 'pexisting-', 10) === 0) {
			$priorities_index = explode('-', $index);
			$item_array['name']			= $value;
			$item_array['id']			= (int) $priorities_index[1];
			$ticket_priorities->edit($item_array);
		}
	
	}
	
	$log_array['event_severity'] = 'notice';
	$log_array['event_number'] = E_USER_NOTICE;
	$log_array['event_description'] = 'Settings Edited';
	$log_array['event_file'] = __FILE__;
	$log_array['event_file_line'] = __LINE__;
	$log_array['event_type'] = 'edit';
	$log_array['event_source'] = 'settings';
	$log_array['event_version'] = '1';
	$log_array['log_backtrace'] = false;	
			
	$log->add($log_array);
	
	$message = $language->get('Ticket Settings Saved');
}

$priorities 			= $ticket_priorities->get(array('enabled' => 1));
$departments 			= $ticket_departments->get(array('enabled' => 1, 'get_other_data' => true));
$status 				= $ticket_status->get(array('enabled' => 1));

$custom_field_groups	= $ticket_custom_fields->get_groups();

include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_header.php');
?>
	<form method="post" action="<?php echo safe_output($_SERVER['REQUEST_URI']); ?>">

		<div id="sidebar">
			<div id="login-details" class="widget">
				<div class="left">
					<h2><?php echo safe_output($language->get('Ticket Settings')); ?></h2>
				</div>
				
				<div class="right">
					<p><button type="submit" name="save"><?php echo safe_output($language->get('Save')); ?></button></p>
				</div>
				
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
				<h3><?php echo safe_output($language->get('General Settings')); ?></h3>
				
				<p><?php echo safe_output($language->get('Reply/Notifications for Anonymous Tickets (sends emails to non-users)')); ?><br />
				<select name="anonymous_tickets_reply">
					<option value="0"><?php echo safe_output($language->get('No')); ?></option>
					<option value="1"<?php if ($config->get('anonymous_tickets_reply') == 1) { echo ' selected="selected"'; } ?>><?php echo safe_output($language->get('Yes')); ?></option>
				</select></p>	
				
				<p><?php echo safe_output($language->get('Guest Portal')); ?><br />
				<select name="guest_portal">
					<option value="0"><?php echo safe_output($language->get('No')); ?></option>
					<option value="1"<?php if ($config->get('guest_portal') == 1) { echo ' selected="selected"'; } ?>><?php echo safe_output($language->get('Yes')); ?></option>
				</select></p>	
				
				<div id="no_underline">
					<p><?php echo safe_output($language->get('Guest Portal Text')); ?><br />
						<textarea class="wysiwyg_enabled" name="guest_portal_index_html" cols="80" rows="12">
							<?php echo safe_output($config->get('guest_portal_index_html')); ?>
						</textarea>
					</p>
				</div>
				
				<div class="clear"></div>
				
			</div>
			
			<div id="content">		
				
				<a name="status"></a>

				<div class="left">
					<h3><?php echo safe_output($language->get('Status')); ?></h3>
				</div>
				
				<div class="right">
					<p><a href="<?php echo safe_output($config->get('address')); ?>/settings/add_status/" class="button grey"><?php echo $language->get('Add'); ?></a></p>
				</div>
					
				<div class="clear"></div>
			
				<table class="data-table">
					<thead>
						<tr>
							<th><?php echo $language->get('Name'); ?></th>
							<th><?php echo $language->get('Type'); ?></th>
							<th><?php echo $language->get('Colour'); ?></th>
						</tr>
					</thead>
					
					<tbody>

						<?php $i = 0; 
							foreach($status as $status_item) { ?>
							<tr <?php if ($i % 2 == 0 ) { echo 'class="switch-1"'; } else { echo 'class="switch-2"'; }; ?>>
								<td class="centre"><a href="<?php echo safe_output($config->get('address')); ?>/settings/edit_status/<?php echo (int) $status_item['id']; ?>/"><?php echo safe_output($status_item['name']); ?></a></td>
								<td class="centre"><?php if ($status_item['active'] == 1) { echo $language->get('Open'); } else { echo $language->get('Closed'); } ?></td>
								<td class="centre" style="background-color: #<?php echo safe_output($status_item['colour']); ?>"></td>

								</tr>
						<?php $i++; } ?>
					</tbody>
				</table>


			</div>
			
			<div id="content">		
				
				<h3><?php echo safe_output($language->get('Priorities')); ?></h3>
							
				<p><?php echo safe_output($language->get('Please note that removing priorities that are in use will leave tickets without a priority.')); ?></p>
	
				
				<div id="no_underline">				
				<?php foreach ($priorities as $priority) { ?>
					<div class="current_priority_field" id="pexisting-<?php echo (int) $priority['id']; ?>">
						<p><input type="text" size="25" name="pexisting-<?php echo (int) $priority['id']; ?>" value="<?php echo safe_output($priority['name']); ?>" /> <a href="#custom" id="delete_existing_priority_item"><img src="<?php echo $config->get('address'); ?>/user/themes/<?php echo safe_output(CURRENT_THEME); ?>/images/icons/delete.png" alt="Delete Priority" /></a></p>
					</div>
				<?php } ?>		
				</div>
				
				<div class="priority_field">
					<p><input type="text" size="25" name="pitem_name[]" value="" /></p>
				</div>
			
				<div class="extra_priority_field"></div>

				
				<div class="clear"></div>


			</div>
			
			<div id="content">	

				<a name="departments"></a>

				<div class="left">
					<h3><?php echo safe_output($language->get('Departments')); ?></h3>
				</div>
				
				<div class="right">
					<p><a href="<?php echo safe_output($config->get('address')); ?>/settings/add_department/" class="button grey"><?php echo $language->get('Add'); ?></a></p>
				</div>
					
				<div class="clear"></div>
			
				<table class="data-table">
					<thead>
						<tr>
							<th><?php echo $language->get('Name'); ?></th>
							<th><?php echo $language->get('Public'); ?></th>
							<th><?php echo $language->get('Members'); ?></th>
						</tr>
					</thead>
					
					<tbody>

						<?php $i = 0; 
							foreach($departments as $department) { ?>
							<tr <?php if ($i % 2 == 0 ) { echo 'class="switch-1"'; } else { echo 'class="switch-2"'; }; ?>>
								<td class="centre"><a href="<?php echo safe_output($config->get('address')); ?>/settings/edit_department/<?php echo (int) $department['id']; ?>/"><?php echo safe_output($department['name']); ?></a></td>
								<td class="centre"><?php if ($department['public_view']) { echo $language->get('Yes'); } else { echo  $language->get('No'); } ?></td>
								<td class="centre"><?php echo safe_output($department['members_count']); ?></td>
							</tr>
						<?php $i++; } ?>
					</tbody>
				</table>
				
				<div class="clear"></div>

			</div>
			
			<div id="content">
				<a name="custom_fields"></a>

				<div class="left">
					<h3><?php echo safe_output($language->get('Custom Fields')); ?></h3>
				</div>
				
				<div class="right">
					<p><a href="<?php echo safe_output($config->get('address')); ?>/settings/add_custom_field/" class="button grey"><?php echo $language->get('Add'); ?></a></p>
				</div>
					
				<div class="clear"></div>
			
				<table class="data-table">
					<thead>
						<tr>
							<th><?php echo $language->get('Name'); ?></th>
							<th><?php echo $language->get('Type'); ?></th>
							<th><?php echo $language->get('Enabled'); ?></th>
						</tr>
					</thead>
					
					<tbody>

						<?php $i = 0; 
							foreach($custom_field_groups as $custom_field_group) { ?>
							<tr <?php if ($i % 2 == 0 ) { echo 'class="switch-1"'; } else { echo 'class="switch-2"'; }; ?>>
								<td class="centre"><a href="<?php echo safe_output($config->get('address')); ?>/settings/edit_custom_field/<?php echo (int) $custom_field_group['id']; ?>/"><?php echo safe_output($custom_field_group['name']); ?></a></td>
								<td class="centre">
								<?php
									switch($custom_field_group['type']) {
										case 'textinput':
											echo $language->get('Text Input');
										break;
										
										case 'textarea':
											echo $language->get('Text Area');
										break;
										
										case 'dropdown':
											echo $language->get('Drop Down');
										break;
									}
								?>						
								</td>
								<td class="centre"><?php if ($custom_field_group['enabled'] == '0') { echo $language->get('No'); } else { echo $language->get('Yes'); } ?></td>
							</tr>
						<?php $i++; } ?>
					</tbody>
				</table>

			</div>			

		</div>
	
	</form>

<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>