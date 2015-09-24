<?php

class Email_model extends CI_Model{
	
	
	function Email_model(){
		//parent::Model();
		$this->load->helper('url');
	}
	
	
	public function getUsers($interest){ //get users according to their interests
		
		$this->load->database();
		$res = $this->db->get_where('register', array('interest' => $interest));
        return $res->result();
	}
	
}