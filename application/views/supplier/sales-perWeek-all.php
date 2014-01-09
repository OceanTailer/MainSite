<div class='violet-table clearfix'>
	<table width=100%>
		<tr>
			<td>Settlement<br/>Period</td>
			<td>Beginning<br/>Balance</td>
			<td>Product charges<br/>Total</td>
			<td>Oceantailer<br/>Fees</td>
			<td>Shipping fee</td>
			<td>Total Deposit</td>
		</tr>
		<?php foreach($range_week as $week){
				$user_id = $this->session->userdata('id'); //id of the loged in user
				$dates[] = array();
				$dates[0] = strtotime($week['start']->format("l Y-m-d"));
				$dates[1] = strtotime($week['end']->format("l Y-m-d"));
				$sales = $this->suppliers->get_sales_perWeek($dates,$user_id, 1);

				$total_prod_charges = 0; //Add
				$total_prod_rebates = 0; //Minus
				$total_prod_fee = 0; //Minus
				$total_prod_other = 0; //Add
				$subtotal_prod_ = 0; //Add

				foreach($sales as $sale)
				{
					$products_info =  $this->suppliers->transaction_detail($user_id,$sale->bsd_id);

					foreach($products_info as $prod_info)
					{
						$total_prod_charges += $prod_info->btd_subamount; //the Quantity * Price 
						$total_prod_fee += $prod_info->btd_subamount * ($prod_info->btd_productFee/100); //Product Fee
						$total_prod_other += $prod_info->btd_shipamount * $prod_info->btd_quan; //other is including the shipping fee
					}

					$subtotal_prod_ = ($total_prod_charges + $total_prod_other) - $total_prod_fee;
				}
			?>

			<tr>
				<td><?php echo $week['start']->format("l Y-m-d").' '.$week['end']->format("l Y-m-d") ?></td>
				<td>$0</td> 
				<td>$<?php echo $total_prod_charges ?></td> 
				<td><span class='red'>-$<?php echo $total_prod_fee ?></span></td> 
				<td>$<?php echo $total_prod_other ?></td> 
				<td>$<?php echo $subtotal_prod_ ?></td> 
			</tr>

		<?php }?>

	</table>
</div>