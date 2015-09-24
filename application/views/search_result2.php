<?php 

	$this->load->helper('url');
	$path = base_url();


$this->load->view('header2_'); 

	echo '<div class="wrapper-view-more">';
		echo '<div class="title-container-s2">';
		
			$adID;
			foreach($query as $row)
			{	
				$_SESSION['adsID'] = $row->id;
				$adID = $row->id;
				echo $row->title;
			}
		echo '</div>';  // title-container-s2
		
		echo '<div class="img-container-s2">';
		
			/*================= image gallery begin ============= */
			
			
			echo '<div id="slider" class="flexslider" style="height:380px">';
          
        echo '<div class="flex-viewport" style="overflow: hidden; position: relative;"><ul class="slides" style="width: 2400%; -webkit-transition: 0s; transition: 0s; -webkit-transform: translate3d(-1682px, 0px, 0px);">';
            //echo '<li class="" style="width: 841px; float: left; display: block;">';
  	    	  //  echo '<img src="images/kitchen_adventurer_cheesecake_brownie.jpg" draggable="false">';
  	    		//echo '</li>';
				
				foreach($image as $row)
				{
  	    		echo '<li class="" style="width: 841px; float: left; display: block;">';
  	    	    echo '<img src="'.$path.'addImages/'.$row->name.'" draggable="false">';
  	    		echo '</li>';
				}
  	    		
          	echo '</ul></div><ul class="flex-direction-nav"><li><a class="flex-prev" href="#">Previous</a></li><li><a class="flex-next" href="#">Next</a></li></ul></div>';
			
			
			
			
			
			echo '<div id="carousel" class="flexslider" style="margin-top:-40px">';
          
        echo '<div class="flex-viewport" style="overflow: hidden; position: relative;"><ul class="slides" style="width: 2400%; -webkit-transition: 0.6s; transition: 0.6s; -webkit-transform: translate3d(-860px, 0px, 0px);">';
            //echo '<li class="" style="width: 210px; float: left; display: block;">';
  	    	 //   echo '<img src="'.$path.'images/kitchen_adventurer_cheesecake_brownie.jpg" draggable="false">';
  	    		//echo '</li>';
				foreach($image as $row)
				{
  	    		echo '<li class="" style="width: 210px; float: left; display: block;">';
  	    	    echo '<img src="'.$path.'addImages/'.$row->name.'" draggable="false">';
  	    		echo '</li>';
				}
  	    	
          echo '</ul></div><ul class="flex-direction-nav"><li><a class="flex-prev" href="#">Previous</a></li><li><a class="flex-next" href="#">Next</a></li></ul></div>';
			
					
			
			
			/*================= image gallery end ===============*/
		
		
		
		
			//foreach($query as $row)
			//{
				//echo $row->image;
				//echo '<img src="'.base_url().'/addImages/'.$row->image.'" alt="image" width="400px" heigth="400px" />';
			//}
		echo '</div>';  //img-container-s2
		
		echo '<div class="price-container-s2">';
			foreach($query as $row)
			{
				echo '<label>'.'Rs '.$row->price.'</label>';
			}
		echo '</div>';  // closed price-container
		
		echo '<div class="contact-container-s2">';
			foreach($query as $row)
			{
				echo '<label>'.'Contact : '.$row->phone.'</label>';
			}
		echo '</div>';  //  contact-container-s2
		
		echo '<div class="location-container-s2">';
			foreach($query as $row)
			{
				echo '<label>'.$row->location.'</label>';
			}
		echo '</div>';  // closed location-container-s2
		
		 // ===========================  rate ================================
		echo '<div class="rate-container-s2">';
			echo '<label id="lblRateThisAd">Rate This Advertisement</label>';
			echo '<label id="lblThankRate" style="display:none;">Thank You For Rating...!!!</label>';
			echo '<div id="rate-stars-container" class="rate-stars-container">';
				//echo '<img src="'.$path.'images/ashStar.png" alt="image" width="40px" height="40px">';
				//echo '<img src="'.$path.'images/ashStar.png" alt="image" width="40px" height="40px">';
				//echo '<img src="'.$path.'images/ashStar.png" alt="image" width="40px" height="40px">';
				//echo '<img src="'.$path.'images/ashStar.png" alt="image" width="40px" height="40px">';
				//echo '<img src="'.$path.'images/ashStar.png" alt="image" width="40px" height="40px">';
				
				
				echo '<div id="stars_1" class="stars" onmouseover="change_stars_image(1)" onmouseout="clearStars()" onclick="showIt('.$adID.',1)" title="Poor">';					
				echo '</div>'; // closed stars
				
				
				
				echo '<div id="stars_2" class="stars" onmouseover="change_stars_image(2)" onmouseout="clearStars()" onclick="showIt('.$adID.',2)" title="Fair" >';
				echo '</div>'; // closed stars
				
				
				
				echo '<div id="stars_3" class="stars" onmouseover="change_stars_image(3)" onmouseout="clearStars()" onclick="showIt('.$adID.',3)" title="Good">';
				echo '</div>'; // closed stars
				
				
				
				echo '<div id="stars_4" class="stars" onmouseover="change_stars_image(4)" onmouseout="clearStars()" onclick="showIt('.$adID.',4)" title="Very Good">';
				echo '</div>'; // closed stars
				
				
				
				echo '<div id="stars_5" class="stars" onmouseover="change_stars_image(5)" onmouseout="clearStars()" onclick="showIt('.$adID.',5)" title="Excellent">';
				echo '</div>'; // closed stars
							
				
			echo '</div>'; // closed rate-stars-container
		echo '</div>';  // closed rate-container-s2
		
		
		echo '<div class="rate-result-container">';
			echo '<label>Excellent</label>';
			echo '<label>Very Good</label>';
			echo '<label>Good</label>';
			echo '<label>Fair</label>';
			echo '<label>Poor</label>';	
			
			echo '<div id="rate_val" class="rate-result-values">';
				//echo '<label id="rateVal1">00%</label>';
				//echo '<label>00%</label>';
				//echo '<label>00%</label>';
				//echo '<label>00%</label>';
				//echo '<label>00%</label>';		
			echo '</div>'; // closed rate-result-values	
			
		echo '</div>';  // closed rate-result-container
		
		
		echo form_open('user_controller/favouriteAdds'); //Favourite add
		echo '<div class="favourite-container">';
			$this->load->helper('url');
			$add_id;
				foreach($query as $row)
				{
					$add_id = $row->id;
					
				}
					echo '<ul>';
						echo '<li>';
							echo '<a class=\'favorite btn btn-default\' href=\'<?php echo base_url(); ?>/index.php/user_controller/favouriteAdds/'.$row->id .'\'><span class=\'glyphicon glyphicon-star\'></span>Favourite</a>';
							/*echo '<a href="';echo site_url('user_controller/favouriteAdds/'.$add_id).'">';
							//echo '<input type="butt" id="btnFavourite" name="btnFavourite" value="Favourite" />';
							//echo '<input type="button" id="btnReportAdd" name="btnReportAdd" value="Report This Ad" />';
							echo '</a>';*/
							echo anchor(array('user_controller/favouriteAdds', $add_id),'Favourites','title="Mark as favourite"');
						echo '</li>';
					echo '</ul>';	
	    echo '</div>';  // closed favourite-container
		echo form_close(); // close Favourite add
		
		
		
		echo '<div id="description-header-container-s2" class="description-header-container-s2">';
			echo 'Description';
		echo '</div>';  // description-header-container-s2
		
		echo '<div class="description-text-container-s2">';
			foreach($query as $row)
			{
				echo $row->description;	
			}
		echo '</div>';  //  closed description-text-container-s2
		
		echo '<div class="reportAdd-container">';
		$this->load->helper('url');
		
				$id;
				foreach($query as $row)
				{
					$id = $row->id;
				}
							
		
			echo '<a href="';echo site_url('e_marketing_portal/reportAds/'.$id).'">';
				echo '<input type="button" id="btnReportAdd" name="btnReportAdd" value="Report This Ad" />';
			echo '</a>';
		echo '</div>';  // end reportAdd-container
		
		echo form_open('e_marketing_portal/add_comments'); // comments
		echo '<div class="post-comment-container">';
			echo '<ul>';
				echo '<li>';
					echo '<input type="text" id="txtName" name="txtName" value="Your Name..." onfocus="if(this.value==\'Your Name...\') this.value=\'\';"  onblur="if(this.value==\'\') this.value=\'Your Name...\';" />';
				echo '</li>';
				echo '<li>';
					echo '<textarea cols="100" rows="3" id="txtComment" name="txtComment"   onfocus="if(this.value==\'Write a comment...\') this.value=\'\';" onblur="if(this.value==\'\') this.value=\'Write a comment...\';" >Write a comment...</textarea>';
				echo '</li>';
			echo '</ul>';
			echo '<input type="button" id="btnPostComment" name="btnPostComment" value="Post Comment" onclick="addComment('.$adID.')" />';
		echo '</div>';  // end post-comment-container
		echo form_close();
		
		
		echo '<div class="view-comments-container">'; // view comments
		
		
		//if(isset($_SESSION['res']))
		//{
			//$result = $_SESSION['res'];
		foreach($result as $row)
		{
			echo '<div class="comment">';
				echo '<div class="commenter-name">';
					echo '<label>By : '.$row->Name.'</label>';
					$commentID = $row->Comment_ID;
				echo '</div>'; // end commenter name
				$delVisibility= 'hidden';
				if(isset($_SESSION['adminProfile'])){
					$delVisibility = 'visible';;
				}
				echo '<div class="close-icon" onclick="deleteComment('.$commentID.')" style="visibility:'.$delVisibility.'">';
					echo '<img src="'.$path.'images/close.gif" alt="icon" />';
				echo '</div>';  // end close-icon
				echo '<div class="comment-text">';
					echo $row->Comment;
				echo '</div>';  // end comment text
			echo '</div>';  //  end comment
		}
		//} // if
		echo '</div>'; // end view comment container
	echo '</div>';  // closed wrapper-result-content
	


