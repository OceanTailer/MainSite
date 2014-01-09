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

			<!-- RIGHT CONTENT CONTAINER-->
			<div class='right-cont clearfix fr'>
				<h4 class="fl">Supplier Profile:</h4>
				<div class="clear"> </div>
					<div class='orange-table'>
						<table width="100%">
							<tr>
								<td colspan="3">Basic Information</td>
							</tr>
							<tr>
								<td width="15%">Supplier Name</td>
								<td width="2%">:</td>
								<td><?php echo $supplier_profile->u_fname.' '.$supplier_profile->u_lname; ?></td>
							</tr>
							<tr>
								<td>Email</td>
								<td>:</td>
								<td><?php echo $supplier_profile->u_email; ?></td>
							</tr>
							<tr align="center">
								<td colspan="3">Billing Address</td>
							</tr>
							<tr>
								<td>Address 1</td>
								<td>:</td>
								<td><?php echo $supplier_profile->ba_add1; ?></td>
							</tr>
							<tr>
								<td>Address 2</td>
								<td>:</td>
								<td><?php echo $supplier_profile->ba_add2; ?></td>
							</tr>
							<tr>
								<td>City</td>
								<td>:</td>
								<td><?php echo $supplier_profile->ba_city; ?></td>
							</tr>
							<tr>
								<td>Province</td>
								<td>:</td>
								<td><?php echo $supplier_profile->ba_province; ?></td>
							</tr>
							<tr>
								<td>Postal Code</td>
								<td>:</td>
								<td><?php echo $supplier_profile->ba_postal; ?></td>
							</tr>
							<tr>
								<td>Phone No.</td>
								<td>:</td>
								<td><?php echo $supplier_profile->ba_phone_num; ?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>

		<!-- MIDDLE PAGE CONTAINER-->
		</div>
		<div class="bg-body-bottom"> </div>
	</div>

</div>

<?php echo $this->load->view('admin/footer') ?>