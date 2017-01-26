<!-- page content -->
<?php
error_reporting(E_ERROR|E_WARNING);
?>
			
			<?php
	$sql = "SELECT * FROM expected_repayment join actual_repayment on expected_repayment.oracle_number=actual_repayment.oracle_number and expected_repayment.expected_monthly_repayment_month=actual_repayment.actual_monthly_repayment_month and expected_repayment.expected_monthly_repayment_year=actual_repayment.actual_monthly_repayment_year and expected_repayment.status = actual_repayment.status where expected_repayment.status = 'NOT MERGED' limit 2";
	$query = $this->db->query($sql);
	if($query->num_rows() >= 1 )
	{
?>
	<a href="<?php echo site_url('main/merge');?>" role="button" class="btn btn-default">Merge</a>
<?php } ?>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>ACTUAL REPAYMENT RECORDS<small></small></h2>
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
                      <li><!--<a class="close-link"><i class="fa fa-close">--></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                      DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
                    </p>
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
						<tr class="info">
						<th>S/N</th>
						<th>Name</th>
						<th>Oracle No</th>
						<th>Actual Repayment</th>
						<th>Repayment Month</th>
						<th>Repayment Year</th>
						<th>Status</th>
						<th>Date Entered</th>
						</tr>
					</thead>


                      <tbody>
						<?php $i=1; foreach($actual as $user) { ?>
						<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo strtoupper($user->name); ?></td>
						<td><?php echo $user->oracle_number; ?></td>
						<td><?php echo "&#8358;".number_format($user->actual_repayment); ?></td>
						<td><?php echo strtoupper($user->actual_monthly_repayment_month); ?></td>
						<td><?php echo $user->actual_monthly_repayment_year; ?></td>
						<td><?php echo $user->status; ?></td>
						<td><?php echo $user->date_entered; ?></td>
						<!--<td style=""><a href='<?php echo base_url().'index.php/main/edit_user?id='.$user->id; ?>' ><i class="fa fa-pencil-square-o" aria-hidden="true"  style=""></i></a></td>-->
						</tr>
						<?php $i++; } ?>
					</tbody>
                    </table>
                  </div>
                </div>
              </div>
			</div>