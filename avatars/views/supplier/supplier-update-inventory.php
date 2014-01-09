<?php echo $this->load->view('supplier/header') ?>
<script src="<?php echo base_url()?>js/organictabs.jquery.js" type="text/javascript"></script>

<div class="global-cont">

	<div class='bg-body'>
		<div class="bg-body-top"> </div>
		<div class="bg-body-middle clearfix">
		<!-- MIDDLE PAGE CONTAINER-->

			<!-- LEFT SIDEBAR CONTAINER-->
			<div id="left-sidebar" class="clearfix fl">
				<?php echo $this->load->view('supplier/sidebar') ?>
			</div>

			<div class='right-cont clearfix fr'>

<!--PRODUCT PAGE CONTAINER-->
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
	        	<a id='link-desc' href="#description">
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
	        <li class="nav-five">
	        	<a id='link-stock' href="#stock">
	        		<div class="head-tab fl"> 
						<div class="tab-left fl"> </div>
						<div class="tab-center fl"> 
							<p class="fl">Stock</p> 
						</div>
						<div class="tab-right fl"> </div>
					</div>
	        	</a>
	        </li>
	        <li class="nav-six">
	        	<a id='link-image' href="#images">
	        		<div class="head-tab fl"> 
						<div class="tab-left fl"> </div>
						<div class="tab-center fl"> 
							<p class="fl">Images</p> 
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

						<div class='breadcrumb-main-cont'>
							<div id="category-breadcrumbs"> <p><?php echo $bread_crumb = $this->categories->create_breadcrumb($product->cat_id, $product->c_level);  ?></p>  </div>	
						</div>
						<div id='category-main-cont' class='clearfix'>

								<div class="category-selectable-cont fl" id='category-level-0'>
									<?php if(count($categories) != 0)
										{ ?>
											<?php foreach($categories as $category){
												$number_sub = count($this->categories->listing_subcategory($category->c_id));
												$class = "class=''";
												if($category->c_id == $product->cat_id)
													$class = "class='active'";

											?>
											<div id="cat-sel<?php echo $category->c_id ?>" <?php echo $class;?> onclick='return select_category(<?php echo $category->c_id?>,"<?php echo $category->c_name?>",<?php echo $category->c_level?>)' value="<?php echo $category->c_id?>"><?php echo $category->c_name?>(<?php echo $number_sub?>)</div>
											<?php }?>  
									<?php }?>
								</div>

							<?php $parent_product = $product->c_level; 
								  $loop_end = 1;
								 ?>
								
 							<?php while($parent_product != 0 && $loop_end <= $parent_product){ ?>

								<div class="category-selectable-cont fl" id='category-level-<?php echo $loop_end?>'>
									<?php 
									$categories = $this->categories->listings($loop_end);
									if(count($categories) != 0)
										{ ?>
											<?php foreach($categories as $category){
												$number_sub = count($this->categories->listing_subcategory($category->c_id));
												$class = "class=''";
												if($category->c_id == $product->cat_id)
													$class = "class='active'";

											?>
											<div id="cat-sel<?php echo $category->c_id?>" <?php echo $class;?> onclick='return select_category(<?php echo $category->c_id?>,"<?php echo $category->c_name?>",<?php echo $category->c_level?>)' value="<?php echo $category->c_id?>"><?php echo $category->c_name?>(<?php echo $number_sub?>)</div>
											<?php }?>  
									<?php }?>
								</div>

							<?php $loop_end += 1; }?>
						</div>	
										

					</div>



				</li>
			</ul>

			 <ul id="basic" class="hide">
	            <li>
					<div class='product-cont padded-cont clearfix'>
						<h3>Basic Information</h3>
						<div class="fl half clearfix">
							<label for='manu'>Manufacture</label>
							<div class="clear"> </div>
							<input type='text' value='<?php echo $product->m_name?>' id='search-manufacturer' />
							<div class='float-dropdown' id='search-manu-result'> </div>
						</div> 

						<div class="fl half clearfix">
							<label for='brand'>Brand</label>
							<div class="clear"> </div>
							<input type='text' value='<?php echo $product->b_name?>' id='search-brand' />
							<div class='float-dropdown' id='search-brand-result'></div>
						</div>

						<div class="fl half clearfix">
							<label for='manu_num'>Manufacturer Part Number</label>
							<div class="clear"> </div>
							<input type="text" id='manu_num' value="<?php echo $product->manuf_num?>"/>
						</div>
						<div class="fl half clearfix">
							<label for='ucp_ean'>UPC/EAN</label>
							<div class="clear"> </div>
							<input type="text" id='ucp_ean' value="<?php echo $product->ucp_ean?>"/>
						</div>

						<div class="fl half clearfix">
							<label for='sup_fee'>Item Price</label>
							<div class="clear"> </div>
							<input type="text" id='sup_fee' value="<?php echo $product->weight?>"/>
						</div>

						<div class="fl half clearfix">
							<label for='ship_alone'>Ship Alone?</label>
							<div class="clear"> </div>
							<select id='ship_alone'>
								<option <?php  if($product->ship_alone == 1) {?> selected="selected" <?php }?>  
								value=1>Yes</option>
								<option <?php  if($product->ship_alone == 0) {?> selected="selected" <?php }?>   value=0>No</option>
							</select>
						</div>
					<div class="clear"> </div>	
					</div>
	            </li>
			 </ul>

			<ul id="description" class="hide">
	            <li>
	            	<div class='product-cont padded-cont clearfix'>
						<h3>Description</h3>
						<div class='desc-cont-inner'>

							<div class="fl half clearfix"> 
								<label for='trans-title'>Title</label>
								<div class="clear"> </div>
								<input type="text" id='trans-title' value=""/>
							</div>
							<div class="clear"></div>
							<div class="fl full clearfix"> 
								<label for='trans-short-des'>Short Description</label>
								<div class="clear"> </div>
								<textarea id='trans-short-desc'></textarea>
							</div>
							<div class="fl full clearfix"> 
								<label for='trans-desc'>Main Decription</label>
								<div class="clear"> </div>
								<textarea id='trans-desc' rows='10'></textarea>
							</div>
							<div class="clear"></div>
							<div class="fl half clearfix"> 
								<select id="trans-lang">
									<?php foreach($countries as $country){?> 
										<option <?php if($default_country == $country->c_id){ echo 'selected="selected"';}?> value="<?php echo $country->c_id?>"><?php echo $country->c_name?></option>
									<?php }?>
								</select>
							</div>

						</div>

						<div class="clear"> </div>

						<button id="add-translation" class='fr normal-button'>Add Translation</button>

						<div class="clear"> </div>

						<div class='violet-table'>
							<table>
								<tr>
									<td>Title</td>
									<td>Short Description</td>
									<td>Decription</td>
									<td>Language</td>
									<td>Action</td>
								</tr>
								<?php 
								$limit = 90;
								foreach($translation_list as $trans){?>
									<tr>
										<td><?php echo $trans->tr_title?></td>
										<td><?php echo substr($trans->tr_short_desc,0,$limit) ?></td>
										<td><?php echo substr($trans->tr_desc,0,$limit) ?></td>
										<td><?php echo $trans->c_name?></td>
										<td><center>
												<a onclick="return updateTranslation(<?php echo $trans->tr_id?>)" href="#">Edit</a>,
												<a onclick="return deleteTranslation(<?php echo $trans->tr_id?>)" href="#">Delete</a>
											</center>
										</td>
									</tr>
								<?php }?>
							</table>
						</div>

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
							<input type="text" id='weight' value="<?php echo $product->weight?>"/>
						</div>

						<div class="fl half clearfix">
							<label for='weight_scale'>Weight Scale</label>
							<div class="clear"> </div>
							<select id="weight_scale">
								<?php foreach($list_scale as $scale){?>
								<option <?php  if($product->weightScale == $scale->scale_name) {?> selected="selected" <?php }?> 
									value="<?php echo $scale->scale_name?>"><?php echo $scale->scale_name?></option>
								<?php }?>  
							</select>
						</div>

						<h3>Dimension Details</h3>

						<div class="fl half clearfix">
							<label for='height'>Height</label>
							<div class="clear"> </div>
							<input type="text" id='height' value="<?php echo $product->d_height?>"/>
						</div>

						<div class="fl half clearfix">
							<label for='width'>Width</label>
							<div class="clear"> </div>
							<input type="text" id='width' value="<?php echo $product->d_width?>"/>
						</div>

						<div class="fl half clearfix">
							<label for='depth'>Depth</label>
							<div class="clear"> </div>
							<input type="text" id='depth' value="<?php echo $product->d_dept?>"/>
						</div>

						<div class="fl half clearfix">
							<label for='dimension_scale'>Dimension Scale</label>
							<div class="clear"> </div>
							<select id="dimension_scale">
								<?php foreach($scale_dimension as $dimension){?>
								<option <?php  if($product->d_scale == $dimension->sd_name) {?> selected="selected" <?php }?> 
								 value="<?php echo $dimension->sd_name?>"><?php echo $dimension->sd_name?></option>
								<?php }?>  
							</select>
						</div>

						

					</div>
			    </li>
			 </ul>

			 <ul id="stock" class="hide">
			    <li>
					<div class='product-cont padded-cont clearfix'>
						<h3>Stock Offer</h3>

						<div class="fl half">
							<label for='sku'>SKU*</label>
							<div class="clear"> </div>
							<input type="text" id='sku' value="<?php echo $product->SKU?>"/>
						</div>
						<div class="fl half">
							<label for='quan'>Quantity*</label>
							<div class="clear"> </div>
							<input type="text" id='quan' value='1' value="<?php echo $product->ic_quan?>" />
						</div>
						<div class="fl half">
							<label for='price'>Price*</label>
							<div class="clear"> </div>
							<input type="text" id='price' value="<?php echo $product->ic_price?>" />
						</div>
						<div class="fl half">
							<label for='ret_price'>Retail Price*</label>
							<div class="clear"> </div>
							<input type="text" id='ret_price' value="<?php echo $product->ic_retail_price?>" />
						</div>

						<div class="fl half">
							<label for='map'>MAP(Minimum Advertized Price)</label>
							<div class="clear"> </div>
							<input type="text" id='map' value="<?php echo $product->ic_map?>" />
						</div>

						<div class="fl half">
							<label for='ship_cost'>Shippng Cost</label>
							<div class="clear"> </div>
							<input type="text" id='ship_cost' value='<?php echo $product->ic_ship_cost?>' />
						</div>	

						<div class="fl half">
							<label for='ship_from'>Shippng From</label>
							<div class="clear"> </div>

							<select id='ship_from'>
							<?php foreach($countries as $country){?>
								<option <?php if($product->c_id == $country->c_id){ ?> selected='selected'  <?php }?>value='<?php echo $country->c_id?>'><?php echo  $country->c_name?></option>
							<?php }?>
							</select>
						</div>	

						<div class="fl half">
							<label for='lead_time'>Lead Time*</label>
							<div class="clear"> </div>
							<input type="text" id='lead_time' value='<?php echo $product->ic_leadtime?>' />
						</div> 
						<div class='clearfix'></div>
						<div class="clearfix">
							<label for='prom_text'>Promotional Text</label>
							<div class="clear"> </div>
							<textarea id='prom_text' class='normal-format-text full-ta'><?php echo $product->ic_prom_text?></textarea>
						</div>

	
						<div class="fr half clearfix">
							<input type='button' class='fr normal-button' id="update-child" value="Update Stock" />
						</div>

					</div>
			    </li>
			 </ul>	

			 <ul id="images" class="hide">
				<li>
					<div class='product-cont padded-cont clearfix'>
						<h3>Images</h3>
				

						<?php echo form_open_multipart('upload/index');?>
						    <p>
						    	<label for="Filedata">Choose a File</label><br/>
						        <?php echo form_upload(array('name' => 'Filedata', 'id' => 'upload'));?>
						        <a href="javascript:$('#upload').uploadifyUpload();"></a>
						    </p>
						<?php echo form_close();?>
						<div id="target-image-upload" class="images-cont clearfix">

							<?php 
							$has_img_set = 0 ;
							foreach($image_list as $img){
								  $data_link['link'] = $img->ii_link;
								  $data_link['id'] = $img->ii_id;
								  $data_link['feat'] = $img->ii_feat;
								  $has_img_set = 1;
							?>
								<?php echo $this->load->view('admin/inventory/inventory-image-list',$data_link, true); ?>
							<?php }?>

						</div>
						
					</div>
				</li>
			</ul>		 
			 
		 </div> <!-- END List Wrap -->
	 
	 </div> 
	<!-- PRODUCT PAGE CONTAINER END-->		

	<div class="fr half clearfix">
		<input type='button' class='fr normal-button' id="update-product" value="Update Product" />
	</div>		
				

			</div>


		<!-- MIDDLE PAGE CONTAINER-->
		</div>
		<div class="bg-body-bottom"> </div>
	</div>

