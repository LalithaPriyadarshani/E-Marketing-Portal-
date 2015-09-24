<?php include 'header_bootstrap_signIn.php'; ?>

	<div id="wrapper-contactUs" class="panel panel-default">
    	<div class="header_profile" style="margin-left:10%">
  		<h3>Contact Us</h3>
        <p><b>If you did not find the answer to your question or problem on this page, then please get in touch with us using the form below. We endeavor to answer your messages as soon as possible.</b></p>
        </div>
        <br/>
  		<?php echo form_open('user_mail/contactMail'); ?>
		<div class="form-horizontal" role="form">
        	<div class="form-group">
    			<label for="inputName" class="col-sm-2 control-label">Your Name</label>
   					 <div class="col-sm-10">
      					 <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Name"  style="width:35%">
   					 </div>
 			</div> 
            
  			<div class="form-group">
    			<label for="inputEmail" class="col-sm-2 control-label">Your Email</label>
   					 <div class="col-sm-10">
      					<input type="email" class="form-control" name="inputEmail" id="inputEmail" placeholder="Email" style="width:35%">
   					 </div>
 			</div>
            
            <div class="form-group">
    			<label for="inputSubject" class="col-sm-2 control-label">Subject</label>
   					 <div class="col-sm-10">
      					<input type="text" class="form-control" id="inputSubject" name="inputSubject" placeholder="Subject" style="width:35%">
   					 </div>
 			</div> 
            
            <div class="form-group">
    			<label for="inputMessage" class="col-sm-2 control-label">Your Message</label>
   					 <div class="col-sm-10">
      					<textarea class="form-control" rows="3" style="width:35%" id="inputMessage"  name="inputMessage" placeholder="Message"></textarea>
   					 </div>
 			</div>
            
  			<div class="form-group">
    			<div class="col-sm-offset-2 col-sm-10">
                <?php echo '<button type="submit" class=\'btn btn-primary \'><span class="glyphicon glyphicon-envelope"></span>  send Your Message </button>'; ?>
      				
    			</div>
  			</div>
		</div>
      <?php form_close() ?>
	</div><!--wrapper-contactUs-->
</body>
</html>


<?php include('footer_bootstrap_no_post_ads.php')?>