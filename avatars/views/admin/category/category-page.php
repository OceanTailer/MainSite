<?php echo $this->load->view('admin/header') ?>

<div id='popbrand' class="popout-cont">
	<div class="padded-cont">

		<input type='button' value='X' class='close-pop-out fr'>

		<div class='clear'> </div>

		<div class='fl'>
			<div class='add-category-cont left-half-popout fl'>
				<label for='update-cattxt'>Update Category Name</label>
				<div class="clear"> </div>
				<input type='text' value='' id='update-cattxt' class="normal-format-text" />
				<label for='update-catfee'>Category's commision in % (Range between 1 to 99)</label>
				<div class="clear"> </div>
				<input type='text' value='' id='update-catfee' class="normal-format-text" />
				<button id='update-category' class='normal-button'>Update</button>
			</div>
			<div class='clear'> </div>
			<div class='add-category-cont left-half-popout fl'>
				<label for='add-cattxt'>Add Sub Category </label>
				<div class="clear"> </div>
				<input type='text' value='' id='add-cattxt' class="normal-format-text" />
				<label for='add-catfee'>Add Supplier Fees</label>
				<div class="clear"> </div>
				<input type='text' value='' id='add-catfee' class="normal-format-text" />
				<button id='add-category' class='normal-button'>Add</button>
			</div>

		</div>
		<div id='category-sub-list' class='cat-listing right-half-popout  fr'>

		</div>

	</div>

</div>

<div id='popdeletecategory' class="popout-cont">
	<div class="padded-cont">
		<input type='button' value='X' class='close-pop-out fr'>
		<div class='clear'> </div>
		<div class="clearfix">
			<p class="fl">Delete Category together with assigned product?</p>
			<input id='delete-attach' type='button' class="fl normal-button" value="DELETE">
		</div>
		<div class="clearfix">
			<p class="fl">Delete and Assign Product to Different Cagetory?</p>
			<button id='delete-move-category' class='normal-button fl'>MOVE AND DELETE</button>
			<div class='clear'> </div>
			<div id="category-breadcrumbs">  </div>	
			<div id='category-main-cont' class='clearfix'>
				<div class="category-selectable-cont fl clearfix" id='category-level-0'>
					<?php if(count($categories) != 0)
						{ ?>
							<?php foreach($categories as $category){
								$number_sub = count($this->categories->listing_subcategory($category->c_id));
							?>
							<div onclick='return select_category(<?php echo $category->c_id?>,"<?php echo $category->c_name?>",<?php echo $category->c_level?>)' value="<?php echo $category->c_id?>"><?php echo $category->c_name?>(<?php echo $number_sub?>)</div>
							<?php }?>  
					<?php }?>
				</div>
			</div>
			

		</div>
	</div>
</div>

