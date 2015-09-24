<?php 


class Db_Model extends CI_Model{
	
	
	public function Db_model(){
		//parent::Model();
		$this->load->helper('url');
	}	
	
	
	
	public function show_featured_ads()  // display featured ads on the home page
	{
		$this->load->database();
		$query = $this->db->get_where('advertisement', array('status' => '1'));
		return $query->result();
	}
	
	
	
	
	public function search_adds(){  // not in use
		
		$this->load->database();
        $query = $this->db->get('advertisement');
        return $query->result();
	}
	
	
	public function m_search_adds($set_where){  // search for ads with keywords
	
			$this->load->database();
			$this->db->like('title',$set_where);
			$this->db->where('status','1');
			$query = $this->db->get('advertisement');
			return $query->result();
		
	}
	
	
	public function m_search_adds_with_city($set_where, $city){  // search for ads with keywords and city
	
			$this->load->database();
			$this->db->like('title',$set_where);
			$this->db->where('status','1');
			$query = $this->db->get_where('advertisement', array('location' => $city));
			return $query->result();
		
	}
	
	
	public function search_adds_with_cat($catId) // search bar category drop down list search
	{
	 		$this->load->database();
			$this->db->where('status','1');
			$query = $this->db->get_where('advertisement', array('subCatID' => $catId));
			return $query->result();
	}
	
	
	public function search_adds_with_cat_and_city($catId, $city) // search bar category drop down list search with city
	{
	 		$this->load->database();
			$this->db->where('subCatID', $catId);
			$this->db->where('location', $city);
			$this->db->where('status','1');
			//$query = $this->db->get_where('advertisement', array('subCatID' => $catId, 'location' => $city));
			$query = $this->db->get_where('advertisement');
			return $query->result();
	}
	
	
	public function search_more_adds($set_where){  // view more page data
		
			$this->load->database();
			$query = $this->db->get_where('advertisement', array('id' => $set_where));
			return $query->result();
			
	}
	
	
	public function get_ad_images($adID)  // get images for image gallery in view more ads
	{
		$this->load->database();
		$query = $this->db->get_where('images', array('id' => $adID));
		return $query->result();
		
	}
	
	
	
	
	public function getCategory()  // display categories in search bar drop down list
	{
		$this->load->database();
		$query = $this->db->get('subcatergories');
		return $query->result();
	}
	
	
	public function reportAds($id, $rHeader, $rDescrip)
	{
		$this->load->database();
		
		$data = array(
		   'AdId' => $id ,
   		   'ReportHeader' => $rHeader ,
   		   'ReportDescription' => $rDescrip
		);

		$this->db->insert('reportads', $data); 

		return true;
	}
	
	
	
	
	public function login($email ,$password) // login function
	{
			$this->load->database();
			$array = array('Email' => $email, 'password' => $password);
			$this->db->where($array); 
			$query = $this->db->get('register');
			return $query->result();
			
	}
	
	
	
	
	public function rate($adID, $rate)  // rate ads insert values
	{
		$this->load->database();
		
		$data = array(
		   'AdId' => $adID ,
   		   'Rate' => $rate
		);

		$this->db->insert('ratings', $data); 

		return true;
	}
	
	
	public function get_rate_results($adID)
	{
		$this->load->database();
		
		$query = $this->db->get_where('ratings', array('AdID' => $adID));
		return $query->result();	
	}
	
	
	public function add_comment($adID, $name, $comment)  // add a comment
	{
		$this->load->database();
		
		$data = array(
		   'Ad_ID' => $adID ,
   		   'Name' => $name,
		   'Comment' => $comment
		);

		$this->db->insert('comment', $data); 

		return true;
	}
	
	
	public function get_comments($adID)
	{
		$this->load->database();
		
		$query = $this->db->get_where('comment', array('Ad_ID' => $adID));
		return $query->result();
	}
	
	
	public function delete_comments($adID)
	{
		$this->load->database();
		
		
		$this->db->where('Comment_ID', $adID);
		$this->db->delete('comment'); 

		//$query = $this->db->get_where('comment', array('Ad_ID' => $adID));
		//return $query->result();
	}
	
	
	
