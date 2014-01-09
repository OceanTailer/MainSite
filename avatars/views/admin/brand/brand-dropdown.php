<?php if($type == 'dropdown'){?>
	<?php foreach($brands as $brand){?>
		<div onclick='return select_brand(<?php echo $brand->b_id?>,"<?php echo $brand->b_name?>")' class='brand-list'>
			<?php echo $brand->b_name?>
		</div>
	<?php }?>
<?php }?>
<?php if($usertype == 1){ //Administrator Priveledge only ?>
	<div class="manu-list-add" onclick="return add_brand()" >
		<p style="text-align:center"> Add New Brand </p>
	</div>
<?php }?>