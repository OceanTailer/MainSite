<?php if($type == 'dropdown'){?>
	<?php foreach($manufacturers as $manu){?>
		<div id="manu-list<?php echo $manu->m_id?>" onclick='return select_manufacture(<?php echo $manu->m_id?>,"<?php echo $manu->m_name?>")' class='manu-list'><?php echo $manu->m_name?></div>
	<?php }?>
<?php }?>
<?php if($usertype == 1){ ?>
	<div class="manu-list-add" onclick="return add_manufacturer()" >
		<p style="text-align:center"> Add New Manufacturer </p>
	</div>
<?php }?>