<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class memSearch_controller extends CI_Controller {

function index(){
	

$this->load->helper('html');
 $this->load->library('form_validation');
 $this->load->helper('string');
$this->load->helper('captcha');
 $this->load->model('db_model');
$data['query'] = $this->db_model->getCategory();	

$data['captcha'] = $this->setCaptcha(); 
$this->load->view('memSearch',$data);                        
    

}
function setCaptcha()
    {
            $this->load->helper('captcha');
            $vals = array(
                'img_path'          => './captcha/',
                'img_url'           => base_url().'/captcha/',
                'expiration'        => 3600,// one hour
                'font_path'     => './system/fonts/georgia.ttf',
                'img_width'     => '140',
                'img_height'    => '40',
                'word'          => random_string('alnum', 6),
                );

            $cap = create_captcha($vals);
			 $this->load->library('session');
			$this->session->set_userdata('captchaword', $cap['word']);
		
           
                return $cap['image'] ;
}  

public function checkCaptcha(){
	$this->load->library('session');
	$capWord = $this->session->userdata('captchaword');
	
	$mail = $this->input->post('email');
	$this->session->set_userdata('email', $mail);
          
	$input = $this->input->post('code');
	$inputWord = trim($input);
	
	$this->load->library('form_validation');
    $this->form_validation->set_rules('code','verification code','required');
   	$this->form_validation->set_rules('email','email( eg:john@gmail.com)','required|valid_email');
	
	
	if( ($this->form_validation->run() == TRUE)&& ($inputWord==$capWord) ) {
		  
		   //$this->searchResults($email);
		   redirect('memSearchData_controller');
           
        } else {
			$this->form_validation->set_message( 'checkCaptcha', 'Your answer was incorrect!' );
			echo '<script>alert("Your answer incorrect ..please try again!");</script>';
			$this->index();
			
            
        }
	
}

public function returnMail(){
	
	$this->load->library('session');
	
	 $email = $this->session->userdata('email');
	 $this->load->model('memSearch_model');
     $data = $this->memSearch_model->getdata($email);
//$this->load->view('memSearchData',$data);
	
	 return $data;
		
}
      

}
?>