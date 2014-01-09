<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title($language->get('New Guest Ticket'));

if (isset($_POST['add'])) {
	if (!empty($_POST['name'])) {
		if (!empty($_POST['subject'])) {		
			
			if (check_email_address($_POST['email'])) {
			
				if ($config->get('captcha_enabled') && (empty($_POST['captcha_input']) || strtoupper($_POST['captcha_input']) !== strtoupper($_SESSION['captcha_text']))) {
					$message = $language->get('Anti-Spam Text Incorrect');
				}
				else {
			
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
						$access_key = rand_str(32);
						
						$add_array = 
							array(
								'subject'			=> $_POST['subject'],
								'description'		=> $_POST['description'],
								'priority_id'		=> (int) $_POST['priority_id'],
								'name'				=> $_POST['name'],
								'email'				=> $_POST['email'],
								'access_key'		=> $access_key,
								'html'				=> 0
							);
						
						if ($config->get('html_enabled')) {
							$add_array['html'] = 1;
						}
						
						$clients 					= $users->get(array('email' => $_POST['email'], 'limit' => 1));
						if (count($clients) == 1) {
							$add_array['user_id']	= $clients[0]['id'];
						}
						
						
						if (isset($_POST['department_id']) && ($_POST['department_id'] != '')) {
							if ($ticket_departments->count(array('id' => $_POST['department_id'], 'public_view' => 1)) > 0) {
								$add_array['department_id']	= (int) $_POST['department_id'];
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
						
						header('Location: ' . $config->get('address') . '/guest/ticket_view/' . $id . '/?access_key=' . $access_key);
						exit;
					}
				}
			}
			else {
				$message = $language->get('Email Address Invalid');
			}
		}
		else {
			$message = $language->get('Subject Empty');
		}
	}
	else {
		$message = $language->get('Name Empty');
	}
}

$_SESSION['captcha_text'] = $captcha->get_random_text();

$priorities 	= $ticket_priorities->get(array('enabled' => 1));
$departments	= $ticket_departments->get(array('enabled' => 1, 'public_view' => 1));


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
				
				<p><?php echo safe_output($language->get('Name')); ?><br /><input type="text" name="name" value="<?php if (isset($_POST['name'])) echo safe_output($_POST['name']); ?>" size="50" /></p>		
				<p><?php echo safe_output($language->get('Email')); ?><br /><input type="text" name="email" value="<?php if (isset($_POST['email'])) echo safe_output($_POST['email']); ?>" size="50" /></p>		

				<p><?php echo safe_output($language->get('Subject')); ?><br /><input type="text" name="subject" value="<?php if (isset($_POST['subject'])) echo safe_output($_POST['subject']); ?>" size="50" /></p>		

				<?php if (count($departments) > 1) { ?>
					<p><?php echo safe_output($language->get('Department')); ?><br />
					<select name="department_id">
						<?php foreach ($departments as $department) { ?>
						<option value="<?php echo (int) $department['id']; ?>"<?php if (isset($_POST['department_id']) && ($_POST['department_id'] == $department['id'])) { echo ' selected="selected"'; } ?>><?php echo safe_output($department['name']); ?></option>
						<?php } ?>
					</select></p>
				<?php } ?>
				
				<p><?php echo safe_output($language->get('Priority')); ?><br />
				<select name="priority_id">
					<?php foreach ($priorities as $priority) { ?>
					<option value="<?php echo (int) $priority['id']; ?>"<?php if (isset($_POST['priority_id']) && ($_POST['priority_id'] == $priority['id'])) { echo ' selected="selected"'; } ?>><?php echo safe_output($priority['name']); ?></option>
					<?php } ?>
				</select></p>
				
				<div id="no_underline">
					<p><?php echo safe_output($language->get('Description')); ?><br />
					<textarea class="wysiwyg_enabled" name="description" cols="80" rows="12"><?php if (isset($_POST['description'])) echo safe_output($_POST['description']); ?></textarea>
					</p>
				</div>
				
				<?php $site->display_custom_field_forms(); ?>				
				
				<?php if ($config->get('storage_enabled')) { ?>
					<p><?php echo safe_output($language->get('Attach File')); ?><br /><input name="file" type="file" /></p>
				<?php } ?>
				
				<?php if ($config->get('captcha_enabled')) { ?>
					<br />
					<p><?php echo safe_output($language->get('Anti-Spam Image')); ?><br /><img src="<?php echo safe_output($config->get('address')); ?>/captcha/" alt="captcha_image" /></p>
					<p><?php echo safe_output($language->get('Anti-Spam Text')); ?><br /><input type="text" name="captcha_input" value="" autocomplete="off" /></p>
				<?php } ?>
				
				<div class="clear"></div>

			</div>
		</div>

	</form>

<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>