<?php
                        error_reporting(E_ERROR|E_WARNING);
                        //echo validation_errors(); 
                        //echo form_open('qlip_controller/upload_files');
                        echo form_open_multipart('main/insert_expected_upload');

                        $message=$this->session->flashdata('message');
                       if($message=="file_inserted")
                       {
                    ?>
                           <div class="alert alert-block alert-success">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            File Successfully uploaded!
                         </div>
                    <?php
                       }
                   ?>

                   <?php
                       if(validation_errors() != false) {   
                    ?>
                        <div class="alert alert-block alert-danger">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            <strong>Error!</strong><?php echo validation_errors();?>
                        </div>
 
                  <?php  } ?>

                   <?php
                       if(isset($error1)) {   
                    ?>
                        <div class="alert alert-block alert-danger">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            <strong>Error!</strong><?php echo $error1; ?>
                        </div>
 
                  <?php  } ?>
				  
		  <div class="row">
              <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
				  
					<?php if($this->session->flashdata('message')) { ?>
					<div class="alert alert-success" role="alert" style="text-align:center;">
					<?php echo $this->session->flashdata('message'); ?>
					</div>
					<?php } ?>
					
                    <h2>UPLOAD EXPECTED REPAYMENTS<small></small></h2>
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
  
</p>

<form enctype="multipart/form-data">

	<div class="col-md-6 form-group">
	<label for="selector1">Microfinance Bank<span style="color: red"> *</span></label>
	<select name="mfb" id="role" class="form-control" required> 
	<option value="">--Select--</option>
	<?php
		$sql = "select * from mf_banks";
		$query = $this->db->query($sql);
		foreach($query->result() as $value)
		{
			$bank = $value->bank ;
	?>
	<option value="<?php echo $bank ; ?>"><?php echo $bank ; ?></option>
	<?php
		}
	?>
	</select>
	</div>
  
  <div class="col-md-6 form-group">
	<label for="selector1">Third Party Company<span style="color: red"> *</span></label>
	<select name="third_party" id="role" class="form-control" required> 
	<option value="">--Select--</option>
	<option value="Qlip">Qlip</option>
	<!--<option value="Others">Others</option>-->
	<!--<option value="user">User</option>-->
	</select>
	</div>
	
  <div class="col-md-6 form-group">
	<label for="selector1">Repayment Month<span style="color: red"> *</span></label>
	<select class="form-control" name="repayment_month" value="" required>
                                                 <option value="" >--Select--</option>
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
  <div class="col-md-6 form-group">
	<label for="selector1">Repayment Year<span style="color: red"> *</span></label>
	<select class="form-control" name="repayment_year" value="" required>
                                                 <option value="" >--Select--</option>
                                                 <?php
                                                   $days=2050; $day=2015;

                                                   while($day<=$days)
                                                   {
                                                   ?>
                                                        <option value="<?php echo $day ; ?>" ><?php echo $day ; ?></option>
                                                   
                                                   <?php $day=$day+1; } ?>
                                               </select>
  </div>

	<div class="col-md-6 form-group">
    <label for="username">Upload Sheet<span style="color: red"> *</span></label>
      <input type="file"  name="myuploadFile" required>
  </div>

  
  <div class="clearfix"> </div>

	  <div class="col-md-12 form-group">
			  <input type="hidden" class="form-control" id="" placeholder="" name="flag_" value="100">
              <button type="submit" class="btn btn-primary">Submit</button>
      </div>
</form>
				</div>
                </div>
			</div><!--end col-->
		</div><!--end row-->

