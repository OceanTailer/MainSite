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
						<p class='breadcrumbs fl'>My Inventory </p>
					</div>

					<div class='search-container clearfix'>
						<div class="clearfix">
							<label for='search-name'>Product Name</label>
							<div class='clear'></div>
							<input type="text" id='search-name'  class='normal-format-text' value=''/>
						</div>

						<div class="clearfix">
						<label>Manufacturer</label>

						<div class='clearfix'>
								<input type='text' value='' id='search-manufacturer' class='normal-format-text' />
								<div class='float-dropdown' id='search-manu-result'> </div>
						</div>
						<div class='clear'></div>

						</div>

						<div class="clearfix">
							<label for='brand'>Brand</label>
							<div class='clearfix'>
								<input type='text' value='' id='search-brand' class='normal-format-text' />
								<div class='float-dropdown' id='search-brand-result'></div>
							</div>
						</div>


					</div>

					

					<div class='padded-cont'>
						<div class='violet-table'>
							<table id='list-product-result'>

							</table>
						</div>
					</div>				
				</div>
			</div>

			<script type="text/javascript" language="javascript">

				var brand_sel = '';
				var manufacture_sel = '';


				$(document).ready(function(){

					filter_product();

					$('#search-name').keyup(function(){
						filter_product();
					});

					$('#manu').change(function(){
						filter_product();
					});


					$('#search-manufacturer').keyup(function(){
						var search_manu = this.value;
						manufacture_sel = '';
						manufacture_sel = search_manu;
						if(search_manu != '')
						{
							$.post('<?php echo base_url()?>manufacturer/search',{m_val:search_manu,type:'dropdown'},function(result){
								$('#search-manu-result').html(result);
							});
							
						}
						else
							$('#search-manu-result').html('');
						filter_product();
					});	

					$('#search-brand').keyup(function(){
						var search_brand = this.value;
						brand_sel = search_brand;

						if(search_brand != '')
						{	
							$.post('<?php echo base_url()?>brand/search',{b_val:search_brand,m_val:manufacture_sel,type:'dropdown'},function(result){
								$('#search-brand-result').html(result);
							});
							
							
						}
						else
							$('#search-brand-result').html('');
						filter_product();
					});		

				});

				function select_brand(id,name)
				{
					$('#search-brand').val(name);
					brand_sel = name;
					$('#search-brand-result').html('');
					filter_product();
				}	

				function select_manufacture(id,name)
				{
					$('#search-manufacturer').val(name);
					manufacture_sel = name;
					$('#search-manu-result').html('');
					filter_product();
				}

				function filter_product()
				{
					var name = $('#search-name').val();
					var manu = manufacture_sel;
					var brand = brand_sel;
					$.post('<?php echo base_url()?>inventory/search',{name:name,manu:manu,brand:brand},function(data){
						$('#list-product-result').html(data);
					});
					setSizes();
				}	

			</script>			

		<!-- MIDDLE PAGE CONTAINER-->
		</div>
		<div class="bg-body-bottom"> </div>
	</div>

</div>
<?php echo $this->load->view('supplier/footer') ?>