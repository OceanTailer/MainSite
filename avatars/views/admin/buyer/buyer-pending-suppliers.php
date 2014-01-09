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
				<?php echo $this->load->view('admin/buyer/buyer-sidebar') ?>
			</div>

			<?php $has_permission = $this->administrators->check_permission($this->session->userdata('id'),6);?>

			<?php $has_permupdate_status = $this->administrators->check_permission($this->session->userdata('id'),7);?>

			<!-- RIGHT CONTENT CONTAINER-->
			<div class='right-cont clearfix fr'>
				<?php if($has_permission){?>
				<div class='right-inner clearfix'> 
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'>Pending Buyer List:</p>
					</div>
					<div class="clear"> </div>
					<div class='padded-cont'>
						<div class='violet-table'>
							<table width="100%">
								<tr align="center">
									<td>Supplier Name</td>
									<td>Contact</td>
									<td>Country</td>
									<td><?php if($has_permupdate_status){?>Action<?php }?></td>
								</tr>
								<?php foreach ($pending_buyers as $buyer) {?>
								<tr align="center">
									<td><?php echo $buyer->u_lname.', '.$buyer->u_fname; ?></td>
									<td><?php echo $buyer->ba_phone_num; ?></td>
									<td><?php echo $buyer->ba_province.', '.$buyer->ba_city; ?></td>
									<td align="center">
										<?php if($has_permupdate_status){?>
										<center>		
										<input type="hidden" value="<?php echo $buyer->u_id; ?>">&nbsp;
										<?php if($buyer->u_admin_approve == 2 || $buyer->u_admin_approve == 0 ){?>
											<a class='normal-link' href="<?php echo base_url()?>buyer/update/<?php echo $buyer->u_id; ?>/approved">Approve</a>&nbsp;
										<?php }if($buyer->u_admin_approve == 1 || $buyer->u_admin_approve == 0 ){?>
											<a class='normal-link' href="<?php echo base_url()?>buyer/update/<?php echo $buyer->u_id; ?>/denied">Deny</a>
										<?php }?>
										</center>
										<?php }?>
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