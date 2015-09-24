<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); //security purpose

class user_controller  extends CI_Controller
{
	public function index()
	{	
		$this->load->library('table');
		$this->load->helper('html');
		
		if(isset($_SESSION['uname']))
		{			
			$this->load->model('userprofile_db');
			 $this->load->model('db_model');
	         $data['query'] = $this->db_model->getCategory();	

			$data['query3'] = $this->userprofile_db->getData();
			$data['query1'] = $this->userprofile_db->getData_P();
			$data['query2'] = $this->userprofile_db->getData_C();
        	$this->load->view('delete_user_view',$data);
		}
			
		else
		{
			echo 'Sorry !!! Login details not correct';
		}
		
	}
	
//===============Manage Users=============================================	
	public function deleteUsers($data)
	{
		$this->load->model('userprofile_db');
		$this->userprofile_db->deleteUsr($data);
        $this->index();
	}
	
//===============Profile View=============================================	
	public function userProfileData()
	{
		$this->load->model('userprofile_db');
		$id = $_SESSION['usrID'];
		$data=$this->userprofile_db->getAccountType($id);
		
		foreach($data as $row)
			{
				$accountType =$row->AccountType;
			}
			
		if($accountType =="Personal Account")
		{
			$this->load->model('userprofile_db');
			
			$this->load->model('db_model');
	         $data['query'] = $this->db_model->getCategory();	

			$data['query3'] = $this->userprofile_db->fillUserDetails();
			$this->load->view('profilePersonal_view',$data);
		}
		
		 if($accountType =="Business Account")
		{
			$this->load->model('userprofile_db');
			
			$this->load->model('db_model');
	         $data['query'] = $this->db_model->getCategory();	

			$data['query3'] = $this->userprofile_db->fillUserDetails();
			$this->load->view('profileBusiness_view',$data);
		}

	}
	
//===============  Mark as Favourite =========================

	public function favouriteAdds($add_id)
	{
		if(isset($_SESSION['uname']))
		{			
			$this->load->model('userprofile_db');
			$userId = $_SESSION['usrID'];
			
			$datafav = array(
				'RegistrationID'=> $userId,
				'id'=>$add_id,
			);
				
			$this->userprofile_db->storeFavAdds($datafav);
			
		}
			
		else
		{
			$this->load->view('login');
		}
		
	}
	
	public function myFavList()
	{
		$this->load->view('favouriteAdsList_view');
	}
	public function removeFavourites($data)
	{
		
		$this->load->model('userprofile_db');
		$this->userprofile_db->removeFav($data);
      	$this->load->view('favouriteAdsList_view');
	}	

	
}
?>