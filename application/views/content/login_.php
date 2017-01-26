
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Minimal Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="<?php echo base_url(); ?>asset/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="<?php echo base_url();?>asset/css/style.css" rel='stylesheet' type='text/css' />
<link href="<?php echo base_url();?>asset/css/font-awesome.css" rel="stylesheet"> 
<script src="<?php echo base_url();?>asset/js/jquery.min.js"> </script>
<script src="<?php echo base_url();?>asset/js/bootstrap.min.js"> </script>
<!--<script src="<?php echo base_url(); ?>asset/js/index.js"></script>-->
</head>
<body style="background-color: white">
	<div class="login" style="background-color: white;">
		<h1><a href="#"><img src="<?php echo base_url();?>asset/images/qlogo.png" ><img></a></h1>
		<!--<h1><a href="index.html">Minimal </a></h1>-->
		<div class="login-bottom" style=""><!--style="background-color: #001f3f !important;"-->
		<p id="error" style="color:red"></p>
			<h2 style="color:white;">Login</h2>
			<form>
			<div class="col-md-6">
				<div class="login-mail" style="">
					<input type="text" id="username" placeholder="Username" required="" style="" >
					<i class="fa fa-envelope"></i>
				</div>
				<div class="login-mail">
					<input type="password" id="password" placeholder="Password" required="" style="">
					<i class="fa fa-lock"></i>
				</div>
				   <!--<a class="news-letter " href="#">
						 <label class="checkbox1"><input type="checkbox" name="checkbox" ><i> </i>Forget Password</label>
					   </a>-->

			
			</div>
			<div class="col-md-6 login-do">
				<label class="hvr-shutter-in-horizontal login-sub">
					<button type="button" class="hvr-shutter-in-horizontal" onclick="login()" id="login-button">Login</button>
					</label>
					<p>Do not have an account?</p>
				<a href="signup.html" class="hvr-shutter-in-horizontal">Forget Password</a>
			</div>
			
			<div class="clearfix"> </div>
			</form>
		</div>
	</div>
		<!---->
<div class="copy-right">
            <p> Copyright &copy; Primera 2016 </p>	    </div>  
<!---->
<!--scrolling js-->
	<script src="<?php echo base_url();?>asset/js/jquery.nicescroll.js"></script>
	<script src="<?php echo base_url();?>asset/js/scripts.js"></script>
	<!--//scrolling js-->
	
	<script type="text/javascript">
		 $("#login-button").click(function(event){
		 event.preventDefault();
	 var authenticate = login();
	//console.log(authenticate);
});

function login() {
	var username = $('#username').val();
	var password = $('#password').val();
	$.post("<?php echo site_url(); ?>/user_login/authenticate",
            {
                username : username,
                password: password
            },
            function(data)
            {
            	$('#error').empty();
            	if(data=='incorrect') {
            		$('#error').text('Incorrect login credentials');
            	}
            	else
            	{
            		$('#error').text('Login successful');
            		$('form').fadeOut(500);
					$('.wrapper').addClass('form-success');
					setTimeout(function() {window.location.assign('<?php echo site_url(); ?>/main/create_user');}, 2000)
            	}
            })
}
	</script>
	
</body>
</html>


		
        
