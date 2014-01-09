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

			<?php $has_permission = $this->administrators->check_permission($this->session->userdata('id'),4);?>

			<!-- RIGHT CONTENT CONTAINER-->
			<div class='right-cont clearfix fr'>

				<?php if($has_permission){?>
				<div class='right-inner clearfix'> 
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'>Approved Supplier:</p>
					</div>

					<div class="clear"> </div>
					<div class='padded-cont'>
						<div class='violet-table'>
							<table width="100%">
								<tr align="center">
									<td>Supplier Name</td>
									<td>Contact</td>
									<td>Country</td>
									<td>Action</td>
								</tr>
								<?php foreach ($approved_suppliers as $approved_sup) {?>
								<tr align="center">
									<td><?php echo $approved_sup->u_lname.', '.$approved_sup->u_fname; ?></td>
									<td><?php echo $approved_sup->ba_phone_num; ?></td>
									<td><?php echo $approved_sup->ba_province.', '.$approved_sup->ba_city; ?></td>
									<!-- Lanz Editted -->
									<td>
										<input type="hidden" value="<?php echo $approved_sup->u_id; ?>">
										<a href="<?php echo base_url() ?>supplier/viewSupplierProfile/admin/<?php echo $approved_sup->u_id ?>">View Profile</a>
									</td>
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