<?php
class memSearch_model extends CI_Model{
	
	function memSearch_model(){
		//parent::Model();
		$this->load->helper('url');
	}
	
	
	function getdata($email){ //get mem data
	
	$this->load->database();
	$data = $this->db->get_where('register', array('Email' => $email));
 
 	 
	return $data->result();
	}
	
	
}