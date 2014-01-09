<!-- Lanz Editted - June 12, 2013 -->
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
				<?php $has_permission = $this->administrators->check_permission($this->session->userdata('id'),1);?>

				<?php if($has_permission){ ?>

				<div class='right-inner clearfix'> 

					<div class="heading-inner-right"> 
						<p class='breadcrumbs fl'>Admnistrator List</p>
					</div>

					<div class='padded-cont'>
						<div class='violet-table'>
							<table width="100%">
								<tr>
									<td>Permission Lists:</td>
								</tr>
								<?php foreach ($permissions as $permission) { ?>
								<tr>
									<?php 
										$has_assigned = false;
										foreach($assigned_permission as $ass){
											if($ass->p_id == $permission->p_id)
												$has_assigned =  true;
									}?>
									<td><input type="checkbox" <?php if($has_assigned) echo "checked='checked'"?> value="<?php echo $permission->p_id ?>" id="permission_id"><?php echo $permission->p_name ?></td>
								</tr>
								<?php } ?>
								<tr>
									<td><button class='normal-link fr' id="btnUpdate">Update</button></td>
								</tr>
							</table>
						</div>
					</div>

				</div>
				<div class="validate-result">
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

<script language="javascript">
	$(function()
	{
	    $('#btnUpdate').click(function()
	    {
	        var val = [];
	        $(':checkbox:checked').each(function(i)
	        {
	        	val[i] = $(this).val();
	        });

	        $.post("<?php echo base_url() ?>administrator/assignpermission/<?php echo $id ?>", {val:val}, function(result)
	        {
	        	//alert(result);
	        	var  convert = JSON.parse(result);

				$('.validate-result').hide();
				$('.validate-result').html(convert.message);
				$('.validate-result').show();

				if (convert.status == 1)
				{
					$(window.location).attr('href', "<?php echo base_url() ?>administrator/managepermission/<?php echo $id?>");
				}
	        });
	    });
	});
</script>

<?php echo $this->load->view('admin/footer') ?>