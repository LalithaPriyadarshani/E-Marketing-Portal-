<?php include('header_bootstrap.php'); ?>

<div class="form-horizontal" role="form" >
<?php
	 $this->load->helper('form');
		echo form_open('PaidAdd_controler/addPayment');
		?>
<div id="wrapper">
    	<div>
       
       <h3 style="color:#006;font-weight:400">Enter Credit Card Details </h3>
       <div class="form-group">
       <label class="col-sm-2 control-label">Card Number </label>
        <div class="col-xs-3" >
       <input type="text" name="number" value="" class="form-control" />
       </div>
       </div>
       <div class="form-group" >
       <label class="col-sm-2 control-label">Card Type </label>
       <a href="">
            <input type="radio" name="card" value="visa" class="visa"<?=set_radio('card','visa')?>/>
        	<img id="1" src="<?php echo base_url(); ?>images/visa.png" width="70" height="50"  alt="visa"  />
            
             <input type="radio" name="card" value="masterCard" class="master" <?=set_radio('card','masterCard')?>/>
            <img id="2" src="<?php echo base_url(); ?>images/masterCard.png" width="70" height="50"  alt="masterCard"  />
            
              <input type="radio" name="card" value="Discover" class="discover" <?=set_radio('card','Discover')?>/>
            <img id="3" src="<?php echo base_url(); ?>images/Discover.png" width="70" height="50"  alt="Discover"  />
            
            <input type="radio" name="card" value="AmericanExpress" class="AmExpress" <?=set_radio('card','AmericanExpress')?>/>
            <img id="4" src="<?php echo base_url(); ?>images/AmericanExpress.png" width="70" height="50"  alt="AmericanEx"  />
            </a>
       </div>
      
       <div class="form-group">
       <label class="col-sm-2 control-label">Expiration Date </label>
        <div class="col-xs-2" >
       <select Name='ddlSelectMonth' class="form-control">
       
            <option value="">--- Select Month ---</option>

            <?php
            for ($x=01; $x<13; $x++)
              {
                echo'<option value="'.$x.'">'.$x.'</option>'; 
              } 
            ?> 
        </select>
         </div>
          <div class="col-xs-2" >
         <select Name='ddlSelectYear' class="form-control">
           <option value="">--- Select Year ---</option>

            <?php
            for ($x=2014; $x<2050; $x++)
              {
                echo'<option value="'.$x.'">'.$x.'</option>'; 
              } 
            ?> 
        </select>
        </div>
       </div>
       <div class="form-group">
       <label class="col-sm-2 control-label"> CVV </label>
         <div class="col-xs-3" >
       <input type="text" name="CVV" value="" class="form-control"/>
       </div>
       <label>AMEX :4 digits on the front.Other cards: 3 digits on the back </label>
       </div> 
       <div class="form-group">
       <label class="col-sm-2 control-label">Card Holder Name </label>
        <div class="col-xs-3">
       <input type="text" name="name" value="" class="form-control"/>
       </div>
       </div>
       <div class="col-xs-3">
       <input type="submit" name="submit" value="Proceed>>>>" class="btn btn-primary" style="margin-left:500px" onclick=""<?php echo base_url(); ?>post_ads_cont/callSetStatus()" />
       </div>
        </div>
</div>
 <?php echo form_close(); ?>
</div>


<?php include('footer_bootstrap_no_post_ads.php')?>
