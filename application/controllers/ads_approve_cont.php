<?php
    class Ads_Approve_Cont  extends CI_Controller{
        
        public function index()
		{
			$this->load->library('table');
			$this->load->model('ads_approve_model');
			$this->setStatus();
						
        }
		
		public function setStatus(){
			
			 $this->load->model('db_model');
	     $data['query'] = $this->db_model->getCategory();	

	      	$this->load->model('ads_approve_model');
			$data['querya']=$this->ads_approve_model->getStatus();
			$this->load->view('add_approval',$data);
		}
		
		
		
		public function approve($id)
		{
				$this->load->model('ads_approve_model');				
				$result = $this->ads_approve_model->approveAds($id);
				if($result!=NULL){
					foreach($result as $col): {					
					$email=$col->email;
						}
					endforeach;
				
					$this->sendEmail($result);
				}
				$data['querya']=$this->ads_approve_model->getStatus();//to reload the view
				$this->load->view('add_approval',$data);
				
			
		}
		public function remove($id)
		{
				$this->load->model('ads_approve_model');
				
				$result = $this->ads_approve_model->removeAds($id);
				if($result!=NULL){
					foreach($result as $col): {					
					$email=$col->email;
						}
					endforeach;
				
					$this->sendEmailRejected($result);
				}				
				$data['querya']=$this->ads_approve_model->getStatus();
				$this->load->view('add_approval',$data);
			
		}
		
		public function sendEmail($data)
		{$this->load->helper('url');
			
			foreach($data as $row){
			
				   $config = Array(
        	            'protocol' => 'smtp',
            	        'smtp_host' => 'ssl://smtp.googlemail.com',
                	    'smtp_port' => 465,
                    	'smtp_user' => 'buyandsell1992@gmail.com',
                   		'smtp_pass' => 'BuyAndSell199212',
                    );	
		
				$this->load->library('email',$config);	
			 	$this->email->set_newline("\r\n");
				$this->email->from('buyandsell1992@gmail.com','GoBuySell');
				$this->email->to($row->email);
				$this->email->subject('Your advertisement  is approved');
				$this->email->message('Your advertisement '.$row->title.' is  posted successfully.This is a auto generated message please do not reply to this');
				$this->email->send();
						
			}	//endforeach;			
		$this->load->library('email', $config);
		}
		
		
		public function sendEmailRejected($data)
		{$this->load->helper('url');
			
			foreach($data as $row){
			
				   $config = Array(
        	            'protocol' => 'smtp',
            	        'smtp_host' => 'ssl://smtp.googlemail.com',
                	    'smtp_port' => 465,
                    	'smtp_user' => '@gmail.com',
                   		'smtp_pass' => '',
                    );	
		
				$this->load->library('email',$config);	
			 	$this->email->set_newline("\r\n");
				$this->email->from('.com','GoBuySell');
				$this->email->to($row->email);
				$this->email->subject('Your advertisement is Rejected');
				
				$this->email->message("We are sorry  to inform you that your advertisment	".$row->title." has been rejected");
				$this->email->send();
						
			}//endforeach;
			
		$this->load->library('email', $config);
		}
		
	
		
		public function updateStatus($id){
		
			$this->load->model('ads_approve_model');
			$this->load->database();
			if(isset($_POST["approve"])){
					
					$query = array(
						
//						'title'=>$title,
						'status'=>0
					);
					$this->db->where('id',$id);
					$this->db->update('advertisement',$query);
					
					
					//$this->db->where('id',$id);
					//$this->db->update('advertisement',$query);
		}
			if(isset($_POST["dissaprove"])){
				$query =  array(
							'status'=>1);
							$this->db->where('id',$id);
							$this->db->update('advertisement',$query);						
			
			}
		}
	}
?>