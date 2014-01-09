<?php
if($this->session->userdata('is_login') == TRUE)
{
	$user_type = $this->session->userdata('type'); //get user type;
	if($user_type == 2) //2 is Supplier
	{
		echo $this->load->view('supplier/header');
	}
	elseif($user_type == 3) //3 is Buyer
	{
		echo $this->load->view('buyer/header');
	}
}
else
	echo $this->load->view('header');
?>
<script src="<?php echo base_url()?>js/organictabs.jquery.js" type="text/javascript"></script> 
<script src="<?php echo base_url()?>js/jquery.validate.js" type="text/javascript"></script>
<div class="global-cont">

	<div class='bg-body'>
		<div class="bg-body-top"> </div>
		<div class="bg-body-middle clearfix">
		<!-- MIDDLE PAGE CONTAINER-->

			<!-- LEFT SIDEBAR CONTAINER-->
			<div id="left-sidebar" class="clearfix fl">

				<?php
				if($this->session->userdata('is_login') == TRUE)
				{
					$user_type = $this->session->userdata('type'); //get user type;
					if($user_type == 2) //2 is Supplier
					{
						echo $this->load->view('supplier/sidebar');
					}
					elseif($user_type == 3) //3 is Buyer
					{
						echo $this->load->view('buyer/sidebar');
					}
				}
				else
						echo $this->load->view('sidebar');
				?>				
			</div>

			<!-- RIGHT CONTENT CONTAINER-->
			<div class='right-cont clearfix fr'>

			<?php if(count($cart) == 0) {?>
			<center><p>--Need Atleast 1 Item in your Cart--</p></center>
			<?php }else{ ?>


			<div id="product-tab">

					<ul class="nav">
				        <li class="nav-one">
				        	<a href="#billing" class="current">
								<div class="head-tab fl"> 
									<div class="tab-left fl"> </div>
									<div class="tab-center fl"> 
										<p class="fl">Billing Address</p> 
									</div>
									<div class="tab-right fl"> </div>
								</div>
				        	</a>
				        </li>
				        <li class="nav-two">
				        	<a href="#credit" >
								<div class="head-tab fl"> 
									<div class="tab-left fl"> </div>
									<div class="tab-center fl"> 
										<p class="fl">Credit Card Information</p> 
									</div>
									<div class="tab-right fl"> </div>
								</div>
				        	</a>
				        </li>
				        <li class="nav-three">
				        	<a href="#shipping">
				        		<div class="head-tab fl"> 
									<div class="tab-left fl"> </div>
									<div class="tab-center fl"> 
										<p class="fl">Shipping Address</p> 
									</div>
									<div class="tab-right fl"> </div>
								</div>
				        	</a>
				        </li>
				        <li class="nav-four">
				        	<a href="#confirm">
				        		<div class="head-tab fl"> 
									<div class="tab-left fl"> </div>
									<div class="tab-center fl"> 
										<p class="fl">Confirm Payment</p> 
									</div>
									<div class="tab-right fl"> </div>
								</div>
				        	</a>
				        </li>
				    </ul>

				    <div class="list-wrap clearfix">

						<ul id="billing">
							<li>
								<div class='product-cont padded-cont clearfix'>
									<h3>Billing Address</h3>

									<div class='clearfix inner-cont-billing-checkout'>
										<div class='fl'><input type='radio' class='billing_address'  name='billing_address' checked='checked'  value='usesame' /></div>
										<div class='fl'>
											<p>Use the saved information for the Billing Address</p>
										</div>
										<div class='clear'></div>

										<div class='fl'><input type='radio' class='billing_address'  name='billing_address'  value='userOther' /></div>
										<div class='fl'>
											<p>Create New Billing Address</p>
										</div>
									</div>
									<div class='clear'></div>

									<div class='inner-cont-billing-checkout clearfix' id='existing-billing'>
										<?php foreach($billing_address as $bil){
											if($bil->ba_isset == 1){ $billing_set = $bil->ba_id;  ?>
											<div class='fl selectable-div'>
												<div class='fl'><input type='radio' class='billing_group' name='billing' checked='checked' value='<?php echo $bil->ba_id?>' /></div>
												<div class='fl'>
													<p>Address: <?php echo $bil->ba_add1?>, <?php echo $bil->ba_postal?></p>
													<p>Cty: <?php echo $bil->ba_city?></p>
													<p>Province: <?php echo $bil->ba_province?></p>
													<p>Number: <?php echo $bil->ba_phone_num." ".$bil->ba_phone_ext	?></p>
												</div>
											</div>
										<?php }else{?>
											<div class='fl selectable-div'>
												<div class='fl'><input type='radio' class='billing_group' name='billing' value='<?php echo $bil->ba_id?>' /></div>
												<div class='fl'>
													<p>Address: <?php echo $bil->ba_add1?>, <?php echo $bil->ba_postal?></p>
													<p>Cty: <?php echo $bil->ba_city?></p>
													<p>Province/State: <?php echo $bil->ba_province?></p>
													<p>Number: <?php echo $bil->ba_phone_num." ".$bil->ba_phone_ext	?></p>
												</div>
											</div>
										<?php } }?>		
									</div>

									<div class='inner-cont-billing-checkout clearfix' id='new-billing' style='display:none'>

										<div>
											<label for='billing-country'>Country*</label>
											<div class='clear'></div>
											<select id='billing-country'>
											<?php 
											foreach($countries as $country){?> 
												<option <?php  if( $countr_sel+"" == $country->c_id){ ?> selected="selected" <?php }?> value="<?php echo $country->c_id?>"><?php echo $country->c_name?></option>
											<?php }?>
											</select>
										</div>

										<div>
											<label for='billing-address1'>Address 1*</label>
											<div class='clear'></div>
											<input type='text' class='longer' id='billing-address1' />
										</div>

										<div>
											<label for='billing-address2'>Address 2</label>
											<div class='clear'></div>
											<input type='text' class='longer' id='billing-address2' />
										</div>

										<div>
											<label for='billing-city'>City/Town*</label>
											<div class='clear'></div>
											<input type='text' class='long' id='billing-city' />
										</div>

										<div id='billing-drp-state'>
											<label for='billing-state_dropdown'>State*</label>
											<div class='clear'></div>
											<select id='billing-state_dropdown'>
												<?php 
												foreach($states as $state){?> 
													<option value="<?php echo $state->st_name?>"><?php echo $state->st_name?></option>
												<?php }?>
											</select>
										</div>

										<div id='billing-state-textbox' style='display:none'>
											<label for='billing-province'>Province/Region/State*</label>
											<div class='clear'></div>
											<input type='text' class='long' id='billing-province' />
										</div>

										<div>
											<label for='billing-postal_code'>Postal Code/Zip Code*</label>
											<div class='clear'></div>
											<input type='text' id='billing-postal_code' />
										</div>

										<div>
											<label for='billing-phone_num'>Phone Number*</label>
											<div class='clear'></div>
											<input type='text' id='billing-phone_num' />+<input type='text' class='small no-margin' id='billing-phone_ext' />
										</div>

										<div class='billing-result-validation'>

										</div>

									</div>

									<div class='clear'></div>
									<button class='fr normal-button step-format' id='step_2_validate' style='display:none'>Validate</button>
									<button class='fr normal-button step-format' id='step_2'>NEXT</button>
									<script type="text/javascript">
										var billing_info = 1;//used the existing for 1
										var isBilling_valid = 0;
										var billing = <?php echo $billing_set?>;
										var billing_is_state = true;

						    			$('.billing_address').click(function(){
											var sel = $('input[name=billing_address]:radio:checked').val();
											if(sel == 'userOther')
											{
												$('#existing-billing').hide();
												$('#new-billing').fadeIn();
												billing_info = 0;
												$('#step_2').hide();
												$('#step_2_validate').fadeIn();
											}
											else
											{
												$('#new-billing').hide();
												$('#existing-billing').fadeIn();
												billing_info = 1;
												$('#step_2_validate').hide();
												$('#step_2').fadeIn();
											}
											setSizesDynamic();
										});

										$('#step_2').click(function(){
										 	$('.nav-two a').trigger('click');
											setSizesDynamic();

											if(billing_info == 0) //new billing info
												validate_billing_new(1);
										 });

										$('#step_2_validate').click(function(){
										 		validate_billing_new(0);
										 });

										 function validate_billing_new(type)
										 {
										 	var country = $('#billing-country').val();
											var add1 = $('#billing-address1').val();
											var add2 = $('#billing-address2').val();
											var city = $('#billing-city').val();

											var prov = '';
											if(billing_is_state)
												prov = $('#billing-state_dropdown').val();
											else
												prov = $('#billing-province').val();

											var postal = $('#billing-postal_code').val();     
											var phone_num = $('#billing-phone_num').val();
											var phone_ext = $('#billing-phone_ext').val();

											if(type == 0)
											{
												$.post('<?php echo base_url()?>buyer/billingValidate',{country:country,add1:add1,add2:add2,city:city,prov:prov,postal:postal,phone_num:phone_num,phone_ext:phone_ext},
												function(result){
													var  data = JSON.parse(result);
													isBilling_valid = data.status;
													if(data.status == 1)
													{
														$('.billing-result-validation').html(data.message);
														$('#step_2_validate').hide();
														$('#step_2').fadeIn();
													}
													else if(data.status == 0)
													{
														$('#step_2').hide();
														$('#step_2_validate').fadeIn();	
														$('.billing-result-validation').html(data.message);
													}	
												});
											}
											else if(type == 1)//adding it into the system
											{
												$.post('<?php echo base_url()?>buyer/billing',{country:country,add1:add1,add2:add2,city:city,prov:prov,postal:postal,phone_num:phone_num,phone_ext:phone_ext,
													action:'add'},function(result){
													var  data = JSON.parse(result);
													isBilling_valid = data.status;
													if(data.status == 1)
													{
														billing = data.id;
														$('.billing-result-validation').html(data.message);
														$('#step_2_validate').hide();
														$('#step_2').fadeIn();
													}
													else if(data.status == 0)
													{
														$('#step_2').hide();
														$('#step_2_validate').fadeIn();			
														$('.billing-result-validation').html(data.message);
													}	
												});
											}
										 
										 }

										 $('#billing-country').change(function(){
											var country_sel = this.value;

											$.post("<?php echo base_url()?>country/load",{id:country_sel,type:'dropdown'},function(result){
											
												if(result != 0)
												{
													$('#billing-state_dropdown').html(result);
													$('#billing-drp-state').fadeIn();
													$('#billing-state-textbox').hide();
													billing_is_state = true;
												}
												else
												{
													billing_is_state = false;
													$('#billing-state-textbox').fadeIn();
													$('#billing-drp-state').hide();
												}
											});
										});
							    	</script>
								</div>
							</li>
						</ul>

						<ul id="credit" class='hide'>
							<li>
								<div class='product-cont padded-cont clearfix'>
									<h3>Credit Card Information</h3>
									<div class='clearfix inner-cont-billing-checkout'>
										<div class='fl'><input type='radio' class='cc_info'  name='cc_info' checked='checked'  value='usesame' /></div>
										<div class='fl'>
											<p>Use the saved information for the Credit Card Information</p>
										</div>
										<div class='clear'></div>

										<div class='fl'><input type='radio' class='cc_info'  name='cc_info'  value='userOther' /></div>
										<div class='fl'>
											<p>Create New Credit Card Information</p>
										</div>
									</div>
									<div class='clear'></div>

									<div class='inner-cont-billing-checkout clearfix' id='existing-cc'>
										<?php foreach($credit_card as $cc){
											if($cc->ccu_isset == 1){ $ccu_id_set = $cc->ccu_id;  ?>
											<div class='fl selectable-div'>
												<div class='fl'><input type='radio' class='cc_group' name='cc' checked='checked' value='<?php echo $bil->ba_id?>' /></div>
												<div class='fl'>
													<p>Credit Card #: <?php echo '***********'.substr($cc->ccu_number, 11, 15)?></p>
													<p>Credit Card name: <?php echo $cc->ccu_name?></p>
													<p>Expiration: <?php  if(count($cc->ccu_exp_month) == 1){echo '0';}; echo $cc->ccu_exp_month."/".$cc->ccu_exp_year	?></p>
												</div>
											</div>
										<?php }else{?>
											<div class='fl selectable-div'>
												<div class='fl'><input type='radio' class='cc_group' name='cc' value='<?php echo $bil->ba_id?>' /></div>
												<div class='fl'>
													<p>Credit Card #: <?php echo $cc->ccu_number?></p>
													<p>Credit Card name: <?php echo $cc->ccu_name?></p>
													<p>Expiration: <?php  if(count($cc->ccu_exp_month) == 1){echo '0';}; echo $cc->ccu_exp_month."/".$cc->ccu_exp_year	?></p>
												</div>
											</div>

										<?php } }?>		
									</div>

									<div class='inner-cont-billing-checkout clearfix' id='new-cc' style='display:none'>
										<div class='clearfix'>
											<label for='cctype'>Credit Card Type*</label>
											<div class='clear'></div>
											<select id='cctype'  name="cctype">
												<?php 
												foreach($credit_cards as $creditcard){?> 
													<option value="<?php echo $creditcard->cc_id?>"><?php echo $creditcard->cc_type?></option>
												<?php }?>
											</select>
										</div>

										<div class='clearfix'>
											<label for='ccuname'>Cardholder's Name*</label>
											<div class='clear'></div>
											<input type='text' id='ccuname' name="ccuname" />
										</div>

										<div class='clearfix'>
											<label for='ccunum'>Credit Card Number*</label>
											<div class='clear'></div>
											<input type='text' id='ccunum' name="ccunum" />
										</div>

										<div class='clearfix'>
											<label for='ccuccv'>CCV*</label>
											<div class='clear'></div>
											<input type='text' class='small' id='ccuccv' name="ccuccv" />
										</div>

										<div class='clearfix'>
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
									</div>
									<button class='fr normal-button step-format' id='step_3_validate' style='display:none'>Validate</button>
									<button class='fr normal-button step-format' id='step_3'>NEXT</button>
									<div class='credit-result-validation'>

									</div>
								</div>
									<script type="text/javascript">
										var cc_info = 1;//used the existing for 1
										var iscc_valid = 0;
										var cc = <?php echo $ccu_id_set?>;
										$('.cc_info').click(function(){
											var sel = $('input[name=cc_info]:radio:checked').val();
											if(sel == 'userOther')
											{
												$('#existing-cc').hide();
												$('#new-cc').fadeIn();
												cc_info = 0;
												$('#step_3').hide();
												$('#step_3_validate').fadeIn();
											}
											else
											{

												$('#new-cc').hide();
												$('#existing-cc').fadeIn();
												cc_info = 1;
												$('#step_3_validate').hide();
												$('#step_3').fadeIn();
											}
											setSizesDynamic();

										});

										 $('#step_3').click(function(){
										 	$('.nav-three a').trigger('click');
											setSizesDynamic();
											if(cc_info == 0) //new billing info
												validate_cc_new(1);
										 });

										$('#step_3_validate').click(function(){
										 	validate_cc_new(0);
										 });

										function validate_cc_new(type)
										{
											var cctype = $('#cctype').val();
											var ccuname = $('#ccuname').val();
											var ccunum = $('#ccunum').val();
											var ccuccv = $('#ccuccv').val();
											var exp_month = $('#exp_month').val();
											var exp_year = $('#exp_year').val();

											if(type == 0) //validate cc
											{
												$.post("<?php echo base_url()?>buyer/validateCc",{cctype:cctype,ccuname:ccuname,ccunum:ccunum,ccuccv:ccuccv,exp_month:exp_month,exp_year:exp_year,
												},function(result){
													alert(result);
													var  data = JSON.parse(result);
													iscc_valid = data.status;
													if(data.status == 1)
													{
														$('.credit-result-validation').html(data.message);
														$('#step_3_validate').hide();
														$('#step_3').fadeIn();
													}
													else if(data.status == 0)
													{
														$('.credit-result-validation').html(data.message);
													}	
												});
											}
											else if(type == 1) //add cc
											{
												$.post("<?php echo base_url()?>buyer/addnewcreditcard",{cctype:cctype,ccuname:ccuname,ccunum:ccunum,ccuccv:ccuccv,exp_month:exp_month,exp_year:exp_year,
												action:'add'},function(result){
													
													var  data = JSON.parse(result);
													isBilling_valid = data.status;
													if(data.status == 1)
													{
														cc = data.ccid;
														$('.credit-result-validation').html(data.message);
														$('#step_3_validate').hide();
														$('#step_3').fadeIn();
													}
													else if(data.status == 0)
													{
														$('#step_3').hide();
														$('#step_3_validate').fadeIn();			
														$('.credit-result-validation').html(data.message);
													}
												});
											}
										}
									</script>
							</li>
						</ul>

						<ul id="shipping" class='hide'>
							<li>
								<div class='product-cont padded-cont clearfix'>
									<h3>Shipping Address</h3>

									<div class='inner-cont-billing-checkout clearfix'>

										<div class='fl'><input type='radio' class='shipp_address'  name='shipp_address' checked='checked'  value='usesame' /></div>
										<div class='fl'>
											<p>Use the same information from the Billing Address</p>
										</div>
										<div class='clear'></div>

										<div class='fl'><input type='radio' class='shipp_address'  name='shipp_address'  value='userOther' /></div>
										<div class='fl'>
											<p>Send to Other/New Address</p>
										</div>
										<div class='clear'></div>
										<div class='new-shipping-info'>

											<div>
												<label for='receiver_name'>Receiver's Name*</label>
												<div class='clear'></div>
												<input type='text' class='longer' id='receiver_name' />
											</div>

											<div>
												<label for='country'>Country*</label>
												<div class='clear'></div>
												<select id='country'>
												<?php 
												foreach($countries as $country){?> 
													<option <?php  if( $countr_sel+"" == $country->c_id){ ?> selected="selected" <?php }?> value="<?php echo $country->c_id?>"><?php echo $country->c_name?></option>
												<?php }?>
												</select>
											</div>

											<div>
												<label for='address1'>Address 1*</label>
												<div class='clear'></div>
												<input type='text' class='longer' id='address1' />
											</div>

											<div>
												<label for='address2'>Address 2</label>
												<div class='clear'></div>
												<input type='text' class='longer' id='address2' />
											</div>

											<div>
												<label for='city'>City/Town*</label>
												<div class='clear'></div>
												<input type='text' class='long' id='city' />
											</div>

											<div id='drp-state'>
												<label for='state_dropdown'>Province/Region/State*</label>
												<div class='clear'></div>
												<select id='state_dropdown'>
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
												<input type='text' id='postal_code' />
											</div>

											<div>
												<label for='phone_num'>Phone Number*</label>
												<div class='clear'></div>
												<input type='text' id='phone_num' />+<input type='text' class='small no-margin' id='phone_ext' />
											</div>
										</div>
									</div>
									<button class='fr normal-button step-format' id='step_4_validate' style='display:none'>VALIDATE</button>
									<button class='fr normal-button step-format' id='step_4'>NEXT</button>
									<div class='shipping-result-validation'>

									</div>
								</div>
							</li>
						</ul>

						<ul id="confirm" class='hide'>
							<li>
								<div class='product-cont padded-cont clearfix'>
									<h3>Confirm Payment</h3>
									<div class='gray-table final-payment-table'>
						                <table>
						                    <tr>
						                        <td width=100></td>
						                        <td>Item</td>
						                        <td width=20>Quantity</td>
						                        <td width=80>Price</td>
						                        <td width=40>Sub Total</td>
								            </tr>
								            <?php 
								            $total_shipping_fee = 0;
								            foreach($cart as $item){
								            	$total_shipping_fee += $item['options']['ship_cost'];
								            	?>
								            <tr>
								            	<td align='center'>
								            		<?php 
													$image_list = $this->inventories->list_image($item['id'],1,true); 
													//limit 1, select only the featured image
													if(count($image_list) == 0){?>
														<img width=95 src="<?php echo base_url()?>images/default-preview.jpg">
													
													<?php }else{?>
														<img width=95  src="<?php echo $image_list[0]->ii_link ?>">
													<?php }?>
								            	</td>
						                        <td><center><?php echo $item['name']?></center></td>
						                        <td><center><?php echo $item['qty'] ?></center></td>
						                        <td><center>$<?php echo $item['price'] ?></center></td>
						                        <td><center>$<?php echo $item['subtotal'] ?></center></td>
						                    </tr>
										<?php }?>
											<tr>
												<td colspan=3></td>
												<td>Shipping Fee</td>
												<td colspan=2><center>$<?php echo $total_shipping_fee ?></center></td>
											</tr>
											<tr>
												<td colspan=3></td>
												<td>Total</td>
												<td colspan=2><center>$<?php echo $total ?></center></td>
											</tr>
								        </table>
								     </div>
								     <div class='clear'></div>

								     <button class='fr normal-button step-format' id='send-transaction'>SEND</button>
								     <div class='fr circle-loading' id='loading-payment'></div>

								     <div id='payment-result'>

								     </div>
								</div>
							</li>
						</ul>

					</div>	

			</div>
			<?php }?>

			</div>
			<!-- RIGHT CONTENT CONTAINER END-->

		<!-- MIDDLE PAGE CONTAINER-->
		</div>
		<div class="bg-body-bottom"> </div>
	</div>

