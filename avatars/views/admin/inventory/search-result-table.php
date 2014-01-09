<table>
	<tr>
		<td>Name</td>
		<td>Brand</td>
		<td>Manufacturer</td>
		<td>Action</td>
	</tr>
	<?php foreach($inventory as $inv){?>
		<tr>
			<td><?php echo $inv->tr_title?></td>
			<td><?php echo $inv->m_name?></td>
			<td><?php echo $inv->b_name?></td>
			<td>
				<center>
					<a href="<?php echo base_url()?>inventory/update/<?php echo $inv->i_id?>">Update</a>,
					<a href="<?php echo base_url()?>inventory/detail/<?php echo $inv->i_id?>">View</a>
				</center>
			</td>
		</tr>
	<?php }?>
</table>