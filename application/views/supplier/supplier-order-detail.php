<?php echo $this->load->view('supplier/header') ?>
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
				<input type='hidden' name='buyer' value='<?php echo $buyer->u_id ?>'>
				<input type='hidden' name='invoice' value='<?php echo $bt->bt_invoice ?>'>
				<input type='hidden' name='id' value='<?php echo $bt->bsd_id ?>'>
				<input type='hidden' name='action' value='send'>
				<input class='normal-button fr' type='submit' name='submit-message' value="Send" />
			<?php echo form_close()?>
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

				<?php echo $this->load->view('supplier/sidebar');?>

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
						<p class='breadcrumbs fl'> Shipping To </p>
					</div>

					<div class='product-cont padded-cont clearfix'>
						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>Recipient’s Name: </label>&#160;&#160;<?php echo $bt->bts_name ?></p>
						</div>

						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>Address 1: </label>&#160;&#160;<?php echo $bt->bts_add1 ?></p>
						</div>
						<?php if($bt->bts_add2 != ""){?>
							<div class="fl half clearfix">
								<p class='p-infoformat fl'> <label class='label-infoformat fl'>Address 2: </label>&#160;&#160;<?php echo $bt->bts_add2 ?></p>
							</div>
						<?php }?>
						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>City: </label>&#160;&#160;<?php echo $bt->bts_city ?></p>
						</div>
						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>Postal Code: </label>&#160;&#160;<?php echo $bt->bts_postal ?></p>
						</div>
						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>State: </label>&#160;&#160;<?php echo $bt->bts_prov ?></p>
						</div>
						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>Country: </label>&#160;&#160;<?php echo $bt->c_name ?></p>
						</div>
						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>Contact Number: </label>&#160;&#160;<?php echo $bt->bts_phone_num.' '.$bt->bts_phone_ext ?></p>
						</div>
					</div>

				</div>
				<?php if($bt->bsd_status != 0 && $bt->bsd_status != -1 && $bt->bsd_status != -2 && $bt->bsd_status != -3){?>
				<div class='right-inner clearfix'>

					<!-- First Row Container-->
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'>Shipping Details</p>
					</div>

					<div class='product-cont padded-cont clearfix'>
						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>Shipping Tracking #: </label>&#160;&#160;<?php echo $bt->ssi_track; ?></p>
						</div>
						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>Shipping Start: </label>&#160;&#160;<?php echo date('M d, Y',$bt->ssi_start); ?></p>
						</div>
						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>Carrier: </label>&#160;&#160;<?php $carrier = $this->countries->carrier_info($bt->ssi_carrier); echo $carrier->sc_name ?></p>
						</div>
						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>Shipping Method: </label>&#160;&#160;<?php echo $bt->ssi_shipMethod; ?></p> 
						</div>

					</div>

				</div>
				<?php }?>

				<div class='right-inner clearfix'>

					<!-- First Row Container-->
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'>Billing Detail</p>
					</div>

					<div class='product-cont padded-cont clearfix'>
						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>Receiver's Name: </label>&#160;&#160;<?php echo $buyer->u_fname.' '.$buyer->u_lname ?></p>
						</div>
						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>Company: </label>&#160;&#160;<?php echo $buyer->u_company ?></p>
						</div>
						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>Address 1: </label>&#160;&#160;<?php echo $buyer->ba_add1 ?></p>
						</div>
						<?php if($buyer->ba_add2 != '') {?>
							<div class="fl half clearfix">
								<p class='p-infoformat fl'> <label class='label-infoformat fl'>Address 2: </label>&#160;&#160;<?php echo $buyer->ba_add2 ?></p>
							</div>
						<?php }?>
						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>City: </label>&#160;&#160;<?php echo $buyer->ba_city ?></p>
						</div>
						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>State: </label>&#160;&#160;<?php echo $buyer->ba_province ?></p>
						</div>

						<div class="fl half clearfix">
							<p class='p-infoformat fl'> <label class='label-infoformat fl'>Contact Number: </label>&#160;&#160;<?php echo $buyer->ba_phone_num.' '.$buyer->ba_phone_ext ?></p>
						</div>
						<div class='clear'></div>

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
									<td width=15>Commision</td>
									<td>Deduction</td>
									<td>Net Total</td>
								</tr>
								<?php 
								$net_total = 0;
								$deduction_total = 0;
								$shipping_total = 0;
								foreach($btd as $btd_det){
									$shipping = $btd_det->btd_shipamount * $btd_det->btd_quan;
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
													<div><a href="<?php echo base_url()?>inventory/detail/<?php echo $btd_det->ic_id?>/<?php echo $btd_det->supplier_id?>" ><?php echo $btd_det->tr_title?> </a></div>
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
										<td><?php echo $btd_det->btd_productFee ?>%</td>
										<td>-$<?php echo $deduction = $btd_det->btd_subamount * ($btd_det->btd_productFee/100); ?></td>
										<td>$<?php echo $net = $btd_det->btd_subamount - $deduction;  ?></td>
										<?php 
											$shipping_total += $shipping;
											$net_total += $net;
											$deduction_total +=$deduction;
										?>
									</tr>
								<?php }?>

								<?php if($bt->bsd_status == -2 || $bt->ssi_status == 1){ $shipping_total = $bt->ssi_shipExtra; }?>

								<tr>
									<td colspan=7><p class='fl' style='margin-top:10px;'>Revision  Shipping Fee: $</p>
										<?php if($bt->bt_status == 0){?>
										<input type='text' id='extra-shipping-cost' class='small fl' value="<?php echo $shipping_total ?> " />
										<button id='submit-confirmation-buyer' class='hide fl'>Notify Buyer</button>
										<?php }else{?>
											<p class='fl' style='margin-top:10px;'><?php echo $shipping_total ?></p>
										<?php }?>
									</td>
								</tr>
								<tr>
									<td colspan='3' class='big-font'><p>Total:</p></td>
									<td colspan='1' class='big-font'>
										<table>
											<tr>
												<td colspan=2></td>
											</tr>
											<tr>
												<td>Total Items: </td>
												<td><label class='label-infoformat'>$<?php echo $bt->bsd_total_paymet ?></label></td>
											</tr>
											<tr>
												<td>Total Shipping: </td>
												<td><label id='shipping-label' class='label-infoformat'>+&#160;$<?php echo $shipping_total?></label></td>
											</tr>
										</table>
									</td>
									<td colspan='1' class='big-font'></td>
									<td colspan='1' class='big-font'><p>-$<?php echo $deduction_total?></p></td>
									<td colspan='1' class='big-font'><p class='totalnet-cont'>$<?php echo $net_total + $shipping_total?></p></td>
								</tr>
							</table>
						</div>

					</div>

				</div>


				<?php if($bt->bsd_status == 0 || $bt->bsd_status == -2){?>
				<div class='right-inner clearfix'>
					<!-- First Row Container-->
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'>Shipping Detail Form</p>
					</div>
					<div class='padded-cont clearfix'>

						<div class='fl'>
							<div class='fl'>
								<label for='track-number'>Tracking Number</label>
								<div class="clear"> </div>
								<input type='text' value='<?php echo $bt->ssi_track?>' class='normal-format-text' id='track-number' />
							</div>
							<div class='clear'> </div>
							<div class='fl'>
								<label for='shipping-carrier'>Carrier</label>
								<div class="clear"> </div>
								<select class='normal-format-select' id='shipping-carrier'>
									<option value=''>Select Carrier</option>
									<?php foreach($delivery_carrier as $cer){?>
										<option <?php if($bt->ssi_carrier == $cer->sc_name){ echo 'selected="selected"';}?> value="<?php echo $cer->sc_id?>"><?php echo $cer->sc_name?></option>
									<?php }?>
								</select>
							</div>

							<div class='clear'> </div>
							<div class='fl' id='country-shipping-cont'>
								<label for='shipping-country'>Country</label>
								<div class="clear"> </div>
								<select class='normal-format-select' id='shipping-country'>
								</select>
							</div>

							<div class='clear'> </div>
							<div class='fl'>
								<label for='shipping-method'>Shipping Method</label>
								<div class="clear"> </div>
								<textarea type='text' id='shipping-method'  class='normal-format-text long'><?php echo $bt->ssi_shipMethod?></textarea>
							</div>
							

						</div>

						<div class='fr shipping-box'>
							<label for='shipping-start'>Ship Date</label>
							<div class="clear"> </div>
							<div id='shipping-start'></div>
						</div>

						<div class='clear'> </div>

						<div class='clear'> </div>
						<!-- <button class='normal-button fr' id='submit-confirmation-buyer'>UPDATE ORDER</button> -->
						<div class='notify-to-check-change-shipfee hide' >
							<center><p>--Need Confirmation From the Buyer for the New Shipping Fee Amount--</p></center>
						</div>

						<?php if($bt->bsd_status == 0 || $bt->bsd_status == ''){ ?>
							<button class='normal-button fr' id='submit-confirmation-shipping'>SUBMIT</button>
						<?php }else{?>
							<br/><center><p>--Waiting for Cofirmation From the Buyer for the New Shipping Detail, Click <a  href='#'>Here</a> to resend the Email--</p></center>
						<?php }?>

						<div class='fr circle-loading' id='loading-supplierpayment'></div>

	

						<div id='result-sending'></div>
					</div>
				</div> 

				<script type="text/javascript">

					var total_net = <?php echo $net_total?>;
					var has_shippingcountry = true;
					var requestType = '';


					$( "#shipping-start" ).datepicker({
						onSelect: function()
					    { 
					        var start = $(this).datepicker('getDate'); 
					    },
					    maxDate: new Date()
				    });

				    $( "#shipping-start" ).datepicker( "option", "dateFormat", 'mm/dd/yy' ); 


				    <?php if($bt->ssi_start != ''){ 
				    	$formattedDateStr = date("m/d/y",$bt->ssi_start);
				    	?>
				    	$('#shipping-start').datepicker('setDate', '<?php echo $formattedDateStr ?>');
				    <?php }?>

				    $('#submit-confirmation-shipping').click(function(){
				    	requestType = 'supplierpayment';
				    	submit_payment('add');
					});

					$('#submit-confirmation-buyer').click(function(){
						requestType = 'supplierpayment';
						submit_payment('request');
					});

					function submit_payment(status_payment)
					{
						start = $("#shipping-start").val();
						end = '0';
						var track  = $('#track-number').val();
						var method = $('#shipping-method').val();
						var carrier = $('#shipping-carrier').val();
						var extra_cost = $('#extra-shipping-cost').val();
					
						var country = <?php echo $bt->country_id ?>;

						if(has_shippingcountry)
						{
							$.post('<?php echo base_url()?>shipping/confirm',{track:track,start:start,end:end,method:method,carrier:carrier,
								extra_cost:extra_cost,shipping_cost:extra_cost,bt_id:<?php echo $bt->bt_id ?>,bsd:<?php echo $bt->bsd_id ?>,country:country,
								action:status_payment},function(data){
									alert(data);
								var  convert = JSON.parse(data);
								if(convert.result == 0) //have problem in paypal
								{
									window.location.reload();
									$('#result-sending').html(data);
								}
								else
								{
									$('#result-sending').html(convert.display);
								}
							});
							$('#submit-confirmation-buyer').fadeOut();
						}
						else
							alert('Please Select A Country for the Carrier');
					}

					$("body").on({
					    ajaxStart: function() { 
					    	if(requestType == 'supplierpayment')
					        	$('#loading-supplierpayment').show();

					    },
					    ajaxStop: function() { 
					    	if(requestType == 'supplierpayment')
					        	$('#loading-supplierpayment').hide();


					        requestType = '';
					    }    
					});

					$('#extra-shipping-cost').keyup(function(){

						$('#extra-shipping-cost').val($('#extra-shipping-cost').val().replace(/[^\d]/g, ""));
						if($('#extra-shipping-cost').val() == "")
							$('#extra-shipping-cost').val(<?php echo $shipping_total ?>);	

						if($('#extra-shipping-cost').val() != <?php echo $shipping_total ?> )
						{
							$('#submit-confirmation-shipping').hide();
							$('#submit-confirmation-buyer').fadeIn(); 
							$('.notify-to-check-change-shipfee').show();
						}
						else
						{
							$('#submit-confirmation-buyer').hide();
							$('#submit-confirmation-shipping').fadeIn();
							$('.notify-to-check-change-shipfee').hide();
						}

						var total = total_net + parseFloat($('#extra-shipping-cost').val());
						$('.totalnet-cont').html('$'+total);
						$('#shipping-label').html('+ $'+$('#extra-shipping-cost').val());

					});

					

				function change_country(){

				    var sel = document.getElementById('shipping-country');
				    var val = '<?php echo $bt->ssi_country?>';
				
				    for(var i = 0, j = sel.options.length; i < j; ++i) {
				        if(sel.options[i].value === val) {
				           sel.selectedIndex = i;
				           break;
				        }
				    }
				}

			
					
				</script>

				<?php } ?>

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
									<td>Prior Refund</td>
									<td>Max Amount</td>
								</tr>
								<tr>
									<td>Product</td>
									<td>$<?php echo $bt->bsd_total_paymet; ?></td>
									<td><span class='red'><center>($<?php echo $orr_detail->orr_prod_amnt ?>)</center></span></td>
									<td>$<?php echo $bt->bsd_total_paymet; ?></td>
								</tr>
								<tr>
									<td>Shipping</td>
									<td>$<?php echo $shipping_total; ?></td>
									<td><span class='red'><center>($<?php echo $orr_detail->orr_ship_amnt?>)</center></span></td>
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
							<label for='ref-reason' class='fl'>Memo to buyer:</label>
							<p class='fl'><b><?php echo $orr_detail->orr_memo ?></b></p>
						</div>
						
					</div>
					<a class='full-width-link full-yellow' href="<?php echo base_url()?>supplier/refund/<?php echo $bt->bsd_id ?>">Update Refund Order</a>
				</div>
				<!--REFUND CONTAINER DETAILS -->
				<?php }?>

				<div class='right-inner clearfix'>
					<!-- First Row Container-->
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'>My Notes</p>
					</div>
					
					<div class='padded-cont clearfix'>
						<div class='clearfix'>
							<div class="clear"> </div>
							<textarea type='text' id='seller-memo'  class='normal-format-text full-ta'><?php echo $bt->bsd_memo ?></textarea>

						</div>
						<div class='clearfix'>
							<button class='normal-button fr' id='clear-memo'>UNDO</button>
							<button class='normal-button fr' id='save-memo'>SAVE</button>
						</div>
						<script type="text/javascript">
							var memo_backup = $('#seller-memo').val();
							$("#save-memo").click(function(){
								var memo = $('#seller-memo').val();

								$.post('<?php echo base_url()?>supplier/memo',{action:'update',memo:memo,id:<?php echo $bt->bsd_id ?>},function(result){

								});

							});

							$('#clear-memo').click(function(){
								$('#seller-memo').val(memo_backup);
							});
						</script>
					</div>
				</div>

				<?php if($bt->bsd_status != 2 && $bt->bsd_status != 1 && $bt->bsd_status != -3 && $bt->bsd_status != -4 && $bt->bsd_status != -1) {?>
				<div class='right-inner clearfix'>
					<!-- First Row Container-->
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'></p>
					</div>

					<a class='full-width-link' href="<?php echo base_url()?>supplier/order_cancel/<?php echo $bt->bsd_id ?>">Cancel Order</a>

				</div>
				<?php }elseif($bt->bsd_status == 1 || $bt->bsd_status == -4){ ?>
				<div class='right-inner clearfix'>
					<!-- First Row Container-->
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'></p>
					</div>

					<a class='full-width-link full-yellow' href="<?php echo base_url()?>supplier/refund/<?php echo $bt->bsd_id ?>">Refund Order</a>

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

				<?php if($bt->bsd_status == 1) {?>
				<div class='right-inner clearfix'>
					<!-- First Row Container-->
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'>Feedback Us</p>
					</div>
					<div class='padded-cont clearfix'>
						<?php if($bt->bsd_feedback_date == ''){?>
							<center><p>--No feedback was given yet from the buyer--</p></center>
						<?php }else{ ?>
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


	load_inbox();
	function load_inbox()
	{
		$.post('<?php echo  base_url() ?>user/personal_message',{id:'<?php echo $bt->bsd_id ?>',action:'get'},function(result){
			$('#messages-main-cont').html(result);
		});
		
	}

	function check_reply(id)
	{

	}

	function add_reply(id)
	{
		var reply_content = $('#reply'+id).val();

		$.post('<?php echo base_url() ?>user/personal_message',{reply_content:reply_content,id:id,action:'addReply'},function(result){
			$('#append-reply'+id).prepend(result);
		});
	}
	
</script>


<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>js/jquery.raty.min.js"></script>
<?php echo $this->load->view('supplier/footer') ?>


