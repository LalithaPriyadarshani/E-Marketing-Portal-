<?php include ('header_bootstrap.php');?>

	<div class="panel panel-default" >
    <div class="panel-body">
    <label style="font-size:24px">Available Categories</label>
   

    
   
<div >
<? echo heading('List of catergories',3); ?>

<table  class="display" id="table_id">
 <thead>
  <tr>

   

    <th>Category Name</th> 
   
    <th></th>
    <th></th>
   <th></th>
   
    
  </tr> 
</thead>

<tbody>
  <?php foreach($queryc as $Cat): ?>
                    <tr>
                        <td><?php echo $Cat['cat_name'] ?></td>
                        <td>
                        <a class= "btn btn-primary btn-sm" onclick="return confirm(\'Confirm this action?\')"  href="<?php echo base_url(); ?>index.php/manageCatergory/loadSubcats/<?php echo $Cat['id'] ?>"> <span class="glyphicon glyphicon-list-alt ">View SubCategories</span> </a>
                        </td>
                        
                        <td>
                            <button type="button" data-toggle="modal" data-target="#editModel" class="btn btn-primary btn-sm" onclick="loadUpdateForm('<?php echo $Cat['id'] ?>')"><span class='glyphicon glyphicon-pencil'></span></button></td>
                            <td>
                           <a class= "btn btn-danger btn-sm" onclick="return doconfirm();"  href= "<?php echo base_url(); ?>index.php/manageCatergory/delete/<?php echo $Cat['id'] ?>"> <span class="glyphicon glyphicon-trash"></span> </a>
                        </td>
                        <input type="hidden" id="Cat_<?php echo $Cat['id'] ?>" value='<?php echo json_encode($Cat) ?>'>
                    </tr>
                    <?php endforeach ?>


</tbody>

</table>
</div>
</div>
</div>

<div class="panel panel-default" >
    <div class="panel-body">
 <label style="font-size:24px">Add New Category </label>

 
 <div class="form-horizontal" role="form">
 <?php
 		$this->load->helper('form');
        echo form_open('manageCatergory/save'); 
		$this->form_validation->set_error_delimiters('<div class="error" style="color:red">', '</div>');
		   
    ?>		
         
         	<div class="form-group" >
                	<label class="col-sm-2 control-label"> Category Name </label>
                    <?php echo form_error('txtCatName') ?>
                     <div class="col-xs-3">
                    <input type="text" name="txtCatName" value="<?php echo set_value('txtCatName');?>" class="form-control" />
                    </div>
                    </div>
                  
                    
                <div class="col-xs-3">
                	<input type="submit" name="submit" value="Add Category" class="btn btn-primary" style="margin-left:500px"/>
                </div>
               
         <?php echo form_close(); ?>
         <?php
         if(isset($this->session->userdata['flashSuccess'])){ // check errors in login page
			$visible = $this->session->userdata['flashSuccess'];	
		}
		else{
			$visible = 'hidden';	
		}
			
		 // end error-container
		
         
echo '<p class=\'flashMsg flashSuccess\' style="visibility:hidden"> </p>' ?>

         </div>
         </div>
                
         </div ><!--/form1-wrapper-->
         

         
   <div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="editModel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit Categories</h4>
      </div>
      <?php
        $this->load->helper('form');
        echo form_open('manageCatergory/Edit'); ?>
		
        <div class="form-horizontal" role="form" id="formEdit" action="" method="post">
      <div class="modal-body">
         <div class="form-group">
               
            <div class="col-sm-9">
          
              <input type="hidden" class="form-control" id="id" name="id" placeholder="ID" readonly="readonly">
              </div>
              </div>
       
          <div class="form-group">
                <label for="catergory" class="col-sm-3 control-label">Category</label>
            <div class="col-sm-9">
          
              <input type="text" class="form-control" id="cat" name="cat" placeholder="Category Name" >
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

  <script type="text/javascript">
 function loadUpdateForm(key)
    {
        var json = $('#Cat_'+key).val();
        var cat = JSON.parse(json);
        
        $("#formEdit input[name='cat']").val(cat.cat_name);
		 $("#formEdit input[name='id']").val(cat.id);
		
       
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