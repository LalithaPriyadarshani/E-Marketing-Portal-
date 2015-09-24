<?php
class paidAdd_model extends CI_Model{
	
	function paidAdd_model(){
		//parent::Model();
		$this->load->helper('url');
	}
	
	function insertPayments($data){
		
		$this->load->database();
		$this->db->insert('payments',$data);
	}
	
	public function retrieveImages(){
	
	$this->load->database();
	$query = $this->db->query('SELECT a.id, a.title, a.price, a.location, a.added_date, a.image, s.sub_name, c.cat_name
FROM advertisement a, subcatergories s, catergories c WHERE s.sub_id = a.subCatID AND c.id = s.cat_id
AND a.fstatus =1 AND CURDATE( ) <= DATE_ADD( a.added_date, INTERVAL 5 DAY ) GROUP BY a.id');
    return $query->result_array();	
	}
	
	public function getAdID(){
		$this->load->database();
		$query = $this->db->query('select max(id) as id from Advertisement');
		 return $query->result();	
		
	}
	
	public function setStatus($id){
		$this->load->database();
		
		
		$data = array(
               'fstatus' => 1,
               
            );

       $this->db->where('id',$id);
       $this->db->update('advertisement', $data);
		
	}
	
	public function reteriveAll($id){
		$this->load->database();
		$query =$this->db->get_where('advertisement', array('id' => $id));
		return $query->result(); 
		
		
	}
	
}