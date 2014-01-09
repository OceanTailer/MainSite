<!-- Lanz Editted - June 18, 2013 -->
<?php echo $this->load->view('buyer/header') ?>
<script src="<?php echo base_url()?>js/jquery-ui-1.10.0.custom.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/jquery-ui-1.10.0.custom.min.css"/>
<div class="global-cont">

	<div class='bg-body'>
		<div class="bg-body-top"> </div>
		<div class="bg-body-middle clearfix">
		<!-- MIDDLE PAGE CONTAINER-->


			<!-- LEFT SIDEBAR CONTAINER-->
			<div id="left-sidebar" class="clearfix fl">

				<?php echo $this->load->view('buyer/sidebar');?>

			</div>

			<!-- RIGHT CONTENT CONTAINER-->
			<div class='right-cont clearfix fr'>
				<div class='right-inner clearfix'>
					<!-- First Row Container-->
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'>Transaction History</p>
					</div>
					<div class='padded-cont'>
						<div class='search-container clearfix'>
							<div class="clearfix">
								<label for='search-name'>Company/Supplier's Name</label>
								<div class='clear'></div>
								<input type="text" id='search-name'  class='normal-format-text' value=''/>
							</div>

							<div class="clearfix">
								<label for='start-date'>From</label>

								<div class='clearfix'>
										<input type='text' value='' id='start-date' class='normal-format-text' style='width:80px;' />
								</div>
								<div class='clear'></div>

							</div>

							<div class="clearfix">
								<label for='end-date'>To</label>
								<div class='clearfix'>
									<input type='text' value='' id='end-date' class='normal-format-text' style='width:80px;' />
								</div>
							</div>

							<div class="clearfix">
								<label for='status-payment'>Status</label>

								<div class='clearfix'>
										<select id='status-payment' class='normal-format-text' style='width:120px;'>
											<option value=''>All</option>
											<option value='0'>Pending/Buyer Approved Shipping Fee</option>
											<option value='-2'>Pending buyer's consent for new shipping fees</option> 
											<option value='-1'>Cancelled Order</option>
											<option value='-4'>Return Order</option>
											<option value='-3'>Refund Order</option>
											<option value='1'>Shipped</option>
											<option value='2'>Completed</option>
										</select>
								</div>
							</div>

							<div class="clearfix">
								<div class='clearfix'>
									<input type='button' value='SEARCH' id='send-search' class='normal-button' style='margin-top:10px;' />
								</div>
							</div>

						</div>
						<div class='violet-table table-margin'>
							<table id='listing-searched-table'>
								
							</table>
						</div>
					</div>

				</div>
			</div>
		<!-- MIDDLE PAGE CONTAINER-->
		</div>
		<div class="bg-body-bottom"> </div>
	</div>

</div>
<script type="text/javascript">

	var start = '';
	var end = '';

	var requestType = '';
	$( "#start-date" ).datepicker({
		onSelect: function()
	    { 
	        var start = $(this).datepicker('getDate'); 
	    }
    });

	$( "#end-date" ).datepicker({
		onSelect: function()
	    { 
	        var end = $(this).datepicker('getDate'); 
	    }
    });

    $( "#start-date" ).datepicker( "option", "dateFormat", 'mm/dd/yy' );
    $( "#end-date" ).datepicker( "option", "dateFormat", 'mm/dd/yy' );

    

    $(window).load(function() {
    	$('#send-search').click(function(){
	    	filter_shipping();
	    });
		filter_shipping(); 
	});

    function filter_shipping(){

    	var name = $('#search-name').val();
    	var start = $('#start-date').val();
    	var end = $('#end-date').val();
    	var stat = $('#status-payment').val();

    	$.post('<?php echo base_url()?>shipping/lists',{name:name,start:start,end:end,stat:stat,action:'request'},function(result){
    		$('#listing-searched-table').html(result);
    	});
    }
</script>
<?php echo $this->load->view('buyer/footer') ?>