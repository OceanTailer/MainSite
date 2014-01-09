<?php echo $this->load->view('admin/header') ?>
<script src="<?php echo base_url()?>js/jquery-ui-1.10.0.custom.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>js/jquery.mjs.nestedSortable.js" type="text/javascript"></script>
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

				<h3>Add Category</h3>
				<?php echo form_open('category/add'); ?>

					<div class='product-cont padded-cont'>

						<label for='manu_name'>Category Name</label>
						<div class="clear"> </div>
						<input type="text" id='category_name' name='category_name'/>
						<input type="hidden" name="action" value="add" >
						<input type="submit" class="normal-button" value="ADD" >

					</div>

				<?php echo form_close(); ?>

				<div class="clear"> </div>
				<h4>Category List</h4>

				<ol class='dynamic-category'> 
					<?php foreach($categories as $category){?>
						<li id="category-<?php echo $category->c_id;?>">
							<div>
								<p><?php echo $category->c_name?></p>
								<a id="manu_delete<?php echo $category->c_id?>" href="#delete">Delete</a>
									,<a id="manu_update<?php echo $category->c_id?>" href="#update">Update</a>
							</div>
						</li>
					<?php }?>
				</ol>

				<div id='toArrayOutput'> </div>



			</div>


		<!-- MIDDLE PAGE CONTAINER-->
		</div>
		<div class="bg-body-bottom"> </div>
	</div>

</div>

<script type="text/javascript"> 

	$(document).ready(function(){

		$('.dynamic-category').nestedSortable({
			forcePlaceholderSize: true,
			handle: 'div',
			helper:	'clone',
			items: 'li',
			opacity: .6,
			placeholder: 'placeholder',
			revert: 250,
			tabSize: 25,
			tolerance: 'pointer',
			toleranceElement: '> div',
			maxLevels: 3,

			isTree: true,
			expandOnHover: 700,
			startCollapsed: true,
			stop: function(ev, ui){
				remap_task_postition();
			}
		});

		function update_category()
		{
			arraied = $('.dynamic-category').nestedSortable('toArray', {startDepthCount: 0});
			arraied = dump(arraied);
			(typeof($('#toArrayOutput')[0].textContent) != 'undefined') ?
			$('#toArrayOutput')[0].textContent = arraied : $('#toArrayOutput')[0].innerText = arraied;
		}

		function remap_task_postition()
	    {
	    	var list_ticket = Array();
	    	$('.dynamic-category').each(function(){
			    // inner scope
			   
			    $(this).find('li').each(function(){
			    	var id = this.id;


			        if ($("#"+id).parents('li').length) {
				    	alert("sub");
				    } else {
				    
				    }
			    });

		
			});

	    }

	function dump(arr,level) {
		var dumped_text = "";
		if(!level) level = 0;

		//The padding given at the beginning of the line.
		var level_padding = "";
		for(var j=0;j<level+1;j++) level_padding += "    ";

		if(typeof(arr) == 'object') { //Array/Hashes/Objects
			for(var item in arr) {
				var value = arr[item];

				if(typeof(value) == 'object') { //If it is an array,
					dumped_text += level_padding + "'" + item + "' ...\n";
					dumped_text += dump(value,level+1);
				} else {
					dumped_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
				}
			}
		} else { //Strings/Chars/Numbers etc.
			dumped_text = "===>"+arr+"<===("+typeof(arr)+")";
		}
		return dumped_text;
	}

	});


</script>



<?php echo $this->load->view('admin/footer') ?>