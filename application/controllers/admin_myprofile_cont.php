<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Myprofile_Cont extends CI_Controller {
	public function index(){		
		
			$this->load->model('admin_myprofile_m');
			$this->getLoggedAdmin();	
	}
	public function getLoggedAdmin(){
		$this->load->model('admin_myprofile_m');
		$data['query']=$this->admin_myprofile_m->getLoggedAdmin();
		if($data!=NULL){
		$this->load->view('admin_myprofile_v',$data);
			
		}
	}
	
	public function EditDetails(){	
		
		if(isset($_POST['submit'])){
	$this->load->library('form_validation');

		$this->form_validation->set_rules('currentPassword','currentPassword','trim|required');
		$this->form_validation->set_rules('newPassword','newPassword','trim|matches[passwordConfirmation]md5');
		$this->form_validation->set_rules('passwordConfirmation','passwordConfirmation','trim');
		
		
		if ($this->form_validation->run() == FALSE)
		{
			//$this->form_validation->set_message('Error validate');
			echo '<script> alert("The values you entered is in correct.Please provide valid data")';
			$this->index();		

		}
		else{
		
			$val=$this->validpassword();
			if($val==0){
				
				
				$this->load->database();
				 $regId =  $_POST['id'];			
				$newpassword = $this->input->post('newPassword');
				$email = $this->input->post('email');
				$this->load->model('admin_myprofile_m');
				$this->admin_myprofile_m->editAdminDetails($regId,$email,$newpassword);
				$this->index();
			}
	
			else
			{
				$this->load->library('session');
				$this->session->set_userdata('errorMsg','visible');
		 		$this->index();	
				//echo 'err';
			
			}
		}
	}
	}
		function validpassword()
		{
			$this->load->helper('html');
			$this->load->helper('url');
			$this->load->model('admin_myprofile_m');			
			$data=$this->admin_myprofile_m->getLoggedAdmin();
					$pw;
			foreach($data as $row)
			{
				 $row->FirstName;
				 $pw =$row->Password;
				 $row->Email;
			}
	
			 $checkPassword = $this->input->post('currentPassword');
		
			
		 	if($pw != $checkPassword)
		 	{
				return 1;
			}
			else if($checkPassword==$pw)
			{
				
				return 0; 
				
			}
		}
		
			
	
	//$this->load->model('admin_myprofile_m');	 getLoggedAdmin()  editAdminDetails($regId,$FirstName,$email,$password)
}?>


	