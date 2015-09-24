<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>E-Marketing</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/CSSFile.css" type="text/css" >
<link rel="stylesheet" href="<?php echo base_url(); ?>css/CSSPostAds.css" type="text/css" >
<link rel="stylesheet" href="<?php echo base_url(); ?>css/registerCSS.css" type="text/css" >
<!--<link href="<?php // echo base_url(); ?>bootstrap-3.1.1-dist/css/bootstrap.min.css"rel="stylesheet">-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>js/jsFile.js" type="text/javascript"></script>


<!-- 3d slider -->

<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<meta name="description" content="Slicebox - 3D Image Slider with Fallback" />
<meta name="keywords" content="jquery, css3, 3d, webkit, fallback, slider, css3, 3d transforms, slices, rotate, box, automatic" />
<meta name="author" content="Pedro Botelho for Codrops" />
<link rel="shortcut icon" href="../favicon.ico"> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/demo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/slicebox.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/custom.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>js/modernizr.custom.46884.js"></script>


<!-- toggle control options -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>

$(document).ready(function(){
$(".controlPopup").click(function(){
  $(".controlOptions").toggle();
  $(".upArrow").toggle();
});
});
</script>

<!--image gallery -->

<link rel="stylesheet" href="<?php echo base_url(); ?>css/flexslider.css" type="text/css" media="screen">
<script src="<?php echo base_url(); ?>js/modernizr.js"></script>

<!--/image gallery-->




<!-- /3d slider -->


<link rel="stylesheet" href="<?php echo base_url(); ?>css/CSSFile.css" type="text/css" >
<link rel="stylesheet" href="<?php echo base_url(); ?>css/CssPostAds.css" type="text/css" >
<link rel="stylesheet" href="<?php echo base_url(); ?>css/registerCSS.css" type="text/css" >
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script src="js/jsFile.js" type="text/javascript"></script>



</head>

