<div class="fl clearfix">
	<a onclick="return false" href="<?php echo base_url().$link?>">
		<button class='delete-image fl' onclick="return delete_image(<?php echo $id?>);"></button>
		<button class='set-featured fr' onclick="return set_featured(<?php echo $id?>);"></button>
		<img width=105 src="<?php echo base_url().$link?>">
	</a>
</div> 