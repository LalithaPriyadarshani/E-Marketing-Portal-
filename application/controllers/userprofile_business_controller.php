<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class userprofile_business_controller extends CI_Controller {
	
	public function index()
	{
		$this->load->helper('html');
		$this->load->model('userprofile_db');
		
		// check id is available in database and account type is personal account
		$this->load->model('db_model');
	    $data['query'] = $this->db_model->getCategory();	

		$data['query2'] = $this->userprofile_db->fillUserDetails();
		$this->load->view('userprofile_business_view',$data);
				
	}

	//Get dropdownlist value
	public function getLocation()
	{
		 $city = array(
							'0'       =>  'Select a location',
                            'option1'       =>  'Colombo',
                            'option2'       =>  'Kandy',
                            'option3'       =>  'Galle',
							'option4'       =>  'Ampara',
                            'option5'       =>  'Anuradhapura',
                            'option6'       =>  'Badulla',
							'option7'       =>  'Batticaloa',
                            'option8'       =>  'Gampaha',
                            'option9'       =>  'Hambantota',
							'option10'       =>  'Jaffna',
                            'option11'       =>  'kalutara',
                            'option12'       =>  'Kegalle',
							'option13'       =>  'Kilinochchi',
                            'option14'       =>  'Kurunegala',
                            'option15'       =>  'Manner',
							'option16'       =>  'Matale',
                            'option17'       =>  'Matara',
                            'option18'       =>  'Moneragala',
							'option19'       =>  'Mullativu',
                            'option20'       =>  'Nuwara Eliya',
                            'option21'       =>  'Polonnaruwa',
							'option22'       =>  'Puttalama',
							'option23'       =>  'Rathnapura',
							'option24'       =>  'Trincomalee',
							'option25'       =>  'Vavuniya'
                							
			 );
			 
			 $place = $this->input->post('dropdown_menu');
			 return $city[$place];
			 
		
	}
	
	// Update details
	public function updateDetails(){
		
		$this->load->library('form_validation');
		
		// we are "trimming" the fields, converting the password to MD5, and running the  "xss_clean" function, which removes malicious data.
		
		$this->form_validation->set_rules('currentPassword','currentPassword','trim|required');
		$this->form_validation->set_rules('newPassword','newPassword','trim|matches[passwordConfirmation]md5');
		$this->form_validation->set_rules('passwordConfirmation','passwordConfirmation','trim');
		
		//phone1 number validate empty or ten numbers
		$Phone1 = $this->input->post('txtMobileNo');
		function validPhoneNumber($Phone1)
		{
    		$Phone1 = trim($Phone1);
			if ($Phone1 == '') 
			{
			return TRUE;
  			}
			
    	else
    		{
				if (preg_match('^\([0-9]{3}\) ?[0-9]{3}( |-)?[0-9]{4}|^\[0-9]{3}( |-)?\[0-9]{3}( |-)?\[0-9]{4}', $Phone1))
            	{
                 	return preg_replace('^\([0-9]{3}\) ?[0-9]{3}( |-)?[0-9]{4}|^\[0-9]{3}( |-)?\[0-9]{3}( |-)?\[0-9]{4}', $Phone1);
            	}
            	else
            	{
					$this->load->view('register_error_validate');
                    //return FALSE;
            	}
    		}
		}

		if ($this->form_validation->run() == FALSE)
		{
			$this->form_validation->set_message('Error validate');
			$this->load->view('register_error_validate');
		}
		else
		{
			$val=$this->validpassword();
			if($val==0){
				$this->load->model('userprofile_db');
				$email =$this->input->post('Email');
				$currentpassword = $this->input->post('currentPassword');
				$newpassword = $this->input->post('newPassword');
				$Phone1 =  $this->input->post('MobileNo');
				$Cities = $this->getLocation(); 
				
				
				$changePwd = $_POST['newPassword'];
				$changePwdConfirm = $_POST['passwordConfirmation'];
				if($changePwd == "" || $changePwdConfirm == "")
				{
					$data = array(
					'Email' => $email,
					'Password'	=> $currentpassword ,
					'MobileNo'	=>	$Phone1,
					'City_Showroom' => $Cities
					);
				}
				else
				{
					$data = array(
					'Email' => $email,
					'Password'	=> $newpassword ,
					'MobileNo'	=>	$Phone1,
					'City_Showroom' => $Cities
					);
				} 
								
				$this->userprofile_db->updateData($data);
				$this->load->helper('url');
				redirect('user_controller/userProfileData');
			}
		
			else
			{
				$this->load->library('session');
				$this->session->set_userdata('errorMsg','visible');
		 		$this->index();	
				
			
			}		
		}
		
	}
	

		// Load Login Page
		public function userPage()
		{
			//echo 'You have been successfully update your details';
			$this->load->view('user_successful_view');
		}
		
		//chack old and new passwords
		function validpassword()
		{
			$this->load->helper('html');
			$this->load->helper('url');
			$this->load->model('userprofile_db');		
			$id = $_SESSION['usrID'];
			
		
			$data=$this->userprofile_db->getPassword($id);
		
			foreach($data as $row)
			{
				$pw =$row->Password;
			}
	
			$checkPassword = $this->input->post('currentPassword');
		
			
		 	if($pw != $checkPassword)
		 	{
				return 1;
			}
			else
			{
				return 0;
			}
		}
}
?>