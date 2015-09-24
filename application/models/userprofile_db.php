<?php 
class userprofile_db extends CI_Model
{
	
	function userprofile_db()
	{
		$this->load->helper('url');
	}
	
////==================user Update Profile====================================
	
	//Fill user details automatically
	public function fillUserDetails()
	{
		$this->load->database();
		$id = $_SESSION['usrID'];
		$query = $this->db->get_where('register',array('RegistrationId' => $id));
		return $query->result();
		
	}
	

	function updateData($data)
	{
		
		$this->load->database();
		$id = $_SESSION['usrID'];
	    $this->db->where('RegistrationId', $id);
    	$this->db->update('register' ,$data);
		return TRUE;
		
	}

 	function getPassword($userid)
	{
	 	$this->load->database();
		$query = $this->db->get_where('register',array('RegistrationId'=>$userid));
		return $query->result();
 	}

///============= Manage Users(delete_user) ===========================================================
	public function getData()
	{
		$this->load->database();
		$query = $this->db->get('register');
		return $query->result();	
	}
	
	public function getData_P()
	{
		$this->load->database();
		$query = $this->db->get_where('register',array('AccountType'=>'Personal Account'));
		return $query->result();	
	}
	
	public function getData_C()
	{
		$this->load->database();
		$query = $this->db->get_where('register',array('AccountType'=>'Business Account'));
		return $query->result();	
	}
	
	public function deleteUsr($id)
	{
		$this->load->database();
	    $query = $this->db->delete('register',array('RegistrationId'=>$id));
		return TRUE;
	}
	
///=============My Profile==============================================================================================
	function getAccountType($userid)
	{
	 	$this->load->database();
		$query = $this->db->get_where('register',array('RegistrationId'=>$userid));
		return $query->result();
 	}
	
//============== Favourite==============================================================================================

	function storeFavAdds($datafav)
	{
		$this->load->database();
		$this->db->insert('favouritetable',$datafav);
		
	}

	public function removeFav($id)
	{
		$this->load->database();
	    $query = $this->db->delete('favouritetable',array('id'=>$id));
		return TRUE;
	}
}
?>
