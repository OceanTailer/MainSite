<?php echo $this->load->view('admin/header') ?>
<div class="global-cont">

	<div class='bg-body'>
		<div class="bg-body-top"> </div>
		<div class="bg-body-middle clearfix">
		<!-- MIDDLE PAGE CONTAINER-->

			<!-- LEFT SIDEBAR CONTAINER-->
			<div id="left-sidebar" class="clearfix fl">
				<?php echo $this->load->view('admin/sales/sidebar') ?>
			</div>

			<!-- RIGHT CONTENT CONTAINER-->
			<div class='right-cont clearfix fr'>
				<?php $has_permission = $this->administrators->check_permission($this->session->userdata('id'),3);?>
				<?php if($has_permission){ ?>
				<div class='right-inner clearfix'>
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'> Supplier Sales Detail </p>
					</div>
					<div class='clearfix product-cont padded-cont '>
						<div class='half fl'>
							<p>Fullname: <span> <?php echo $info->u_fname.' '.$info->u_lname?></span></p>
						</div>
						<div class='half fl'>
							<p>Company: <span> <?php echo $info->u_company?></span></p>
						</div>
						<div class='half fl'>
							<p>Permit: <span> <?php echo $info->u_permit?></span></p>
						</div>
						<div class='half fl'>
							<p>Email: <span> <?php echo $info->u_email?></span></p>
						</div>
						<div class='half fl'>
							<p>Company: <span> <?php echo $info->u_company?></span></p>
						</div>
					</div>
					<div class='clear'></div>
					<div class="hr-orange"></div>
					
					<div class='product-cont padded-cont'>
						<h3>Bank Account Info</h3>
						<div class='half fl'>
							<p>Account Name: <span> <?php echo $info->bnk_owner?></span></p>
						</div>
						<div class='half fl'>
							<p>Bank Name: <span> <?php echo $info->bnk_name?></span></p>
						</div>
						<div class='half fl'>
							<p>Account Number: <span> <?php echo $info->bnk_account?></span></p>
						</div>
						<div class='half fl'>
							<p>Bank Code: <span> <?php echo $info->bnk_id_code?></span></p>
						</div>
					</div>


				</div>

				<div class='right-inner clearfix'>
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'> Payment History </p>
					</div>
					<div class='padded-cont'>
						<div class='gray-table'>
							<table>
								<tr>
									<td>Amount</td>
									<td>Date</td>
									<td>Bank Name</td>
									<td>Bank Account</td>
								</tr>
	 							<?php 
	 								$total_payment = 0;
	 								if(count($payment_history) != 0){?>
									<?php foreach($payment_history as $history){
										$payment_setting = json_decode($history->asp_value_send);
										?>
										<tr>
											<td>$<?php echo $history->asp_amount?></td>
											<td><?php echo date('M d, Y H:i:s',$history->asp_date); ?></td>
											<td><?php echo $payment_setting->bank_name ?></td> 
											<td><?php echo $payment_setting->bank_acct_num ?></td>
										</tr>
									<?php }?>
								<?php }else{?>
									<tr>
										<td colspan='7'><center>No Payment Record Yet</center></td>
									</tr>
								<?php }?>
							</table>
						</div>

					</div>

				</div>

				<div class='right-inner clearfix'>
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'> Pending Send Payment </p>
					</div>
					<div class='padded-cont'>
						<div class='gray-table'>
							<table>
								<tr>
									<td>Invoice</td>
									<td>Date</td>
									<td>Quantity</td>
									<td>Amount</td>
									<td>Commission</td>
									<td>Net Amount</td>
								</tr>
	 							<?php 
	 								$total_payment = 0;
	 								if(count($sales_detail) != 0){?>
									<?php foreach($sales_detail as $sales){?>
										<tr>
											<td><?php echo $sales->bt_invoice?></td>
											<td><?php echo date('M d, Y H:i:s',$sales->bt_time); ?></td>
											<td><?php echo $sales->bsd_total_item?></td> 
											<td>$<?php echo $sales->bsd_total_paymet?></td>
											<td><?php echo $percent = $this->suppliers->total_fee_transaction($sales->u_supplier,$sales->bsd_id) ?>%</td>	
											<td>$<?php echo $payment_gross= $sales->bsd_total_paymet - ($sales->bsd_total_paymet * ($percent /  100)); ?></td>
											<?php $total_payment +=  $payment_gross; ?>	
										</tr>
									<?php }?>
								<?php }else{?>
									<tr>
										<td colspan='7'><center>No Sales Yet</center></td>
									</tr>
								<?php }?>
							</table>
						</div>

					</div>

				</div>

				<?php }else{?>
					<?php echo $this->load->view('admin/permission-error') ?>
				<?php }?>

				<script type="text/javascript">

					$('#send-payment').click(function(){

						var bnk = <?php echo $info->bnk_id?>;
						var total_payment = <?php echo $total_payment?>;
						var supplier_id = <?php echo $info->u_id?>;


						$.post("<?php echo base_url()?>authorized/send_payment",{bnk:bnk,total_payment:total_payment,supplier_id:supplier_id},function(result){
							$('#result-payment').html(result);
						});

					});

				</script>

					

			</div>

		<!-- MIDDLE PAGE CONTAINER-->
		</div>
		<div class="bg-body-bottom"> </div>
	</div>

</div>

<?php echo $this->load->view('admin/footer') ?>