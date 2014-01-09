<!-- Lanz Editted -->
<?php echo $this->load->view('buyer/header') ?>
<div class="global-cont">

	<div class='bg-body'>
		<div class="bg-body-top"> </div>
		<div class="bg-body-middle clearfix">
		<!-- MIDDLE PAGE CONTAINER-->


			<!-- LEFT SIDEBAR CONTAINER-->
			<div id="left-sidebar" class="clearfix fl">

				<?php echo $this->load->view('sidebar');?>

			</div>

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
									<img src="images/sample/big-image.png" width=250 height=175 />
								</div>

								<div class="small-cont-cat-images fr">
									<a href="#"><img src="images/sample/small-image.png">
									<div class='cat-cover-small'>
										<p><b>Women</b><br/><span>Shoes</span>
										</p>

									</div>
									</a>
								</div>

								<div class="small-cont-cat-images fr">
									<a href="#"><img src="images/sample/small-image.png">
									<div class='cat-cover-small'>
										<p><b>Women</b><br/><span>Shoes</span>
										</p>

									</div>
									</a>
								</div>

								<div class="small-cont-cat-images fr">
									<a href="#"><img src="images/sample/small-image.png">
									<div class='cat-cover-small'>
										<p><b>Women</b><br/><span>Shoes</span>
										</p>

									</div>
									</a>
								</div>

							</div>
						</div>
						<!-- Container for Category List-->
						<?php }?>


					</div>

			</div>

		<!-- MIDDLE PAGE CONTAINER-->
		</div>
		<div class="bg-body-bottom"> </div>
	</div>

</div>
<?php echo $this->load->view('buyer/footer') ?>