<?php echo $this->load->view('admin/header') ?> 
<script src="<?php echo base_url()?>js/organictabs.jquery.js" type="text/javascript"></script>

<div class="global-cont">

	<div class='bg-body'>
		<div class="bg-body-top"> </div>
		<div class="bg-body-middle clearfix">
		<!-- MIDDLE PAGE CONTAINER-->

			<!-- LEFT SIDEBAR CONTAINER-->
			<div id="left-sidebar" class="clearfix fl">
				<?php echo $this->load->view('admin/inventory/sidebar') ?>
			</div>
			<?php $has_permission = $this->administrators->check_permission($this->session->userdata('id'),2);?>
			<!-- RIGHT CONTENT CONTAINER-->
			<div class='right-cont clearfix fr'>
				<?php if($has_permission){?>
				<!-- PRODUCT PAGE CONTAINER-->
				<div id="product-tab">
							
					<ul class="nav">
				        <li class="nav-one">
				        	<a href="#featured" class="current">
								<div class="head-tab fl"> 
									<div class="tab-left fl"> </div>
									<div class="tab-center fl"> 
										<p class="fl">Classification</p> 
									</div>
									<div class="tab-right fl"> </div>
								</div>
				        	</a>
				        </li>
				        <li class="nav-two">
				        	<a href="#basic">
				        		<div class="head-tab fl"> 
									<div class="tab-left fl"> </div>
									<div class="tab-center fl"> 
										<p class="fl">Basic Information</p> 
									</div>
									<div class="tab-right fl"> </div>
								</div>
				        	</a>
				        </li>
				        <li class="nav-three">
				        	<a href="#description">
				        		<div class="head-tab fl"> 
									<div class="tab-left fl"> </div>
									<div class="tab-center fl"> 
										<p class="fl">Description</p> 
									</div>
									<div class="tab-right fl"> </div>
								</div>
				        	</a>
				        </li>
				        <li class="nav-four">
				        	<a href="#extra">
				        		<div class="head-tab fl"> 
									<div class="tab-left fl"> </div>
									<div class="tab-center fl"> 
										<p class="fl">Extra Information</p> 
									</div>
									<div class="tab-right fl"> </div>
								</div>
				        	</a>
				        </li>
				    </ul>
					
					<div class="list-wrap">
					
						<ul id="featured">
							<li>
								<div class='product-cont padded-cont clearfix'>
									<h3>Classification</h3>
									<div class="fl clearfix">
										<div class="clear"> </div>
										<div id="category-breadcrumbs">  </div>	
										<div class="clear"> </div>
										<div id='category-main-cont' class='clearfix'>
											<div class="category-selectable-cont fl clearfix" id='category-level-0'>
												<?php if(count($categories) != 0)
													{ ?>
														<?php foreach($categories as $category){
															$number_sub = count($this->categories->listing_subcategory($category->c_id));
														?>
														<div id="cat-sel<?php echo $category->c_id?>" onclick='return select_category(<?php echo $category->c_id?>,"<?php echo $category->c_name?>",<?php echo $category->c_level?>)' value="<?php echo $category->c_id?>"><?php echo $category->c_name?>(<?php echo $number_sub?>)</div>
														<?php }?>  
												<?php }?>
											</div>
										</div>
									</div>
									<div class="clear"> </div>
									<button class='fr normal-button step-format' id='step_2'>NEXT</button>

								</div>



							</li>
						</ul>

						 <ul id="basic" class="hide">
				            <li>
								<div class='product-cont padded-cont clearfix'>
									<h3>Basic Information</h3>
									<div class="fl half clearfix">
										<label for='manu'>Manufacture</label>
										<div class='clearfix'>
											<input type='text' value='' id='search-manufacturer' />
											<div class='float-dropdown' id='search-manu-result'> </div>
										</div>
										<div class="clear"> </div>
									</div> 

									<div class="fl half clearfix">
										<label for='brand'>Brand</label>
										<div class='clearfix'>
											<input type='text' value='' id='search-brand' />
											<div class='float-dropdown' id='search-brand-result'></div>
										</div>
										<div class="clear"> </div>
									</div>

									<div class="fl half clearfix">
										<label for='ucp_ean'>UPC/EAN</label>
										<div class="clear"> </div>
										<input type="text" id='ucp_ean'/>
									</div>
									<div class="fl half clearfix">
										<label for='manu_num'>Manufacturer Part Number</label>
										<div class="clear"> </div>
										<input type="text" id='manu_num'/>
									</div>

									<div class="fl half clearfix">
										<label for='sup_fee'>Item Price</label>
										<div class="clear"> </div>
										<input type="text" id='sup_fee'/>
									</div>

									<div class="fl half clearfix">
										<label for='ship_alone'>Ship Alone?</label>
										<div class="clear"> </div>
										<select id='ship_alone'>
											<option value=1>Yes</option>
											<option value=0>No</option>
										</select>
									</div>
								<div class="clear"> </div>
								<button class='fr normal-button step-format' id='step_3'>NEXT</button>	
								</div>
				            </li>
						 </ul>

						<ul id="description" class="hide">
				            <li>
				            	<div class='product-cont padded-cont clearfix'>
									<h3>Description</h3>
									<div class='desc-cont-inner'>
										<div class="fl half clearfix"> 
											<label for='trans-title'>Product Name</label>
											<div class="clear"> </div>
											<input type="text" id='trans-title' value=""/>
										</div>
										<div class="clear"></div>
										<div class="fl full clearfix"> 
											<label for='trans-short-desc'>Short Description</label>
											<div class="clear"> </div>
											<textarea id='trans-short-desc'>

											</textarea>
										</div>
										<div class="fl full clearfix"> 
											<label for='trans-desc'>Main Description</label>
											<div class="clear"> </div>
											<textarea id='trans-desc' rows='10'>

											</textarea>
										</div>
										<div class="clear"></div>
										<div class="fl half clearfix"> 
											<?php foreach($countries as $country){?>
												<?php if($default_country == $country->c_id){ ?> 
													<input type="text" readonly='readonly' value="<?php echo $country_sel_name = $country->c_name?>"/>
													<input type='hidden' id="trans-lang" value="<?php echo $country->c_id?>"/>
												<?php }?>
											<?php }?>
											<div class="clear"> </div>
										</div>
										<div class='note-p'><i>Note: Language Set Default to <?php echo $country_sel_name?>, and different language description can be set After Saving</i></div>
								
									</div>
									<div class="clear"> </div>
									<button class='fr normal-button step-format' id='step_4'>NEXT</button>	
								</div>
				            </li>
				        </ul>			 
						 
						 <ul id="extra" class="hide">
						    <li>
								<div class='product-cont padded-cont clearfix'>
									<h3>Weight Details</h3>

									<div class="fl half clearfix">
										<label for='weight'>Weight</label>
										<div class="clear"> </div>
										<input type="text" id='weight'/>
									</div>

									<div class="fl half clearfix">
										<label for='weight_scale'>Weight Scale</label>
										<div class="clear"> </div>
										<select id="weight_scale">
											<?php foreach($list_scale as $scale){?>
											<option <?php if($scale->scale_name == "Pounds"){echo 'selected="selected"';}?> value="<?php echo $scale->scale_name?>"><?php echo $scale->scale_name?></option>
											<?php }?>  
										</select>
									</div>
									<h3>Dimension Details</h3>
									<div class="fl half clearfix">
										<label for='height'>Height</label>
										<div class="clear"> </div>
										<input type="text" id='height'/>
									</div>

									<div class="fl half clearfix">
										<label for='width'>Width</label>
										<div class="clear"> </div>
										<input type="text" id='width'/>
									</div>

									<div class="fl half clearfix">
										<label for='depth'>Depth</label>
										<div class="clear"> </div>
										<input type="text" id='depth'/>
									</div>

									<div class="fl half clearfix"> 
										<label for='dimension_scale'>Dimension Scale</label>
										<div class="clear"> </div>
										<select id="dimension_scale">
											<?php foreach($scale_dimension as $dimension){?>
											<option value="<?php echo $dimension->sd_name?>"><?php echo $dimension->sd_name?></option>
											<?php }?>  
										</select>
									</div>

				
									<div class="fr half clearfix">
										<input type='button' class='fr normal-button step-format' id="submit-product" value="Save" />
									</div>
								</div>
						    </li>
						 </ul>
						 
						 
					 </div> <!-- END List Wrap -->
				 
				 </div> 
				<!-- PRODUCT PAGE CONTAINER END-->

				<!-- PRODUCT RESULT CONTAINER-->
				<div class="result-product-add fr">
				</div>
				<!-- PRODUCT RESULT CONTAINER END-->
				<?php }else{?>
					<?php echo $this->load->view('admin/permission-error') ?>
				<?php }?>

			</div>
			<!-- RIGHT CONTENT CONTAINER-->

		<!-- MIDDLE PAGE CONTAINER-->
		</div>
		<div class="bg-body-bottom"> </div>
	</div>

