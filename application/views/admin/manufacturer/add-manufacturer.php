<?php echo $this->load->view('admin/header') ?>
<div id='popbrand' class="popout-cont">
	<div class="padded-cont">

		<input type='button' value='X' class='close-pop-out fr'>

		<div class='clear'> </div>

		<div class='add-brand-cont left-half-popout fl'>
			<label for='add-brandtxt'>Brand Name</label>
			<div class="clear"> </div>
			<input type='text' value='' id='add-brandtxt' class="normal-format-text" />
			<button id='add-brand' class='normal-button'>Add</button>
		</div>

		<div id='brand-manu-list' class='brand-listing right-half-popout  fr'>

		</div>

	</div>

</div>

<div class="global-cont">

	<div class='bg-body'>
		<div class="bg-body-top"> </div>
		<div class="bg-body-middle clearfix">
		<!-- MIDDLE PAGE CONTAINER-->

			<!-- LEFT SIDEBAR CONTAINER-->
			<div id="left-sidebar" class="clearfix fl">
				<?php echo $this->load->view('admin/inventory/sidebar') ?>
			</div>

			<?php $has_permission = $this->administrators->check_permission($this->session->userdata('id'),9);?>
				

			<!-- RIGHT CONTENT CONTAINER-->
			<div class='right-cont clearfix fr'>
				<?php if($has_permission){?>
				<h3>Add Manufacturer</h3>
				<?php echo form_open('manufacturer/add'); ?>

					<div class='product-cont padded-cont'>
	
						<label for='manu_name'>Manufacturer Name</label>
						<div class="clear"> </div>
						<input type="text" id='manu_name' name='manu_name' class="normal-format-text"/>
						<input type="hidden" name="action" value="add" >
						<input type="submit" class="normal-button" value="ADD" >
				
					</div>

				<?php echo form_close(); ?>

				<div class="clear"> </div>
				<h4>Manufacturing List</h4>
				<div class='orange-table'>
					<table>
						<tr>
							<td>Manufacture Name</td>
							<td>Action</td>
						</tr>
						<?php foreach($list_manufac as $manu){?>
							<tr id='manu-list<?php echo $manu->m_id?>'>
								<td><?php echo $manu->m_name?></td>
								<td>
									<a id="manu_update<?php echo $manu->m_id?>" onclick="update_manufacturer(<?php echo $manu->m_id?>)" href="#update">Update</a>,
									<a id="manu_delete<?php echo $manu->m_id?>" onclick="delete_manufacturer(<?php echo $manu->m_id?>)" href="#delete">Delete</a>
								</td>
							</tr>
						<?php }?>
					</table>
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

<script type="text/javascript" language="javascript">
	var sel_manufac = '';
	$(document).ready(function(){
		
		$('.close-pop-out').click(function(){
			$('.popout-cont').fadeOut();
		});

		$('#add-brand').click(function(){
			var name = $('#add-brandtxt').val();
			if(sel_manufac != '')
			$.post('<?php echo base_url()?>brand/add',{name:name,manu_id:sel_manufac,action:'add'}, function(result){
				load_exisitng_brand(sel_manufac);
			});

		});

	});

	function update_manufacturer(id)
	{
		sel_manufac = id;
		load_exisitng_brand(sel_manufac);
	}

	function load_exisitng_brand(id)
	{
		$('#popbrand').fadeIn();
		$.post('<?php echo base_url()?>brand/detail',{id:id,view_type:'table'},function(result){
			$('#brand-manu-list').html(result);
		});
	}

	function delete_manufacturer(id)
	{
		$.post('<?php echo base_url()?>manufacturer/delete',{id:id,type:'delete'},function(result){

		});
		$('#manu-list'+id).slideUp();
	}

	function deletebrand(id)
	{
		$.post('<?php echo base_url()?>brand/delete',{id:id,type:'delete'},function(result){
			alert(result);
		});	
		$('#brand-list'+id).slideUp();
	
	}





</script>

<?php echo $this->load->view('admin/footer') ?>