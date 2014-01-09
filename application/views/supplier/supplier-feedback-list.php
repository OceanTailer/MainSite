<!-- Lanz Editted - June 7, 2013 -->
<?php echo $this->load->view('supplier/header') ?>
<div class="global-cont">

	<div class='bg-body'>
		<div class="bg-body-top"> </div>
		<div class="bg-body-middle clearfix">
		<!-- MIDDLE PAGE CONTAINER-->

			<!-- LEFT SIDEBAR CONTAINER-->
			<div id="left-sidebar" class="clearfix fl">
				<?php echo $this->load->view('supplier/sidebar') ?>
			</div>

			<!-- RIGHT CONTENT CONTAINER-->
			<div class='right-cont clearfix fr'>

				<div class='right-inner clearfix'>
					<!-- First Row Container-->
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'>Buyer's Feedbacks </p>
					</div>

					<div class='padded-cont'>
						<div class='violet-table'>
							<table>
								<tr>
									<td>Company</td>
									<td>Rate</td>
									<td>Feedback</td>
									<td>Date</td>
								</tr>	
								<?php foreach($feedback_detail as $feedback){?>
									<tr>
										<td><?php echo $feedback->u_company ?></td>
										<td>
											<div id="buyer_ic_rate<?php echo $feedback->u_id?>" class="fl sup_ic_rate-cont"></div>
											<script type="text/javascript">
												$(document).ready(function(){
						                            $('#buyer_ic_rate<?php echo $feedback->u_id?>').raty({
						                              readOnly : true,
						                              score    : <?php echo $feedback->bsd_buyer_rate ?>,
						                              width    : 150,
						                              path     :"<?php echo base_url().'images/'?>"
						                            });
						                        });
					                        </script>
										</td>
										<td><?php echo $feedback->bsd_buyer_feedback ?> </td>
										<td><?php echo date('d/M/Y',$feedback->u_time) ?></td>
									</tr>
								<?php }?>
							</table>
						</div>
					</div>
				</div>


			</div>

		<!-- MIDDLE PAGE CONTAINER-->
		</div>
		<div class="bg-body-bottom"> </div>
	</div>

</div>

<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>js/jquery.raty.min.js"></script>
<?php echo $this->load->view('supplier/footer') ?>