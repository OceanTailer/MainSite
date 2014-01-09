<!-- May 28, 2013 - Lanz Editted -->

<?php if($email_type == "Supplier Approval Email"){?>
	<table width="60%" align="center">
		<tr>
			<td>Welcome To Ocean Tailer</td>
		</tr>
		<tr>
			<td>Your account has been activated by Admin. Your account details are listed below.</td>
		</tr>
		<tr>
			<td>Ocean Tailer Account</td>
		</tr>		<tr>
			<td>First Name:</td>
			<td><?php echo $supplier_info->u_fname; ?></td>
		</tr>
		<tr>
			<td>Last Name:</td>
			<td><?php echo $supplier_info->u_lname; ?></td>
		</tr>
		<tr>
			<td>Username:</td>
			<td><?php echo $supplier_info->u_username; ?></td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><?php echo $supplier_info->u_email; ?></td>
		</tr>		<tr>
			<td colspan="2">Thank you for choosing Ocean Tailer as your partner in selling your products.</td>
		</tr>
		<tr>
			<td>By Admin</td>
		</tr>
	</table>
<?php }?>
<?php if($email_type == "Buyer Activate Email"){?>
	<table width="60%" align="center">
		<tr>
			<td>Welcome To Ocean Tailer</td>
		</tr>
		<tr>
			<td>Your account has been activated by Admin. Your account details are listed below.</td>
		</tr>
		<tr>
			<td>Ocean Tailer Account</td>
		</tr>		<tr>
			<td>First Name:</td>
			<td><?php echo $firstname; ?></td>
		</tr>
		<tr>
			<td>Last Name:</td>
			<td><?php echo $lastname; ?></td>
		</tr>
		<tr>
			<td>Verification Link:</td>
			<td>
				<p>To Verify the Account Click the link
					<a href="<?php echo base_url()?>buyer/activate/<?php echo $activate?>">(here)</a>
				</p>
			</td>
		</tr>
		<tr>
			<td colspan="2">Thank you for choosing Ocean Tailer as your online shopping store.</td>
		</tr>
		<tr>
			<td>By Admin</td>
		</tr>
	</table>
<?php }?>

<!-- Lanz Editted - June 17, 2013 -->
<?php if($email_type == "Administrator Account Activate Email"){?>
	<table width="60%" align="center">
		<tr>
			<td>Welcome To Ocean Tailer</td>
		</tr>
		<tr>
			<td>New Administrator Account has been created. Your account details are listed below.</td>
		</tr>
		<tr>
			<td>Ocean Tailer Administrator Account</td>
		</tr>		
		<tr>
			<td>Username:</td>
			<td><?php echo $username; ?></td>
		</tr>
		<tr>
			<td>Password:</td>
			<td><?php echo $password; ?></td>
		</tr>
		<tr>
			<td>
				<p>You can login to your account at
					<a href="<?php echo base_url() ?>">(here)</a>
				</p>
			</td>
		</tr>
		<tr>
			<td>By Admin</td>
		</tr>
	</table>
<?php }?>