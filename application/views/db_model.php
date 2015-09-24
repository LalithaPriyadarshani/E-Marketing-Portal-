<?php 


class Db_Model extends CI_Model{
	
	
	public function Db_model(){
		//parent::Model();
		$this->load->helper('url');
	}	
	
	
	public function search_adds(){
		
		$this->load->database();
        $query = $this->db->get('advertisement');
        return $query->result();
	}
	
	
	
	
}














?>