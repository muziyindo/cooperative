<!-- page content -->
        

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>EXPECTED REPAYMENT RECORDS <small></small></h2>
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
				  
				  <!--Searches Start-->
				  <form action="<?php echo site_url('main/search/expected_repayment/view_expected_record'); ?>" method="post" accept-charset="utf-8">
				  <div class="row">
						<div class="col-xs-2">
							<label>Microfinance Bank</label>
							<select class="form-control" name="bank" id="bank">
								<option value="all" <?php if($bank=='all') echo 'selected="selected"';?>>All</option>
								<?php
									$sql = "select * from mf_banks";
									$query = $this->db->query($sql);
									foreach($query->result() as $value)
									{
										$bank_db = $value->bank ;
								?>
								<option value="<?php echo $bank_db ; ?>" <?php if($bank==$bank_db) echo 'selected="selected"';?>><?php echo $bank_db ; ?></option>
								<?php
									}
								?>
								
							</select>
						</div>
						<div class="col-xs-2">
							<label>Repayment Month</label>
							<select class="form-control" name="month" id="month">
								<option value="all" <?php if($month=='all') echo 'selected="selected"';?>>All</option>
								<option value="january" <?php if($month=='january') echo 'selected="selected"';?>>January</option>
                                <option value="february" <?php if($month=='february') echo 'selected="selected"';?>>February</option>
                                <option value="march" <?php if($month=='march') echo 'selected="selected"';?>>March</option>
                                <option value="april" <?php if($month=='april') echo 'selected="selected"';?>>April</option>
                                <option value="may" <?php if($month=='may') echo 'selected="selected"';?>>May</option>
                                <option value="june" <?php if($month=='june') echo 'selected="selected"';?>>June</option>
                                <option value="july" <?php if($month=='july') echo 'selected="selected"';?>>July</option>
                                <option value="august" <?php if($month=='august') echo 'selected="selected"';?>>August</option>
                                <option value="september" <?php if($month=='september') echo 'selected="selected"';?>>September</option>
                                <option value="october" <?php if($month=='october') echo 'selected="selected"';?>>October</option>
                                <option value="november" <?php if($month=='november') echo 'selected="selected"';?>>November</option>
                                <option value="december" <?php if($month=='december') echo 'selected="selected"';?>>December</option>
							</select>
						</div>
						<div class="col-xs-2">
							<label>Repayment Year</label>
							<select class="form-control" name="year" id="year" >
								<option value="all">All</option>
								<?php
                                 $days=2050; $day=2015;

                                 while($day<=$days)
                                 {
                                 ?>
                                      <option value="<?php echo $day ; ?>" <?php if($year==$day) echo 'selected="selected"';?>><?php echo $day ; ?></option>
                                 
                                 <?php $day=$day+1; } ?>
							</select>
						</div>
						<div class="col-xs-2">
							<label>Keyword</label>
							<input type="text" class="form-control" placeholder="Search" name="keyword" <?php if(!empty($keyword)) echo 'value='.$keyword ;  ?>></input>
						</div>
						<div class="col-xs-2">
							<label>.</label>
							<input type="submit" role="button" class="btn btn-default btn-block" value="Search" name="btn_search" ></input>
						</div>
						<div class="col-xs-2">
							<label>.</label>
							<input type="submit" role="button" class="btn btn-info btn-block" value="Spool" name="btn_search" style="border:5px solid gray; border-style:outset;"></input>
						</div>
				  </div>
				  </form>
				  <!--Searches End-->
				  
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                      DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
                    </p>
                    <table id="datatable_" class="table table-striped table-bordered">
                      <thead>
                        <tr>
							<th>S/N</th>
							<th>Name</th>
							<th>Oracle No</th>
							<!--<th>Ministry</th>-->
							<th>MFB Bank</th>
							<!--<th>Third Party</th>
							<th>Loan Amount</th>-->
							<th>Expected Monthly</th>
							<th>Total Expected</th>
							<th>Repayment Month</th>
							<th>Repayment Year</th>
							<th>Percentage From  Total</th>
							<th>Status</th>
							<th>Date Entered</th>
                        </tr>
                      </thead>


                      <tbody>
						<?php $i=1; foreach($data as $user) { ?>
						<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo strtoupper($user->name); ?></td>
						<td><?php echo $user->oracle_number; ?></td>
						<!--<td><?php echo strtoupper($user->ministry); ?></td>-->
						<td><?php echo strtoupper($user->microfinance_bank); ?></td>
						<!--<td><?php echo strtoupper($user->third_party_company); ?></td>
						<td><?php echo "&#8358;".number_format($user->loan_amount,2); ?></td>-->
						<td><?php echo "&#8358;".number_format($user->expected_monthly_repayment_amount,2); ?></td>
						<td><?php echo "&#8358;".number_format($user->total_expected,2); ?></td>
						<td><?php echo strtoupper($user->expected_monthly_repayment_month); ?></td>
						<td><?php echo $user->expected_monthly_repayment_year; ?></td>
						<td><?php echo number_format($user->percentage_from_total,2)."%"; ?></td>
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