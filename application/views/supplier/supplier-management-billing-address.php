<!-- Lanz Editted -->
<?php echo $this->load->view('supplier/header') ?>
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
						<p class='breadcrumbs fl'>Manage Billing Address</p>
					</div>
					<div class='padded-cont'>
						<a  class='fr' href="<?php echo base_url()?>supplier/billing/add">Add</a>
						<div class="clear"> </div>
						<div class='gray-table table-margin'>
							<table>
								<tr>
									<td>Address</td>
									<td>Country</td>
									<td>City</td>
									<td>Postal</td>
									<td width=120>Options</td>
								</tr>
								<?php foreach($billing_address as $billing){?>
								<tr>
									<td><?php echo $billing->ba_add1?></td>
									<td><?php echo $billing->c_name?></td>
									<td><?php echo $billing->ba_city?></td>
									<td><?php echo $billing->ba_postal?></td>
									<td>
										<center>
										<a href="<?php echo base_url() ?>supplier/billing/update/<?php echo $billing->ba_id?>">Update</a>,
										<a href="<?php echo base_url() ?>supplier/billing/delete/<?php echo $billing->ba_id?>">Delete</a>,
										<?php 
										if ($billing->ba_isset == 1){
										}
										else
										{
											echo '<a href='.base_url().'supplier/billing/setactive/'.$billing->ba_id.'/'.$billing->u_id.'>Set</a>';
										}
										?>
										</center>
										<input type="hidden" value="<?php echo $billing->ba_id ?>">
										<input type="hidden" value="<?php echo $billing->u_id ?>">
									</td>
								</tr>	
								<?php }?>
							</table>
						</div>
					</div>
				</div>
			</div>

		<!-- MIDDLE PAGE CONTAINER-->
		</div>
		<div class="bg-body-bottom"> </div>
	</div>

</div>
<?php echo $this->load->view('supplier/footer') ?>