	//==================================== advanced search =================================================================
	
	
	public function model_advanced_search_basic($access, $include, $exclude, $category)
	{
		if($access == '1')
		{
			$this->db->like('title', $include);
			$this->db->not_like('title', $exclude);
			$this->db->where('subCatID', $category);
			$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '2')
		{
			$this->db->like('title', $include);
			$this->db->not_like('title', $exclude);
			//$this->db->where('subCatID', $category);
			$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '3')
		{
			$this->db->like('title', $include);
			//$this->db->not_like('title', $exclude);
			$this->db->where('subCatID', $category);
			$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '4')
		{
			$this->db->like('title', $include);
			//$this->db->not_like('title', $exclude);
			//$this->db->where('subCatID', $category);
			$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '5')
		{
			//$this->db->like('title', $include);
			//$this->db->not_like('title', $exclude);
			$this->db->where('subCatID', $category);
			$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '6')
		{
			//$this->db->like('title', $include);
			//$this->db->not_like('title', $exclude);
			//$this->db->where('subCatID', $category);
			$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		
	}
	
	
	
	public function model_advanced_search($access, $include, $exclude, $category, $priceFrom, $priceTo, $condition, $locationFrom, $locationTo)
	{
		
		if($access == '1')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND title not like ? AND id in (SELECT id from advertisement where subCatID = ? AND conditions = ? AND price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?))))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%', $category, $condition,$priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '2')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND title not like ? AND id in (SELECT id from advertisement where subCatID = ? AND price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?))))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%', $category, $priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '3')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND title not like ? AND id in (SELECT id from advertisement where subCatID = ? AND conditions = ? AND location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%', $category, $condition, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '4')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND title not like ? AND id in (SELECT id from advertisement where subCatID = ? AND location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%', $category, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '5')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND title not like ? AND id in (SELECT id from advertisement where subCatID = ? AND conditions = ? AND price in (Select price from advertisement where price between ? and ? )))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%', $category, $condition, $priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '6')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND title not like ? AND id in (SELECT id from advertisement where subCatID = ? AND price in (Select price from advertisement where price between ? and ? )))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%', $category, $priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '7')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND title not like ? AND id in (SELECT id from advertisement where subCatID = ? AND conditions = ? ))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%', $category, $condition));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '8')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND title not like ? AND id in (SELECT id from advertisement where subCatID = ?))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%', $category));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '9')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE description like ? AND description not like ? AND id in (SELECT id from advertisement where subCatID = ? AND conditions = ? AND price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?))))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%', $category, $condition,$priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '10')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE description like ? AND description not like ? AND id in (SELECT id from advertisement where subCatID = ? AND price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?))))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%', $category, $priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '11')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE description like ? AND description not like ? AND id in (SELECT id from advertisement where subCatID = ? AND conditions = ? and location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%', $category, $condition, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '12')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE description like ? AND description not like ? AND id in (SELECT id from advertisement where subCatID = ? and location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%', $category, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '13')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE description like ? AND description not like ? AND id in (SELECT id from advertisement where subCatID = ? AND conditions = ? AND price in (Select price from advertisement where price between ? and ? )))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%', $category, $condition,$priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '14')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE description like ? AND description not like ? AND id in (SELECT id from advertisement where subCatID = ? AND price in (Select price from advertisement where price between ? and ? )))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%', $category, $priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '15')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE description like ? AND description not like ? AND id in (SELECT id from advertisement where subCatID = ? AND conditions = ? ))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%', $category, $condition));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '16')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE description like ? AND description not like ? AND id in (SELECT id from advertisement where subCatID = ? ))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%', $category));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '17')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND title not like ? AND description like ? AND description not like ? AND id in (SELECT id from advertisement where subCatID = ? AND conditions = ? AND price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?))))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%','%'.$include.'%', '%'.$exclude.'%', $category, $condition,$priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '18')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND title not like ? AND description like ? AND description not like ? AND id in (SELECT id from advertisement where subCatID = ? AND price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?))))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%','%'.$include.'%', '%'.$exclude.'%', $category, $priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '19')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND title not like ? AND description like ? AND description not like ? AND id in (SELECT id from advertisement where subCatID = ? AND conditions = ? AND location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%','%'.$include.'%', '%'.$exclude.'%', $category, $condition, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '20')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND title not like ? AND description like ? AND description not like ? AND id in (SELECT id from advertisement where subCatID = ? AND location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%','%'.$include.'%', '%'.$exclude.'%', $category, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '21')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND title not like ? AND description like ? AND description not like ? AND id in (SELECT id from advertisement where subCatID = ? AND conditions = ? AND price in (Select price from advertisement where price between ? and ? )))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%','%'.$include.'%', '%'.$exclude.'%', $category, $condition, $priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '22')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND title not like ? AND description like ? AND description not like ? AND id in (SELECT id from advertisement where subCatID = ? AND price in (Select price from advertisement where price between ? and ? )))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%','%'.$include.'%', '%'.$exclude.'%', $category, $priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '23')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND title not like ? AND description like ? AND description not like ? AND id in (SELECT id from advertisement where subCatID = ? AND conditions = ? ))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%','%'.$include.'%', '%'.$exclude.'%', $category, $condition));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '24')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND title not like ? AND description like ? AND description not like ? AND id in (SELECT id from advertisement where subCatID = ?))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%','%'.$include.'%', '%'.$exclude.'%', $category));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '25')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND title not like ? AND id in (SELECT id from advertisement where conditions = ? AND price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?))))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%', $condition, $priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '26')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND title not like ? AND id in (SELECT id from advertisement where price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?))))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%', $priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '27')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND title not like ? AND id in (SELECT id from advertisement where conditions = ? AND location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%', $condition, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '28')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND title not like ? AND id in (SELECT id from advertisement where location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%', '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '29')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND title not like ? AND id in (SELECT id from advertisement where conditions = ? AND price in (Select price from advertisement where price between ? and ? )))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%', $condition, $priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '30')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND title not like ? AND id in (SELECT id from advertisement where price in (Select price from advertisement where price between ? and ? )))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%', $priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '31')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND title not like ? AND id in (SELECT id from advertisement where conditions = ? ))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%', $condition));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '32')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND title not like ? )"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '33')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE description like ? AND description not like ? AND id in (SELECT id from advertisement where  conditions = ? AND price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?))))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%', $condition,$priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '34')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE description like ? AND description not like ? AND id in (SELECT id from advertisement where price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?))))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%', $priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '35')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE description like ? AND description not like ? AND id in (SELECT id from advertisement where conditions = ? and location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%', $condition, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '36')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE description like ? AND description not like ? AND id in (SELECT id from advertisement where location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%', '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '37')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE description like ? AND description not like ? AND id in (SELECT id from advertisement where conditions = ? AND price in (Select price from advertisement where price between ? and ? )))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%', $condition,$priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '38')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE description like ? AND description not like ? AND id in (SELECT id from advertisement where price in (Select price from advertisement where price between ? and ? )))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%', $priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '39')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE description like ? AND description not like ? AND id in (SELECT id from advertisement where conditions = ? ))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%', $condition));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '40')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE description like ? AND description not like ? )"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%', $category));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '41')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND title not like ? AND description like ? AND description not like ? AND id in (SELECT id from advertisement where conditions = ? AND price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?))))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%','%'.$include.'%', '%'.$exclude.'%', $condition,$priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '42')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND title not like ? AND description like ? AND description not like ? AND id in (SELECT id from advertisement where price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?))))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%','%'.$include.'%', '%'.$exclude.'%', $priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '43')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND title not like ? AND description like ? AND description not like ? AND id in (SELECT id from advertisement where conditions = ? AND location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%','%'.$include.'%', '%'.$exclude.'%', $condition, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '44')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND title not like ? AND description like ? AND description not like ? AND id in (SELECT id from advertisement where location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%','%'.$include.'%', '%'.$exclude.'%', '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '45')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND title not like ? AND description like ? AND description not like ? AND id in (SELECT id from advertisement where conditions = ? AND price in (Select price from advertisement where price between ? and ? )))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%','%'.$include.'%', '%'.$exclude.'%', $condition, $priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '46')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND title not like ? AND description like ? AND description not like ? AND id in (SELECT id from advertisement where price in (Select price from advertisement where price between ? and ? )))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%','%'.$include.'%', '%'.$exclude.'%', $priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '47')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND title not like ? AND description like ? AND description not like ? AND id in (SELECT id from advertisement where conditions = ? ))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%','%'.$include.'%', '%'.$exclude.'%', $condition));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '48')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND title not like ? AND description like ? AND description not like ?)"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$exclude.'%','%'.$include.'%', '%'.$exclude.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '49')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND id in (SELECT id from advertisement where subCatID = ? AND conditions = ? AND price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?))))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', $category, $condition,$priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '50')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND id in (SELECT id from advertisement where subCatID = ? AND price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?))))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', $category, $priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '51')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND id in (SELECT id from advertisement where subCatID = ? AND conditions = ? AND location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', $category, $condition, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '52')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND id in (SELECT id from advertisement where subCatID = ? AND location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', $category, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '53')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND id in (SELECT id from advertisement where subCatID = ? AND conditions = ? AND price in (Select price from advertisement where price between ? and ? )))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', $category, $condition, $priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '54')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND id in (SELECT id from advertisement where subCatID = ? AND price in (Select price from advertisement where price between ? and ? )))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', $category, $priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '55')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND id in (SELECT id from advertisement where subCatID = ? AND conditions = ? ))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', $category, $condition));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '56')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND id in (SELECT id from advertisement where subCatID = ?))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', $category));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '57')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE description like ? AND id in (SELECT id from advertisement where subCatID = ? AND conditions = ? AND price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?))))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', $category, $condition,$priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '58')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE description like ? AND id in (SELECT id from advertisement where subCatID = ? AND price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?))))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', $category, $priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '59')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE description like ? AND id in (SELECT id from advertisement where subCatID = ? AND conditions = ? and location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', $category, $condition, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '60')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE description like ? AND id in (SELECT id from advertisement where subCatID = ? and location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', $category, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '61')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE description like ? AND id in (SELECT id from advertisement where subCatID = ? AND conditions = ? AND price in (Select price from advertisement where price between ? and ? )))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', $category, $condition,$priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '62')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE description like ? AND id in (SELECT id from advertisement where subCatID = ? AND price in (Select price from advertisement where price between ? and ? )))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', $category, $priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '63')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE description like ? AND id in (SELECT id from advertisement where subCatID = ? AND conditions = ? ))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', $category, $condition));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '64')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE description like ? AND id in (SELECT id from advertisement where subCatID = ? ))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', $category));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '65')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND description like ? AND description not like ? AND id in (SELECT id from advertisement where subCatID = ? AND conditions = ? AND price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?))))"; 

			$query = $this->db->query($sql, array('%'.$include.'%','%'.$include.'%', '%'.$exclude.'%', $category, $condition,$priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '66')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND description like ? AND description not like ? AND id in (SELECT id from advertisement where subCatID = ? AND price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?))))"; 

			$query = $this->db->query($sql, array('%'.$include.'%','%'.$include.'%', '%'.$exclude.'%', $category, $priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '67')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND description like ? AND description not like ? AND id in (SELECT id from advertisement where subCatID = ? AND conditions = ? AND location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array('%'.$include.'%','%'.$include.'%', '%'.$exclude.'%', $category, $condition, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '68')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND description like ? AND description not like ? AND id in (SELECT id from advertisement where subCatID = ? AND location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array('%'.$include.'%','%'.$include.'%', '%'.$exclude.'%', $category, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '69')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND description like ? AND description not like ? AND id in (SELECT id from advertisement where subCatID = ? AND conditions = ? AND price in (Select price from advertisement where price between ? and ? )))"; 

			$query = $this->db->query($sql, array('%'.$include.'%','%'.$include.'%', '%'.$exclude.'%', $category, $condition, $priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '70')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND description like ? AND description not like ? AND id in (SELECT id from advertisement where subCatID = ? AND price in (Select price from advertisement where price between ? and ? )))"; 

			$query = $this->db->query($sql, array('%'.$include.'%','%'.$include.'%', '%'.$exclude.'%', $category, $priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '71')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND description like ? AND description not like ? AND id in (SELECT id from advertisement where subCatID = ? AND conditions = ? ))"; 

			$query = $this->db->query($sql, array('%'.$include.'%','%'.$include.'%', '%'.$exclude.'%', $category, $condition));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '72')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND description like ? AND description not like ? AND id in (SELECT id from advertisement where subCatID = ?))"; 

			$query = $this->db->query($sql, array('%'.$include.'%','%'.$include.'%', '%'.$exclude.'%', $category));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '73')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND id in (SELECT id from advertisement where conditions = ? AND price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?))))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', $condition, $priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '74')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND id in (SELECT id from advertisement where price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?))))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', $priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '75')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND id in (SELECT id from advertisement where conditions = ? AND location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', $condition, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '76')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND id in (SELECT id from advertisement where location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '77')
		{

			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND id in (SELECT id from advertisement where conditions = ? AND price in (Select price from advertisement where price between ? and ? )))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', $condition, $priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '78')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND id in (SELECT id from advertisement where price in (Select price from advertisement where price between ? and ? )))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', $priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '79')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND id in (SELECT id from advertisement where conditions = ? ))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', $condition));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '80')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? )"; 

			$query = $this->db->query($sql, array('%'.$include.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '81')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE description like ? AND id in (SELECT id from advertisement where  conditions = ? AND price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?))))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', $condition,$priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '82')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE description like ? AND id in (SELECT id from advertisement where price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?))))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', $priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '83')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE description like ? AND id in (SELECT id from advertisement where conditions = ? and location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', $condition, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '84')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE description like ? AND id in (SELECT id from advertisement where location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '85')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE description like ? AND id in (SELECT id from advertisement where conditions = ? AND price in (Select price from advertisement where price between ? and ? )))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', $condition,$priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '86')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE description like ? AND id in (SELECT id from advertisement where price in (Select price from advertisement where price between ? and ? )))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', $priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '87')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE description like ? AND id in (SELECT id from advertisement where conditions = ? ))"; 

			$query = $this->db->query($sql, array('%'.$include.'%', $condition));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '88')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE description like ? )"; 

			$query = $this->db->query($sql, array('%'.$include.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '89')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND description like ? AND id in (SELECT id from advertisement where conditions = ? AND price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?))))"; 

			$query = $this->db->query($sql, array('%'.$include.'%','%'.$include.'%', $condition,$priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '90')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND description like ? AND id in (SELECT id from advertisement where price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?))))"; 

			$query = $this->db->query($sql, array('%'.$include.'%','%'.$include.'%', $priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '91')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND description like ? AND id in (SELECT id from advertisement where conditions = ? AND location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array('%'.$include.'%','%'.$include.'%', $condition, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '92')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND description like ? AND id in (SELECT id from advertisement where location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array('%'.$include.'%','%'.$include.'%', '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '93')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND description like ? AND id in (SELECT id from advertisement where conditions = ? AND price in (Select price from advertisement where price between ? and ? )))"; 

			$query = $this->db->query($sql, array('%'.$include.'%','%'.$include.'%', $condition, $priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '94')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND description like ? AND id in (SELECT id from advertisement where price in (Select price from advertisement where price between ? and ? )))"; 

			$query = $this->db->query($sql, array('%'.$include.'%','%'.$include.'%', $priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '95')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND description like ? AND id in (SELECT id from advertisement where conditions = ? ))"; 

			$query = $this->db->query($sql, array('%'.$include.'%','%'.$include.'%', $condition));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '96')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id FROM advertisement WHERE title like ? AND description like ? )"; 

			$query = $this->db->query($sql, array('%'.$include.'%','%'.$include.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '97')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND conditions = ? AND price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array($category, $condition,$priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '98')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array($category, $priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '99')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND conditions = ? AND location in (Select location from advertisement where location like ? or location like ?))"; 

			$query = $this->db->query($sql, array($category, $condition, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '100')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND location in (Select location from advertisement where location like ? or location like ?))"; 

			$query = $this->db->query($sql, array($category, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '101')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND conditions = ? AND price in (Select price from advertisement where price between ? and ? ))"; 

			$query = $this->db->query($sql, array($category, $condition, $priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '102')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND price in (Select price from advertisement where price between ? and ? ))"; 

			$query = $this->db->query($sql, array($category, $priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '103')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND conditions = ? )"; 

			$query = $this->db->query($sql, array($category, $condition));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '104')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ?)"; 

			$query = $this->db->query($sql, array($category));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '105')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND conditions = ? AND price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array($category, $condition,$priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '106')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array($category, $priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '107')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND conditions = ? and location in (Select location from advertisement where location like ? or location like ?))"; 

			$query = $this->db->query($sql, array($category, $condition, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '108')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? and location in (Select location from advertisement where location like ? or location like ?))"; 

			$query = $this->db->query($sql, array($category, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '109')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND conditions = ? AND price in (Select price from advertisement where price between ? and ? ))"; 

			$query = $this->db->query($sql, array($category, $condition,$priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '110')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND price in (Select price from advertisement where price between ? and ? ))"; 

			$query = $this->db->query($sql, array($category, $priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '111')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND conditions = ? )"; 

			$query = $this->db->query($sql, array($category, $condition));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '112')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? )"; 

			$query = $this->db->query($sql, array($category));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '113')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND conditions = ? AND price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array($category, $condition,$priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '114')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array($category, $priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '115')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND conditions = ? AND location in (Select location from advertisement where location like ? or location like ?))"; 

			$query = $this->db->query($sql, array($category, $condition, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '116')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND location in (Select location from advertisement where location like ? or location like ?))"; 

			$query = $this->db->query($sql, array($category, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '117')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND conditions = ? AND price in (Select price from advertisement where price between ? and ? ))"; 

			$query = $this->db->query($sql, array($category, $condition, $priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '118')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND price in (Select price from advertisement where price between ? and ? ))"; 

			$query = $this->db->query($sql, array($category, $priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '119')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND conditions = ? )"; 

			$query = $this->db->query($sql, array($category, $condition));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '120')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ?)"; 

			$query = $this->db->query($sql, array($category));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '121')
		{
			
			$sql = "select * from advertisement where status = '1' and id in  (SELECT id from advertisement where conditions = ? AND price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array($condition, $priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '122')
		{
			$sql = "select * from advertisement where status = '1' and id in  (SELECT id from advertisement where price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array($priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '123')
		{
			$sql = "select * from advertisement where status = '1' and id in  (SELECT id from advertisement where conditions = ? AND location in (Select location from advertisement where location like ? or location like ?))"; 

			$query = $this->db->query($sql, array($condition, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '124')
		{
			$sql = "select * from advertisement where status = '1' and id in  (SELECT id from advertisement where location in (Select location from advertisement where location like ? or location like ?))"; 

			$query = $this->db->query($sql, array('%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '125')
		{

			
			$sql = "select * from advertisement where status = '1' and id in  (SELECT id from advertisement where conditions = ? AND price in (Select price from advertisement where price between ? and ? ))"; 

			$query = $this->db->query($sql, array($condition, $priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '126')
		{
			
			$sql = "select * from advertisement where status = '1' and id in  (SELECT id from advertisement where price in (Select price from advertisement where price between ? and ? ))"; 

			$query = $this->db->query($sql, array($priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '127')
		{
			
			$sql = "select * from advertisement where status = '1' and id in  (SELECT id from advertisement where conditions = ? )"; 

			$query = $this->db->query($sql, array($condition));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '128')
		{
			
			$sql = "select * from advertisement where status = '1'"; 

			$query = $this->db->query($sql);//==============================================================================
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '129')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where  conditions = ? AND price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array($condition,$priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '130')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array($priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '131')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where conditions = ? and location in (Select location from advertisement where location like ? or location like ?))"; 

			$query = $this->db->query($sql, array($condition, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '132')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where location in (Select location from advertisement where location like ? or location like ?))"; 

			$query = $this->db->query($sql, array('%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '133')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where conditions = ? AND price in (Select price from advertisement where price between ? and ? ))"; 

			$query = $this->db->query($sql, array($condition,$priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '134')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where price in (Select price from advertisement where price between ? and ? ))"; 

			$query = $this->db->query($sql, array($priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '135')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where conditions = ? )"; 

			$query = $this->db->query($sql, array($condition));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '136')
		{
			
			$sql = "select * from advertisement where status = '1'"; 

			$query = $this->db->query($sql);
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '137')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where conditions = ? AND price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array($condition,$priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '138')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array($priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '139')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where conditions = ? AND location in (Select location from advertisement where location like ? or location like ?))"; 

			$query = $this->db->query($sql, array($condition, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '140')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where location in (Select location from advertisement where location like ? or location like ?))"; 

			$query = $this->db->query($sql, array('%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '141')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where conditions = ? AND price in (Select price from advertisement where price between ? and ? ))"; 

			$query = $this->db->query($sql, array($condition, $priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '142')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where price in (Select price from advertisement where price between ? and ? ))"; 

			$query = $this->db->query($sql, array($priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '143')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where conditions = ? )"; 

			$query = $this->db->query($sql, array($condition));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '144')
		{
			
			$sql = "select * from advertisement where status = '1' "; 

			$query = $this->db->query($sql);
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '145')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND conditions = ? AND price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array($category, $condition,$priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '146')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array($category, $priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '147')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND conditions = ? AND location in (Select location from advertisement where location like ? or location like ?))"; 

			$query = $this->db->query($sql, array($category, $condition, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '148')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND location in (Select location from advertisement where location like ? or location like ?))"; 

			$query = $this->db->query($sql, array($category, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '149')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND conditions = ? AND price in (Select price from advertisement where price between ? and ? ))"; 

			$query = $this->db->query($sql, array($category, $condition, $priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '150')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND price in (Select price from advertisement where price between ? and ? ))"; 

			$query = $this->db->query($sql, array($category, $priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '151')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND conditions = ? )"; 

			$query = $this->db->query($sql, array($category, $condition));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '152')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ?)"; 

			$query = $this->db->query($sql, array($category));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '153')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND conditions = ? AND price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array($category, $condition,$priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '154')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array($category, $priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '155')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND conditions = ? and location in (Select location from advertisement where location like ? or location like ?))"; 

			$query = $this->db->query($sql, array($category, $condition, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '156')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? and location in (Select location from advertisement where location like ? or location like ?))"; 

			$query = $this->db->query($sql, array($category, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '157')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND conditions = ? AND price in (Select price from advertisement where price between ? and ? ))"; 

			$query = $this->db->query($sql, array($category, $condition,$priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '158')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND price in (Select price from advertisement where price between ? and ? ))"; 

			$query = $this->db->query($sql, array($category, $priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '159')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND conditions = ? )"; 

			$query = $this->db->query($sql, array($category, $condition));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '160')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? )"; 

			$query = $this->db->query($sql, array($category));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '161')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND conditions = ? AND price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array($category, $condition,$priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '162')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array($category, $priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '163')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND conditions = ? AND location in (Select location from advertisement where location like ? or location like ?))"; 

			$query = $this->db->query($sql, array($category, $condition, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '164')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND location in (Select location from advertisement where location like ? or location like ?))"; 

			$query = $this->db->query($sql, array($category, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '165')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND conditions = ? AND price in (Select price from advertisement where price between ? and ? ))"; 

			$query = $this->db->query($sql, array($category, $condition, $priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '166')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND price in (Select price from advertisement where price between ? and ? ))"; 

			$query = $this->db->query($sql, array($category, $priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '167')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ? AND conditions = ? )"; 

			$query = $this->db->query($sql, array($category, $condition));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '168')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where subCatID = ?)"; 

			$query = $this->db->query($sql, array($category));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '169')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where conditions = ? AND price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array($condition, $priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '170')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array($priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '171')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where conditions = ? AND location in (Select location from advertisement where location like ? or location like ?))"; 

			$query = $this->db->query($sql, array($condition, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '172')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where location in (Select location from advertisement where location like ? or location like ?))"; 

			$query = $this->db->query($sql, array('%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '173')
		{

			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where conditions = ? AND price in (Select price from advertisement where price between ? and ? ))"; 

			$query = $this->db->query($sql, array($condition, $priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '174')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where price in (Select price from advertisement where price between ? and ? ))"; 

			$query = $this->db->query($sql, array($priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '175')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where conditions = ? )"; 

			$query = $this->db->query($sql, array($condition));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '176')
		{
			
			$sql = "select * from advertisement where status = '1' "; 

			$query = $this->db->query($sql);
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '177')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where  conditions = ? AND price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array($condition,$priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '178')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array($priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '179')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where conditions = ? and location in (Select location from advertisement where location like ? or location like ?))"; 

			$query = $this->db->query($sql, array($condition, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '180')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where location in (Select location from advertisement where location like ? or location like ?))"; 

			$query = $this->db->query($sql, array('%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '181')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where conditions = ? AND price in (Select price from advertisement where price between ? and ? ))"; 

			$query = $this->db->query($sql, array($condition,$priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '182')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where price in (Select price from advertisement where price between ? and ? ))"; 

			$query = $this->db->query($sql, array($priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '183')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where conditions = ? )"; 

			$query = $this->db->query($sql, array($condition));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '184')
		{
			
			$sql = "select * from advertisement where status = '1' "; 

			$query = $this->db->query($sql);
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '185')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where conditions = ? AND price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array($condition,$priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '186')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where price in (Select price from advertisement where price between ? and ? and location in (Select location from advertisement where location like ? or location like ?)))"; 

			$query = $this->db->query($sql, array($priceFrom, $priceTo, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '187')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where conditions = ? AND location in (Select location from advertisement where location like ? or location like ?))"; 

			$query = $this->db->query($sql, array($condition, '%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '188')
		{
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where location in (Select location from advertisement where location like ? or location like ?))"; 

			$query = $this->db->query($sql, array('%'.$locationFrom.'%', '%'.$locationTo.'%'));
			//$query = $this->db->get('advertisement');
			return $query->result();
		}
		else if($access == '189')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where conditions = ? AND price in (Select price from advertisement where price between ? and ? ))"; 

			$query = $this->db->query($sql, array($condition, $priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '190')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where price in (Select price from advertisement where price between ? and ? ))"; 

			$query = $this->db->query($sql, array($priceFrom, $priceTo));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '191')
		{
			
			$sql = "select * from advertisement where status = '1' and id in (SELECT id from advertisement where conditions = ? )"; 

			$query = $this->db->query($sql, array($condition));
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		else if($access == '192')
		{
			
			$sql = "select * from advertisement where status = '1' "; 

			$query = $this->db->query($sql);
			//$query = $this->db->get('advertisement');
			return $query->result();
			
		}
		
		
		
		
		
		
		
		
		
		
	}
		
	
	
	
	
}














?>