<?php
    class Upload  extends CI_Controller{
        
        public function index()
		{
			$this->load->library('table');
			$this->load->model('upload_model');
			$this->setStatus();					
        }
		
		public function setStatus(){
			
			$this->load->model('upload_model');
			$data['query']=$this->upload_model->getStatus();			
			$this->load->view('upload_view',$data);
		}
		
		public function popup($id){
			$this->load->model('upload_model');
			
			$data['query'] = $this->upload_model->ViewAd($id);
			$this->load->view('upload_view',$data);

		}
	}
?>