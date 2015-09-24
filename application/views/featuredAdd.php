<?php include 'header2.php'; ?>
  <div class="wrapper-FAds">
            	<ul style="list-style:none">
            		
                  <?php 
				  $path = base_url();
				 
                foreach($fAds as $row){
					{
					echo '<li>';
        				echo '<div class="wrapper-FAdd1" style="float:left;margin:5px">';//<!--show only 3 ads on the home page-->
                        echo  "<label>". $row->title."</label>";
                         echo  '<div class="image-FAds">';
						 echo '<img src="'.$path.'addImages/'. $row->image .'"  width="200px" height="160px"';
                           		
                          echo "</div>";//<!--/image-FAds-->
                          echo '<div class="price-FAds" style="margin-top:-150px ; margin-left:210px">';
                          echo 	"<label>Price $row->price </label>";
                           echo "</div>";//<!--price-FAds-->
                           echo '<div class="location-FAds" style="margin-top:-100px ; margin-left:210px">';
                           	echo	"<label>$row->location </label>";
                          echo "</div>";//<!--location-FAds-->
                          echo '<div class="viewMore-FAds"style="margin-top:-50px ; margin-left:210px">';
                          echo anchor('featuredAdd_controller/displayAds?id='.$row->id,'More','title="View More About This Ad"');  
                          echo "</div>";//<!--viewMore-FAds-->
            			echo "</div>";//<!--wrapper-FAdd1-->
						echo '</li>';
					}
					
				}
						?>
                        
                  
                    
            	</ul> 
            </div><!--/wrapper-FAds-->
            
            
            
            
            <?php include('footer_no_postAds2.php')?>
			