<body onload="" style="background-color:#FFF;">

		<?php
		
			//session_start();
			
			$margine_left = "";
			$viewMyprofile = "hidden";
			
			$noUser = "";
			$adminMargine_left = "";
			$viewAdminprofile = "hidden";
			
    		if(isset($_SESSION['myProfile'])){
				$viewMyprofile = $_SESSION['myProfile'];    
				$margine_left = '20px'; // my profile button move left when login
				$uname_left = '-200px';
				
				$regAndLogLeft = '-146px';
				$postAdsLeft = '320px';
				$controlLeft = '-107px';
				$controlVisibitity = 'visible';
				
				/*visible user controls*/
				$userControlVisibility = 'visible';
				
				/*visible admin controls*/
				$adminControlVisibility = 'hidden';
				
				
				/*control options adjustments*/
				$controlOptionHeight = '100px';
				$logOutMarginTop = '-124px';
				$adminControlMarginTop = '1px';
				
			}
			else if(isset($_SESSION['adminProfile'])){
				$viewAdminprofile = $_SESSION['adminProfile'];	
				$adminMargine_left = '-80px'; // admin profile button move left when login
				$uname_left = '-100px';
				
				$regAndLogLeft = '-146px';
				$postAdsLeft = "320px";
				$controlLeft = '-2px';
				$controlVisibitity = 'visible';
				
				/*visible user controls*/
				$userControlVisibility = 'hidden';
				
				/*visible admin controls*/
				$adminControlVisibility = 'visible';
				
				/*control options adjustments*/
				$controlOptionHeight = '150px';
				$logOutMarginTop = '-8px';
				$adminControlMarginTop = '-65px';
			}
			else{
				
				$viewMyprofile = 'hidden';
				$margine_left = '60px';
				$uname_left = '10px';
				
				$viewAdminprofile = 'hidden';	
				$adminMargine_left = '-98px';
				
				$regAndLogLeft = '-208px';
				$postAdsLeft = "396px";
				$controlLeft = '-10px';
				$controlVisibitity = 'hidden';
				
				/*visible user controls*/
				$userControlVisibility = 'hidden';
				
				/*visible admin controls*/
				$adminControlVisibility = 'hidden';
				
				/*control options adjustments*/
				$controlOptionHeight = '1px';
				$logOutMarginTop = '1px';
				$adminControlMarginTop = '1px';
			}
			
			
		?>
		<div class="upperLine">
        	<div class="logo">
            	<a href="<?php echo site_url('/e_marketing_portal/');?>">
            		<img src="<?php echo base_url(); ?>images/logo.jpg" width="100" height="50">
                </a>
            </div><!-- /logo -->
            <div class="options">
            	<ul>
                	<li>
                    	<a href="<?php echo site_url('/e_marketing_portal/');?>">Home </a>&nbsp; |
                    </li>
                	<li>
                    	<a href="">Help & Support </a>&nbsp; |
                    </li>
                    <li>
                    	<a href="<?php echo site_url('/user_mail');?>">Contact us </a>&nbsp; |
                    </li>
                    <li>
                    	<a href="">About us</a>
                    </li>
                </ul>
            </div><!-- /options-->
            
            	<?php  
									// get logged user's name
									$user;
								 $this->load->library('session');
		
									if(isset($_SESSION['uname'])){
										
										$user = $_SESSION['uname'];	
									}
									else
									{
										$user = "No user";	
									}
									
							
						?>
            
             <div class="postAd">
            	<input type="button" name="btnPostAd" id="btnPostAd" value="POST YOUR AD" style="margin-left:<?php echo $postAdsLeft; ?>">
            </div><!-- /postAd -->
        	<div class="user-profile" style="visibility:<?php echo $viewMyprofile ?>; margin-left:<?php echo $margine_left ?> ">
            	<a href="<?php echo site_url('/user_controller/userProfileData');?>">
            		<input type="button" name="btnUserFrofile" value="<?php echo $user; ?>" />
                </a>    
            </div><!--/user-profile-->
            <div class="admin-profile" style="visibility:<?php echo $viewAdminprofile ?>; margin-left:<?php echo $adminMargine_left?>">
            	<a href="<?php echo site_url('admin_myprofile_cont/');?>">
            	<input type="button" name="btnAdminProfile" value="Admin" />
                </a>
            </div><!--/admin-profile-->
            <div class="controls" style="margin-left:<?php echo $controlLeft; ?>; visibility:<?php echo $controlVisibitity; ?>">
            |
            	<div class="controlPopup">
                	<img src="<?php echo base_url(); ?>images/controls.jpg" alt="Control" width="20" height="20" />
            	</div><!-- /controlPopup -->
            </div><!-- /controls -->
            
    		<div class="regnLogContainer" style=" margin-left:<?php echo $regAndLogLeft; ?>; visibility:<?php if(isset($_SESSION['signInUp'])){ echo $_SESSION['signInUp'];}else{ echo 'visible';} ?>;">
        		<ul>
            		<li>
                    	<?php
                    	echo anchor('/register/','Sign up','title="Sign up To Post Free Ads"');
						?>
                		<!--<a href="">
                        Sign up -->
                		<!--<input type="button" name="btnRegister" value="Register" /> -->
                    	</a>
                        &nbsp;&nbsp;or 
                	</li>
                	<li>
                		<?php
                    	echo anchor('/e_marketing_portal/load_login','Sign in','title="Sign in To Post Free Ads"');
						?> 
                	</li>
            	</ul>
        	</div><!--regnLogContainer-->
           
           <!-- <div class="users-name" style="margin-left:<?php echo $uname_left?>">  
            	<label> <?php  
								 $this->load->library('session');
		
									if(isset($_SESSION['uname'])){
										
										echo $_SESSION['uname'];	
									}
									else
									{
										echo '<< Sign In To Post Free Ads';	
									}
									
							
						?>
               </label>
            </div><!--/users-name-->
           
        </div><!--/upperLine-->
        <div class="upArrow">
        	<img src="<?php echo base_url(); ?>images/upArrow.png" alt="Arrow" width="20" height="10" />
        </div><!-- /upArrow -->
		<div class="controlOptions" style="height:<?php echo $controlOptionHeight; ?>">
        	<div class="user-controls" style="visibility:<?php echo $userControlVisibility; ?>">
            	<ul>
                	
                    		<?php
                    			//echo anchor('/e_marketing_portal/search','Edit Profile','title="Manage Your Categories"');
						
								$accountType;
                    
								if(isset($_SESSION['accountType']))
								{
									$accountType = $_SESSION['accountType'];
							
									if($accountType == 'Personal Account')
									{
										//$controller = 'userprofile_personal_controller';
										//echo anchor('/userprofile_personal_controller/','Edit Profile','title="Manage Your Categories"');
							?>
										<a href="<?php echo site_url('/userprofile_personal_controller/');?>">
                                        
                            <?php
									}
									else
									{
										//$accountType = '/userprofile_business_controller/';
										//echo anchor('/userprofile_business_controller/','Edit Profile','title="Manage Your Categories"');	
							?>
										<a href="<?php echo site_url('/userprofile_business_controller/');?>">
                            <?php
									}	
								}	
						
						
							?>
                    
                	<li>
                    	
                        	&nbsp;&nbsp;&nbsp;&nbsp; Edit Profile
                        	
                    </li>
                    </a>
                    <a href="<?php echo site_url('/upload/');?>">
                    <li>
                    	
                        	&nbsp;&nbsp;&nbsp;&nbsp; My Adds
                    </li>
                    </a>
                    
                </ul>
            </div><!-- /user-controls -->
        	<div class="admin-controls" style="visibility:<?php echo $adminControlVisibility; ?>; margin-top:<?php echo $adminControlMarginTop; ?>">
            	<ul>
                	<a href="<?php echo site_url('/manageCatergory');?>">
                	<li>
                    	
                        	&nbsp;&nbsp;&nbsp;&nbsp; Manage Category
                    </li>
                    </a>
                    <a href="<?php echo site_url('/user_controller');?>">
                    <li>
                    	
                        	&nbsp;&nbsp;&nbsp;&nbsp; Manage Users
                    </li>
                    </a>
                    <a href="<?php echo site_url('/ads_approve_cont/');?>">
                    <li>
                    	
                        	&nbsp;&nbsp;&nbsp;&nbsp; Approve Ads
                    </li>
                    </a>
                    <a href="<?php echo site_url('/reportAds_controller');?>">
                    <li>
                    	
                        	&nbsp;&nbsp;&nbsp;&nbsp; Review Ads
                    </li>
                    </a>
                </ul>
        	</div><!-- /admin-controls -->
        	<div class="log-out-container" style="visibility:<?php if(isset($_SESSION['logout'])){ echo $_SESSION['logout'];}else{ echo 'hidden';} ?>; margin-top:<?php echo $logOutMarginTop; ?>">
            	
                <ul>
                	<a href="<?php echo site_url('e_marketing_portal/log_out');?>">
                    	<li>
                    	
                        		&nbsp;&nbsp;&nbsp;&nbsp; Log out
                    	</li>
                    </a>
               	</ul>
            </div><!--/log-out-container-->
        </div><!-- /controlOptions-->
