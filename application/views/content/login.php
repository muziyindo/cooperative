
				<?php
                       $message=$this->session->flashdata('message');
                       if($message=="invalid_password")
                       {
                    ?>
                        <div class="alert alert-block alert-warning">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            Incorrect Login details - password
                        </div>
                    <?php
                       }
                   ?>
				   
				   <?php
                       $message=$this->session->flashdata('message');
                       if($message=="invalid_user")
                       {
                    ?>
                        <div class="alert alert-block alert-warning">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            Incorrect Login details - username
                        </div>
                    <?php
                       }
                   ?>
				   
				   


<form action="<?php echo base_url();?>index.php/user_login/authenticate" method="post">
   
	<div id="content">
			<div id="c0">
			<?php 
				if(validation_errors()) 
					echo '<div style="color:red">'.validation_errors().'</div>';
				else
					echo '<code> Kindly enter your username and password</code>';
			?>
			</div>
			<div id="c1">
				USER LOGIN 
			</div>
			
			
			<div class="fd" style="width:70%; margin-left:auto; margin-right:auto; padding:10px; color:gray;">
				USERNAME :
				<input type="text" name="username" placeholder="" style="width:100%; height:40px; font-size:15px; text-align:center;" >
			</div>
			
			<div class="fd" style="width:70%; margin-left:auto; margin-right:auto; padding:10px; color:gray;">
				PASSWORD :
				<input type="password" name="password" placeholder="" style="width:100%; height:40px; font-size:15px; text-align:center;" >
			</div>
			
			
			<div class="fd" style="width:70%; margin-left:auto; margin-right:auto; padding:10px; color:gray;">
				
				<input type="submit" name="submit" style="width:100%; font-size:15px; text-align:center; background:#3e5380; color:white;" value="SIGN IN"></input>
			</div>
			
			
		</div>
		</form>
		
		<div class="fd" style="width:50%; margin-left:auto; margin-right:auto; padding:40px; color:blue; text-align:center; ">
				Copyright &copy , 2016.
		</div>