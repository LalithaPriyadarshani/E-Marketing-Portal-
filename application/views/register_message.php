<?php include('header_bootstrap_signIn.php'); ?>

	<div id="wrapper-register" >
		<h2><B>Register</B></h2>
        <?php $this->load->helper('form'); ?>
              
        	<?php echo form_open('register/createAccount'); ?>
        	        	
	  
         <div class="form-group" style="margin-left:17%">
         <label id="lblCreateYour" for="inputCreateYour"  >CreateYour</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             <input type="radio"  name="Account" value="Personal Account" id="PersonalChk" class="Personal Account" checked="checked"  <?=set_radio('Account','Personal Account')?> onClick="javascript:radioBtnCheck()">Personal Account</input>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        	<input type="radio" name="Account" value="Business Account" id="BusinessChk" class="Business Account" <?=set_radio('Account','Business Account')?> onClick="javascript:radioBtnCheck()">Business Account </input>
        	
          </div> 
     
         <br/>
         
         <div class="form-horizontal" role="form" >
         	<div id="idCompanyName">
         	<div class="form-group" style="margin-left:10%" >
             	<label id="lblCmpName" for="inputCompany"  class="col-sm-2 control-label">Company Name</label>
   				<div class="col-sm-10">
   				<input type="text"  class="form-control" id="CompanyName" name="CompanyName"  placeholder="Enter Company Name" style="width:35%" size"=50"/>
					<br />
   				</div>			
       		</div>
            </div>
            
            <div id="idFirstName"> 
                       
        	<div class="form-group" style="margin-left:10%">
            	<label id="lblFname" for="inputFirst"  class="col-sm-2 control-label">First Name</label>
   				<div class="col-sm-10">
   				
      				<input type="text" class="form-control" id="FirstName" name="FirstName" placeholder="Enter Your First Name"  style="width:35%" size"=50"/>
					<br />
   				</div>
            </div>
                        
            <div class="form-group" style="margin-left:10%" >
            	<label id="lblLname" for="inputLast" class="col-sm-2 control-label">Last Name</label>
   				<div class="col-sm-10">
      				<input type="text" class="form-control" id="LastName" name="LastName" placeholder="Enter Your Last Name" style="width:35%" size"=50"/>
					<br />
   				</div>
            </div>
            
            </div>
                        
            <div class="form-group" style="margin-left:10%" >
            	<label id="lblEmail" for="inputEmail" class="col-sm-2 control-label">Email</label>
                 
   				<div class="col-sm-10">
      				<input type="email" class="form-control" id="Email" name="Email" placeholder="Enter Your Email"  required="required" style="width:35%" size"=50"/>
					<br />
   				</div>
           	</div>
                        
            <div class="form-group" style="margin-left:10%">
            	<label id="lblPassword" for="inputPassword" class="col-sm-2 control-label">Password</label>
   				<div class="col-sm-10">
      				<input type="password" class="form-control" name="Password"  id="Password" placeholder="Enter Your Password" required="required" style="width:35%" size"=50"/>
					<br />
   				</div>
            </div>
                        
            <div class="form-group" style="margin-left:10%">
            	<label id="lblConfirmPassword" for="inputConfirmPassword" class="col-sm-2 control-label">Confirm Password</label>
   				<div class="col-sm-10">
      				<input type="password" class="form-control" name="ConfirmPassword" id="ConfirmPassword" placeholder="Enter Your Password" required="required" style="width:35%" size"=50"/>
					<br />
   				</div>
           	</div>
           
           	<div class="form-group" style="margin-left:10%"> 
           	    <div class="col-sm-10">
                	<input type="radio" name="rbnTermsAndConditios" value="Terms" required="required" >  By registering for an account on this site you agree to Terms and Conditions and Privacy Policy in this website.</input>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
           </div>
           
           <div class="form-group" style="margin-left:10%"> 
           	    <div class="col-sm-offset-2 col-sm-10">
                                <?php echo '<button type="submit" class=\'btn btn-primary \'><span class="glyphicon glyphicon-user"></span>    Create Your Account </button>'; ?>

           		</div>
           </div>
           
            <?php echo form_close();?>
	    
            
                     
		</div>
     
    
                
    </div><!--/wrapper-registe-->
<?php include('footer_bootstrap_no_post_ads.php')?>


<script type="text/javascript">

function radioBtnCheck() {
    if (document.getElementById('PersonalChk').checked)
	 {
		document.getElementById('idCompanyName').style.display='none';
		document.getElementById('idFirstName').style.display='block';
		
    } else if(document.getElementById('BusinessChk').checked)
	{
		document.getElementById('idFirstName').style.display='none';
		document.getElementById('idCompanyName').style.display='block';
    }
}

window.onload=function onloadform(){
		document.getElementById('idCompanyName').style.display='none';
		document.getElementById('idFirstName').style.display='block';
	
}
</script>







