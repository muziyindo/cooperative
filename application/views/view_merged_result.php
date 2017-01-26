<!-- page content -->
        

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>MERGED RESULTS <small></small></h2>
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
				  
				  <form action="<?php echo site_url('main/search_merged/'); ?>" method="post" accept-charset="utf-8">
				  <div class="row">
						<div class="col-xs-3">
							<label>Microfinance Bank</label>
							<select class="form-control" name="bank">
								<option value="all">All</option>
								<option value="Primera MFB">Primera MFB</option>
								<option value="Firstbank">Firstbank</option>
								<option value="Guarantee MFB">Guarantee MFB</option>
							</select>
						</div>
						<div class="col-xs-2">
							<label>Repayment Month</label>
							<select class="form-control" name="month">
								<option value="all">All</option>
								<option value="january" >January</option>
                                <option value="february">February</option>
                                <option value="march">March</option>
                                <option value="april" >April</option>
                                <option value="may">May</option>
                                <option value="june">June</option>
                                <option value="july" >July</option>
                                <option value="august">August</option>
                                <option value="september">September</option>
                                <option value="october" >October</option>
                                <option value="november">November</option>
                                <option value="december">December</option>
							</select>
						</div>
						<div class="col-xs-2">
							<label>Repayment Year</label>
							<select class="form-control" name="year">
								<option value="all">All</option>
								<?php
                                 $days=2050; $day=2015;

                                 while($day<=$days)
                                 {
                                 ?>
                                      <option value="<?php echo $day ; ?>" ><?php echo $day ; ?></option>
                                 
                                 <?php $day=$day+1; } ?>
							</select>
						</div>
						<div class="col-xs-2">
							<label>.</label>
							<input type="submit" role="button" class="btn btn-default btn-block" value="Search" name="btn_search" ></input>
						</div>
						<div class="col-xs-3">
							<label>.</label>
							<input type="submit" role="button" class="btn btn-info btn-block" value="Spool" name="btn_search" style="border:5px solid gray; border-style:outset;"></input>
						</div>
				  </div>
				  </form>
				  
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                      <code>You can search by any of the columns shown below</code>
                    </p>
					<div class="horizontal" style="width: 100%; height: 100%; overflow: auto;">
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
						<tr>
						<th>S/N</th>
						<th>Name</th>
						<th>Oracle No</th>
						<!--<th>Ministry</th>-->
						<th>MFB Bank</th>
						<!--<th>Third Party</th>-->
						<th>Loan Amount</th>
						<th>Expected Monthly</th>
						<th>Total Expected</th>
						<th>Repayment Month</th>
						<th>Repayment Year</th>
						<th>Percentage From  Total</th>
						<th>Actual Repayment</th>
						<th>Percentage Equivalent</th>
						<th>Amount Deducted</th>
						<th>Outstanding</th>
						<th>Remittance</th>
						<th>EQ/PR</th>
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
						<!--<td><?php echo strtoupper($user->third_party_company); ?></td>-->
						<td><?php echo "&#8358;".number_format($user->loan_amount,2); ?></td>
						<td><?php echo "&#8358;".number_format($user->expected_monthly_repayment_amount,2); ?></td>
						<td><?php echo "&#8358;".number_format($user->total_expected,2); ?></td>
						<td><?php echo $user->expected_monthly_repayment_month; ?></td>
						<td><?php echo $user->expected_monthly_repayment_year; ?></td>
						<td><?php echo number_format($user->percentage_from_total,2)."%"; ?></td>
						<td><?php echo "&#8358;".number_format($user->actual_repayment,2); ?></td>
						<td><?php echo "&#8358;".number_format($user->percentage_equivalent,2) ; ?></td>
						<td><?php echo "&#8358;".number_format($user->amount_deducted,2) ; ?></td>
						<td><?php echo "&#8358;".number_format($user->outstanding,2) ; ?></td>
						<td><?php echo "&#8358;".number_format($user->remittance,2) ; ?></td>
						<!--<td><?php echo "&#8358;".number_format($user->balance,2); ?></td>-->
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
			</div>