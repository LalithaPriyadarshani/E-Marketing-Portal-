<?php 

class Admin_Myprofile_M extends CI_Model{
	
	public function getLoggedAdmin(){
		$this->load->library('session');
		$this->load->database();
		
		
		if(isset($_SESSION['usrID']))
			{
			$sessionid = $_SESSION['usrID'];
			$query=$this->db->get_where('register',array('RegistrationId'=>$sessionid));					
			//$this->db->select('FirstName','email','password','RegistrationId');
			return $query->result();
		}
		
	
	}
	
	public function editAdminDetails($regId,$email,$password){
		$this->load->database();
		$data=array('Email'=>$email,'Password'=>$password);
		$this->db->where('RegistrationId',$regId);
		$this->db->update('register',$data);
		
	}
			
	
}
?>