<!-- page content -->
			
			<?php
	$sql = "SELECT * FROM expected_repayment join actual_repayment on expected_repayment.oracle_number=actual_repayment.oracle_number and expected_repayment.expected_monthly_repayment_month=actual_repayment.actual_monthly_repayment_month and expected_repayment.expected_monthly_repayment_year=actual_repayment.actual_monthly_repayment_year and expected_repayment.status = actual_repayment.status where expected_repayment.status = 'NOT MERGED'";
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
                    <h2>CUMMULATIVE DEDUCTIONS,OUTSTANDING AND REMITTANCE<small></small></h2>
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
				  
				  <form action="<?php echo site_url('main/search_cumm/cummulative_report/view_cummulative_report_'); ?>" method="post" accept-charset="utf-8">
				  <div class="row">
						<div class="col-xs-3">
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
							<label>.</label>
							<input type="submit" role="button" class="btn btn-default btn-block" value="Search" name="btn_search" ></input>
						</div>
						<!--<div class="col-xs-3">
							<label>.</label>
							<input type="submit" role="button" class="btn btn-info btn-block" value="Spool" name="btn_search" style="border:5px solid gray; border-style:outset;"></input>
						</div>-->
				  </div>
				  </form>
				  
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30" style="color:red">
                      PLEASE NOTE:<code>The total expected amount does not include customers that are not merged( i.e not found on oracle deduction sheet)</code>
                    </p>
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
						<tr class="info">
						<th>S/N</th>
						<th>Microfinance Bank</th>
						<th>Month</th>
						<th>Year</th>
						<th>Total Expected</th>
						<th>Cummulative Deduction</th>
						<th>Cummulative Outstanding</th>
						<th>Cummulative Remittance</th>
						<th>Date Merged</th>
						</tr>
					</thead>


                      <tbody>
						<?php $i=1; foreach($data as $user) { ?>
						
						<?php
							$bank = $user->microfinance_bank;
							$month = $user->expected_monthly_repayment_month;
							$year = $user->expected_monthly_repayment_year;
							
							$sql = "select microfinance_bank,expected_monthly_repayment_month,expected_monthly_repayment_year,sum(expected_monthly_repayment_amount) as cumm_expected,sum(amount_deducted) as cumm_deduction,sum(outstanding) as cumm_outstanding,sum(remittance) as cumm_remittance,date_merged from merged_result where microfinance_bank='$bank' and expected_monthly_repayment_month='$month' and expected_monthly_repayment_year='$year'";
							$query = $this->db->query($sql);
							foreach($query->result() as $value)
							{
						?>
						<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo strtoupper($value->microfinance_bank); ?></td>
						<td><?php echo strtoupper($value->expected_monthly_repayment_month); ?></td>
						<td><?php echo $user->expected_monthly_repayment_year; ?></td>
						<td><?php echo number_format($value->cumm_expected,2); ?></td>
						<td><?php echo number_format($value->cumm_deduction,2); ?></td>
						<td><?php echo number_format($value->cumm_outstanding,2); ?></td>
						<td><?php echo number_format($value->cumm_remittance,2); ?></td>
						<td><?php echo $value->date_merged ; ?></td>
						<!--<td style=""><a href='<?php echo base_url().'index.php/main/edit_user?id='.$user->id; ?>' ><i class="fa fa-pencil-square-o" aria-hidden="true"  style=""></i></a></td>-->
						</tr>
						<?php
							}
						?>
						<?php $i++; } ?>
					</tbody>
                    </table>
                  </div>
                </div>
              </div>
			</div>