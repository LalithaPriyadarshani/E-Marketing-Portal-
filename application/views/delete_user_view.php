<?php include 'header_bootstrap.php'; ?>
<?php $path = base_url(); ?>

	<div id="wrapper-deleteUser" class="panel panel-default">
		<div class="ManageUser">
        	<h4>Account Type</h4>
            
        <div class= "RadioBtnGrp">
                 	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   <input type="radio" name="Account" value="Personal Account" id="PersonalChk" onClick="javascript:radioBtnCheck()" <?=set_radio('Account','Personal Account')?> >Personal Account</input>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="Account" value="Business Account" id="BusinessChk" onClick="javascript:radioBtnCheck()" <?=set_radio('Account','Business Account')?> >Business Account  </input>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="Account" value="All Account" id="AllChk" onClick="javascript:radioBtnCheck()" checked="checked" <?=set_radio('Account','All Accounts')?> >All Accounts</input>
                    
                   
                </div><!--RadioBtnGrp-->
            </div><!--ManageUser-->
            
            
            <div id="table_users">
            	<table  class="display " id="table_id" cellspacing="0" width="100%"  style="margin-top:1000px;">
                	<thead>
                	<tr>
						<th>Email</th> 
                        <th>Account Type</th>
                        <th>Name</th>
                        <th>Mobile No</th>
                        <th>Action </th>
					</tr> 
                    </thead>
                    
                    <tbody>

					<?php 
						foreach($query3 as $row)
						{	
							echo "<tr>";
							echo "<td>". $row->Email ."</td>";
							echo "<td>". $row->AccountType ."</td>";
							$name =$row->AccountType;
							if($name=='Personal Account')
							{
								echo "<td>". $row->FirstName." " .$row->LastName ."</td>";
							}
							else if($name=='Business Account')
							{
								echo "<td>". $row->CompanyName ."</td>";
							}
							echo "<td>". $row->MobileNo ."</td>";
							echo "<td>";
							echo '<a class=\'btn btn-danger btn-sm\' onclick="return doconfirm();" href="<?php echo base_url(); ?>/index.php/user_controller/deleteUsers/'.$row->RegistrationId .'\'> <span class=\'glyphicon glyphicon-trash\'></span> Delete</a>';
           					echo "</td>";
							echo "</tr>";   
						}
					?>
                    
                    </tbody>
				</table>
			</div><!--table_users-->
            
            <div id="table_users_personal" >
				<table  class="display" id="table_id_p" cellspacing="0" width="100%">
                	<thead>
                	<tr>
						<th>Email</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Mobile No</th>
                        <th>Action </th>
					</tr>
                    </thead> 
					
                    <tbody>
					<?php 
						foreach($query1 as $row)
						{
							echo "<tr>";
							echo "<td>". $row->Email ."</td>";
							echo "<td>". $row->FirstName ."</td>";
							echo "<td>". $row->LastName ."</td>";
							echo "<td>". $row->MobileNo ."</td>";
							echo "<td>";
							echo '<a class=\'btn btn-danger btn-sm\' onclick="return doconfirm();" href=\'<?php echo base_url(); ?>/index.php/user_controller/deleteUsers/'.$row->RegistrationId .'\'> <span class=\'glyphicon glyphicon-trash\'></span> Delete</a>';
           					echo "</td>";
							echo "</tr>";   
						}
					?>
                    </tbody>
				</table>
			</div><!--table_users_personal-->
            
            <div id="table_users_Company" >
				<table  class="display" id="table_id_c" cellspacing="0" width="100%">
                	<thead>
                	<tr>
						<th>Email</th>
                        <th>Company Name</th>
                        <th>Mobile No</th>
                        <th>Action </th>
					</tr>
                    </thead> 
					
                    <tbody>
					<?php 
						foreach($query2 as $row)
						{
							echo "<tr>";
							echo "<td>". $row->Email ."</td>";
							echo "<td>". $row->CompanyName ."</td>";
							echo "<td>". $row->MobileNo ."</td>";
							echo "<td>";
							echo '<a class=\'btn btn-danger btn-sm\' onclick="return doconfirm();" href=\'<?php echo base_url(); ?>/index.php/user_controller/deleteUsers/'.$row->RegistrationId .'\'> <span class=\'glyphicon glyphicon-trash\'></span> Delete</a>';
							
           					echo "</td>";
							echo "</tr>";   
						}
					?>
                    </tbody>
				</table>
			</div><!--table_users_Company-->
 
    </div><!--wrapper-deleteUser-->

</body>
</html>

<script type="text/javascript">

function radioBtnCheck() 
{
    if (document.getElementById('PersonalChk').checked) 
	{
        document.getElementById('table_users').style.display='none';
		document.getElementById('table_users_Company').style.display='none';
		document.getElementById('table_users_personal').style.display='block';
    } 
	else if (document.getElementById('BusinessChk').checked)
	{
       	document.getElementById('table_users').style.display='none';
		document.getElementById('table_users_personal').style.display='none';
		document.getElementById('table_users_Company').style.display='block';
    }
	else
	{
		document.getElementById('table_users_Company').style.display='none';
		document.getElementById('table_users_personal').style.display='none';
		document.getElementById('table_users').style.display='block';
	}
}

window.onload=function onloadform()
{
	document.getElementById('table_users_Company').style.display='none';
	document.getElementById('table_users_personal').style.display='none';
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


