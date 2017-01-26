<?php

class Main_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//$this->load->database();
	}
	
	function insert_user()
	{
			$fullname = $this->input->post('fullname');
			$email = $this->input->post('email');
			$company = $this->input->post('company');
			$role = $this->input->post('role');
			$username = $this->input->post('username');
			$password1 = $this->input->post('password1');
			$password2 = $this->input->post('password2');
			$status = $this->input->post('status');
			$date_created = date('Y-m-d');
			$action_type='insert';
			$action_user = $this->session->userdata('uname');
			$encrypted_password = $this->encrypt->encode($password1);
			return $this->db->query("INSERT INTO users (name, email, company, role, username, password,status,date_created,last_modified,action_type,action_user) VALUES ('$fullname', '$email', '$company', '$role', '$username', '$encrypted_password','$status','$date_created','$date_created','$action_type','$action_user')");
	}
	
	function get_all_users()
	{
		$sql = "select * from users";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_expected_record()
	{
		$sql = "select * from expected_repayment order by eid desc limit 500";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_actual_record()
	{
		$sql = "select name,oracle_number,actual_monthly_repayment_month,actual_monthly_repayment_year,actual_repayment,status,date_entered from actual_repayment where status='NOT MERGED'";
		/*$sql = "select name,oracle_number,actual_monthly_repayment_month,actual_monthly_repayment_year,actual_repayment,status,date_entered from actual_repayment order by aid desc limit 500";*/
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_merged_result()
	{
		$sql = "select * from merged_result order by id desc limit 500";
		$query = $this->db->query($sql);
		return $query->result();
	}
    
	function get_outstanding()
	{
		$sql = "select * from merged_result where outstanding > 0";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function get_duplicates()
	{
		$sql = "select * from duplicates";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function search($table)
	{
		$bank = $this->input->post('bank');
		$month = $this->input->post('month');
		$year = $this->input->post('year');
		$keyword = $this->input->post('keyword');
		
		if($bank=="all" && $month=="all" && $year=="all" && empty($keyword))
		{
			$sql = "select * from ".$table."";
		}
		if($bank=="all" && $month=="all" && $year=="all" && !empty($keyword))
		{
			$sql = "select * from ".$table." where (oracle_number = '$keyword' or name like '%$keyword%' or  status like '%$keyword%' )";
		}
		/**others set to value,single set to all**/
		else if($bank=="all" && $month!="all" && $year!="all" && empty($keyword))
		{
			$sql = "select * from ".$table." where expected_monthly_repayment_month='$month' and expected_monthly_repayment_year='$year'";
		}
		else if($bank=="all" && $month!="all" && $year!="all" && !empty($keyword))
		{
			$sql = "select * from ".$table." where expected_monthly_repayment_month='$month' and expected_monthly_repayment_year='$year' and (oracle_number = '$keyword' or name like '%$keyword%' or  status like '%$keyword%' )";
		}
		else if($bank!="all" && $month=="all" && $year!="all" && empty($keyword))
		{
			$sql = "select * from ".$table." where microfinance_bank='$bank' and expected_monthly_repayment_year='$year'";
		}
		else if($bank!="all" && $month=="all" && $year!="all" && !empty($keyword))
		{
			$sql = "select * from ".$table." where microfinance_bank='$bank' and expected_monthly_repayment_year='$year' and (oracle_number = '$keyword' or name like '%$keyword%' or  status like '%$keyword%' )";
		}
		else if($bank!="all" && $month!="all" && $year=="all" && empty($keyword))
		{
			$sql = "select * from ".$table." where microfinance_bank='$bank' and expected_monthly_repayment_month='$month'";
		}
		else if($bank!="all" && $month!="all" && $year=="all" && !empty($keyword))
		{
			$sql = "select * from ".$table." where microfinance_bank='$bank' and expected_monthly_repayment_month='$month' and (oracle_number = '$keyword' or name like '%$keyword%' or  status like '%$keyword%' )";
		}
		else if($bank!="all" && $month!="all" && $year!="all" && empty($keyword))
		{
			$sql = "select * from ".$table." where microfinance_bank='$bank' and expected_monthly_repayment_month='$month' and expected_monthly_repayment_year='$year'";
		}
		else if($bank!="all" && $month!="all" && $year!="all" && !empty($keyword))
		{
			$sql = "select * from ".$table." where microfinance_bank='$bank' and expected_monthly_repayment_month='$month' and expected_monthly_repayment_year='$year' and (oracle_number = '$keyword' or name like '%$keyword%' or  status like '%$keyword%' )";
		}
		/**Single set to value,others set to all**/
		else if($bank!="all" && $month=="all" && $year=="all" && empty($keyword))
		{
			$sql = "select * from ".$table." where microfinance_bank='$bank'";
		}
		else if($bank!="all" && $month=="all" && $year=="all" && !empty($keyword))
		{
			$sql = "select * from ".$table." where microfinance_bank='$bank' and (oracle_number = '$keyword' or name like '%$keyword%' or  status like '%$keyword%' )";
		}
		else if($bank=="all" && $month!="all" && $year=="all" && empty($keyword))
		{
			$sql = "select * from ".$table." where expected_monthly_repayment_month='$month'";
		}
		else if($bank=="all" && $month!="all" && $year=="all" && !empty($keyword))
		{
			$sql = "select * from ".$table." where expected_monthly_repayment_month='$month' and (oracle_number = '$keyword' or name like '%$keyword%' or  status like '%$keyword%' )";
		}
		else if($bank=="all" && $month=="all" && $year!="all" && empty($keyword))
		{
			$sql = "select * from ".$table." where expected_monthly_repayment_year='$year'";
		}
		else if($bank=="all" && $month=="all" && $year!="all" && !empty($keyword))
		{
			$sql = "select * from ".$table." where expected_monthly_repayment_year='$year' and (oracle_number = '$keyword' or name like '%$keyword%' or  status like '%$keyword%' )";
		}
		
		$query = $this->db->query($sql);
		return $query->result();
			
	}
	
	function search_cumm($table)
	{
		$bank = $this->input->post('bank');
		$month = $this->input->post('month');
		$year = $this->input->post('year');
		$keyword = $this->input->post('keyword');
		
		if($bank=="all" && $month=="all" && $year=="all" && empty($keyword))
		{
			$sql = "select distinct microfinance_bank,expected_monthly_repayment_month,expected_monthly_repayment_year from ".$table."";
		}
		if($bank=="all" && $month=="all" && $year=="all" && !empty($keyword))
		{
			$sql = "select distinct microfinance_bank,expected_monthly_repayment_month,expected_monthly_repayment_year from ".$table." where (oracle_number = '$keyword' or name like '%$keyword%' or  status like '%$keyword%' )";
		}
		/**others set to value,single set to all**/
		else if($bank=="all" && $month!="all" && $year!="all" && empty($keyword))
		{
			$sql = "select distinct microfinance_bank,expected_monthly_repayment_month,expected_monthly_repayment_year from ".$table." where expected_monthly_repayment_month='$month' and expected_monthly_repayment_year='$year'";
		}
		else if($bank=="all" && $month!="all" && $year!="all" && !empty($keyword))
		{
			$sql = "select distinct microfinance_bank,expected_monthly_repayment_month,expected_monthly_repayment_year from ".$table." where expected_monthly_repayment_month='$month' and expected_monthly_repayment_year='$year' and (oracle_number = '$keyword' or name like '%$keyword%' or  status like '%$keyword%' )";
		}
		else if($bank!="all" && $month=="all" && $year!="all" && empty($keyword))
		{
			$sql = "select distinct microfinance_bank,expected_monthly_repayment_month,expected_monthly_repayment_year from ".$table." where microfinance_bank='$bank' and expected_monthly_repayment_year='$year'";
		}
		else if($bank!="all" && $month=="all" && $year!="all" && !empty($keyword))
		{
			$sql = "select distinct microfinance_bank,expected_monthly_repayment_month,expected_monthly_repayment_year from ".$table." where microfinance_bank='$bank' and expected_monthly_repayment_year='$year' and (oracle_number = '$keyword' or name like '%$keyword%' or  status like '%$keyword%' )";
		}
		else if($bank!="all" && $month!="all" && $year=="all" && empty($keyword))
		{
			$sql = "select distinct microfinance_bank,expected_monthly_repayment_month,expected_monthly_repayment_year from ".$table." where microfinance_bank='$bank' and expected_monthly_repayment_month='$month'";
		}
		else if($bank!="all" && $month!="all" && $year=="all" && !empty($keyword))
		{
			$sql = "select distinct microfinance_bank,expected_monthly_repayment_month,expected_monthly_repayment_year from ".$table." where microfinance_bank='$bank' and expected_monthly_repayment_month='$month' and (oracle_number = '$keyword' or name like '%$keyword%' or  status like '%$keyword%' )";
		}
		else if($bank!="all" && $month!="all" && $year!="all" && empty($keyword))
		{
			$sql = "select distinct microfinance_bank,expected_monthly_repayment_month,expected_monthly_repayment_year from ".$table." where microfinance_bank='$bank' and expected_monthly_repayment_month='$month' and expected_monthly_repayment_year='$year'";
		}
		else if($bank!="all" && $month!="all" && $year!="all" && !empty($keyword))
		{
			$sql = "select distinct microfinance_bank,expected_monthly_repayment_month,expected_monthly_repayment_year from ".$table." where microfinance_bank='$bank' and expected_monthly_repayment_month='$month' and expected_monthly_repayment_year='$year' and (oracle_number = '$keyword' or name like '%$keyword%' or  status like '%$keyword%' )";
		}
		/**Single set to value,others set to all**/
		else if($bank!="all" && $month=="all" && $year=="all" && empty($keyword))
		{
			$sql = "select distinct microfinance_bank,expected_monthly_repayment_month,expected_monthly_repayment_year from ".$table." where microfinance_bank='$bank'";
		}
		else if($bank!="all" && $month=="all" && $year=="all" && !empty($keyword))
		{
			$sql = "select distinct microfinance_bank,expected_monthly_repayment_month,expected_monthly_repayment_year from ".$table." where microfinance_bank='$bank' and (oracle_number = '$keyword' or name like '%$keyword%' or  status like '%$keyword%' )";
		}
		else if($bank=="all" && $month!="all" && $year=="all" && empty($keyword))
		{
			$sql = "select distinct microfinance_bank,expected_monthly_repayment_month,expected_monthly_repayment_year from ".$table." where expected_monthly_repayment_month='$month'";
		}
		else if($bank=="all" && $month!="all" && $year=="all" && !empty($keyword))
		{
			$sql = "select distinct microfinance_bank,expected_monthly_repayment_month,expected_monthly_repayment_year from ".$table." where expected_monthly_repayment_month='$month' and (oracle_number = '$keyword' or name like '%$keyword%' or  status like '%$keyword%' )";
		}
		else if($bank=="all" && $month=="all" && $year!="all" && empty($keyword))
		{
			$sql = "select distinct microfinance_bank,expected_monthly_repayment_month,expected_monthly_repayment_year from ".$table." where expected_monthly_repayment_year='$year'";
		}
		else if($bank=="all" && $month=="all" && $year!="all" && !empty($keyword))
		{
			$sql = "select distinct microfinance_bank,expected_monthly_repayment_month,expected_monthly_repayment_year from ".$table." where expected_monthly_repayment_year='$year' and (oracle_number = '$keyword' or name like '%$keyword%' or  status like '%$keyword%' )";
		}
		
		$query = $this->db->query($sql);
		return $query->result();
			
	}
	
	function spool($table)
	{
		$bank = $this->input->post('bank');
		$month = $this->input->post('month');
		$year = $this->input->post('year');
		$keyword = $this->input->post('keyword');
		
		if($bank=="all" && $month=="all" && $year=="all" && empty($keyword))
		{
			$sql = "select * from ".$table."";
		}
		if($bank=="all" && $month=="all" && $year=="all" && !empty($keyword))
		{
			$sql = "select * from ".$table." where (oracle_number = '$keyword' or name like '%$keyword%' or  status like '%$keyword%' )";
		}
		/**others set to value,single set to all**/
		else if($bank=="all" && $month!="all" && $year!="all" && empty($keyword))
		{
			$sql = "select * from ".$table." where expected_monthly_repayment_month='$month' and expected_monthly_repayment_year='$year'";
		}
		else if($bank=="all" && $month!="all" && $year!="all" && !empty($keyword))
		{
			$sql = "select * from ".$table." where expected_monthly_repayment_month='$month' and expected_monthly_repayment_year='$year' and (oracle_number = '$keyword' or name like '%$keyword%' or  status like '%$keyword%' )";
		}
		else if($bank!="all" && $month=="all" && $year!="all" && empty($keyword))
		{
			$sql = "select * from ".$table." where microfinance_bank='$bank' and expected_monthly_repayment_year='$year'";
		}
		else if($bank!="all" && $month=="all" && $year!="all" && !empty($keyword))
		{
			$sql = "select * from ".$table." where microfinance_bank='$bank' and expected_monthly_repayment_year='$year' and (oracle_number = '$keyword' or name like '%$keyword%' or  status like '%$keyword%' )";
		}
		else if($bank!="all" && $month!="all" && $year=="all" && empty($keyword))
		{
			$sql = "select * from ".$table." where microfinance_bank='$bank' and expected_monthly_repayment_month='$month'";
		}
		else if($bank!="all" && $month!="all" && $year=="all" && !empty($keyword))
		{
			$sql = "select * from ".$table." where microfinance_bank='$bank' and expected_monthly_repayment_month='$month' and (oracle_number = '$keyword' or name like '%$keyword%' or  status like '%$keyword%' )";
		}
		else if($bank!="all" && $month!="all" && $year!="all" && empty($keyword))
		{
			$sql = "select * from ".$table." where microfinance_bank='$bank' and expected_monthly_repayment_month='$month' and expected_monthly_repayment_year='$year'";
		}
		else if($bank!="all" && $month!="all" && $year!="all" && !empty($keyword))
		{
			$sql = "select * from ".$table." where microfinance_bank='$bank' and expected_monthly_repayment_month='$month' and expected_monthly_repayment_year='$year' and (oracle_number = '$keyword' or name like '%$keyword%' or  status like '%$keyword%' )";
		}
		/**Single set to value,others set to all**/
		else if($bank!="all" && $month=="all" && $year=="all" && empty($keyword))
		{
			$sql = "select * from ".$table." where microfinance_bank='$bank'";
		}
		else if($bank!="all" && $month=="all" && $year=="all" && !empty($keyword))
		{
			$sql = "select * from ".$table." where microfinance_bank='$bank' and (oracle_number = '$keyword' or name like '%$keyword%' or  status like '%$keyword%' )";
		}
		else if($bank=="all" && $month!="all" && $year=="all" && empty($keyword))
		{
			$sql = "select * from ".$table." where expected_monthly_repayment_month='$month'";
		}
		else if($bank=="all" && $month!="all" && $year=="all" && !empty($keyword))
		{
			$sql = "select * from ".$table." where expected_monthly_repayment_month='$month' and (oracle_number = '$keyword' or name like '%$keyword%' or  status like '%$keyword%' )";
		}
		else if($bank=="all" && $month=="all" && $year!="all" && empty($keyword))
		{
			$sql = "select * from ".$table." where expected_monthly_repayment_year='$year'";
		}
		else if($bank=="all" && $month=="all" && $year!="all" && !empty($keyword))
		{
			$sql = "select * from ".$table." where expected_monthly_repayment_year='$year' and (oracle_number = '$keyword' or name like '%$keyword%' or  status like '%$keyword%' )";
		}
		
		$query = $this->db->query($sql);
		return $query;
			
	}
	
	
	
	/**function get_cummulative_report()
	{
		$sql = "select * from cummulative_report";
		$query = $this->db->query($sql);
		return $query->result();
	}**/
	
	function get_cummulative_report()
	{
		$sql = "select distinct microfinance_bank,expected_monthly_repayment_month,expected_monthly_repayment_year from merged_result;";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_user($id)
	{
		$query = $this->db->query("SELECT * FROM users WHERE id='$id'");
		$result = $query->result();
		return $result;
	}
	
	function update_user($id)
	{
		$current_user = $this->session->userdata('uname');
		$fullname = $this->input->post('fullname');
		$email = $this->input->post('email');
		$company = $this->input->post('company');
		$role = $this->input->post('role');
		$status = $this->input->post('status');
		$username = $this->input->post('username');
		$password1 = $this->input->post('password1');
		$password2 = $this->input->post('password2');
		$encrypted_password = $this->encrypt->encode($password1);
		
		$date = date('Y-m-d') ;
		$this->db->query("UPDATE users SET name='$fullname', email='$email', company='$company', role='$role', username='$username', status='$status', action_type='update', action_user='$current_user', last_modified='$date' WHERE id='$id'");
		
	}
	
	function insert_merged_result($data)
	{
		$this->db->insert('merged_result',$data);
	}
  
}

?>
  