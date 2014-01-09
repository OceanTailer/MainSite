<?php
if($this->session->userdata('is_login') == TRUE)
{
	$user_type = $this->session->userdata('type'); //get user type;
	if($user_type == 2) //2 is Supplier
	{
		echo $this->load->view('supplier/header');
	}
	elseif($user_type == 3) //3 is Buyer
	{
		echo $this->load->view('buyer/header');
	}
}
else
		echo $this->load->view('header');
?>

<div class="global-cont">

	<div class='bg-body'>
		<div class="bg-body-top"> </div>
		<div class="bg-body-middle clearfix">
		<!-- MIDDLE PAGE CONTAINER-->

			<div class="inner-body-page clearfix">

				<!-- LEFT SIDEBAR CONTAINER-->
				<div id="left-sidebar" class="clearfix fl">

				<?php
				if($this->session->userdata('is_login') == TRUE)
				{
					$user_type = $this->session->userdata('type'); //get user type;
					if($user_type == 2) //2 is Supplier
					{
						echo $this->load->view('supplier/sidebar');
					}
					elseif($user_type == 3) //3 is Buyer
					{
						echo $this->load->view('buyer/sidebar');
					}
				}
				else
						echo $this->load->view('sidebar');
				?>	

				</div>
				<!-- LEFT SIDEBAR CONTAINER-->

				<!-- RIGHT CONTENT CONTAINER-->
				<div class='right-cont clearfix fr'>

					<div class='right-inner clearfix'> 

						<div class="heading-inner-right"> 
							<p class='breadcrumbs fl'> <a href="<?php echo base_url()?>">Home</a>><?php echo $breadcrumbs;?> </p>
						</div>

						<?php if(count($inventories ) == 0){?>
							<center><p>NO PRODUCT RESULT</p></center>
						<?php }else{ foreach($inventories as $inv){?>
							<div class='prod-list-cont fl'>
								<div class='img-feat-prod-list-cont'>
									<a href="<?php echo base_url()?>inventory/detail/<?php echo $inv->i_id?>">
										<?php 
										$image_list = $this->inventories->list_image($inv->i_id,1,true); 
										//limit 1, select only the featured image
										if(count($image_list) == 0){?>
											<img width=100% src="<?php echo base_url()?>images/default-preview.jpg">
										
										<?php }else{?>
											<img width=100%  src="<?php echo $image_list[0]->ii_link ?>">
										<?php }?>
									</a>
								</div>

								<div class='quick-detail-prod-list'>
									<h5><a href="<?php echo base_url()?>inventory/detail/<?php echo $inv->i_id?>"><?php echo $inv->tr_title?></a></h5>
									<p>Stocks Available: <?php echo $this->inventories->total_quantity($inv->i_id)?></p>
									<p>Price: <?php echo $this->inventories->range_price($inv->i_id) ?>$</p>
								</div>
							</div>

						<?php }}?>




					</div>

					<div class='right-inner clearfix'> 
						<div class="heading-yellow-full"> 
							<p class='fl'>Most Popular & Feautured Products</p>
						</div>

						<div class="feat-cont clearfix fl">
							<div class="feat-img-cont fl">
								<img src="<?php echo base_url()?>images/sample/feat-image.png" width=157 />
							</div>
							<div class='feat-cont-detail'>
								<h4 class="fl"><a href="#">Luggage Bag</a></h4>
								<div class="clear"> </div>
								<p><span>Price:</span> $50 / <span>RRP:</span> $60</p>
								<div class="hr-orange"> </div>
								<p>Estimated profit: 40%</p>

							</div>
						</div>

						<div class="feat-cont clearfix fl">
							<div class="feat-img-cont fl">
								<img src="<?php echo base_url()?>images/sample/feat-image.png" width=157 />
							</div>
							<div class='feat-cont-detail'>
								<h4  class="fl"><a href="#">Luggage Bag</a></h4>
								<div class="clear"> </div>
								<p><span>Price:</span> $50 / <span>RRP:</span> $60</p>
								<div class="hr-orange"> </div>
								<p>Estimated profit: 40%</p>

							</div>
						</div>

						<div class="feat-cont clearfix fl">
							<div class="feat-img-cont fl">
								<img src="<?php echo base_url()?>images/sample/feat-image.png" width=157 />
							</div>
							<div class='feat-cont-detail'>
								<h4  class="fl"><a href="#">Luggage Bag</a></h4>
								<div class="clear"> </div>
								<p><span>Price:</span> $50 / <span>RRP:</span> $60</p>
								<div class="hr-orange"> </div>
								<p>Estimated profit: 40%</p>

							</div>
						</div>

						<div class="feat-cont clearfix fl">
							<div class="feat-img-cont fl">
								<img src="<?php echo base_url()?>images/sample/feat-image.png" width=157 />
							</div>
							<div class='feat-cont-detail'>
								<h4  class="fl"><a href="#">Luggage Bag</a></h4>
								<div class="clear"> </div>
								<p><span>Price:</span> $50 / <span>RRP:</span> $60</p>
								<div class="hr-orange"> </div>
								<p>Estimated profit: 40%</p>

							</div>
						</div>

						<div class="clear"></div>

						<div class="navi-feat fr"> 
							<a class="left-navi" href='#'></a>
							<a class="right-navi" href='#'></a>
						</div>

					</div>



				</div>
				<!-- RIGHT CONTENT CONTAINER-->

			</div>

		<!-- MIDDLE PAGE CONTAINER-->
		</div>
		<div class="bg-body-bottom"> </div>
	</div>

</div>

<script type="text/javascript">


</script>

<?php
if($this->session->userdata('is_login') == TRUE)
{
	$user_type = $this->session->userdata('type'); //get user type;
	if($user_type == 2) //1 is suplier
	{
		echo $this->load->view('supplier/footer');
	}
	elseif($user_type == 3) //3 is Buyer
	{
		echo $this->load->view('buyer/footer');
	}
}
else
		echo $this->load->view('footer');
?>
)?>