
<?php if($result){?>
<div>
	<br/><br/>
	<p><?php echo $fullname?>,  you have just completed your payment successfully.</p> <br/>
 
	<p>Invoice # is <?php echo $invoice?> was generated towards this order and we will email you
	a payment confirmation for your reference.</p><br/>
	 
	<p>Thank you for your business,</p>
	<p>OceanTailer</p>
</div>
<?php }else{?>
	<div>
	<p>Your Payment is not Submitter.</p>
	<div>
		<?php echo print_r($errors); ?>
	</div>
	</p>
</div>

<?php }?>