</div>


<script type="text/javascript">
		
		var brand_sel = '';
		var manufacture_sel = '';
		var category_sel = '';

		level = 0;

		$('#search-manufacturer').keyup(function(){
			var search_manu = this.value;
			manufacture_sel = '';

			if(search_manu != '')
			{
				$.post('<?php echo base_url()?>manufacturer/search',{m_val:search_manu,type:'dropdown'},function(result){
					$('#search-manu-result').html(result);
				});
			}
			else
				$('#search-manu-result').html('');
		});

		$('#search-brand').keyup(function(){
			var search_brand = this.value;

			if(manufacture_sel == '')
			{
				alert('Select Manufacturer First');
				$('#search-brand').val('');
			}
			else
			if(search_brand != '')
			{
				$.post('<?php echo base_url()?>brand/search',{b_val:search_brand,m_val:manufacture_sel,type:'dropdown'},function(result){
					$('#search-brand-result').html(result);
				});
			}
			else
				$('#search-brand-result').html('');
		});

		function select_manufacture(id,name)
		{
			$('#search-manufacturer').val(name);
			manufacture_sel = id;
			$('#search-manu-result').html('');
		}

		function add_manufacturer()
		{
			var manufacture_name = $('#search-manufacturer').val();

			$.post('<?php echo base_url() ?>manufacturer/add',{manu_name:manufacture_name,action:'quickadd'},function(id){
					manufacture_sel = id;
			});
			$('#search-manu-result').html('');
		}

		function select_brand(id,name)
		{
			$('#search-brand').val(name);
			brand_sel = id;
			$('#search-brand-result').html('');
		}

		function add_brand()
		{
			var name_brand = $('#search-brand').val();

			$.post('<?php echo base_url() ?>brand/add',{name:name_brand,manu_id:manufacture_sel,action:'quickadd'},function(data){
					var  convert = JSON.parse(data);
					brand_sel = convert.b_id;
			});
			$('#search-brand-result').html('');
		}
		
		function select_category(id,name,lvl)
		{
			level = lvl+1;
			category_sel = id;
			for(var level_list = level+1; level_list < 20;level_list++)
			{
				$('#category-level-'+level_list).remove();
			}
			$.post('<?php echo base_url()?>category/detail',{id:id,level:level,view_type:'dropdown'},function(result){
				if ( $('#category-level-'+level).length){
					$('#category-level-'+level).remove();
				}
				$('#category-main-cont').append(result);
				setSizesDynamic();
			});

			$('.category-selectable-cont div').removeClass('active');
			$('#cat-sel'+category_sel).addClass('active');

			$.post('<?php echo base_url()?>category/detail',{id:id,level:level,view_type:'breadcrumbs'},function(result){
				$('#category-breadcrumbs').html(result);
				setSizesDynamic();
			});
			setSizesDynamic();
		}


		$('#submit-product').click(function(){
			var ucp_ean = $('#ucp_ean').val(); 
			var manu_num = $('#manu_num').val();
			
			var weight = $('#weight').val();
			var weight_scale = $('#weight_scale').val();
			var sup_fee = $('#sup_fee').val(); 
			var ship_alone = $('#ship_alone').val();

			var height = $('#height').val();
			var width = $('#width').val();
			var depth = $('#depth').val();
			var d_scale = $('#dimension_scale').val();

			var manu = manufacture_sel;
			var brand = brand_sel;
			var category = category_sel;

			var lang_title =  $('#trans-title').val();
			var short_desc =  $('#trans-short-desc').val();
			var long_decs =  $('#trans-desc').val(); 
			var lang =  $('#trans-lang').val();

			$.post("<?php echo base_url()?>inventory/add",
				{ucp_ean:ucp_ean,manu_num:manu_num,manu:manu,brand:brand,
				weight:weight,weight_scale:weight_scale,sup_fee:sup_fee,ship_alone:ship_alone,
				height:height,width:width,depth:depth,d_scale:d_scale,category:category,
				lang_title:lang_title,short_desc:short_desc,long_decs:long_decs,lang:lang,
				action:'add'}, function(result){
				var  convert = JSON.parse(result);

				if(convert.status == 0) // has error input
				{
					$('.result-product-add').hide();
					$('.result-product-add').html(convert.message);
					$('.result-product-add').fadeIn();
				}
				else
				{
					$(window.location).attr('href', ""+convert.message);
				}


			});

		});

	$('#step_2').click(function(){
		if(category_sel !="")
		{
			$('.nav-two a').trigger('click');	
		}
		else
			alert('Complete The Details');
	});

	$('#step_3').click(function(){
		if(brand_sel != "" && manufacture_sel !="")
		{
			$('.nav-three a').trigger('click');	
		}
		else
			alert('Fill Up Manufacturer and Brand');
	});

	$('#step_4').click(function(){

		$('.nav-four a').trigger('click');	

	});

	function setSizesDynamic(){

	   var containerHeight = $(".right-cont").height();
	   $(".bg-body-middle").height(containerHeight - 158);
	}



    $(function() {

        $("#product-tab").organicTabs();
        
    });

</script>

<?php echo $this->load->view('admin/footer') ?>