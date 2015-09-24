<?php
	include('header_bootstrap.php');
	$this->load->helper('form');
	$this->load->helper('url');
?>
<link href=" <?=base_url();?>assets/css/bootstrap.css" rel="stylesheet">	
<body> 

<?php 		
					
					echo ' <div class="col-md-12" >';
					echo '<h4> My Advertisements </h4>';
					echo '<table id="table_id" class="display">';                	echo '<thead>';
					   echo '<tr>';
					    echo '<th> Title </th>';
						echo '<th>Images</th>';
						echo '<th>';echo '</th>';
						echo '<th>';echo '</th>';
					   echo '</tr>';
					echo '</thead>';
					echo '<tbody>';
					foreach($query as $item):
					{	
					
							echo '<tr>';
									 	
								echo '<td class="col-md-2" >'. $item->title ."</td>";	
								echo '<td class="col-md-9">';									
								$image='addImages/'.$item->image;
								
								//echo $image;
								if(file_exists($image)){	
								
									echo '<img src="'.base_url().$image.'" alt="image" width="100px" heigth="100px" />';
												
									}
									else {
										$images = explode(',',$item->image);
										foreach($images as $i):{
//											echo base_url().'addImages/'.$i;	
									echo '<img src="'.base_url().'addImages/'.$i.'" alt="image" width="100px" heigth="100px" />';
										echo "\t";
										//echo base_url().'images/'.$i;
										
										}
										endforeach;	
									}										
								echo '</td>';
								echo'<td  class ="col-md-12">';
									echo' <div class="row text-center" style="width:auto">';
										$id= $item->id;
											echo '<a href="'.site_url().'/e_marketing_portal/view_more/'.($id).'"; class="btn btn-default" >view more </a>';
											//echo '<a href="'.site_url().'/e_marketing_portal/view_more/'.($id).'"; class="fa fa-caret-square-o-right" data-toggle="modal"   data-target="#basicModal">view more </a>';
											echo "<td>";
											
											echo '<a href="'.site_url().'/post_ads_cont/populateAds/'.($id).'"; class="btn btn-default" >Edit My Advertisement</a>';
										
									echo'</div>';
								 "</td>";
									//echo site_url().'/upload/popup/'.$data;
									// data-toggle="modal"   data-target="#basicModal"			
							echo "</tr>";
					}endforeach;		
	 
				echo '</tbody>';	
				echo '</table>';		

				?>		
</div> <!--/btnapprove-->
			<!--wrapper-content-->
 
                         <!-- make the popup-->
			<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
		      <div class="modal-dialog">
        		<div class="modal-content">
		         	 <div class="modal-header">
                     	 
        		    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		           	<!-- <h4 class="modal-title" id="myModalLabel">Basic Modal</h4>-->
        			 </div>
	         		<div class="modal-body">
 		               <?php   
				   			echo  "<table>";
					   			foreach($query as $item){

									echo "<tr>";							
									echo "<td> <h3>".'Title'."</h3> ".$item->title."</td>";
									echo "</tr>";
									
									echo "<tr>";							
									echo "<td> <h3>".'Price'."</h3> ".$item->price."</td>";
									echo "</tr>";
							
									echo "<tr>";							
									echo "<td> <h3>".'Description'."</h3> ".$item->description."</td>";
									echo "</tr>";
									
									
									echo "<tr>";							
									echo "<td> <h3>".'Location'."</h3> ".$item->location."</td>";
									echo "</tr>";
									
									echo "<tr>";							
									echo "<td> <h3>".'Date'."</h3> ".$item->added_date."</td>";
									echo "</tr>";
						
						}
						echo "</table>"
				?>
          			</div>
         			<div class="modal-footer">
           				 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         			</div>
        		</div>
     		</div>
	    </div>    
                        
    
	<script src="<?= base_url();?>assets/js/jquery-1.7.1.min.js"> </script>
    <script src="<?= base_url();?>assets/js/bootstrap.min.js"></script>
       <!--for page table propertie-->  
	<script src="<?= base_url();?>assets/js/jquery.js"></script>
</body>
</html>
<?= include('footer_bootstrap_no_post_ads.php') ?>