
<?php include 'header_bootstrap.php' ?>

<div class="panel panel-default">
<div class="panel-body">
   <div class="panel-heading" style="font-size:24px">Search Results</div>
   </div>
         <!--start: Agent Form-->
        
        <div class="form-horizontal" role="form" id="formAdd" >
      
     <?php echo form_open('memSearchData_controller'); ?>
  
        <?php 
       foreach($querym as $row)
					{
            echo '<div class="form-group">';
             echo   '<label for="key" class="col-sm-3 control-label">Name</label>';
             echo '<div class="col-sm-9">';
               
           echo  '<input type="text" class="form-control" id="name" style="width:300px" name="name"  value="'.$row->FirstName. " " .$row->LastName.'"  READONLY>';
           echo  '</div>';
           echo  '</div>';
		   
           echo '<div class="form-group">';
             echo   '<label for="key" class="col-sm-3 control-label"> Company Name</label>';
             echo '<div class="col-sm-9">';
               
           echo  '<input type="text" class="form-control" id="comname" style="width:300px" name="comname"  value="'.$row->CompanyName.'" READONLY>';
           echo  '</div>';
           echo  '</div>';
          echo '<div class="form-group">';
          echo   '<label for="key" class="col-sm-3 control-label"> Mobile number</label>';
          echo '<div class="col-sm-9">';
               
           echo  '<input type="text" class="form-control" id="mobileNo" style="width:300px" name="mobileNo"  value="'.$row->MobileNo.'" READONLY>';
           echo  '</div>';
           echo  '</div>';
         echo '<div class="form-group">';
             echo   '<label for="key" class="col-sm-3 control-label"> City/Show Room</label>';
             echo '<div class="col-sm-9">';
               
           echo  '<input type="text" class="form-control" id="city" style="width:300px" name="city"  value="'.$row->City_Showroom.'" READONLY>';
           echo  '</div>';
           echo  '</div>';
					}
					?>
          
            
      </div>
      
          </div>
          </div>
         
<!--end: Agent Form-->
    </div>
  
  
  <?php include('footer_bootstrap_no_post_ads.php')?>
  
  