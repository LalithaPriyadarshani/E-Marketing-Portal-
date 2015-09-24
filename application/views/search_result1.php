<?php 

	$this->load->view('header2');

	// advanced search
?>

	<div class="item-search-wrapper" style="float:left; width:344px;">
    <?php echo form_open('e_marketing_portal/advanced_search_basic'); ?>
    	<div class="advanced-search-title" style="width:342px;">
        	Find items
        </div><!--advanced-search-title-->
        <div class="keyword-partition" style="width:342px;">
        	<ul>
            	<li>
        			<label style="margin-left:20px;">Enter keywords</label>
                </li>
                <li>
                	<input type="text" id="txtInclude" name="txtInclude" value="" />
                </li>
                <li>
        			<label style="font-weight:normal; margin-left:20px;">Exclude words from search</label>
                </li>
                <li>
                	<input type="text" id="txtExclude" name="txtExclude" />
                </li>
                <li>
        			<label style="margin-top:20px; margin-left:20px;">In this category</label>
                </li>
                <li>
        			<select style="margin-top:10px;" id="ddlCategory" name="ddlCategory">
                    <option value="">All Categories</option>
                    <?php foreach($query as $row) { ?>
                    <?php echo 'here'; ?>
                    <option value="<?php echo $row->sub_id; ?>"><?php echo $row->sub_name; ?></option>
                    <?php } ?>
                    </select>
                </li>
                <li>
        			<input type="submit" id="btnAdvancedSearchBasic" name="btnAdvancedSearchBasic" value="Search">
                </li>
            </ul>
        </div><!--keyword-partition-->
        <div class="search-field-partition" style="width:342px;">
        	<ul>
            	<li>
                	<label style="margin-left:20px;">Search including</label>
                </li>
                <li>
                	<input type="checkbox" id="rbtnTitle" name="rbtnTitle" value="title" style="font-weight:normal" checked="checked"  />Title
                </li>
                <li>
                	<input type="checkbox" id="rbtnTitle" name="rbtnDescription" value="description" style="font-weight:normal"  />Description
                </li>
            </ul>
        </div><!--search-field-partition-->
        <div class="price-partition" style="width:342px;">
        	<ul>
            	<li>
                	<label style="margin-left:20px;">Price</label>
                </li>
                <li>
                	<input type="checkbox" id="rbtnPrice" name="rbtnPrice" value="true" style="font-weight:normal"  />Only show items&nbsp;:
                </li>
                <li>
                	<label style="font-weight:normal; float:left; margin-left:20px;" >priced from &nbsp;&nbsp;RS&nbsp;</label>
                </li>
                <li>
                	<input type="text" id="txtPriceFrom" name="txtPriceFrom" style="float:left; margin-top:7px; width:80px;"  />
                </li>
                <li>
                	<label style="font-weight:normal; float:left; margin-left:5px;" >to&nbsp;&nbsp;RS&nbsp;</label>
                </li>
                 <li>
                	<input type="text" id="txtPriceTo" name="txtPriceTo" style="float:left; margin-top:7px; width:80px;" />
                </li>
            </ul>
        </div><!-- /price-partition -->
        <div class="condition-partition" style="width:342px;">
        	<ul>
            	<li>
                	<label style="margin-left:20px;">Condition</label>
                </li>
                <li>
                	<input type="radio" id="rbtnNew" name="rbtnCondition"  value="new" style="font-weight:normal"  />New
                </li>
                <li>
                	<input type="radio" id="rbtnUsed" name="rbtnCondition"  value="used" style="font-weight:normal"  />Used
                </li>
                <li>
                	<input type="radio" id="rbtnAny" name="rbtnCondition"  value="Any" style="font-weight:normal" checked="checked"  />Any
                </li>
            </ul>
        </div><!-- /condition-partition -->
        <div class="location-partition" style="width:342px;">
        	<ul>
            	<li>
                	<label style="margin-left:20px;">Location</label>
                </li>
                <li>
                	<input type="checkbox" id="rbtnLocation" name="rbtnLocation" value="true" style="font-weight:normal"  />Only show items&nbsp;:
                </li>
                <li>
                	<label style="font-weight:normal; float:left; margin-left:20px;" >Located in &nbsp;&nbsp;</label>
                </li>
                <li>
                	<input type="text" id="txtLocatedFrom" name="txtLocatedFrom" style="float:left; margin-top:7px; width:80px;" />
                </li>
                <li>
                	<label style="font-weight:normal; float:left; margin-left:5px;" >and&nbsp;&nbsp;</label>
                </li>
                 <li>
                	<input type="text" id="txtLocationTo" name="txtLocationTo" style="float:left; margin-top:7px; width:80px;" />
                </li>
            </ul>
        </div><!-- /location-partition -->
        <div class="advanced-search-container">
        	<input type="submit" id="btnAdvancedSearch" name="btnAdvancedSearch" value="Search">
        </div><!-- /advanced-search-container-->
    </div><!-- /item-search-wrapper -->
    <?php echo form_close(); ?>





	<!-- end advanced search -->

	<div class="wrapper-content-search" style="float:left; margin-left:40px;">
<?php
	foreach($adsquery as $row)
	{
		echo '<div class="result_content">';
			echo '<div class="pic-container">';
				echo '<img src="'.base_url().'/addImages/'. $row['image'].'" alt="image" width="200px" heigth="100px" />';
			echo '</div>';  // closed pic-container
			echo '<div class="basic-desc-container">';
				echo '<div class="title-container">';
					echo $row['title'];
				echo '</div>';  // closed title-container
				echo '<div class="price-container">';
					echo 'Rs '.$row['price'];
				echo '</div>';  //closed price-container
				echo '<div class="location-container">';
					echo $row['location'];
				echo '</div>';  //closed location-container
				echo '<div class="added-time-container">';
					$dateTime1 = $row['added_date'];
					$time1 = substr($dateTime1,0,10);
					echo 'Added '.$time1;
					
					// need to add the different of the time 		
										
					/*$dt = new DateTime('UTC');
					$dateTime2 = $dt->format('Y-m-d H:i:s');
					$time2 = substr($dateTime2,10);
					$diff = $time1 - $time2;
					echo $diff;*/
					 
				
				echo '</div>';  //added-time-container
				echo '<div class="view-more-container">';
					$add_id = $row['id'];
					echo '<ul>';
						echo '<li>';
							echo anchor(array('e_marketing_portal/view_more', $add_id),'View More','title="Get Full Information"');
						echo '</li>';
					echo '</ul>';	
				echo '</div>';  // closed view-more-container
			echo '</div>';  //cosed basic-desc-container
		echo '</div>';  // closed result_content
	}
	echo '</div>';  // closed wrapper div



	$this->load->view('footer2');

 ?>