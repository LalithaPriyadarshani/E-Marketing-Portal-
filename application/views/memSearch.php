<?php include 'header_bootstrap.php'; ?>

<div class="advanced-wrapper">
	<label>Advanced Search</label>
	<div class="side-bar">
		<div class="item-search">
        	Items
        </div><!-- /item-search -->
        <ul>
        	<li>
            	<a href="<?php echo site_url('e_marketing_portal/displayAdvancedSearch');?>">Find items</a>
            </li>
        </ul>
     	<div class="member-search">
        	Members
        </div><!-- /member-search -->
        <ul>
        	<li>
            	<a href="">Find a member</a>
            </li>
        </ul>
	</div><!-- /side-bar -->


<div class="item-search-wrapper"  id="panel">
<?php echo form_open('memSearch_controller/checkCaptcha');
$this->form_validation->set_error_delimiters('<div class="error" style="color:red">', '</div>'); ?>
 <div class="panel-heading" style="font-size:24px">Find a member</div>
  
    	<div class="panel-body" >
        <div class="form-horizontal" role="form">
       <div class="form-group">
       <label class="col-sm-2 control-label" style="font-size:14px" >Enter Email address</label>
       
        <div class="col-xs-3" >
         <?php echo form_error('email') ?>
       <input type="text" name="email"  class="form-control"  placeholder="Email Address of the member" value="<?php echo set_value('email');?>" onchange="needToConfirm=true" />
       </div>
       </div>
      
       <div class="form-group">;
       <label class="col-sm-2 control-label" style="font-size:14px">Enter verification code hidden in the image</label>
       <?php echo form_error('code') ?>
        <div class="col-xs-3" >
       <input type="text" name="code" class="form-control" value="<?php echo set_value('code');?>" onchange="needToConfirm=true" />
       <div style="margin-left:300px;margin-top:-30px">  
  
         <?php echo $captcha ?>
      <button type="button" class="btn btn-default btn-lg" data-container="body" data-toggle="popover" data-placement="top" data-content="This extra security check helps to prevent  inappropriate use of the site" style="margin-left:150px;margin-top:-40px">
  <span class="glyphicon glyphicon-question-sign"></span> 
</button>

         </div>
         <div class="col-xs-3">
         <input type="submit" name="btnSearch" value="Search" class="btn btn-primary" onclick="needToConfirm=false" />
         </div>
       </div>
       </div>
 
      </div>
</div>
<?php echo form_close(); ?>


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

<script>$(function () 
      { $("[data-toggle='popover']").popover();
      });
   </script>
</div>

<?php include('footer_bootstrap_no_post_ads.php')?>

