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
								<?php if($bt->bsd_status == -4) echo "Returned: " ?> 
								<?php echo $bt->bsd_reason ?>
							</p>
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

								<?php if($bt->bsd_status == -2 || $bt->ssi_status == 1 ){ $shipping_total = $bt->ssi_shipExtra; }?>

								<tr>
									<td colspan=7><p class='fl' style='margin-top:10px;'>Revision  Shipping Fee: $</p>
	
										<p class='fl' style='margin-top:10px;'><?php echo $shipping_total ?></p>

									</td>
								</tr>
								<tr>
									<td colspan='3' class='big-font'><p>Total:</p></td>
									<td colspan='1' class='big-font'><b><label class='label-infoformat'>$<?php echo $bt->bsd_total_paymet ?></label>&#160;&#160;<label id='shipping-label' class='label-infoformat'>+&#160;$<?php echo $shipping_total?></label></b></td>
									<td colspan='1' class='big-font'></td>
									<td colspan='1' class='big-font'><p>-$<?php echo $deduction_total?></p></td>
									<td colspan='1' class='big-font'><p class='totalnet-cont'>$<?php echo $net_total + $shipping_total?></p></td>
								</tr>
							</table>
						</div>

					</div>

				</div>


				<?php 
					  $orr_detail = false;
					  if($bt->bsd_status == 1 || $bt->bsd_status == -4 || $bt->bsd_status == -3) {?>
				<?php if($bt->bsd_status == -3){ $orr_detail =  $this->suppliers->orr_detail($bt->bsd_id); } 

					$refund_val_reason = "";
					$refund_memo = "";
					$refund_product = 0;
					$refund_shipping = 0;
					$total_refund  = 0;

					if($orr_detail != false)
					{
						$refund_val_reason = $orr_detail->orr_reason;
						$refund_memo = $orr_detail->orr_memo;
						$refund_product =  $orr_detail->orr_prod_amnt;
						$refund_shipping =  $orr_detail->orr_ship_amnt;
						$total_refund = $refund_product+$refund_shipping;
					}

					?>
				<div class='right-inner clearfix'>
					<!-- First Row Container-->
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'>Refund Order</p>
					</div>

					<script type="text/javascript">
						function submit_refund(){
							if (confirm('are you sure to refund the order? \n press [OK] to send refund order or press [Cancel] to cancel refund order?'))
							{
								
								var product_refund = $('#ref-prod').val();
								var product_shipping = $('#ref-ship').val(); 
								var reason = $('#ref-reason').val(); 
								var memo = $('#ref-memo-buyer').val();
								$.post('<?php echo base_url()?>supplier/refund/<?php echo $bt->bsd_id ?>',{
									product_refund:product_refund,product_shipping:product_shipping,reason:reason,memo:memo,
									bsd:<?php echo $bt->bsd_id ?>,action:'save'},
									function(value){
										window.location.reload();
										//alert(value);

								});
						    }
						} 
						$(window).load(function() {

							$('#ref-prod, #ref-ship').keyup(function(){
								var total_refund = parseFloat($('#ref-prod').val())+parseFloat($('#ref-ship').val());
								$('.total_refund').html("$"+total_refund);
							});

						});
					</script>


					<div class='padded-cont clearfix'>
						<div class='fl'>
							<label for='ref-reason'>Reason:</label>
							<select class='normal-format-select' id='ref-reason'>
								<?php foreach($refund_lists as $ref){?>
								<option <?php if($refund_val_reason == $ref->or_name){echo "selected='selected'";} ?> value="<?php echo $ref->or_name?>"><?php echo $ref->or_name?></option>
								<?php }?>
							</select>
						</div>	
						<div class='clear'></div>
						<div class='violet-table'>
							<table>
								<tr>
									<td></td>
									<td>Order Amount</td>
									<td>Prior Refund</td>
									<td>Amount Refund</td>
									<td>Max Amount</td>
								</tr>
								<tr>
									<td>Product</td>
									<td>$<?php echo $bt->bsd_total_paymet; ?></td>
									<td><span class='red'><center>($0.00)</center></span></td>
									<td><input tpe='text' value='<?php echo $refund_product ?>' id='ref-prod' placeholder="0" onfocus="this.placeholder = ''" onblur="this.placeholder = '0'" /></td>
									<td>$<?php echo $bt->bsd_total_paymet; ?></td>
								</tr>
								<tr>
									<td>Shipping</td>
									<td>$<?php echo $shipping_total; ?></td>
									<td><span class='red'><center>($0.00)</center></span></td>
									<td><input tpe='text' value='<?php echo $refund_shipping ?>' id='ref-ship' placeholder="0" onfocus="this.placeholder = ''" onblur="this.placeholder = '0'" /></td>
									<td>$<?php echo $shipping_total; ?></td>
								</tr>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td><span class='total_refund'>$<?php echo $total_refund ;?></span></td>
									<td></td>
								</tr>

							</table>
						</div>
						<div class='clear'></div>
						<div class='clearfix padded-cont'>

							<label for='ref-memo-buyer'>Memo to Buyer:</label>
							<textarea id='ref-memo-buyer' class='normal-format-text full-ta'><?php echo $refund_memo; ?></textarea>

						</div>
						<div class='clear'></div>
						<button class='normal-button fr' id='submit-cancel-shipping' onclick="submit_refund()" >SUBMIT REFUND ORDER</button>
					</div>

				</div>
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



			</div>

   		</div>
		<div class="bg-body-bottom"> </div>
	</div>  

</div>


<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>js/jquery.raty.min.js"></script>
<?php echo $this->load->view('supplier/footer') ?>
