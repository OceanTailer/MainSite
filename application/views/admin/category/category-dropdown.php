<?php if(count($categories) != 0)
	{ ?>
		<div class="category-selectable-cont fl clearfix" id="category-level-<?php echo $level?>">
			<?php foreach($categories as $category){
				$number_sub = count($this->categories->listing_subcategory($category->c_id));?>
			<div id="cat-sel<?php echo $category->c_id?>" onclick='return select_category(<?php echo $category->c_id?>,"<?php echo $category->c_name?>",<?php echo $category->c_level?>)' value="<?php echo $category->c_id?>"><?php echo $category->c_name?>(<?php echo $number_sub?>)</div>
			<?php }?>  
		</div>
<?php }?>
