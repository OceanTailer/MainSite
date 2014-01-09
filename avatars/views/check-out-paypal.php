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
				        <li class="nav-three">
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

									<div class='inner-cont-billing-checkout clearfix'>
										<?php foreach($billing_address as $bil){
											if($bil->ba_isset == 1){ $billing_set = $bil->ba_id;  ?>
											<div class='fl'><input type='radio' class='billing_group' name='billing' checked='checked' value='<?php echo $bil->ba_id?>' /></div>
											<div class='fl'>
												<p>Address: <?php echo $bil->ba_add1?>, <?php echo $bil->ba_postal?></p>
												<p>Cty: <?php echo $bil->ba_city?></p>
												<p>Provice: <?php echo $bil->ba_province?></p>
												<p>Number: <?php echo $bil->ba_phone_num." ".$bil->ba_phone_ext	?></p>
											</div>
										<?php }else{?>

											<div class='fl'><input type='radio' class='billing_group' name='billing' value='<?php echo $bil->ba_id?>' /></div>
											<div class='fl'>
												<p>Address: <?php echo $bil->ba_add1?>, <?php echo $bil->ba_postal?></p>
												<p>Cty: <?php echo $bil->ba_city?></p>
												<p>Provice: <?php echo $bil->ba_province?></p>
												<p>Number: <?php echo $bil->ba_phone_num." ".$bil->ba_phone_ext	?></p>
											</div>

										<?php } }?>		
									</div>
									<div class='clear'></div>

									<button class='fr normal-button step-format' id='step_2'>NEXT</button>

								</div>
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
											<p>Send to other/New Address</p>
										</div>
										<div class='clear'></div>
										<div class='new-shipping-info'>

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
												<label for='state_dropdown'>Provice/Region/State*</label>
												<div class='clear'></div>
												<select id='state_dropdown'>
													<?php 
													foreach($states as $state){?> 
														<option value="<?php echo $state->st_name?>"><?php echo $state->st_name?></option>
													<?php }?>
												</select>
											</div>

											<div id='state-textbox'>
												<label for='province'>Provice/Region/State*</label>
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

									<button class='fr normal-button step-format' id='step_3'>NEXT</button>

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
						                        <td width=40>Price</td>
						                        <td width=40>Ship Price</td>
						                        <td width=40>Sub Total</td>
								            </tr>
								            <?php 
								            foreach($cart as $item){?>
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
						                        <td><center><?php echo $item['price']-$item['options']['ship_cost'] ?>$</center></td>
						                        <td><center><?php echo $item['options']['ship_cost'] ?>$</center></td>
						                        <td><center><?php echo $item['subtotal'] ?>$</center></td>
						                    </tr>
										<?php }?>
											<tr>
												<td colspan=4></td>
												<td>Total</td>
												<td colspan=2><center><?php echo $total ?>$</center></td>
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
		

			</div>
			<!-- RIGHT CONTENT CONTAINER END-->

		<!-- MIDDLE PAGE CONTAINER-->
		</div>
		<div class="bg-body-bottom"> </div>
	</div>

</div>

<script type="text/javascript">

	var billing = <?php echo $billing_set?>;
	var shipping_info = 1;
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

		$.post('<?php echo base_url()?>payments_pro/do_direct_payment',{billing:billing,shipping_info:shipping_info, 
			country:country,add1:add1,add2:add2,city:city,prov:prov,postal:postal,phone_num:phone_num,phone_ext:phone_ext}, 
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

	$('.shipp_address').click(function(){
		var sel = $('input[name=shipp_address]:radio:checked').val();
		if(sel == 'userOther')
		{
			$('.new-shipping-info').fadeIn();
			shipping_info = 0;
		}
		else
		{
			$('.new-shipping-info').hide();
			shipping_info = 1;
		}
		setSizesDynamic();
	});


	 $(function() {

        $("#product-tab").organicTabs();
        
    });

	 $('#step_2').click(function(){
	 	
	 	$('.nav-two a').trigger('click');
		setSizesDynamic();

	 });

	 $('#step_3').click(function(){
	 	
	 	$('.nav-three a').trigger('click');
		setSizesDynamic();
		
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
