 <?php 
include('header_bootstrap.php');
?>
<script>
needToConfirm = false;
window.onbeforeunload = askConfirm;
function askConfirm() 
{
 if (needToConfirm) 
 {
 return "You have unsaved changes.";
 }       
}
</script>
<!--	<script>
		
            var myEvent = window.attachEvent || window.addEventListener;
            var chkevent = window.attachEvent ? 'onbeforeunload' : 'beforeunload'; /// make IE7, IE8 compitable
 
            myEvent(chkevent, function(e) { 
                var confirmationMessage = ' ';  
                (e || window.event).returnValue = confirmationMessage;
                return confirmationMessage;
            });
        </script> --><!--end leave page or stay on page-->
 
        
<link href="<?=base_url();?>assets/css/bootstrap.css" rel="stylesheet">
	  	<!--<form action="post.php" method="get"> 	-->
        
<body>	<?php $this->load->helper('form'); 	 echo form_open_multipart('post_ads_cont/uploadImage');	?>
        
	<div id=" wrapper">
		 <ul>   
                     <div class="postHeader">
                     <h1> <label for="pageTitle" style="font-family:Arial "> Post Advertisement </label> </h1>                    
                     </div>
                     
                 <div class="postAdsRightPanel" >
                	<label for="A"> Important</label>
                    </br>
                     <label for="rule one"> ○ Make sure you post in the correct Category</label> 
                     	
                                    <label for="ruletwo"> ○ Make sure you post pictures that match or clearly show the advertised item or service</label> 
                       	
                                    <label for="ruleT"> ○ Make sure you include text in the title or description that is related to the advertised item or service</label> 
    
                    </div> 
                 <!--post ads postAdsRightPanel-->                 
               <div class="postAdsBody">
                            <li>	
                                    <label for="category">Category</label> 
                            </li>    
                            <li>  
                                <div class="drop_down">          
                                <select name="category" onChange="this.form.submit()" id="cat">
                                    <?php 
                                        foreach($queryc as $row)
                                        {
                                            echo '<option value="'.$row->id.'">'.$row->cat_name.'</option>';								
                                        }												
                                    ?>
                                </select> 
                                </div>
                            </li>
                <div class="drop_down ">
               		<li>	
					<label for="subcategory">Sub Category</label> 
            		</li>                
               		<li>
                		<select name="Subcategory" onChange="this.form.submit()" id="subcat" >
                				<?php 
							foreach($subcat as $row)
							{
								echo '<option value="'.$row->sub_id.'">'.$row->sub_name.'</option>';								
							}												
						?>
                		</select>
                	</li>   
                </div> 
                <div class="drop_down">
                		<li>
					<label for="condition"> Item Condition </label>
                     <li>
                	<select id="condition" name="condition" onChange="ChangeDropdowns(this.value)">
                   
                    	<option value="new">New </option>
                        <option value="used">Used</option>
                        <option value="other">Other</option>
                       </select>
                        </li>
                        </li>
                        
                </div><!--end condition div-->
                <li>
					<label for="title" > Advertisement Title </label>
                    <input type ="text" name="title" value="<?php echo set_value('title'); ?>" size="50" onChange="needToConfirm=true"/>
                </li>
                
               <li>    
               <div class="radioBtnGroup">   
                   <input type="radio" name="type"  value="Private" <?php set_radio('type','1',TRUE)?> /> Private
					<input type="radio" name="type" value="Business" <?php set_radio('type','1',TRUE) ?> /> Business
                   </div>
                </li>    
                <li>
                	
					<label for="name" > Company Name </label>
                    <?php echo form_error('name');?>
                    <input type ="text" name="name" value="<?php echo set_value('name'); ?>" size="50" onChange="needToConfirm=true"/>
                </li>
				<li>
					<label for="email" >Email</label>
                    <?php echo form_error('<p>','email','</p>'); ?>
					<input type="text" name="email" value="<?php echo set_value('email'); ?>" size="50" onChange="needToConfirm=true"/>
				</li>  
				<li>
					<label for="phoneNo">Phone No   </label> 
                      <?php echo form_error('<p>','phoneNo','</p>') ?>
					<input type="text" name="phoneNo" value=" <?php echo set_value('phoneNo'); ?>" size="50" /> 
				</li>
                <div class="drop_down">   
				<li>
					<label for="location">Location  </label>
                     <li>
                	<select id="location" name="location" onChange="ChangeDropdowns(this.value)">
                   
                   
                        <option value="colombo">Colombo</option>
                        <option value="kandy">Kandy</option>
                        <option value="galle">Galle</option>
                        <option value="ampara">Ampara</option>
						<option value="anuradhapura">Anuradhapura</option>
                    	<option value="badulla">Badulla</option>
                    	<option value="batticaloa">Batticaloa</option>
                    	<option value="gampaha">Gampaha</option>
                    	<option value="hambantota">Hambantota</option>
                    	<option value="jaffna">Jaffna</option>
                    	<option value="kalutara">Kalutara</option>
                    	<option value="kegalle">Kegalle</option>
                    	<option value="kilinochchi">Kilinochchi</option>
                    	<option value="kurunegala">Kurunegala</option>
                        <option value="mannar">Mannar</option>
                        <option value="matale">Matale</option>
                        <option value="matara">Matara</option>
                        <option value="moneragala">Moneragala</option>
                        <option value="mullativu">Mullativu</option>
                        <option value="nuwara eliya">Nuwara Eliya</option>
                        <option value="polonnaruwa">Polonnaruwa</option>
                    	<option value="puttalam">Puttalam</option>
                    	<option value="ratnapura">Ratnapura</option>
                    	<option value="trincomalee">Trincomalee</option>
                    	<option value="vavuniya">Vavuniya</option>
                    
                    </select>
                </li>
					
				</li>          
                </div>
				<li>
					<label for="description">Description </label> 
					<textarea name="comment" rows="3" cols="40" value="<?php echo set_value('comment'); ?> onchange="needToConfirm=true"" ></textarea>
				</li>          
				<li>
					<label for="price"> Price (Rs.)</label>
                      <?php echo form_error('price') ?>
					<input type="text" name="price" value="<?php echo set_value('price'); ?>" size="50"  onchange="needToConfirm=true"/>
				</li>
                
              
               <div class= "chooseFile">    
				<li>
					<label for="uploadImage"> Upload Image</label>
				</li>
                              <br />           
                       
                         <li>	<input type="radio" name="mode"  value="default1" <?php set_radio('mode','1',TRUE)?> /> Set as default 
             			<input type="file" name="userfile1" id="userfile" value="" checked="checked" height="65px" width="200px" />  </li>
                        <li>	<input type="radio" name="mode" value="default2"  <?php set_radio('mode','1',TRUE)?> /> Set as default 
                        <input type="file" name="userfile2" id="userfile" value="" height="65px" width="200px"  /> </li>
	                   <li>     <input type="radio" name="mode" value="default3"  <?php set_radio('mode','1',TRUE)?>/> Set as default <?php echo "\t"?> 
                        <input type="file" name="userfile3" id="userfile" value="" height="65px" width="200px" /> </li>
						<li>	<input type="radio" name="mode" value="default4"  <?php set_radio('mode ','1',TRUE)?>/> Set as default <?php echo "\t"?>     
                        <input type="file" name="userfile4" id="userfile" value="" height="65px" width="200px" /> </li>
                        <li>	<input type="radio" name="mode" value="default5"  <?php set_radio('mode','1',TRUE)?> />Set as default  <?php echo "\t"?> 
                        <input type="file" name="userfile5" id="userfile" value="" height="65px" width="200px"  /> </li>
				
                	</div> <!--Uploadimage-->                    
                    
				 <li>
                
 <input type="checkbox" name="checkbox" value="1"> Do you like to display your advertisement on our home page </input></li>
             
                <li>  
                <div class="btn btn-default">
                	<?php echo form_submit('submit','Post My advertisement','onclick="needToConfirm=false";' ) ?>
					<?php echo form_close();?>
                    </div>
                </li>
                <?php echo form_close()?>
             </div><!--postAdsBody-->   
			
                </ul>	    
              
		</div> <!--wrapper-->
          <!-- </form> -->

<?php echo form_close();?>
      
</body>
 
</html>

<?php include('footer_bootstrap_no_post_ads.php'); ?>
