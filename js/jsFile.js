// JavaScript Document


/*function slider(){
	
	$(".slideShowContainer #1").show("fade",500);
	$(".slideShowContainer #1").delay(5500).hide("slide",{direction:"left"},400);
	
	var sc = $(".slideShowContainer img").size();
	var count = 2;
	
	setInterval(function(){
		
		$(".slideShowContainer #"+count).show("slide",{direction:"right"},500);
		$(".slideShowContainer #"+count).delay(5500).hide("slide",{direction:"left"},400);
		
		if(count==sc){
		
			count = 1;	
		}
		else{
		
			count = count+1;	
		}
		
			
	},6500)
}

*/



<!-- ==================== home page design ========================== -->










 <!-- ======================== rating design ================================================-->
 
 function change_stars_image(star_id)
 { 
	 for (var i=1;i<=star_id;i++){
         
              $("#stars_"+i).css('background', 'url(http://localhost/E_Marketing_Portal/images/goldStar3.png) no-repeat');
         
    }
	
	

 }
 
function clearStars(){
    for (var i=1;i<6;i++){
         $("#stars_"+i).css('background', 'url(http://localhost/E_Marketing_Portal/images/ashStar3.png) no-repeat');
    }
}
 
 
 <!-- ======================== /rating design ================================================-->
 
 

 
 
 

 
 
 <!-- ======================== rating code ================================================-->
 
 
 
 function showIt(adID, rate)  // insert rate values
 {	 
	 var adID = adID;
	 var rate = rate;
	 
	
	 
	  $.ajax({
            type:'POST',
            url:'http://localhost/E_Marketing_Portal/index.php/e_marketing_portal/rate_ads',
			data:{'adID':adID, 'rate':rate},
			success:function(){ 	
			//alert('okey'); 
			displayRates(adID);
			}
			
	  });
	 
	 	 $('.rate-stars-container').css("visibility","visible");
	
	
 }
 
 
 
function displayRates(adID)  // display rate values
 {
	 
	 var adID = adID;
	 $.ajax({
            type:'POST',
			url:'http://localhost/E_Marketing_Portal/index.php/e_marketing_portal/get_rate_results',
			dataType:'JSON',
			data:{'adID':adID},
			
			success:function(rates){ 
							
				$('#rate_val').html('<label>'+rates.excellent+' %'+'</label>'+'<label>'+rates.veryGood+' %'+'</label>'+'<label>'+rates.good+' %'+'</label>'+'<label>'+rates.fair+' %'+'</label>'+'<label>'+rates.poor+' %'+'</label>');	
				
				
			}
			
	  });
	  
		
	  
	  
$button = $('.stars');
$container = $('.rate-result-container');      // display result div


  $container
    .css({
      visibility: 'visible',
      display: 'none'
    })
    .slideDown("slow");

	  $("#lblRateThisAd").hide(1000); // hide rate this ad label 
	  $("#rate-stars-container").hide(); // hide stars
	  $("#lblThankRate").fadeIn(3000); // show thank you
	  $("#lblThankRate").css("margin-top","25px");
	  
	  
	
	 return false;
	 
 }
 
 
 
 <!-- ======================== /rating code ================================================-->
 
 





 <!-- ======================== comments code ================================================-->
 
 
function addComment(adID)  // insert comments
 {	 
	 var adID = adID;
	 var name = document.getElementById("txtName").value;
	 var comment =  document.getElementById("txtComment").value;
	
	if(name != 'Your Name...' && name != ' ' && comment != 'Write a comment...' && comment != ' ')
	{
	
	  $.ajax({
            type:'POST',
            url:'http://localhost/E_Marketing_Portal/index.php/e_marketing_portal/add_comments',
			dataType:"json",
			data:{'adID':adID, 'name':name, 'comment':comment},
			success:function(data){ 	
			
			}
			
			
			
	  });
	 
	 	 
	//alert('here '+adID);
	showComments(adID);
	}
	
 }
 
 
 function showComments(adID)    // display comments
 {
	 
	 
	// var adID = adID;
	 $.ajax({
            type:'POST',
			url:'http://localhost/E_Marketing_Portal/index.php/e_marketing_portal/get_comments',
			dataType:'JSON',
			data:{'adID':adID },
			success:function(comment){ 
						//alert('success');	
			}
			
	  });
	 
	  window.location.reload();
            // $(".view-comments-container").load('http://localhost/E_Marketing_Portal/index.php/e_marketing_portal/view_more/adID .view-comments-container');    
				
	//alert('here called...'); 
	 
 }
 
 
 
 function deleteComment(comID)
 {
	 
	 $.ajax({
            type:'POST',
			url:'http://localhost/E_Marketing_Portal/index.php/e_marketing_portal/delete_ads',
			dataType:'JSON',
			data:{'comID':comID },
			success:function(comment){ 
						//alert('success');	
			}
			
	  });
	 
	  window.location.reload();
	 
	 
 }
 
 
 
 
 
 
 
 
 
 <!-- ======================== comments code ================================================-->
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 