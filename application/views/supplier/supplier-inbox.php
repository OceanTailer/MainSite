<?php echo $this->load->view('supplier/header') ?>
<script src="<?php echo base_url()?>js/jquery-ui-1.10.0.custom.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>js/organictabs.jquery.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/jquery-ui-1.10.0.custom.min.css"/>



<div class="global-cont">

	<div class='bg-body'>
		<div class="bg-body-top"> </div>
		<div class="bg-body-middle clearfix">
		<!-- MIDDLE PAGE CONTAINER-->


			<!-- LEFT SIDEBAR CONTAINER-->
			<div id="left-sidebar" class="clearfix fl">

				<?php echo $this->load->view('supplier/sidebar');?>

			</div>

			<!-- RIGHT CONTENT CONTAINER-->
			<div class='right-cont clearfix fr'>
				<div id="product-tab">
							
					<ul class="nav">
				        <li class="nav-one">
				        	<a href="#received" class="current">
								<div class="head-tab fl"> 
									<div class="tab-left fl"> </div>
									<div class="tab-center fl"> 
										<p class="fl">Received Message</p> 
									</div>
									<div class="tab-right fl"> </div>
								</div>
				        	</a>
				        </li>
				        <li class="nav-two">
				        	<a href="#sent">
				        		<div class="head-tab fl"> 
									<div class="tab-left fl"> </div>
									<div class="tab-center fl"> 
										<p class="fl">Sent Message</p> 
									</div>
									<div class="tab-right fl"> </div>
								</div>
				        	</a>
				        </li>

				    </ul>
					
					<div class="list-wrap">

						 <ul id="received">
				            <li>
								<div class='product-cont padded-cont clearfix'>

									<div class='violet-table'>
										<table>
											<tr>
												<td width=75>Date</td>
												<td width=85>Sender</td>
												<td width=425>Subject</td>
												<td>Reference</td>
											</tr>
											<?php foreach($messages as $message){ if($message->sender_type == 'buyer'){?>
											<tr>
												<td><?php echo  date('M d, Y H:i:s',$message->bsm_time) ?></td>
												<td><a href='<?php echo base_url()?>supplier/inbox/<?php echo $message->bsm_id ?>'><?php echo $message->u_fname. ' '.$message->u_lname ?></a></td>
												<td><a href='<?php echo base_url()?>supplier/inbox/<?php echo $message->bsm_id ?>'><?php echo $message->bsm_subject ?></a></td>
												<td><a href='<?php echo base_url()?>supplier/order/<?php echo $message->bsd_id ?>'><?php echo $message->bt_invoice ?></a></td>
											</tr>
											<?php }}?>
										</table>
									</div>

								</div>
				            </li>
						 </ul>

						 <ul id="sent" class="hide">
				            <li>
								<div class='product-cont padded-cont clearfix'>

									<div class='violet-table'>
										<table>
											<tr>
												<td width=75>Date</td>
												<td width=85>Sender</td>
												<td width=425>Subject</td>
												<td>Reference</td>
											</tr>
											<?php foreach($messages as $message){ if($message->sender_type == 'supplier'){?>
											<tr>
												<td><?php echo  date('M d, Y H:i:s',$message->bsm_time) ?></td>
												<td><a href='<?php echo base_url()?>supplier/inbox/<?php echo $message->bsm_id ?>'><?php echo $message->u_fname. ' '.$message->u_lname ?></a></td>
												<td><a href='<?php echo base_url()?>supplier/inbox/<?php echo $message->bsm_id ?>'><?php echo $message->bsm_subject ?></a></td>
												<td><a href='<?php echo base_url()?>supplier/order/<?php echo $message->bsd_id ?>'><?php echo $message->bt_invoice ?></a></td>
											</tr>
											<?php }}?>
										</table>
									</div>

								</div>
				            </li>
						 </ul>
					 </div> <!-- END List Wrap -->
				 
				</div> 					
			</div>

   		</div>
		<div class="bg-body-bottom"> </div>
	</div>  

</div>

<script type="text/javascript">
	$(function() {

        $("#product-tab").organicTabs();
        
    });
</script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>js/jquery.raty.min.js"></script>
<?php echo $this->load->view('supplier/footer') ?>

