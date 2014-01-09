<?php if($email_type == "Send Invoice"){?>
	<table width="80%" align="left">
		<tr>
			<td>Invoice:<?php echo $transaction->bt_invoice?></td>
			<td> </td>
		</tr>
		<tr>
			<td> </td>
			<td> </td>
		</tr>
		<tr>
			<td>Payment Type:<?php echo  $transaction->bt_type?></td>
			<td>Transaction ID:<?php echo  $transaction->bt_trans_id?></td>
		</tr>
		<tr>
			<td>Timestamp:<?php echo  $transaction->bt_timestamp?></td>
			<td>Correlation ID:<?php echo  $transaction->bt_correlation_id?></td>
		</tr>
	</table>

	<table width="100%"  border="1">
		<tr>
            <td>Item</td>
            <td width=20>Quantity</td>
            <td width=40>Price</td>
            <td width=40>Ship Price</td>
            <td width=40>Sub Total</td>
        </tr>
        <?php 	foreach($products as $itemd){?>
	        <tr>
	            <td><?php echo $itemd->tr_title?></td>
	            <td><?php echo $itemd->btd_quan?></td>
                <td><center>$<?php echo $itemd->btd_quan?></center></td>
                <td><center><?php echo $itemd->btd_shipamount ?>$</center></td>
                <td><center><?php echo $itemd->btd_subamount ?>$</center></td>
	        </tr>
	    <?php }?>
	    <tr>
			<td colspan=2></td>
			<td>Total</td>
			<td colspan=2><center>$<?php echo $total?></center></td>
		</tr>
	</table>

	<table width="80%" align="left">
		<tr>
			<td>Shipping To:</td>
			<td> </td>
		</tr>
	</table>

	<table width="80%" align="left">
		<tr>
			<td> </td>
			<td> </td>
		</tr>
		<tr>
			<td>Address1: <?php echo $ship->bts_add1?></td>
			<td><?php if($ship->bts_add2 != ""){ ?>Address2: <?php echo $ship->bts_add2?><?php }?></td>
		</tr>
		<tr>
			<td>City:<?php echo $ship->bts_city?></td>
			<td>Province/Region/State:<?php echo $ship->bts_prov?></td>
		</tr>
		<tr>
			<td>Postal Code/Zip Code:<?php echo $ship->bts_postal?></td>
			<td>Number:<?php echo $ship->bts_phone_num." ".$ship->bts_phone_ext?></td>
		</tr>
	</table>

	<table width="60%" align="left">
		<tr>
			<td>For More Inquires email us at <a href="mailto:support@oceantailer.com">support@oceantailer.com</a></td>
			<td> </td>
		</tr>
	</table>

<?php }elseif($email_type == "Send Pre Invoice"){?>
	<table width="80%" align="left">
		<tr>
			<td>Invoice:<?php echo $transaction->bt_invoice?></td>
			<td> </td>
		</tr>
		<tr>
			<td> </td>
			<td> </td>
		</tr>
	</table>

	<table width="100%"  border="1">
		<tr>
            <td>Item</td>
            <td width=20>Quantity</td>
            <td width=40>Price</td>
            <td width=40>Ship Price</td>
            <td width=40>Sub Total</td>
        </tr>
        <?php $carts = $this->cart->contents(); //James, cart content	

			foreach($carts as $itemd)
			{?>
	        <tr>
	            <td><?php echo $itemd['name']?></td>
	            <td><?php echo $itemd['qty']?></td>
                <td><center><?php echo $itemd['price']-$itemd['options']['ship_cost'] ?>$</center></td>
                <td><center><?php echo $itemd['options']['ship_cost'] ?>$</center></td>
                <td><center><?php echo $itemd['subtotal'] ?>$</center></td>
	        </tr>
	    <?php }?>
	    <tr>
			<td colspan=2></td>
			<td>Total</td>
			<td colspan=2><center><?php echo $this->cart->total() ?>$</center></td>
		</tr>
	</table>

	<table width="80%" align="left">
		<tr>
			<td>Shipping To:</td>
			<td> </td>
		</tr>
	</table>

	<table width="80%" align="left">
		<tr>
			<td> </td>
			<td> </td>
		</tr>
		<tr>
			<td>Address1: <?php echo $ship->bts_add1?></td>
			<td><?php if($ship->bts_add2 != ""){ ?>Address2: <?php echo $ship->bts_add2?><?php }?></td>
		</tr>
		<tr>
			<td>City:<?php echo $ship->bts_city?></td>
			<td>Province/Region/State:<?php echo $ship->bts_prov?></td>
		</tr>
		<tr>
			<td>Postal Code/Zip Code:<?php echo $ship->bts_postal?></td>
			<td>Number:<?php echo $ship->bts_phone_num." ".$ship->bts_phone_ext?></td>
		</tr>
	</table>

	<table width="60%" align="left">
		<tr>
			<td>Note:Please wait for an email or Call from the Supplier for the shipping Date and to Confirm of the Payment</td>
			<td> </td>
		</tr>
	</table>

	<table width="60%" align="left">
		<tr>
			<td>For More Inquires email us at <a href="mailto:support@oceantailer.com">support@oceantailer.com</a></td>
			<td> </td>
		</tr>
	</table>

<?php }elseif($email_type == "Confirm Shipping Expense"){?>

	<table width="80%" align="left">
		<tr>
			<td>Shipping Detail:</td>
			<td> </td>
		</tr>
		<tr>
			<td>Tracking Number:</td>
			<td><?php echo $transaction->ssi_track?></td>
		</tr>
		<tr>
			<td>Shipping Method:</td>
			<td><?php echo $transaction->ssi_shipMethod?></td>
		</tr>
		<tr>
			<td>Carrier:</td>
			<td><?php echo $transaction->ssi_carrier?></td>
		</tr>
		<tr>
			<td>Additional Shipping Cost:</td>
			<td>$<?php echo $transaction->ssi_shipExtra?></td>
		</tr>
	</table>

	<table width="100%"  border="1">
		<tr>
            <td>Item</td>
            <td width=20>Quantity</td>
            <td width=40>Price</td>
            <td width=40>Ship Price</td>
            <td width=40>Sub Total</td>
        </tr>
        <?php 	foreach($products as $itemd){?>
	        <tr>
	            <td><?php echo $itemd->tr_title?></td>
	            <td><?php echo $itemd->btd_quan?></td>
                <td><center>$<?php echo $itemd->btd_quan?></center></td>
                <td><center><?php echo $itemd->btd_shipamount ?>$</center></td>
                <td><center><?php echo $itemd->btd_subamount ?>$</center></td>
	        </tr>
	    <?php }?>
	    <tr>
			<td colspan=2></td>
			<td>Total</td>
			<td colspan=2><center>$<?php echo $transaction->bt_total_payment+$transaction->ssi_shipExtra?></center></td>
		</tr>
	</table>

	<table width="80%" align="left">
		<tr>
			<td>Ship To:</td>
			<td> </td>
		</tr>
	</table>

	<table width="80%" align="left">
		<tr>
			<td> </td>
			<td> </td>
		</tr>
		<tr>
			<td>Address1: <?php echo $transaction->bts_add1?></td>
			<td><?php if($transaction->bts_add2 != ""){ ?>Address2: <?php echo $transaction->bts_add2?><?php }?></td>
		</tr>
		<tr>
			<td>City:<?php echo $transaction->bts_city?></td>
			<td>Province/Region/State:<?php echo $transaction->bts_prov?></td>
		</tr>
		<tr>
			<td>Postal Code/Zip Code:<?php echo $transaction->bts_postal?></td>
			<td>Number:<?php echo $transaction->bts_phone_num." ".$transaction->bts_phone_ext?></td>
		</tr>
	</table>

	<table width="60%" align="left">
		<tr>
			<td>See More details and Confirm Shipping Details Here <a href="<?php echo base_url()?>buyer/order/<?php echo $transaction->bt_id?>">(Click Me)</a></td>
			<td> </td>
		</tr>
	</table>
	<table width="60%" align="left">
		<tr>
			<td>For More Inquires email us at <a href="mailto:support@oceantailer.com">support@oceantailer.com</a></td>
			<td> </td>
		</tr>
	</table>
<?php }?>