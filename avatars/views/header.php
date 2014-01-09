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

		   	var full = $(".full-cont").height();

		   	if ($(".full-cont")[0])
		   		$(".bg-body-middle").height(full - 158);
		   	
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
				<li class="user">
					<div class='login-cont fl' >

						<input type='text' name="login-username" id="login-username" value="username" onblur="if(this.value=='') this.value='username';" onfocus="if(this.value=='username') this.value='';"  />
						<input type='password' name="login-pass" id="login-pass" value="password" onblur="if(this.value=='') this.value='password';" onfocus="if(this.value=='password') this.value='';"  />
						<input type='submit' value='Login' name="login-submit" id="login-submit">
						<div class="clear"> </div>
						<a class='' href='<?php echo base_url()?>buyer/register'>Be our Buyer</a> , <a class='' href='<?php echo base_url()?>supplier/register'>Be our Supplier</a>, <a class='' href='<?php echo base_url()?>user/forgotpassword'>forgot password?</a>	
						<div class="clear"> </div>
					</div>
				</li>
				<li>
					<div class='fl cart-icon'>
						<p><img src='<?php echo base_url()?>images/cart-top.png'></p>
					</div>
					<div class='fl'> 
						<p>Your cart: <a href='<?php echo base_url()?>cart'> <span id='num-total-item'> <?php echo $this->cart->total_items() ?> </span>  items </a></p>
					</div>
				</li>
			</ul>

		</div>
		<!-- END TOP RIGHT HEADER -->
	</div>


	<div class="clear"> </div>

	<div class="global-cont">

		<div class="main-menu">
			<ul class="m-left fl">
				<li class="home"><a href="<?php echo base_url()?>">home</a></li>
				<li><a href="#">Catalog</a></li>
				<li><a href="#">Feeds</a></li>
				<li><a href="#">Orders</a></li>
				<li><a href="#">Account</a></li>
				<li><a href="#">Help</a></li>
			</ul>

			<ul class="m-right fr">
				<li><a href="#">ENG<div class="eng fr"></div></a></li>
				<li><a href="#">Support</a></li>
				<li><a href="#">Contact Us</a></li>
			</ul>
		</div>

	</div>

<script type="text/javascript">  
		$('#login-submit').click(function(){
			login();
		});
	
	function login()
	{
		var username = $('#login-username').val();
			var pass = $('#login-pass').val();

			$.post("<?php echo base_url()?>user/login",{name:username,pass:pass}, function(result){
				var  convert = JSON.parse(result);
	            if(convert.result == 1)
	                $(window.location).attr('href', '<?php echo base_url()?>');//redirect to the user page
	            else
	            {
	                // $('.custom-message-box').fadeIn('slide');
	                // $('.custom-message-box').delay(1500).fadeOut();
	                alert(convert.message);
	            }
			});
	}	

	$('#login-username, #login-pass').keyup(function(e){
		if(e.keyCode  == 13)
		{
			login();
		}
	});

</script>