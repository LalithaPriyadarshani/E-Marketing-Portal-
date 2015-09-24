<?php
class category_model extends CI_Model{
	
	function category_model(){
		//parent::Model();
		$this->load->helper('url');
	}
	
	function get_category(){ //fill category table
		$this->load->database();
        $query = $this->db->get('catergories');
		
        return $query->result_array();
}

	function insert_category($data){ 
		$this->load->database();
		$this->db->insert('catergories',$data);
	}
	
	function getAllCat(){ //get all category names
		$this->load->database();
		$query = $this->db->query('select cat_name from catergories');
		return $query->result();
		
	}
	
	function getId($cat_name){ //get category id
	
	$this->load->database();
	$id = $this->db->get_where('catergories', array('cat_name' => $cat_name));
     return $id->result();
	}
	
	function insert_SubCategory($Subdata){ 
	
		$this->load->database();
		$this->db->insert('subcatergories',$Subdata);	
	}
	
	function selectSubCatergories($catName){//select sub catergories
		
	  $this->load->database();
	  $this->db->select('*');
     $this->db->from('subcatergories');
	 $this->db->where('cat_id',$catName);
     $this->db->join('catergories', 'catergories.id = subcatergories.cat_id');
     $data =$this->db->get();
	 return $data->result_array();
}
	

	
public function update_catName($id,$catName){
	  
	  $this->load->database();
	  $data =array(
	  'cat_name'=>$catName
	  );
	  $this->db->where('id',$id);
	 $this->db->update('catergories',$data);
		
}
	
public function deleteCategory($id){
	
$this->load->database();

 $data =array(
	  'cat_id'=> 1
	  );
	  $this->db->where('cat_id',$id);
	 $this->db->update('subcatergories',$data);
		

 $this->db->where('id',$id);
 $this->db->delete('catergories');
			
	
}
	
	public function update_subcatName($id,$SubcatName){
	  
	  $this->load->database();
	  $data =array(
	  'sub_name'=>$SubcatName
	  );
	  $this->db->where('sub_id',$id);
	 $this->db->update('subcatergories',$data);
		
}	


public function deleteSubCategory($id){
	
$this->load->database();

 $data =array(
	  'subCatID'=> 1
	  );
	  $this->db->where('subCatID',$id);
	 $this->db->update('advertisement',$data);
		

 $this->db->where('sub_id',$id);
 $this->db->delete('subcatergories');
			
	
}
	
/*	function insert_subCat(){
		$this->load->database();
		$query = $this->db->query('select id from catergories where cat_name=*/


}
?>