</div>


<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/uploadify/uploadify.css" />
<script type="text/javascript" language="javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>js/uploadify/jquery.uploadify.v2.1.4.min.js"></script>

<script type="text/javascript" language="javascript">
	var brand_sel = '<?php echo $product->b_id?>';
	var manufacture_sel = '<?php echo $product->m_id?>';
	var category_sel = '<?php echo $product->cat_id?>';
	$(document).ready(function(){

		$("#update-product").click(function(){
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
			alert(category_sel);

			$.post("<?php echo base_url()?>inventory/update",
				{ucp_ean:ucp_ean,manu_num:manu_num,manu:manu,brand:brand,
				weight:weight,weight_scale:weight_scale,sup_fee:sup_fee,ship_alone:ship_alone,
				height:height,width:width,depth:depth,d_scale:d_scale,category:category,id:<?php echo $product->i_id?>,
				action:'update_product'}, function(result){
					alert(result);
				var  convert = JSON.parse(result);

				if(convert.status == 0) // has error input
				{	
					alert(convert.message);
					$('.result-product-add').hide();
					$('.result-product-add').html(convert.message);
					$('.result-product-add').fadeIn();
				}
				else
				{
					window.location.reload();
				}


			});			
		});

		$('#update-child').click(function(){
			var sku =  $('#sku').val();
			var quan =  $('#quan').val();
			var price =  $('#price').val();
			var ret_price =  $('#ret_price').val();
			var icid =  '<?php echo $product->ic_id ?>';
			var lead_time =  $('#lead_time').val();

			var ship_cost =  $('#ship_cost').val();
			var ship_from =  $('#ship_from').val();
			var map =  $('#map').val();
			var prom_text =  $('#prom_text').val();

			$.post("<?php echo base_url()?>inventory/update",{sku:sku,quan:quan,price:price,ret_price:ret_price,ic_id:icid,lead_time:lead_time,
				ship_cost:ship_cost,ship_from:ship_from,map:map,prom_text:prom_text,
				action:'update_stock'},
				function(result){
					alert(result);
			});
		});	

		$("#upload").uploadify({
				uploader: '<?php echo base_url();?>js/uploadify/uploadify.swf',
				script: '<?php echo base_url();?>js/uploadify/uploadify.php',
				cancelImg: '<?php echo base_url();?>js/uploadify/cancel.png',
				folder: '/oceantailer/product_image',
				scriptAccess: 'always',
				multi: true,
				auto:true,
				width: 110,
				'onError' : function (a, b, c, d) {
					 if (d.status == 404)
						alert('Could not find upload script.');
					 else if (d.type === "HTTP")
						alert('error '+d.type+": "+d.status);
					 else if (d.type ==="File Size")
						alert(c.name+' '+d.type+' Limit: '+Math.round(d.sizeLimit/1024)+'KB');
					 else
						alert('error '+d.type+": "+d.text);
					},
				'onComplete'   : function (event, queueID, fileObj, response, data) {
					//Post response back to controller
					$.post('<?php echo site_url('upload/product_attachment');?>',
						{product_id:<?php echo $product->i_id?>,filearray: response},
						function(info){
						$("#target-image-upload").append(info);  //Add response returned by controller
						setSizesDynamic();	
						$('#target-image-upload div a').imgPreview({
						    containerID: 'imgPreviewWithStyles',
						    imgCSS: {
						        // Limit preview size:
						        height: 200
						    },
						    // When container is shown:
						    onShow: function(link){
						        $('<span>' + $(link).text() + '</span>').appendTo(this);
						    },
						    // When container hides: 
						    onHide: function(link){
						        $('span', this).remove();
						    }
						});					
					});								 			
				}
		});	
		
		$(function() {
        	$("#product-tab").organicTabs();
    	});

		<?php if($has_img_set){?>

			$('#target-image-upload div a').imgPreview({
			    containerID: 'preview-slides',
			    imgCSS: {
			        // Limit preview size:
			        height: 200
			    },
			    // When container is shown:
			    onShow: function(link){
			        $('<span>' + $(link).text() + '</span>').appendTo(this);
			    },
			    // When container hides: 
			    onHide: function(link){
			        $('span', this).remove();
			    }
			});

		<?php }?>

		$('#add-translation').click(function(){
			var title = $("#trans-title").val();
			var short_desc = $("#trans-short-desc").val();
			var desc = $("#trans-desc").val();
			var lang = $("#trans-lang").val();

			$.post('<?php echo base_url()?>inventory/translation',{id:<?php echo $product->i_id?>,title:title,short_desc:short_desc,desc:desc,lang:lang,action:'add'}, function(data){
				window.location.reload();

			});
		});

		
		$('.close-pop-out').click(function(){
			$('.popout-cont').fadeOut();
		});
	});

	function pop_image_link(id){
		$('.popout-image').fadeIn();
		return false;
	}

	function set_featured(id){
		$.post('<?php echo base_url()?>inventory/update',{id:<?php echo $product->i_id?>,imgid:id,action:'set_feature_image'}, function(data){
			return false;
		});
	}

	function delete_image(id)
	{
		$.post('<?php echo base_url()?>inventory/delete',{imgid:id,action:'image'}, function(data){
			window.location.reload();
		});
	}

	function updateTranslation(id)
	{
		$('#popTranslation').fadeIn();
		$.post('<?php echo base_url()?>inventory/translation',{id:id,action:'detail'},function(data){
			var  result = JSON.parse(data);
			$('#trans-title-update').val(result.tr_title);
			$('#trans-short-desc-update').val(result.tr_short_desc);
			$('#trans-desc-update').val(result.tr_desc);
			$('#trans-id-update').val(result.tr_id);
		});
		return false;
	}

	function deleteTranslation(id)
	{
		$.post('<?php echo base_url()?>inventory/translation',{id:id,action:'delete'}, function(data){
			window.location.reload();
		});
	}

	$('#update-translation').click(function(){
		var title = $('#trans-title-update').val();
		var short_desc = $('#trans-short-desc-update').val();
		var desc = $('#trans-desc-update').val();
		var id = $('#trans-id-update').val();

		$.post('<?php echo base_url()?>inventory/translation',{id:id,title:title,short_desc:short_desc,desc:desc,action:'update'},function(){

		});
		window.location.reload();
	});

	///////////////// MANUFACTURER AND BRAND FUNCTIONS///////////////////////////////////


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
		alert(brand_sel);
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

	function setSizesDynamic() {
		   var containerHeight = $(".right-cont").height();

		   if((containerHeight - 258) > 350)
		   	$(".bg-body-middle").height(containerHeight - 258);
	}

	$('.nav li a').click(function(){
		var id = this.id;

		if(id == "link-desc" || id == "link-image" || id == "link-stock")
			$('#update-product').hide();
		else
			$('#update-product').fadeIn();
		setTimeout(setSizesDynamic,500);
	});




</script>

<script src="<?php echo base_url()?>js/imgpreview.full.jquery.js" type="text/javascript"></script>



<?php echo $this->load->view('supplier/footer') ?>