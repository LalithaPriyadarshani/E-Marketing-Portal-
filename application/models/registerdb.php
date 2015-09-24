<?php 
class Registerdb extends CI_Model{
	function process($data){
		$this->load->database();
		$this->db->insert('Register',$data);
		}
		
		function getId($data){
				$this->load->database();
				$this->db->insert('Register',$data);
			}
	
	}
?>