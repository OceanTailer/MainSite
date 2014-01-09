<!-- Lanz Editted - June 12, 2013 -->
<?php echo $this->load->view('admin/header') ?>
<div class="global-cont">

	<div class='bg-body'>
		<div class="bg-body-top"> </div>
		<div class="bg-body-middle clearfix">
		<!-- MIDDLE PAGE CONTAINER-->

			<!-- LEFT SIDEBAR CONTAINER-->
			<div id="left-sidebar" class="clearfix fl">
				<?php echo $this->load->view('admin/admin/admin-sidebar') ?>
			</div>

			<!-- RIGHT CONTENT CONTAINER-->
			<div class='right-cont clearfix fr'>
				<h4 class="fl">Administrators</h4>
				<div class="clear"> </div>
				<div class='orange-table'>
					<table width="100%">
						<tr>
							<td width="80%">Name</td>
							<td>Options</td>
						</tr>
						<?php foreach ($administrators as $admins) { ?>
						<tr>
							<td><?php echo $admins->u_fname.' '.$admins->u_lname; ?><input type="hidden" value="<?php echo $admins->u_id ?>"></td>
							<td><a href="<?php echo base_url() ?>administrator/addpermission/<?php echo $admins->u_id ?>">Add Permission</a></td>
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