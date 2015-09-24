 <?php 
 include('header2.php');
 include('postAds_body.php'); 
 ?>
 
 <body>
 <?php
	 $this->load->helper('form');
		echo form_open('post_ads_cont/selectUsers');
		//echo form_open_multipart('users_rules_cont/');
?>

      
       
	 <?php 
	 	
	 	echo '<table border="0" cellpadding="30" cellspacing="0"> ';
	 	echo '<tr> ';
			echo '<th> Registered ID  </th> ' ,'<th> Name </th> ' , '<th> Account Type  </th>','<th>  Rules </th>' ;				
		echo '</tr>';
		
		echo '<tr>';
			foreach($regusers as $item): {			
			echo '<td> '.$item['RegistrationId'].' </td>';
			echo '<td> '.$item['FirstName'].' '.$item['LastName'].' </td>';
			echo '<td> '.$item['AccountType'].' </td>';
			echo '<td> <input type="Submit" value="Edit rules" width="100"> </td>';
			echo '</tr>';
			}
			endforeach;
		echo '</table>'; 
	 ?> 
     
        
  <?php echo form_close(); ?>
   <?php echo form_close(); ?>
 </body>
<?php $this->load->view('footer2.php'); ?>