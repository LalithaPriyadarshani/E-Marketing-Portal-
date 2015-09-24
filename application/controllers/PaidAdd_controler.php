<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class paidAdd_controler extends CI_Controller {
	
	public function index()
	{
        $this->load->library('form_validation'); 
		$this->load->view('PaidAdd');
		
		
		
	}
	 
	public function addPayment(){
		
	 $cardNum =$this->input->post('number');
	  $this->load->library('form_validation'); 
	
        $this->form_validation->set_rules('number','verification code','required');
   	$this->form_validation->set_rules('CVV','CVV','required');
        $this->form_validation->set_rules('name','Card holder name','required');
	 $i;
	  
	$cardType;
	 $selectedRadio = $_POST['card'];	
	 
	 if($selectedRadio == 'visa'){
		 
		 $cardType ='visa';
		 
		 if(preg_match('/^4[0-9]{12}(?:[0-9]{3})?/',$cardNum)){
		 	
		 	$i=0;
		 }
		 else{
		 	
		 	$i=1;
		 }
	 }
	 elseif($selectedRadio =='masterCard'){
		$cardType ='Master Card'; 
		 if(preg_match('/^5[1-5][0-9]{14}/',$cardNum)){
		 	
		 	$i=0;
		 }
		 else{
		 	
		 	$i=1;
		 }
	 }
	 elseif($selectedRadio=='Discover'){
		$cardType ='Discover'; 
		 if(preg_match('/^6(?:011|5[0-9]{2})[0-9]{12}$/',$cardNum)){
		 	
		 	$i=0;
		 }
		 else{
		 	
		 	$i=1;
		 }
	 }
	 elseif($selectedRadio == 'AmericanExpress'){
		$cardType ='American Express'; 
		 if(preg_match('/^3[47][0-9]{13}$/',$cardNum)){
		 	
		 	$i=0;
		 }
		 else{
		 	
		 	$i=1;
		 }
	}
	  if($this->form_validation->run() == TRUE && $i==0){
	
	 
	 $expireMonth = $this->input->post('ddlSelectMonth');
	 $expireYear =$this->input->post('ddlSelectYear');
	 
	 $cvv =$this->input->post('CVV');
	 $holder =$this->input->post('name');
	 
	  //$this->load->library('../controllers/e_marketing_portal');
	  //$user=$this->e_marketing_portal->log_in();
	 $this->load->library('session');
	 $user=  $_SESSION['usrID'];
	 
	 $data = array (
	
		'cardNumber' => $cardNum,
		'cardType' => $cardType,
		'ExpireMonth'=>$expireMonth,
		'ExpireYear' =>$expireYear,
		'CVV' => $cvv,
		'cardHolder' =>$holder,
		'customerId' =>$user
	);
	
	$this->load->model('paidAdd_model');
	$this->paidAdd_model->insertPayments($data);
	
	$data = $this->paidAdd_model->getAdID();// get id. it is an array
	
	  $id;
	
	foreach($data as $row) //get id to the variable
	{
		$id = $row->id;
	}
	$this->paidAdd_model->setStatus($id);
	 echo '<script>alert("Thank You.. your advertisement will be appear on our home page!");</script>';
	$this->load->model('upload_model');
	$data['query']=$this->upload_model->getStatus();			
	$this->load->view('upload_view',$data);

	}
	

else{

echo '<script>alert("Your answer incorrect ..please try again!");</script>';
$this->index();
			
}

}
}