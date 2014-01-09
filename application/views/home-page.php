<?php echo $this->load->view('header')?>

<div class="global-cont">

	<div class='bg-body'>
		<div class="bg-body-top"> </div>
		<div class="bg-body-middle clearfix">
		<!-- MIDDLE PAGE CONTAINER-->

			<div class="inner-body-page clearfix">

				<!-- LEFT SIDEBAR CONTAINER-->
				<div id="left-sidebar" class="clearfix fl">

					<?php echo $this->load->view('sidebar')?>

				</div>
				<!-- LEFT SIDEBAR CONTAINER-->

				<!-- RIGHT CONTENT CONTAINER-->
				<div class='right-cont clearfix fr'>

					<div class='right-inner clearfix'> 

						<div class="heading-inner-right"> 
							<p class='breadcrumbs fl'> <a href="#">Home</a> </p>
						</div>

						<?php foreach($feat_categories as $cat){?>
						<!-- Container for Category List : Shoes and Accessories-->
						<div class='category-cont clearfix fl'>
							<div class="head-cat fl"> 
								<div class='cat-left fl'> </div>
								<div class='cat-center fl'> 
									<p class="fl"><?php echo $cat->c_name ?></p> 
									<div class="cat-button-down fr">
										<div class='cat-dropdown-cont'>
											<?php $subcat1 =  $this->categories->listings(1, $cat->c_id);?>
											<?php if(count($subcat1) != 0){?>
											<?php foreach($subcat1 as $subhead){?>
												<div class='sub-cat-popout-cont clearfix  fl'>
													
													<h3 class='corpi-font'><a href="#<?php echo $subhead->c_id?>"><?php echo $subhead->c_name?></a></h3>
													<?php $subcat2 =  $this->categories->listings(2, $subhead->c_id);?>
													<div class='clearfix fl'>
														
														<ul>
															<?php foreach($subcat2 as $sub2){?>
															<li>
																<a class='semi-gray' href="<?php echo base_url()?>category/info/<?php echo $sub2->c_level ?>/<?php echo $cat->c_link?>/<?php echo $subhead->c_link ?>/<?php echo $sub2->c_link; ?>"><?php echo $sub2->c_name?></a>
															</li>
															<?php }?>
														</ul>
															
													</div>

												</div>
											<?php }?>
											<?php }else{?>
												<div class='sub-cat-popout-cont clearfix  fl'>
													<h3 class='corpi-font'><a href="#">No Sub Category Available</a></h3>
												</div>
											<?php }?>
										</div>
									</div>
								</div>
								<div class='cat-right fl'> </div>
							</div>
							<p class='fr prod-count'><span>Products: </span><?php echo $this->categories->attached_product($cat->c_id)?></p>
							<div class="clear"> </div>

							<div class="cat-detail-cont clearfix"> 

								<div class='big-cont-cat-image fl'>
									<?php if($cat->c_default_image == ""){ ?>
										<img src="<?php echo base_url().$cat->c_default_image?>" width=250 height=175 />
									<?php }else{ ?>
										<img src="<?php echo base_url().$cat->c_default_image?>" width=250 height=175 />
									<?php }?>
								</div>

								<?php $limit_sub = 3;  foreach($subcat1 as $sub_3){

									if($limit_sub == 0) break;?>

									<div class="small-cont-cat-images fr">
										<a href="<?php echo base_url()?>category/info/<?php echo $sub_3->c_level ?>/<?php echo $cat->c_link ?>/<?php echo $sub_3->c_link ?>">
											<?php if($sub_3->c_default_image == ""){ ?>
												<img src="images/sample/small-image.png"  />
											<?php }else{ ?>
												<img src="<?php echo base_url().$sub_3->c_default_image?>" width=80 />
											<?php }?>
											<div class='cat-cover-small'>
												<p><span><?php echo $sub_3->c_name?></span><!-- <br/>Shoes -->
												</p>
											</div>
										</a>
									</div>

								<?php $limit_sub--; }?>



							</div>
						</div>
						<!-- Container for Category List-->
						<?php }?>


					</div>

					<div class='right-inner clearfix'> 
						<div class="heading-yellow-full"> 
							<p class='fl'>Most Popular & Feautured Products</p>
						</div>

						<center><p style='padding-top:20px;padding-bottom:20px;'>No Featured Product Listed</p></center>
						<!--

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

						 -->
						

					</div>



				</div>
				<!-- RIGHT CONTENT CONTAINER-->

			</div>

		<!-- MIDDLE PAGE CONTAINER-->
		</div>
		<div class="bg-body-bottom"> </div>
	</div>

</div>

<?php echo $this->load->view('footer')?>