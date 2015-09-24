<?php		 if (!defined('BASEPATH')) exit('No direct script access allowed');
		class Post_Ads_Cont  extends CI_Controller
		{
	        function __construct()
    		{
        		parent::__construct();

	    	    $this->load->helper('form');
				$this->load->helper('url');
				$this->load->library('form_validation');
				$this->load->library('upload');
				$this->load->database();
		
			}  
				public function index()
				{
				if(isset($_SESSION['uname']))
				{			
				$this->load->model('post_ads_model');
			
				$data['base_url'] = base_url();
				 $this->load->model('db_model');
	              $data['query'] = $this->db_model->getCategory();	
     				
						$data['queryc'] = $this->post_ads_model->getCategory();
						$data['subcat']=$this->post_ads_model->getSubCategory();
						$this->load->view('post_ads',$data,array('error'=>''));			
		
				}
			else
			{
				$this->load->view('login');	
			}
        }	


/*		public function test(){
		
			if (isset($_POST['submit']))
    		{
				$this->load->model('post_ads_model');	
				$category=$this->input->post('category');
				$subcategory = $this->input->post('subcategory');
				//$subname= $this->input->post('');
				$this->post_ads_model->uploadFile($category,$subcategory);	
				$this->load->view('post_ads_success',$data);
			}
			
		}*/
		
		//update advertisement data
		public function updateAds($adId){
			if(isset($_POST['submit'])){
			$this->load->model('post_ads_model');
				
				
				//echo $adId;
				$title= $this->input->post('title');
				//echo $title;
				$name = $this->input->post('name');
				$email = $this->input->post('email');
				$phoneNo = $this->input->post('phoneNo');
				$location=$this->input->post('location');	              
				$description=$this->input->post('comment');
				$price=  $this->input->post('price');
				$day= date('y-m-d');
				$cusId = $_SESSION['usrID'];
				
				//echo $adId,$title,$name,$email,$phoneNo,$location,$description,$price,$day,$cusId;
				
				$data=$this->post_ads_model->update_Ads($adId,$title,$name,$email,$phoneNo,$location,$description,$price,$day,$cusId);	
				$this->load->model('upload_model');
				$data['query']=$this->upload_model->getStatus();			
				$this->load->view('upload_view',$data);
				//$this->load->view('',$data);//=====================================================================
			}
		}
		//***
	/*	function getSubCatId($subcategory)// to fill ads table
		{
			$this->load->model('post_ads_model');
			 $data=$this->post_ads_model->getSubCat($subcategory);
			
			 if($data!=0){}
			 foreach($data as $id){
			 echo $data['subcatname']= $id->sub_name;
			 //echo $data['cat_id']= $id->cat_id;
			  return $data;
			  }
			  
		}*/
		
			//*********
	
		public function populateAds($AdId){ //  from upload_view to post ads view.function for user to edit my ads
			$this->load->model('post_ads_model');
			$myAd =$this->post_ads_model->getAdData($AdId);
			//$data['query'] = $this->post_ads_model->getAdData($AdId);
			
			if($myAd!=NULL){
	
				foreach($myAd as $row){
	
				
					$subcatname;
					$catname;
					$data=$this->post_ads_model->getSubCat($row->subCatID);			
			 			if($data!=0){}
			 				foreach($data as $id){
			 		$subcatname= $data['subcatname']= $id->sub_name;
					$catname= $data['catname']= $id->cat_name;
							}
					
					$data['subcategory']=$subcatname;
					$data['category']=$catname;
					$data['title']=$row->title;
					$data['type']=$row->Adtype;					
					$data['name']=$row->name;
					$data['email']=$row->email;
					$data['phoneNo']=$row->phone;
					$data['location']=$row->location;
					$data['description']=$row->description;
					$data['price']=$row->price;			
				}
                   
				$this->load->view('edit_ads',$data,array('error'=>''));	
			}
			else {echo 'No advertisement data';}

	}
	//***end edit ads view***//
//****************************post ads view *********************//

		function fillSubCatDb($data){
					
			$this->load->model('post_ads_model');//img count, img ids
					
			$count=$data['imgcount'];
			$count;
			$lastInsertedID= $data['img'];
			
			for($i=$count;$i>0;$i--){
				$imgsubId= $data['img'.$i];
				if($lastInsertedID!=NULL){
						
						$this->post_ads_model->updateAdId($lastInsertedID,$imgsubId);
					}	
					else{ echo 'please post an advertisement to prceed';}
			}
			
		}
		/**/
		/* ----*/
	
	function uploadImage(){
		$checked = $this->input->post('checkbox',TRUE);
	 if (isset($_POST['submit']))
    {
		 if ($checked==TRUE){
		$imgcount=0;
				$this->load->model('post_ads_model');			
				$this->load->library('table');
				$this->load->library('session');
					
				$this->form_validation->set_rules('title','Title (eg: Sony Xperia Brand New phone for sale)','trim|required');//				
				$this->form_validation->set_rules('name','Name','trim|required');
				$this->form_validation->set_rules('email','email( eg:john@gmail.com)','trim|required|valid_email');
				$this->form_validation->set_rules('phoneNo','phone Number','trim|required');
				
				$this->form_validation->set_rules('price','price details','trim|required');
				
				if($this->form_validation->run()==false)
				{
					$this->index();							
				}
				else
				{
					$category=$this->input->post('category');
					$subcategory=$this->input->post('Subcategory');	
					$condition = $this->input->post('condition');			
					$title= $this->input->post('title');
					$adtype=$this->input->post('type');
					$name = $this->input->post('name');
					$email = $this->input->post('email');
					$phoneNo = $this->input->post('phoneNo');
					$location=$this->input->post('location');	              
					$description=$this->input->post('comment');
					$price=  $this->input->post('price');
					$day= date('y-m-d');
					$cusId = $_SESSION['usrID'];
							
				
				
				
        		for($i=1;$i<=5;$i++) //no of images
				{
			
					if (!empty($_FILES['userfile'.$i]['name']))
        			{
	       			 $config['upload_path'] =   'addImages/';
					 $config['allowed_types'] = 'gif|jpg|png|jpeg';
			         $config['max_size'] = '5000';
        			 $config['max_width']  = '1024';
		        	 $config['max_height']  = '768';       

	        		 $this->upload->initialize($config);   
					   
    		    	$imgcount++;
								
				
			
					if($this->upload->do_upload('userfile'.$i))  //File1,File2 are filenames
		  			{				    
						$img = $this->upload->data();
	 					$file_name[$i] = $img['file_name'];	
						$data['Image'] = implode(',',$file_name);
						
								
						//call thumbnail func
					
								$this->createThumbnail($img['file_name']);
								$data['uploadInfo'] = $img;
								$data['thumbnail_name'] = $img['raw_name']. '_thumb' .$img['file_ext'];
					
						switch($i){
							case 1:
							   $file_name1 = $img['file_name'];              				
							   $data['img1']=$this->post_ads_model->uploadFile1($file_name1);
							   
							break;
							case 2:
								$file_name1 = $img['file_name'];                				
               					$data['img2']=$this->post_ads_model->uploadFile2($file_name1);
																								
							break;
							case 3:
								$file_name1 = $img['file_name'];	                				
               					$data['img3']=$this->post_ads_model->uploadFile3($file_name1);	
							break;
							case 4:
								$file_name1 = $img['file_name'];	                				
               					$data['img4']=$this->post_ads_model->uploadFile4($file_name1);	
							break;
							case 5:
								$file_name1 = $img['file_name'];	                				
               					$data['img5']=$this->post_ads_model->uploadFile5($file_name1);	
							break;
							}
							
						//find the default image
				 		switch($this->input->post("mode"))
							{
								case "default1":
								$defaultimg = $img['file_name'];
								break;
								case "default2":
								$defaultimg = $img['file_name'];
								break;
								case "default3":
								$defaultimg = $img['file_name'];
								break;
								case "default4":
								$defaultimg = $img['file_name'];
								break;
								case "default5":
								$defaultimg = $img['file_name'];
								break;							
							}
							
							
					}//if upload()
					else
					{
						$this->upload->display_errors();	
					}
				} //end (!empty)
				if (empty($_FILES['userfile1']['name']))
        			{$data['Image'] = 'default.jpg';}
			}	//end for 
				
				$data['img']=$this->post_ads_model->uploadFile($data,$subcategory,$condition,$title,$adtype,$name,$email,$phoneNo,$location,$description,$price,$day,$cusId,$defaultimg);
				$data['imgcount']=$imgcount;	
				
				$this->fillSubCatDb($data);
				
				$this->load->model('upload_model');
			$data['query']=$this->upload_model->getStatus();
			redirect('PaidAdd_controler/');
				}
		 }
				
				else{
					
				$imgcount=0;
				$this->load->model('post_ads_model');			
				$this->load->library('table');
				$this->load->library('session');
					
				$this->form_validation->set_rules('title','Title (eg: Sony Xperia Brand New phone for sale)','trim|required');//				
				$this->form_validation->set_rules('name','Name','trim|required');
				$this->form_validation->set_rules('email','email( eg:john@gmail.com)','trim|required|valid_email');
				$this->form_validation->set_rules('phoneNo','phone Number','trim|required');
				
				$this->form_validation->set_rules('price','price details','trim|required');
				
				if($this->form_validation->run()==false)
				{
					$this->index();							
				}
				else
				{
					$category=$this->input->post('category');
					$subcategory=$this->input->post('Subcategory');	
					$condition = $this->input->post('condition');			
					$title= $this->input->post('title');
					$adtype=$this->input->post('type');
					$name = $this->input->post('name');
					$email = $this->input->post('email');
					$phoneNo = $this->input->post('phoneNo');
					$location=$this->input->post('location');	              
					$description=$this->input->post('comment');
					$price=  $this->input->post('price');
					$day= date('y-m-d');
					$cusId = $_SESSION['usrID'];
							
				
				
				
        		for($i=1;$i<=5;$i++) //no of images
				{
			
					if (!empty($_FILES['userfile'.$i]['name']))
        			{
	       			 $config['upload_path'] =   'addImages/';
					 $config['allowed_types'] = 'gif|jpg|png|jpeg';
			         $config['max_size'] = '5000';
        			 $config['max_width']  = '1024';
		        	 $config['max_height']  = '768';       

	        		 $this->upload->initialize($config);   
					   
    		    	$imgcount++;
								
				
			
					if($this->upload->do_upload('userfile'.$i))  //File1,File2 are filenames
		  			{				    
						$img = $this->upload->data();
	 					$file_name[$i] = $img['file_name'];	
						$data['Image'] = implode(',',$file_name);
						
								
						//call thumbnail func
					
								$this->createThumbnail($img['file_name']);
								$data['uploadInfo'] = $img;
								$data['thumbnail_name'] = $img['raw_name']. '_thumb' .$img['file_ext'];
					
						switch($i){
							case 1:
							   $file_name1 = $img['file_name'];              				
							   $data['img1']=$this->post_ads_model->uploadFile1($file_name1);
							   
							break;
							case 2:
								$file_name1 = $img['file_name'];                				
               					$data['img2']=$this->post_ads_model->uploadFile2($file_name1);
																								
							break;
							case 3:
								$file_name1 = $img['file_name'];	                				
               					$data['img3']=$this->post_ads_model->uploadFile3($file_name1);	
							break;
							case 4:
								$file_name1 = $img['file_name'];	                				
               					$data['img4']=$this->post_ads_model->uploadFile4($file_name1);	
							break;
							case 5:
								$file_name1 = $img['file_name'];	                				
               					$data['img5']=$this->post_ads_model->uploadFile5($file_name1);	
							break;
							}
							
						//find the default image
				 		switch($this->input->post("mode"))
							{
								case "default1":
								$defaultimg = $img['file_name'];
								break;
								case "default2":
								$defaultimg = $img['file_name'];
								break;
								case "default3":
								$defaultimg = $img['file_name'];
								break;
								case "default4":
								$defaultimg = $img['file_name'];
								break;
								case "default5":
								$defaultimg = $img['file_name'];
								break;							
							}
							
							
					}//if upload()
					else
					{
						$this->upload->display_errors();	
					}
				} //end (!empty)
				if (empty($_FILES['userfile1']['name']))
        			{$data['Image'] = 'default.jpg';}
			}	//end for 
				
				$data['img']=$this->post_ads_model->uploadFile($data,$subcategory,$condition,$title,$adtype,$name,$email,$phoneNo,$location,$description,$price,$day,$cusId,$defaultimg);
				$data['imgcount']=$imgcount;	
				
				$this->fillSubCatDb($data);
				
				$this->load->model('upload_model');
			$data['query']=$this->upload_model->getStatus();
			$this->load->view('upload_view',$data);			
			
		
				}
			}
		}
	}
	 //Create Thumbnail function

    function createThumbnail($filename)
    {
        $config['image_library']    = "gd2";  
        $config['source_image']     = 'addImages/'.$filename;     
        $config['create_thumb']     = TRUE;      
        $config['maintain_ratio']   = TRUE;      
        $config['width'] = "80";      
        $config['height'] = "80";
        $this->load->library('image_lib');
		$this->image_lib->resize();  
		$this->image_lib->clear();
		$this->image_lib->initialize($config);
        if(!$this->image_lib->resize())
        {
            echo $this->image_lib->display_errors();
        }
		
    
	}
	
	public function formValidate()
		{

				$this->load->helper(array('form','url'));					
				$this->load->library('form_validation');
				$this->form_validation->set_rules('title','Title (eg: Sony Xperia Brand New phone for sale)','trim|required');//				
				$this->form_validation->set_rules('name','Name','trim|required');
				$this->form_validation->set_rules('email','email( eg:john@gmail.com)','required|valid_email');
				$this->form_validation->set_rules('phoneNo','phone Number','required');
				$this->form_validation->set_rules('location','location','required');
				$this->form_validation->set_rules('price','price details','required');
				if($this->form_validation->run()==false)
				{
					echo "form validation";	
					$this->load->view('post_ads');//load the same page						
				}
			
		}// end validating function
		/* ----*/
		
		/*		
			$category =$this->input->post('txtCat');
		
			$this->load->model('email_model');
		
			$data = $this->email_model->getUsers($category);
	
	   
	
			foreach($data as $row)
			{
				   $config = Array(
        	            'protocol' => 'smtp',
            	        'smtp_host' => 'ssl://smtp.googlemail.com',
                	    'smtp_port' => 465,
                    	'smtp_user' => 'lalithapriyadarshani977@gmail.com',
                   		'smtp_pass' => '0726653224',
                    );	
		
				$this->load->library('email',$config);	
			 	$this->email->set_newline("\r\n");
				$this->email->from('lalithapriyadarshani977@gmail.com','GoBuySell');
				$this->email->to($row->Email);
				$this->email->subject('From GoBuySell');
				$description = $this->input->post('comment');
				$this->email->message($description);
				$this->email->send();
				echo 'successfully added';
		
		
			}*/
	//end insert()



	public function view($page='post_ads_success')
	{
				$this->load->helper(array('form','url'));
				if( ! file_exists('application/views/'.$page.'.php'))
				{
					//don't have page
					show_404();				
				}
				$this->load->view('post_ads_success');
			
	}//end view page

	//*************
	
}
?>