<div class="global-cont">

	<div class='bg-body'>
		<div class="bg-body-top"> </div>
		<div class="bg-body-middle clearfix">
		<!-- MIDDLE PAGE CONTAINER-->

			<!-- LEFT SIDEBAR CONTAINER-->
			<div id="left-sidebar" class="clearfix fl">
				<?php echo $this->load->view('admin/inventory/sidebar') ?>
			</div>

			<!-- RIGHT CONTENT CONTAINER-->
			<div class='right-cont clearfix fr'>
				<?php $has_permission = $this->administrators->check_permission($this->session->userdata('id'),8);?>
				<?php if($has_permission){?>
				<h3>Add Category</h3>
				<?php echo form_open('category/add'); ?>

					<div class='product-cont padded-cont'>

						<div class='fl'>
							<label for='manu_name'>Category Name</label> 
							<div class="clear"> </div>
							<input type="text" id='category_name' name='category_name' class="normal-format-text"/>
						</div>
						<div class='fl'>
							<label for='manu_name'>Fee</label>
							<div class="clear"> </div>
							<input type="text" id='category_fee' name='category_fee' class="normal-format-text"/>
							<input type="hidden" id='level' name='level' value=0 />
							<input type="hidden" id='parent' name='parent' value=0 />
							<input type="hidden" name="action" value="add" >
							<input type="submit" class="normal-button" value="ADD" >
						</div>
						
						

					</div>

				<?php echo form_close(); ?>

				<div class="clear"> </div>
				<h4>Category List</h4>

				<div class='orange-table'>
					<table>
						<tr>
							<td>Category Name</td>
							<td width=90>Action</td>
						</tr>
					<?php 

					foreach($categories as $category){?>
						<tr>
							<td><p class='fl'><?php echo $category->c_name?></p>
								<?php $sub_cat1 = $this->categories->listing_subcategory($category->c_id);
								if(count($sub_cat1) != 0){ /////////////////////////////////////////////SUB CATEGORY 1 ?>
								<a id='trig-cat<?php echo $category->c_id?>' onclick='return ontoggle(<?php echo $category->c_id?>)' href="#">(+)</a>
								<div class='orange-table sub-category-table' id='sub-cat<?php echo $category->c_id?>'>
									<table>
										<tr>
										</tr>
										<?php foreach($sub_cat1 as $cat1){ ?>
											<tr>
												<td><p class='fl'><?php echo $cat1->c_name?></p>

													<?php $sub_cat2 = $this->categories->listing_subcategory($cat1->c_id);
													if(count($sub_cat2) != 0){ /////////////////////////////////////////////SUB CATEGORY 2?>
													<a id='trig-cat<?php echo $cat1->c_id?>' onclick='return ontoggle(<?php echo $cat1->c_id?>)' href="#">(+)</a>
													<div class='orange-table sub-category-table' id='sub-cat<?php echo $cat1->c_id?>'>
													<table>
														<tr>
														</tr>
														<?php foreach($sub_cat2 as $cat2){ ?>
														<tr>
															<td><p class='fl'><?php echo $cat2->c_name?></p>
																<?php $sub_cat3 = $this->categories->listing_subcategory($cat2->c_id);
																if(count($sub_cat3) != 0){ /////////////////////////////////////////////SUB CATEGORY 3?>
																<a id='trig-cat<?php echo $cat2->c_id?>' onclick='return ontoggle(<?php echo $cat2->c_id?>)' href="#">(+)</a>
																<div class='orange-table sub-category-table' id='sub-cat<?php echo $cat2->c_id?>'>
																<table>
																	<tr>
																	</tr>
																	<?php foreach($sub_cat3 as $cat3){ ?>
																	<tr>
																		<td><p class='fl'><?php echo $cat3->c_name?></p></td>
																		<td width=40>
																			<a id="manu_update<?php echo $cat3->c_id?>"  onclick="add_sub(<?php echo $cat3->c_id?>,<?php echo $cat3->c_level?>),'<?php echo $cat3->c_name?>',<?php echo $cat3->c_feePercent?>" href="#update">Update</a>
																			,<a id="manu_delete<?php echo $cat3->c_id?>" onclick="remove_category(<?php echo $cat3->c_id?>,<?php echo $cat3->c_level?>)" href="#delete">Delete</a>
																		</td>
																	</tr>
																	<?php }?>
																</table>
																</div>
																<?php }?>

															</td>
															<td width=40>
																<a id="manu_update<?php echo $cat2->c_id?>"  onclick="add_sub(<?php echo $cat2->c_id?>,<?php echo $cat2->c_level?>,'<?php echo $cat2->c_name?>',<?php echo $cat2->c_feePercent?>)" href="#update">Update</a>
																,<a id="manu_delete<?php echo $cat2->c_id?>" onclick="remove_category(<?php echo $cat2->c_id?>,<?php echo $cat2->c_level?>)" href="#delete">Delete</a>
															</td>
														</tr>
														<?php }?>

													</table>
													</div>
													<?php }?>
												</td>
												<td width=40>
													<a id="manu_update<?php echo $cat1->c_id?>"  onclick="add_sub(<?php echo $cat1->c_id?>,<?php echo $cat1->c_level?>,'<?php echo $cat1->c_name?>',<?php echo $cat1->c_feePercent?>)" href="#update2">Update</a>
													,<a id="manu_delete<?php echo $cat1->c_id?>" onclick="remove_category(<?php echo $cat1->c_id?>,<?php echo $cat1->c_level?>)" href="#delete2">Delete</a>
												</td>
											</tr>
										<?php }?>

									</table>
								</div>
								<?php }?>

							</td>
							<td>
								<a id="manu_update<?php echo $category->c_id?>"  onclick="add_sub(<?php echo $category->c_id?>,<?php echo $category->c_level?>,'<?php echo $category->c_name?>',<?php echo $category->c_feePercent?>)" href="#update">Update</a>
								,<a id="manu_delete<?php echo $category->c_id?>" onclick="remove_category(<?php echo $category->c_id?>,<?php echo $category->c_level?>)"  href="#delete">Delete</a>
							</td>
						</tr>
					<?php }?>
					</table>
				</div>
				
				<div id='toArrayOutput'> </div>


				<?php }else{?>
					<?php echo $this->load->view('admin/permission-error') ?>
				<?php }?>

			</div>


		<!-- MIDDLE PAGE CONTAINER-->
		</div>
		<div class="bg-body-bottom"> </div>
	</div>

