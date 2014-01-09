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
						<p class='breadcrumbs fl'>Buyer List:</p>
					</div>
					<div class="clear"> </div>
					<div class='padded-cont'>
						<div class='violet-table'>
							<table width="100%">
								<tr align="center">
									<td>Buyer Name</td>
									<td>Email</td>
									<td>Username</td>
									<td>Action</td>
								</tr>
								<?php foreach ($buyer_listings as $buyer_listing) {?>
								<tr align="center">
									<td><?php echo $buyer_listing->u_fname.' '.$buyer_listing->u_lname; ?></td>
									<td><?php echo $buyer_listing->u_email; ?></td>
									<td><?php echo $buyer_listing->u_username; ?></td>
									<td align="center">
										<center>
										<input type="hidden" value="<?php echo $buyer_listing->u_id; ?>">&nbsp;
										<a href="<?php echo base_url() ?>buyer/profile/admin/<?php echo $buyer_listing->u_id ?>">View Profile</a>
										</center>
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
			</div>

		<!-- MIDDLE PAGE CONTAINER-->
		</div>
		<div class="bg-body-bottom"> </div>
	</div>

</div>

<?php echo $this->load->view('admin/footer') ?>