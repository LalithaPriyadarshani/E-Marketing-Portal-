<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class featuredAdd_controller extends CI_Controller {
	
	public function index()
	{
		$this->load->model('paidAdd_model');
		$data['fAds'] =$this->paidAdd_model->retrieveImages();
		
		$this->load->view('featuredAdd',$data);
		
		
		
	}
	
	public function displayAds(){
		
		$id = $this->input->get('id');
		$this->load->model('paidAdd_model');
	  $data['rslt1']=  $this->paidAdd_model->reteriveAll($id);
	  $this->load->model('reportAds_model');
	  $data['rslt2']=  $this->reportAds_model->getImages();
	  $this->load->view('displayFeatured_ads',$data);
		
	}
}