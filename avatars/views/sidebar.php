<div class='sidebar-min-violet cleafix'>
	<div class='inner clearfix'>
		<h3>Find a Product</h3>
		<div class='clearfix'>
			<input type='text' value="<?php if(isset($search_name)){echo $search_name;}else{echo 'Search...';}?>" onblur="if(this.value=='') this.value='Search...';" onfocus="if(this.value=='Search...') this.value='';" id="search-prod" class='text-format-small fl' />
			<input type='button' value="" id='search-input' class="search-button fl" />
			<div class="clear"> </div>
			<div class='dropdown-searchresult' id='search-prod-result'></div>	
		</div>
		<div class="clear"> </div>
<!-- 		<div class="select-cont">
			<select class="select-button">
				<option value="">Product Name</option>
			</select>
		</div> -->
	</div>
</div>



<script type="text/javascript">  
	$(window).load(function() {
		 
		 $(".radio-style").click(function(){
			if(!$(this).hasClass('radio-style-active')) {
		        $(this).addClass('radio-style-active');
		    }
		    else{
		    	$(this).removeClass('radio-style-active');
		    }

		 });								
		
	});
</script>

<?php if(count($categories) != 0){?>
<div class='heading-sidebar'>Category</div>
<div class='sidebar-min-orange cleafix'>
	<div class='inner clearfix'>
		<ul class="menu-category">
			<?php foreach($categories as $cat){?>
				<li><input type="checkbox" class="radio-style categoryside" name='categoryside[]' value='<?php echo $cat->c_id ?>' id='cat<?php echo $cat->c_id ?>'/><label for="cat<?php echo $cat->c_id ?>"><?php echo substr($cat->c_name,0,18) ?></label>
					<?php $subcat1 =  $this->categories->listings(1, $cat->c_id);?>
					<?php if(count($subcat1) != 0){?>
					<ul class="menu-category">
					<?php foreach($subcat1 as $subhead){?>
							<li><input type="checkbox" class="radio-style categoryside" name='categoryside[]' value='<?php echo $subhead->c_id ?>' id='cat<?php echo $subhead->c_id ?>'/><label for="cat<?php echo $subhead->c_id ?>"><?php echo $subhead->c_name ?></label></li>
						<?php }?>
					</ul>
					<?php }?>	
				</li>
			<?php }?>	
		</ul>

	</div>
</div>
<?php }?>

<?php if(count($manus) != 0){?>
<div class='heading-sidebar'>Brands</div>
<div class='sidebar-min-orange cleafix'>
	<div class='inner clearfix'>
		<ul class="menu-category">
			<?php foreach($manus as $manu){?>
				<li><input type="checkbox" class="radio-style manuside" name='manuside[]' id='brand<?php echo $manu->m_id?>' value='<?php echo $manu->m_id?>' /><label for="brand<?php echo $manu->m_id?>"><?php echo $manu->m_name?></label></li>
			<?php } ?>			
		</ul>

	</div>
</div>
<?php }?>

<div class='heading-sidebar'>Prices</div>

<div class='sidebar-min-violet cleafix'>
	<div class='inner pad clearfix'>
		<input type='text' value="From" onblur="if(this.value=='') this.value='From';" onfocus="if(this.value=='From') this.value='';" id='price-from' class='text-format-small smallest fl' />
		<input type='text' value="To" onblur="if(this.value=='') this.value='To';" onfocus="if(this.value=='To') this.value='';" id='price-to' class='text-format-small smallest fl' />
		<input type='button' value="" id='search-price-range' class="search-button fl" />
	</div>
</div>

<?php if(!isset($is_home)){?>

<div class='heading-sidebar'>Supplier</div>

<div class='sidebar-min-violet cleafix'>
	<div class='inner pad clearfix'>
		<div class="select-cont select-medium fl">
			<select id='supplier-sel' class="select-button select-medium">
				<option value="">All</option>
				<?php foreach($suppliers as $sup){?>
					<option value="<?php echo $sup->u_id?>"><?php echo substr($sup->u_company,0, 10); ?></option>
				<?php }?>
			</select>
		</div>
		<input type='button' value="" id='supplier-info' class="go-button fl" />
	</div>
</div>
<?php }?>
<script type="text/javascript">
	$(window).load(function() {

		var ary_cat = [];
		var ary_manu = [];

		var from = '';
		var to = '';
		var supplier = '';

		search_function();
		function search_function(){
			from = $('#price-from').val();
			to = $('#price-to').val();

	

			if(isNumber(from))	
				from = $('#price-from').val();
			else
				from = "";

			if(isNumber(to))
				to = $('#price-to').val();
			else
				to = "";

			$.post('<?php if(isset($dym_link)){ echo $dym_link;} ?>',{action:'get',cat:ary_cat,manu:ary_manu,from:from,to:to,supplier:supplier},function(result){
				if(result != '')
					$('#result-product-maincont').html(result);
				else
					$('#result-product-maincont').html('');
			});
		}

		function isNumber(value) {
		    if ((undefined === value) || (null === value)) {
		        return false;
		    }
		    if (typeof value == 'number') {
		        return true;
		    }
		    return !isNaN(value - 0);
		}

		$('#search-prod').keyup(function(){
			var val = this.value;

			if(val == 'Search...' || val == '');
			else
				$.post('<?php echo base_url()?>inventory/search/quick',{val:val},function(result){
					if(result != '')
						$('#search-prod-result').html(result);
					else
						$('#search-prod-result').html('');
				});
		});

		$('#search-input').click(function(){
			var val = $('#search-prod').val();
			if(val == 'Search...' || val == '');
			else
				$(window.location).attr('href', "<?php echo base_url()?>inventory/search/product/"+val);
		});

		$('#price-from, #price-to').keypress(function(event){
			if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
			    event.preventDefault();
			}

		});

		$('#search-price-range').click(function(){

			from = $('#price-from').val();
			to = $('#price-to').val();

			if(<?php if(isset($search_page)){ echo 1;}else{ echo 0;}?>)
				search_function();
			else
			{
				if(isNumber(to) && isNumber(from))
				{
					var val = $('#search-prod').val();
					if(val == 'Search...' || val == '')
						val = '';
					else
						val = $('#search-prod').val();
					$(window.location).attr('href', "<?php echo base_url()?>inventory/search/price/"+from+'/'+to);
				}
			}
				
		});

		$('#supplier-info').click(function(){
			var id = $('#supplier-sel').val();
			supplier = id;
			if(<?php if(isset($search_page)){ echo 1;}else{ echo 0;}?>)
				search_function();
			else
			{
				$(window.location).attr('href', "<?php echo base_url()?>supplier/detail/"+id);
			}

		});
		
		$('.categoryside').click(function(){
			ary_cat = [];
	        $('.categoryside:checkbox:checked').each(function(i)
	        {
	        	ary_cat[i] = $(this).val();
	        });;
	        search_function();
		}); 
		
		$('.manuside').click(function(){
			ary_manu = [];
	        $('.manuside:checkbox:checked').each(function(i)
	        {
	        	ary_manu[i] = $(this).val();
	        });;
	        search_function();
		});

	});

	function redirect_product(id)
	{
		
		$(window.location).attr('href', "<?php echo base_url()?>inventory/detail/"+id);
	
	}
</script>