<?php include('header_bootstrap.php'); ?>

<html>
<body>
	<div id="wrapper-personalProfile">
    	<div class="header_profile" style="margin-left:25%">
  		<h3>My Profile</h3>
        </div>
        
        <?php
		$this->load->helper('form'); 
		echo form_open('user_controller/userProfileData');?>
        <div class="imageProfile" style="margin-left:25%">
        <img src="<?php echo base_url(); ?>addImages/personal.png" class="img-rounded" width="100px" height="100px"  />
        </div>
        <br /> 
        
              
         <?php
		 	foreach($query3 as $row)
			{
			echo '<br>';
			echo  '<form class="form-horizontal" role="form" >';
        	echo '<div class="form-group" style="margin-left:25%">';
    			echo '<label for="inputCompany" class="col-sm-2 control-label">Company Name</label>';
   					 echo '<div class="col-sm-10">';
      					echo '<input type="text" class="form-control" id="inputCompany" placeholder="Company" style="width:35%" value="'.$row->CompanyName.'" size"=50" READONLY/>';
						echo '<br />';
   					 echo '</div>';
 			echo '</div>'; 
            
                   
  			echo '<div class="form-group" style="margin-left:25%">';
    			echo '<label for="inputEmail" class="col-sm-2 control-label">Email</label>';
   					 echo '<div class="col-sm-10">';
      					echo '<input type="email" class="form-control" id="inputEmail" placeholder="Email" style="width:35%" value="'.$row->Email.'" size"=50" READONLY />';
						echo '<br />';
   					 echo '</div>';
 			echo '</div>';
            
            echo '<div class="form-group" style="margin-left:25%">';
    			echo '<label for="inputMobile" class="col-sm-2 control-label">Mobile No</label>';
   					 echo '<div class="col-sm-10">';
      					echo '<input type="text" class="form-control" id="inputMobile" placeholder="Mobile" style="width:35%" value="'.$row->MobileNo.'" size"=50" READONLY />';
						echo '<br />';
   					 echo '</div>';
 			echo '</div>'; 
           	
			echo '<div class="form-group" style="margin-left:25%">';
    			echo '<label for="City_Showroom" class="col-sm-2 control-label">Showroom</label>';
   					 echo '<div class="col-sm-10">';
      					echo '<input type="text" class="form-control" id="City" placeholder="City" style="width:35%" value="'.$row->City_Showroom.'" size"=50" READONLY />';
						echo '<br />';
   					 echo '</div>';
 			echo '</div>';
		   
  			echo '<div class="form-group" style="margin-left:10%">'; 
    			echo '<div class="col-sm-offset-2 col-sm-10">'; 
      				echo '<a class=\'btn btn-primary \' onclick=\'return confirm(\'Confirm this action?\')\' href=\'http://localhost/E_Marketing_Portal/index.php/userprofile_business_controller\'><span class="glyphicon glyphicon-pencil"></span>  Edit Profile </a>';
    			echo '</div>'; 
  			echo '</div>'; 
		echo '</form>'; 
		}
      	?>
        
	</div><!--wrapper-personalProfile-->
</body>
</html>

<?php include('footer_no_postAds.php'); ?>