</div>

<script type="text/javascript"> 
	var sel_category = '';
	var sel_level = '';

	var sel_del_category = '';
	var sel_del_level = '';
	$('.close-pop-out').click(function(){
		$('.popout-cont').fadeOut();
		window.location.reload();
	});

	function add_sub(id,level,name,fee){

		sel_category = id;
		sel_level = level+1;
		$('#update-cattxt').val(name);
		$('#update-catfee').val(fee);
		$('#popbrand').fadeIn();
		load_sub_category(sel_category);
	}

	function remove_category(id,level){
		sel_del_category = id;
		sel_del_level = level;
		$('#popdeletecategory').fadeIn();
		return	false;
	}

	$('#add-category').click(function(){
		var name = $('#add-cattxt').val(); 
		var fee = $('#add-catfee').val();
		$.post("<?php echo base_url()?>category/add",{category_name:name,category_fee:fee,level:sel_level,parent:sel_category,action:'add'},function(result){
		});
		load_sub_category(sel_category);
	});

	$('#update-category').click(function(){
		var name = $('#update-cattxt').val();
		var fee = $('#update-catfee').val();
		$.post("<?php echo base_url()?>category/update",{category_name:name,fee:fee,level:sel_level,parent:sel_category,action:'update'},function(result){
		});
		load_sub_category(sel_category);
	});

	function load_sub_category(id)
	{
		$.post('<?php echo base_url()?>category/detail',{id:sel_category,view_type:'table'},function(result){
			$('#category-sub-list').html(result);
		});
	}

	function ontoggle(id)
	{
		var link_val = $('#trig-cat'+id).text();

		if(link_val == '(+)')
			$('#trig-cat'+id).text('(-)');
		else
			$('#trig-cat'+id).text('(+)');

		$('#sub-cat'+id).toggle();
		setSizesDynamic();
		return false;
	}

	function setSizesDynamic() {

	   var containerHeight = $(".right-cont").height();
	   $(".bg-body-middle").height(containerHeight - 158);
	}

	var change_cat = "";
	var change_level = "";

	function select_category(id,name,lvl)
	{
		change_level = lvl+1;
		change_cat = id;

		for(var level_list = change_level+1; level_list < 20;level_list++)
		{
			$('#category-level-'+level_list).remove();
		}
		$.post('<?php echo base_url()?>category/detail',{id:id,level:change_level,view_type:'dropdown'},function(result){
			if ( $('#category-level-'+change_level).length){
				$('#category-level-'+change_level).remove();
			}
			$('#category-main-cont').append(result);
			setSizesDynamic();
		});

		$.post('<?php echo base_url()?>category/detail',{id:id,level:change_level,view_type:'breadcrumbs'},function(result){
			$('#category-breadcrumbs').html(result);
			setSizesDynamic();
		});
		setSizesDynamic();
	}


	$('#delete-attach').click(function(){
		$.post('<?php echo base_url()?>category/delete',{cat:sel_del_category,level:sel_del_level,type:'deleteAll'},function(result){
			window.location.reload();
		});
	});

	$('#delete-move-category').click(function(){
		$.post('<?php echo base_url()?>category/delete',{cat:sel_del_category,level:sel_del_level,cat_change:change_cat,type:'deleteChange'},function(result){
			window.location.reload();
		});
	});

</script>



<?php echo $this->load->view('admin/footer') ?>