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
						<p class='breadcrumbs fl'> My Sales </p>
					</div>

					<div class='padded-cont'>
						<div class='informative-format'>

							<div class='sales-result-trans clearfix'>

							</div>

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

/*	var sel_date = $('.range_sel_week').val();

	$('.range_sel_week').change(function(){
		sel_date = $('.range_sel_week').val();
		load_payment_list();
	});*/


	load_payment_list();

	function load_payment_list()
	{

		$.post('<?php echo base_url()?>sale/report',{type:'byweek-all'},function(result){
			$('.sales-result-trans').html(result);
		});
	}

</script>
<?php echo $this->load->view('supplier/footer') ?>