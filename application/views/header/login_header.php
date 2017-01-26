<html>
	<head>
		<title><?php echo $title; ?></title>
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<meta name="description" content="Developed By M Abdur Rokib Promy">
		<meta name="keywords" content="Admin, Bootstrap 3, Template, Theme, Responsive">
		<link href="<?php echo base_url() ; ?>asset/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		
		<style>
    .login-container .logobox{height:auto !important; min-height:50px;padding:10px;}
	.login-container{max-width:50% !important;margin:0 auto;}
	.login-container .loginbox{width:100% !important;}
	
	
	*{
				-webkit-box-sizing: border-box;
				-moz-box-sizing: border-box;
					box-sizing: border-box;
			}
			#d1
			{
				margin:5px;
			}
			
			#logo_div
			{
				background:url(<?php echo base_url() ?>/asset/images/logo.png);
				float:left;
				height:130px;
				width:10%;
				font-size:14px;
				color:#001f3f;
				font-weight:bold;
				text-align:center;
				padding-top:108px;
				border-bottom: 5px solid #001f3f;
				
				
			}
			#container_div2
			{
				width:100%;
				height:130px;
				float:left;
				background:url(<?php echo base_url() ?>/asset/images/bg.jpg);
			}
			#top_header_div
			{
				width:100%;
				height:40px;
				float:left;
				
			}
			#user_d
			{
				width:100%;
				height:40px;
				float:left ;
				color:orange;
				background:gray;
				text-align:right;
				padding-right:30px;
				padding-top:20px;
			}
			#bottom_header_div
			{
				width:100%;
				height:50px;
				float:left;
				background:#001f3f;
				text-align:right;
				color:white;
				font-size:17px;
				padding-top:20px;
				padding-right:5px;
				
			}
			#iid1
			{
				width:50%;
				
				height:80px;
				float:left ;
			}
			#iid2
			{
				width:50%;
				height:80px;
				float:left ;
			}
			
			.link1
			{
				width:20%;
				height:40px;
				padding:5px;
				float:left;
				color:white;
				font-size:13px;
				margin-top:7px;
			}
			
			#content
			{
				width:30%;
				margin-top:100px;
				margin-left:auto;
				margin-right:auto;
				/*background:url(bg.jpg);*/
				border-style:outset;
				background:#f1f2f7;
				box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
				height:450px;
			}
			#c0
			{
				width:100%;
				height:50px;
				text-align: center;
				padding:5px;
				
			}
			#c1
			{
				width:100%;
				height:50px;
				text-align: center;
				padding:5px;
				font-size:25px;
				font-weight:bold;
				/**background:url(<?php echo base_url() ?>/asset/images/bg.jpg);**/
				
				
			}
			body
			{
				background:white;
			}
			
			
			
			
			
			@media only screen and (max-width: 768px) 
			{
				/* For mobile phones: */
				
				#id2
				{
					width:100% ;
					text-align:center ;
				}
				
				#d2i1
				{
					width:100% ;
				}
				#d2i2
				{
					width:100% ;
				}
				#d2i3
				{
					width:100% ;
				}
				#d2i4
				{
					width:100% ;
				}
				
				
			}
    </style>
	
	</head>
	
	<body>
	
	<!--<div id="d1">
			
			<div id="container_div2">
				<div id="top_header_div">
					<div id="iid1">
					</div>
					<div id="iid2">
						<div class="link1">
							
						</div>
						<div class="link1">
							
						</div>
						<div class="link1">
							
						</div>
						<div class="link1">
							
						</div>
						
						<?php
							$uid = $this->session->userdata('userid');
							if(!empty($uid))
							{
						?>
							<div class="link1">
							<a href="<?php echo base_url();?>index.php/main/view_voucher" style="color:white">Voucher Request</a>
						</div>
						<?php	
							}
						?>
						
						<br style="clear:left;">
					</div>
				</div>
				<div id="user_d">
				<?php
					$uid = $this->session->userdata('userid');
					if(empty($uid))
					{
				?>
					<a href="<?php echo base_url();?>index.php/user_login" style="color:orange;">Login</a><a href="<?php echo base_url();?>index.php/main/sign_up" style="color:orange;"> | Sign Up</a>
				<?php	
					}
					else
					{
						
						$name = $this->session->userdata('name');
				?>
						
						<span style="color:white">Welcome</span><?php  echo " ".$name ; ?><a href="<?php echo base_url();?>index.php/main/logout" style="color:#fff;"> | Logout</a><a href="<?php echo base_url();?>index.php/main/change_password" style="color:#fff;"> | Change Password</a>
				<?php
					}
				?>
					
				</div>
				<div id="bottom_header_div">
					Co-operative Portal
				</div>
				<br style="clear:left;">
			</div>
			<br style="clear:left;">
			
		</div>-->