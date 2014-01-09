<?php echo $this->load->view('header')?>

<div class="global-cont">

	<div class='bg-body'>
		<div class="bg-body-top"> </div>
		<div class="bg-body-middle clearfix">
		<!-- MIDDLE PAGE CONTAINER-->

			<div class="inner-body-page clearfix">

				<!-- FULL CONTENT CONTAINER-->
				<div class='full-cont clearfix fr'>

					<div class="padded-cont normal-format">
						<h4>Basic Information</h4>
						<?php echo form_open('buyer/add'); ?>
						<div class='fl'>
							<div>	
								<div class='medium'>
									<label for='firstname'>First Name*</label>	
									<div class='clear'></div>
									<input type='text' id='firstname' name="firstname" /> 
								</div>
								<div class="fl">
									<label for='lastname'>Last Name*</label>
									<div class='clear'></div>
									<input type='text' id='lastname' name="lastname" />
								</div>
							</div>	

							<div class='medium'>	
								<label for='username'>Username*</label>
								<div class='clear'></div>
								<input type='text' id='username' name="username" />
							</div>
						

							<div class='medium'>
								<label for='email'>Email*</label>
								<div class='clear'></div>
								<input type='text' id='email' name="email" />
							</div>
						</div>

						<div class='fl'>
							<div class='medium'>
								<label for='company'>Company*</label>
								<div class='clear'></div>
								<input type='text' id='company' />
							</div>
							<div class='permit'>
								<label for='feid'>FEID/Business Number/VAT Registration Number*</label>
								<div class='clear'></div>
								<input type='text' id='permit' />
							</div>
							<div>
								<label for='pass'>Password*</label>
								<div class='clear'></div>
								<input type='password' id='pass' name="password" />
							</div>

							<div>
								<label for='conpass'>Confirm Password*</label>
								<div class='clear'></div>
								<input type='password' id='conpass' name="conpass" />
							</div>
						</div>

						<div class='clear'></div>

						<h4>Credit Card Information</h4>

						<div class='clearfix fl'>
							<label for='cctype'>Credit Card Type*</label>
							<div class='clear'></div>
							<select id='cctype' class='medium' name="cctype">
								<?php 
								foreach($creditcards as $creditcard){?> 
									<option value="<?php echo $creditcard->cc_id?>"><?php echo $creditcard->cc_type?></option>
								<?php }?>
							</select>
						</div>

						<div class='clearfix fl'>
							<label for='ccuname'>Cardholder's Name*</label>
							<div class='clear'></div>
							<input type='text' id='ccuname' name="ccuname" />
						</div>

						<div class='clearfix fl'>
							<label for='ccunum'>Credit Card Number*</label>
							<div class='clear'></div>
							<input type='text' id='ccunum' name="ccunum" />
						</div>

						<div class='clearfix fl'>
							<label for='ccuccv'>CCV*</label>
							<div class='clear'></div>
							<input type='text' class='small' id='ccuccv' name="ccuccv" />
						</div>

						<div class='clearfix fl'>
							<label for='exp_month'>Expiration Date*</label>
							<div class='clear'></div>
							<select id='exp_month' class='medium' name="exp_month">
								<?php echo $this->creditcards->generate_months('option'); ?>
							</select>
							<select id='exp_year' class='small' name="exp_year">
								<?php 
								$year_set = date('Y', strtotime('+7 year'));
								echo $this->creditcards->generate_years($year_set,date('Y')); ?>
							</select>
						</div>

						<div class='clear'></div>

						<h4>Billing Address</h4>

						<div>
							<label for='country'>Country*</label>
							<div class='clear'></div>
							<select id='country' name="country">
							<?php 
							foreach($countries as $country){?> 
								<option <?php  if( $countr_sel+"" == $country->c_id){ ?> selected="selected" <?php }?> value="<?php echo $country->c_id?>"><?php echo $country->c_name?></option>
							<?php }?>
							</select>
						</div>

						<div>
							<label for='address1'>Address 1*</label>
							<div class='clear'></div>
							<input type='text' class='longer' id='address1' name="address1" />
						</div>

						<div>
							<label for='address2'>Address 2</label>
							<div class='clear'></div>
							<input type='text' class='longer' id='address2' name="address2" />
						</div>

						<div>
							<label for='city'>City/Town*</label>
							<div class='clear'></div>
							<input type='text' class='long' id='city' name="city" />
						</div>

						<div id='drp-state'>
							<label for='state_dropdown'>Province/Region/State*</label>
							<div class='clear'></div>
							<select id='state_dropdown' name="state_dropdown">
								<?php 
								foreach($states as $state){?> 
									<option value="<?php echo $state->st_name?>"><?php echo $state->st_name?></option>
								<?php }?>
							</select>
						</div>
						<div id='state-textbox'>
							<label for='province'>Province/Region/State*</label>
							<div class='clear'></div>
							<input type='text' class='long' id='province' />
						</div>
						<div>
							<label for='postal_code'>Postal Code/Zip Code*</label>
							<div class='clear'></div>
							<input type='text' id='postal_code' name="postal_code" />
						</div>

						<div>
							<label for='phone_num'>Phone Number*</label>
							<div class='clear'></div>
							<input type='text' id='phone_num' name="phone_num" />+<input type='text' class='small no-margin' id='phone_ext' name="phone_ext" />
						</div>

						<div class='clear'></div>
						<center><a href="#">Accept Terms and Condition</a><input type='checkbox' id='terms_aggrement' /></center>
						<center><input type='button' name="submit-buyer" id='submit-buyer' value='SUBMIT' class='normal-button' /></center>
						<div class='validate-result'>
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

	var is_state = true;
	
	$('#state-textbox').hide();

	$('#submit-buyer').click(function(){
		var firstname = $('#firstname').val();
		var lastname = $('#lastname').val();

		var uname = $('#username').val(); 
		var email = $('#email').val();
		var company = $('#company').val();
		var permit = $('#permit').val();		

		var pass = $('#pass').val();
		var conpass = $('#conpass').val();

		var cctype = $('#cctype').val();
		var ccuname = $('#ccuname').val();
		var ccunum = $('#ccunum').val(); 
		var ccuccv = $('#ccuccv').val();
		var exp_month = $('#exp_month').val();
		var exp_year = $('#exp_year').val();

		var country = $('#country').val();
		var add1 = $('#address1').val();
		var add2 = $('#address2').val();
		var city = $('#city').val();

		var prov = '';
		if(is_state)
			prov = $('#state_dropdown').val();
		else
			prov = $('#province').val();

		var postal = $('#postal_code').val();
		var phone_num = $('#phone_num').val();
		var phone_ext = $('#phone_ext').val();
		
		var is_checked = $('#terms_aggrement').is(":checked");

		if(is_checked)
			$.post("<?php echo base_url()?>buyer/add",{firstname:firstname,lastname:lastname,uname:uname,email:email,company:company,permit:permit,pass:pass,conpass:conpass,
			cctype:cctype,ccuname:ccuname,ccunum:ccunum,ccuccv:ccuccv,exp_month:exp_month,exp_year:exp_year,country:country,add1:add1,add2:add2,city:city,prov:prov,postal:postal,phone_num:phone_num,phone_ext:phone_ext,
			action:'register'},function(result){

				var  convert = JSON.parse(result);

				$('.validate-result').hide();
				$('.validate-result').html(convert.message);
				$('.validate-result').show();
				setSizesDynamic();
	
			});

		
	});

	$('#country').change(function(){
		var country_sel = this.value;

		$.post("<?php echo base_url()?>country/load",{id:country_sel,type:'dropdown'},function(result){
		
			if(result != 0)
			{
				$('#state_dropdown').html(result);
				$('#drp-state').fadeIn();
				$('#state-textbox').hide();
				is_state = true;
			}
			else
			{
				is_state = false;
				$('#state-textbox').fadeIn();
				$('#drp-state').hide();
			}
		});
	});

	function setSizesDynamic(){

	   var containerHeight = $(".full-cont").height();
	   $(".bg-body-middle").height(containerHeight - 158);
	}

</script>

<?php echo $this->load->view('footer')?>