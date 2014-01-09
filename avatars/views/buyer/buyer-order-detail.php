<?php echo $this->load->view('buyer/header') ?>
<script src="<?php echo base_url()?>js/jquery-ui-1.10.0.custom.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/jquery-ui-1.10.0.custom.min.css"/>

<div id='popSendEmail' class="popout-cont">
	<div class="padded-cont">

		<input type='button' value='X' class='close-pop-out fr'>

		<div class='clear'> </div>
		<div class='product-cont padded-cont clearfix'>
			<div class="fl half clearfix">
				<p class='p-infoformat fl'> <label class='label-infoformat fl'>Order ID: </label>&#160;&#160;<?php echo $bt->bt_invoice; ?></p>
			</div>
			<div class="fl half clearfix">
				<p class='p-infoformat fl'> <label class='label-infoformat fl'>Order Date: </label>&#160;&#160;<?php echo date('M d, Y H:i:s',$bt->bt_time); ?></p>
			</div>
		</div>
		<div class='product-cont padded-cont'>
			<?php echo form_open_multipart('user/personal_message');?>

				<div class='clearfix'>
					<label for='seller-memo'>Subject</label>
					<div class="clear"> </div>
					<input type='text' id='send-subject-val' name='subject'  class='normal-format-text longer' />
				</div>
				<div class='clearfix'>
					<label for='seller-memo'>Message</label>
					<div class="clear"> </div>
					<textarea id='send-message-val' name='message'  class='normal-format-text full-ta'></textarea>
				</div>
				<div class='clearfix'>
					<label for='seller-memo'>Attachment</label>
					<div class="clear"> </div>
					<input type="file" name="userfile" size="20" />
				</div>
				<!-- <button class='normal-button fr' id='send_message' >Send</button> -->
				<input type='hidden' name='supplier' value='<?php echo $supplier_info->u_id ?>'>
				<input type='hidden' name='invoice' value='<?php echo $bt->bt_invoice ?>'>
				<input type='hidden' name='id' value='<?php echo $bt->bsd_id ?>'>
				<input type='hidden' name='action' value='send'>
				<input class='normal-button fr' type='submit' name='submit-message' value="Send" />
			<?php echo form_close()?>
		</div>

	</div>

</div>

<div id='popInboxEmail' class="popout-cont">
	<div class="padded-cont">

		<input type='button' value='X' class='close-pop-out fr'>

		<div class='clear'> </div>
		<div class='product-cont padded-cont clearfix'>
			<div class="fl half clearfix">
				<p class='p-infoformat fl'> <label class='label-infoformat fl'>Order ID: </label>&#160;&#160;<?php echo $bt->bt_invoice; ?></p>
			</div>
			<div class="fl half clearfix">
				<p class='p-infoformat fl'> <label class='label-infoformat fl'>Order Date: </label>&#160;&#160;<?php echo date('M d, Y H:i:s',$bt->bt_time); ?></p>
			</div>
		</div>


		<div class='product-cont padded-cont' id='messages-main-cont'>
		</div>

	</div>

</div>

