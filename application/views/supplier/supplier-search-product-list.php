<tr>
	<td>Title</td>
	<td>SKU</td>
	<td>Quantity</td>
	<td>Quan Remaining</td>
	<td>Price</td>
	<td>Retailed Price</td>
	<td>Time Posted</td>
	<td>Action</td>
</tr>
<?php if(count($inventories) != 0){?>
	<?php foreach($inventories as $inv){
		$remaining_quantity = $this->suppliers->get_child_remaining_quan($inv->ic_id, $inv->ic_quan);
		?>
		<tr>
			<td><?php echo $inv->tr_title?></td>
			<td><?php echo $inv->SKU?></td>
			<td><?php echo $inv->ic_quan?></td> 
			<td><?php echo $remaining_quantity?></td> 
			<td><?php echo $inv->ic_price?></td>
			<td><?php echo $inv->ic_retail_price?></td>
			<td><?php echo date('d/m/Y H:i:s',$inv->ic_time); ?></td>
			<td><center>
					<?php // if($inv->master_uid == $this->session->userdata('id')){?>
						<a href="<?php echo base_url()?>inventory/update/<?php echo $inv->ic_id?>">Edit</a>,
					<?php // }else{?>
						<!-- <p class='fl'>Disable Edit</p> -->
					<?php //}?>
					<a href="<?php echo base_url()?>inventory/detail/<?php echo $inv->i_id?>/<?php echo $inv->ic_id?>">View</a>
				</center>
			</td>
		</tr>
	<?php }?>
<?php }else{?>
	<tr>
		<td colspan='7'><center>No Product Added Yet</center></td>
	</tr>
<?php }?>
<!-- <tr>
	<td colspan='7'><?php echo $this->db->last_query();?> </td>
</tr> -->