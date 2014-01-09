<?php foreach($product as $prod){?>
	<div onclick='return redirect_product(<?php echo $prod->i_id?>)' class='product-result-list'>
		<?php echo $prod->tr_title?>
	</div>
<?php }?>
