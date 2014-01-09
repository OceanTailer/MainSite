<?php
namespace sts;
use sts as core;

$site->set_title($language->get('View Message'));

$id = (int) $url->get_item();

$items = $messages->get(array('id' => $id, 'to_from_user_id' => $auth->get('id')));

if (count($items) == 1) { 
	$item = $items[0];
}
else {
	header('Location: ' . $config->get('address') . '/profile/');
	exit;
}

$notes_array = $message_notes->get(array('message_id' => (int)$item['id'], 'get_other_data' => true));

include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_header.php');
?>

<script type="text/javascript">
	$(document).ready(function () {
		$('#delete').click(function () {
			if (confirm("<?php echo safe_output($language->get('Are you sure you wish to delete this message?')); ?>")){
				return true;
			}
			else{
				return false;
			}
		});
	});
</script>

<div id="sidebar">
	<div id="users-details" class="widget">
		<div class="left">
			<h2><?php echo safe_output($language->get('Private Message')); ?></h2>
		</div>
		
		<div class="right">
			<p><a href="<?php echo $config->get('address'); ?>/profile/" class="button grey"><?php echo safe_output($language->get('Cancel')); ?></a></p>
		</div>

		<div class="clear"></div>
		
		<p class="label short"><?php echo safe_output($language->get('From')); ?></p>
		<p class="result">
			<?php echo core\safe_output(ucfirst($item['from_name'])); ?>
		</p>

		<p class="label short"><?php echo safe_output($language->get('To')); ?></p>
		<p class="result">
			<?php echo core\safe_output(ucfirst($item['to_name'])); ?>
		</p>
		
		<div class="clear"></div>
		
		<p class="label short"><?php echo safe_output($language->get('Sent')); ?></p>
		<p class="result">
			<?php echo safe_output(date('D, d M Y g:i A', strtotime($item['date_added']))); ?>
		</p>
		<div class="clear"></div>
		
		<?php if ($item['user_id'] == $auth->get('id')) { ?>
			<br />
			<div class="right">
				<form method="post" action="<?php echo core\safe_output($config->get('address')); ?>/messages/delete/<?php echo (int) $item['id']; ?>/">
					<p><button type="submit" name="delete" id="delete" class="red"><?php echo safe_output($language->get('Delete')); ?></button></p>
				</form>
			</div>
				
			<div class="clear"></div>
		<?php } ?>

		
	</div>
</div>

<div id="box">
	<div id="content">	
		<h2><?php echo safe_output($item['subject']); ?></h2>

		<?php echo nl2br(safe_output($item['message'])); ?>
		<br />
	</div>
	
	<?php if (!empty($notes_array)) { ?>
		<div id="content">	
			<h2><?php echo safe_output($language->get('Notes')); ?></h2>
			<?php $i = 0; foreach($notes_array as $note) { ?>
				<div <?php if ($i % 2 == 0 ) { echo 'class="ticket-note-1"'; } else { echo 'class="ticket-note-2"'; }; ?>>
					<?php if ($config->get('gravatar_enabled')) { ?>
						<?php $gravatar->setEmail($note['email']); ?>
						<p class="right"><img src="<?php echo $gravatar->getUrl(); ?>" alt="Gravatar" /></p>
					<?php } ?>
					

					<p><?php echo nl2br(safe_output($note['message'])); ?></p>
					
					<div class="clear"></div>
					<p class="right"><?php echo safe_output(ucwords($note['name'])); ?> - <?php echo safe_output(time_ago_in_words($note['date_added'])); ?> <?php echo safe_output($language->get('ago')); ?></p>
					<div class="clear"></div>
				</div>
			<?php $i++; } ?>
			
			<div class="clear"></div>

		</div>
	<?php } ?>
	
	<?php $messages->read(array('message_id' => $item['id'], 'user_id' => $auth->get('id'))); ?>

	<div id="content">	
		<h2><a name="addnote"></a><?php echo safe_output($language->get('Add Note')); ?></h2>
		
		<form method="post" action="<?php echo $config->get('address'); ?>/messages/addnote/<?php echo (int) $item['id']; ?>/">
										
			<div id="no_underline">
				<p><textarea name="message" cols="70" rows="12"></textarea></p>
			</div>

			<br />
			<p><input type="hidden" name="id" value="<?php echo (int) $item['id']; ?>" /><button name="add" type="submit"><?php echo safe_output($language->get('Add')); ?></button></p>
		</form>
		
		<div class="clear"></div>
	</div>
</div>
<?php include(core\ROOT . '/user/themes/'. CURRENT_THEME .'/includes/html_footer.php'); ?>