
<?php include('header_bootstrap.php'); 
?>
<div>
<div id="wrapper" class="panel panel-default" style="height:400px">
<table  class="display" id="table_id">
 <thead>
  <tr>

    <th>Reason</th>

    <th>Number of reports</th>   
    <th>Title</th>
    <th>Description</th>   
   <th>Images</th>
     <th> </th>   
     <th></th>
     <th></th>      

  </tr> 
</thead>

<tbody>
<?php 

foreach($querya as $row)
			{

	echo "<tr>";
	echo "<td>". $row->ReportDescription ."</td>";

    echo "<td>". $row->totAds ."</td>";

    echo "<td>". $row->title ."</td>";
	
	$path = base_url();
	echo "<td>". $row->description."</td>";

	echo '<td>';
		 	
		echo '<img src="'.base_url().'addImages/'. $row->image . '" height="80px" width ="80px" alt="'. $row->image . '"  />';
   
		
	
         echo '</td>';
		   echo '<td>';
		 echo '<a href="'.site_url().'/e_marketing_portal/view_more/'.$row->AdID.'"; class="btn btn-default" >view more </a>';
											//echo '<a href="'.site_url().'/e_marketing_portal/view_more/'.($id).'"; class="fa fa-caret-square-o-right" data-toggle="modal"   data-target="#basicModal">view more </a>';
											echo "</td>";
	echo "<td>" ;
	//echo' <input type="submit" name="Alow" value="Alow" class="btn btn-success"  />';
	echo anchor ('reportAds_controller/allowAds?id='.$row->AdID, 'DENY <span class="glyphicon glyphicon-remove"></span>', 'id="$row->AdID"'); 
	echo "</td>";
		echo "<td>";
		echo anchor('reportAds_controller/denyAds?id='.$row->RID, 'ALLOW <span class="glyphicon glyphicon-ok"></span>', 'id="$row->RID"');
		//echo ' <input type="submit" name="Deny" value="Deny" class="btn btn-danger" onclick="(array(reportAds_controller/denyAds,$row->RID)" />';
		echo "</td>";
	echo "</tr>";	
			  
}
?>


</tbody>
</table>

</div>
<?php echo form_close(); 
?>
</div>

</div>

<?php include'footer_bootstrap_no_post_ads.php';?> 


