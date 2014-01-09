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
						<p class='breadcrumbs fl'>Add Administrator</p>
					</div>
					<div class='padded-cont'>
						<div class='fl half'>
							<label for='track-number'>First Name*</label>
							<div class="clear"> </div>
							<input class='normal-format-text' type="text" id="firstname" name="firstname">
						</div>
						<div class='fl half'>
							<label for='track-number'>Last Name*</label>
							<div class="clear"> </div>
							<input class='normal-format-text' type="text" id="lastname" name="lastname">
						</div>

						<div class='fl half'>
							<label for='track-number'>Username*</label>
							<div class="clear"> </div>
							<input class='normal-format-text' type="text" id="username" name="username">
						</div>

						<div class='fl half'>
							<label for='track-number'>Email*</label>
							<div class="clear"> </div>
							<input class='normal-format-text' type="text" id="email" name="email">
						</div>
						<div class='fl half'>
							<label for='track-number'>Password*</label>
							<div class="clear"> </div>
							<input class='normal-format-text' type="password" id="password" name="password">
						</div>

						<div class='fl half'>
							<label for='track-number'>Confirm Password*</label>
							<div class="clear"> </div>
							<input class='normal-format-text' type="password" id="confirmPassword" name="confirmPassword">
						</div>
						<div class="clear"></div>

						<div class='fr half'>
							<button id="add-new-user" class='fr normal-button'>Add User</button>
						</div>

						<div class="clear"></div>

						<div class='validate-result red'>

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

<script type="text/javascript">
		
		$('#state-textbox').hide();

		$('#add-new-user').click(function(){
				var firstname = $('#firstname').val();
				var lastname = $('#lastname').val();
				var email = $('#email').val();
				var username = $('#username').val();
				var password = $('#password').val();
				var con_pass = $('#confirmPassword').val();

				$.post("<?php echo base_url()?>administrator/addnewuser",{
				firstname:firstname,lastname:lastname,email:email,username:username,password:password,con_pass:con_pass,
				action:'add'},function(result){
					var  convert = JSON.parse(result);

					$('.validate-result').hide();
					$('.validate-result').html(convert.message);
					$('.validate-result').show();
					
					if (convert.status == 1)
					{
						$(window.location).attr('href', "<?php echo base_url() ?>administrator");
					}
				});
		});
</script>

<?php echo $this->load->view('admin/footer') ?>
