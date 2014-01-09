<?php if(count($inventories ) == 0){?>
	<center><p>NO PRODUCT RESULT</p></center>
<?php }else{ foreach($inventories as $inv){?>
	<div class='prod-list-cont fl'>
		<div class='img-feat-prod-list-cont'>
			<a href="<?php echo base_url()?>inventory/detail/<?php echo $inv->i_id?>">
				<?php 
				$image_list = $this->inventories->list_image($inv->i_id,1,true); 
				//limit 1, select only the featured image
				if(count($image_list) == 0){?>
					<img width=100% src="<?php echo base_url()?>images/default-preview.jpg">
				
				<?php }else{?>
					<img width=100%  src="<?php echo $image_list[0]->ii_link ?>">
				<?php }?>
			</a>
		</div>

		<div class='quick-detail-prod-list'>
			<h5><a href="<?php echo base_url()?>inventory/detail/<?php echo $inv->i_id?>"><?php echo $inv->tr_title?></a></h5>
			<p>Stocks Available: <?php echo $this->inventories->total_quantity($inv->i_id)?></p>
			<p>Price: $<?php echo $this->inventories->range_price($inv->i_id).' gdg '.$inv->cat_id ?></p>
		</div>
	</div>

<?php }}?>