<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller
{
	
	public function index()
	{
		
		$this->load->library('form_validation');
		 $this->load->model('db_model');
	$data['query'] = $this->db_model->getCategory();	

		$this->load->view('register_message',$data);
		
	}
	
	//Create Auto Increment Registartion ID
	public function createId(){
		$pStatus = 'unchecked';
		$bStatus = 'unchecked';
		$selectedRadio = $_POST['Account'];
		
		if ($selectedRadio == 'Personal Account') {
			$pStatus = 'checked';
			$this->load->helper('string');
			$id=random_string('numeric',6); 
			return $id;
			}
			
		else if ($selectedRadio == 'Business Account') {
			$bStatus = 'checked';
			$this->load->helper('string');
			$id =  random_string('numeric',6); 
			return $id;
			}
			
		
		} 
		

	// Create Account	
	public function createAccount()
	{
		
		$this->load->library('form_validation');
		
		// we are "trimming" the fields, converting the password to MD5, and running the  "xss_clean" function, which removes malicious data.
		$this->form_validation->set_rules('Account','Account','trim|required|xss_clean');
		$this->form_validation->set_rules('Email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('Password','Password','trim|required|matches[ConfirmPassword]md5');
		$this->form_validation->set_rules('ConfirmPassword','ConfirmPassword','trim|required');
		$this->form_validation->set_rules('rbnTermsAndConditios','rbnTermsAndConditios','trim|required|xss_clean');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->form_validation->set_message('Error validate');
			$this->load->view('register_error_validate');
		}
		else
		{
			
			$this->load->model('registerdb');
			$account = $this->input->post('Account');
			$registerId = $this->createId();
			$companyName = $this->input->post('CompanyName');
			$firstName =  $this->input->post('FirstName');
			$lastName = $this->input->post('LastName');
			$email= $this->input->post('Email');
			$password = $this->input->post('Password');
		
			$data = array(
				'AccountType' => $account,
				'RegistrationID'=> $registerId,
				'CompanyName' => $companyName,
				'FirstName' => $firstName,
				'LastName' => $lastName,
				'Email' => $email,
			   'Password' => $password,
			);
				
			$this->registerdb->process($data);
			$this->registerMail();
			 
			
			
		}
	}
	
	public function registerMail()
	{
		
		   $config = Array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'ssl://smtp.googlemail.com',
                    'smtp_port' => 465,
                    'smtp_user' => 'buyandsell1992@gmail.com',
                    'smtp_pass' => 'BuyAndSell199212',
                    );
    
			$this->load->library('email',$config);
			$this->email->set_newline("\r\n");
			
			$this->email->from('buyandsell1992@gmail.com','GoBuySell');
			$email= $this->input->post('Email');
			$this->email->to($email);
			
			$this->email->subject("Go Buy And Sell");
			$password = $this->input->post('Password');
			
			$this->email->message("Congratulations!!!.You have successfully create your account in gobuyandsell.Now you can enjoy our service.You can login to the system using below details.  Email: ".$email."  Password: ".$password);
			if ($this->email->send())
			 {
			 	$this->load->helper('url');
			redirect('http://localhost/E_Marketing_Portal/index.php/e_marketing_portal/load_login');
				
			 }
			 else
			 {
			 	$this->load->view('register_error_validate');
			 }
								
	}


		
}
?>