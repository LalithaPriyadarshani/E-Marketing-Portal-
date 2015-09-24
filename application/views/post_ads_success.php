 <?php 
 include('header2.php');
 include('postAds_body.php'); 
  ?>
<body>
	<p><span class="error"></span></p>
	<?php
	 $this->load->helper('form');
		echo form_open_multipart('post_ads_cont/doUpload');
		echo form_open('post_ads_cont/insertAds');
		?>
        
	<div class="wrapper">
		 <ul>   
          <?php
//						foreach ($upload_data as $item=>$value): ?> 
						<?php // endforeach; ?>					
		</ul>
        </div>
    
         <div class="successResult">
             <?php    			 
				echo'<div class="successResult">';
                echo'<label for="pageTitle" style="font-family:Arial > Your advertisement posted succesfully </label>';
				echo'</div>';
             ?>   
          </div>    <!--successResult -->
          <div class="btnViewAds">         
				<?php
					echo '<div class="btnViewAds"';
					
                 	echo '</div>';
          		?>
                </div> <!-- btnbtnViewAds -->
          </ul>    
		 <!--wrapper-->

        
       <!-- </form> -->
<?php
       echo form_close();
?>
      <!--  <p> *required field.</p>-->
</body>
        <?php	
					include('footer.php');
				?>
                <?php
					echo form_close();
				?>
</html>


<?php include('footer_no_postAds2.php')?>


