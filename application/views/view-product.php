<?php
if($this->session->userdata('is_login') == TRUE)
{
	$user_type = $this->session->userdata('type'); //get user type;
	if($user_type == 2) //2 is Supplier
	{
		echo $this->load->view('supplier/header');
	}
	elseif($user_type == 3) //3 is Buyer
	{
		echo $this->load->view('buyer/header');
	}
	elseif($user_type == 1) //1 Admin
	{
		echo $this->load->view('admin/header');
	}
}
else
		echo $this->load->view('header');
?>

<script src="<?php echo base_url()?>js/organictabs.jquery.js" type="text/javascript"></script>

<script src="<?php echo base_url()?>js/jquery.flexslider.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>js/flexslider.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/style.css"/>
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

				<?php
				if($this->session->userdata('is_login') == TRUE)
				{
					$user_type = $this->session->userdata('type'); //get user type;
					if($user_type == 2) //2 is Supplier
					{
						echo $this->load->view('supplier/sidebar');
					}
					elseif($user_type == 3) //3 is Buyer
					{
						echo $this->load->view('sidebar');
					}
					elseif($user_type == 1) //1 Admin
					{
						echo $this->load->view('admin/inventory/sidebar');
					}
				}
				else
						echo $this->load->view('sidebar');
				?>				

			</div>

			<!-- RIGHT CONTENT CONTAINER-->
			<div class='right-cont clearfix fr'>

				<div class='right-inner clearfix'>

					<!-- First Row Container-->
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'> <?php $this->categories->create_breadcrumb($product->cat_id,$product->c_level) ?> </p>
					</div>

					<div class="right-prod-det normal-style fl clearfix">
						<div class='inner-img-prod-list'>
							<?php if(count($image_list) == 0){?>
								<img width=240 src="<?php echo base_url()?>images/default-preview.jpg">
							<?php }else{?>	
								<div class="flexslider">
								  <ul class="slides">
								  	<?php foreach($image_list as $img){?>
								    <li>
								    	<a onclick='return false' href="<?php echo base_url().$img->ii_link?>">
								    		<img width=240 src="<?php echo base_url().$img->ii_link?>" id="slide0" />
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

					<div class='left-prod-det normal-style clearfix fl'>
						<h3><?php echo $product->tr_title?></h3>
						<div class='orange-line'> </div>
						<div class='clearfix'>
							<div class='half fl'>
								<p>EPID: <span> <?php echo $product->i_id?></span></p>
							</div>
							<div class='half fl'>
								<?php if($has_child){ ?>
									<p>MSRP: <span> $<?php echo $product->ic_retail_price?></span></p>
								<?php }else{ ?>
									<p>MSRP: <span> N/A</span></p>
								<?php }?>
								
							</div>
							<div class='half fl'>
								<p>Brand: <a href="#"><?php echo $product->b_name?></a></p>
							</div>
							<div class='half fl'>
								<?php if($has_child){ ?>
									<p>MAP: <a href="#"><?php echo $product->ic_map?></a></p>
								<?php }else{ ?>
									<p>MAP: <span> N/A</span></p>
								<?php }?>
								
							</div>
							<div class='half fl'>
								<p>Manufacturer: <a href="#"><?php echo $product->m_name?></a></p>
							</div>
							<div class='half fl'>
								<p>EST margin: <span>100%</span></p>
							</div>
							<div class='half fl'>
								<?php //$total_qty = $this->inventories->total_quantity($product->i_id);?>
								<?php if($has_child){ ?>
									<p>Qty in Stock: <span> <?php echo $product->ic_quan?></span></p>
								<?php }else{ ?>
									<p>Qty in Stock: <span> N/A</span></p>
								<?php }?>
							</div>
							<div class='half fl'>
								<?php //$total_qty = $this->inventories->total_quantity($product->i_id);?>
								<?php if($has_child){ ?>
									<p>Qty Remaining: <span> <?php echo $product->remaining_quantity?></span></p>
								<?php }else{ ?>
									<p>Qty Remaining:  <span> N/A</span></p>
								<?php }?>
								
							</div>
							<div class='half fl'>
								<?php if($has_child){ ?>
									<p>Your Cost: <span> $<?php echo $product->ic_price?></span></p>
								<?php }else{ ?>
									<p>Your Cost:  <span> N/A</span></p>
								<?php }?>
								
							</div>
							<div class='half fl'>
								<p>Condition: <span>New</span></p>
							</div>

							<div class='clear'></div>
							<br/>
							<div class='clearfix'>
								<?php if($has_child){ ?>
									<p>Supplier: <span><a href="#"><?php echo $product->u_company?></a></span></p>
								<?php }else{ ?>
									<p>Supplier:  <span>No Supplier Yet</span></p>
								<?php }?>
								
							</div>

							<div class='clear'></div>
							


						</div>
					</div>
					<?php if($has_child){ ?>
					<div class='add-to-cart-cont fl clearfix'>

						<div class='violet-container clearfix'>
							<div class='inner clearfix'>
								<div class='quan-input-cont'>
									<p class='fl'>Quantity:</p> <input readonly='readonly' type='text' id='quantity-cart' class='normal-format-text small fl' value='1' />
									<div class='stepper-cont'>
										<button class='stepper-up'></button>
										<button class='stepper-down'></button>
									</div> 
								</div>
								<div>
									<button class='add-to-cart' onclick='return add_to_cart(<?php echo $product->ic_id ?>)'>Add to Cart</button>
								</div>
								<div class='order-to-another-cont'>
									<!-- <p><a href="#">Order from <br/> another supplier</a></p> -->
								</div>
							</div>
						</div>

					</div>
					<?php }else{?>
					<div class='add-to-cart-cont fl clearfix'>

						<div class='violet-container clearfix'>
							<div class='inner clearfix'>
								<div class='quan-input-cont'>
									<p class='fl'>Quantity:</p> <input readonly='readonly' type='text' id='quantity-cart' class='normal-format-text small fl' value='1' />
									<div class='stepper-cont'>
										<button class='stepper-up'></button>
										<button class='stepper-down'></button>
									</div> 
								</div>
								<div>
									<button class='add-to-cart' >Cannot Add</button>
								</div>
								<div class='order-to-another-cont'>
									<!-- <p><a href="#">Order from <br/> another supplier</a></p> -->
								</div>
							</div>
						</div>

					</div>
					<?php }?>
					<!-- First Row Container END-->
					<div class='clear'></div>
				</div>

				<!-- SUPPLIER PRODUCT TAB CONTAINER-->
				<div id="supplier-product-tab">
							
					<ul class="nav">
				        <li class="nav-one">
				        	<a href="#featured" class="current">

				        	<div class="head-tab fl"> 
								<div class="tab-left fl"> </div>

								<div class="tab-center fl"> 
									<p class="fl">Description</p> 
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
										<p class="fl">Inventory and Promotion</p> 
									</div>
									<div class="tab-right fl"> </div>
								</div>
				        	</a>
				        </li>
				    </ul>
					
					<div class="list-wrap">
					
						<ul id="featured">
							<li>
								<div class='inner-list-wrap clearfix'>
									<div class='left-inner-desc-prod semi-gray fl'>

										<h4 class='arrow-bullet'><?php echo $product->tr_title?></h4>

										<p><?php echo $product->tr_short_desc?></p>
									</div>

									<div class='right-inner-desc-prod semi-gray fr'>
										<div class='gray-table'>
							                <table>
							                    <tr>
							                    	<td width=165 align='center' class='semi-gray'>Manufacture part No.</td>
							                    	<td width=165 class='black'><?php echo $product->manuf_num?></td>							                        
							                    </tr>
							                    <tr>
							                    	<td align='center' class='semi-gray'>GTIN (UPC/EAN)</td>
							                    	<td><?php echo $product->ucp_ean?></td>
							                    </tr>
							                    <tr>
							                    	<td align='center' class='semi-gray'>Shipping Weight</td>
							                    	<td><?php echo $product->weight.$product->weightScale?></td>
							                    </tr>
							                    <tr>
							                    	<td align='center' class='semi-gray'>Shipping Size</td>
							                    	<td>
							                    		<?php echo $product->d_height.$product->d_scale.' H x '.
							                    				   $product->d_width.$product->d_scale.' W x '.
							                    				   $product->d_dept.$product->d_scale.' D' ?>
							                    	</td>
							                    </tr>
							                    <tr>
							                    	<td align='center' class='semi-gray'>Lead Time</td>
							                    	<td><?php echo $product->ic_leadtime?></td>
							                    </tr>
							                </table>
						            	</div>
									</div>
								</div>
							</li>
						</ul>

						 <ul id="basic" class="hide">
				            <li>
				            	<div class='status-selection-cont clearfix'>
					            	<div class='status-selection'>
					            		<input type="radio" class="radio-type-sel" id="type-new">
					            		<label for="type-new">New</label>
					            	</div>
					            	<div class='status-selection'>
					            		<input type="radio" class="radio-type-sel" id="type-refurb">
					            		<label for="type-refurb">Refurbished</label>
					            	</div>

					            	<div class='status-selection'>
					            		<input type="radio" class="radio-type-sel" id="type-used">
					            		<label for="type-used">Used</label>
					            	</div>

					            	<div class='status-result'>
					            		<p>Showing 1 out of 10 offers</p>
					            	</div>

				            	</div>

				            	<div class='clear'></div>
				            	<div class='list-supplier-cont-prod'>
					            	<div class='gray-table'>
						                <table>
						                    <tr>
						                        <td width=270>Supplier</td>
						                        <td>Condition</td>
						                        <td>Onhand</td>
						                        <td>Price</td>
						                        <td>Retail Price</td>
						                        <td>Ship Price</td>
						                        <td>Ship From</td>
						                        <td>Promotion</td>
						                        <td width=30>Add</td>
						                    </tr>
						                    <?php 
						                    	if(isset($suppliers))
						                    	foreach($suppliers as $sup){
						                    	$remaining_quantity = $this->suppliers->get_child_remaining_quan($sup->ic_id, $sup->ic_quan);
						                    	?>
							                    <tr>
							                    	<td>
								                    	<p class='fl'>
								                    		<a onclick='return show_sup_status(<?php echo $sup->ic_id ?>)' href="#"><?php echo $sup->u_company ?></a>
								                    		<div class='supplier-status-cont float-cont' id='supplierstat<?php echo $sup->ic_id ?>'>
								                    			<div class='inner-sup-stat'>

								                    				<div class='heading-violet-full'>
								                    					<p class='fl'><?php echo $sup->u_company ?></p>
								                    				</div>

								                    				<div class='fl inner-left-sup-stat'>
									                    				<div class='fl'>
									                    					<p class='fl'>Feedback rating:</p>
									                    					<div id="sup_ic_rate<?php echo $sup->ic_id?>" class="fl sup_ic_rate-cont"></div>
																			<script type="text/javascript">
																				$(document).ready(function(){
														                            $('#sup_ic_rate<?php echo $sup->ic_id?>').raty({
														                              readOnly : true,
														                              score    : 4,
														                              width    : 150,
														                              path     :"<?php echo base_url().'images/'?>"
														                            });
														                        });
													                        </script>

									                    				</div>
									                    				<div class='clear'></div>
									                    				<div>
									                    					<p>Avarage lead time: <span><?php echo $this->suppliers->average_lead_time($sup->u_id); ?> business Days</span> </p>
									                    				</div>
									                    				<div class='clear'></div>
									                    				<div>
									                    					<p>Returns: <span>None</span></p>
									                    				</div>
									                    				<div class='clear'></div>
									                    				<div>
									                    					<p>Line in Hand: <span>100%</span></p>
									                    				</div>
									                    				<div class='clear'></div>
									                    				<div>
									                    					<p>Country:<span></span></p>
									                    				</div>
									                    				<div class='clear'></div>
									                    				<div>
									                    					<p>Launch Date:<span></span></p>
									                    				</div>
								                    				</div>

								                    				<div class='fr inner-right-sup-stat'>
								                    					<p class='feedback-top'>(Feedbacks: <span>127</span>)</p>
								                    					<p class='date-feedback'>15/03/2011</p>
								                    					<p>Excellent dealer. I’m happy with his performance.</p>
								                    					<p class='bottom-feedback-auth'>by <a href="#">yuri_t</a></p>
								                    				</div>

								                    			</div>
								                    			<div class='clear'></div>
								                    			<div class='bottom-arrow-pop'></div>
								                    		</div>
								                    	</p>
							                    		<div class='star-cont fl'>
							                    			<p class='fl percent'>56%</p><button class='star-rate fr'></button>
							                    		</div>
							                    		<div class='action-icon-cont fl'>
							                    			<a class='overview-icon fl' href="#"></a>
							                    			<a class='restriction-icon fl' href="#"></a>
							                    			<a class='returnPolicy-icon fl' href="#"></a>
							                    		</div>
							                    	</td>
							                    	<td>New</td>
							                    	<td><?php echo $remaining_quantity ?></td>
							                    	<td><?php echo $sup->ic_price ?></td>
							                    	<td><?php echo $sup->ic_retail_price ?></td>
							                    	<td><?php echo $sup->ic_ship_cost ?></td>
							                    	<td><?php echo $sup->c_code ?></td>
							                    	<td><?php echo $sup->ic_prom_text ?></td>
							                    	<td><button onclick="return add_to_cart(<?php echo $sup->ic_id ?>)" class='add-quick-cart'></button></td>
							                    </tr>
							                <?php }?>
						                </table>
					            	</div>
				            	</div>
				            </li>
						 </ul>
						 
					 </div> <!-- END List Wrap -->
				 
				 </div> 
				<!-- SUPPLIER PRODUCT TAB CONTAINER END-->


				<!-- TRANSLATION CONTAINER-->
				<div class="right-inner clearfix"> 
					<div class="heading-yellow-full"> 
						<p class="fl">Available Translations</p>
					</div>
					<div class='left-inner-trans-prod semi-gray fl'>
						<div class='gray-no-top'>
			                <table>
			                	<?php foreach($translations as $trans){?>
				                    <tr>
				                    	<td align='center' class='semi-gray'><?php echo $trans->c_name?></td>
				                    	<td class='black'><?php echo $trans->c_code?></td>							                        
				                    </tr>
			                    <?php }?>
			                </table>
		            	</div>
					</div>

				</div>
				<!-- TRANSLATION CONTAINER END-->

				<!-- FEEDBACK CONTAINER-->
				<div class="right-inner clearfix"> 
					<div class="heading-yellow-full"> 
						<p class="fl">Feedback</p>			
					</div>
					<div class='inner-feedback-cont'>
						<ul class='arrow-bullet clearfix'>
							<li>If you need help or have a question for <a href="#">Customer Service.</a></li>
							<li>Did you find an error or have a <a href="#">suggestion</a> about the product?</li>
							<li>Did you see the <a href="#"><?php echo $product->tr_title?></a> cheapen somewhere else?</li>
						</ul>
						<div class='orange-line'> </div>
						<input type='button' class='normal-button corpi-font' value='Add this product to feed' />
					</div>
				</div>
				<!-- FEEDBACK CONTAINER END-->

			</div>
			<!-- RIGHT CONTENT CONTAINER END-->

		<!-- MIDDLE PAGE CONTAINER-->
		</div>
		<div class="bg-body-bottom"> </div>
	</div>

</div>


<script type="text/javascript">
	$(function() {

        $("#supplier-product-tab").organicTabs();
        
    });
    $(window).load(function() {
	 
		$(".radio-type-sel").click(function(){
			if(!$(this).hasClass('radio-type-sel-active')) {
		        $(this).addClass('radio-type-sel-active');
		    }
		    else{
		    	$(this).removeClass('radio-type-sel-active');
		    }

		});

		 <?php if(count($image_list) != 0){?>
		 $('.inner-img-prod-list div.flexslider div.flex-viewport ul.slides li a ').imgPreview({
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
		
	});

	function show_sup_status(id)
	{
		$('#supplierstat'+id).fadeIn();
		return false;
	}

	$(document).mouseup(function (e)
	{
	    var container = $(".supplier-status-cont");

	    if (container.has(e.target).length === 0)
	    {
	        container.hide();
	    }
	});
	var quan = 1;
	$('.stepper-up').click(function(){
		quan = $('#quantity-cart').val();
			$('#quantity-cart').val(parseInt(quan)+1);
		quan = $('#quantity-cart').val();
	});

	$('.stepper-down').click(function(){

		quan = $('#quantity-cart').val();
		if(parseInt(quan) != 1 )
		 	$('#quantity-cart').val(parseInt(quan)-1);
		 quan = $('#quantity-cart').val();
	});

	function add_to_cart(icid)
	{
		$.post("<?php echo base_url()?>cart/add",{icid:icid,quan:quan},function(result){
			var crt = JSON.parse(result);
			$('#num-total-item').html(crt.total_item);
			$(window.location).attr('href', '<?php echo base_url()?>cart');//redirect to the user page
		});
	}

</script>

<script src="<?php echo base_url()?>js/imgpreview.full.jquery.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>js/jquery.raty.min.js"></script>

<?php
if($this->session->userdata('is_login') == TRUE)
{
	$user_type = $this->session->userdata('type'); //get user type;
	if($user_type == 2) //1 is suplier
	{
		echo $this->load->view('supplier/footer');
	}
	elseif($user_type == 3) //3 is Buyer
	{
		echo $this->load->view('buyer/footer');
	}
	elseif($user_type == 1) //1 Admin
	{
		echo $this->load->view('admin/footer');
	}
}
else
		echo $this->load->view('footer');
?>
