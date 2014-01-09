<?php echo $this->load->view('supplier/header') ?>
<script src="<?php echo base_url()?>js/jquery.flexslider.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>js/flexslider.css"/>

<script type="text/javascript">  
	$(window).load(function() {
		$('.flexslider').flexslider({
			animation: "fade",
			slideshowSpeed: 8000,
			controlsContainer: ".number-slide", 
			directionNav: false,
			startAt: 0,                 
			slideshow: false,
		    start: function(slider) {
			    $('.right-navi').click(function(event){
			        event.preventDefault();
			        slider.flexAnimate(slider.getTarget("next"));
			    });
			    $('.left-navi').click(function(event){
			        event.preventDefault();
			        slider.flexAnimate(slider.getTarget("prev"));
			    });
			}
		});


	});
</script>

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
						<p class='breadcrumbs fl'>Update Stock: <?php echo $this->categories->create_breadcrumb($inventory->cat_id,$inventory->c_level)?></p>
					</div>

					<div class='product-cont padded-cont clearfix'>
							
						<div class='sel-add-stock-cont clearfix'>
							<h3>Product Summary</h3>
							<div class='right-prod-det normal-style fl clearfix'>
								<div class='inner-img-prod-list'>
									<?php if(count($image_list) == 0){?>
										<img width=240 src="<?php echo base_url()?>images/default-preview.jpg">
									<?php }else{?>	
										<div class="flexslider">
										  <ul class="slides">
										  	<?php foreach($image_list as $img){?>
										    <li>
										    	<a onclick='return false' href="<?php echo $img->ii_link?>">
										    		<img width=240 src="<?php echo $img->ii_link?>" id="slide0" />
										    	</a>
										    </li>
										    <?php }?>
										  </ul>
										</div>
									<?php }?>
								</div>
								<div class='clear'></div>
								<div class="navi-img-slide clearfix">
									<a class='left-navi' href="#"></a>
									<div class="fl number-slide clearfix">

									</div>
									<a class='right-navi' href="#"></a>
								</div>
							</div>
							<div class='product-detail-info width-400 normal-style fl'>
								<h3><?php echo $inventory->tr_title?></h3>
								<div class="orange-line"> </div>
								<div>
									<p>Manufacturer: <span><?php echo $inventory->m_name?></span></p>
								</div>
								<div>
									<p>Brand: <span><?php echo $inventory->b_name?></span></p>
								</div>
								<div>
									<p>Weight: <span><?php echo $inventory->weight.' '.$inventory->weightScale?></span></p>
								</div>
							</div>
						</div>

						<div class="clear"> </div>

						<div class="fl half">
							<label for='sku'>SKU*</label>
							<div class="clear"> </div>
							<input type="text" id='sku' value="<?php echo $inventory->SKU ?>"/>
						</div>
						<div class="fl half">
							<label for='quan'>Quantity*</label>
							<div class="clear"> </div>
							<input type="text" id='quan' value="<?php echo $inventory->ic_quan ?>" />
						</div>

						<div class="fl half">
							<label for='price'>Price*</label>
							<div class="clear"> </div>
							<input type="text" id='price'  value="<?php echo $inventory->ic_price ?>" />
						</div>

						<div class="fl half">
							<label for='ret_price'>Retail Price*</label>
							<div class="clear"> </div>
							<input type="text" id='ret_price'value="<?php echo $inventory->ic_retail_price ?>" />
						</div>

						<div class="fl half">
							<label for='map'>MAP(Minimum Advertized Price)</label>
							<div class="clear"> </div>
							<input type="text" id='map' value="<?php echo $inventory->ic_map ?>" />
						</div>

						<div class="fl half">
							<label for='ship_cost'>Shippng Cost</label>
							<div class="clear"> </div>
							<input type="text" id='ship_cost' value="<?php echo $inventory->ic_ship_cost ?>" />
						</div>	

						<div class="fl half">
							<label for='ship_from'>Shippng From</label>
							<div class="clear"> </div>

							<select id='ship_from'>
							<?php foreach($countries as $country){?>
								<option <?php if($inventory->ic_ship_country)echo 'selected="selected"'; ?> value='<?php echo $country->c_id?>'><?php echo  $country->c_name?>	</option>
							<?php }?>
							</select>
						</div>	

						<div class="fl half">
							<label for='lead_time'>Lead Time*</label>
							<div class="clear"> </div>
							<input type="text" id='lead_time' value='<?php echo $inventory->ic_ship_country ?>' />
						</div> 

						<div class="clear"> </div>
						<div class="clearfix">
							<label for='prom_text'>Promotional Text</label>
							<div class="clear"> </div>
							<textarea id='prom_text' class='normal-format-text full-ta'><?php echo $inventory->ic_prom_text ?></textarea>
						</div>



						<div class="clear"> </div>
						<button class='fr normal-button step-format' id='save-update-stock'>Update</button>

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
			});

		});

		$('#save-update-stock').click(function(){
			var sku =  $('#sku').val();
			var quan =  $('#quan').val();
			var price =  $('#price').val();
			var ret_price =  $('#ret_price').val();
			var ic_id =  '<?php echo $inventory->ic_id ?>';
			var lead_time =  $('#lead_time').val();

			var ship_cost =  $('#ship_cost').val();
			var ship_from =  $('#ship_from').val();
			var map =  $('#map').val();
			var prom_text =  $('#prom_text').val();

			$.post('<?php echo base_url()?>inventory/update',{sku:sku,quan:quan,price:price,ret_price:ret_price,ic_id:ic_id,lead_time:lead_time, ship_cost:ship_cost,ship_from:ship_from,map:map,prom_text:prom_text,
				action:'update_stock'},function(result){
				window.location.reload();
			});

		});
	});
</script>

<?php echo $this->load->view('supplier/footer') ?>