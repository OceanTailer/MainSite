<?php echo $this->load->view('supplier/header') ?>
<script src="<?php echo base_url()?>js/jquery-ui-1.10.0.custom.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/jquery-ui-1.10.0.custom.min.css"/>



<div class="global-cont">

	<div class='bg-body'>
		<div class="bg-body-top"> </div>
		<div class="bg-body-middle clearfix">
		<!-- MIDDLE PAGE CONTAINER-->


			<!-- LEFT SIDEBAR CONTAINER-->
			<div id="left-sidebar" class="clearfix fl">

				<?php echo $this->load->view('supplier/sidebar');?>

			</div>

			<!-- RIGHT CONTENT CONTAINER-->
			<div class='right-cont clearfix fr'>

				<div class='right-inner clearfix'>
					<!-- First Row Container-->
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'>Message: </p>
					</div>
					
					<div class='product-cont padded-cont clearfix'>
						<div class="clearfix">
							<h4>Subject: <?php echo $message->bsm_subject?></h4>
						</div>	
						<div class="clearfix">
							<p>From: <?php echo $message->u_fname.' '.$message->u_lname?> (<?php echo $message->u_username?>@oceantailer.com)</p>
						</div>	
						<div class="clearfix">
							<p>Sent: <?php echo date('M d, Y H:i:s',$message->bsm_time); ?></p>
						</div>
						<div class="clearfix">
							<p>To: <?php echo $supplier->u_company?></p>
						</div>
						<br/>
						<div class="clearfix">
							<p>Order  ID: <strong><?php echo $message->bt_invoice?></strong></p>
						</div>		

						<div class='message-container-inbox'>
							<p><?php echo $message->bsm_message?></p>
						</div>

						<?php if($message->bsm_attachment != ''){ ?>

							<a href="<?php echo $message->bsm_attachment ?>" target="_blank" >Download Attached File</a>
							<br/>
						<?php }else{ ?>
							<p>No attached File</p>
						<?php }?>

						<br/>

						<div>
							<p>If you believe this message is suspicious, please report it to us <a href="#">Here</a></p>
						</div>

						<div class="clearfix">
							<h4>Reply</h4>
						</div>	

						<div>
							<?php echo form_open_multipart('user/personal_message');?>
								<textarea rows="2" name='reply_content' class='full-ta fl' ></textarea>
								<label for='seller-memo'>Attachment</label>
								<div class="clear"> </div>
								<input type="file" name="userfile" size="20" />
								<div class='clear'></div>

								<input type='hidden' name='buyer' value='<?php echo $message->u_id ?>'>
								<input type='hidden' name='invoice' value='<?php echo $message->bt_invoice ?>'>
								<input type='hidden' name='id' value='<?php echo $message->bsd_id ?>'>

								<input type='hidden' name='id_message' value='<?php echo $message->bsm_id ?>'>

								<input type='hidden' name='action' value='addReply'>
								<input type='hidden' name='subject' value='RE: <?php echo $message->bsm_subject?>'>
								<input type='submit' class='normal-button fr' name='submit-message' value='REPLY'> 
				

							<?php echo form_close()?>
						</div>

						<div class='clearfix'>	
							<center>
								<?php if($this->session->userdata('has_upload') == 1){
								if($this->session->userdata('is_upload') == 1) {?>
									<p>--<?php echo $this->session->userdata('error')  ?>--</p>
								<?php }else{?>
									<p>--<?php echo $this->session->userdata('error')  ?>--</p>
								<?php }?>
								<?php 

									$array_items = array('has_upload' => '', 'error' => '', 'is_upload' => '');
									$this->session->unset_userdata($array_items);

								} ?>
							</center>
						</div>

						<script type="text/javascript">
							$('#reply-message').click(function(){

								var message = $('#reply-message').val();
								var subject = "RE: <?php echo $message->bsm_subject?>";

								$.post('<?php echo base_url() ?>user/personal_message',{message:message,buyer:'<?php echo $message->u_id?>',invoice:'<?php echo $message->bt_invoice; ?>',subject:subject,
									action:'send',id:'<?php echo $message->bsd_id ?>'},function(result){
									window.location.reload();
								});

							});
						</script>

						<?php $replies =  $this->users->get_message_reply($message->bsm_id);?>
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

											<?php if($reply->bsr_attachment != ''){ ?>

												<a href="<?php echo $reply->bsr_attachment ?>" target="_blank" >Download Attached File</a>
												<br/>
											<?php } ?>

										</div>
								<?php }?>

							<?php }?>
						</div>
				

					</div>
				</div>



			</div>

   		</div>
		<div class="bg-body-bottom"> </div>
	</div>  

</div>


<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>js/jquery.raty.min.js"></script>
<?php echo $this->load->view('supplier/footer') ?>

