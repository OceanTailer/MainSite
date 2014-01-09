<!-- Lanz Editted -->
<?php echo $this->load->view('supplier/header') ?>
<div class="global-cont">

	<div class='bg-body'>
		<div class="bg-body-top"> </div>
		<div class="bg-body-middle clearfix">
		<!-- MIDDLE PAGE CONTAINER-->
			<!-- LEFT SIDEBAR CONTAINER-->
			<div id="left-sidebar" class="clearfix fl">
				<?php echo $this->load->view('supplier/sidebar');?>
			</div>
			<!-- RIGHT CONTENT CONTAINER-->
			<div class='right-cont clearfix fr'>
				<div class='right-inner clearfix'>
					<!-- First Row Container-->
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'>Update Password</p>
					</div>
					<div class='padded-cont'>
						<div class='informative-format fl'>
							<div>
								<table>
									<tr>
										<td><p><span>Current Password</span></p></td>
										<td>&nbsp;&nbsp;:</td>
										<td><input type="password" name="curr_pass" id="curr_pass" class='normal-format-text'></td>
									</tr>
									<tr>
										<td><p><span>New Password</span></p></td>
										<td>&nbsp;&nbsp;:</td>
										<td><input type="password" name="new_pass" id="new_pass" class='normal-format-text'></td>
									</tr>
									<tr>
										<td><p><span>Confirm New Password</span></p></td>
										<td>&nbsp;&nbsp;:</td>
										<td><input type="password" name="new_pass1" id="new_pass1" class='normal-format-text'></td>
									</tr>
									<tr>
										<td><input type="button" name="update-supplier-password" id='update-supplier-password' value='UPDATE' class='normal-button' /></td>
									</tr>
								</table>
								<!-- <p><span>Current Password:</span></p><input type="password" name="curr_pass" id="curr_pass"> -->
							</div>
							<!-- <div>
								<p><span>New Password:</span></p><input type="password" name="new_pass" id="new_pass">
							</div>
							<div>
								<p><span>Confirm New Password:</span></p><input type="password" name="new_pass1" id="new_pass1">
							</div> -->
						</div>
					</div>
				</div>
			</div>
			<div class='validate-result'>
			</div>
		</div>

		<!-- MIDDLE PAGE CONTAINER-->
		</div>
		<div class="bg-body-bottom"> </div>
	</div>
	<script language="javascript">
	$("#update-supplier-password").click(
		function()
		{
			var curr_pass = $("#curr_pass").val();
			var new_pass = $("#new_pass").val();
			var new_pass1 = $("#new_pass1").val();

			$.post("<?php echo base_url() ?>supplier/passwordupdate",
					{curr_pass:curr_pass, new_pass:new_pass, new_pass1:new_pass1, action:"update"},
					function(result)
					{
						var convert = JSON.parse(result);
						if (result.status == 1)
						{
							alert("Must provide new password");
							$('.validate-result').hide();
							$('.validate-result').html(convert.message);
							$('.validate-result').show();
						}
						else if (result.status == 2)
						{
							alert("Password Update Successfully");
							$('.validate-result').hide();
							$('.validate-result').html(convert.message);
							$('.validate-result').show();
						}
						else if (result.status == 0)
						{
							alert("Password does not match");
							$('.validate-result').hide();
							$('.validate-result').html(convert.message);
							$('.validate-result').show();
						}
					}
				);
		});
	</script>
</div>

<?php echo $this->load->view('supplier/footer') ?>