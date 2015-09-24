<?php


	$this->load->view('header2');
	
		echo '<div class="wrapper-report">';
		
			echo form_open('e_marketing_portal/report/'.$id);
			
			echo '<div class="radio-button-container">';
			
				echo '<label>Please select</label>';
				echo '<ul>';
					echo '<li>';
						echo '<input type="radio" name="rdbReport" id="1" value="should_not_be_in_this_web_site" />I think it should not be in this web site';
					echo  '</li>';
					echo '<li>';
						echo '<input type="radio" name="rdbReport" id="2" value="not_relavent" />It is not relavent to this web site';
					echo  '</li>';
					echo '<li>';
						echo '<input type="radio" name="rdbReport" id="3" value="spam" />It is a spam';
					echo  '</li>';
					echo '<li>';
						echo '<input type="radio" name="rdbReport" id="4" value="Other" />Other';
					echo  '</li>';
				echo  '</ul>';
				
			echo '</div>';  // end radio-button-container
			
			echo '<div class="other-text">';
				echo '<label>Description</label>';
				echo '<textarea name="txtDescription" id="txtDescription" cols="47" rows="10">';
				echo '</textarea>';
				
			echo '</div>';  // end other text
			
			echo '<div class="report-button-container">';
			
				echo '<input type="submit" name="submit" id="Submit" value="Report" />';
			
			echo '</div>';  // end report-button-container
			echo form_close();
		echo '</div>';  // end wrapper-report
		
	
	
	
	
	$this->load->view('footer2');












?>