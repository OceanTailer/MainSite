<select id='brand'>
	<?php if($add_all){?>
		<option value=''>All</option>
	<?php }?>
	<?php foreach($brands as $brand){ ?>
		<option <?php if($sel == $brand->b_id){?>selected='selected'<?php }?> value="<?php echo $brand->b_id?>"><?php echo $brand->b_name?></option>
	<?php }?>
</select>