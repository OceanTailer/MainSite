<!-- Lanz Editted - June 7, 2013 -->
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
						<p class='breadcrumbs fl'>Add Billing Address</p>
					</div>
					<div class='padded-cont clearfix'>
						<div>
							<label for='country'>Country*</label>
							<div class='clear'></div>
							<select id='country' name="country" class='normal-format-select'>
							<?php 
							foreach($countries as $country){?> 
								<option <?php  if( $billing->c_id == $country->c_id){ ?> selected="selected" <?php }?> value="<?php echo $country->c_id?>"><?php echo $country->c_name?></option>
							<?php }?>
							</select>
						</div>

						<div>
							<label for='address1'>Address 1*</label>
							<div class='clear'></div>
							<input type='text' class='longer normal-format-text' id='address1' name="address1" value='<?php echo $billing->ba_add1?>' />
						</div>

						<div>
							<label for='address2'>Address 2</label>
							<div class='clear'></div>
							<input type='text' class='longer normal-format-text' id='address2' name="address2" value="<?php echo $billing->ba_add2?>" />
						</div>

						<div>
							<label for='city'>City/Town*</label>
							<div class='clear'></div>
							<input type='text' class='long normal-format-text' id='city' name="city" value="<?php echo $billing->ba_city?>" />
						</div>

						<div id='drp-state'>
							<label for='state_dropdown'>Province/Region/State*</label>
							<div class='clear'></div>
							<select id='state_dropdown' name="state_dropdown" class='normal-format-select'>
								<?php 
								foreach($states as $state){?> 
									<option value="<?php echo $state->st_name?>"><?php echo $state->st_name?></option>
								<?php }?>
							</select>
						</div>
						<div id='state-textbox'>
							<label for='province'>Province/Region/State*</label>
							<div class='clear'></div>
							<input type='text' class='long normal-format-text' id='province' value="<?php echo $billing->ba_province; ?>" />
						</div>
						<div>
							<label for='postal_code'>Postal Code/Zip Code*</label>
							<div class='clear'></div>
							<input type='text' id='postal_code' name="postal_code" value="<?php echo $billing->ba_postal; ?>" class='normal-format-text' />
						</div>

						<div>
							<label for='phone_num'>Phone Number*</label>
							<div class='clear'></div>
							<input type='text' id='phone_num' class='normal-format-text' name="phone_num" value="<?php echo $billing->ba_phone_num; ?>" />+<input type='text' class='small no-margin normal-format-text' id='phone_ext' name="phone_ext" value="<?php echo $billing->ba_phone_ext; ?>" />
						</div>
						<button id='update-billing-button' class='normal-button fr'>Update</button>
						<div class='clear'></div>
						<div class='validate-result'>
						</div>

					</div>
				</div>
			</div>

		<!-- MIDDLE PAGE CONTAINER-->
		</div>
		<div class="bg-body-bottom"> </div>
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

				var postal = $('#postal_code').val();     
				var phone_num = $('#phone_num').val();
				var phone_ext = $('#phone_ext').val();
				$.post("<?php echo base_url()?>supplier/billing",{
				country:country,add1:add1,add2:add2,city:city,prov:prov,postal:postal,phone_num:phone_num,phone_ext:phone_ext,
				id:<?php echo $billing->ba_id; ?>,action:'update'},function(result){
					var  convert = JSON.parse(result);

					// Lanz Editted - June 7, 2013
					$('.validate-result').hide();
					$('.validate-result').html(convert.message);
					$('.validate-result').show();
					
					if(convert.status == 1)
					{
						$(window.location).attr('href', "<?php echo base_url() ?>supplier/billing/update/<?php echo $billing->ba_id; ?>");
					}
		
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
	</script>

</div>
<?php echo $this->load->view('supplier/footer') ?>