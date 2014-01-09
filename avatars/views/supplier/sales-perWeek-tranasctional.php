<div class='violet-table clearfix'>
	<table width=100%>
		<tr>
			<td>Date</td>
			<td>Transaction Status</td>
			<td>Order ID</td>
			<td>Product Detail</td>
			<td>Product Charges</td>
			<td>Oceantailer Fee</td>
			<td>Total</td>
		</tr>
		<?php foreach($_data_sales as $sale){?>
		<tr>
			<td>Date</td>
			<td><?php echo $sale->bsd_id?></td>
			<td>Order ID</td>
			<td>Product Detail</td>
			<td>Product Charges</td>
			<td>Oceantailer Fee</td>
			<td>Total</td>
		</tr>

		<?php }?>

	</table>
</div>