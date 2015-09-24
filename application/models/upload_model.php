<?php
    class Upload_Model extends CI_Model{  
	
		public function getStatus()
		{
			$this->load->database();
			$this->load->library('table');
			$this->load->library('session');
	 		
			if(isset($_SESSION['usrID']))
			{
			$sessionid = $_SESSION['usrID'];
			$query=$this->db->get_where('advertisement',array('cusId'=>$sessionid));	
					
			$this->db->select('id','title','Defaultimage');
			return $query->result();
			}
		}
		
		public function viewAd($id)
		{ //id = add id
			$this->load->database();			
			$query=$this->db->get_where('advertisement',array('id'=>$id));
			$this->db->select('title','added_date','location','price','description');	
			return $query->result();
			//$id=$this->uri->segment(3);
			//$data['adsdb'] = $qry;
			
		}		
		//$sessionid= $this->session->userdata('usrID');
	 
				
				/* $this->db->select_max('RegistrationId');
				$Q = $this->db->get('register');
				$row = $Q->row_array();
				$sessionid= $row['RegistrationId'];//'id12344';// //$this->db->insert_id();// 
				*/

}
		
?>