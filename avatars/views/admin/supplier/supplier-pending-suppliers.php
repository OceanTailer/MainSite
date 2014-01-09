<!-- Lanz Editted -->
<?php echo $this->load->view('admin/header') ?>

<!--<?php echo print_r($pending_suppliers); ?>-->

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
				<h4 class="fl">Pending Suppliers:</h4>
				<div class="clear"> </div>
				<div class='orange-table'>
					<table width="100%">
						<tr align="center">
							<td>Supplier Name</td>
							<td>Contact</td>
							<td>Country</td>
							<td>Action</td>
						</tr>
						<?php foreach ($pending_suppliers as $pending_sup) {?>
						<tr align="center">
							<td><?php echo $pending_sup->u_lname.', '.$pending_sup->u_fname; ?></td>
							<td><?php echo $pending_sup->ba_phone_num; ?></td>
							<td><?php echo $pending_sup->ba_province.', '.$pending_sup->ba_city; ?></td>
							<td align="center">
								<input type="hidden" value="<?php echo $pending_sup->u_id; ?>">&nbsp;
								<a href="<?php echo base_url()?>supplier/update/<?php echo $pending_sup->u_id; ?>/approved"><input type="button" value="Approve"></a>&nbsp;
								<a href="<?php echo base_url()?>supplier/update/<?php echo $pending_sup->u_id; ?>/denied"><input type="button" value="Deny"></a>
							</td>
						</tr>
						<?php } ?>
					</table>
				</div>
			</div>

		<!-- MIDDLE PAGE CONTAINER-->
		</div>
		<div class="bg-body-bottom"> </div>
	</div>

</div>

<?php echo $this->load->view('admin/footer') ?>