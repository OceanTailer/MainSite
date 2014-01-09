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
						<p class='breadcrumbs fl'>Authorized.net Setting</p>
					</div>
					<div class='padded-cont'>

						<div class='clearfix'>
							<label>API LOGIN</label>
							<div class='clear'></div>
							<input class='normal-format-text' type='text' value="<?php echo $settings->auth_apiLogin?>" id='api_login' />
						</div>
						<div class='clearfix'>
							<label>Transaction Key</label>
							<div class='clear'></div>
							<input class='normal-format-text' type='text' value="<?php echo $settings->auth_apiKey?>" id='trans_key' />
						</div>
						<div class='clearfix'>
							<label>Is Sandbox</label>
							<div class='clear'></div>
							<select id='is_sandbox' class='normal-format-text'>
								<option <?php if($settings->auth_apiSandbox == 1){echo "selected='selected'"; } ?> value=1>Yes</option>
								<option <?php if($settings->auth_apiSandbox == 0){echo "selected='selected'"; } ?> value=0>No</option>
							</select>
						</div>
						<button class='normal-button fr' id='update-api-auth'>UPDATE</button>

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
	
	$('#update-api-auth').click(function(){
		var api_login =  $('#api_login').val();
		var api_key =  $('#trans_key').val();
		var is_sandbox =  $('#is_sandbox').val();

		$.post('<?php echo base_url()?>administrator/setting_update/',{action:'authorized', api_login:api_login,api_key:api_key,is_sandbox:is_sandbox},function(result){

		});

	});

</script>

<?php echo $this->load->view('admin/footer') ?>