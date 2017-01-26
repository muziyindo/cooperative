<table id="myTable" class="table">
  <thead>
    <tr>
      <th>S/N</th>
      <th>Full Name</th>
      <th>Company</th>
      <th>Role</th>
      <th>Status</th>
      <th>Edit</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1; foreach($all_users as $user) { ?>
      <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $user->name; ?></td>
      <td><?php echo $user->company; ?></td>
      <td><?php echo $user->role; ?></td>
      <td><?php echo $user->status; ?></td>
      <td><a href='<?php echo base_url().'index.php/main/edit_user?id='.$user->id; ?>'><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Edit</a></td>
      </tr>
      <?php $i++; } ?>
  </tbody>
</table>

<style type="text/css">
  .table td {
    color: #000000 !important;
  }  
</style>

<script type="text/javascript">
  $(document).ready(function(){
    $('#myTable').DataTable();
  });
</script>