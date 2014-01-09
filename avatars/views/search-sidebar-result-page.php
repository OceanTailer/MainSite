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
						echo $this->load->view('sidebar');
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
							<p class='breadcrumbs fl'> Searching for: <?php echo $search_name;?> </p>
						</div>

						<div id='result-product-maincont'>

						</div>




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