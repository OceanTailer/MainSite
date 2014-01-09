<?php if($email_type == "User Activate Account"){?>
	<table>
		<tr>
			<td>Welcome To Ocean Tailer,</td>
			<td></td>
		</tr>
		<tr>
			<td>Username:</td>
			<td><p><?php echo $user?></p></td>
		</tr>
		<tr>
			<td>Password:</td>
			<td><p><?php echo $pasword?></p></td>
		</tr>
		<tr>
			<td><br/></td>
			<td></td>
		</tr>
		<tr>
			<td>Verification Link:</td>
			<td>
				<p>To Verify the Account Click the link 
					<a href="<?php echo base_url()?>supplier/activate/<?php echo $activate?>">(here)</a>
				</p>
			</td>
		</tr>
	</table>
<?php }elseif($email_type == "New Password"){?>
	<table>
		<tr>
			<td>New Password Set:</td>
			<td></td>
		</tr>
		<tr>
			<td>Username:</td>
			<td><p><?php echo $username?></p></td>
		</tr>
		<tr>
			<td>Password:</td>
			<td><p><?php echo $pass?></p></td>
		</tr>
		<tr>
			<td><br/></td>
			<td></td>
		</tr>
	</table>
<?php }elseif($email_type == "Notify Feedback"){?>
	<table>
		<tr>
			<td>Welcome To Oceantailer <?php echo $buyer_info->u_fname.' '.$buyer_info->u_lname?>,</td>
			<td></td>
		</tr>
		<tr>
			<td>Please give us some feedback from your Last Transaction (Invoice #<?php echo $order_detail->bt_invoice?>) from Company  <?php echo $buyer_info->u_company ?> </td>
			<td></td>
		</tr>
		<tr>
			<td>Just click this link <a href="#">(here)</a> to create a feedback</td>

		</tr>
	</table>
<?php }elseif($email_type == "Personal Message"){?>
	<table>
		<tr>
			<td>Invoice Number:</td>
			<td><?php echo $invoice?></td>
		</tr>
		<tr>
			<td>Subject:</td>
			<td><?php echo $subject?></td>
		</tr>
		<tr>
			<td>Message:</td>
			<td></td>
		</tr>
		<tr>
			<td colspan=2><?php echo $message?></td>
		</tr>
		<tr>
			<td>You can view the message through this link when you login:<a href='<?php echo base_url()?>'>Click Here</a></td>
			<td></td>
		</tr>
	</table>
<?php } ?>