<div id="wrapper">
	<div class="header">
    	<!--upperlineHere-->    
        
        <div class="searchBar">
        <!--<form method="post">-->
        <?php $this->load->helper('form'); ?>
        <?php echo form_open('e_marketing_portal/search_adds'); ?>
        	<ul>
            	<li>
                	<input type="text" id="txtSearch" name="txtSearch" value="Search..." onfocus="if(this.value=='Search...') this.value='';" onblur="if(this.value=='') this.value='Search...';" style="height:41px;" />
                    
                </li>
                <li>
                	<select id="ddCat" name="ddCat">
                    <?php
						foreach($query as $row)
						{
                    		echo '<option value="'.$row->sub_id.'">'.$row->sub_name.'</option>';
						}
					?>
                    </select>
                </li>
                <li>
                	<select id="ddCity" name="ddCity">
                   
                    	<option value="all">All</option>
                        <option value="colombo">Colombo</option>
                        <option value="kandy">Kandy</option>
                        <option value="galle">Galle</option>
                        <option value="ampara">Ampara</option>
						<option value="anuradhapura">Anuradhapura</option>
                    	<option value="badulla">Badulla</option>
                    	<option value="batticaloa">Batticaloa</option>
                    	<option value="gampaha">Gampaha</option>
                    	<option value="hambantota">Hambantota</option>
                    	<option value="jaffna">Jaffna</option>
                    	<option value="kalutara">Kalutara</option>
                    	<option value="kegalle">Kegalle</option>
                    	<option value="kilinochchi">Kilinochchi</option>
                    	<option value="kurunegala">Kurunegala</option>
                        <option value="mannar">Mannar</option>
                        <option value="matale">Matale</option>
                        <option value="matara">Matara</option>
                        <option value="moneragala">Moneragala</option>
                        <option value="mullativu">Mullativu</option>
                        <option value="nuwara eliya">Nuwara Eliya</option>
                        <option value="polonnaruwa">Polonnaruwa</option>
                    	<option value="puttalam">Puttalam</option>
                    	<option value="ratnapura">Ratnapura</option>
                    	<option value="trincomalee">Trincomalee</option>
                    	<option value="vavuniya">Vavuniya</option>
                    
                    </select>
                </li>
                <li>
                	<input type="submit" name="submit" value="" style="background:url(<?php echo base_url(); ?>images/searchImg.png); background-repeat:no-repeat;" />
                </li>
                <li>
                	 <?php
                    	echo anchor('/e_marketing_portal/show_advanced_search','Advanced','title="Advanced Search"');
					?>
                </li>				
            </ul>
         <?php echo form_close(); ?>
         <!--</form>-->
        </div><!--searchBar-->
        
    </div><!--/header-->
    <div class="body">
