<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); //security purpose

class user_mail  extends CI_Controller
{
	public function index()
	{	
	
		$this->load->model('userprofile_db');
		 $this->load->model('db_model');
	     $data['query'] = $this->db_model->getCategory();	

		$this->load->view('contactUs_View',$data);
	
	}
	public function contactMail()
	{
		$this->load->library('form_validation');
		
		// we are "trimming" the fields, converting the password to MD5, and running the  "xss_clean" function, which removes malicious data.
		$this->form_validation->set_rules('inputMessage','inputMessage','trim|required');
		$this->form_validation->set_rules('inputEmail','inputEmail','trim|required|valid_email');
		
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->form_validation->set_message('Error validate');
			$this->load->view('register_error_validate');
		}
		else
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
			$this->email->to('buyandsell19921991@gmail.com');
			
		
			$subject = $this->input->post('inputSubject');
			$inputEmail = $this->input->post('inputEmail');
			$inputName = $this->input->post('inputName');
			$this->email->subject($subject." User Email: ".$inputEmail." User: ".$inputName);
			
			$description = $this->input->post('inputMessage');
			$this->email->message($description." User Email: ".$inputEmail." User: ".$inputName);
			if ($this->email->send())
			 {
				redirect('http://localhost/E_Marketing_Portal/');
			 }
			 else
			 {
				$this->load->view('register_error_validate');
			 }
		}
			
	}
	
	
	
	
	
	
}