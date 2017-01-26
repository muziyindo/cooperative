<?php echo validation_errors(); ?>

<div class="row">
              <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
				  
					<?php if($this->session->flashdata('message')) { ?>
					<div class="alert alert-success" role="alert" style="text-align:center;">
					<?php echo $this->session->flashdata('message'); ?>
					</div>
					<?php } ?>
					
                    <h2>USER PROFILING FORM<small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
					
                    <p>Form fields with asterisks <span style="color: red"> *</span> are compulsory</p>
<p id="errors" style="color: red">
  <?php echo validation_errors(); ?>
</p>
<?php echo form_open('main/insert_user'); ?>
<form>
	<div class="col-md-6 form-group" >
    <label for="fullname">Full Name<span style="color: red"> *</span></label>
      <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Full Name" value="" required>
  </div>
  <div class="col-md-6 form-group">
	
									
    <label for="email">Email</label>
		<div class="input-group">							
		<span class="input-group-addon"><span><i class="fa fa-envelope-o"></i></span></span>
      <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="<?php echo set_value('email'); ?>">
	  </div>
  </div>
  <div class="col-md-6 form-group">
	<label for="selector1">Company<span style="color: red"> *</span></label>
	<select name="company" id="role" class="form-control" required> 
	<option value="">--Select--</option>
	<option value="qlip">Qlip</option>
	<!--<option value="user">User</option>-->
	</select>
  </div>
  <div class="col-md-6 form-group">
	<label for="selector1">Role<span style="color: red"> *</span></label>
	<select name="role" id="role" class="form-control" required> 
	<option value="">Select Role</option>
	<option value="admin">Admin</option>
	<option value="user">User</option>
	</select>
  </div>

	<div class="col-md-6 form-group">
    <label for="username">Username<span style="color: red"> *</span></label>
      <input type="text" name="username" class="form-control" id="username" placeholder="Username" value="<?php echo set_value('username'); ?>" required>
  </div>

  <div class="col-md-6 form-group">
    <label for="password1">Password<span style="color: red"> *</span></label>
	 <div class="input-group">							
	 <span class="input-group-addon"><span><i class="fa fa-key"></i></span></span>
      <input name="password1" type="password" class="form-control" id="password1" placeholder="Password" required>
	 </div>
  </div>

	<div class="col-md-6 form-group">
    <label for="password2">Password Confirmation<span style="color: red"> *</span></label>
	 <div class="input-group">							
	 <span class="input-group-addon"><span><i class="fa fa-key"></i></span></span>
      <input type="password" name="password2" class="form-control" id="password2" placeholder="Password Confirmation">
	  </div>
  </div>
  <div class="col-md-6 form-group">
	<label for="selector1">Status<span style="color: red"> *</span></label>
	<select name="status" id="role" class="form-control" required> 
	<option value="enable">Enable</option>
	<option value="disable">Disable</option>
	</select>
  </div>
  <div class="clearfix"> </div>

	  <div class="col-md-12 form-group">
              <button type="submit" class="btn btn-primary">Add User</button>
              <button type="reset" class="btn btn-default">Reset</button>
      </div>
</form>

                  </div>
                </div>
			</div><!--end col-->
		</div><!--end row-->