<!-- Lanz Editted - June 18, 2013 -->
<?php echo $this->load->view('buyer/header') ?>
<div class="global-cont">

	<div class='bg-body'>
		<div class="bg-body-top"> </div>
		<div class="bg-body-middle clearfix">
		<!-- MIDDLE PAGE CONTAINER-->


			<!-- LEFT SIDEBAR CONTAINER-->
			<div id="left-sidebar" class="clearfix fl">

				<?php echo $this->load->view('buyer/sidebar');?>

			</div>

			<!-- RIGHT CONTENT CONTAINER-->
			<div class='right-cont clearfix fr'>
				<div class="clear"> </div>
				<div class='gray-table table-margin'>
					<table>
						<tr>
							<td width="15%">Invoice</td>
							<td width="10%">Type</td>
							<td width="12%">Transaction Id</td>
							<td width="12%">Total Payment</td>
							<td width="9%">No. Items</td>
							<td width="13%">Status</td>
						</tr>
						<?php foreach ($transactions as $trans) { ?>
						<tr>
							<td><?php echo $trans->bt_invoice; ?></td>
							<td><?php echo $trans->bt_type; ?></td>
							<td><?php echo $trans->bt_trans_id; ?></td>
							<td><?php echo $trans->bt_total_payment; ?></td>
							<td><?php echo $trans->bt_total_item; ?></td>
							<td><?php echo $trans->bt_ack; ?></td>
						</tr>
						<?php } ?>
					</table>
				</div>
			</div>
		<!-- MIDDLE PAGE CONTAINER-->
		</div>
		<div class="bg-body-bottom"> </div>
	</div>

</div>
<?php echo $this->load->view('buyer/footer') ?>