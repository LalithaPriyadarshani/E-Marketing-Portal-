<?php
    class Ads_Approve_Model extends CI_Model{  
	
		/*function doUpload(){
			
		}*/
	 
       /* function insert_ad_data($data){
                    $this->load->database();
                    $this->db->insert('advertisement',$data);    
            }//end of function insert advertisement  data */
		public function getStatus()
		{
			$this->load->database();
			//$stat=1;
			$this->load->library('table');

			$query=$this->db->get_where('advertisement',array('status'=>0));
			return $query->result();
			//echo $this->table->generate($query);			
			
			//$statusqry = $this->db->query('SELECT * FROM advertisement WHERE ststus=1');
			//$fields=$statusqry->field_data();//column data			
//			return $fields->result();	
		}	
		public function approveAds($id)
		{
			$this->load->database();
			
			$data = array(
               'status' => 1
            );

			$this->db->where('id', $id);
			$this->db->update('advertisement', $data);
			
			$report=$this->db->query("select id,title,image,email FROM advertisement WHERE id=".$id.";");
			return $report->result();
	
		}
		public function removeAds($id)
		{
			$this->load->database();
			//email
			$report=$this->db->query("select id,title,image,email FROM advertisement WHERE id=".$id.";");

			$this->db->where('id', $id);
			$this->db->delete('advertisement');
			
						return $report->result();

		}
		
		
		
		
		
		
		
		
		
		
		
		
		
}
		
?>