<?php echo $this->load->view('admin/header') ?>
<div class="global-cont">

	<div class='bg-body'>
		<div class="bg-body-top"> </div>
		<div class="bg-body-middle clearfix">
		<!-- MIDDLE PAGE CONTAINER-->

			<!-- LEFT SIDEBAR CONTAINER-->
			<div id="left-sidebar" class="clearfix fl">
				<?php echo $this->load->view('admin/sidebar') ?>
			</div>

			<!-- RIGHT CONTENT CONTAINER-->
			<div class='right-cont clearfix fr'>

				<div class='right-inner clearfix'>
					<!-- First Row Container-->
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'>My Profile </p>
					</div>

					<div class='padded-cont'>

						<div class='profile-cont fl'>
							<div class="user-icon">
								<?php if($info->u_pic != ""){?>
								<img src="<?php echo base_url().$info->u_pic?>" width=100%>
								<?php }else{ ?>
								<img src="<?php echo base_url()?>images/avatar.jpg" width=100%>
								<?php }?>
							</div>
							<a href="<?php echo base_url()?>user/upload_profile">Upload Image</a>					
						</div>

						<div class='informative-format fl'>
							<div>
								<p><span>Full Name:</span> <?php echo $info->u_fname.' '.$info->u_lname ?></p>
							</div>
							<div>
								<p><span>Email:</span> <?php echo $info->u_email ?></p>
							</div>
						</div>
					</div>
				</div>

				<div class='right-inner' style='min-height:215px'>
					<!-- First Row Container-->
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'>Permission List:</p>
					</div>


					<div class='padded-cont'>
						<div class='violet-table'>
							<table width="100%">
								<tr>
									<td>Permission</td>
								</tr>
								<?php if($info->u_superAdmin == 1){?>
								<tr>									
									<td><center><p>Super Admin Set</p></center></td>
								</tr>
								<?php }?>
								<?php foreach ($assigned_permission as $permission) { ?>
								<tr>
									<td><p><?php echo $permission->p_name ?></p></td>
								</tr>
								<?php } ?>
							</table>
						</div>
					</div>


				</div>

			</div>



		</div>
		<!-- MIDDLE PAGE CONTAINER-->
		</div>
		<div class="bg-body-bottom"> </div>
	</div>

</div>

<?php echo $this->load->view('admin/footer') ?>