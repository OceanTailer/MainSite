<div class='orange-table'>
	<table>
		<tr>
			<td>Category Name</td>
			<td>Action</td>
		</tr>
		<?php foreach($categories as $cat){ ?>
			<tr id="cat_row<?php echo $cat->c_id?>">
				<td><?php echo $cat->c_name?></td>
				<td><a onclick='delete_category(<?php echo $cat->c_id?>,<?php echo $cat->c_level?>)' href="#">delete</a></td>
			</tr>
		<?php }?>

	</table>
</div>