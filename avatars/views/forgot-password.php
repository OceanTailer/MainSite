<?php
		echo $this->load->view('header');
?>

<div class="global-cont">

	<div class='bg-body'>
		<div class="bg-body-top"> </div>
		<div class="bg-body-middle clearfix">
		<!-- MIDDLE PAGE CONTAINER-->

			<div class="inner-body-page clearfix">

				<!-- LEFT SIDEBAR CONTAINER-->
				<div id="left-sidebar" class="clearfix fl">

				<?php echo $this->load->view('sidebar')?>

				</div>
				<!-- LEFT SIDEBAR CONTAINER-->

				<!-- RIGHT CONTENT CONTAINER-->
				<div class='right-cont clearfix fr'>

					<div class='right-inner clearfix'> 
						<div class="heading-inner-right"> 
							<p class='breadcrumbs fl'>Forgot Password</p>
						</div>

						<div class='padded-cont'>
							<div class='informative-format fl'>
								<div>
									<table>
										<tr>
											<td colspan="3"><p>Forgot your password? Enter your email address below to send you your new password.</p></td>
										</tr>
										<tr>
											<td colspan="3"><br></td>
										</tr>
										<tr>
											<td><p><span>Email</span></p></td>
											<td>&nbsp;&nbsp;:</td>
											<td><input type="email" class="normal-format-text" name="email" id="email"></td>
										</tr>
										<tr>
											<td><button class='normal-button' id='new-pass'> SUBMIT</button></td>
										</tr>
									</table>
								</div>
								<div>
									<p class='result-pass'></p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- RIGHT CONTENT CONTAINER-->

			</div>

		<!-- MIDDLE PAGE CONTAINER-->
		</div>
		<div class="bg-body-bottom"> </div>
	</div>

</div>

<script type="text/javascript">
	
	$('#new-pass').click(function(){
		var email = $('#email').val();
		$.post('<?php echo base_url()?>user/forgot',{email:email},function(result){
			/*alert(result);*/
			var  convert = JSON.parse(result);
			if (convert.status == 1)
			{
				$('.result-pass').hide();
				$('.result-pass').html(convert.message);
				$('.result-pass').show();
				$('#email').val("");
			}
			else if (convert.status == 0)
			{
				$('.result-pass').hide();
				$('.result-pass').html(convert.message);
				$('.result-pass').show();
			}
		});
	});


</script>

<?php
	echo $this->load->view('footer');
?>