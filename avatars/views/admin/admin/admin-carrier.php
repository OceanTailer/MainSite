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

			<?php $has_permission = $this->administrators->check_permission($this->session->userdata('id'),11);?>

			<!-- RIGHT CONTENT CONTAINER-->
			<div class='right-cont clearfix fr'>
				<?php if($has_permission){?>
				<div class='right-inner clearfix'> 
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'>Carriers List</p>
					</div>
					<div class="clear"> </div>
					<div class='padded-cont'>
						<div class='orange-table'>
							<table width="100%">
								<tr>
									<td width="80%">Name</td>
									<td>Options</td>
								</tr>
								<?php foreach ($carriers as $carrier) { ?>
								<tr>
									<td><?php echo $carrier->sc_name  ?></td>
									<td>
										<!-- Lanz Editted - August 12, 2013 -->
										<a href="<?php echo base_url() ?>carrier/carrierinfo/<?php echo $carrier->sc_id ?>">Edit</a>,
										<a href="<?php echo base_url() ?>carrier/assign/<?php echo $carrier->sc_id ?>">Assign</a>,
										<!-- Lanz Editted - August 12, 2013 -->
										<a href="<?php echo base_url() ?>carrier/deletecarrier/<?php echo $carrier->sc_id ?>">Delete</a></td>
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