<div class="global-cont">

	<div class='bg-body'>
		<div class="bg-body-top"> </div>
		<div class="bg-body-middle clearfix">
		<!-- MIDDLE PAGE CONTAINER-->


			<!-- LEFT SIDEBAR CONTAINER-->
			<div id="left-sidebar" class="clearfix fl">

				<?php echo $this->load->view('buyer/sidebar');?>

			</div>

			<!-- RIGHT CONTENT CONTAINER-->
			<div class='right-cont clearfix fr'>

				<div class='right-inner clearfix'>

					<!-- First Row Container-->
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'> Order Detail </p>
					</div>

					<div class='product-cont padded-cont clearfix'>
						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>Order Date: </label>&#160;&#160;<?php echo date('M d, Y H:i:s',$bt->bt_time); ?></p>
						</div>
						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>Payment Method: </label>&#160;&#160;<?php echo $bt->bt_type; ?></p>
						</div>
						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>Invoice Number: </label>&#160;&#160;<?php echo $bt->bt_invoice; ?></p>
						</div>

						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>Order Status: </label>&#160;&#160;
								<?php if($bt->bsd_status == -1) echo "Cancelled: " ?> 
								<?php if($bt->bsd_status == -4) echo "Returned: " ?> 
								<?php echo $bt->bsd_reason ?>
							</p>
						</div>

					</div>

				</div>
				<div class='right-inner clearfix'>

					<!-- First Row Container-->
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'> Shipping Address </p>
					</div>

					<div class='product-cont padded-cont clearfix'>
						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>Receivers's Name: </label>&#160;&#160;<?php echo $bt->bts_name ?></p>
						</div>

						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>Address 1: </label>&#160;&#160;<?php echo $bt->bts_add1 ?></p>
						</div>
						<?php if($bt->bts_add2 != '') {?>
							<div class="fl half clearfix">
								<p class='p-infoformat fl'> <label class='label-infoformat fl'>Address 2: </label>&#160;&#160;<?php echo $bt->bts_add2 ?></p>
							</div>
						<?php }?>
						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>City: </label>&#160;&#160;<?php echo $bt->bts_city ?></p>
						</div>
						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>State: </label>&#160;&#160;<?php echo $bt->bts_prov ?></p>
						</div>
						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>Contact Number: </label>&#160;&#160;<?php echo $bt->bts_phone_num.' '.$bt->bts_phone_ext ?></p>
						</div>
					</div>

				</div>

				<div class='right-inner clearfix'>

					<!-- First Row Container-->
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'>Supplier Detail</p>
					</div>

					<div class='product-cont padded-cont clearfix'>
						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>Recipient’s Name: </label>&#160;&#160;<?php echo $supplier_info->u_fname.' '.$supplier_info->u_lname ?></p>
						</div>
						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>Company: </label>&#160;&#160;<?php echo $supplier_info->u_company ?></p>
						</div>
						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>Address 1: </label>&#160;&#160;<?php echo $supplier_info->ba_add1 ?></p>
						</div>
						<?php if($supplier_info->ba_add2 != '') {?>
							<div class="fl half clearfix">
								<p class='p-infoformat fl'> <label class='label-infoformat fl'>Address 2: </label>&#160;&#160;<?php echo $supplier_info->ba_add2 ?></p>
							</div>
						<?php }?>
						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>City: </label>&#160;&#160;<?php echo $supplier_info->ba_city ?></p>
						</div>
						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>State: </label>&#160;&#160;<?php echo $supplier_info->ba_province ?></p>
						</div>

						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>Contact Number: </label>&#160;&#160;<?php echo $supplier_info->ba_phone_num.' '.$supplier_info->ba_phone_ext ?></p>
						</div>
						<div class='clear'></div>


						<button class='normal-button fr' id='message_seller' >Send Email</button>
						<div class='clear'></div>
						<p class='fr'>You got <?php echo count($email_notification)?>  <a href="<?php echo base_url()?>buyer/inbox">New Message</a></p>
						<div class='clear'></div>
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

					</div>

				</div>

				<div class='right-inner clearfix'>

					<!-- First Row Container-->
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'> Item Order Detail </p>
					</div>

					<div class='product-cont padded-cont clearfix'>
						<div class='violet-table'>
							<table>
								<tr>
									<td>Product</td>
									<td width=15>Qty</td>
									<td width=15>Amount</td>
