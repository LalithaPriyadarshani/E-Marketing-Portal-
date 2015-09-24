<?php


	$this->load->view('header2');
	
	echo '<div class="login-wrapper">';
	
		echo '<div class="controllers-container">';
		
			echo form_open('e_marketing_portal/log_in');		
			echo '<ul>';
				echo '<li>';
					echo '<label>E-mail</label>';
					echo '<input type="text" id="txtEmail" name="txtEmail" value="" />';
				echo '</li>';
				echo '<li>';
					echo '<label>Password</label>';
					echo '<input type="password" id="txtPword" name="txtPword" value="" />';
				echo '</li>';
				echo '<li>';
					echo '<input type="submit" id="btnLogin" name="btnLogin" value="Sign in" />';
				echo '</li>';
			echo '</ul>';
		
			echo form_close();
		echo '</div>'; // end controllers-container 
		
		
		if(isset($this->session->userdata['errorMsg'])){ // check errors in login page
			$visible = $this->session->userdata['errorMsg'];	
		}
		else{
			$visible = 'hidden';	
		}
			
		echo '<div class="error-container" style="visibility:'.$visible.'">';
			echo 'Username or Password Error';
			echo '</br>';
			echo 'Please Check Againg';
		echo '</div>'; // end error-container
		
	echo '</div>'; // end login-wrapper
	
	
	
	


	$this->load->view('footer_no_postAds2');

?>