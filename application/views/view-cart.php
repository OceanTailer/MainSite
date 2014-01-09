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

			<!-- RIGHT CONTENT CONTAINER-->
			<div class='right-cont clearfix fr'>
				<div class='right-inner clearfix'> 
						<div class="heading-yellow-full"> 
							<p class='fl'>Your Cart</p>
						</div>
						<div class='cart-container'>

							<div class='gray-table'>
				                <table>
				                    <tr>
				                        <td width=100></td>
				                        <td>Item</td>
				                        <td width=20>Quantity</td>
				                        <td width=40>Price</td>
				                        <td width=80>Sub Total</td>
				                        <td width=30>Action</td>
						            </tr>
						            <?php 
						            $total_shipping_fee = 0;
						            foreach($cart as $item){
						            	$total_shipping_fee += $item['options']['ship_cost'];
						            	?>
						            <tr>
						            	<td align='center'>
						            		<?php 
											$image_list = $this->inventories->list_image($item['options']['i_id'],1,true); 
											//limit 1, select only the featured image
											if(count($image_list) == 0){?>
												<img width=95 src="<?php echo base_url()?>images/default-preview.jpg">
											
											<?php }else{?>
												<img width=95  src="<?php echo $image_list[0]->ii_link ?>">
											<?php }?>
						            	</td>
				                        <td><center><?php echo $item['name']?></center></td>
				                        <td><center><input class='small' type='text' id='qty<?php echo $item['rowid']?>' value='<?php echo $item['qty'] ?>' /></center></td>
				                        <td><center><?php echo $item['price'] ?></center></td>
				                        <td><center>$<?php echo $item['subtotal'] ?></center></td>
				                        <td><center><a href="#" onclick='update_cart("<?php echo $item['rowid']?>")'>Update</a> ,<a onclick='delete_cart("<?php echo $item['rowid']?>")' href="#">Delete</a></center></td>
				                    </tr>
								<?php }?>
									<tr>
										<td colspan=4></td>
										<td>Shipping Fee</td>
										<td colspan=2><center>$<?php echo $total_shipping_fee ?></center></td>
									</tr>
									<tr>
										<td colspan=4></td>
										<td>Total</td>
										<td colspan=2><center>$<?php echo $total+$total_shipping_fee ?></center></td>
									</tr>
						        </table>
						     </div>

						     <p><a href="<?php echo base_url();?>cart/empty_cart">Empty Cart</a></p>

						</div>
				</div>

				<?php if($login){?>

				<div class='right-inner clearfix'> 
						<div class="heading-yellow-full"> 
							<p class='fl'>Checkout Now!</p>
						</div>
						<div class='inner-cont-billing-checkout clearfix'>
							<?php if($this->cart->total_items() != 0){?>
							<div>
								<h3>Paypal Checkout</h3>
								<a id='checkout-paypal' href="<?php echo base_url()?>checkout/paypal"></a>
							</div>	
							<?php }else{?>
								<p>Need atleast 1 item in your cart</p>
							<?php }?>
						</div>
				</div>

				<?php }else{?>
				<div class='right-inner clearfix'> 
						<div class="heading-yellow-full"> 
							<p class='fl'>Login as Buyer</p>
						</div>
						<p>You Must Login to our Website or Subscribe as Buyer. Click <a href="#">here</a> to Register</p>
				</div>
				<?php }?>

			</div>
			<!-- RIGHT CONTENT CONTAINER END-->

		<!-- MIDDLE PAGE CONTAINER-->
		</div>
		<div class="bg-body-bottom"> </div>
	</div>

</div>

<script type="text/javascript">

	$('#country').change(function(){
		var country_sel = this.value;

		$.post("<?php echo base_url()?>country/load",{id:country_sel,type:'dropdown'},function(result){
			if(result != 0)
			{
				$('#state_dropdown').html(result);
				$('#drp-state').fadeIn();
				$('#state-textbox').hide();
				is_state = true;
			}
			else
			{
				is_state = false;
				$('#state-textbox').fadeIn();
				$('#drp-state').hide();
			}
		});
	});

	function update_cart(rid)
	{
		var qty = $('#qty'+rid).val();
		$.post("<?php echo base_url()?>cart/update/qty",{qty:qty,rid:rid},function(data){
			$(window.location).attr('href', '<?php echo base_url()?>/cart');
		});
	}

	function delete_cart(rid)
	{
		$.post("<?php echo base_url()?>cart/update/qty",{qty:0,rid:rid},function(data){
			$(window.location).attr('href', '<?php echo base_url()?>/cart');
		});
	}

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