</div>

<script type="text/javascript">
	$('#state-textbox').hide();
	
	var shipping_info = 1; //used the existing for 1 
	var is_state = true;

	var requestType = '';

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

	$('#send-transaction').click(function(){
		var receiver_name = $('#receiver_name').val();
		var country = $('#country').val();
		var add1 = $('#address1').val();
		var add2 = $('#address2').val();
		var city = $('#city').val();
		if(is_state)
			prov = $('#state_dropdown').val();
		else
			prov = $('#province').val();

		var postal = $('#postal_code').val();
		var phone_num = $('#phone_num').val();
		var phone_ext = $('#phone_ext').val();

		requestType = 'payment';

		//<?php echo base_url()?>payments_pro/do_direct_payment
		$.post('<?php echo base_url()?>payment/buyer',{cc:cc,billing:billing,shipping_info:shipping_info, 
			receiver_name:receiver_name,country:country,add1:add1,add2:add2,city:city,prov:prov,postal:postal,phone_num:phone_num,phone_ext:phone_ext}, 
			function(result){
			var  data = JSON.parse(result);
			$('#payment-result').html(data.display);

			if(data.status == 1)
			{
				$('.final-payment-table').fadeOut();
				$('#send-transaction').hide();
			}
		});

	});

	$("body").on({
	    ajaxStart: function() { 
	    	if(requestType == 'payment')
	        	$('#loading-payment').show();

	    },
	    ajaxStop: function() { 
	    	if(requestType == 'payment')
	        	$('#loading-payment').hide();


	        requestType = '';
	    }    
	});


	$('.billing_group').click(function(){
		var sel = $('input[name=billing]:radio:checked').val();
		billing = sel;
	});

	$('.cc_group').click(function(){
		var sel = $('input[name=cc]:radio:checked').val();
		cc = sel;
	});
	//changing div if using existing information or not
	$('.shipp_address').click(function(){
		var sel = $('input[name=shipp_address]:radio:checked').val();
		if(sel == 'userOther')
		{
			$('.new-shipping-info').fadeIn();
			shipping_info = 0;
			$('#step_4').hide();
			$('#step_4_validate').fadeIn();
		}
		else
		{
			$('.new-shipping-info').hide();
			shipping_info = 1;
			$('#step_4_validate').hide();
			$('#step_4').fadeIn();
			
		}
		setSizesDynamic();
	});

	//changing div if using existing information or not end

	 $(function() {

        $("#product-tab").organicTabs();
        
    });



	 $('#step_4').click(function(){
	 	
	 	$('.nav-four a').trigger('click');
		setSizesDynamic();
		
	 });
	 $('#step_4_validate').click(function(){
	 	validate_shipping_new();
	 });

	 function validate_shipping_new()
	{
		var receiver_name = $('#receiver_name').val();
		var country = $('#country').val();
		var add1 = $('#address1').val();
		var add2 = $('#address2').val();
		var city = $('#city').val();
		if(is_state)
			prov = $('#state_dropdown').val();
		else
			prov = $('#province').val();

		var postal = $('#postal_code').val();
		var phone_num = $('#phone_num').val();
		var phone_ext = $('#phone_ext').val();

		$.post('<?php echo base_url()?>buyer/billing',{country:country,add1:add1,add2:add2,city:city,prov:prov,postal:postal,phone_num:phone_num,phone_ext:phone_ext,
			action:'add'},function(result){
			var  data = JSON.parse(result);
			if(data.status == 1)
			{
				$('.shipping-result-validation').html("Shipping Detail Valid");
				$('#step_4_validate').hide();
				$('#step_4').fadeIn();
			}
			else if(data.status == 0)
			{
				$('#step_4').hide();
				$('#step_4_validate').fadeIn();			
				$('.shipping-result-validation').html(data.message);
			}	
		});
	}

	function setSizesDynamic() {
		   var containerHeight = $(".right-cont").height();
		   $(".bg-body-middle").height(containerHeight - 258);
	}

	$('.nav li a').click(function(){
		setTimeout(setSizesDynamic,500);
	});

</script>



<?php
if($this->session->userdata('is_login') == TRUE)
{
	$user_type = $this->session->userdata('type'); //get user type;
	if($user_type == 2) //1 is suplier
	{
		echo $this->load->view('supplier/footer');
	}
	elseif($user_type == 3) //3 is Buyer
	{
		echo $this->load->view('buyer/footer');
	}
}
else
		echo $this->load->view('footer');
?>
