<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class E_Marketing_Portal extends CI_Controller {

	public function index()
	{
		
		$this->load->model('db_model');
		$data['query'] = $this->db_model->getCategory(); 
		$this->load->model('paidAdd_model');
		// display categories in drop down list 
		
		$data['featuredAds'] = $this->paidAdd_model->retrieveImages();
		
		
		$this->load->view('home',$data);
		//$this->load->view('home2');
			
				
	}
	
	public function redirectCategory(){
	
		$this->load->view('testpage');	
	}
	
	
	public function search(){  // not in use
		
		$this->load->library('table');
		$this->load->helper('html');	
		$this->load->model('db_model');

		//$data = $this->category_model->general();
		$data['query'] = $this->db_model->search_adds();
	
			
		
		$this->load->view('search_result',$data);
				
	}
	
	
	public function search_adds()  // search function for home
	{
		//$this->load->view('search_result');
		$searchText = $this->input->post('txtSearch');
		$selectedValue = $this->input->post('ddCat');
		$selectedCity = $this->input->post('ddCity');
		
		$this->load->helper('html');
		$this->load->model('db_model');
		
		if($searchText != 'Search...' && $searchText != '' && $selectedCity == 'all')
		{
		
			$data['adsquery'] = $this->db_model->m_search_adds($searchText); // call to the model for search adds
				
			if($data['adsquery'] != null)  // check are there any results
			{
				$this->load->model('db_model');
				$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
				$this->load->view('search_result',$data);
			}
			else
			{
				$this->load->model('db_model');
				$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
				$this->load->view('no_search_result',$data);
			}
		
		}
		else if($searchText != 'Search...' && $searchText != '' && $selectedCity != 'all')
		{
			// search ads with keywords and specific city
			
			$data['adsquery'] = $this->db_model->m_search_adds_with_city($searchText, $selectedCity); // call to the model for search adds with city
				
			if($data['adsquery'] != null)  // check are there any results
			{
				$this->load->model('db_model');
				$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
				$this->load->view('search_result',$data);
			}
			else
			{
				$this->load->model('db_model');
				$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
				$this->load->view('no_search_result',$data);
			}
			
		}
		else 
		{
			
			if($selectedCity == 'all')
			{
				$catId = $this->input->post('ddCat');
			
				$data['adsquery'] = $this->db_model->search_adds_with_cat($catId); // call to the model for search adds with category
				
				if($data['adsquery'] != null)  // check are there any results
				{
					$this->load->model('db_model');
					$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
					$this->load->view('search_result',$data);
				}
				else
				{
					$this->load->model('db_model');
					$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
					$this->load->view('no_search_result', $data);
				}
			}
			else 
			{
				// search items category wise with city
	
				$catId = $this->input->post('ddCat');
			
				$data['adsquery'] = $this->db_model->search_adds_with_cat_and_city($catId, $selectedCity); // call to the model for search adds with category and city
				
				if($data['adsquery'] != null)  // check are there any results
				{
					$this->load->model('db_model');
					$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
					$this->load->view('search_result',$data);
				}
				else
				{
					$this->load->model('db_model');
					$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
					$this->load->view('no_search_result', $data);
				}
						
			
			}	
			
		}
		
	}
	
	
	public function view_more($add_id) // for search2 view   ============================================================================
	{
		$this->load->model('db_model');
		$data['query'] = $this->db_model->search_more_adds($add_id);
		
		//$this->load->model('db_model','',true); // display comments
		//$AdId = $_SESSION['adsID'];
		$data['result'] = $this->db_model->get_comments($add_id);
		
		$data['image'] = $this->db_model->get_ad_images($add_id);
		
		
		$this->load->view('search_result2',$data);
		//echo $add_id;
		
	}
	
	
	public function show_advanced_search()
	{
		$this->load->model('db_model');
		$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
		
		
		$this->load->view('advanced_search', $data);
		
	}
	
	
	public function show_all_fAds()
	{
		
		$this->load->model('paidAdd_model');
		//$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
		
		$data['adsquery'] = $this->paidAdd_model->retrieveImages();
		$this->load->view('search_result1',$data);
		
		
	}
	
	
	
	
	
	
	public function display_admin_home()  // show admin home page
	{
		$this->load->model('db_model');
		$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
		
		$this->load->view('home_admin' , $data);	
	}
	
	
	
	public function display_logged_user_home()  // show logged user home page
	{
		$this->load->model('db_model');
		$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
		
		$this->load->view('home_logged_user' , $data);	
	}
	
	
	
	public function reportAds($id)  // view report ads
	{
		$data['id'] = $id;
		$this->load->view('report_adds',$data);	
	}
	
	
	
	public function report($id) // report ads
	{
			
		$this->load->model('db_model');
		
		$header = $this->input->post('rdbReport');
		$descrip = $this->input->post('txtDescription');
		
		$result = $this->db_model->reportAds($id, $header, $descrip);
		
		//echo $result;
			
		$this->load->view('report_ads_success');	
			
			
	}
	
	
	
	
	
	
	public function load_login()  // view login page
	{
		$this->load->model('db_model');
		$data['query'] = $this->db_model->getCategory(); 
		$this->load->view('login', $data);	
	}
	
	
	public function log_in()  // login function
	{
		$this->load->model('db_model');
		$this->load->helper('url');
		$this->load->library('session');
		
		
		$email = $this->input->post('txtEmail');
		$password = $this->input->post('txtPword');
		
		$data = $this->db_model->login($email,$password);
		$count = 0;
		foreach($data as $row)
		{
			
			$count++;
			
			$_SESSION['uname'] = $row->FirstName; // name
			$_SESSION['usrType'] = $row->UserType; // user type - admin - user
			$_SESSION['accountType'] = $row->AccountType;
			$_SESSION['usrID'] = $row->RegistrationId;
			
							
		}
		
		//session_start();
		
		 //==============handle user privilages==============
		 //==================================================
		
		if($count > 0){ // valid login
		
			// set visible log out button
			$_SESSION['logout'] = 'visible';
			
			 // set visible sign in- sign out buttons
			$_SESSION['signInUp'] = 'hidden';
			
			
			if($_SESSION['usrType'] == 1){
				$_SESSION['myProfile'] = 'visible'; // set my-profile visible
			}
			else if($_SESSION['usrType'] == 2){
				$_SESSION['adminProfile'] = 'visible';  //set admin profile visible
			}
		
			//always load data to drop down
		
			$this->load->model('db_model');
			$this->load->model('paidAdd_model');
			$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 	
			$data['featuredAds'] = $this->paidAdd_model->retrieveImages();
			
			$this->load->view('home',$data);
			
			
		}
		else{  // invalid login
		
			$this->session->set_userdata('errorMsg','visible');
			$this->load->view('login');
		}
		
		//===============end handle user privileges==========
				
	}
	
	
	public function log_out() // unset all session variables 
	{
		$this->load->library('session');
		
		
		unset($_SESSION['uname']);
		unset($_SESSION['logout']);
		unset($_SESSION['signInUp']);
		unset($_SESSION['myProfile']);
		unset($_SESSION['adminProfile']);
		
		$this->load->model('db_model');
		$this->load->model('paidAdd_model');
		$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 	
		$data['featuredAds'] = $this->paidAdd_model->retrieveImages();
		$this->load->view('home',$data);
		
	}
	
	
	
	
	public function rate_ads()  // rate ads
	{
		$this->load->model('db_model','',true);
		
		$id = trim($_POST['adID']);
		$rate = trim($_POST['rate']);
		
		//echo 'here';
		
		$this->db_model->rate($id,$rate);
	}
	
	
	public function get_rate_results()
	{
		$this->load->model('db_model','',true);
		
		$id =  $_SESSION['adsID'];
		$data['result'] = 	$this->db_model->get_rate_results($id);
		
		$poor = 0;
		$fair = 0;
		$good = 0;
		$veryGood = 0;
		$excellent = 0;
		$count = 0;
		
		foreach($data['result'] as $row)
		{ 
			if($row->Rate == '1')
			{
				$count++;
				$poor++;	
			}
			else if($row->Rate == '2')
			{
				$count++;
				$fair++;
			}
			else if($row->Rate == '3')
			{
				$count++;
				$good++;	
			}
			else if($row->Rate == '4')
			{
				$count++;
				$veryGood++;	
			}
			else if($row->Rate == '5')
			{
				$count++;
				$excellent++;	
			}
			
					
		}
		
		
		$poorRate = sprintf ("%.2f",($poor/$count)*100);
		$fairRate = sprintf ("%.2f",($fair/$count)*100);
		$goodRate = sprintf ("%.2f",($good/$count)*100);
		$veryGoodRate = sprintf ("%.2f",($veryGood/$count)*100);
		$excellentRate = sprintf ("%.2f",($excellent/$count)*100);
		
		$rates['poor'] = $poorRate;
		$rates['fair'] = $fairRate;
		$rates['good'] = $goodRate;
		$rates['veryGood'] = $veryGoodRate;
		$rates['excellent'] = $excellentRate;
		
		
		echo json_encode($rates); die;

	}
	
	
	public function add_comments()
	{
		//$postComment = $this->input->post('btnPostComment');
		
		//if($postComment)
		//{
		$this->load->model('db_model','',true);
		
		$AdId = $_SESSION['adsID'];
		//$name = $this->input->post('txtName');
		//$comment = $this->input->post('txtComment');
		$name = trim($_POST['name']);
		$comment = trim($_POST['comment']);

		
		
		
		$this->db_model->add_comment($AdId, $name, $comment);
		
		
		//$this->view_more($AdId);
		
		//}
	}
	
	
	public function get_comments()
	{
		$AdId = $_SESSION['adsID'];
		$this->view_more($AdId);
	}
	
	
	public function delete_ads()
	{
		$this->load->model('db_model','',true);
		
		
		$adID = trim($_POST['comID']);
		
		$this->db_model->delete_comments($adID);
		
	}
	
	
	//======================== Advanced search ================================================================
	
	
	public function displayAdvancedSearch()
	{
		$this->load->model('db_model','',true);
		$data['query'] = $this->db_model->getCategory();
		$this->load->view('advanced_search',$data);
		
	}
	
	
	
	
	public function advanced_search_basic()
	{
		$this->load->model('db_model','',true);
		
		$keywordsInclude = $this->input->post('txtInclude');
		$keywordsExclude = $this->input->post('txtExclude');
		$category = $this->input->post('ddlCategory');
		
		//echo $category;
		
		if(isset($_POST['btnAdvancedSearchBasic']))
		{
			
			if($keywordsInclude != '')
			{
				// with include keywords
				if($keywordsExclude != '')
				{
					//with exclude
					if($category != '') // 1
					{
						// include category 
						$data['adsquery'] = $this->db_model->model_advanced_search_basic('1',$keywordsInclude,$keywordsExclude,$category);
						if($data['adsquery'] != null)  // check are there any results
						{
							$this->load->model('db_model');
							$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
							$this->load->view('search_result',$data);
						}
						else
						{
							$this->load->model('db_model');
							$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
							$this->load->view('no_search_result',$data);
						}
						//$this->load->view('search_result',$data);
					}
					else // 2
					{
						// all category
						$data['adsquery'] = $this->db_model->model_advanced_search_basic('2',$keywordsInclude,$keywordsExclude,$category);
						if($data['adsquery'] != null)  // check are there any results
						{
							$this->load->model('db_model');
							$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
							$this->load->view('search_result',$data);
						}
						else
						{
							$this->load->model('db_model');
							$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
							$this->load->view('no_search_result',$data);
						}
						//$this->load->view('search_result',$data);
					}
				}
				else // 3
				{
					// without exclude
					if($category != '')
					{
						// include category
						$data['adsquery'] = $this->db_model->model_advanced_search_basic('3',$keywordsInclude,$keywordsExclude,$category);
						if($data['adsquery'] != null)  // check are there any results
						{
							$this->load->model('db_model');
							$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
							$this->load->view('search_result',$data);
						}
						else
						{
							$this->load->model('db_model');
							$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
							$this->load->view('no_search_result',$data);
						}
					}
					else // 4
					{
						// all category
						$data['adsquery'] = $this->db_model->model_advanced_search_basic('4',$keywordsInclude,$keywordsExclude,$category);
						if($data['adsquery'] != null)  // check are there any results
						{
							$this->load->model('db_model');
							$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
							$this->load->view('search_result',$data);
						}
						else
						{
							$this->load->model('db_model');
							$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
							$this->load->view('no_search_result',$data);
						}
						
					}
				}
			}
			else  // 5
			{
				// without include keywords
				// search by only category	
				if($category != '')
					{
						// include category
						$data['adsquery'] = $this->db_model->model_advanced_search_basic('5',$keywordsInclude,$keywordsExclude,$category);
						if($data['adsquery'] != null)  // check are there any results
						{
							$this->load->model('db_model');
							$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
							$this->load->view('search_result',$data);
						}
						else
						{
							$this->load->model('db_model');
							$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
							$this->load->view('no_search_result',$data);
						}
					}
					else
					{
						// all category
						$data['adsquery'] = $this->db_model->model_advanced_search_basic('6',$keywordsInclude,$keywordsExclude,$category);
						if($data['adsquery'] != null)  // check are there any results
						{
							$this->load->model('db_model');
							$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
							$this->load->view('search_result',$data);
						}
						else
						{
							$this->load->model('db_model');
							$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
							$this->load->view('no_search_result',$data);
						}
					}
			}
			
		}
		else if(isset($_POST['btnAdvancedSearch']))
		{
			$searchFiledTitle = $this->input->post('rbtnTitle');  // search field
			$searchFiledDescription = $this->input->post('rbtnDescription');
			
			$isPriceApplied = $this->input->post('rbtnPrice');  //  price
			$priceFrom = $this->input->post('txtPriceFrom');
			$priceTo = $this->input->post('txtPriceTo');
			
			$itemCondition = $this->input->post('rbtnCondition');  //  item condition
			
			$isLocationApplied = $this->input->post('rbtnLocation');  // location
			$locationFrom = $this->input->post('txtLocatedFrom');
			$locationTo = $this->input->post('txtLocationTo');
			
			//$category = $this->input->post('ddlCategory'); // category
			
			
			if($keywordsInclude != '')
			{
				// with include keywords
				if($keywordsExclude != '')
				{
					//with exclude
					if($category != '') // 1
					{
						// include category 
						if($searchFiledTitle != '' && $searchFiledDescription == '')
						{
							// title selected
							if($isPriceApplied == 'true' && $isLocationApplied == 'true') // price and location applied
							{
								//include, exclude, condition,category, price and location applied 
								if($itemCondition != 'Any')  // 1
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('1', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 2
										{
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('2', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
								
								
							}
							else if($isPriceApplied != 'true' && $isLocationApplied == 'true') // only location applied
							{
								
								// include, exclude, category, title, condition ,location applied price not applied
								
								if($itemCondition != 'Any')  // 3
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('3', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 4
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('4', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
							}
							else if($isPriceApplied == 'true' && $isLocationApplied != 'true') // only price applied  5
							{
								// price applied location not applied
								
								if($itemCondition != 'Any')  // 5
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('5', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 6
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('6', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}
							else	// price and location not applied
							{
								
								
								if($itemCondition != 'Any')  // 7
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('7', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 8
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('8', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
								
							}
						}
						else if($searchFiledTitle == '' && $searchFiledDescription != '')
						{
							// include,exclude,category and description selected
							if($isPriceApplied == 'true' && $isLocationApplied == 'true') // price and location applied
							{
								// price and location applied 
								
								if($itemCondition != 'Any')  // 9
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('9', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 10
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('10', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}
							else if($isPriceApplied != 'true' && $isLocationApplied == 'true') // only location applied
							{
								// location applied price not applied
								
								if($itemCondition != 'Any')  // 11
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('11', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 12
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('12', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}
							else if($isPriceApplied == 'true' && $isLocationApplied != 'true') // only price applied
							{
								
								if($itemCondition != 'Any')  // 13
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('13', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 14
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('14', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
							}
							else	// price and location not applied
							{
								
								if($itemCondition != 'Any')  // 15
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('15', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 16
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('16', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}

						}
						else if($searchFiledTitle != '' && $searchFiledDescription != '')
						{
							// include,exclude,category ,title and description both selected
							if($isPriceApplied == 'true' && $isLocationApplied == 'true') // price and location applied
							{
								//include, exclude, condition,category, price and location applied 
								if($itemCondition != 'Any')  // 17
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('17', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 18
										{
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('18', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
								
								
							}
							else if($isPriceApplied != 'true' && $isLocationApplied == 'true') // only location applied
							{
								
								// include, exclude, category, title, condition ,location applied price not applied
								
								if($itemCondition != 'Any')  // 19
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('19', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 20
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('20', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
							}
							else if($isPriceApplied == 'true' && $isLocationApplied != 'true') // only price applied  5
							{
								// price applied location not applied
								
								if($itemCondition != 'Any')  // 21
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('21', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 22
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('22', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}
							else	// price and location not applied
							{
								
								
								if($itemCondition != 'Any')  // 23
								{
											$data['adsquery'] = $this->db_model->model_advanced_search('23', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 24
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('24', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
								
							}
						
							
							
						
						}
					}
					else // 2 
					{
						
						// all category
						// include,exclude  selected
						
						if($searchFiledTitle != '' && $searchFiledDescription == '')
						{	
							
							// title selected
							if($isPriceApplied == 'true' && $isLocationApplied == 'true') // price and location applied
							{
								//include, exclude, condition,category, price and location applied  
								if($itemCondition != 'Any')  // 25
										{
											
											$data['adsquery'] = $this->db_model->model_advanced_search('25', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 26
										{
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('26', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
								
								
							}
							else if($isPriceApplied != 'true' && $isLocationApplied == 'true') // only location applied
							{
								
								// include, exclude, category, title, condition ,location applied price not applied
								
								if($itemCondition != 'Any')  // 27
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('27', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 28
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('28', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
							}
							else if($isPriceApplied == 'true' && $isLocationApplied != 'true') // only price applied  5
							{
								// price applied location not applied
								
								if($itemCondition != 'Any')  // 29
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('29', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 30
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('30', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}
							else	// price and location not applied
							{
								
								
								if($itemCondition != 'Any')  // 31
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('31', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 32
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('32', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
								
							}
						}
						else if($searchFiledTitle == '' && $searchFiledDescription != '')
						{
							// include,exclude,category and description selected
							if($isPriceApplied == 'true' && $isLocationApplied == 'true') // price and location applied
							{
								// price and location applied  
								
								if($itemCondition != 'Any')  // 33
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('33', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 34
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('34', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}
							else if($isPriceApplied != 'true' && $isLocationApplied == 'true') // only location applied
							{
								// location applied price not applied
								
								if($itemCondition != 'Any')  // 35
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('35', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 36
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('36', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}
							else if($isPriceApplied == 'true' && $isLocationApplied != 'true') // only price applied
							{
								
								if($itemCondition != 'Any')  // 37
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('37', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 38
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('38', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
							}
							else	// price and location not applied
							{
								
								if($itemCondition != 'Any')  // 39
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('39', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 40
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('40', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}

						}
						else if($searchFiledTitle != '' && $searchFiledDescription != '')
						{
							// include,exclude,category ,title and description both selected
							if($isPriceApplied == 'true' && $isLocationApplied == 'true') // price and location applied
							{
								//include, exclude, condition,category, price and location applied 
								if($itemCondition != 'Any')  // 41
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('41', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 42
										{
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('42', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
								
								
							}
							else if($isPriceApplied != 'true' && $isLocationApplied == 'true') // only location applied
							{
								
								// include, exclude, category, title, condition ,location applied price not applied
								
								if($itemCondition != 'Any')  // 43
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('43', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 44
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('44', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
							}
							else if($isPriceApplied == 'true' && $isLocationApplied != 'true') // only price applied  5
							{
								// price applied location not applied
								
								if($itemCondition != 'Any')  // 45
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('45', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 46
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('46', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}
							else	// price and location not applied
							{
								
								
								if($itemCondition != 'Any')  // 47
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('47', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 48
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('48', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
								
							}
							
						
						}
						
						
						
					}
				}
				else // 3 =====  without exclude 
				{
					
					
					//with exclude
					if($category != '') // 1
					{
						// include category 
						if($searchFiledTitle != '' && $searchFiledDescription == '')
						{
							// title selected
							if($isPriceApplied == 'true' && $isLocationApplied == 'true') // price and location applied
							{
								//include, exclude, condition,category, price and location applied  
								if($itemCondition != 'Any')  // 49
										{
											
											$data['adsquery'] = $this->db_model->model_advanced_search('49', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 50
										{
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('50', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
								
								
							}
							else if($isPriceApplied != 'true' && $isLocationApplied == 'true') // only location applied
							{
								
								// include, exclude, category, title, condition ,location applied price not applied
								
								if($itemCondition != 'Any')  // 51
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('51', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 52
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('52', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
							}
							else if($isPriceApplied == 'true' && $isLocationApplied != 'true') // only price applied  5
							{
								// price applied location not applied
								
								if($itemCondition != 'Any')  // 53
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('53', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 54
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('54', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}
							else	// price and location not applied
							{
								
								
								if($itemCondition != 'Any')  // 55
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('55', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 56
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('56', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
								
							}
						}
						else if($searchFiledTitle == '' && $searchFiledDescription != '')
						{
							// include,exclude,category and description selected
							if($isPriceApplied == 'true' && $isLocationApplied == 'true') // price and location applied
							{
								// price and location applied  
								
								if($itemCondition != 'Any')  // 57
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('57', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 58
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('58', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}
							else if($isPriceApplied != 'true' && $isLocationApplied == 'true') // only location applied
							{
								// location applied price not applied
								
								if($itemCondition != 'Any')  // 59
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('59', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 60
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('60', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}
							else if($isPriceApplied == 'true' && $isLocationApplied != 'true') // only price applied
							{
								
								if($itemCondition != 'Any')  // 61
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('61', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 62
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('62', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
							}
							else	// price and location not applied
							{
								
								if($itemCondition != 'Any')  // 63
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('63', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 64
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('64', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}

						}
						else if($searchFiledTitle != '' && $searchFiledDescription != '')
						{
							// include,exclude,category ,title and description both selected
							if($isPriceApplied == 'true' && $isLocationApplied == 'true') // price and location applied
							{
								//include, exclude, condition,category, price and location applied  
								if($itemCondition != 'Any')  // 65
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('65', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 66
										{
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('66', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
								
								
							}
							else if($isPriceApplied != 'true' && $isLocationApplied == 'true') // only location applied
							{
								
								// include, exclude, category, title, condition ,location applied price not applied
								
								if($itemCondition != 'Any')  // 67
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('67', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 68
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('68', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
							}
							else if($isPriceApplied == 'true' && $isLocationApplied != 'true') // only price applied  5
							{
								// price applied location not applied
								
								if($itemCondition != 'Any')  // 69
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('69', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 70
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('70', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}
							else	// price and location not applied
							{
								
								
								if($itemCondition != 'Any')  // 71
								{
											$data['adsquery'] = $this->db_model->model_advanced_search('71', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 72
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('72', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
								
							}
						
							
							
						
						}
					}
					else // 2 
					{
						
						// all category
						// include,exclude  selected
						
						if($searchFiledTitle != '' && $searchFiledDescription == '')
						{	
							
							// title selected
							if($isPriceApplied == 'true' && $isLocationApplied == 'true') // price and location applied
							{
								//include, exclude, condition,category, price and location applied  
								if($itemCondition != 'Any')  // 73
										{
											
											$data['adsquery'] = $this->db_model->model_advanced_search('73', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 74
										{
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('74', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
								
								
							}
							else if($isPriceApplied != 'true' && $isLocationApplied == 'true') // only location applied
							{
								
								// include, exclude, category, title, condition ,location applied price not applied
								
								if($itemCondition != 'Any')  // 75
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('75', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 76
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('76', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
							}
							else if($isPriceApplied == 'true' && $isLocationApplied != 'true') // only price applied  5
							{
								// price applied location not applied
								
								if($itemCondition != 'Any')  // 77
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('77', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 78
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('78', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}
							else	// price and location not applied
							{
								
								
								if($itemCondition != 'Any')  // 79
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('79', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 80
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('80', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
								
							}
						}
						else if($searchFiledTitle == '' && $searchFiledDescription != '')
						{
							// include,exclude,category and description selected
							if($isPriceApplied == 'true' && $isLocationApplied == 'true') // price and location applied
							{
								// price and location applied  
								
								if($itemCondition != 'Any')  // 81
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('81', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 82
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('82', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}
							else if($isPriceApplied != 'true' && $isLocationApplied == 'true') // only location applied
							{
								// location applied price not applied
								
								if($itemCondition != 'Any')  // 83
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('83', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 84
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('84', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}
							else if($isPriceApplied == 'true' && $isLocationApplied != 'true') // only price applied
							{
								
								if($itemCondition != 'Any')  // 85
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('85', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 86
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('86', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
							}
							else	// price and location not applied
							{
								
								if($itemCondition != 'Any')  // 87
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('87', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 88
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('88', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}

						}
						else if($searchFiledTitle != '' && $searchFiledDescription != '')
						{
							// include,exclude,category ,title and description both selected
							if($isPriceApplied == 'true' && $isLocationApplied == 'true') // price and location applied
							{
								//include, exclude, condition,category, price and location applied  
								if($itemCondition != 'Any')  // 89
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('89', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 90
										{
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('90', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
								
								
							}
							else if($isPriceApplied != 'true' && $isLocationApplied == 'true') // only location applied
							{
								
								// include, exclude, category, title, condition ,location applied price not applied
								
								if($itemCondition != 'Any')  // 91
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('91', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 92
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('92', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
							}
							else if($isPriceApplied == 'true' && $isLocationApplied != 'true') // only price applied  5
							{
								// price applied location not applied
								
								if($itemCondition != 'Any')  // 93
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('93', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 94
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('94', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}
							else	// price and location not applied
							{
								
								
								if($itemCondition != 'Any')  // 95
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('95', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 96
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('96', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
								
							}
							
						
						}
						
						
						
					}
				
					
					
				}
			}
			else  // 5 
			{
				// without include keywords
				// search by only category
				
				
				// with include keywords
				if($keywordsExclude != '')
				{
					//with exclude
					if($category != '') // 1
					{
						// include category 
						if($searchFiledTitle != '' && $searchFiledDescription == '')
						{
							// title selected
							if($isPriceApplied == 'true' && $isLocationApplied == 'true') // price and location applied
							{
								//include, exclude, condition,category, price and location applied 
								if($itemCondition != 'Any')  // 97
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('97', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 98
										{
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('98', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
								
								
							}
							else if($isPriceApplied != 'true' && $isLocationApplied == 'true') // only location applied
							{
								
								// include, exclude, category, title, condition ,location applied price not applied
								
								if($itemCondition != 'Any')  // 99
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('99', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 100
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('100', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
							}
							else if($isPriceApplied == 'true' && $isLocationApplied != 'true') // only price applied  5
							{
								// price applied location not applied
								
								if($itemCondition != 'Any')  // 101
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('101', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 102
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('102', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}
							else	// price and location not applied
							{
								
								
								if($itemCondition != 'Any')  // 103
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('103', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 104
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('104', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
								
							}
						}
						else if($searchFiledTitle == '' && $searchFiledDescription != '')
						{
							// include,exclude,category and description selected
							if($isPriceApplied == 'true' && $isLocationApplied == 'true') // price and location applied
							{
								// price and location applied 
								
								if($itemCondition != 'Any')  // 105
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('105', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 106
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('106', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}
							else if($isPriceApplied != 'true' && $isLocationApplied == 'true') // only location applied
							{
								// location applied price not applied
								
								if($itemCondition != 'Any')  // 107
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('107', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 108
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('108', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}
							else if($isPriceApplied == 'true' && $isLocationApplied != 'true') // only price applied
							{
								
								if($itemCondition != 'Any')  // 109
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('109', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 110
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('110', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
							}
							else	// price and location not applied
							{
								
								if($itemCondition != 'Any')  // 111
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('111', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 112
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('112', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}

						}
						else if($searchFiledTitle != '' && $searchFiledDescription != '')
						{
							// include,exclude,category ,title and description both selected
							if($isPriceApplied == 'true' && $isLocationApplied == 'true') // price and location applied
							{
								//include, exclude, condition,category, price and location applied  
								if($itemCondition != 'Any')  // 113
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('113', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}

											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 114
										{
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('114', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
								
								
							}
							else if($isPriceApplied != 'true' && $isLocationApplied == 'true') // only location applied
							{
								
								// include, exclude, category, title, condition ,location applied price not applied
								
								if($itemCondition != 'Any')  // 115
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('115', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 116
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('116', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
							}
							else if($isPriceApplied == 'true' && $isLocationApplied != 'true') // only price applied  5
							{
								// price applied location not applied
								
								if($itemCondition != 'Any')  // 117
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('117', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 118
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('118', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}
							else	// price and location not applied
							{
								
								
								if($itemCondition != 'Any')  // 119
								{
											$data['adsquery'] = $this->db_model->model_advanced_search('119', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 120
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('120', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
								
							}
						
							
							
						
						}
					}
					else // 2 
					{
						
						// all category
						// include,exclude  selected
						
						if($searchFiledTitle != '' && $searchFiledDescription == '')
						{	
							
							// title selected
							if($isPriceApplied == 'true' && $isLocationApplied == 'true') // price and location applied
							{
								//include, exclude, condition,category, price and location applied  
								if($itemCondition != 'Any')  // 121
										{
											
											$data['adsquery'] = $this->db_model->model_advanced_search('121', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 122
										{
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('122', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
								
								
							}
							else if($isPriceApplied != 'true' && $isLocationApplied == 'true') // only location applied
							{
								
								// include, exclude, category, title, condition ,location applied price not applied
								
								if($itemCondition != 'Any')  // 123
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('123', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 124
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('124', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
							}
							else if($isPriceApplied == 'true' && $isLocationApplied != 'true') // only price applied  5
							{
								// price applied location not applied
								
								if($itemCondition != 'Any')  // 125
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('125', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 126
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('126', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}
							else	// price and location not applied
							{
								
								
								if($itemCondition != 'Any')  // 127
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('127', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 128
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('128', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
								
							}
						}
						else if($searchFiledTitle == '' && $searchFiledDescription != '')
						{
							// include,exclude,category and description selected
							if($isPriceApplied == 'true' && $isLocationApplied == 'true') // price and location applied
							{
								// price and location applied 
								
								if($itemCondition != 'Any')  // 129
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('129', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 130
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('130', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}
							else if($isPriceApplied != 'true' && $isLocationApplied == 'true') // only location applied
							{
								// location applied price not applied
								
								if($itemCondition != 'Any')  // 131
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('131', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 132
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('132', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}
							else if($isPriceApplied == 'true' && $isLocationApplied != 'true') // only price applied
							{
								
								if($itemCondition != 'Any')  // 133
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('133', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 134
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('134', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
							}
							else	// price and location not applied
							{
								
								if($itemCondition != 'Any')  // 135
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('135', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 136
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('136', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}

						}
						else if($searchFiledTitle != '' && $searchFiledDescription != '')
						{
							// include,exclude,category ,title and description both selected
							if($isPriceApplied == 'true' && $isLocationApplied == 'true') // price and location applied
							{
								//include, exclude, condition,category, price and location applied  
								if($itemCondition != 'Any')  // 137
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('137', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 138
										{
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('138', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
								
								
							}
							else if($isPriceApplied != 'true' && $isLocationApplied == 'true') // only location applied
							{
								
								// include, exclude, category, title, condition ,location applied price not applied
								
								if($itemCondition != 'Any')  // 139
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('139', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 140
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('140', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
							}
							else if($isPriceApplied == 'true' && $isLocationApplied != 'true') // only price applied  5
							{
								// price applied location not applied
								
								if($itemCondition != 'Any')  // 141
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('141', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 142
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('142', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}
							else	// price and location not applied
							{
								
								
								if($itemCondition != 'Any')  // 143
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('143', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 144
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('144', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
								
							}
							
						
						}
						
						
						
					}
				}
				else // 3 =====  without exclude 
				{
					
					
					//with exclude
					if($category != '') // 1
					{
						// include category 
						if($searchFiledTitle != '' && $searchFiledDescription == '')
						{
							// title selected
							if($isPriceApplied == 'true' && $isLocationApplied == 'true') // price and location applied
							{
								//include, exclude, condition,category, price and location applied  
								if($itemCondition != 'Any')  // 145
										{
											
											$data['adsquery'] = $this->db_model->model_advanced_search('145', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 146
										{
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('146', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
								
								
							}
							else if($isPriceApplied != 'true' && $isLocationApplied == 'true') // only location applied
							{
								
								// include, exclude, category, title, condition ,location applied price not applied
								
								if($itemCondition != 'Any')  // 147
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('147', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 148
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('148', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
							}
							else if($isPriceApplied == 'true' && $isLocationApplied != 'true') // only price applied  5
							{
								// price applied location not applied
								
								if($itemCondition != 'Any')  // 149
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('149', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 150
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('150', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}
							else	// price and location not applied
							{
								
								
								if($itemCondition != 'Any')  // 151
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('151', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 152
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('152', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
								
							}
						}
						else if($searchFiledTitle == '' && $searchFiledDescription != '')
						{
							// include,exclude,category and description selected
							if($isPriceApplied == 'true' && $isLocationApplied == 'true') // price and location applied
							{
								// price and location applied  
								
								if($itemCondition != 'Any')  // 153
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('153', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 154
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('154', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}
							else if($isPriceApplied != 'true' && $isLocationApplied == 'true') // only location applied
							{
								// location applied price not applied
								
								if($itemCondition != 'Any')  // 155
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('155', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 156
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('156', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}
							else if($isPriceApplied == 'true' && $isLocationApplied != 'true') // only price applied
							{
								
								if($itemCondition != 'Any')  // 157
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('157', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 158
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('158', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
							}
							else	// price and location not applied
							{
								
								if($itemCondition != 'Any')  // 159
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('159', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 160
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('160', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}

						}
						else if($searchFiledTitle != '' && $searchFiledDescription != '')
						{
							// include,exclude,category ,title and description both selected
							if($isPriceApplied == 'true' && $isLocationApplied == 'true') // price and location applied
							{
								//include, exclude, condition,category, price and location applied  
								if($itemCondition != 'Any')  // 161
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('161', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 162
										{
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('162', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
								
								
							}
							else if($isPriceApplied != 'true' && $isLocationApplied == 'true') // only location applied
							{
								
								// include, exclude, category, title, condition ,location applied price not applied
								
								if($itemCondition != 'Any')  // 163
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('163', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 164
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('164', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
							}
							else if($isPriceApplied == 'true' && $isLocationApplied != 'true') // only price applied  5
							{
								// price applied location not applied
								
								if($itemCondition != 'Any')  // 165
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('165', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 166
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('166', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}
							else	// price and location not applied
							{
								
								
								if($itemCondition != 'Any')  // 167
								{
											$data['adsquery'] = $this->db_model->model_advanced_search('167', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 168
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('168', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
								
							}
						
							
							
						
						}
					}
					else // 2
					{
						
						// all category
						// include,exclude  selected
						
						if($searchFiledTitle != '' && $searchFiledDescription == '')
						{	
							
							// title selected
							if($isPriceApplied == 'true' && $isLocationApplied == 'true') // price and location applied
							{
								//include, exclude, condition,category, price and location applied  
								if($itemCondition != 'Any')  // 169
										{
											
											$data['adsquery'] = $this->db_model->model_advanced_search('169', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 170
										{
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('170', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
								
								
							}
							else if($isPriceApplied != 'true' && $isLocationApplied == 'true') // only location applied
							{
								
								// include, exclude, category, title, condition ,location applied price not applied
								
								if($itemCondition != 'Any')  // 171
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('171', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 172
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('172', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
							}
							else if($isPriceApplied == 'true' && $isLocationApplied != 'true') // only price applied  5
							{
								// price applied location not applied
								
								if($itemCondition != 'Any')  // 173
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('173', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 174
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('174', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}
							else	// price and location not applied
							{
								
								
								if($itemCondition != 'Any')  // 175
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('175', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 176
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('176', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
								
							}
						}
						else if($searchFiledTitle == '' && $searchFiledDescription != '')
						{
							// include,exclude,category and description selected
							if($isPriceApplied == 'true' && $isLocationApplied == 'true') // price and location applied
							{
								// price and location applied 
								
								if($itemCondition != 'Any')  // 177
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('177', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 178
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('178', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}
							else if($isPriceApplied != 'true' && $isLocationApplied == 'true') // only location applied
							{
								// location applied price not applied
								
								if($itemCondition != 'Any')  // 179
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('179', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 180
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('180', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}
							else if($isPriceApplied == 'true' && $isLocationApplied != 'true') // only price applied
							{
								
								if($itemCondition != 'Any')  // 181
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('181', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 182
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('182', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
							}
							else	// price and location not applied
							{
								
								if($itemCondition != 'Any')  // 183
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('183', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 184
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('184', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}

						}
						else if($searchFiledTitle != '' && $searchFiledDescription != '')
						{
							// include,exclude,category ,title and description both selected
							if($isPriceApplied == 'true' && $isLocationApplied == 'true') // price and location applied
							{
								//include, exclude, condition,category, price and location applied  
								if($itemCondition != 'Any')  // 185
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('185', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 186
										{
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('186', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
								
								
							}
							else if($isPriceApplied != 'true' && $isLocationApplied == 'true') // only location applied
							{
								
								// include, exclude, category, title, condition ,location applied price not applied
								
								if($itemCondition != 'Any')  // 187
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('187', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 188
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('188', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
							}
							else if($isPriceApplied == 'true' && $isLocationApplied != 'true') // only price applied  5
							{
								// price applied location not applied
								
								if($itemCondition != 'Any')  // 189
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('189', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 190
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('190', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
							}
							else	// price and location not applied
							{
								
								
								if($itemCondition != 'Any')  // 191
										{
											$data['adsquery'] = $this->db_model->model_advanced_search('191', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
										}
										else  // 192
										{
											
											// no need condition checking	
											$data['adsquery'] = $this->db_model->model_advanced_search('192', $keywordsInclude, $keywordsExclude, $category, $priceFrom, $priceTo, $itemCondition, $locationFrom, $locationTo);
											if($data['adsquery'] != null)  // check are there any results
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('search_result',$data);
											}
											else
											{
												$this->load->model('db_model');
												$data['query'] = $this->db_model->getCategory(); // display categories in drop down list 
												$this->load->view('no_search_result',$data);
											}
											
										}// end condition
								
								
							}
							
						
						}
						
						
						
					}
				
					
					
				}
			
				
				
				
				
				
				
			}
		
		
     	}
	
   	}
 
	
	
	
	
	
}


?>