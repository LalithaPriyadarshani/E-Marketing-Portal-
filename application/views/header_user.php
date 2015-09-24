<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>E-Marketing</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/CSSFile.css" type="text/css" >
<link rel="stylesheet" href="<?php echo base_url(); ?>css/CSSUserProfilePersonal.css" type="text/css" >
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>js/jsFile.js" type="text/javascript"></script>



</head>



<body onload="slider()">

<?php 
		
		
									if(isset($_SESSION['uname'])){
										
										//echo $_SESSION['uname'];	
									}
									else
									{
										//echo 'not setted';	
									}

 ?>


				<?php
    		/*if(isset($_SESSION['myProfile'])){
				$viewMyprofile = $_SESSION['myProfile'];    
			}
			else{
				$viewMyprofile = 'hidden';
			}
			
			if(isset($_SESSION['adminProfile'])){
				$viewAdminprofile = $_SESSION['adminProfile'];	
			}
			else{
				$viewAdminprofile = 'hidden';	
			}*/
			
			
			if(isset($_SESSION['myProfile'])){
				$viewMyprofile = $_SESSION['myProfile'];    
				$margine_left = '900px'; // my profile button move left when login
				$uname_left = '-200px';
			}
			else{
				$viewMyprofile = 'hidden';
				$margine_left = '640px';
				$uname_left = '10px';
			}
			
			if(isset($_SESSION['adminProfile'])){
				$viewAdminprofile = $_SESSION['adminProfile'];	
				$adminMargine_left = '160px'; // admin profile button move left when login
				$uname_left = '-100px';
			}
			else{
				$viewAdminprofile = 'hidden';	
				$adminMargine_left = '5px';
			}
			
			
			
			
		?>
		<div class="upperLine">
        	<div class="user-profile" style="visibility:<?php echo $viewMyprofile ?>; margin-left:<?php echo $margine_left ?> ">
            	<a href="<?php echo site_url('/user_controller/userProfileData');?>">
            		<input type="button" name="btnUserFrofile" value="My Profile" />
                </a>    
            </div><!--/user-profile-->
            <div class="admin-profile" style="visibility:<?php echo $viewAdminprofile ?>; margin-left:<?php echo $adminMargine_left?> ">
            	<a href="<?php echo site_url('admin_myprofile_cont/');?>">
            	<input type="button" name="btnAdminProfile" value="Admin Profile" />
                </a>
            </div><!--/admin-profile-->
    		<div class="regnLogContainer" style="visibility:<?php if(isset($_SESSION['signInUp'])){ echo $_SESSION['signInUp'];}else{ echo 'visible';} ?>">
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
            <div class="users-name" style="margin-left:<?php echo $uname_left?>" >
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
            </div><!--/users-profile-->
            <div class="log-out-container" style="visibility:<?php if(isset($_SESSION['logout'])){ echo $_SESSION['logout'];}else{ echo 'hidden';} ?>">
            	<?php
                    	echo anchor('e_marketing_portal/log_out','Log out','title="Log out from your Account"');
				?>
            </div><!--/log-out-container-->
        </div><!--/upperLine-->

<div id="wrapper">
	<div class="header">
    	<!--upperlineHere-->    
        <div class="logoContainer">
        	<a href="">
        	<img src="<?php echo base_url(); ?>images/logo.png" width="270" height="70"  alt="Logo"  />
            </a>
        </div><!--/logoContainer-->
        <div class="searchBar">
        <!--<form method="post">-->
        <?php $this->load->helper('form'); ?>
        <?php echo form_open('e_marketing_portal/search_adds'); ?>
        	<ul>
            	<li>
                	<input type="text" id="txtSearch" name="txtSearch" value="Search..." onfocus="if(this.value=='Search...') this.value='';" onblur="if(this.value=='') this.value='Search...';" />
                    
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
                	<input type="submit" name="submit" value="Search" />
                </li>				
            </ul>
         <?php echo form_close(); ?>
         <!--</form>-->
        </div><!--searchBar-->
        <div class="menuContainer">
        	<ul>
            	<li>
                	<?php
                    	echo anchor(base_url(),'Home','title="Home"');
					?>
                </li>
                <li>
                	<!--<a href="<?php //echo base_url(); ?>testpage">Catagory</a>-->
                    <?php
                    	//echo anchor('/e_marketing_portal/search','Edit Profile','title="Manage Your Categories"');
						
						$accountType;
                    
						if(isset($_SESSION['accountType']))
						{
							$accountType = $_SESSION['accountType'];
							
							if($accountType == 'Personal Account')
							{
								//$controller = 'userprofile_personal_controller';
								echo anchor('/userprofile_personal_controller/','Edit Profile','title="Manage Your Categories"');
							}
							else
							{
								//$accountType = '/userprofile_business_controller/';
								echo anchor('/userprofile_business_controller/','Edit Profile','title="Manage Your Categories"');	
							}	
						}
						
						
					?>
                </li>
                <li>
                	<?php
                    	echo anchor('/upload/','My Adds','title="Manage Your Categories"');
					?>
                </li>
                
               
            </ul>
        </div><!--/menuContainer-->
    </div><!--/header-->
    <div class="body">