?>

<!-- ================= image gallery =============== -->


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.min.js">\x3C/script>')</script>
<script defer="" src="<?php $this->load->helper('url'); echo base_url(); ?>js/jquery.flexslider.js"></script>

			
<script type="text/javascript">
    $(function(){
      SyntaxHighlighter.all();
    });
    $(window).load(function(){
      $('#carousel').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 210,
        itemMargin: 5,
        asNavFor: '#slider'
      });

      $('#slider').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        sync: "#carousel",
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });
  </script>
  
  
  <script type="text/javascript" src="<?php echo base_url(); ?>js/shCore.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>js/shBrushXml.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>js/shBrushJScript.js"></script>
  
  
  
  

<!-- ================= image gallery end =============== -->
<!--=================== favourite =================================-->
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
<!--<script>
//save to favorites
$('.favorite').on('click', function(e){
    e.preventDefault();
    var data = [],
    newclass = 'btn-warning',
    oldcalss = 'btn-default',
    fav = $(this);
    favId = fav.attr('id'),

    $.ajax({
        type: "POST",
        url: base_url + 'ajax/add_favorite/' + favId,
        success: function(result)
        {
            fav.removeClass(oldcalss)
            .addClass(newclass);    
        }
    });

});
</script>

<!--=================== rating =================================-->

<?php

$this->load->view('footer2');


 ?>