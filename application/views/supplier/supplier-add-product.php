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
					<div class="heading-yellow-full"> 
						<p class='fl'>Search Product Existing:</p>
					</div>


					<div class="search-top-product clearfix">
						<label>UCP/EAN/MANUFACTURER PART NUMBER</label>
						<input id="search-product" class='normal-format-text' value="" /> 
						<button id='search-item' class='normal-button'>SEARCH</button>
						<div class='clear'></div>
						<p class='fl link-addmaster'>If it is not in Oceantailer's Inventory:
							<a href="<?php echo base_url()?>inventory/add">Add Product</a>
						</p>
					</div>
					
				</div>				
			
				<div class='right-inner clearfix'> 
					<div class="heading-yellow-full"> 
						<p class='fl'>Search Result:</p>
					</div>
					<div id='search-result-product' class='clearfix'>

					</div>
				</div>

				

			</div>

		<!-- MIDDLE PAGE CONTAINER-->
		</div>
		<div class="bg-body-bottom"> </div>
	</div>

</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#search-item').click(function(){
			var search_prod = $('#search-product').val();

			$.post('<?php echo base_url()?>inventory/search/supplier_search_add',
				{search_prod:search_prod},function(result){
					$('#search-result-product').html(result);
				setSizes(); 
			});

			setSizes(); 

		});
	});
</script>
<?php echo $this->load->view('supplier/footer') ?>