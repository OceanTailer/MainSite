<?php echo $this->load->view('admin/header') ?>
<div class="global-cont">

	<div class='bg-body'>
		<div class="bg-body-top"> </div>
		<div class="bg-body-middle clearfix">
		<!-- MIDDLE PAGE CONTAINER-->

			<!-- LEFT SIDEBAR CONTAINER-->
			<div id="left-sidebar" class="clearfix fl">
				<?php echo $this->load->view('admin/admin/admin-sidebar') ?>
			</div>

			<!-- RIGHT CONTENT CONTAINER-->
			<div class='right-cont clearfix fr'>
				<div class='right-inner clearfix'> 
					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'> Update Carrier <?php echo $carrier->sc_name; ?></p>
					</div>


					<div class='padded-cont normal-format clearfix'>
						<div class='fl clearfix'>
							<h2> Assign  Country Destination </h2>
							<select id='selCountry' class='normal-format'>
								<?php foreach($countries as $country){?>
									<option value='<?php  echo $country->c_id?>'><?php echo $country->c_name?></option>
								<?php }?>
							</select>
							<button onclick='assignCountry(<?php echo $carrier->sc_id?>)'>Add</button>
						</div>

						<div class='country-listing-carrier clearfix fr'>
							<div class='gray-table clearfix'>
								<table>
									<tr>
										<td>Country</td>
										<td></td>
									</tr>
									<?php foreach($assigned_countries as $count){?>
									<tr>
										<td><?php echo $count->c_name ?></td>
										<td><a href="<?php echo base_url()?>carrier/delete_assign/<?php echo $carrier->sc_id  ?>/<?php echo $count->scc_id  ?>">Delete</a></td>
									</tr>
									<?php }?>
								</table>
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
<script type="text/javascript">
	function assignCountry(id)
	{
		var country =  $('#selCountry').val();
		$.post('<?php echo base_url() ?>carrier/assign',{sc_id:id,country:country,action:'add'},function(data){
			$(window.location).attr('href', '<?php echo base_url()?>carrier/assign/<?php  echo $carrier->sc_id?>');//redirect to the user page
		});	
	}
</script>

<?php echo $this->load->view('admin/footer') ?>