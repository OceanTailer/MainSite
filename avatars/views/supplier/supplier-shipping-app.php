<!-- Lanz Editted -->
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
						<p class='breadcrumbs fl'> Shipping Request </p>
					</div>

					<?php  //echo print_r($pending);?>
					<div class='violet-table'>
						<table>
							<tr>
								<td width=55>Date Order</td>
								<td>Invoice</td>
								
								<td>Buyer</td>

								<td width=15>Billing Country</td>
								<td width=15>Total Item</td>
								<td>Total Amount</td>
								<td>Action</td>
							</tr>
							<?php if(count($app) != 0){?>
								<?php foreach($app as $apprv){?>
									<tr>
										<td><center><?php echo date('M d, Y H:i:s',$apprv->bt_time); ?></center></td>
										<td>
											<div><?php echo $apprv->bt_invoice?></div>
										</td>
										<td><center><p><?php echo $apprv->u_fname.' '.$apprv->u_lname?></p></center></td>
										<td><center><?php echo $apprv->c_code?></center></td>
										<td><center><?php echo $apprv->total_quan?></center></td> 
										<td>$<?php echo $apprv->total_amount?></td>
										<td>
											<center>
<!-- 												<a href="#" onclick='confirm_shipping(<?php echo $pend->btd_id?>)' >Confirm</a>,
												<a href="">Decline</a>, -->
												<a href="<?php echo base_url()?>supplier/order/<?php echo $apprv->bt_id ?>/1" >Order Detail</a>
											</center>
										</td>
									</tr>
								<?php }?>
							<?php }else{?>
								<tr>
									<td colspan='7'><center>No Shipping Request Yet</center></td>
								</tr>
							<?php }?>
						</table>
					</div>

				</div>
			</div>

		<!-- MIDDLE PAGE CONTAINER-->
		</div>
		<div class="bg-body-bottom"> </div>
	</div>

</div>

<?php echo $this->load->view('supplier/footer') ?>