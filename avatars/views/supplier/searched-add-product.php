<?php foreach($products as $prod){?>
	<div class='clearfix'>
		<div class='images-slider-cont fl'>
			<div>
				<?php 
					$images = $this->inventories->list_image($prod->i_id, 1);
					if(count($images) != 0){
					$image = $images[0];
					
					?>
					<img width=120 src="<?php echo $image->ii_link?>" />
				<?php }else{?>
					<img width=120 src="<?php echo base_url()?>images/default-preview.jpg" />
				<?php }?>
			</div>
		</div>
		<div class='product-detail-info fl'>
			<h3><?php echo $prod->tr_title?></h3>
			<p><span><?php echo $this->categories->create_breadcrumb($prod->cat_id,$prod->c_level)?></span></p>
			<hr/>
			<p>Manufacturer: <span><?php echo $prod->m_name?></span></p>
			<p>Brand: <span><?php echo $prod->b_name?></span></p>
			<p>Weight: <span><?php echo $prod->weight.$prod->weightScale?></span></p>

			<a href="<?php echo base_url()?>inventory/add/stock/<?php echo $prod->i_id?>">Add Stock</a>

			
		</div>
	</div>
	<hr/>
<?php }?>