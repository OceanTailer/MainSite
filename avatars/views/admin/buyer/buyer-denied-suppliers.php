<!-- Lanz Editted -->
<?php echo $this->load->view('admin/header') ?>
<div class="global-cont">

	<div class='bg-body'>
		<div class="bg-body-top"> </div>
		<div class="bg-body-middle clearfix">
		<!-- MIDDLE PAGE CONTAINER-->

			<!-- LEFT SIDEBAR CONTAINER-->
			<div id="left-sidebar" class="clearfix fl">
				<?php echo $this->load->view('admin/buyer/buyer-sidebar') ?>
			</div>
			<?php $has_permission = $this->administrators->check_permission($this->session->userdata('id'),6);?>

			<!-- RIGHT CONTENT CONTAINER-->
			<div class='right-cont clearfix fr'>
				<?php if($has_permission){?>
				<div class='right-inner clearfix'> 
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'>Denied Buyer List:</p>
					</div>

					<div class="clear"> </div>
					<div class='padded-cont'>
						<div class='violet-table'>
							<table width="100%">
								<tr align="center">
									<td>Supplier Name</td>
									<td>Contact</td>
									<td>Country</td>
								</tr>
								<?php foreach ($denied_buyers as $denied_sup) {?>
								<tr align="center">
									<td><?php echo $denied_sup->u_lname.', '.$denied_sup->u_fname; ?></td>
									<td><?php echo $denied_sup->ba_phone_num; ?></td>
									<td><?php echo $denied_sup->ba_province.', '.$denied_sup->ba_city; ?></td>
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