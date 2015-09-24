 <?php 
 include('header2.php');
 include('postAds_body.php'); 
 ?>


<body>

	<?php 
	/*<div id="wrapper">
		<div class= "table">
		</div>
	</div>*/
		echo '<input type="Submit" width="10" value="Add Rule">';
		echo '<table border="2" cellpadding="4" cellspacing="0">'; 
			echo '<tr>';
				echo '<th> Rule </th> ','<th> Actions </th>';
		
		
			echo '<tr>';	
	 			echo '<td> Email  </td>';
				echo '<td>  
							<input type="radio" name="type"  value="Include" >
						   <input type="radio" name="type" value="Exclude">
                  
				</td>';
			echo '</tr>';	
			
			echo '<tr>';	
	 			echo '<td> Phone No  </td>';
				echo '<td>  
						<input type="radio" name="type"  value="Include" >
						   <input type="radio" name="type" value="Exclude">
					</td>';
			echo '</tr>';	
			
			
			echo '<tr>';	
	 			echo '<td> Price  </td>';
				echo '<td>  
							<input type="radio" name="type"  value="Include" >
						   <input type="radio" name="type" value="Exclude">
						    </td>';
			echo '</tr>';	
				
  		echo '</table>'; 
     
	?>
    
</body>
<?php $this->load->view('footer2.php'); ?>