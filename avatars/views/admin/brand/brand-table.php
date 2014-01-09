<div class='orange-table'>
	<table>
		<tr>
			<td>Brand Name</td>
			<td>Action</td>
		</tr>
		<?php foreach($brands as $brand){ ?>
			<tr id="brand-list<?php echo $brand->b_id?>">
				<td><?php echo $brand->b_name?></td>
				<td><a onclick="return deletebrand(<?php echo $brand->b_id?>)" href="#deletebrand">delete</a></td>
			</tr>
		<?php }?>

	</table>
</div>