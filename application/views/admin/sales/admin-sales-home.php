<!-- Lanz Editted -->
<?php echo $this->load->view('admin/header') ?>
<div class="global-cont">

	<div class='bg-body'>
		<div class="bg-body-top"> </div>
		<div class="bg-body-middle clearfix">
		<!-- MIDDLE PAGE CONTAINER-->

			<!-- LEFT SIDEBAR CONTAINER-->
			<div id="left-sidebar" class="clearfix fl">
				<?php echo $this->load->view('admin/sales/sidebar') ?>
			</div>

			<!-- RIGHT CONTENT CONTAINER-->
			<div class='right-cont clearfix fr'>

				<?php $has_permission = $this->administrators->check_permission($this->session->userdata('id'),3);?>
				<?php if($has_permission){ ?>
				<div class='right-inner clearfix'>
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'> List Sales </p>
					</div>
					<div class='padded-cont'>

		            	<div class='gray-table'>
			                <table>
			                    <tr>
			                    	<td>Company</td>
			                    	<td>Total Sales</td>
			                    	<td>Total Item</td>		
			                    	<td>Action</td>				                        
			                    </tr>
			                    <?php foreach($supplier_sales as $sup_sale){?>
									<tr>
				                    	<td><?php echo $sup_sale->u_company?></td>
				                    	<td><?php echo $sup_sale->asp_amount ?></td>	
				                    	<td>
				                    		<center>
				                    			<a href="<?php echo base_url()?>sale/details/<?php echo $sup_sale->u_id ?>">Details</a>
				                    		</center>
				                    	</td>				                        
				                    </tr>
			                    <?php }?>
			                </table>
		            	</div>

	            	</div>
	            	
				</div>

				<?php }else{?>
					<?php echo $this->load->view('admin/permission-error') ?>
				<?php }?>

			</div>

		<!-- MIDDLE PAGE CONTAINER-->
		</div>
		<div class="bg-body-bottom"> </div>
	</div>

</div>

<?php echo $this->load->view('admin/footer') ?>