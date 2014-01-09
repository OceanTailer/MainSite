<?php echo $this->load->view('supplier/header') ?>
<script src="<?php echo base_url()?>js/jquery-ui-1.10.0.custom.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/jquery-ui-1.10.0.custom.min.css"/>

<div id='popship' class="popout-cont">
	<div class="padded-cont">

		<input type='button' value='X' class='close-pop-out fr'>

		<div class='clear'> </div>
		<div>
			<div class='fl'>
				<label for='track-number'>Tracking Number</label>
				<div class="clear"> </div>
				<input type='text' value='' class='normal-format' id='track-number' />
			</div>

			<div class='clear'> </div>
			<div class='fl shipping-box'>
				<label for='shipping-start'>Start Shipping</label>
				<div class="clear"> </div>
				<div id='shipping-start'></div>
			</div>

			<div class='fl shipping-box'>
				<label for='shipping-end'>End Shipping</label>
				<div class="clear"> </div>
				<div id='shipping-end'></div>
			</div>
			<div class='clear'> </div>
			<button class='normal-button' id='submit-confirmation-shipping'>SUBMIT</button>
			<div class='fr circle-loading' id='loading-supplierpayment'></div>
			<div id='result-sending'></div>
			
		</div>
	</div>

</div>

<div id='popshipview' class="popout-cont">
	<div class="padded-cont">

		<input type='button' value='X' class='close-pop-out fr'>

		<div class='clear'> </div>
		test

	</div>

</div>

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
						<p class='breadcrumbs fl'> Shipping Request </p>
					</div>

					<?php  //echo print_r($pending);?>
					<div class='violet-table'>
						<table>
							<tr>
								<td width=55>Date Order</td>
								<td>Invoice</td>
								
								<td>Buyer</td>

								<td width=15>Billing Country</td>
								<td width=15>Total Item</td>
								<td>Total Amount</td>
								<td>Action</td>
							</tr>
							<?php if(count($pending) != 0){?>
								<?php foreach($pending as $pend){?>
									<tr>
										<td><center><?php echo date('M d, Y H:i:s',$pend->bt_time); ?></center></td>
										<td>
											<div><?php echo $pend->bt_invoice?></div>
	<!-- 										<div class='table-format-det clearfix'>
												<label class='fl'>UCP/EAN: </label><p class='fl'> <?php echo $pend->bt_invoice?></p>
											</div>
											<div class='table-format-det clearfix'>
												<label class='fl'>SKU: </label><p class='fl'> <?php echo $pend->SKU?></p> 
											</div> -->


										<td><center><p><?php echo $pend->u_fname.' '.$pend->u_lname?></p></center></td>
										<td><center><?php echo $pend->c_code?></center></td>
										<td><center><?php echo $pend->total_quan?></center></td> 
										<td>$<?php echo $pend->total_amount?></td>
										<td>
											<center>
<!-- 												<a href="#" onclick='confirm_shipping(<?php echo $pend->btd_id?>)' >Confirm</a>,
												<a href="">Decline</a>, -->
												<a href="<?php echo base_url()?>supplier/order/<?php echo $pend->bt_id ?>" >Order Detail</a>
											</center>
										</td>
									</tr>
								<?php }?>
							<?php }else{?>
								<tr>
									<td colspan='7'><center>No Shipping Request Yet</center></td>
								</tr>
							<?php }?>
						</table>
					</div>

				</div>
			</div>

		<!-- MIDDLE PAGE CONTAINER-->
		</div>
		<div class="bg-body-bottom"> </div>
	</div>

</div>

<script type="text/javascript">
	$('#loading-supplierpayment').hide();
	$('#popship').hide();
	$('#popshipview').hide();
	var start = '';
	var end = '';

	var requestType = '';
	$( "#shipping-start" ).datepicker({
		onSelect: function()
	    { 
	        var start = $(this).datepicker('getDate'); 
	    }
    });

	$( "#shipping-end" ).datepicker({
		onSelect: function()
	    { 
	        var end = $(this).datepicker('getDate'); 
	    }
    });

    $( "#shipping-start" ).datepicker( "option", "dateFormat", 'mm/dd/yy' );
    $( "#shipping-end" ).datepicker( "option", "dateFormat", 'mm/dd/yy' );

	var sel_ship_prod = '';

	$('.close-pop-out').click(function(){
		$('.popout-cont').fadeOut();
		window.location.reload();
	});


	function confirm_shipping(id){
		sel_ship_prod = id;

		$('#popship').fadeIn();
	}

	$('#submit-confirmation-shipping').click(function(){
		if(sel_ship_prod != '')
		{
			start = $("#shipping-start").val();
			end = $("#shipping-end").val();

			var track  = $('#track-number').val();
			requestType = 'supplierpayment';
			$.post('<?php echo base_url()?>shipping/confirm',{track:track,start:start,end:end,sel_ship:sel_ship_prod,action:'add'},function(data){
				var  convert = JSON.parse(data);
				$('#result-sending').html(convert.display);
			});
		}
	});

	$("body").on({
	    ajaxStart: function() { 
	    	if(requestType == 'supplierpayment')
	        	$('#loading-supplierpayment').show();

	    },
	    ajaxStop: function() { 
	    	if(requestType == 'supplierpayment')
	        	$('#loading-supplierpayment').hide();


	        requestType = '';
	    }    
	});

</script>
<?php echo $this->load->view('supplier/footer') ?>