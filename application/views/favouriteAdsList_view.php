<?php include 'header_bootstrap.php'; ?>
<?php $path = base_url(); ?>

	<div id="wrapper-favouritelist" class="panel panel-default">
		<div class="Favourite Advertisement">
        	
            </div><!--Favourite Advertisement-->
            
            
            <div id="table_fav">
            	<table  class="display " id="table_id_f" cellspacing="0" width="100%"  style="margin-top:1000px;">
                	<thead>
                	<tr>
						<th>Title</th> 
                        <th>Image</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>>Mobile No </th>
						<th>Location </th>
					</tr> 
                    </thead>
                    
                    <tbody>

					<?php 
						foreach($queryf as $row)
						{	
							echo "<tr>";
							echo "<td>". $row->title ."</td>";
							
							$image='addImages/'.$row->image;
							if(file_exists($image))
							{	
								echo '<img src="'.base_url().$image.'" alt="image" width="100px" heigth="100px" />';
							}
							else 
							{
								$images = explode(',',$row->image);
								foreach($images as $i):
								{	
									echo '<img src="'.base_url().'addImages/'.$i.'" alt="image" width="100px" heigth="100px" />';
									echo "\t";
								}
								endforeach;	
							}
							
							echo "<td>". $row->image ."</td>";
							echo "<td>". $row->description ."</td>";
							echo "<td>". $row->price ."</td>";
							echo "<td>". $row->phone ."</td>";
							echo "<td>". $row->location ."</td>";
							echo "<td>";
							echo '<a class=\'btn btn-default btn-sm\' onclick="return doconfirm();" href="<?php echo base_url(); ?>/index.php/user_controller/removeFavourites/'.$row->id .'\'> <span class=\'glyphicon glyphicon-trash\'></span>Remove</a>';
           					echo "</td>";
							echo "</tr>";   
						}
					?>
                    
                    </tbody>
				</table>
			</div><!--table_fav-->
            
            
            
            
 
    </div><!--wrapper-favouritelist-->

</body>
</html>



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


