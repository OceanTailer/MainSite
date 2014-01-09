<div class='violet-table clearfix'>
	<table width=100%>
		<tr>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td rowspan=4>Orders</td>
			<td>Product Charges</td>
			<td>$<?php echo $sum_prod_charges ?></td>
		</tr>
		<tr>
			<td>Promo Rebates</td>
			<td><span class='red'>-$<?php echo $sum_prod_rebates ?></span></td>
		</tr>
		<tr>
			<td>Oceantailer Fee</td>
			<td><span class='red'>-$<?php echo $sum_prod_fee ?></span></td>
		</tr>
		<tr>
			<td>Other (shipping & gift wrap credits</td>
			<td>$<?php echo $sum_prod_other ?></td>
		</tr> 
		<tr>
			<td colspan=2></td>
			<td>Subtotal $<?php echo $subtotal_prod ?></td>
		</tr>
		<tr>
			<td colspan=3></td>
		</tr>
		<tr>
			<td rowspan=4>Refund</td>
			<td>Product Charges</td>
			<td><span class='red'>-$<?php echo $sum_rfnd_charges ?></span></td>
		</tr>
		<tr>
			<td>Promo Rebates</td>
			<td>$<?php echo $sum_rfnd_rebates ?></td>
		</tr>
		<tr>
			<td>Oceantailer Fee</td>
			<td>$<?php echo $sum_rfnd_fee ?></td>
		</tr>

		<tr>
			<td>Other (shipping & gift wrap credits</td>
			<td><span class='red'>-$<?php echo $sum_rfnd_other ?></span></td>
		</tr> 
		<tr>
			<td colspan=2></td>
			<td>Subtotal <span class='red'>-$<?php echo $subtotal_rfnd ?></span></td>
		</tr>
		<tr>
			<td colspan=3></td>
		</tr>
		<tr>
			<td colspan=2>Selling Fees</td>
			<td><span class='red'>-$<?php  echo  $seller_fee; ?></span></td>
		</tr>
		<tr>
			<td>Closing Balance</td>
			<td>Total Balance</td>
			<td>$<?php echo $closing_balance ?></td>
		</tr>
		<tr>
			<td colspan=3></td>
		</tr>
		<tr>
			<td colspan=2><center><b>Transfer amount scheduled to initiate on <?php echo $date_transfer ?>*</b></center></td>
			<td>$<?php echo $closing_balance ?></td>
		</tr>


	</table>
</div>
<?php // foreach($_data_sales as $sale){?>

<?php  //echo date('M d, Y H:i:s',$sale->bsd_timestamp)?>

<?php // }?>