 <?php 
 include('header.php');
 include('postAds_body.php'); 
  ?>
<body>
		<div id=" wrapper">
		 <table> 
         <div class="Qbody" >
         <h1> <label for="QuestionPaper" style="font-family:Arial "> Question Paper </label> </h1>
         </div>
			<div>
             <?php
 		$this->load->helper('form');
        echo form_open('onlineCont/validPassMarks');    
    ?>
    
   
			<tr>	
				<td>	<label for="name">Question Paper Name</label></td>
                <td>    <input type="text" name="name" value=""/></td>
            </tr>    
            
                    <tr>
					<td><label for="title"> Total Questions </label></td>
                   <td> <input type ="text" name="total" value=""/></td>
                    
                 <td>   <label for="title" > Marks per question </label></td>
                 <td>   <input type ="text" name="marks" value=""/></td>
                    
                </tr>
                
               <tr>  
              <td>   <label for="title" > passing Marks </label> </td>
               <td>     <input type ="text" name="passMrk" value=""/></td>
                    
                <td>    <label for="title" > Time (Min) </label></td>
                <td>    <input type ="text" name="Time" value=""/></td>
                    
               
                </tr>  
                
                <tr >
                <td> <label for="title" > Total marks </label></td>
                <td>    <input type ="text" name="totalMrk" /></td>
                  </tr>  
                <tr>
               <td> <label for ="title"> select module for add </label></td>
               <td> <select name="module">
                <option> Internet </option>
                <option>MS word </option>
                <option> MS Excel </option>
                <option>MS Powerpoint </option>
                </select></td>
				<td>	<label for="name" > No of Questions </label></td>
                 <td>   <input type ="text" name="No" value=""/></td>
                    
                 <td>   <input type="submit" name="Add" value ="Add"/></td>
                </tr>
                
                <tr>
                
                <tr> 
                <table border="2">
                <tr>
                <th>Course Module </th>
                <th>No. Of Question </th>
                
                
                </tr>
                <?php 

              foreach($qry as $row){

                 echo "<tr>";
                 echo "<td>". $row->courseModule ."</td>";

                   echo "<td>". $row->no_of_ques ."</td>";

   
                  echo "</tr>";   

               }

?>
   </table>
               
                </tr>
				
                
             </div><!--postAdsBody-->   
				</table> 
                 <?php echo form_close(); ?>   
		</div> <!--wrapper-->
        <!--<div class="submitButton">
        <input type="submit" value ="Submit" align="middle" width="100px" height="100px" style="margin-top:-0px; margin-left:150px;"/>
        </div>-->
       <!-- </form> -->

      <!--  <p> *required field.</p>-->
</body>
</html>


<?php include('footer_no_postAds.php')?>

