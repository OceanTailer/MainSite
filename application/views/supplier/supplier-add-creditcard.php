<!-- Lanz Editted - June 8, 2013 -->
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
						<p class='breadcrumbs fl'>Credit Card Information:</p>
					</div>

					<div class='padded-cont'>
						<div class='clearfix'>
							<label for='cctype'>Credit Card Type*</label>
							<div class='clear'></div>
							<select id='cctype' class='medium normal-format-select' name="cctype">
								<?php 
								foreach($creditcards as $creditcard){?> 
									<option value="<?php echo $creditcard->cc_id?>"><?php echo $creditcard->cc_type?></option>
								<?php }?>
							</select>
						</div>

						<div class='clearfix'>
							<label for='ccuname'>Cardholder's Name*</label>
							<div class='clear'></div>
							<input type='text' id='ccuname' name="ccuname" class='normal-format-text' />
						</div>

						<div class='clearfix'>
							<label for='ccunum'>Credit Card Number*</label>
							<div class='clear'></div>
							<input type='text' id='ccunum' name="ccunum" class='normal-format-text'  />
						</div>

						<div class='clearfix'>
							<label for='ccuccv'>CCV*</label>
							<div class='clear'></div>
							<input type='text' class='small normal-format-text' id='ccuccv' name="ccuccv" />
						</div>

						<div class='clearfix '>
							<label for='exp_month'>Expiration Date*</label>
							<div class='clear'></div>
							<select id='exp_month' class='medium normal-format-select' name="exp_month">
								<?php echo $this->creditcards->generate_months('option'); ?>
							</select>
							<select id='exp_year' class='small normal-format-select' name="exp_year">
								<?php 
								$year_set = date('Y', strtotime('+7 year'));
								echo $this->creditcards->generate_years($year_set,date('Y')); ?>
							</select>
						</div>

						<div class='clear'></div>
						<button id='add-creditcard-button' class='normal-button fr'>ADD CREDIT CARD</button>
						<div class='clear'></div>
						<div class='validate-result'>
						</div>
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

		$('#add-creditcard-button').click(function(){
				var cctype = $('#cctype').val();
				var ccuname = $('#ccuname').val();
				var ccunum = $('#ccunum').val();
				var ccuccv = $('#ccuccv').val();
				var exp_month = $('#exp_month').val();
				var exp_year = $('#exp_year').val();

				$.post("<?php echo base_url()?>buyer/addnewcreditcard",{cctype:cctype,ccuname:ccuname,ccunum:ccunum,ccuccv:ccuccv,exp_month:exp_month,exp_year:exp_year,
				action:'add'},function(result){
					var  convert = JSON.parse(result);
					
					if(convert.status == 1)
					{
						$('.validate-result').hide();
						$('.validate-result').html(convert.message);
						$('.validate-result').show();
						$(window.location).attr('href', "<?php echo base_url() ?>supplier/creditcard");
					}
					// Lanz Editted - June 6, 2013
					else if (convert.status == 0)
					{
						$('.validate-result').hide();
						$('.validate-result').html(convert.message);
						$('.validate-result').show();
					}
		
				});
		});
	</script>

</div>
<?php echo $this->load->view('supplier/footer') ?>