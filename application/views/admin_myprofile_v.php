<?php include ('header_bootstrap.php');
$this->load->helper('form');
	
 echo form_open('admin_myprofile_cont/EditDetails') 
 ?>


 <link href=" <?=base_url();?>assets/css/jquery.dataTables.css" rel="stylesheet">
     <link href="<?=base_url();?>"assets/css/dataTables.editor.min.css" rel="stylesheet">
<link href=" <?=base_url();?>assets/css/bootstrap.css" rel="stylesheet">	

   <?php
   
    echo '<img src="'.base_url().'images/gradmale_avatar.png" alt="image" width="100px" heigth="100px" />'; 
   
     foreach($query as $item){
				echo '<div class="form-group" style="margin-left:25%">';
					 
	echo ' <div class="adminDetails">  <span class="glyphicon glyphicon-user"></span> <label> User Name </label> </div> ';
	 echo '<input type="text" name="firstname" value="'.$item->FirstName.'"width="100" disabled/>' ;
     
	   echo ' <div class="adminemail">  <span class="glyphicon glyphicon-user"></span> <label> E mail </label></div> ';
	   echo '<input type="text" name="email" value="'.$item->Email.'" width="100"/>' ;
	 
		echo'   <h3>Edit Details</h3>   ';
		echo ' <div class="adminpasswords">  <span class="glyphicon glyphicon-user"></span> <label>Current Password </label> </div> ';
		echo '<input type="password" id ="currentPassword" name="currentPassword" value="" width="100"/>' ;
	  
		echo ' <div class="adminpasswords">  <span class="glyphicon glyphicon-user"></span> <label>New Password </label> </div> ';
		echo'<input type="password" name="newPassword"  value=""width"=100"/>   ';
		echo ' <div class="adminpasswords">  <span class="glyphicon glyphicon-user"></span> <label>Retype New Password </label> </div> ';
		echo'<input type="password" name="passwordConfirmation"  value=""width"=100"/>' ; 
	echo '</br>' ;
		 	// echo	anchor(array('admin_myprofile_cont/EditDetails',$item->RegistrationId), 'Edit Details'); echo '</br>' ;			 
			//echo form_submit('submit','Post My advertisement');
			 $id=$item->RegistrationId;
			echo "<input type='hidden' name='id' value='{$id}'>";
echo'			</br>';
			echo '<input type="submit" name="submit" value="Submit" class="btn btn-primary">';
echo'			</div>';
 		}
		?>					

  
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
 
<? include'footer_bootstrap_no_post_ads.php';?> 
