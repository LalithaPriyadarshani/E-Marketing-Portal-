<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>E-Marketing</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/CSSFile.css" type="text/css" >
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>js/jsFile.js" type="text/javascript"></script>


<!-- 3d slider-->
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
<!-- /3d slider-->

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
    		if(isset($_SESSION['myProfile'])){
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
			}
			
		?>
		<div class="upperLine">
        	<div class="user-profile" style="visibility:<?php echo $viewMyprofile ?> ">
            	<a href="<?php echo site_url('e_marketing_portal/display_logged_user_home');?>">
            		<input type="button" name="btnUserFrofile" value="My Profile" />
                </a>    
            </div><!--/user-profile-->
            <div class="admin-profile" style="visibility:<?php echo $viewAdminprofile ?>">
            	<a href="<?php echo site_url('e_marketing_portal/display_admin_home');?>">
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
            <div class="users-name">
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
                    	echo anchor('/manageCatergory','Manage Category','title="Manage Your Categories"');
					?>
                </li>
                <li>
                	<?php
                    	echo anchor('/user_controller','Manage Users','title="Manage Your Categories"');
					?>
                </li>
                <li>
                	<?php
                    	echo anchor('/e_marketing_portal/search','Change Password','title="Manage Your Categories"');
					?>
                </li>
                <li>
                	<?php
                    	echo anchor('/ads_approve_cont/','Approve Ads','title="Approve Posted Ads"');
					?>
                </li>
                 <li>
                	<?php
                    	echo anchor('/reportAds_controller','Review Ads','title="Review Reported Ads"');
					?>
                </li>
               
            </ul>
        </div><!--/menuContainer-->
    </div><!--/header-->
    <div class="body">
    	<div class="wrapper-slide">
    		
             <!-- 3d slider -->
        		
                
                
                
                <div class="wrapper">

				<ul id="sb-slider" class="sb-slider">
					<li>
						<a href="" target="_blank"><img src="<?php echo base_url(); ?>images/1.png" alt="image1"/></a>
						
					</li>
					<li>
						<a href="" target="_blank"><img src="<?php echo base_url(); ?>images/2.png" alt="image2"/></a>
						<!--<div class="sb-description">
							<h3>Honest Entertainer</h3>
						</div>-->
					</li>
					<li>
						<a href="" target="_blank"><img src="<?php echo base_url(); ?>images/3.png" alt="image1"/></a>
						
					</li>
					
				</ul>

				<div id="shadow" class="shadow"></div>

				<div id="nav-arrows" class="nav-arrows">
					<a href="#">Next</a>
					<a href="#">Previous</a>
				</div>

			</div><!-- /wrapper -->
        		
                
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.slicebox.js"></script>
		<script type="text/javascript">
			
			
			$(function() {
				
				var Page = (function() {

					var $navArrows = $( '#nav-arrows' ).hide(),
						$shadow = $( '#shadow' ).hide(),
						slicebox = $( '#sb-slider' ).slicebox( {
							onReady : function() {

								$navArrows.show();
								$shadow.show();

							},
							orientation : 'r',
							cuboidsRandom : true,
							disperseFactor : 30
						} ),
						
						init = function() {

							initEvents();
							
						},
						initEvents = function() {

							// add navigation events
							$navArrows.children( ':first' ).on( 'click', function() {

								slicebox.next();
								return false;

							} );

							$navArrows.children( ':last' ).on( 'click', function() {
								
								slicebox.previous();
								return false;

							} );

						};

						return { init : init };

				})();

				Page.init();

			});
				</script>
        			
        	<!-- /3d slider -->
            
            
            
        </div><!--/wrapper-slide-->
        <div class="wrapper-content">
        		<!--line 1-->
        	<div id="content1" class="content1">
            	<div class="top-line">
                	<img src="<?php echo base_url(); ?>images/Top2_electronics.jpg" alt="Top" width="250px" height="30px" />
                </div><!--/top-line-->
                <div id="img-container1" class="img-container">
                </div><!--/img-container-->
                <div class="more-link">
                	<?php echo anchor('','More','title="View More Items"'); ?>
                </div><!--/more-link-->
            </div><!--content1-->
            <div id="content2" class="content2">
            	<div class="top-line">
                	<img src="<?php echo base_url(); ?>images/Top2_Cars.jpg" alt="Top" width="250px" height="30px" />
                </div><!--/top-line-->
                <div id="img-container2" class="img-container">
                </div><!--/img-container-->
                <div class="more-link">
                	<?php echo anchor('','More','title="View More Items"'); ?>
                </div><!--/more-link-->
            </div><!--content2-->
            <div id="content3" class="content2">
            	<div class="top-line">
                	<img src="<?php echo base_url(); ?>images/Top2_property.jpg" alt="Top" width="250px" height="30px" />
                </div><!--/top-line-->
                <div id="img-container3" class="img-container">
                </div><!--/img-container-->
                <div class="more-link">
                	<?php echo anchor('','More','title="View More Items"'); ?>
                </div><!--/more-link-->
            </div><!--content3-->
            <div id="content4" class="content2">
            	<div class="top-line">
                	<img src="<?php echo base_url(); ?>images/Top2_edu.jpg" alt="Top" width="250px" height="30px" />
                </div><!--/top-line-->
                <div id="img-container4" class="img-container">
                </div><!--/img-container-->
                <div class="more-link">
                	<?php echo anchor('','More','title="View More Items"'); ?>
                </div><!--/more-link-->
            </div><!--content4-->
            	<!--line 2-->
            <div id="content5" class="content3">
            	<div class="top-line">
                	<img src="<?php echo base_url(); ?>images/Top2_jobsServices.jpg" alt="Top" width="250px" height="30px" />
                </div><!--/top-line-->
                <div id="img-container5" class="img-container">
                </div><!--/img-container-->
                <div class="more-link">
                	<?php echo anchor('','More','title="View More Items"'); ?>
                </div><!--/more-link-->
            </div><!--content5-->
            <div id="content6" class="content4">
            	<div class="top-line">
                	<img src="<?php echo base_url(); ?>images/Top2_animals.jpg" alt="Top" width="250px" height="30px" />
                </div><!--/top-line-->
                <div id="img-container6" class="img-container">
                </div><!--/img-container-->
                <div class="more-link">
                	<?php echo anchor('','More','title="View More Items"'); ?>
                </div><!--/more-link-->
            </div><!--content6-->
            <div id="content7" class="content4">
            	<div class="top-line">
                	<img src="<?php echo base_url(); ?>images/Top2_food.jpg" alt="Top" width="250px" height="30px" />
                </div><!--/top-line-->
                <div id="img-container7" class="img-container">
                </div><!--/img-container-->
                <div class="more-link">
                	<?php echo anchor('','More','title="View More Items"'); ?>
                </div><!--/more-link-->
            </div><!--content7-->
            <div id="content8" class="content4">
            	<div class="top-line">
                	<img src="<?php echo base_url(); ?>images/Top2_leisure.jpg" alt="Top" width="250px" height="30px" />
                </div><!--/top-line-->
                <div id="img-container8" class="img-container">
                </div><!--/img-container-->
                <div class="more-link">
                	<?php echo anchor('','More','title="View More Items"'); ?>
                </div><!--/more-link-->
            </div><!--content8-->    
        </div><!--wrapper-content-->
    </div><!--/body-->
</div><!--/wrapper-->
<div class="footer">
	<div class="post-add">
    	<input type="button" name="btnPostAdd" value="Post Your Free Add" />
    </div><!--/post-add-->
	<div class="bottom-line">
    	<div class="follow-fb">
        	<ul>
            	<li>
                	<h2>Follow us</h2>
                </li>
                <li>
                	<a href="">
        				<img src="<?php echo base_url(); ?>images/fb.png" width="72" height="72" align="fb" />
                    </a>
                </li>
            </ul>
        </div><!--/follow-fb-->
        <div class="customer-help-support">
        	<ul>
            	<li>
                	<a href="">Banner Advertising</a>
                </li>
                <li>
                	<a href="">Healp & Support</a>
                </li>
                <li>
                	<a href="">Terms & Conditions</a>
                </li>
                <li>
                	<a href="">Privacy Policy</a>
                </li>										
            </ul>
        </div><!--customer-help-support-->
     </div><!--/bottom-line--> 
</div><!--/footer-->

</body>
</html>