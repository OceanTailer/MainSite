<div class='orange-table'>
	<table>
		<tr>
			<td>Category Name</td>
			<td>Action</td>
		</tr>
		<?php foreach($categories as $cat){ ?>
			<tr>
				<td><?php echo $cat->c_name?></td>
				<td><a href="#">delete</a></td>
			</tr>
		<?php }?>

	</table>
</div>