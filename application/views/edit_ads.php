 <?php 
include('header_bootstrap.php');
?>

	<?php
	 $this->load->helper('form');
	$adId=$this->uri->segment(3);
	echo form_open('post_ads_cont/updateAds/'.$adId.'');
		
?>
<script src="<?= base_url();?>js/updateMyAds.js"></script>
<link href=" <?=base_url();?>assets/css/bootstrap.css" rel="stylesheet">	
<body>      
	<div id=" wrapper">
		 <ul>   
             <div class="postHeader">
             			<h1> <label for="pageTitle" style="font-family:Arial "> Edit Advertisement </label> </h1>
             	</div>
             <div class="postAdsBody">
                	<li>	
                        <label for="category">Category</label> 
           		 	</li>    
            	<li>            
               	<input type ="text" name="category" readonly="readonly" value="<?php echo set_value('subcategory',$category); ?>" size="50"/>
                </li>
                <li>	
					<label for="subcategory">Sub Category</label> 
            	</li>
                <li>
                		 <input type ="text" name="subcategory" readonly="readonly" value="<?php echo set_value('subcategory',$subcategory); ?>" size="50"/>
                
                		
                </li>    
                <li>
					<label for="title" > Advertisement Title </label>
                    <input type ="text" name="title" value="<?php echo set_value('title',$title); ?>" size="50"/>
                </li>
                
               <li>    
               <div class="radioBtnGroup">   
               		<?php 
                   		if($type=="Private"){
                     		echo form_radio('type','P',$type,'id=Private'.set_radio('type','Private')).$type;; 							
						echo '<input type="radio" name="type" value="Business" disabled="disabled"/>Business';
						}
						else if($type=="Business"){
						 echo '<input type="radio" name="type"  value="Private" disabled="disabled"/>Private';
                		 echo form_radio('type','B',$type,'id=Business'.set_radio('type','Business')).$type;;
				   		}
						else{
							echo form_radio('type','p',$type,'id=Private').'Private';
							echo form_radio('type','B',$type,'id=Business').'Business';	
						}
						
				   ?> 
					
                   
                   </div>
                </li>    
                <li>
                	
					<label for="name" > Company Name </label>
                    <?php echo form_error('name');?>
                    <input type ="text" name="name" value="<?php echo set_value('name',$name); ?>" size="50"/>
                </li>
				<li>
					<label for="email" >Email</label>
                    <?php echo form_error('<p>','email','</p>'); ?>
					<input type="text" name="email" value="<?php echo set_value('email',$email); ?>" size="50"/>
				</li>  
				<li>
					<label for="phoneNo">Phone No   </label> 
                      <?php echo form_error('<p>','phoneNo','</p>') ?>
					<input type="text" name="phoneNo" value=" <?php echo set_value('phoneNo',$phoneNo); ?>" size="50" /> 
				</li>   
				<li>
					<label for="location">Location     </label>
                      <?php echo form_error('<p>','location','</p>') ?>
					<input type="text" name="location" value=" <?php echo set_value('location',$location); ?>" size="50" />
				</li>          
				<li>
					<label for="description">Description </label> 
					<textarea name="comment" rows="3" cols="40" value="<?php echo set_value('comment',$description); ?>"" ></textarea>
				</li>          
				<li>
					<label for="price"> Price</label>
                      <?php echo form_error('price') ?>
					<input type="text" name="price" value="<?php echo set_value('price',$price); ?>" size="50"  />
				</li>
                
                
				<li>
					<label for="uploadImage"> Upload Image</label>

              </li>                    
              <li>      <div class= "Uploadimage"> 
                 
             			<input type="file" name="userfile1" id="userfile" value="" height="65px" width="200px" onClick="this.disabled=true"/> 
                        <input type="file" name="userfile2" id="userfile" value="" height="65px" width="200px" onClick="this.disabled=true" /> 
                        <input type="file" name="userfile3" id="userfile" value="" height="65px" width="200px" onClick="this.disabled=true"/> 
                        <input type="file" name="userfile4" id="userfile" value="" height="65px" width="200px" onClick="this.disabled=true"/> 
                        <input type="file" name="userfile5" id="userfile" value="" height="65px" width="200px" onClick="this.disabled=true" /> 
					</div> <!--Uploadimage-->                    
                    
				</li>
                <li>  <div class="submitButton">
               
						
	 <?php echo form_submit('submit','Edit My advertisement');?>

				
                    
			
                    </div> <!--end submit button-->
                </li>
              	 <?php echo form_close()?>
             </div><!--postAdsBody-->   
			     	</ul>
</div><!--wrapper-->

<?php echo form_close();?>
      	<script src="<?= base_url();?>assets/js/jquery-1.7.1.min.js"> </script>

</body>

 <?php //$this->load->view('footer_no_postAds.php');?>
</html>


<?php include('footer_bootstrap_no_post_ads.php')?>