<!-- 									<td width=15>Shipping Fee</td> -->
									<td>Sub Amount</td>
									<td>Net Total</td>
								</tr>
								<?php 
								$net_total = 0;
								$deduction_total = 0;
								$shipping_total = 0;
								foreach($btd as $btd_det){
									$shipping = $btd_det->btd_shipamount * $btd_det->btd_quan; //shipping amount * the quantity
									?>
									<tr>
										<td>
											<div class='clearfix'>
												<div class='fl' style='margin-right:10px;'>
													<?php 
													$image_list = $this->inventories->list_image($btd_det->i_id,1,true); 
													//limit 1, select only the featured image
													if(count($image_list) == 0){?>
														<img width=90 src="<?php echo base_url()?>images/default-preview.jpg">
													
													<?php }else{?>
														<img width=90  src="<?php echo $image_list[0]->ii_link ?>">
													<?php }?>
												</div>
												<div class='fl'>
													<div><a target='_blank' href="<?php echo base_url()?>inventory/detail/<?php echo $btd_det->ic_id?>/<?php echo $btd_det->supplier_id?>" ><?php echo $btd_det->tr_title?> </a></div>
													<div class='table-format-det clearfix'>
														<label class='fl'>Produt ID: </label><p class='fl'> <?php echo $btd_det->ic_id?></p> 
													</div>
													<div class='table-format-det clearfix'>
														<label class='fl'>UPC/EAN: </label><p class='fl'> <?php echo $btd_det->ucp_ean?></p>
													</div>
													<div class='table-format-det clearfix'>
														<label class='fl'>SKU: </label><p class='fl'> <?php echo $btd_det->SKU?></p> 
													</div>
												</div>
											</div>
										</td>
										<td><center><?php echo $btd_det->btd_quan?></center></td>
										<td><center>$<?php echo $btd_det->btd_amount?></center></td> 
										<td>$<?php echo $btd_det->btd_subamount?></td> 
										<td>$<?php echo $net = $btd_det->btd_subamount;  ?></td>
										<?php 
											$shipping_total += $shipping;
											$net_total += $net;

										?>
									</tr>
								<?php }?>
								<?php if($bt->bsd_status == -2 || $bt->ssi_status == 1){ 
									$shippin_old_price = $shipping_total;
									$shipping_total = $bt->ssi_shipExtra; }?>
								<tr>
									<td colspan=7><p class='fl' style='margin-top:10px;'>Shipping Fee: $</p>

											<p class='fl' style='margin-top:10px;'><?php echo $shipping_total ?></p>
						
									</td>
								</tr>
								<tr>
									<td colspan='3' class='big-font'><p>Total:</p></td>
									<td colspan='1' class='big-font'><b><label class='label-infoformat'>$<?php echo $bt->bsd_total_paymet ?></label>&#160;&#160;<label id='shipping-label' class='label-infoformat'>+&#160;$<?php echo $shipping_total?></label></b></td>
									<td colspan='1' class='big-font'><p class='totalnet-cont'>$<?php echo $net_total + $shipping_total?></p></td>
								</tr>
							</table>
						</div>

					</div>

				</div>


				<?php if( $bt->bsd_status == -2) {?>
				<script type="text/javascript">
					
					function confirmChangeFee(){

						if (confirm('Are you ok with the new shipment rates? \n Please press ok if you agree to the new shipping rates, cancel if not and your response will be sent to the seller')){
							$.post('<?php echo base_url()?>supplier/orderUpdate',{action:'pending',confirmFee:true,reason:'Buyer Approved Shipping Fee',bsd_id:<?php echo $bt->bsd_id ?>},function(data){

						     });

							$.post('<?php echo base_url()?>buyer/confirmShippingFee',{ssi:<?php echo $bt->ssi_id ?>},function(data){

							});
							location.reload();
						}
					}


				</script>
				<div class='right-inner clearfix'>
					<!-- First Row Container-->
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'>Confirm Shipping Fee Update</p>
					</div>
						<div class='padded-cont clearfix'>
						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>Original Shipping Fee: </label>&#160;&#160;$<?php echo $shippin_old_price?></p>
						</div>
						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>New Shipping Fee: </label>&#160;&#160;$<?php echo $shipping_total?></p>
						</div>
						<div class='clear'></div>
						<button class='normal-button fr' id='submit-confirm-change-fee' onclick='confirmChangeFee()'>CONFIRM</button>
					</div>
				</div>
				<?php }?>

				<?php if($bt->bsd_status == -3){ $orr_detail =  $this->suppliers->orr_detail($bt->bsd_id); ?>
				<!--REFUND CONTAINER DETAILS -->
				<div class='right-inner clearfix'>
					<!-- First Row Container-->
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'>Refund Details</p>
					</div>
					<div class='padded-cont clearfix'>
						<div class='fl padded-cont'>
							<label for='ref-reason' class='fl'>Reason:</label>
							<p class='fl'><b><?php echo $orr_detail->orr_reason ?></b></p>
						</div>
						<div class='clear'></div>
						<div class='violet-table'>
							<table>
								<tr>
									<td></td>
									<td>Order Amount</td>
									<td>Amount Refund</td>
									<td>Max Amount</td>
								</tr>
								<tr>
									<td>Product</td>
									<td>$<?php echo $bt->bsd_total_paymet; ?></td>
									<td>$<?php echo $orr_detail->orr_prod_amnt	 ?></td>
									<td>$<?php echo $bt->bsd_total_paymet; ?></td>
								</tr>
								<tr>
									<td>Shipping</td>
									<td>$<?php echo $shipping_total; ?></td>
									<td>$<?php echo $orr_detail->orr_ship_amnt?></td>
									<td>$<?php echo $shipping_total; ?></td>
								</tr>
								<tr>
									<td><b>Total Refund:</b></td>
									<td></td>
									<td><span class='total_refund'>$<?php echo $orr_detail->orr_total?></span></td>
									<td></td>
								</tr>

							</table>
						</div>
						<div class='fl padded-cont'>
							<label for='ref-reason' class='fl'>Memo:</label>
							<p class='fl'><b><?php echo $orr_detail->orr_memo ?></b></p>
						</div>
					</div>
				</div>
				<!--REFUND CONTAINER DETAILS -->
				<?php }?>


				<?php if($bt->bsd_status != 0 && $bt->bsd_status != -1 && $bt->bsd_status != -2 && $bt->bsd_status != -3) {?>
				<div class='right-inner clearfix'>
					<!-- First Row Container-->
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'>Shipping Detail Form</p>
					</div>
					<div class='padded-cont clearfix'>

						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>Shipping Tracking #: </label>&#160;&#160;<?php echo $bt->ssi_track?></p>
						</div>

						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>Carrier: </label>&#160;&#160;<?php $carrier = $this->countries->carrier_info($bt->ssi_carrier); echo $carrier->sc_name ?></p>
						</div>

						<div class="fl half clearfix">
							<?php $country_carrier = $this->countries->country_info($bt->country_billing);?>
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>Country: </label>&#160;&#160;<?php echo $country_carrier->c_name?></p>
						</div>

						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>Ship Date: </label>&#160;&#160;<?php echo date('M d, Y',$bt->ssi_start);?></p>
						</div>

						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>Additional Shipping Fee Expenses: </label>&#160;&#160;$<?php echo $bt->ssi_shipExtra;?></p>
						</div>

						<div class="fl full clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>Shipping Method: </label>&#160;&#160;<?php echo $bt->ssi_shipMethod?></p>
						</div>

						<?php if($bt->ssi_status == 0 || $bt->ssi_status == ""){?>
							<div class='decision-buttons-order-cont'>
								<button class='normal-button fr' id='submit-cancel'>CANCEL</button>
								<button class='normal-button fr' id='submit-confirm'>CONFIRM</button>
							</div>
							<?php }else{?>

							<div class='clear'></div>
							<center><p>--Please Wait for the Confirmation from the Seller--</p></center>

						<?php }?>
						<div class='clear'></div>
						<div class='fr circle-loading' id='loading-supplierpayment'></div>
						<div id='result-sending'>

						</div>
							
					</div>
				</div> 

				<script type="text/javascript">

					$('#submit-confirm').click(function(){

						var status = 1;//1 confirmed
						var ssiid = <?php echo $bt->ssi_id ?>;
						var supplier = <?php echo $bt->supplier_u_id?>;

						$.post('<?php echo base_url()?>buyer/updateOrder',{status:status,ssiid:ssiid,action:'updateStatus'},function(data){
							$('.decision-buttons-order-cont').fadeOut().delay(400);
							$('#result-sending').fadeIn().html('<p>Thank you for using Oceantailer</p>');
						});
					});

					$('#submit-cancel').click(function(){

						var status = 2; //2 cancel
						var ssiid = <?php echo $bt->ssi_id ?>;
						var supplier = <?php echo $bt->supplier_u_id?>;

						$.post('<?php echo base_url()?>buyer/updateOrder',{status:status,ssiid:ssiid,action:'updateStatus'},function(data){
							$('.decision-buttons-order-cont').fadeOut().delay(400);
							$('#result-sending').fadeIn().html('<p>Your order is been Canceled, Thank you for Using Oceantailer</p>');
						});
					});

					
				</script>
				<?php }?>

				<?php if($bt->bsd_status != 1 && $bt->bsd_status != -3 && $bt->bsd_status != -4 && $bt->bsd_status != -1) {?>
				<div class='right-inner clearfix'>
					<!-- First Row Container-->
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'></p>
					</div>

					<a class='full-width-link' href="<?php echo base_url()?>buyer/order_cancel/<?php echo $bt->bsd_id ?>">Cancel Order</a>

				</div>
				<?php }elseif($bt->bsd_status == 1){ ?>
				<div class='right-inner clearfix'>
					<!-- First Row Container-->
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'></p>
					</div>

					<a class='full-width-link full-yellow' href="<?php echo base_url()?>buyer/order_return/<?php echo $bt->bsd_id ?>">Return Order</a>

				</div>

				<?php }?>

				<?php if($bt->bsd_status == -1) {?>
				<!--IF THE ORDER IS BEEN CANCELLED-->
				<div class='right-inner clearfix'>
					<!-- First Row Container-->
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'>Cancelled </p>
					</div>
					<div class='padded-cont clearfix'>
						<center><p>-<?php echo $bt->bsd_reason ?>-</p></center>
					</div>
				</div>
				<!--IF THE ORDER IS BEEN CANCELLED END-->
				<?php }?>

				<?php if($bt->bsd_status == 1 && $bt->bsd_is_feedback == 1) {?>
				<div class='right-inner clearfix'>
					<!-- First Row Container-->
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'>Feedback Us</p>
					</div>
					<div class='padded-cont clearfix'>
						<?php if($bt->bsd_feedback_date == ''){?>
						<div class="clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>Your Rate: </label>
								&#160;&#160;
								<div id="buyer_ic_rate" class="fl sup_ic_rate-cont" style='margin-top:-5px !Important'></div>
								<script type="text/javascript">
									$(document).ready(function(){
			                            $('#buyer_ic_rate').raty({
			                              readOnly : false,
			                              score    : 1,
			                              width    : 150,
			                              path     :"<?php echo base_url().'images/'?>",
			                              precision: true
			                            });
			                        });
		                        </script>
							</p>
							<div class='clear'></div>
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>Your Feedback: </label>
								&#160;&#160;
								<div class="clear"> </div>
								<textarea id='feedback-content' class='normal-format-text full-ta'></textarea>
							</p>
							<br/>
							<button class='normal-button fr' id='send-feedback-buyer'>SEND FEEDBACK</button>

						</div>
						<script type="text/javascript">
							$('#send-feedback-buyer').click(function(){
								var feedback = $('#feedback-content').val();
								var rate = $('#buyer_ic_rate').raty('score');

								$.post('<?php echo base_url()?>buyer/add_feedback',{feedback:feedback,rate:rate,bsd:<?php echo $bt->bsd_id ?>},function(data){
									location.reload();
								});
							});
						</script>
						<?php }else{?>
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>Your Rate: </label>
								&#160;&#160;
								<div id="buyer_ic_rate" class="fl sup_ic_rate-cont" style='margin-top:-5px !Important'></div>
								<script type="text/javascript">
									$(document).ready(function(){
			                            $('#buyer_ic_rate').raty({
			                              readOnly : true,
			                              score    : <?php echo $bt->bsd_buyer_rate?>,
			                              width    : 150,
			                              path     :"<?php echo base_url().'images/'?>",
			                              precision: true
			                            });
			                        });
		                        </script>
							</p>
							<div class='clear'></div>
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>Your Feedback: </label>
								&#160;&#160; <?php echo $bt->bsd_buyer_feedback?>								
							</p>
						<?php }?>
					</div>
				</div>
				<?php }?>
				
				

			</div>

		<!-- MIDDLE PAGE CONTAINER-->
		</div>
		<div class="bg-body-bottom"> </div>
	</div>

</div>

<script type="text/javascript">
	$('#message_seller').click(function(){
		$('#popSendEmail').fadeIn();

	})



	$('.close-pop-out').click(function(){
		$('.popout-cont').fadeOut();
		window.location.reload();
	});

	$('#send_message').click(function(){


		var message = $('#send-message-val').val();
		var subject = $('#send-subject-val').val();

		$.post('<?php echo base_url() ?>user/personal_message',{message:message,subject:subject,
			action:'send',id:'<?php echo $bt->bsd_id ?>',supplier:'<?php echo $supplier_info->u_id ?>'},function(result){
			location.reload();
		});
	});


</script>


<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>js/jquery.raty.min.js"></script>
<?php echo $this->load->view('buyer/footer') ?>