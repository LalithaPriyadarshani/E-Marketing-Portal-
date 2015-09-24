<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ReportAds_controller extends CI_Controller {

function index(){
	
$this->load->library('table');
$this->load->helper('html');
	
$this->load->model('reportAds_model');
 $this->load->model('db_model');
$data['query'] = $this->db_model->getCategory();	


$data['querya']= $this->reportAds_model->getAds();
$data['img'] =$this->reportAds_model->getImages();

$this->load->view('report_ads',$data);

}


function denyAds(){
	$id = $this->input->get('id');
	$this->load->model('reportAds_model');
	$this->reportAds_model->denyReportAds($id);
	$this->index();
}


function allowAds(){
	$id = $this->input->get('id');
	$this->load->model('reportAds_model');
	$data= $this->reportAds_model->selectRepId($id);
	 
	 $RId;
	foreach($data as $row){

    $RId=$row->RID;
	

    }

	$this->reportAds_model->allowReportAds($RId,$id);
	$this->index();
}
 function manageTwoButtons(){
$this->load->model('reportAds_model');



   if(!empty($_POST['Alow'])){
	   
	  
	
     $aid =$this->input->post('id');
	 
	 $data= $this->reportAds_model->selectRepId($aid);
	 
	 $RId;
	foreach($data as $row){

    $RId=$row->RID;
	

    }
	$this->reportAds_model->allowReportAds($aid,$RId);
	$this->index();
}

elseif(!empty($_POST['Deny'])){
	 $RId;
	 $aid =$this->input->post('id');
	 
	 $data= $this->reportAds_model->selectRepId($aid);
	foreach($data as $row){

    $RId=$row->RID;
	

    }
	$this->reportAds_model->denyReportAds($RId);
	$this->index();

	
}
}


}