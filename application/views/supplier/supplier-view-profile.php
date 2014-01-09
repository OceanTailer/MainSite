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
						<p class='breadcrumbs fl'>My Profile </p>
					</div>

					<div class='padded-cont'>

						<div class='profile-cont fl'>
							<div class="user-icon">
								<?php if($supplier_profile->u_pic != ""){?>
								<img src="<?php echo base_url().$supplier_profile->u_pic?>" width=100%>
								<?php }else{ ?>
								<img src="<?php echo base_url()?>images/avatar.jpg" width=100%>
								<?php }?>
							</div>
							<a href="<?php echo base_url()?>user/upload_profile">Upload Image</a>					
						</div>

						<div class='informative-format fl'>
							<div>
								<p><span>Full Name:</span> <?php echo $supplier_profile->u_fname.' '.$supplier_profile->u_lname; ?></p>
							</div>
							<div>
								<p><span>Email:</span> <?php echo $supplier_profile->u_email; ?></p>
							</div>
							<div>
								<p><span>Company:</span> <?php echo $supplier_profile->u_company; ?></p>
							</div>
							<div>
								<p><span>FEID/Business Number/VAT Registration Number:</span> <?php echo $supplier_profile->u_permit; ?></p>
							</div>
						</div>


					</div>

				</div>

				<div class='right-inner right-inner-half clearfix fl' style='min-height:215px'>
					<!-- First Row Container-->
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'>Default Billing Information</p>
					</div>

					<div class='padded-cont'>
						<div class='informative-format fl' >
							<div>
								<p><span>Country:</span><?php echo $supplier_profile->c_name; ?></p>
							</div>
							<div>
								<p><span>Address 1:</span><?php echo $supplier_profile->ba_add1; ?></p>
							</div>
							<div>
								<p><span>Address 2:</span> <?php echo $supplier_profile->ba_add2; ?></p>
							</div>
							<div>
								<p><span>City:</span> <?php echo $supplier_profile->ba_city; ?></p>
							</div>
							<div>
								<p><span>Province:</span> <?php echo $supplier_profile->ba_province; ?></p>
							</div>
							<div>
								<p><span>Postal Code:</span> <?php echo $supplier_profile->ba_postal; ?></p>
							</div>
							<div>
								<p><span>Phone Number:</span> <?php echo $supplier_profile->ba_phone_num; ?></p>
							</div>
						</div>
					</div>

				</div>

				<div class='right-inner right-inner-half-fr clearfix fr' style='min-height:215px'>
					<!-- First Row Container-->
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'>Default Credit Card Information</p>
					</div>

					<div class='padded-cont'>
						<div class='informative-format fl'>
							<div>
								<p><span>Credit Card Name</span><?php echo $supplier_profile->ccu_name; ?></p>
							</div>
							<div>
								<p><span>Credit Card:</span> <?php echo $supplier_profile->cc_type; ?></p>
							</div>
							<div>
								<p><span>Credit Card Number:</span> <?php echo '***********'.substr($supplier_profile->ccu_number, 11, 15) ?></p>
							</div>
							<div>
								<p><span>Expiration Date:</span> <?php  if(count($supplier_profile->ccu_exp_month) == 1){echo '0';}; echo $supplier_profile->ccu_exp_month.'/'.$supplier_profile->ccu_exp_year; ?></p>
							</div>
						</div>
					</div>

				</div>

				<?php

				 	$total_sales = 0;
				 	$total_item = 0;

				 	
					$grand_shipping_total = 0;
					$grand_net_total = 0;
					$grand_deduction = 0;
					foreach($bt_list as $bt)
					{
						$shipping_total = 0;
						$net_total = 0;
						$deduction_total = 0;

						$total_sales += $bt->bsd_total_paymet;
						$total_item += $bt->bsd_total_item;

						$btd_list =  $this->suppliers->transaction_detail($supplierID,$bt->bsd_id);

						//get all the total sales - the dedicated deduction from the oceantailer
						foreach ($btd_list as $btd){
							$shipping = $btd->btd_shipamount * $btd->btd_quan;
							$deduction = $btd->btd_subamount * ($btd->btd_productFee/100); 
							$net = $btd->btd_subamount - $deduction;

							$shipping_total += $shipping;
							$net_total += $net;
							$deduction_total += $deduction;

						}

						if($bt->bsd_status == -2 || $bt->ssi_status == 1)
						{ 
							$shipping_total = $bt->ssi_shipExtra;

						}

						$grand_shipping_total += $shipping_total;
						$grand_net_total += $net_total + $shipping_total;
						$total_sales += $shipping_total;
						$grand_deduction += $deduction_total;
					}
				?>

				<div class='right-inner right-inner-half-fr clearfix fl' style='min-height:215px'>
					<!-- First Row Container-->
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'>Current Sales</p>
					</div>

					<div class='padded-cont'>
						<div class='informative-format fl'>
							<div>
								<p><span>Total Product Shipped:</span><?php echo $total_item; ?></p>
							</div>
							<div>
								<p><span>Total Sales:</span> <?php echo $total_sales; ?></p>
							</div>
							<div>
								<p><span>Total Oceantailer Fee:</span> <?php echo $grand_deduction; ?></p>
							</div>
							<div>
								<p><span>Total Net Sales:</span> <?php echo $grand_net_total; ?></p>
							</div>
						</div>
					</div>

				</div>
			
			</div>

		<!-- MIDDLE PAGE CONTAINER-->
		</div>
		<div class="bg-body-bottom"> </div>
	</div>

</div>

<?php echo $this->load->view('supplier/footer') ?>