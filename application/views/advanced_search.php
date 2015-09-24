
<?php $this->load->view('header2'); ?>


<div class="advanced-wrapper">
	<label>Advanced Search</label>
	<div class="side-bar">
		<div class="item-search">
        	Items
        </div><!-- /item-search -->
        <ul>
        	<li>
            	<a href="">Find items</a>
            </li>
        </ul>
     	<div class="member-search">
        	Members
        </div><!-- /member-search -->
        <ul>
        	<li>
            	<a href="<?php echo site_url('memSearch_controller/');?>">Find a member</a>
            </li>
        </ul>
	</div><!-- /side-bar -->

	<div class="item-search-wrapper">
    <?php echo form_open('e_marketing_portal/advanced_search_basic'); ?>
    	<div class="advanced-search-title">
        	Find items
        </div><!--advanced-search-title-->
        <div class="keyword-partition">
        	<ul>
            	<li>
        			<label>Enter keywords</label>
                </li>
                <li>
                	<input type="text" id="txtInclude" name="txtInclude" value="" />
                </li>
                <li>
        			<label style="font-weight:normal">Exclude words from search</label>
                </li>
                <li>
                	<input type="text" id="txtExclude" name="txtExclude" />
                </li>
                <li>
        			<label style="margin-top:20px;">In this category</label>
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
        <div class="search-field-partition">
        	<ul>
            	<li>
                	<label>Search including</label>
                </li>
                <li>
                	<input type="checkbox" id="rbtnTitle" name="rbtnTitle" value="title" style="font-weight:normal" checked="checked"  />Title
                </li>
                <li>
                	<input type="checkbox" id="rbtnTitle" name="rbtnDescription" value="description" style="font-weight:normal"  />Description
                </li>
            </ul>
        </div><!--search-field-partition-->
        <div class="price-partition">
        	<ul>
            	<li>
                	<label>Price</label>
                </li>
                <li>
                	<input type="checkbox" id="rbtnPrice" name="rbtnPrice" value="true" style="font-weight:normal"  />Only show items&nbsp;:
                </li>
                <li>
                	<label style="font-weight:normal; float:left" >priced from &nbsp;&nbsp;RS&nbsp;</label>
                </li>
                <li>
                	<input type="text" id="txtPriceFrom" name="txtPriceFrom" style="float:left; margin-top:7px;" />
                </li>
                <li>
                	<label style="font-weight:normal; float:left; margin-left:5px;" >to&nbsp;&nbsp;RS&nbsp;</label>
                </li>
                 <li>
                	<input type="text" id="txtPriceTo" name="txtPriceTo" style="float:left; margin-top:7px;" />
                </li>
            </ul>
        </div><!-- /price-partition -->
        <div class="condition-partition">
        	<ul>
            	<li>
                	<label>Condition</label>
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
        <div class="location-partition">
        	<ul>
            	<li>
                	<label>Location</label>
                </li>
                <li>
                	<input type="checkbox" id="rbtnLocation" name="rbtnLocation" value="true" style="font-weight:normal"  />Only show items&nbsp;:
                </li>
                <li>
                	<label style="font-weight:normal; float:left" >Located in &nbsp;&nbsp;</label>
                </li>
                <li>
                	<input type="text" id="txtLocatedFrom" name="txtLocatedFrom" style="float:left; margin-top:7px;" />
                </li>
                <li>
                	<label style="font-weight:normal; float:left; margin-left:5px;" >and&nbsp;&nbsp;</label>
                </li>
                 <li>
                	<input type="text" id="txtLocationTo" name="txtLocationTo" style="float:left; margin-top:7px;" />
                </li>
            </ul>
        </div><!-- /location-partition -->
        <div class="advanced-search-container">
        	<input type="submit" id="btnAdvancedSearch" name="btnAdvancedSearch" value="Search">
        </div><!-- /advanced-search-container-->
    </div><!-- /item-search-wrapper -->
    <?php echo form_close(); ?>
</div><!-- /advanced wrapper -->

<?php $this->load->view('footer2'); ?>