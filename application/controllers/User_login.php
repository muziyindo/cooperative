<?php

error_reporting(E_ERROR|E_WARNING);

class User_login extends CI_Controller 
{

   public function __construct()
   {
       parent::__construct();

		$this->load->database();
       $this->load->library('encrypt');
       $this->load->library('session');
       $this->load->library('form_validation');
	   
   }
   
	function index()
	{
		$data['title'] = 'Login Page';
		$this->load->view('header/login_header',$data);
		$this->load->view('content/login');
		//$this->load->view('footer/footer');
		
	}
   
   function authenticate()
   {
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$check = $this->db->query("SELECT * FROM users WHERE username='$username'");
		
		if($check->num_rows()>0)
		{
			$pword = $this->db->query("SELECT password FROM users WHERE username='$username'");
			$pword = $pword->result();
			$decrypted_password = $this->encrypt->decode($pword[0]->password);
			if($decrypted_password==$password)
			{
				
				//get user details
				foreach($check->result() as $value)
				{
					$uid = $value->id ;
					$username = $value->username ;
					$name = $value->name ;
					$role = $value->role ;
					//$lname = $value->lname ;
					
			
				}
				
				//store user details in session
				$this->session->set_userdata('userid', $uid);
				$this->session->set_userdata('uname', $username);
				$this->session->set_userdata('name', $name);
				$this->session->set_userdata('role', $role);
				//$this->session->set_userdata('lname', $lname);
				
				
				redirect('main/view_cummulative_report','refresh');
			}
			else
			{
				$this->session->set_flashdata('message', 'invalid_password');
				redirect('user_login');
			}
			
		}
		else
		{
			$this->session->set_flashdata('message', 'invalid_user');
			redirect('user_login');
		}
	}
   
   
  

}//end controller class



?>