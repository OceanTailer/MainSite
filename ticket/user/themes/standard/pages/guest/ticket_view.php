<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$site->set_title($language->get('View Guest Ticket'));

$id 			= (int) $url->get_item();

$access_key 	= '';
if (isset($_GET['access_key'])) {
	$access_key	= $_GET['access_key'];
}

if ($id == 0 && !empty($access_key)) {
	header('Location: ' . $config->get('address') . '/guest/');
	exit;
}

$t_array['id']				= $id;
$t_array['get_other_data'] 	= true;
$t_array['limit']			= 1;
$t_array['access_key']		= $access_key;

$tickets_array = $tickets->get($t_array);

if (count($tickets_array) == 1) {
	$ticket = $tickets_array[0];
}
else {
	header('Location: ' . $config->get('address') . '/guest/');
	exit;
}

$notes_array = $ticket_notes->get(array('ticket_id' => (int)$ticket['id'], 'get_other_data' => true));

$custom_field_groups		= $ticket_custom_fields->get_groups(array('enabled' => 1));

include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_header.php');
?>
	<div id="sidebar">
		<div id="ticket-details" class="widget">
			<h2 class="left"><?php echo safe_output($language->get('Ticket')); ?></h2>
			<div class="right">
			</div>
			
			<div class="clear"></div>
			
			<p class="label short"><?php echo safe_output($language->get('User')); ?></p>
			<p class="result">
				<?php echo safe_output(ucwords($ticket['owner_name'])); ?>
			</p>
			<div class="clear"></div>
			
			<p class="label short"><?php echo safe_output($language->get('Status')); ?></p><p class="result"><?php if ($ticket['state_id'] == 1) { echo $language->get('Open'); } else { echo $language->get('Closed'); } ?></p>
			<div class="clear"></div>
			
			<p class="label short"><?php echo safe_output($language->get('Priority')); ?></p><p class="result"><?php echo safe_output($ticket['priority_name']); ?></p>
			<div class="clear"></div>
			
			<p class="label short"><?php echo safe_output($language->get('Submitted By')); ?></p>
			<p class="result">
				<?php echo safe_output(ucwords($ticket['submitted_name'])); ?>
			</p>
			<div class="clear"></div>
			
			<p class="label short"><?php echo safe_output($language->get('Assigned User')); ?></p>
			<p class="result">
				<?php echo safe_output(ucwords($ticket['assigned_name'])); ?>
			</p>			
			<div class="clear"></div>

			<p class="label short"><?php echo safe_output($language->get('Department')); ?></p><p class="result"><?php echo safe_output(ucwords($ticket['department_name'])); ?></p>
			<div class="clear"></div>			
			
			<p class="label short"><?php echo safe_output($language->get('Added')); ?></p><p class="result"><?php echo safe_output(time_ago_in_words($ticket['date_added'])); ?> <?php echo safe_output($language->get('ago')); ?></p>
			<div class="clear"></div>
			
			<p class="label short"><?php echo safe_output($language->get('Updated')); ?></p><p class="result"><?php echo safe_output(time_ago_in_words($ticket['last_modified'])); ?> <?php echo safe_output($language->get('ago')); ?></p>
			<div class="clear"></div>
			
			<p class="label short"><?php echo safe_output($language->get('ID')); ?></p><p class="result"><?php echo safe_output($ticket['id']); ?></p>
			<div class="clear"></div>
			
			<?php $plugins->run('view_ticket_details_finish'); ?>

		</div>
	
		
		<div id="user-details" class="widget">
	
			<div class="left">
				<h2><?php echo safe_output($language->get('User Details')); ?></h2>
			</div>
			
			<div class="clear"></div>

			<?php if ($ticket['user_id'] == 0) { ?>		
				<p class="label short"><?php echo safe_output($language->get('Name')); ?></p><p class="result"><?php echo safe_output(ucwords($ticket['name'])); ?></p>
				<div class="clear"></div>
				
				<p class="label short"><?php echo safe_output($language->get('Email')); ?></p><p class="result"><a href="mailto:<?php echo safe_output($ticket['email']); ?>"><?php echo safe_output($ticket['email']); ?></a></p>
				<div class="clear"></div>
			<?php } else { ?>	
				<p class="label short"><?php echo safe_output($language->get('Name')); ?></p><p class="result"><?php echo safe_output(ucwords($ticket['owner_name'])); ?></p>
				<div class="clear"></div>
				
				<p class="label short"><?php echo safe_output($language->get('Email')); ?></p><p class="result"><a href="mailto:<?php echo safe_output($ticket['owner_email']); ?>"><?php echo safe_output($ticket['owner_email']); ?></a></p>
				<div class="clear"></div>
			
				<?php if (!empty($ticket['owner_phone'])) { ?>
					<p class="label short"><?php echo safe_output($language->get('Phone')); ?></p><p class="result"><?php echo safe_output($ticket['owner_phone']); ?></p>
					<div class="clear"></div>
				<?php } ?>
			<?php } ?>
			
			<?php $plugins->run('view_ticket_user_details_finish'); ?>

		</div>	

		<?php $plugins->run('view_ticket_sidebar_finish'); ?>
		
		
	</div>
	
	<div id="box">
	
		<div id="content">		
		
			<h2><?php echo safe_output($ticket['subject']); ?>
				<?php if ($config->get('gravatar_enabled')) { ?>
					<?php $gravatar->setEmail($ticket['owner_email']); ?>
					<img class="right" src="<?php echo $gravatar->getUrl(); ?>" alt="Gravatar" />
				<?php } ?>
			</h2>
			<br />
			<div id="ticket-body">
				<?php if ($ticket['html'] == 1) { ?>
					<?php echo html_output($ticket['description']); ?>
				<?php } else { ?>
					<p><?php echo nl2br(safe_output($ticket['description'])); ?></p>
				<?php } ?>
			</div>
			
			<div class="clear"></div>
			<?php if (!empty($custom_field_groups)) { ?>
				<div id="custom-fields-area">
					<?php ?>
					<?php foreach($custom_field_groups as $custom_field_group) { ?>
						<?php $fields = $ticket_custom_fields->get_values(array('ticket_field_group_id' => $custom_field_group['id'], 'ticket_id' => (int) $ticket['id'])); 
						?>
						<?php if (!empty($fields) && !empty($fields[0]['value'])) { ?>
							<br />
							<h3><?php echo safe_output($custom_field_group['name']); ?></h3>
							<?php if ($custom_field_group['type'] == 'textinput') { ?>
								<p><?php echo safe_output($fields[0]['value']); ?></p>
							<?php } else if ($custom_field_group['type'] == 'textarea') { ?>
								<?php if ($ticket['html'] == 1) { ?>
									<?php echo html_output($fields[0]['value']); ?>
								<?php } else { ?>								
									<p><?php echo nl2br(safe_output($fields[0]['value'])); ?></p>
								<?php } ?>
							<?php } else if ($custom_field_group['type'] == 'dropdown') { 
									$set_fields = $ticket_custom_fields->get_fields(array('ticket_field_group_id' => $custom_field_group['id']));
								?>
								<?php foreach ($set_fields as $field) { ?>
									<?php if (isset($fields[0]['value']) && ($field['id'] == $fields[0]['value'])) { ?>
									<p><?php echo safe_output($field['value']); ?></p>
									<?php }?>
								<?php } ?>
							<?php } ?>
						<?php }?>
					<?php } ?>		
				</div>
				
				<div class="clear"></div>
			<?php } ?>
		</div>
		
		<?php if (!empty($notes_array)) { ?>
			<div id="content">	
				<h2><?php echo safe_output($language->get('Replies')); ?></h2>
				<?php $i = 0; foreach($notes_array as $note) { ?>
					<div <?php if ($i % 2 == 0 ) { echo 'class="ticket-note-1"'; } else { echo 'class="ticket-note-2"'; }; ?>>
						<?php if ($config->get('gravatar_enabled')) { ?>
							<?php $gravatar->setEmail($note['owner_email']); ?>
							<p class="right"><img src="<?php echo $gravatar->getUrl(); ?>" alt="Gravatar" /></p>
						<?php } ?>
						
						<?php if ($note['html'] == 1) { ?>
							<?php echo html_output($note['description']); ?>
						<?php } else { ?>
							<p><?php echo nl2br(safe_output($note['description'])); ?></p>
						<?php } ?>
						
						<div class="clear"></div>
						<p class="right"><?php echo safe_output(ucwords($note['owner_name'])); ?> - <?php echo safe_output(time_ago_in_words($note['date_added'])); ?> <?php echo safe_output($language->get('ago')); ?></p>
						<div class="clear"></div>
					</div>
				<?php $i++; } ?>
				
				<div class="clear"></div>

			</div>
		<?php } ?>
			
		<div id="content">	
			<h2><a name="addnote"></a><?php echo safe_output($language->get('Reply')); ?></h2>
			
			<form method="post" enctype="multipart/form-data" action="<?php echo $config->get('address'); ?>/guest/ticket_addnote/<?php echo (int) $ticket['id']; ?>/?access_key=<?php echo safe_output($ticket['access_key']); ?>">
				
				<div id="no_underline">
					<p><textarea class="wysiwyg_enabled" name="description" cols="70" rows="12"></textarea></p>
				</div>
								
				<?php if ($config->get('storage_enabled')) { ?>
					<p><?php echo safe_output($language->get('Attach File')); ?><br /><input name="file" type="file" /></p>
				<?php } ?>
				
				<?php if ($ticket['state_id'] != 2) { ?>
					<p><?php echo safe_output($language->get('Close Ticket')); ?> <input type="checkbox" name="close_ticket" value="1" /></p>
				<?php } ?>
				<br />
				<p><input type="hidden" name="id" value="<?php echo (int) $ticket['id']; ?>" /><button name="add" type="submit"><?php echo safe_output($language->get('Add')); ?></button></p>
			</form>
			
			<div class="clear"></div>
		</div>

	</div>

<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>