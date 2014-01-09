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
						<p class='breadcrumbs fl'>Supplier Setting</p>
					</div>
					<div class='padded-cont'>

						<div class='clearfix'>
							<label>Transaction Fee</label>
							<div class='clear'></div>
							<input class='normal-format-text' type='text' value="<?php echo $settings->supplier_selFee?>" id='sup_fee' />
						</div>
						<button class='normal-button fr' id='update-api-sup'>UPDATE</button>

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

<script type="text/javascript">
	
	$('#update-api-sup').click(function(){
		var sup_fee =  $('#sup_fee').val();

		$.post('<?php echo base_url()?>administrator/setting_update/',{action:'supplier_settings', sup_fee:sup_fee},function(result){

		});

	});

</script>

<?php echo $this->load->view('admin/footer') ?>