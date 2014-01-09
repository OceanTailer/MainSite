<!-- Lanz Editted - June 10, 2013 -->
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
				<?php $has_permission = $this->administrators->check_permission($this->session->userdata('id'),1);?>
				<?php if($has_permission){ ?>
				<div class='right-inner clearfix'> 

					
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'>Admnistrator List</p>
					</div>

					<div class='padded-cont'>
						<div class='violet-table'>
							<table width="100%">
								<tr>
									<td width="20%">Name</td>
									<td width="30%">Email</td>
									<td width="10%">Status</td>
									<?php if($has_permission){ ?>
										<td>Options</td>
									<?php } ?>
								</tr>
								<?php foreach ($administrators as $admins) { ?>
								<tr>
									<td><?php echo $admins->u_fname.' '.$admins->u_lname; ?><input type="hidden" value="<?php echo $admins->u_id ?>"></td>
									<td width="30%"><?php echo $admins->u_email; ?></td>
									<td width="10%">
										<?php if($admins->u_status == 0){ echo 'Block';}elseif($admins->u_status == 1){ echo 'Active';}elseif($admins->u_status == 2){echo 'Block';} ?>
									</td>
									<?php if($has_permission){ ?>
									<td>
										<center>
											<a href="<?php echo base_url() ?>user/profile/<?php echo $admins->u_id ?>">Update Profile</a>,
											<?php if($admins->u_status == 1){?>
												<a href="<?php echo base_url() ?>administrator/block/<?php echo $admins->u_id ?>">Block</a>,
											<?php }elseif($admins->u_status == 2){?>
												<a href="<?php echo base_url() ?>administrator/activate/<?php echo $admins->u_id ?>">Activate</a>,
											<?php }?>
											<a href="<?php echo base_url() ?>administrator/managepermission/<?php echo $admins->u_id ?>">Manage Permission</a>	
										</center>									
									</td>
									<?php } ?>
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