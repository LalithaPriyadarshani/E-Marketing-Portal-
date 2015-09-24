<?php

class reportAds_model extends CI_Model{
	
	
	function reportAds_model(){
		//parent::Model();
		$this->load->helper('url');
	}
	
	
	function getAds(){
	
	$this->load->database();
	$this->db->distinct();
	
     	
     $this->db->select('ReportDescription,title,description,image,count(AdID)as totAds,AdID,RID');
     $this->db->from('reportads');
     $this->db->join('advertisement', 'advertisement.id = reportads.AdID');
$this->db->group_by('AdID');
$this->db->order_by("totAds", "desc"); 


	$query =$this->db->get();
	
	return $query->result();	
		
	}
	
	
	function getImages(){
		$this->load->database();
        $query = $this->db->get('images');
		
        return $query->result();
		
	}
	
	function selectRepId($id){
		
		$this->load->database();
		  $this->db->select('*');
     $this->db->from('reportads');
	 $this->db->where('id',$id);
     $this->db->join('advertisement', 'advertisement.id = reportads.AdID');



	    $query =$this->db->get();
		return $query->result();
		
	}
	
	function allowReportAds($Rid,$aid){
		
	$this->load->database();
	
	$this->db->delete('ratings', array('AdID' => $aid)); 	
	$this->db->delete('comment', array('Ad_ID' => $aid)); 	
	$this->db->delete('reportads', array('RID' => $Rid)); 	
	$this->db->delete('advertisement', array('id' => $aid)); 	
	}
	
	
	
	function denyReportAds($Rid){
		
	$this->load->database();
	
    $this->db->delete('reportads', array('RID' => $Rid)); 	
	 	
	}
	
}