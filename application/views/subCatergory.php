<?php include ('header_bootstrap.php');?>


	<div class="panel panel-default" >
    <div class="panel-body">
    <label style="font-size:24px">Available SubCategories</label>
   

    
   
<div >

<table  class="display" id="table_id">
 <thead>
  <tr>

   

    <th>sub Category Name</th> 
   
    <th></th>
    <th></th>
   
   
    
  </tr> 
</thead>

<tbody>
  <?php foreach($query as $subCat): ?>
                    <tr>
                        <td><?php echo $subCat['sub_name'] ?></td>
                       
                        
                        <td>
                            <button type="button" data-toggle="modal" data-target="#editModel" class="btn btn-primary btn-sm" onclick="loadUpdateForm('<?php echo $subCat['sub_id'] ?>')"><span class='glyphicon glyphicon-pencil'></span></button></td>
                            <td>
                           <a class= "btn btn-danger btn-sm" onclick="return doconfirm();"  href= "<?php echo base_url();?>index.php/manageCatergory/deleteSubCat/<?php echo $subCat['sub_id'] ?>"> <span class="glyphicon glyphicon-trash"></span> </a>
                        </td>
                        <input type="hidden" id="subCat_<?php echo $subCat['sub_id'] ?>" value='<?php echo json_encode($subCat) ?>'>
                    </tr>
                    <?php endforeach ?>


</tbody>

</table>
</div>
</div>
</div>


 <div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="editModel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit SubCategories</h4>
      </div>
      <?php
        $this->load->helper('form');
        echo form_open('manageCatergory/Editsubcat'); ?>
		
        <div class="form-horizontal" role="form" id="formEdit" action="" method="post">
      <div class="modal-body">
         <div class="form-group">
               
            <div class="col-sm-9">
          
              <input type="hidden" class="form-control" id="id" name="id" placeholder="ID" readonly="readonly">
              </div>
              </div>
       
          <div class="form-group">
                <label for="catergory" class="col-sm-3 control-label">SubCategory</label>
            <div class="col-sm-9">
          
              <input type="text" class="form-control" id="subcat" name="subcat" placeholder="subCategory Name" >
              </div>
            <strong></strong> </div>
            
            </div>
            
  
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="sumbit" class="btn btn-primary" >Save</button>
      </div>
          </div>
    </div> <!--close form div -->
    <?php echo form_close(); ?>
  </div>
</div> 



  <div class="panel panel-default" >
    <div class="panel-body">
 <label style="font-size:24px">Add New Sub Category </label>
         
       <div class="form-horizontal" role="form">
         <?php  echo form_open('manageCatergory/getCatName');
		  $this->form_validation->set_error_delimiters('<div class="error" style="color:red">', '</div>');
		 ?> 
            	<div class="form-group" >
                    	<label class="col-sm-2 control-label"> Select Category </label>
                        <div class="col-xs-2" >
                        <select name="txtCat" class="form-control">
                        	<?php 
								foreach ($queryc as $row): ?>
					        <option value= "<?php echo $row['cat_name']?>"> <?php echo $row['cat_name'] ?> </option>
							 <?php endforeach ?>	
							
                        </select>
                   </div>
                   </div>
                   <div class="form-group" >
                    	<label  class="col-sm-2 control-label">Sub Category Name </label>
                         <div class="col-xs-3">
                        <input type="text" name="txtSubCat" value="" class="form-control" /> 
                        </div>
                   </div>
                     <div class="col-xs-3">
                    	<input type="submit" name="btnAddSubCat" value="Add Sub Category" class="btn btn-primary" style="margin-left:500px"; />
                   </div>
            <?php echo form_close(); ?>
            
            </div> <!--/form-sub-cat-->
         </div>
         </div>
            
            
            
            
  <script type="text/javascript">
 function loadUpdateForm(key)
    {
        var json = $('#subCat_'+key).val();
        var subcat = JSON.parse(json);
        
        $("#formEdit input[name='subcat']").val(subcat.sub_name);
		 $("#formEdit input[name='id']").val(subcat.sub_id);
		
       
    }
  
</script>

<script>
function doconfirm()
{
    job=confirm("Are you sure You want to delete this permanently?");
    if(job!=true)
    {
        return false;
    }
}
</script>


<?php include('footer_bootstrap_no_post_ads.php')?>