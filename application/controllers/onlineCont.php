<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class onlineCont extends CI_Controller {

	

	public function index()
	{
		
		
		
		$this->load->library('table');
        $this->load->helper('html');
		 //$courseModule = $this->input->post('module');
		 $this->load->model('online_model');	
		$data['qry'] = $this->online_model->fill_table();
		$this->load->view('online');
	}
	
	public function validPassMarks(){
		  $passMark = $this->input->post('passMrk');
		  $tot = $this->input->post('totalMrk');
		  
		 
		  $marksPerQuestion = $this->input->post('marks');
		  $totalQues = $this->input->post('total');
		  //$tot = $marksPerQuestion * $totalQues;
		  
		  $courseModule = $this->input->post('module');
		  $noQuestions = $this ->input->post('No');
		   if ($passMark > $tot)
		  {
			  echo "error";
		
		  }
		  else{
		  $data = array(
		
			'courseModule' => $courseModule,
			'no_of_ques' =>$noQuestions,
			'total' =>$tot
			);
			
			 $this->load->model('online_model');  
		  $this->online_model->insert_marks($data);
		  }
		
	}
}

