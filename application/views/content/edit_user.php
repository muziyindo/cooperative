
                
<div class="grid-form1" style="border: 0">
<?php if($this->session->flashdata('message')) { ?>
<div class="alert alert-success" role="alert">
  <?php echo $this->session->flashdata('message'); ?>
</div>
<?php } ?>

  <div class="panel panel-default" style="width:70%; margin-left:auto; margin-right:auto;">
    <div class="panel-heading" style="text-align:center;">
      <h3 id="forms-horizontal">Registration Form</h3>
    </div>
    
    <div class="panel-body" style="padding:30px; ">
<p>Form fields with asterisks <span style="color: red"> *</span> are compulsory</p>
<p id="errors" style="color: red">
  <?php echo validation_errors(); ?>
</p>
<?php 
	$id = $user[0]->id; 
?>
<?php echo form_open('main/edit_user/'.$id); ?>
<form class="form-horizontal" method="post" action="insert_user">
  <div class="form-group">
    <label for="fullname">Full Name<span style="color: red"> *</span></label>
      <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Full Name" value="<?php echo $user[0]->name; ?>" required>
  </div>
  <div class="form-group">
    <label for="email">Email</label>
      <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="<?php echo $user[0]->email; ?>">
  </div>
  <div class="form-group">
    <label for="company">Company<span style="color: red"> *</span></label>
      <input type="text" name="company" class="form-control" id="company" placeholder="Company" value="<?php echo $user[0]->company; ?>" required>
  </div>

  <div class="form-group">
  <label for="selector1">Role<span style="color: red"> *</span></label>
  <select name="role" id="role" class="form-control" required value="<?php echo $user[0]->role; ?>"> 
  <option value="">Select Role</option>
  <option value="admin">Admin</option>
  <option value="user">User</option>
  </select>
  </div>

  <div class="form-group">
  <label for="selector1">Status<span style="color: red"> *</span></label>
  <select name="status" id="status" class="form-control" required value="<?php echo $user[0]->status; ?>"> 
  <option value="enabled">Enabled</option>
  <option value="disabled">Disabled</option>
  </select>
  </div>

  <div class="form-group">
    <label for="username">Username<span style="color: red"> *</span></label>
      <input type="text" name="username" class="form-control" id="username" placeholder="Username" value="<?php echo $user[0]->username; ?>" required>
  </div>

      <button type="submit" id="submit" class="btn btn-default">Update</button>
</form>
</div><!--end panel body-->
  </div><!--end panel out div-->
</div>


<script type="text/javascript">
  $('#role').val('<?php echo $user[0]->role; ?>')
  $('#status').val('<?php echo $user[0]->status; ?>')
</script>