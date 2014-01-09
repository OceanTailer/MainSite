<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title($language->get('New Ticket'));

if (isset($_POST['add'])) {
	if (!empty($_POST['subject'])) {		
		
		$upload_file 	= false;
		$file_id		= false;
		
		if ($config->get('storage_enabled')) {
			if (isset($_FILES['file'])) {
				if ($_FILES['file']['size'] > 0) {
					$file_array['file']			= $_FILES['file'];
					$file_array['name']			= $_FILES['file']['name'];
					
					$file_id = $storage->upload($file_array);
					$upload_file = true;
				}
			}
		}
		
		if ($upload_file && !$file_id) {
			$message = $language->get('File Upload Failed. Ticket Not Submitted.');
		}
		else {
			$add_array = 
				array(
					'subject'			=> $_POST['subject'],
					'description'		=> $_POST['description'],
					'priority_id'		=> (int) $_POST['priority_id'],
					'html'				=> 0
				);
			if ($config->get('html_enabled')) {
				$add_array['html'] = 1;
			}
			$add_array['user_id'] = $auth->get('id');
			
			if (isset($_POST['department_id']) && ($_POST['department_id'] != '')) {
				$add_array['department_id']	= (int) $_POST['department_id'];
			}
			
			if ($auth->get('user_level') == 2 || $auth->get('user_level') == 5 || $auth->get('user_level') == 6) {
				if (isset($_POST['user_id']) && ($_POST['user_id'] != '')) {
					$add_array['user_id']	= (int) $_POST['user_id'];
				}
				if (isset($_POST['assigned_user_id']) && ($_POST['assigned_user_id'] != '')) {
					$add_array['assigned_user_id']	= (int) $_POST['assigned_user_id'];
				}
			}

				
			$id = $tickets->add($add_array);
					
			foreach($_POST as $index => $value){
				if(strncasecmp($index, 'field-', 6) === 0) {
					$group_index = explode('-', $index);
					$group_id = (int) $group_index[1];
					if ($group_id !== 0) {
					
						$edit_array['ticket_field_group_id']	= $group_id;
						$edit_array['ticket_id']				= $id;
						$edit_array['value']					= $value;
					
						$ticket_custom_fields->add_value($edit_array);
						unset($edit_array);
					}
				}			
			}
					
			if ($upload_file && $file_id) {
				$storage->add_file_to_ticket(array('file_id' => $file_id, 'ticket_id' => $id));
			}
			
			header('Location: ' . $config->get('address') . '/tickets/view/' . $id . '/');
			exit;
		}
	}
	else {
		$message = $language->get('Subject Empty');
	}
}

$priorities 	= $ticket_priorities->get(array('enabled' => 1));

if ($auth->get('user_level') == 2 || $auth->get('user_level') == 6) {
	$departments	= $ticket_departments->get(array('enabled' => 1));
} else {
	$departments 	= $ticket_departments->get(array('enabled' => 1, 'get_other_data' => true, 'user_id' => $auth->get('id')));
}


include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_header.php');
?>
	<form method="post" enctype="multipart/form-data" action="<?php echo safe_output($_SERVER['REQUEST_URI']); ?>">
	
		<div id="sidebar">
			<div id="users-details" class="widget">
				<div class="left">
					<h2><?php echo safe_output($language->get('New Ticket')); ?></h2>
				</div>
				<div class="right">
					<p><button type="submit" name="add"><?php echo safe_output($language->get('Add')); ?></button></p>
				</div>
				<div class="clear"></div>
				<?php if ($auth->get('user_level') == 2 || $auth->get('user_level') == 5 || $auth->get('user_level') == 6) { ?>

					<br />
					<div class="right">
						<p><a href="#" id="show_extra_settings" class="button grey"><?php echo safe_output($language->get('Show Extra Settings')); ?></a></p>
					</div>
					<div class="clear"></div>
				<?php } ?>

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
								
				<p><?php echo safe_output($language->get('Subject')); ?><br /><input type="text" name="subject" value="<?php if (isset($_POST['subject'])) echo safe_output($_POST['subject']); ?>" size="50" /></p>		
				
				<?php if (count($departments) > 1) { ?>
					<p><?php echo safe_output($language->get('Department')); ?><br />
					<?php if ($auth->get('user_level') == 2 || $auth->get('user_level') == 6) { ?>
						<select name="department_id" id="update_department_id">
							<?php foreach ($departments as $department) { ?>
							<option value="<?php echo (int) $department['id']; ?>"<?php if (isset($_POST['department_id']) && ($_POST['department_id'] == $department['id'])) { echo ' selected="selected"'; } ?>><?php echo safe_output($department['name']); ?></option>
							<?php } ?>
						</select>
					<?php } else { ?>
						<select name="department_id" id="update_department_id">
							<?php foreach ($departments as $department) { ?>
								<?php if ($department['is_user_member'] || $department['public_view']) { ?>
									<option value="<?php echo (int) $department['id']; ?>"<?php if (isset($_POST['department_id']) && ($_POST['department_id'] == $department['id'])) { echo ' selected="selected"'; } ?>><?php echo safe_output($department['name']); ?></option>
								<?php } ?>
							<?php } ?>
						</select>						
					<?php } ?>
					</p>
				<?php } ?>
								
				<p><?php echo safe_output($language->get('Priority')); ?><br />
				<select name="priority_id">
					<?php foreach ($priorities as $priority) { ?>
					<option value="<?php echo (int) $priority['id']; ?>"<?php if (isset($_POST['priority_id']) && ($_POST['priority_id'] == $priority['id'])) { echo ' selected="selected"'; } ?>><?php echo safe_output($priority['name']); ?></option>
					<?php } ?>
				</select></p>
				
				<?php if ($auth->get('user_level') == 2 || $auth->get('user_level') == 5 || $auth->get('user_level') == 6) { ?>
					<div id="extra_settings">
															
						<p><?php echo safe_output($language->get('On Behalf Of')); ?><br />
						<select name="user_id" id="user_id">
							<option value=""></option>
							<?php if (isset($_POST['user_id'])) { ?>
								<option value="<?php echo (int) $_POST['user_id']; ?>" selected="selected"></option>
							<?php } ?>
						</select></p>
						
						<p><?php echo safe_output($language->get('Assigned To')); ?><br />
						<select name="assigned_user_id" id="assigned_user_id">
							<option value=""></option>
							<?php if (isset($_POST['assigned_user_id'])) { ?>
								<option value="<?php echo (int) $_POST['assigned_user_id']; ?>" selected="selected"></option>
							<?php } ?>
						</select></p>
					
					</div>
				<?php } ?>
				
				<div id="no_underline">
					<p><?php echo safe_output($language->get('Description')); ?><br />
					<textarea class="wysiwyg_enabled" name="description" cols="80" rows="12"><?php if (isset($_POST['description'])) echo safe_output($_POST['description']); ?></textarea>
					</p>
				</div>
				
				<?php $site->display_custom_field_forms(); ?>
				
				<?php if ($config->get('storage_enabled')) { ?>
					<p><?php echo safe_output($language->get('Attach File')); ?><br /><input name="file" type="file" /></p>
				<?php } ?>
					
				<div class="clear"></div>

			</div>
		</div>

	</form>

<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>