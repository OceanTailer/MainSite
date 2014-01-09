<div class='violet-table clearfix'>
	<table width=100%>
		<tr>
			<td>Date</td>
			<td>Transaction<br/>Status</td>
			<td>Order ID</td>
			<td>Product Detail</td>
			<td>Product Charges</td>
			<td>Oceantailer Fee</td>
			<td>Total</td>
		</tr>
		<?php foreach($_data_sales as $sale){
			$user_id = $this->session->userdata('id'); //id of the loged in user
			$btds = $this->suppliers->transaction_detail($user_id,$sale->bsd_id);
			?>

			<?php foreach($btds as $btd){
				$deduction = $btd->btd_subamount * ($btd->btd_productFee/100);
				$net = $btd->btd_subamount - $deduction;
				?>
				<tr>
					<td><?php echo date('M d, Y H:i:s',$sale->bsd_timestamp) ?></td>
					<td><?php echo $sale->bsd_reason?></td>
					<td><?php echo $btd->bt_invoice?></td>
					<td><?php echo $btd->tr_title?></td>
					<td>$<?php echo $btd->btd_subamount?></td>
					<td><span class='red'>-$<?php echo $deduction?></span></td> 
					<td>$<?php echo $net?></td>
				</tr>
			<?php }?>

		<?php }?>

	</table>
</div>