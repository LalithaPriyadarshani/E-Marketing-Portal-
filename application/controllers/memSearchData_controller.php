
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'controllers/memSearch_controller.php';
class memSearchData_controller extends memSearch_controller {

function index(){
	

$this->load->helper('html');
 $this->load->model('db_model');
$data['query'] = $this->db_model->getCategory();	

$data['querym'] =$this->returnMail(); 
 //$this->load->model('memSearch_model');
//$data['query'] = $this->memSearch_model->getdata($mail);
$this->load->view('memSearchData',$data);
	   

}
}