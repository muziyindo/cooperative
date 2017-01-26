<?php

error_reporting(E_ERROR|E_WARNING);
ob_start();
class Main extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->library('encrypt');
		$this->load->library('session');
		$this->load->model('main_model');
		
		$ud = $this->session->userdata('userid');
        if ($ud < 1)
        {
              redirect('user_login','refresh');
        }
		
	}
	
	function create_user()
	{
		$data['title'] = 'New user';
		$this->load->view('header/header',$data);
		$this->load->view('content/create_user');
		$this->load->view('footer/footer');
	}

	function insert_user()
	{
		$this->form_validation->set_error_delimiters('<div class="error" style="color: red">', '</div>');
		$this->form_validation->set_message('matches', 'Passwords do not match');
		$this->form_validation->set_message('is_unique', 'User with %s already exists');
		$this->form_validation->set_message('required', 'The %s field must be filled');
		$this->form_validation->set_rules('fullname', 'Full Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('company', 'Company', 'trim|required');
		$this->form_validation->set_rules('role', 'Role', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[users.username]');
		/*$this->form_validation->set_rules('password1', 'Password', 'required|matches[password2]');*/
		
		$this->form_validation->set_rules('password1', 'Password', 'trim|required|matches[password2]');
        $this->form_validation->set_rules('password2', 'Password Confirmation', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('header/header');
			$this->load->view('content/create_user');
			$this->load->view('footer/footer');
			//$this->session->set_flashdata('item', 'value');
			//redirect('main/create_user');
		}
		else
		{
				$this->load->model('main_model');
				$this->main_model->insert_user();
				$num_inserts = $this->db->affected_rows();
				if($num_inserts=="1")
				{
					$this->session->set_flashdata('message', 'User '.$fullname.' has been successfully registered');
					redirect('main/create_user');
				}
				else
				{
					echo "There is an issue with the user creation";
				}
		}

	}
	
	function edit_user()
	{
		if($this->input->post())
		{
			$this->form_validation->set_error_delimiters('<div class="error" style="color: red">', '</div>');
			$this->form_validation->set_message('matches', 'Passwords do not match');
			$this->form_validation->set_message('is_unique', 'User with %s already exists');
			$this->form_validation->set_rules('fullname', 'Full Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
			$this->form_validation->set_rules('company', 'Company', 'trim|required');
			$this->form_validation->set_rules('role', 'Role', 'trim|required');
			$this->form_validation->set_rules('username', 'Username', 'trim|required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('header/header');
				$this->load->view('content/create_user');
				$this->load->view('footer/footer');
				
			}
			else
			{
				$id = $this->uri->segment(3); 
				$this->main_model->update_user($id);
				$num_inserts = $this->db->affected_rows();
				if($num_inserts=="1")
				{
					$this->session->set_flashdata('message', 'Update Successful');
					redirect('main/edit_user?id='.$id);
				}
				else
				{
					$this->session->set_flashdata('message', 'No update was done!');
					redirect('main/edit_user?id='.$id);
				}
				
				//redirect('main/view_users','refresh');
			}
		}
		else
		{
			$id = $this->input->get('id');
			$data['user'] = $this->main_model->get_user($id);
			$this->session->set_flashdata('id', $id);
			$data['title'] = 'Edit user';
			$this->load->view('header/header',$data);
			$this->load->view('content/edit_user', $data);
			$this->load->view('footer/footer');
		}
		
	}
	
	function view_users()
	{
		$this->load->model('main_model');
		$data['all_users'] = $this->main_model->get_all_users();
		$data['title'] = 'users';
		$this->load->view('header/header',$data);
		$this->load->view('content/view_users',$data);
		$this->load->view('footer/footer');
	}
	
	function upload_expected_view()
	{
		$data['title'] = 'Upload Expected';
		$this->load->view('header/header',$data);
		$this->load->view('content/upload_expected_view');
		$this->load->view('footer/footer');
	}
	
	function insert_expected_upload()
   {
    
    $uname = $this->session->userdata('uname');
	$this->form_validation->set_rules('repayment_year', 'Repayment year', 'required');
	$this->form_validation->set_rules('repayment_month', 'repayment Month', 'required');
	$this->form_validation->set_rules('third_party', 'Third Party', 'required');
    $this->form_validation->set_rules('mfb', 'Microfinance Bank', 'required');
   $this->form_validation->set_rules('flag_', 'Document', 'required');
   if (empty($_FILES['myuploadFile']['name']))
    {
        $this->form_validation->set_rules('myuploadFile', 'Document', 'required');
    }

    if ($this->form_validation->run() === FALSE)
    {
		$data['title'] = 'Upload Expected';
		$this->load->view('header/header',$data);
		$this->load->view('content/upload_expected_view');
		$this->load->view('footer/footer');
      
    }
    else
    {
        $storeFolder = './uploads/';
        if (!empty($_FILES)) 
        { 
          $tempFile = $_FILES['myuploadFile']['tmp_name'];            
          $targetPath =$storeFolder;
          $temp = explode(".", $_FILES["myuploadFile"]["name"]);
          $newfilename = time().$_FILES["myuploadFile"]["name"];
          $targetFile =  $targetPath. $newfilename;  
          move_uploaded_file($tempFile,$targetFile); 
          $path=$file_name='uploads/'.$newfilename;

          $this->insert_from_uploaded_expected($path);
        }

    }

 }
 
 function insert_from_uploaded_expected($path)
 {

     $this->load->library('PHPExcel/Classes/PHPExcel');
     $inputFileType = PHPExcel_IOFactory::identify($path);
     $objReader1     = PHPExcel_IOFactory::createReader($inputFileType);
     $objPHPExcel1   = $objReader1->load($path);
     $sheetList      = $objReader1->listWorksheetNames($path); 
     foreach ($sheetList as $sheetName)
     {
        $currentObjectName  = $objPHPExcel1->setActiveSheetIndexByName($sheetName);
        $result=$this->insertintodb_uploaded_expected($currentObjectName);
     }
  }
  
  function insertintodb_uploaded_expected($objWorksheet1)
{ 
	
	error_reporting(E_ERROR|E_WARNING);
	ini_set('memory_limit','512M');
	ini_set('max_execution_time', 10000); //300 seconds = 5 minutes

    $unames = $this->session->userdata('uname');

    $entry_date=date('Y-m-d');
    $this->load->library('form_validation');
    $highestRow1 = $objWorksheet1->getHighestRow(); // e.g. 10
    $row1=1; // row in which customers description starts in a work sheet
    $row_start= $row1+1;
    
    //design error page ;
    echo '<html>';
    echo '<head>';
    echo '<title>Result</title>';
    echo '<head>';
    echo '<link href="'.base_url().'asset/css/bootstrap.min.css" rel="stylesheet">';
    //echo '<link href="'.base_url().'asset/css/style.css" rel="stylesheet">';
    echo '<link href="'.base_url().'asset/js/bootstrap.min.js"></script>';
    echo '<link href="'.base_url().'asset/js/jquery.min.js"></script>';
    echo '</head>';

    echo '<body>';

    echo '<p><div class="container">';
    echo '<div class="panel panel-primary">';
    echo '<div class="panel-heading">File Upload Report(s)</div>';
    echo '<div class="panel-body">';

    for ($row_start; $row_start <= $highestRow1; $row_start++) //$highestRow
    {
          $row1=$row_start;
          $oracle_no=$objWorksheet1->getCellByColumnAndRow(0, $row1)->getValue()?$objWorksheet1->getCellByColumnAndRow(0, $row1)->getValue():'';
          $name=$objWorksheet1->getCellByColumnAndRow(1, $row1)->getValue()?$objWorksheet1->getCellByColumnAndRow(1, $row1)->getValue():'';
		  //$ministry=$objWorksheet1->getCellByColumnAndRow(2, $row1)->getValue()? $objWorksheet1->getCellByColumnAndRow(2, $row1)->getValue():'';
          //$loan_amount=$objWorksheet1->getCellByColumnAndRow(2, $row1)->getValue()? $objWorksheet1->getCellByColumnAndRow(3, $row1)->getValue():'';
          $expected_monthly_repayment_amount=$objWorksheet1->getCellByColumnAndRow(2, $row1)->getValue()? $objWorksheet1->getCellByColumnAndRow(2, $row1)->getValue():'';
          //$tenure=$objWorksheet1->getCellByColumnAndRow(4, $row1)->getValue() ? $objWorksheet1->getCellByColumnAndRow(5, $row1)->getValue() : ''; 
          //$repayment_frequency=$objWorksheet1->getCellByColumnAndRow(5, $row1)->getValue() ? $objWorksheet1->getCellByColumnAndRow(6, $row1)->getValue() : '';
		  
		  $ministry="NA";
		  $loan_amount="0";
		  $tenure="NA";
		  $repayment_frequency="NA";
		  
		  $mfb = $this->input->post('mfb');
		  $third_party = $this->input->post('third_party');
		  $repayment_month = $this->input->post('repayment_month');
		  $repayment_year = $this->input->post('repayment_year');
		  
		  //Remove commas from expected monthly repayment amount
		  $expected_monthly_repayment_amount = str_replace(",","",$expected_monthly_repayment_amount);
		  //str_replace(","," ",$row['city'])
		  
		  
          /*$po_number=$objWorksheet1->getCellByColumnAndRow(6, $row1)->getValue() ? $objWorksheet1->getCellByColumnAndRow(6, $row1)->getValue() : '';
          $vendor=$objWorksheet1->getCellByColumnAndRow(7, $row1)->getValue() ? $objWorksheet1->getCellByColumnAndRow(7, $row1)->getValue() : '';
          $purchase_date=$objWorksheet1->getCellByColumnAndRow(8, $row1)->getValue() ? $objWorksheet1->getCellByColumnAndRow(8, $row1)->getValue() : '';
          $warranty=$objWorksheet1->getCellByColumnAndRow(9, $row1)->getValue() ? $objWorksheet1->getCellByColumnAndRow(9, $row1)->getValue() : '';
          $date_installed=$objWorksheet1->getCellByColumnAndRow(10, $row1)->getValue() ? $objWorksheet1->getCellByColumnAndRow(10, $row1)->getValue() : '';
          $state=$objWorksheet1->getCellByColumnAndRow(11, $row1)->getValue() ? $objWorksheet1->getCellByColumnAndRow(11, $row1)->getValue() : '';
          $city=$objWorksheet1->getCellByColumnAndRow(12, $row1)->getValue() ? $objWorksheet1->getCellByColumnAndRow(12, $row1)->getValue() : '';
          $lg=$objWorksheet1->getCellByColumnAndRow(13, $row1)->getValue() ? $objWorksheet1->getCellByColumnAndRow(13, $row1)->getValue() : '';*/
          /*echo $category."".$asset_type."".$asset_name."".$model."".$serial."".$spec."".$po_number."".$vendor."".$purchase_date."".$warranty."".$date_installed."".$state."".$city."".$lg ;*/
          //format date
          /*$purchase_date = PHPExcel_Style_NumberFormat::toFormattedString($purchase_date,'YYYY-MM-DD' );
          $date_installed = PHPExcel_Style_NumberFormat::toFormattedString($date_installed,'YYYY-MM-DD' );*/
          
          //validate mandatory fields
          if(!empty($oracle_no) && !empty($name) && !empty($expected_monthly_repayment_amount) )
          {

              //validate duplicacy
       $result3 = mysql_query("SELECT * from expected_repayment where oracle_number='$oracle_no' and expected_monthly_repayment_month='$repayment_month' and expected_monthly_repayment_year='$repayment_year' and microfinance_bank='$mfb'");
              if(mysql_num_rows($result3)>0)
              {
				  
				  //Store the duplicates
				  /*$data_dup = array(
				  'oracle_number'=>$oracle_no,
				  'month'=>$repayment_month,
				  'year'=>$repayment_year,
				  'bank'=>$mfb,
				  'sheet'=>'expected'
				  );
				  $this->db->insert('duplicates',$data_dup);*/
				  
				  //delete the duplicates
				  /*$sql = "delete from expected_repayment where oracle_number='$oracle_no' and expected_monthly_repayment_month='$repayment_month' and expected_monthly_repayment_year='$repayment_year' and microfinance_bank='$mfb'";
				  $this->db->query($sql);*/
				  
                  echo '<center><strong>Error!</strong><span class="text-danger">record already exist for this customer ('.$oracle_no.') with the same oracle_no, month and year </span></center>';
                  $error_report=1 ;
              }
              else
              {
				$repayment_frequency = str_replace(",","",$repayment_frequency);
				$loan_amount = str_replace(",","",$loan_amount);

              
              $data = array(
              'name' => $name,
              'oracle_number' => $oracle_no,
			  'ministry' => $ministry,
              'loan_amount' => $loan_amount,
              'expected_monthly_repayment_amount' => $expected_monthly_repayment_amount,
              'expected_monthly_repayment_month' => $repayment_month,
              'expected_monthly_repayment_year' => $repayment_year,
              'microfinance_bank' => $mfb,
              'third_party_company' => $third_party,
              'loan_tenure' => $tenure,
              'repayment_frequency' => $repayment_frequency,
              'total_expected' => 'N',
              'percentage_from_total' => 'N',
              'sum_in_sheet' => 'N',
              'status' => 'NOT MERGED',
              'date_entered' => date('Y-m-d'),
              'last_modified' => date('Y-m-d'),
              'action_type' => 'insert',
              'action_user' => $this->session->userdata('uname')
			  //'flag' =>'1'
              );
              $this->db->insert('expected_repayment', $data);
              $id_ = $this->db->insert_id();
              $num_inserts = $this->db->affected_rows();
              if($num_inserts=="1")
              {
				  //compute total expected
				  $sum = 0 ;
				  $sql = "select * from expected_repayment where oracle_number = '$oracle_no' and expected_monthly_repayment_month='$repayment_month' and expected_monthly_repayment_year='$repayment_year'";
				  $query = $this->db->query($sql);
				  if( $query->num_rows() > 0 )
				  {
					  foreach ($query->result() as $value)
					  {
						 $expected_repayment = $value->expected_monthly_repayment_amount ;
						 $sum = $sum + $value->expected_monthly_repayment_amount ;
						 
					  }
					  
					  //update with total expected
					  $sql = "update expected_repayment set total_expected = '$sum' where oracle_number='$oracle_no' and expected_monthly_repayment_month='$repayment_month' and expected_monthly_repayment_year='$repayment_year'";
					  $this->db->query($sql);
					  
					  //compute percentage_from_total
					  $sql_ = "select * from expected_repayment where oracle_number = '$oracle_no' and expected_monthly_repayment_month='$repayment_month' and expected_monthly_repayment_year='$repayment_year'";
					  $query_ = $this->db->query($sql_);
					  foreach ($query_->result() as $value_)
					  {
						 $id = $value_->eid ;
					
						 $expected_repayment = $value_->expected_monthly_repayment_amount ;
						 $percentage_from_total = ($expected_repayment/$sum) * 100 ;
						 
						 $sql = "update expected_repayment set percentage_from_total='$percentage_from_total' where eid = '$id' ";
						 $this->db->query($sql);
						 
					  }
					  
				  }else{ echo "No record for oracle_no ".$oracle_no." for month ".$repayment_month." and year ".$repayment_year ; }
				  
                  echo '<center><strong>Sucess!</strong><span class="text-success"> Customer '.$oracle_o.' Successfully added</span></center>';
                  //$this->load->model('qlip_model');
                  //$this->qlip_model->audit_trigger($id_);
              }

              }//end duplicacy validation
          }//end fields validation if
          else
          {
              echo $oracle_no.'<center><strong>Error!</strong><span class="text-danger">ORACLE NO , NAME,  LOAN AMOUNT,  EXPECTED_MONTHLY_REPAYMENT are mandatory</span></center>';
              $error_report=1 ;
          }
    }//end for
    if($error_report==1)
    {
       echo '<a href="'.site_url().'/main/upload_expected_view/'.$unames.'" class="btn btn-primary">Return to repayment entry page</a>';
    }
    else
    {
        echo '<a href="'.site_url().'/main/upload_expected_view/'.$unames.'" class="btn btn-primary">Return to repayment entry page</a>';
    }
}

	function view_expected_record()
	{
		$this->load->model('main_model');
		$data['data'] = $this->main_model->get_expected_record();
		$data['title'] = 'Expected Repayment';
		$this->load->view('header/header',$data);
		$this->load->view('content/view_expected_record',$data);
		$this->load->view('footer/footer');
	}
	
	function view_merged_result()
	{
		$this->load->model('main_model');
		$data['data'] = $this->main_model->get_merged_result();
		$data['title'] = 'Merged Result';
		$this->load->view('header/header',$data);
		$this->load->view('content/view_merged_result',$data);
		$this->load->view('footer/footer');
	}

        function view_outstanding()
	{
		$this->load->model('main_model');
		$data['data'] = $this->main_model->get_outstanding();
		$data['title'] = 'Outstanding(s)';
		$this->load->view('header/header',$data);
		$this->load->view('content/view_outstanding',$data);
		$this->load->view('footer/footer');
	}
	
	function search($table,$view)
	{
		$this->load->model('main_model');
		
		$btn_search = $this->input->post('btn_search');
		
		/**Passed to view,to keep selected value after page refresh**/
		$data['bank'] = $this->input->post('bank');
		$data['month'] = $this->input->post('month');
		$data['year'] = $this->input->post('year');
		$data['keyword'] = $this->input->post('keyword');
		
		if($btn_search == "Search")
		{
			$data['data'] = $this->main_model->search($table);
			$data['title'] = 'Records';
			$this->load->view('header/header',$data);
			$this->load->view('content/'.$view,$data);
			$this->load->view('footer/footer');
		}
		else if($btn_search == "Spool")
		{
			$this->file_path = realpath(APPPATH . '../asset/csv');
           //$this->load->model('csv_m');
           $this->load->dbutil();
           $this->load->helper('file');
           //get the object
           
           $report=$this->main_model->spool($table);

           //generate the csv report
            $delimiter = ",";
            $newline = "\r\n";
            $new_report = $this->dbutil->csv_from_result($report, $delimiter, $newline);
            // write file
            write_file($this->file_path . '/csv_file.csv', $new_report);
            //force download from server
            $this->load->helper('download');
            $data = file_get_contents($this->file_path . '/csv_file.csv');
            $name = 'name-'.date('d-m-Y').'.csv';
            force_download($name, $data);
		}
		
	}
	
	function search_cumm($table,$view)
	{
		$this->load->model('main_model');
		
		$btn_search = $this->input->post('btn_search');
		
		/**Passed to view,to keep selected value after page refresh**/
		$data['bank'] = $this->input->post('bank');
		$data['month'] = $this->input->post('month');
		$data['year'] = $this->input->post('year');
		$data['keyword'] = $this->input->post('keyword');
		
		if($btn_search == "Search")
		{
			$data['data'] = $this->main_model->search($table);
			$data['title'] = 'Records';
			$this->load->view('header/header',$data);
			$this->load->view('content/'.$view,$data);
			$this->load->view('footer/footer');
		}
		else if($btn_search == "Spool")
		{
			$this->file_path = realpath(APPPATH . '../asset/csv');
           //$this->load->model('csv_m');
           $this->load->dbutil();
           $this->load->helper('file');
           //get the object
           
           $report=$this->main_model->spool($table);

           //generate the csv report
            $delimiter = ",";
            $newline = "\r\n";
            $new_report = $this->dbutil->csv_from_result($report, $delimiter, $newline);
            // write file
            write_file($this->file_path . '/csv_file.csv', $new_report);
            //force download from server
            $this->load->helper('download');
            $data = file_get_contents($this->file_path . '/csv_file.csv');
            $name = 'name-'.date('d-m-Y').'.csv';
            force_download($name, $data);
		}
		
	}
	
	function upload_actual_view()
	{
		$data['title'] = 'Upload Actual';
		$this->load->view('header/header',$data);
		$this->load->view('content/upload_actual_view');
		$this->load->view('footer/footer');
	}
	
	function view_cummulative_report()
	{
		$this->load->model('main_model');
		$data['data'] = $this->main_model->get_cummulative_report();
		$data['title'] = 'Cummulative Report';
		$this->load->view('header/header',$data);
		$this->load->view('content/view_cummulative_report_',$data);
		$this->load->view('footer/footer');
	}
	
	function view_duplicates()
	{
		$this->load->model('main_model');
		$data['data'] = $this->main_model->get_duplicates();
		$data['title'] = 'Duplicates';
		$this->load->view('header/header',$data);
		$this->load->view('content/view_duplicates',$data);
		$this->load->view('footer/footer');
	}

	
	function insert_actual_upload()
   {
    
    $uname = $this->session->userdata('uname');
	$this->form_validation->set_rules('repayment_year', 'Repayment year', 'required');
	$this->form_validation->set_rules('repayment_month', 'repayment Month', 'required');
	$this->form_validation->set_rules('flag_', 'Document', 'required');
   if (empty($_FILES['myuploadFile']['name']))
    {
        $this->form_validation->set_rules('myuploadFile', 'Document', 'required');
    }

    if ($this->form_validation->run() === FALSE)
    {
		$data['title'] = 'Upload Actual';
		$this->load->view('header/header',$data);
		$this->load->view('content/upload_actual_view');
		$this->load->view('footer/footer');
      
    }
    else
    {
        $storeFolder = './uploads/';
        if (!empty($_FILES)) 
        { 
          $tempFile = $_FILES['myuploadFile']['tmp_name'];            
          $targetPath =$storeFolder;
          $temp = explode(".", $_FILES["myuploadFile"]["name"]);
          $newfilename = time().$_FILES["myuploadFile"]["name"];
          $targetFile =  $targetPath. $newfilename;  
          move_uploaded_file($tempFile,$targetFile); 
          $path=$file_name='uploads/'.$newfilename;

          $this->insert_from_uploaded_actual($path);
        }

    }

 }
 
 function insert_from_uploaded_actual($path)
 {

     $this->load->library('PHPExcel/Classes/PHPExcel');
     $inputFileType = PHPExcel_IOFactory::identify($path);
     $objReader1     = PHPExcel_IOFactory::createReader($inputFileType);
     $objPHPExcel1   = $objReader1->load($path);
     $sheetList      = $objReader1->listWorksheetNames($path); 
     foreach ($sheetList as $sheetName)
     {
        $currentObjectName  = $objPHPExcel1->setActiveSheetIndexByName($sheetName);
        $result=$this->insertintodb_uploaded_actual($currentObjectName);
     }
  }
  
  function insertintodb_uploaded_actual($objWorksheet1)
  { 

    error_reporting(E_ERROR|E_WARNING);
	ini_set('memory_limit','512M');
	ini_set('max_execution_time', 1000); //300 seconds = 5 minutes

    $unames = $this->session->userdata('uname');

    $entry_date=date('Y-m-d');
    $this->load->library('form_validation');
    $highestRow1 = $objWorksheet1->getHighestRow(); // e.g. 10
    $row1=1; // row in which customers description starts in a work sheet
    $row_start= $row1+1;
    
    //design error page ;
    echo '<html>';
    echo '<head>';
    echo '<title>Result</title>';
    echo '<head>';
    echo '<link href="'.base_url().'asset/css/bootstrap.min.css" rel="stylesheet">';
    //echo '<link href="'.base_url().'asset/css/style.css" rel="stylesheet">';
    echo '<link href="'.base_url().'asset/js/bootstrap.min.js"></script>';
    echo '<link href="'.base_url().'asset/js/jquery-1.8.3.min.js"></script>';
    echo '</head>';

    echo '<body>';

    echo '<p><div class="container">';
    echo '<div class="panel panel-primary">';
    echo '<div class="panel-heading">File Upload Report(s)</div>';
    echo '<div class="panel-body">';

    for ($row_start; $row_start <= $highestRow1; $row_start++) //$highestRow
    {
          $row1=$row_start;
          $oracle_no=$objWorksheet1->getCellByColumnAndRow(0, $row1)->getValue()?$objWorksheet1->getCellByColumnAndRow(0, $row1)->getValue():'';
          $name=$objWorksheet1->getCellByColumnAndRow(1, $row1)->getValue()?$objWorksheet1->getCellByColumnAndRow(1, $row1)->getValue():'';
		  //$ministry=$objWorksheet1->getCellByColumnAndRow(2, $row1)->getValue()? $objWorksheet1->getCellByColumnAndRow(2, $row1)->getValue():'';
          $actual_repayment_amount=$objWorksheet1->getCellByColumnAndRow(2, $row1)->getValue()? $objWorksheet1->getCellByColumnAndRow(2, $row1)->getValue():'';
          /*$expected_monthly_repayment_amount=$objWorksheet1->getCellByColumnAndRow(3, $row1)->getValue()? $objWorksheet1->getCellByColumnAndRow(4, $row1)->getValue():'';
          $tenure=$objWorksheet1->getCellByColumnAndRow(4, $row1)->getValue() ? $objWorksheet1->getCellByColumnAndRow(5, $row1)->getValue() : ''; 
          $repayment_frequency=$objWorksheet1->getCellByColumnAndRow(5, $row1)->getValue() ? $objWorksheet1->getCellByColumnAndRow(6, $row1)->getValue() : '';*/
         
           $ministry="NA";
		  
		  /*$mfb = $this->input->post('mfb');
		  $third_party = $this->input->post('third_party');*/
		  $repayment_month = $this->input->post('repayment_month');
		  $repayment_year = $this->input->post('repayment_year');
		  
          /*$po_number=$objWorksheet1->getCellByColumnAndRow(6, $row1)->getValue() ? $objWorksheet1->getCellByColumnAndRow(6, $row1)->getValue() : '';
          $vendor=$objWorksheet1->getCellByColumnAndRow(7, $row1)->getValue() ? $objWorksheet1->getCellByColumnAndRow(7, $row1)->getValue() : '';
          $purchase_date=$objWorksheet1->getCellByColumnAndRow(8, $row1)->getValue() ? $objWorksheet1->getCellByColumnAndRow(8, $row1)->getValue() : '';
          $warranty=$objWorksheet1->getCellByColumnAndRow(9, $row1)->getValue() ? $objWorksheet1->getCellByColumnAndRow(9, $row1)->getValue() : '';
          $date_installed=$objWorksheet1->getCellByColumnAndRow(10, $row1)->getValue() ? $objWorksheet1->getCellByColumnAndRow(10, $row1)->getValue() : '';
          $state=$objWorksheet1->getCellByColumnAndRow(11, $row1)->getValue() ? $objWorksheet1->getCellByColumnAndRow(11, $row1)->getValue() : '';
          $city=$objWorksheet1->getCellByColumnAndRow(12, $row1)->getValue() ? $objWorksheet1->getCellByColumnAndRow(12, $row1)->getValue() : '';
          $lg=$objWorksheet1->getCellByColumnAndRow(13, $row1)->getValue() ? $objWorksheet1->getCellByColumnAndRow(13, $row1)->getValue() : '';*/
          /*echo $category."".$asset_type."".$asset_name."".$model."".$serial."".$spec."".$po_number."".$vendor."".$purchase_date."".$warranty."".$date_installed."".$state."".$city."".$lg ;*/
          //format date
          /*$purchase_date = PHPExcel_Style_NumberFormat::toFormattedString($purchase_date,'YYYY-MM-DD' );
          $date_installed = PHPExcel_Style_NumberFormat::toFormattedString($date_installed,'YYYY-MM-DD' );*/
		  
		  //Remove commas from actual repayment amount
		  $actual_repayment_amount = str_replace(",","",$actual_repayment_amount);
          
          //validate mandatory fields
          if(!empty($oracle_no) && !empty($name) && !empty($actual_repayment_amount) )
          {

              //validate duplicacy
       $result3 = mysql_query("SELECT * from actual_repayment where oracle_number='$oracle_no' and actual_monthly_repayment_month='$repayment_month' and actual_monthly_repayment_year='$repayment_year' ");
              if(mysql_num_rows($result3)>0)
              {
                  echo '<center><strong>Error!</strong><span class="text-danger">record already exist for this customer ('.$oracle_no.') with the same oracle_no, month and year </span></center>';
                  $error_report=1 ;
              }
              else
              {
				//$repayment_frequency = str_replace(",","",$repayment_frequency);
				$actual_repayment_amount = str_replace(",","",$actual_repayment_amount);

              
              $data = array(
              'name' => $name,
              'oracle_number' => $oracle_no,
			  'ministry' => $ministry,
              'actual_monthly_repayment_month' => $repayment_month,
              'actual_monthly_repayment_year' => $repayment_year,
			  'actual_repayment' => $actual_repayment_amount,
              'status' => 'NOT MERGED',
              'date_entered' => date('Y-m-d'),
              'last_modified' => date('Y-m-d'),
              'action_type' => 'insert',
              'action_user' => $this->session->userdata('uname')
              );
              $this->db->insert('actual_repayment', $data);
              $id_ = $this->db->insert_id();
              $num_inserts = $this->db->affected_rows();
              if($num_inserts=="1")
              {
			
                  echo '<center><strong>Sucess!</strong><span class="text-success"> Customer '.$oracle_o.' Successfully added</span></center>';
                  //$this->load->model('qlip_model');
                  //$this->qlip_model->audit_trigger($id_);
              }

              }//end duplicacy validation
          }//end fields validation if
          else
          {
              echo '<center><strong>Error!</strong><span class="text-danger">ORACLE NO , NAME,  LOAN AMOUNT,  EXPECTED_MONTHLY_REPAYMENT are mandatory'.$oracle_no.'</span></center>';
              $error_report=1 ;
          }
    }//end for
    if($error_report==1)
    {
       echo '<a href="'.site_url().'/main/upload_expected_view/'.$unames.'" class="btn btn-primary">Return to repayment entry page</a>';
    }
    else
    {
        echo '<a href="'.site_url().'/main/upload_expected_view/'.$unames.'" class="btn btn-primary">Return to repayment entry page</a>';
    }
}
  
  
	
	function view_actual_record()
	{
		$this->load->model('main_model');
		$data['actual'] = $this->main_model->get_actual_record();
		$data['title'] = 'Actual Repayment';
		$this->load->view('header/header',$data);
		$this->load->view('content/view_actual_record',$data);
		$this->load->view('footer/footer');
	}
	
	
	function merge()
	{
                error_reporting(E_ERROR|E_WARNING);
	       ini_set('memory_limit','512M');
	       ini_set('max_execution_time', 10000); //300 seconds = 5 minutes

		$error_report = 3 ;
		 //design error page ;
		echo '<html>';
		echo '<head>';
		echo '<title>Result</title>';
		echo '<head>';
		echo '<link href="'.base_url().'asset/css/bootstrap.min.css" rel="stylesheet">';
		//echo '<link href="'.base_url().'asset/css/style.css" rel="stylesheet">';
		echo '<link href="'.base_url().'asset/js/bootstrap.min.js"></script>';
		echo '<link href="'.base_url().'asset/js/jquery-1.8.3.min.js"></script>';
		echo '</head>';
	
		echo '<body>';
	
		echo '<p><div class="container">';
		echo '<div class="panel panel-primary">';
		echo '<div class="panel-heading">File Upload Report(s)</div>';
		echo '<div class="panel-body">';
		
		
		//get current config
		$config = "equal" ;
		
		$sql = "SELECT * FROM expected_repayment join actual_repayment on expected_repayment.oracle_number=actual_repayment.oracle_number and expected_repayment.expected_monthly_repayment_month=actual_repayment.actual_monthly_repayment_month and expected_repayment.expected_monthly_repayment_year=actual_repayment.actual_monthly_repayment_year and expected_repayment.status = actual_repayment.status where expected_repayment.status = 'NOT MERGED'";
		$query = $this->db->query($sql);
		foreach($query->result() as $key)
		{
			$name = $key->name ;
			$oracle_no = $key->oracle_number ;
			$ministry = $key->ministry ;
			$loan_amount = $key->loan_amount ;
			$expected_monthly_repayment_amount = $key->expected_monthly_repayment_amount ;
			$expected_monthly_repayment_month = $key->expected_monthly_repayment_month ;
			$expected_monthly_repayment_year = $key->expected_monthly_repayment_year ;
			$microfinance_bank = $key->microfinance_bank ;
			$third_party_company = $key->third_party_company ;
			$total_expected = $key->total_expected ;
			$percentage_from_total = $key->percentage_from_total ;
			$actual_repayment = $key->actual_repayment ;
			
			/*echo $name."/".$oracle_no."/".$ministry."/".$loan_amount."/".$expected_monthly_repayment_amount."/".$expected_monthly_repayment_month."/".$expected_monthly_repayment_year."/".$microfinance_bank."/".$third_party_company."/".$total_expected."/".$percentage_from_total."/".$actual_repayment."<br><br>";*/
			
			//compute the merge - subtractions
			if($config == "equal")
			{
				$percentage_equivalent = ($percentage_from_total/100) * $actual_repayment ;
				$balance = $expected_monthly_repayment_amount - $percentage_equivalent ;
				$balance = round($balance);
				if($balance < 0)
				{
					$amount_deducted = $expected_monthly_repayment_amount ;
					$remittance = $balance ;
					$outstanding = 0 ;
				}
				else if($balance > 0)
				{
					$amount_deducted = $percentage_equivalent ;
					$outstanding = $balance ;
					$remittance = 0 ;
				}
				else if($balance == 0)
				{
					$amount_deducted = $expected_monthly_repayment_amount ;
					$outstanding = 0 ;
					$remittance = 0;
				}
				 
				echo "oracle_no =".$oracle_no."<br>";
				echo "name =".$name."<br>";
				echo "expected_monthly_repayment_amount =".$expected_monthly_repayment_amount."<br>"; 
				echo "expected_monthly_repayment_month =".$expected_monthly_repayment_month."<br>"; 
				echo "expected_monthly_repayment_year =".$expected_monthly_repayment_year."<br>"; 
				echo "microfinance_bank =".$microfinance_bank."<br>"; 
				echo "total_expected =".$total_expected."<br>";
				echo "percentage_from_total =".$percentage_from_total."<br>";
				echo "actual_repayment =".$actual_repayment."<br>";
				echo "percentage_equivalent =".$percentage_equivalent."<br>";
				echo "balance =".$balance."<br><br><br>";
				
				$data = array(
				'oracle_number'=>$oracle_no,
				'name'=>$name,
				'ministry'=>$ministry,
				'loan_amount'=>$loan_amount,
				'expected_monthly_repayment_amount'=>$expected_monthly_repayment_amount,
				'expected_monthly_repayment_month'=>$expected_monthly_repayment_month,
				'expected_monthly_repayment_year'=>$expected_monthly_repayment_year,
				'microfinance_bank'=>$microfinance_bank,
				'third_party_company'=>$third_party_company,
				'total_expected'=>$total_expected,
				'percentage_from_total'=>$percentage_from_total,
				'actual_repayment'=>$actual_repayment,
				'percentage_equivalent'=>$percentage_equivalent,
				'amount_deducted'=>$amount_deducted,
				'outstanding'=>$outstanding,
				'remittance'=>$remittance,
				'config_type'=>'EQ',
				'date_merged'=>date('Y-m-d'),
				'action_type'=>'insert',
				'action_user'=>$this->session->userdata('uname')
				);
				//validate duplicacy
				$result3 = mysql_query("SELECT * from merged_result where oracle_number='$oracle_no' and expected_monthly_repayment_month='$expected_monthly_repayment_month' and expected_monthly_repayment_year='$expected_monthly_repayment_year' and microfinance_bank='$microfinance_bank'");
				if(mysql_num_rows($result3)>0)
				{
					echo '<center><strong>Error!</strong><span class="text-danger">Customer has already been merged ('.$oracle_no.') with the same oracle_no, month and year </span></center>';
					$error_report=1 ;
				}//end duplicacy if
				else
				{
				
				$this->main_model->insert_merged_result($data);
				$num_inserts = $this->db->affected_rows();
				if($num_inserts=="1")
				{
					//change status o expected_repayment table
					$sql = "update expected_repayment set status = 'MERGED' where oracle_number='$oracle_no' and expected_monthly_repayment_month='$expected_monthly_repayment_month' and expected_monthly_repayment_year='$expected_monthly_repayment_year' and microfinance_bank='$microfinance_bank'";
					$this->db->query($sql);
					
					//change status on actual_repayment table
					$sql = "update actual_repayment set status = 'MERGED' where oracle_number='$oracle_no' and actual_monthly_repayment_month='$expected_monthly_repayment_month' and actual_monthly_repayment_year='$expected_monthly_repayment_year'";
					$this->db->query($sql);
					
					//compute cummulative deduction,outstanding,remittance for each bank in a month
					$sql_c = "select * from cummulative_report where microfinance_bank='$microfinance_bank' and expected_monthly_repayment_month='$expected_monthly_repayment_month' and expected_monthly_repayment_year='$expected_monthly_repayment_year'";
					$query = $this->db->query($sql_c);
					$no_rows = $query->num_rows();
					if($no_rows>0)
					{
						$sql_c_ = "update cummulative_report set cumm_deduction = cumm_deduction +'$amount_deducted',cumm_outstanding = cumm_outstanding +'$outstanding',cumm_remittance = cumm_remittance +'$remittance' where microfinance_bank='$microfinance_bank' and expected_monthly_repayment_month='$expected_monthly_repayment_month' and expected_monthly_repayment_year='$expected_monthly_repayment_year'";
						$this->db->query($sql_c_);
					}
					else
					{
						$data_cumm =	array(
						'microfinance_bank'=>$microfinance_bank,
						'expected_monthly_repayment_month'=>$expected_monthly_repayment_month,
						'expected_monthly_repayment_year'=>$expected_monthly_repayment_year,
						'cumm_deduction'=>$amount_deducted,
						'cumm_outstanding'=>$outstanding,
						'cumm_remittance'=>$remittance,
						'date_merged'=>date('Y-m-d')
						);
						$this->db->insert('cummulative_report',$data_cumm);
					}
					
					echo '<center><strong>Sucess!</strong><span class="text-success"> Customer '.$name.'/'.$oracle_no.' loan from '.$microfinance_bank.'/'.$expected_monthly_repayment_month.'/'.$expected_monthly_repayment_year.'  Successfully merged</span></center>';
				}
				else
				{
					echo '<center><strong>Error!</strong><span class="text-danger">There is an issue Merging '.$name.'/'.$oracle_no.'</span></center>';
					$error_report=1 ;
				}
				
				}//end duplicacy else
			}
			else
			{
				echo "primera-first config style";
			}
			
		}
		
		if($error_report==1)
		{
			echo '<a href="'.site_url().'/main/view_actual_record/'.$unames.'" class="btn btn-primary">Retry Merging Record Again</a>';
		}
		if($error_report==3)
		{
			echo '<center><strong>Error!</strong><span class="text-danger">There is no record to Merged</span></center>';
			
			echo '<a href="'.site_url().'/main/view_merged_result/'.$unames.'" class="btn btn-primary">View Merged Record(s)</a>';
		}
		else
		{
			echo '<a href="'.site_url().'/main/view_merged_result/'.$unames.'" class="btn btn-primary">View Merged Record(s)</a>';
		}
			
		
		
	}
	
	function logout()
	{
		$this->session->unset_userdata('userid');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('name');
		$this->session->unset_userdata('role');
		$this->session->unset_userdata('company');
		
		redirect(site_url('user_login'));
	}
	
	function test_get()
	{
	
		$you_url = "http://localhost/ci/index.php/api/book/3?X-API-KEY=12345"; //fetches multiple row record

		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_PORT => "80",
		CURLOPT_URL => $you_url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
		"cache-control: no-cache"
			),
		));

		$response = curl_exec($curl);
		//$err = curl_error($curl);
		$json_results = json_decode($response,true);

		if(!empty($json_results['error']))
		{
			echo $json_results['error'] ;
	
		}
		else
		{
			if($json_results['status']=="failure")
			{
				echo $json_results['message'] ;
			}
			else
			{
				foreach($json_results['message'] as $value=>$key)
				{
					echo $key['uri']." ".$key['method']." ".$key['params']." ".$key['api_key']."<br>" ;
				}
			}
	
		}


                       

	}
	
	function test_post()
	{
		$name="musideen";
		$address="30 abeje street";
		$request="X-API-KEY=12345&name=".$name."&address=".$address;
		
		//echo $request ;
		$data = array("name" => "$name", "address" => "$address","X-API-KEY"=>"12345");
$data_string = json_encode($data);
		
		$you_url = "http://localhost:80/ci/index.php/api/book/"; //fetches multiple row record
		
		/*$ch = curl_init(); //initialize curl handle
					curl_setopt($ch, CURLOPT_URL, $you_url); //set the url www.thinkfirstsms.com
					//curl_setopt($ch, CURLOPT_PORT,80);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); //return as a variable
					curl_setopt($ch, CURLOPT_POST, 1); //set POST method
					//curl_setopt($ch, CURLOPT_POSTFIELDS, $request); //set the POST variables
					$response = curl_exec($ch); //run the whole process and return the response
					curl_close($ch); //close the curl handle
					
					echo $response ;*/
					
					$ch = curl_init('http://localhost:80/ci/index.php/api/book');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string))
);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

//execute post
$result = curl_exec($ch);

//close connection
curl_close($ch);

echo $result ;

	}
	
	


}

?>
