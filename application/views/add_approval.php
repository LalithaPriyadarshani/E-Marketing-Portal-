<?php
	include('header_bootstrap.php');
	//include('postAds_body.php');
	 ?>   
     <link href=" <?=base_url();?>assets/css/jquery.dataTables.css" rel="stylesheet">
     <link href="<?=base_url();?>"assets/css/dataTables.editor.min.css" rel="stylesheet">
<link href=" <?=base_url();?>assets/css/bootstrap.css" rel="stylesheet">	

     <script> </script>
<body>  
	<?php  $this->load->helper('form');
	
	echo form_open('ads_approve_cont/setStatus');	
	?>

   
   		<!--line 1-->
                
            <div class="btnapprove" style="height:400px">
              
              
             
                
                <?php 
					  	echo '<table id="table_id" class="display">';                	
						echo '<thead>';
					   echo '<tr>';
					    echo '<th> Title </th>';
						echo '<th>Images</th>';
						echo '<th>';echo '</th>';
						echo '<th>';echo '</th>';
					   echo '</tr>';
					echo '</thead>';
					echo '<tbody>';
				
                	foreach($querya as $item){
					 	echo "<tr>";
					 
					    echo "<td>". $item->title ."</td>";
							
						echo "<td>".'<img src="'.base_url().'addImages/'.$item->image.'" alt="image" width="100px" heigth="100px" />'."</td>";
						//echo "<td>".'<img src="<?php echo site_url();
						echo "<td>";
						
							echo anchor(array('ads_approve_cont/approve', $item->id),'Approve','title="Get Full Information"');
						echo "</td>";
						
			
						echo '<td>';						
					  	echo anchor(array('ads_approve_cont/remove', $item->id),'Dissaprove','title="Get Full Information"'); 
						echo "</td>";				
				
								
					}
					
					
                ?>              
               
                </tbody>
              </table>                          
              </div><!-- /btnapprove-->
          
          
 </body>
 
 <script src="<?= base_url();?>assets/js/jquery.js"></script>
</body>
</html>
<?php include('footer_bootstrap_no_post_ads.php')?>