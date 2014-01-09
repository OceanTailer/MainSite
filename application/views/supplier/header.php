<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Oceantailer</title>
<link rel="css/common.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/reset.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/nav.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/style.css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript">  
	 	// Resize body Image Dynamically

		$(window).load(function() {
			setSizes(); 
		});

		function setSizes() {
			var containerHeightleft = $("#left-sidebar").height();
			var containerHeightright = $(".right-cont").height();
		   if(containerHeightleft > containerHeightright)
		   		$(".bg-body-middle").height(containerHeightleft - 158);
		   else
		   		$(".bg-body-middle").height(containerHeightright - 158);
		}

	</script>
</head>
<body>
	<div id='head' class="global-cont">

		<div class="fl clearfix">
			<a id='logo' href="<?php echo base_url()?>"></a>
		</div>

		<!-- -TOP RIGHT HEADER -->
		<div class="fr clearfix">
			<ul class="top-header-menu clearfix">
				<li class="user"><p><?php echo $this->session->userdata('fname').' '.$this->session->userdata('lname')?> (<a href="<?php echo base_url()?>user/logout">sign out</a>)</p></li>
			</ul>
		</div>
		<!-- END TOP RIGHT HEADER -->
	</div>


	<div class="clear"> </div>

	<div class="global-cont">

		<div class="main-menu">
			<ul class="m-left fl">
				<li class="home"><a href="<?php echo base_url()?>supplier">Home</a></li>
				<li><a href="<?php echo base_url()?>supplier/profile/supplier/view">My Profile</a></li>
				<li><a href="<?php echo base_url()?>inventory">Inventory</a></li>
			</ul>

			<ul class="m-right fr">
				<li><a href="<?php echo base_url()?>supplier/inbox">Messages</a></li>
				<li><a href="#">ENG<div class="eng fr"></div></a></li>
			</ul>
		</div>

	</div>