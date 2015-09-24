<?php include('header_bootstrap.php'); ?>

	<div id="wrapper-personal-account">
    	<div class="header_profile" style="margin-left:25%">
  		<h3>My Profile</h3>
        </div>
        
	  <?php
		$this->load->helper('form'); 
		echo form_open('userprofile_personal_controller/updateDetails');?>
        
        <div class="imageProfile" style="margin-left:25%">
        <img src="<?php echo base_url(); ?>addImages/personal.png" class="img-rounded" width="100px" height="100px"  />
        </div>
        <br />  
          
         <div class="UserProfileDetails">
        
                 
					<?php
		 	foreach($query1 as $row)
			{
			echo '<br>';
			echo  '<div class="form-horizontal" role="form" >';
        	echo '<div class="form-group" style="margin-left:25%">';
    			echo '<label for="FirstName" class="col-sm-2 control-label">First Name</label>';
   					 echo '<div class="col-sm-10">';
      					echo '<input type="text" class="form-control" id="FirstName"  style="width:35%" value="'.$row->FirstName.'" size"=50" READONLY/>';
						echo '<br />';
   					 echo '</div>';
 			echo '</div>'; 
            
            echo '<div class="form-group" style="margin-left:25%">';
    			echo '<label for="LastName" class="col-sm-2 control-label">Last Name</label>';
   					 echo '<div class="col-sm-10">';
      					echo '<input type="text" class="form-control" id="LastName"  style="width:35%" value="'.$row->LastName.'" size"=50" READONLY />';
						echo '<br />';
   					 echo '</div>';
 			echo '</div>'; 
            
			echo '</div>';
			}
			?>
                     
          <div class="ChangeDetails" style="margin-left:25%">
  			<h3>Change Details</h3>
         </div>
         
         <form class="form-horizontal" role="form" >
         	<div class="form-group" style="margin-left:25%">
    			<label for="inputEmail" class="col-sm-2 control-label">Email</label>
   					 <div class="col-sm-10">
                     	
      					<?php echo '<input type="email" name="Email" class="form-control" id="Email"  style="width:35%" value="'.$row->Email.'" size"=50"  required="required"/>' ?>
						<br />
   					 </div>
 			</div>
         
         	<div class="form-group" style="margin-left:25%">
            	<label id="lblcurrentPassword" for="inputcurrentPassword" class="col-sm-2 control-label">Current Password</label>
   				<div class="col-sm-10">
      				<input type="password" class="form-control" name="currentPassword" id="currentPassword" placeholder="Enter Your Current Password" required="required" style="width:35%" size"=50"/>
					<br />
   				</div>
            </div>
            
            <div class="form-group" style="margin-left:25%">
            	<label id="lblnewPassword" for="inputnewPassword" class="col-sm-2 control-label">New Password</label>
   				<div class="col-sm-10">
      				<input type="password" class="form-control" name="newPassword" id="newPassword" placeholder="Enter Your New Password" style="width:35%" size"=50"/>
					<br />
   				</div>
           	</div>
            
            <div class="form-group" style="margin-left:25%">
            	<label id="lblpasswordConfirmation" for="inputpasswordConfirmation" class="col-sm-2 control-label">Password Confirmation</label>
   				<div class="col-sm-10">
      				<input type="password" class="form-control" name="passwordConfirmation" id="passwordConfirmation" placeholder="Enter Your New Password " style="width:35%" size"=50"/>
					<br />
   				</div>
           	</div>
            
            <div class="form-group" style="margin-left:25%">
            	<label id="lblMobileNo" for="inputMobileNo" class="col-sm-2 control-label">Mobile No</label>
   				<div class="col-sm-10">
      				<?php echo '<input type="text" class="form-control" name="MobileNo" id="MobileNo"  style="width:35%" value="'.$row->MobileNo.'"size"=50"/>' ?>
					<br />
   				</div>
           	</div>

             <div class="form-group" style="margin-left:25%">
            	<label id="lblCity" for="inputCity" class="col-sm-2 control-label">City</label>
   				<div class="col-sm-10">
                    <div class="btn-group">
  						<?php echo form_open(); ?>  
                			<?php $city = array(
	
                            '0'       =>  'Select a location',
                            'option1'       =>  'Colombo',
                            'option2'       =>  'Kandy',
                            'option3'       =>  'Galle',
							'option4'       =>  'Ampara',
                            'option5'       =>  'Anuradhapura',
                            'option6'       =>  'Badulla',
							'option7'       =>  'Batticaloa',
                            'option8'       =>  'Gampaha',
                            'option9'       =>  'Hambantota',
							'option10'       =>  'Jaffna',
                            'option11'       =>  'kalutara',
                            'option12'       =>  'Kegalle',
							'option13'       =>  'Kilinochchi',
                            'option14'       =>  'Kurunegala',
                            'option15'       =>  'Manner',
							'option16'       =>  'Matale',
                            'option17'       =>  'Matara',
                            'option18'       =>  'Moneragala',
							'option19'       =>  'Mullativu',
                            'option20'       =>  'Nuwara Eliya',
                            'option21'       =>  'Polonnaruwa',
							'option22'       =>  'Puttalama',
							'option23'       =>  'Rathnapura',
							'option24'       =>  'Trincomalee',
							'option25'       =>  'Vavuniya',

               		 );
					  echo form_dropdown('dropdown_menu',$city,'0'); ?>
            		<?php  form_close(); ?> 
					</div>
					<br />
   				</div>
           	</div>
            
             <div class="form-group" style="margin-left:25%"> 
           	    <div class="col-sm-offset-2 col-sm-10">
                	 <?php echo '<button type="submit" class=\'btn btn-primary \'><span class="glyphicon glyphicon-user"></span>  Update Details </button>'; ?>
           		</div>
           </div>
           
           <?php
						if(isset($this->session->userdata['errorMsg'])){ // check errors in login page
			       		$visible = $this->session->userdata['errorMsg'];	
		           		}
		              else{
						$visible = 'hidden';	
		          		}
						echo '<div class="error-container" style="visibility:'.$visible.'" >';
					    echo 'Please insert correct password';
			
					echo '</div>';
					?>
                            
                     <?php form_close(); ?>
         
          
                 </form>
              </div><!--/UserProfileDetails-->
                    
       
    </div><!--/wrapper-->

<?php include('footer_bootstrap_no_post_ads.php'); ?>