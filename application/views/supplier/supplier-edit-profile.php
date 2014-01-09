<!-- Lanz Editted - June 7, 2013 -->
<?php echo $this->load->view('supplier/header') ?>
<div class="global-cont">

	<div class='bg-body'>
		<div class="bg-body-top"> </div>
		<div class="bg-body-middle clearfix">
		<!-- MIDDLE PAGE CONTAINER-->

			<!-- LEFT SIDEBAR CONTAINER-->
			<div id="left-sidebar" class="clearfix fl">
				<?php echo $this->load->view('supplier/sidebar') ?>
			</div>

			<!-- RIGHT CONTENT CONTAINER-->
			<div class='right-cont clearfix fr'>
				<div class='right-inner clearfix'>
					<!-- First Row Container-->
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'>Edit Buyer Profile</p>
					</div>

					<div class='padded-cont'>
						<div class='fl half'>
							<label for='track-number'>First Name*</label>
							<div class="clear"> </div>
							<input type="text" id="firstname" name="firstname" class='normal-format-text' value="<?php echo $supplier_profile->u_fname; ?>">
						</div>
						<div class='fl half'>
							<label for='track-number'>Last Name*</label>
							<div class="clear"> </div>
							<input type="text" id="lastname" name="lastname" class='normal-format-text'  value="<?php echo $supplier_profile->u_lname; ?>">
						</div>
						<div class='fl half'>
							<label for='track-number'>Email*</label>
							<div class="clear"> </div>
							<input type="text" id="email" name="email" class='normal-format-text'  value="<?php echo $supplier_profile->u_email; ?>">
						</div>
						<div class='fl half'>
							<label for='track-number'>Company*</label>
							<div class="clear"> </div>
							<input type="text" id="comp" name="comp" class='normal-format-text'  value="<?php echo $supplier_profile->u_company; ?>">
						</div> 
						<div class='fl half'>
							<label for='track-number'>FEID/Business Number/VAT Registration Number*</label>
							<div class="clear"> </div>
							<input type="text" id="permit" name="permit" class='normal-format-text'  value="<?php echo $supplier_profile->u_permit; ?>">
						</div>

						<input type="hidden" id="id" name="id" value="<?php echo $supplier_profile->u_id; ?>">
						<div class="clear"> </div>
						<input type="button" name="update-buyer-info" id='update-supplier-info' value='UPDATE PROFILE' class='normal-button fr' />
						<div class="clear"> </div>
						<div class='validate-result'>

						</div>
					</div>

				</div>

				<div class='right-inner clearfix fl'>
					<!-- First Row Container-->
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'>Default Billing Information</p>
					</div>

					<div class='padded-cont'>
						<div class='clear'></div>
						<div class='fl half'>
							<label for='country'>Country*</label>
							<div class='clear'></div>
							<select id='country' name="country" class='normal-format-select'>
							<?php 
							foreach($countries as $country){?> 
								<option <?php  if( $supplier_profile->country_billing == $country->c_id){ ?> selected="selected" <?php }?> value="<?php echo $country->c_id?>"><?php echo $country->c_name?></option>
							<?php }?>
							</select>
						</div>
						<div class='clear'></div>
						<div class='fl half'>
							<label for='track-number'>Address 1</label>
							<div class="clear"> </div>
							<input type="text" id="address1" name="address1" class='normal-format-text longer'  value="<?php echo $supplier_profile->ba_add1; ?>">
						</div>
						<div class='clear'></div>
						<div class='fl half'>
							<label for='track-number'>Address 2</label>
							<div class="clear"> </div>
							<input type="text" id="address2" name="address2" class='normal-format-text longer'  value="<?php echo $supplier_profile->ba_add2; ?>">
						</div>
						<div class='clear'></div>
						<div class='fl half'>
							<label for='track-number'>City</label>
							<div class="clear"> </div>
							<input type="text" id="city" name="city" class='normal-format-text'  value="<?php echo $supplier_profile->ba_city; ?>">
						</div>
						<div class='clear'></div> 
						<div id='drp-state'>
							<label for='state_dropdown'>Province/Region/State*</label>
							<div class='clear'></div>
							<select id='state_dropdown' name="state_dropdown" class='normal-format-select'>
								<?php 
								foreach($states as $state){?> 
									<option <?php  if( $supplier_profile->ba_province == $state->st_name){ ?> selected="selected" <?php }?> value="<?php echo $state->st_name?>"><?php echo $state->st_name?></option>
								<?php }?>
							</select>
						</div>
						<div class='clear'></div> 
						<div class='fl half'  id='state-textbox'>
							<label for='track-number'>Province*</label>
							<div class="clear"> </div>
							<input type="text" id="province" name="province" class='normal-format-text'  value="<?php echo $supplier_profile->ba_province; ?>">
						</div>
						<div class='clear'></div>
						<div class='fl half'>
							<label for='track-number'>Postal Code*</label>
							<div class="clear"> </div>
							<input type="text" id="postal" name="postal" class='normal-format-text'  value="<?php echo $supplier_profile->ba_postal; ?>">
						</div>
						<div class='clear'></div>
						<div class='fl half'>
							<label for='track-number'>Phone Number*</label>
							<div class="clear"> </div>
							<input type="text" id="phone_num" name="phone_num"  class='normal-format-text' value="<?php echo $supplier_profile->ba_phone_num; ?>"> + <input type='text' class='normal-format-text small no-margin' id='phone_ext' name="phone_ext" value="<?php echo $supplier_profile->ba_phone_ext; ?>" />
						</div>
						<div class='clear'></div>
						<button id='update-billing-button' class='normal-button fr'>UPDATE BILLING</button>
						<div class='clear'></div>
						<div class='validate-result-billing'>

						</div>
						<div class='clear'></div>
					</div>

				</div>

				<script type="text/javascript">

					var is_state = true;
					
					$('#state-textbox').hide();

					$('#update-billing-button').click(function(){
							var country = $('#country').val();
							var add1 = $('#address1').val();
							var add2 = $('#address2').val();
							var city = $('#city').val();

							var prov = '';
							if(is_state)
								prov = $('#state_dropdown').val();
							else
								prov = $('#province').val();

							var postal = $('#postal').val();     
							var phone_num = $('#phone_num').val();
							var phone_ext = $('#phone_ext').val();

							$.post("<?php echo base_url()?>supplier/billing",{
							country:country,add1:add1,add2:add2,city:city,prov:prov,postal:postal,phone_num:phone_num,phone_ext:phone_ext,
							id:<?php echo $supplier_profile->ba_id; ?>,action:'update'},function(result){

								var  convert = JSON.parse(result);

								if(convert.status == 1)
								{
									$(window.location).attr('href', "<?php echo base_url() ?>supplier/profile/supplier/update");
								}
								else
								{
									$('.validate-result-billing').hide();
									$('.validate-result-billing').html(convert.message);
									$('.validate-result-billing').show();
								}
					
							});
					});

					$('#country').change(function(){
						change_country();
					});
					change_country();
					function change_country()
					{
						var country_sel = $('#country').val();
						var state_sel = $('#state_dropdown').val();
						$.post("<?php echo base_url()?>country/load",{id:country_sel,type:'dropdown',sel:state_sel},function(result){
						
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
					}


				</script>

				<div class='right-inner clearfix fl'>
					<!-- First Row Container-->
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'>Default Credit Card Information</p>
					</div>

					<div class='padded-cont'>
						<div class='clearfix'>
							<label for='cctype'>Credit Card Type*</label>
							<div class='clear'></div>
							<select id='cctype' class='normal-format-select' name="cctype">
								<?php foreach($creditcards as $creditcard){?>
									<option <?php if ($creditcard->cc_id == $supplier_profile->cc_id){ echo "selected = 'selected' "; } ?> value="<?php echo $creditcard->cc_id ?>"><?php echo $creditcard->cc_type?></option>
								<?php }?>
							</select>
						</div>

						<div class='clearfix'>
							<label for='ccuname'>Cardholder's Name*</label>
							<div class='clear'></div>
							<input type='text' id='ccuname' name="ccuname" class='normal-format-text' value="<?php echo $supplier_profile->ccu_name ?>" />
						</div>

						<div class='clearfix'>
							<label for='ccunum'>Credit Card Number*</label>
							<div class='clear'></div>
							<input type='text' id='ccunum' name="ccunum"  class='normal-format-text' value="<?php echo $supplier_profile->ccu_number ?>" />
						</div>

						<div class='clearfix'>
							<label for='ccuccv'>CCV*</label>
							<div class='clear'></div>
							<input type='text' class='normal-format-text small' id='ccuccv'  name="ccuccv" value="<?php echo $supplier_profile->ccu_ccv ?>" />
						</div>

						<div class='clearfix fl'>
							<label for='exp_month'>Expiration Date*</label>
							<div class='clear'></div>
							<select id='exp_month' class='medium normal-format-select' name="exp_month">
								<?php echo $this->creditcards->generate_months('option',$supplier_profile->ccu_exp_month); ?>
							</select>
							<select id='exp_year' class='small normal-format-select' name="exp_year">
								<?php 
								$year_set = date('Y', strtotime('+7 year'));
								echo $this->creditcards->generate_years($year_set,date('Y'),$supplier_profile->ccu_exp_year); 
								?>
							</select>
							<input type="hidden" value="<?php echo $supplier_profile->ccu_id ?>" name="ccuid" id="ccuid" />
						</div>

						<div class='clear'></div>
						<button id='update-creditcard-button' class='normal-button fr'>UPDATE CREDIT CARD</button>
						<div class='clear'></div>
						<div class='validate-result-credit-card'>
						</div>
					</div>

				</div>
				<script type="text/javascript">
		
					$('#state-textbox').hide();

					$('#update-creditcard-button').click(function(){
							var cctype = $('#cctype').val();
							var ccuname = $('#ccuname').val();
							var ccunum = $('#ccunum').val();
							var ccuccv = $('#ccuccv').val();
							var exp_month = $('#exp_month').val();
							var exp_year = $('#exp_year').val();
							var ccuid = $('#ccuid').val();

							$.post("<?php echo base_url()?>supplier/updatecard",{cctype:cctype,ccuname:ccuname,ccunum:ccunum,ccuccv:ccuccv,exp_month:exp_month,exp_year:exp_year,ccuid:ccuid,
							action:'update'},function(result){
								var  convert = JSON.parse(result);
								
								if (convert.status == 1)
								{
									$('.validate-result-credit-card').hide();
									$('.validate-result-credit-card').html(convert.message);
									$('.validate-result-credit-card').show();
									$(window.location).attr('href', "<?php echo base_url() ?>supplier/profile/supplier/update");
								}
								else if (convert.status == 0)
								{
									$('.validate-result-credit-card').hide();
									$('.validate-result-credit-card').html(convert.message);
									$('.validate-result-credit-card').show();
								}
							});
					});
				</script>

			</div>

		<!-- MIDDLE PAGE CONTAINER-->
		</div>
		<div class="bg-body-bottom"> </div>
	</div>

</div>

<script type="text/javascript">

	$('#update-supplier-info').click(function(){
		var firstname = $('#firstname').val();
		var lastname = $('#lastname').val();
		var email = $('#email').val(); 
		var comp = $('#comp').val();
		var permit = $('#permit').val();
		var id = $('#id').val();


		$.post("<?php echo base_url()?>supplier/updatesupplierprofile",{firstname:firstname,lastname:lastname,email:email,comp:comp,permit:permit,id:id,
			action:'update'},function(result){
				var  convert = JSON.parse(result);

				$('.validate-result').hide();
				$('.validate-result').html(convert.message);
				$('.validate-result').show();
				setSizesDynamic();

				if (convert.status == 1)
				{
					$(window.location).attr('href', '<?php echo base_url()?>supplier/profile/supplier/view');//redirect to the user page
				}
				
			});
	});

	function setSizesDynamic(){

	   var containerHeight = $(".right-cont").height();
	   $(".bg-body-middle").height(containerHeight - 158);
	}

</script>

<?php echo $this->load->view('supplier/footer') ?>