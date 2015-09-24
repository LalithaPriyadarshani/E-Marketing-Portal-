<?php
    class Post_Ads_Model extends CI_Model{  
	

		public function getAdData($AdId){ //get advetisement data accrding to the adID and pass it to view
			$this->load->database();
			$query = $this->db->get_where('advertisement',array('id'=>$AdId));
			$this->db->select('title','added_date','location','price','description');	
			return $query->result();			
		} 
		
		public function update_Ads($id,$title,$name,$email,$phone,$location,$description,$price,$day,$cusId){
			//echo 1;
			$data=array('title'=>$title,'name'=>$name,'email'=>$email,'phone'=>$phone,'location'=>$location,'description'=>$description,'price'=>$price,'added_date'=>$day,'cusId'=>$cusId);
			$this->db->where('id',$id);
			$this->db->update('advertisement',$data);
			//echo 9;
		}		
        function insert_ad_data($data){
             $this->load->database();
             $this->db->insert('advertisement',$data);  
					  
        }//end of function insert advertisement  data		
		
//**********end edit ad ****

		/*public function filledAdId(){
			$this->load->database();
			$id=$this->db->insert_id('advertisement');			//get the last inserted id
			echo $id.'is ID';
			if($id!=0){
			return $id;	
			}
			else echo 'Post an advertisement first';	
									
		}*/
	public function getSubCat($subcategory){
			$this->load->database();
			//$query=$this->db->get_where('subcatergories',array('sub_name'=>$subcategory));//select * from image where subid=$subid
			//$this->db->select('sub_id');	
			$query=$this->db->query("select sub_name,cat_name FROM subcatergories s, catergories c WHERE  s.cat_id=c.id AND sub_id=".$subcategory." ;");
			if ($query!=NULL){//echo 1;
			return $query->result();
			}
			
		}
		public function updateAdId($id,$imgsubId){ //insertAD ID into 'images' 
			$data= array('id'=>$id); 
			$this->db->where('subid',$imgsubId);
			$this->db->update('images',$data);
		}

		public function getCategory()
		{
			$this->load->database();
			$query = $this->db->get('catergories');
			return $query->result();	
		}
		public function getSubCategory()
		{
			$this->load->database();
			$query = $this->db->get('subcatergories');
			return $query->result();	
		}
		
			/*public function uploadFile($category,$subcategory,$subname){
			$data= array('sub_id'=>$subcategory,'cat_id'=>$category,'sub_name'=>$subname);
			$this->db->insert('subcategories',$data);
		}*/

		public function uploadFile($data,$subcategory,$condition,$title,$adtype,$name,$email,$phone,$location,$description,$price,$day,$cusId,$defaultimg){
			$data= array('Defaultimage' => $data['Image'],'SubCatId'=>$subcategory,'conditions'=>$condition,'title'=>$title,'Adtype'=>$adtype,'name'=>$name,'email'=>$email,'phone'=>$phone,'location'=>$location,'description'=>$description,'Price'=>$price,'added_date'=>$day,'cusId'=>$cusId,'image'=>$defaultimg);
			$this->db->insert('advertisement',$data);
			$id=$this->db->insert_id('advertisement');			//get the last inserted id
			if($id!=0){
			return $id;	
			}
			else echo 'Post an advertisement first';	
				
		}
		
		public function uploadFile1($file_name){
			$data= array('name'=> $file_name);
			$this->db->insert('images',$data);
			$subid=$this->db->insert_id('images');			//get the last inserted subid
			
			return $subid;
		}
		
		public function uploadFile2($file_name){
			$data= array('name'=>$file_name);
			$this->db->insert('images',$data);
			$subid=$this->db->insert_id('images');			//get the last inserted subid
			
			return $subid;
		}
		public function uploadFile3($file_name){
			$data= array('name'=>$file_name);
			$this->db->insert('images',$data);
			$subid=$this->db->insert_id('images');			//get the last inserted subid
			//echo 'sub id'.$subid;
			return $subid;
		}
		public function uploadFile4($file_name){
			$data= array('name'=>$file_name);
			$this->db->insert('images',$data);
			$subid=$this->db->insert_id('images');			//get the last inserted subid
			//echo 'sub id'.$subid;
			return $subid;
		}
		public function uploadFile5($file_name){
			$data= array('name'=>$file_name);
			$this->db->insert('images',$data);
			
			$subid=$this->db->insert_id('images');			//get the last inserted subid
			//echo 'sub id'.$subid;
			return $subid;
		}
		//end images
		
		
		
		///functions for rules pages	
		public function getUsers(){
			$this->load->database();
			$query= $this->db->get('register');
			
			if($query->num_rows()>0){
			return $query->result_array();
			}
		}
		
		public function getNumUsers(){
			return $this->db->count_all('register');
			
		}
		
		//
		
}
	/*
						$this->db->select_max('id');
						$query = $this->db->get('emplyee_personal_details');
						-----------------------------------------------------
													$maxid = 0;
							$row = $this->db->query('SELECT MAX(id) AS `maxid` FROM `emplyee_personal_details`')->row();
							if ($row) {
								$maxid = $row->maxid; 
							}
						*/	
?>