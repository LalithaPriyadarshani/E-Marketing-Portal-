 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ManageCatergory extends CI_Controller {


	
 function index(){
$this->load->helper('url');
$this->load->library('form_validation');	 
$this->load->library('table');
$this->load->helper('html');
$this->load->library('session');

$this->loadData();

           
$data['query']= $this->category_model->getAllCat();

 }
 
 
 public function loadData(){
	 $this->load->model('db_model');
	$data['query'] = $this->db_model->getCategory();	

     $this->load->model('category_model');

//$data = $this->category_model->general();
$data['queryc'] = $this->category_model->get_category();
//$data['subcats']=$this->category_model->selectSubCatergories(); 

	
	
$this->load->view('Catergory',$data); 
	 
 }
 
 
 public function save(){ //insert new category
 
             $this->load->helper(array('form', 'url'));
			 $this->load->library('form_validation');
			 $name;
			 
			  $name = $this->input->post('txtCatName');

			  $this->form_validation->set_rules('txtCatName', 'Category', 'required'); //validate empty text box
			  //$this->form_validation->set_error_delimiters ('<div class="alert">','</div>');
			  
			   if ($this->form_validation->run() == FALSE)
 						{
 					     
                           
						 echo '<script>alert("You Have failed to added this Record try again!");</script>';
			
						  redirect('manageCatergory/', 'refresh');
						  //$this->load->view('errorTest',$msg);
					  }
               else
             {
            
            $this->load->model('category_model');        
          
			$data = array(
		
			'cat_name' => $name
			);
			
			$this->category_model->insert_category($data);
			
			   echo '<script>alert("You Have Successfully added this Record!");</script>';
			redirect('manageCatergory/', 'refresh');

			
			 }
 }
 
  public function getCatName(){ //get category name and insert sub category details
	 
	$catName = $this->input->post('txtCat');
	$this->load->model('category_model');
	
	$data = $this->category_model->getId($catName);// get id. it is an array
	
	$cid;
	
	foreach($data as $row) //get id to the variable
	{
		$cid = $row->id;
	}
		
	
	
    	$subCatName= $this->input->post('txtSubCat');
	
	 	$this->load->library('form_validation');
	 
		  $this->form_validation->set_rules('txtSubCat','Category','required');
	
	     if ($this->form_validation->run() == TRUE){
	         $data = array(  // data to the arreay
		   'cat_id' => $cid,
		   'sub_name'=> $subCatName
		);
		
	
		
   $this->category_model->insert_SubCategory($data); //insert data   
	
	 echo '<script>alert("You Have Successfully added this Record!");</script>';
	redirect('manageCatergory/', 'refresh');
	}
	
	else{
		
		 echo '<script>alert("You Have failed to added this Record!");</script>';
		 redirect('manageCatergory/', 'refresh');
			
	}
 }


 
 public function Edit(){
	
	$catName = $this->input->post('cat');
    $id = $this->input->post('id');
	$this->load->model('category_model');
	
	
		
   $this->category_model->update_catName($id,$catName);
	//echo $cid;
	$this->index();
	 
 }
 
 
 
 
 public function delete ($id){
	 
	 $this->load->model('category_model');
	 $this->category_model-> deleteCategory($id);
     $this->index();
	 
 }
 
 public function loadSubcats($catName){
	 
	  $this->load->model('category_model');
	$data['query']= $this->category_model->selectSubCatergories($catName);
	
    $this->load->view('SubCatergory',$data);
	
	$this->load->library('session');
	 
    $this->session->set_userdata('refered_from', $_SERVER['HTTP_REFERER']);
	 
 }
 
 public function Editsubcat(){
	
	$subcatName = $this->input->post('subcat');
    $id = $this->input->post('id');
	$this->load->model('category_model');
	
	
		
   $this->category_model->update_subcatName($id,$subcatName);
	//echo $cid;
	$this->load->library('session');
	redirect($this->session->userdata('refered_from')); //redirect to the previous page
 }
  public function deleteSubCat ($id){
	 
	 $this->load->model('category_model');
	 $this->category_model-> deleteSubCategory($id);
	 
	$this->load->library('session');
	redirect($this->session->userdata('refered_from')); //redirect to the previous page
	
     }
 	
 
 
  
 
 

}


?>