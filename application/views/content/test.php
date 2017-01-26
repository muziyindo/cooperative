<!-- page content -->
        

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Default Example <small>Users</small></h2>
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
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
						<tr class="info">
						<th>S/N</th>
						<th>Name</th>
						<th>Oracle No</th>
						<!--<th>Ministry</th>-->
						<th>MFB Bank</th>
						<th>Third Party</th>
						<th>Loan Amount</th>
						<th>Expected Monthly</th>
						<th>Total Expected</th>
						<th>Repayment Month</th>
						<th>Repayment Year</th>
						<th>Percentage From  Total</th>
						<th>Actual Repayment</th>
						<th>Percentage Equivalent</th>
						<th>Balance</th>
						<th>Split Type</th>
						<th>Date</th>
						</tr>
					</thead>


                      <tbody>
						<?php $i=1; foreach($expected as $user) { ?>
						<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo strtoupper($user->name); ?></td>
						<td><?php echo $user->oracle_number; ?></td>
						<!--<td><?php echo strtoupper($user->ministry); ?></td>-->
						<td><?php echo strtoupper($user->microfinance_bank); ?></td>
						<td><?php echo strtoupper($user->third_party_company); ?></td>
						<td><?php echo "&#8358;".number_format($user->loan_amount,2); ?></td>
						<td><?php echo "&#8358;".number_format($user->expected_monthly_repayment_amount,2); ?></td>
						<td><?php echo "&#8358;".number_format($user->total_expected,2); ?></td>
						<td><?php echo $user->expected_monthly_repayment_month; ?></td>
						<td><?php echo $user->expected_monthly_repayment_year; ?></td>
						<td><?php echo $user->percentage_from_total; ?></td>
						<td><?php echo $user->actual_repayment; ?></td>
						<td><?php echo $user->percentage_equivalent; ?></td>
						<td><?php echo $user->balance; ?></td>
						<td><?php echo $user->config_type; ?></td>
						<td><?php echo $user->date_merged; ?></td>
						<!--<td style=""><a href='<?php echo base_url().'index.php/main/edit_user?id='.$user->id; ?>' ><i class="fa fa-pencil-square-o" aria-hidden="true"  style=""></i></a></td>-->
						</tr>
						<?php $i++; } ?>
					</tbody>
                    </table>
                  </div>
                </div>
              </div>
			</div>