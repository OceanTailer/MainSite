<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title($language->get('Edit Department'));

if ($auth->get('user_level') != 2) {
	header('Location: ' . $config->get('address') . '/');
	exit;
}

$id = (int) $url->get_item();

$departments		= $ticket_departments->get(array('id' => $id));
	
if (empty($departments)) {
	header('Location: ' . $config->get('address') . '/settings/tickets/#departments');
	exit;
}

$item = $departments[0];

if (isset($_POST['delete'])) {
	if ($item['id'] != 1) {
		$ticket_departments->delete(array('id' => $item['id']));
		header('Location: ' . $config->get('address') . '/settings/tickets/#departments');
		exit;
	}
}

if (isset($_POST['save'])) {
	if (!empty($_POST['name'])) {
		$add_array['name']				= $_POST['name'];
		$add_array['id']				= $id;
		$add_array['public_view'] 		= $_POST['public_view'] ? 1 : 0;
	
		$ticket_departments->edit($add_array);
		
		
		header('Location: ' . $config->get('address') . '/settings/tickets/#departments');
		exit;
		//$message = $language->get('Saved');
		
	}
	else {
		$message = $language->get('Name empty');
	}
	$departments	= $ticket_departments->get(array('id' => $id));
	$item 			= $departments[0];
}

$users_array = $users->get(array('department_id' => $id));

include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_header.php');
?>

<script type="text/javascript">
	$(document).ready(function () {
		$('#delete').click(function () {
			if (confirm("<?php echo safe_output($language->get('Are you sure you wish to delete this Department?')); ?>")){
				return true;
			}
			else{
				return false;
			}
		});
	});
</script>

<form method="post" action="<?php echo safe_output($_SERVER['REQUEST_URI']); ?>">

	<div id="sidebar">
		<div id="login-details" class="widget">
			<div class="left">
				<h2><?php echo safe_output($language->get('Department')); ?></h2>
			</div>
		
			
			<div class="right">
				<p>
					<button type="submit" name="save"><?php echo safe_output($language->get('Save')); ?></button>
					<a href="<?php echo $config->get('address'); ?>/settings/tickets/#departments" class="button grey"><?php echo safe_output($language->get('Cancel')); ?></a>
				</p>
			</div>
				
			<div class="clear"></div>	
			
			<?php if ($item['id'] != 1) { ?>
				<br />
				<div class="right"><button type="submit" id="delete" name="delete" class="red"><?php echo safe_output($language->get('Delete')); ?></button></div>
				<div class="clear"></div>
			<?php } else { ?>
				<br />
				<div class="right">
				<?php echo safe_output($language->get('Default Department cannot be deleted.')); ?>
				</div>
				<div class="clear"></div>
				
			<?php } ?>

		</div>
	</div>

	<div id="box">

		<?php if (isset($message)) { ?>
			<div id="content">
				<?php echo message($message); ?>
			</div>
		<?php } ?>

		<div id="content">	

			<div class="clear"></div>
			
			<p><?php echo $language->get('Name'); ?><br /><input type="text" name="name" value="<?php echo safe_output($item['name']); ?>" size="30" /></p>

			<p><?php echo safe_output($language->get('Public')); ?><br />
			<select name="public_view">
				<option value="0"><?php echo safe_output($language->get('No')); ?></option>
				<option value="1"<?php if ($item['public_view'] == 1) { echo ' selected="selected"'; } ?>><?php echo safe_output($language->get('Yes')); ?></option>
			</select></p>	


		</div>
		
		<?php if (!empty($users_array)) { ?>
			<div id="content">	
				<h3><?php echo $language->get('Members'); ?></h3>
						
				<table class="data-table">
					<thead>
						<tr>
							<th><?php echo $language->get('Name'); ?></th>
							<th><?php echo $language->get('Permissions'); ?></th>
						</tr>
					</thead>
					
					<tbody>

						<?php $i = 0; 
							foreach($users_array as $user) { ?>
							<tr <?php if ($i % 2 == 0 ) { echo 'class="switch-1"'; } else { echo 'class="switch-2"'; }; ?>>
								<td class="centre"><a href="<?php echo $config->get('address'); ?>/users/view/<?php echo (int) $user['id']; ?>/"><?php echo safe_output($user['name']); ?></a></td>
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
								</td>
							</tr>
						<?php $i++; } ?>
					</tbody>
				</table>
				
			</div>
		<?php } ?>
			
		<div class="clear"></div>

	</div>

</form>
<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>