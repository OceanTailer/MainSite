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

<script src="<?php echo base_url()?>js/organictabs.jquery.js" type="text/javascript"></script>

<script src="<?php echo base_url()?>js/jquery.flexslider.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>js/flexslider.css"/>

<script type="text/javascript">  
	$(window).load(function() {
		$('.flexslider').flexslider({
			animation: "slide",
			slideshowSpeed: 8000,
			controlsContainer: ".number-slide", 
			directionNav: false,
			startAt: 0,                 
			slideshow: false,
		    start: function(slider) {
			    $('.right-navi').click(function(event){
			        event.preventDefault();
			        slider.flexAnimate(slider.getTarget("next"));
			    });
			    $('.left-navi').click(function(event){
			        event.preventDefault();
			        slider.flexAnimate(slider.getTarget("prev"));
			    });
			}
		});
	});
</script>

</head>
<div class="global-cont">

	<div class='bg-body'>
		<div class="bg-body-top"> </div>
		<div class="bg-body-middle clearfix">
		<!-- MIDDLE PAGE CONTAINER-->


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

			<!-- RIGHT CONTENT CONTAINER-->
			<div class='right-cont clearfix fr'>

				<div class='right-inner-small clearfix'>
					<!-- First Row Container-->
					<div class="heading-inner-right-small"> 
						<p class='breadcrumbs fl'> <?php echo $supplier->u_company ?> </p>
					</div>
				</div>

				<!-- SUPPLIER PRODUCT TAB CONTAINER-->
				<div id="supplier-product-tab" class='supplier-home-tabs'>
							
					<ul class="nav">
				        <li class="nav-one">
				        	<a href="#overview" class="current">

				        	<div class="head-tab fl"> 
								<div class="tab-left fl"> </div>
								<div class="tab-center fl"> 
									<p class="fl">Overview</p> 
								</div>
								<div class="tab-right fl"> </div>
							</div>

							</a>
						</li>
				        <li class="nav-two">
				        	<a href="#feedback">
					        	<div class="head-tab fl"> 
									<div class="tab-left fl"> </div>
									<div class="tab-center fl"> 
										<p class="fl">Feedbacks</p> 
									</div>
									<div class="tab-right fl"> </div>
								</div>
				        	</a>
				        </li>
				        <li class="nav-three">
				        	<a href="#restriction">
					        	<div class="head-tab fl"> 
									<div class="tab-left fl"> </div>
									<div class="tab-center fl"> 
										<p class="fl">Restriction</p> 
									</div>
									<div class="tab-right fl"> </div>
								</div>
				        	</a>
				        </li>
				        <li class="nav-four">
				        	<a href="#return_policy">
					        	<div class="head-tab fl"> 
									<div class="tab-left fl"> </div>
									<div class="tab-center fl"> 
										<p class="fl">Return Policy</p> 
									</div>
									<div class="tab-right fl"> </div>
								</div>
				        	</a>
				        </li>
				    </ul>
					
					<div class="list-wrap">
					
						<ul id="overview">
							<li class='clearfix'>
								<div class="left-overview fl clearfix">
									<h3><?php echo $supplier->u_company?></h3>
									<div class='orange-line'> </div>
									<div class='overview-par clearfix'>
										<p>Average lead time : <span>4 Business Days</span></p>
										<p>Returns : <span>0</span></p>
										<p>Lined on Hand : <span>100%</span></p>
										<p>Country : <span><?php echo $supplier->c_name?></span></p>
										<p>Launched day : <span><?php echo date('M d, Y',$supplier->u_time) ?></span></p>
									</div>
									<div class='clear'></div>
									<a class='normal-button brwse-prod-link fl' href="#">Browse Products</a>
								</div>
								<div class='right-overview fl clearfix'>
									<div class='overview-par clearfix'>

										<?php 
										$total_feedback = 0;
										if($general_feedback != false)
												$total_feedback = $general_feedback->avg_rate;
										else
												$total_feedback = 0;
										?>
										<p class='fl'>Feedback rating:</p>
										<div id="sup_ic_rate<?php echo $supplier->u_id?>" class="fl sup_ic_rate-cont"></div>
										<script type="text/javascript">
											$(document).ready(function(){
					                            $('#sup_ic_rate<?php echo $supplier->u_id?>').raty({
					                              readOnly : true,
					                              score    : <?php echo $total_feedback ?>,
					                              width    : 150,
					                              path     :"<?php echo base_url().'images/'?>"
					                            });
					                        });
				                        </script>
				                        <p class='fl'>(feedbacks: <span> <?php echo count($feedback_detail)?> </span>)</p>
			                        </div>
			                        <div class='list-supplier-cont-prod'>
						            	<div class='gray-table'>
							                <table>
							                    <tr>
							                        <td>Feedback</td>
							                        <td>1 Month</td>
							                        <td>6 Months</td>
							                        <td>1 Year</td>
							                        <td>Lifetime</td>
							                    </tr>
							                    <?php foreach($feedback_detail as $feedback){?>
							                    <tr>
							                        <td><p><span><?php echo count($feedback_detail)?></span></p></td>
							                        <td><p><?php echo count($feedback_detail)?></p></td>
							                        <td><p>0</p></td>
							                        <td><p>0</p></td>
							                        <td><p>0</p></td>
							                    </tr>
							                    <?php }?>
							                </table>
						            	</div>
					            	</div>

								</div>
								<div class='clearfix arrow-conthead'>Latest Feedback</div>
								<div class='clear'></div>
								<div class='feed-back-cont-main-bot clearfix'>
									<div class='gray-no-top'>
						                <table>
						                	<?php foreach($feedback_detail as $feedback){?>
						                	<tr>
						                		<td><?php echo date('d/M/Y',$feedback->u_time) ?></td>
						                		<td><?php echo $feedback->bsd_buyer_feedback ?> </td>
						                		<td>was rate at <?php echo $feedback->bsd_buyer_rate ?> by <?php echo $feedback->u_company ?> </td>
						                	</tr>
						                	<?php }?>
<!-- 						                	<tr>
						                		<td>15/03/2013</td>
						                		<td>Excellent dealer. I’m happy with his performance. </td>
						                		<td>was good 5 out of 5 by yuri_t </td>
						                	</tr> -->
						                </table>
					            	</div>
								</div>

							</li>
						</ul>

						<ul id="feedback" class="hide">
				           <li>
				            	
				           </li>
						</ul>

						<ul id="restriction" class="hide">
				           <li>
				            	
				           </li>
						</ul>

						<ul id="return_policy" class="hide">
				           <li>
				            	
				           </li>
						</ul>
						 
					 </div> <!-- END List Wrap -->
				 
				 </div> 
				<!-- SUPPLIER PRODUCT TAB CONTAINER END-->

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
			<!-- RIGHT CONTENT CONTAINER END-->

		<!-- MIDDLE PAGE CONTAINER-->
		</div>
		<div class="bg-body-bottom"> </div>
	</div>

</div>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>js/jquery.raty.min.js"></script>
<script type="text/javascript">
	$(function() {

        $("#supplier-product-tab").organicTabs();
        
    });
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
