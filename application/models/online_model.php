<?php
class online_model extends CI_Model{
	
	function online_model(){
		//parent::Model();
		$this->load->helper('url');
	}
	
	
	function insert_marks($data){ 
		$this->load->database();
		$this->db->insert('online',$data);
	}
	
	
	function getData($module){ 	
	$this->load->database();
	$query = $this->db->get_where('online', array('courseModule' => $module));
 
 	 
	return $query->result();
	}
	
	
	    function fill_table(){//fill  table
		$this->load->database();
        $query = $this->db->get('online');
		
        return $query->result();
}
	
	
	
}
?>