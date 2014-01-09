<?php if($type == 'bsd'){ ?>
	<div class='message-main-cont'>
		<?php foreach($messages as $message){?>
		<div class='message-det'>
			<h3 class='fl'>Subject: <?php echo $message->bsm_subject ?></h3>
				<?php if($message->bsm_buyer_read == 0){?>
				<p class='notify-new fr'>
					New!
				</p>

					<?php $this->users->update_unread_message($message->bsm_id,3);  ?>
				<?php }?>
			<div class='clear'></div>
			<p>									
				<?php if($message->u_id == $this->session->userdata('id')){ ?>
				From : Me
				<?php }else{ ?>

					<?php echo 'From: '.$message->u_fname. ' '.$message->u_lname ?> 

				<?php } ?>
			</p>
			<div class='message-inner-cont clearfix'>
				<p><?php echo $message->bsm_message ?></p>
				<div class='clear'></div>
				<div class='fr'>
					<p class='small-p-label'><?php echo  date('M d, Y H:i:s',$message->bsm_time) ?></p>
				</div>
			</div>

			<?php $replies =  $this->users->get_message_reply($message->bsm_id);?>

			<div class='clearfix reply-container-added'>
				<p class='fl label'>Reply:</p>
				<textarea  rows="2" class='add-reply fl' id='reply<?php echo $message->bsm_id?>' onkeyup='return check_reply(<?php echo $message->bsm_id?>)'></textarea>
				<button class='normal-button fr' onclick='return add_reply(<?php echo $message->bsm_id?>)'>Reply</button>
			</div>


			<div id='append-reply<?php echo $message->bsm_id?>'  class='clearfix reply-main-container'>
				<?php if(count($replies) == 0){?>
					<center><p>--No Reply Messages--</p></center>
				<?php } else{ foreach($replies as $reply){?>
							<div class='clearfix'>
								<p>									
									<?php if($reply->u_id == $this->session->userdata('id')){ ?>
									Me: 
									<?php }else{ ?>

										<?php echo $reply->u_fname. ' '.$reply->u_lname ?> 

									<?php } ?></p>
								<p class='reply-content'><?php echo $reply->bsr_content ?></p>
								<div class='clear'></div>
								<div class='fr'>
									<p class='small-p-label'><?php echo date('M d, Y H:i:s',$reply->bsr_time)?></p>
								</div>
							</div>
					<?php }?>

				<?php }?>
			</div>


			
			
		</div>
		<?php }?>
	</div>
<?php }?>