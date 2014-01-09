<!-- Lanz Editted -->
<?php echo $this->load->view('admin/header') ?>
<div class="global-cont">

	<div class='bg-body'>
		<div class="bg-body-top"> </div>
		<div class="bg-body-middle clearfix">
		<!-- MIDDLE PAGE CONTAINER-->

			<!-- LEFT SIDEBAR CONTAINER-->
			<div id="left-sidebar" class="clearfix fl">
				<?php echo $this->load->view('admin/supplier/supplier-sidebar') ?>
			</div>

			<!-- RIGHT CONTENT CONTAINER-->
			<div class='right-cont clearfix fr'>

				<?php $has_permission = $this->administrators->check_permission($this->session->userdata('id'),4);?>

				<?php $has_permupdate_status = $this->administrators->check_permission($this->session->userdata('id'),5);?>

				<?php if($has_permission){?>
				<div class='right-inner clearfix'> 
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'>Supplier List:</p>
					</div>

					<div class='padded-cont'>
						<div class='violet-table'>
							<table>
								<tr align="center">
									<td>Supplier Name</td>
									<td>Contact</td>
									<td>Country</td>
									<td>Action</td>
								</tr>
								<?php foreach ($suppliers as $sup) {?>
								<tr align="center">
									<td><?php echo $sup->u_lname.', '.$sup->u_fname; ?></td>
									<td><?php echo $sup->ba_phone_num; ?></td>
									<td><?php echo $sup->ba_province.', '.$sup->ba_city; ?></td>
									<td align="center">
										<?php if($has_permupdate_status){?>
										<center>
											<input type="hidden" value="<?php echo $sup->u_id; ?>">&nbsp;
											<?php if($sup->u_admin_approve == 2 || $sup->u_admin_approve == 0 ){?>
												<a class='normal-link' href="<?php echo base_url()?>supplier/update/<?php echo $sup->u_id; ?>/approved">Approve</a>&nbsp;
											<?php }if($sup->u_admin_approve == 1 || $sup->u_admin_approve == 0 ){?>
												<a class='normal-link' href="<?php echo base_url()?>supplier/update/<?php echo $sup->u_id; ?>/denied">Deny</a>
											<?php }?>
										</center>
										<?php } ?>
									</td>
									</tr>
								</tr>
								<?php } ?>
							</table>

						</div>
					</div>

				</div>
				<?php }else{?>
					<?php echo $this->load->view('admin/permission-error') ?>
				<?php }?>
			</div>

		<!-- MIDDLE PAGE CONTAINER-->
		</div>
		<div class="bg-body-bottom"> </div>
	</div>

</div>

<?php echo $this->load->view('admin/footer') ?>