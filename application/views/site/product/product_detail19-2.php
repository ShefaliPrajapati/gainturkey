<?php
$this->load->view('site/templates/header');
?>
<script src="js/site/new.js"></script>
<script src="js/site/core.js" type="text/javascript"></script>
<script type="text/javascript" src="js/site/jquery_1.4.1min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="js/site/jquery.timers-1.2.js"></script>
<script type="text/javascript" src="js/site/jquery.galleryview-3.0-dev.js"></script>
<script type="text/javascript">
	$(function(){
		$('#myGallery').galleryView();
	});
</script>
<script src="js/site/menu.js" type="text/javascript"></script>
<script src="js/site/script.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	
	//Calculate the height of <header>
	//Use outerHeight() instead of height() if have padding
    var aboveHeight = $('#header').outerHeight();
	
	// when scroll
    $(window).scroll(function(){
		
		//if scrolled down more than the header's height
        if ($(window).scrollTop() > aboveHeight){
			
			// if yes, add "fixed" class to the <nav>
			// add padding top to the #content (value is same as the height of the nav)
            $('#inner_topnav').addClass('fixed').css('top','0').next().css('padding-top','0px');
        } else {
			
			// when scroll up or less than aboveHeight, remove the "fixed" class, and the padding-top
            $('#inner_topnav').removeClass('fixed').next().css('padding-top','0');
        }
    });
});
</script>
<script>
			$(document).ready(function(){
			
				// hide #back-top first
				$("#top").hide();
				
				// fade in #back-top
				$(function () {
					$(window).scroll(function () {
						if ($(this).scrollTop() > 100) {
							$('#top').fadeIn();
						} else {
							$('#top').fadeOut();
						}
					});
			
					// scroll body to 0px on click
					$('#top a').click(function () {
						$('body,html').animate({
							scrollTop: 0
						}, 800);
						return false;
					});
				});
			
			});
	</script>
<script type="text/javascript"  src="js/site/jquery.colorbox.js"></script>
	<script>
		$(document).ready(function(){
			//Examples of how to assign the ColorBox event to elements
			$(".example8").colorbox({width:"420px", inline:true, href:"#inline_example1"});
			$(".example9").colorbox({width:"700px", inline:true, href:"#inline_example2"});
			$(".example10").colorbox({width:"420px", inline:true, href:"#inline_example3"});

				//Example of preserving a JavaScript event for inline calls.
			$("#onLoad").click(function(){ 
				$('#onLoad').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
				return false;
			});
		});
	</script>
    <script type="text/javascript" src="js/site/jcarousellite_1.0.1.pack.js"></script>
<script type="text/javascript" src="js/site/captify.tiny.js"></script>
<script type="text/javascript">
	function Start(){
	window.location="sign-up.html";
	}
</script>
<link rel="stylesheet" type="text/css" href="css/site/calendar1.css" />
<script type="text/javascript" src="js/site/yuiloader-min.js"></script>
<script type="text/javascript" src="js/site/event-min.js"></script>
<script type="text/javascript" src="js/site/dom-min.js"></script>
<script type="text/javascript" src="js/site/calendar-min.js"></script>
<script type="text/javascript" src="js/site/element-min.js"></script>


<script type="text/javascript">
$(document).ready(function() {
	
	//Calculate the height of <header>
	//Use outerHeight() instead of height() if have padding
    var aboveHeight = $('#header').outerHeight();
	
	// when scroll
    $(window).scroll(function(){
		
		//if scrolled down more than the header's height
        if ($(window).scrollTop() > aboveHeight){
			
			// if yes, add "fixed" class to the <nav>
			// add padding top to the #content (value is same as the height of the nav)
            $('#inner_topnav').addClass('fixed').css('top','0').next().css('padding-top','0px');
        } else {
			
			// when scroll up or less than aboveHeight, remove the "fixed" class, and the padding-top
            $('#inner_topnav').removeClass('fixed').next().css('padding-top','0');
        }
    });
});
</script>
<script src="js/site/jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript">
	jQuery(document).ready( function () {
		$(".datepicker").datepicker({ minDate:0, dateFormat: 'yy-mm-dd'});
	});
</script>
<div class="top_search">
	<div class="main">
    	<?php echo form_open(base_url('city/search'),array('class'=>'custom show-search-options position-left search-area','method'=>'get','style'=>'position:static; margin:0','id'=>'search_form')); ?>
        	<span style="float:left; text-shadow:none; font-weight:bold; margin:10px 10px 0 0px">Search for</span>
            <div class="input-wrapper">
              <input type="text" placeholder="Vacation Destination" value="<?php if($_GET['city']!='')  echo $_GET['city']; ?>"  name="city" id="location" autocomplete="off" class="location">
              <div class="for_auto_search"></div>
            </div>
          <!--  <div class="input-wrapper">
              <input type="text" class="location" autocomplete="off" id="property" name="location" placeholder="Property ID"  />
            </div>-->
            
            <div class="input-wrapper">
              <input type="text" id="rentalid" value="<?php if($_GET['rentalid']!='')  echo $_GET['rentalid']; ?>" class="checkin search-option" name="rentalid" placeholder="Rental Id" />
              </div>
            <div class="input-wrapper" id="checkinWrapper">
              <input type="text" placeholder="Arrival" name="datefrom" value="<?php if($_GET['datefrom']!='')  echo $_GET['datefrom']; ?>" class="checkin search-option datepicker" id="checkin">
              <span class="search-area-icon"></span> </div>
            <div class="input-wrapper" id="checkoutWrapper">
              <input type="text" placeholder="Departure" name="expiredate" value="<?php if($_GET['expiredate']!='')  echo $_GET['expiredate']; ?>"  class="checkout search-option datepicker" id="checkout">
              <span class="search-area-icon"></span></div>
            <input type="submit" value="Search" onclick="return SearchValidation();" style="border:none;" class="large pink btn icon-and-text position-left">
            <div id="location_val" style="background:none; color:#FF0000; padding-left:110px;"></div>
          </form>
           <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>"  />
    </div>
    <script type="text/javascript">
var baseUrl='<?php echo base_url();?>';

function dropSort(){
//alert($("#bed").val());
$(function() {
						$.ajax(
						{
							type: 'POST',
							url: baseUrl+'site/product/dropSort',
							data:{'price':$("#price").val(),'bed':$("#bed").val(),'sleep':$("#sleep").val(),'bath':$("#bath").val()},
							success: function(data) 
							{
								jQuery("#results").html(data);
							}
							
						});
	//window.location.href='site/product/dropSort?val='+val+'&type='+typ;
	});
}
</script>
<?php $product = $productDetails->row(); ?> 
<div class="top_search"> 
   <div class="bread_crumb">
    	<div class="main">
        	<ul class="quick_links">
            	<li><a href="<?php echo base_url();?>">Home</a></li>
               <!-- <li><a href="#"><?php echo $admin_settings->row()->email_title;?></a></li>
              
               <li><a href="<?php echo base_url();?>"><?php echo ucfirst($this->uri->segment(1));?></a></li>-->
                <li><a href="<?php echo base_url();?>city/<?php echo $product->CitySurl;?>"><?php echo ucfirst($product->CityName); ?></a></li>
                <li><b><?php echo ucfirst($title);?> Listing #<?php echo $this->uri->segment(2);?></b></li>
            </ul>
        </div>
    </div> 
    </div>
</div>
<!--body content-->
<section>
	<div class="main">
    			    <div class="feature_list">
                 <div id="main_page">
      	<div class="mainpage_container">
<div id="rooms">
  <div id="room" class="clearfix" >
    <div id="the_roof">
    
	<div id="room_snapshot">
    	 	
		<h1 itemprop="name" title="Adam centre, 10 mins walk to canals"><div class="overflow"><?php echo $product->product_name; ?></div></h1>
		<ul class="reputation unstyled PL15">
			<li class="badge badge_type_reviews-bubble">
				<span class="badge_image">
					<span class="badge_text reviews-bubble"><?php echo stripslashes($product->bedroom) ?></span>
				</span>
				<span class="badge_name">Bedrooms</span>
			</li>
            <li class="badge badge_type_reviews-bubble">
				<span class="badge_image">
					<span class="badge_text reviews-bubble"><?php echo stripslashes($product->bathroom) ?></span>
				</span>
				<span class="badge_name">Bathrooms</span>
			</li>
            <li class="badge badge_type_reviews-bubble">
				<span class="badge_image">
					<span class="badge_text reviews-bubble"><?php echo stripslashes($product->sleeps) ?></span>
				</span>
				<span class="badge_name">Sleeps</span>
			</li>
	</ul>
    <div class="price ">
		<div class="price_data">$<?php echo $product->price; ?> / Day</div>
	</div>
   
	</div>
	<div class="clear"></div>
</div>
    <div id="left_column">
<div id="main_content" class="box">
  <div class="middle clearfix">
    <div class="heading_tab">
        	 <h2>Photos</h2>
        </div>
    <div id="photos_div" class="main_content" >
      <div class="banner_slider" id="header">
      <div style="float: left; margin-left:495px; margin-top: 17px; position: absolute; z-index: 999999999;"><a target="_blank" href="javascript:void(0);"  onclick="javascript:window.open('mailto:?subject=I wanted you to see this site&amp;body=Check out this site:  <?php echo current_url(); ?>'); return false;" enctype="text/plain" title="Email to a friend"><img src="images/friend-button.png" width="150"/></a>  </div>
      <ul id="myGallery">
      <?php
	  	$imgArr = $productImages->result_array();
		if(count($imgArr)>0)
		{
			foreach ($imgArr as $img)
			{
				echo '<li><img src="'.$base_url_image.'images/product/'.$img['product_image'].'" width="630" alt="'.$img['imgtitle'].'" /></li>';
			 }
		}
		else
		{
			echo '<li><img src="'.$base_url_image.'images/product/dummyProductImage.jpg" width="192" height="113" alt="" /></li>';
		}
	  ?>
	</ul>
    </div>
    </div>
    <div class="clear"></div>
    
  </div>
</div>
<div id="inner_topnav">
		<ul class="unstyled rooms_sub_nav clearfix" style="margin:0 0 0 11px; padding:10px 0 0 10px; border-radius:0px; border:1px solid #D0D0D0; width:66.6%; background-image:none;background:#FFF;">
        	  <li class="main_link"><a href="<?php echo current_url()?>#description">Overview</a></li>
              <li class="main_link"><a href="<?php echo current_url()?>#features">Reviews</a></li>
              <!--<li class="main_link"><a href="<?php echo current_url()?>#rental-rates">Rates</a></li>-->
              <li class="main_link"><a href="<?php echo current_url()?>#calendar">Calendar</a></li>
              <li class="main_link"><a href="<?php echo current_url()?>#attractions">Location</a></li>
              <li class="main_link"><a href="<?php echo current_url()?>#owner-info">Owner Info</a></li>
              <li class="main_link"><a href="<?php echo current_url()?>#property-rooms">Photos</a></li>
        </ul>
        </div>
<div id="details" class="box">
    <div class="middle clearfix">
        <div class="heading_tab" id="description">
        	 <h2>Overview<a name="description"></a></h2>
        </div>
        <div class="details_content">
        <div class="vacation_tab Pwidth">
        <ul id="description_details" class="unstyled">
                 
              </ul>
            <div id="description_text">
                <div id="description_text_wrapper" class="trans">
                  <p><?php echo stripslashes($product->description); ?></p>
                </div>
            </div>
            </div>
        </div>
        
         <div class="vacation_tab Pwidth">        	
            <div id="description_text">
                <div id="description_text_wrapper" class="trans">
                  <strong>Property Type:</strong>
				  <div class="oth_detil"><br /><?php //echo $product->property_type;
				  
				 		$property_typeArr= explode(',',$product->property_type);
				 
				  if(count($property_typeArr) > 0){
				  foreach($property_typeArr as $property_typ){
				   echo '<span style="font-size:12px;">'.$property_typ.'&nbsp;&nbsp;&nbsp;&nbsp;</span>';
				   }
				   } ?></div>
                </div>
            </div>
            </div>
            
             <div class="heading_tab">
        	 <h2>Amenities<a name="amenities"></a></h2>
        	</div>
            <div class="vacation_tab">
            	<?php echo $listCountryValue; ?>
                </div>
            
         <!--<div class="vacation_tab Pwidth">        	
            <div id="description_text">
                <div id="description_text_wrapper" class="trans">
                <strong>Features:</strong><br /><br />
                  <div class="oth_detil"><?php echo stripslashes($product->feature); ?></div>
                </div>
            </div>
            </div>-->
            
         <div class="vacation_tab Pwidth">        	
            <div id="description_text">
            <?php
			if(!empty($product->add_feature))
			{
			?>
                <div id="description_text_wrapper" class="trans">
                  <strong>Other Activities :</strong><br /><br /> 
				  <div class="oth_detil"><?php echo stripslashes($product->add_feature); ?></div>
                </div>
                <?php
				}
				if(!empty($product->rentals_policy))
				{
				?>
                <!--<div id="description_text_wrapper" class="trans">
                  <strong>Rental Policy:</strong><br /><br /> 
				  <div class="oth_detil"><?php echo stripslashes($product->rentals_policy); ?></div>
                </div>-->
                <?php 
				}
				if(!empty($product->trams_condition))
				{
				?>
               <!-- <div id="description_text_wrapper" class="trans">
                  <strong>Terms and Condition:</strong><br /><br /> 
				  <div class="oth_detil"><?php echo stripslashes($product->trams_condition); ?></div>
                </div>-->
                <?php
				}
				?>
            </div>
            </div>
            <?php
			
			if(!empty($product->about))
			{
			?>
        <div class="heading_tab">
        	 <h2>Owner Information<a name="owner-info"></a></h2>
        </div>
        <div class="vacation_tab Pwidth">        	
            <div id="description_text">
                <div id="description_text_wrapper" class="trans">
                  <strong>About the owner:</strong><br /><?php echo $product->about; 
				  ?>
                </div>
            </div>
            </div>
            <?php
			}
			?>
            <div class="heading_tab">
        	 <h2>Location<a name="attractions"></a></h2>
        	</div>
            <div class="vacation_tab">
            	<div class="location_map">
                	<iframe width="100%" height="400px" src="https://maps.google.com/?q=<?php echo $product->latitude;?>,<?php echo $product->longitude;?>&amp;ie=UTF8&amp;t=m&amp;z=14&amp;ll=<?php echo $product->latitude;?>,<?php echo $product->longitude;?>&amp;output=embed"></iframe> 
                </div>                  
                
                </div>
        <div class="heading_tab">
        	 <h2>Reviews <a name="features" href="<?php echo base_url().'rental/'.$product->id; ?>/write_review" class="link_tex"> Write a review</a> </h2>
        	</div>
             <div class="vacation_tab">
             	<div class="review_list">
                     <?php
	  	$reviewArr = $reviewData->result_array();
		
		//print_r($reviewArr);die;
		if(count($reviewArr)>0)
		{
			foreach ($reviewArr as $revData)
			{
			?>	
            <div class="review_list1">
            	<?php if($revData['rateVal'] == '1'){ ?>                    
                   	<img src="images/rating1.png" />
                 <?php } elseif($revData['rateVal'] == '2') {?>
                   	<img src="images/rating2.png" />
                 <?php } elseif($revData['rateVal'] == '3') {?>                    
                   	<img src="images/rating3.png" />
                 <?php } elseif($revData['rateVal'] == '4') {?>                    
                   	<img src="images/rating4.png" />
                 <?php } elseif($revData['rateVal'] == '5') {?>                    
                   	<img src="images/rating5.png" />
                 <?php } else{ ?>                    
                   	<img src="images/rating0.png" />
                 <?php }?>                    					                    
                    	<span class="review_title"><?php echo $revData['title'];?></span>
                        <div class="clear"></div>
                        <span class="span_name"><b><?php if($revData['user_type']=='Guest'){ echo $revData['user_type']; }?></b> <?php echo $revData['nickname'];?> (<?php echo $revData['location'];?>)</span>
                        <div class="clear"></div>
                        <span class="span_tex"><b>Date of stay </b><?php echo $revData['date_arrival'];?></span>
                        <span class="review_righ"><b>Review Submitted</b> <?php echo $revData['dateAdded'];?></span>
                        <div class="review_txt"><?php echo $revData['review'];?></div> 
                        <span class="review_txt"><b>Recommended for: </b> <?php echo $revData['recommendation'];?></span>
                        <!--<span class="review_title">Review Submitted <?php echo $revData['dateAdded'];?></span>-->
                        <?php if($revData['owner_reply']!=''){ ?>
                        <div class="ownerresponse">
                        	<p><b>Owner response:</b> <?php echo $revData['owner_reply'];?></p>
                        
                        
                        </div>
                        <?php } ?>                     
                    </div>
		<?php 	 }
		}
		else
		{
			echo 'No Reviews';
		}
	  ?>
                    
                    
                    </div>
                </div>
             
             <div class="heading_tab">
        	 <h2>Photos<a name="property-rooms"></a></h2>
        	</div>
               <div class="vacation_tab">
            <div id="description_text">
                <ul class="photo_list">
                
               
                
                
                	<?php
						$imgArr = $productImages->result_array();
						if(count($imgArr)>0)
						{
							foreach ($imgArr as $img)
							{
								echo '<li><img src="'.$base_url_image.'images/product/'.$img['product_image'].'" alt="'.$img['imgtitle'].'" width="483" /></li>';
							 }
						}
						else
						{
							echo '<li><img src="'.$base_url_image.'images/product/dummyProductImage.jpg" width="483" /></li>';
						}
					?>
                </ul>         
            </div>
            
            </div>
            <div class="heading_tab">
        	 <h2>Room Details<a name="room-details"></a></h2>
        </div>
         <div class="vacation_tab">
         	<div style="width:100%; float:left">
            	<div style="width:90%; float:left;">
                BEDROOM
                </div>
                <div style="width:10%; float:left;">
                <?php echo stripslashes($product->bedroom); ?>
                </div>
            </div>
         <div style="width:100%; float:left">
            	<div style="width:90%; float:left;">
                BATHROOM
                </div>
                <div style="width:10%; float:left;">
                <?php echo stripslashes($product->bathroom); ?>
                </div>
            </div>
         <div style="width:100%; float:left">
            	<div style="width:90%; float:left;">
                SLEEPS
                </div>
                <div style="width:10%; float:left;">
                <?php echo stripslashes($product->sleeps); ?>
                </div>
            </div>
         
         
         </div>
            
             <!--<div class="heading_tab">
        	 <h2>Rental Rates<a name="rental-rates"></a></h2>
        	</div>
               <div class="vacation_tab">
                <?php echo stripslashes($product->rates); ?>
            		<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #666666; margin:10px 0px;">
                    	<tr>
                        	<th>Dates</th>
                        	<th>Nightly($)</th>
                            <th>Wknd Night($)</th>
                            <th>Weekend($)</th>
                            <th>Weekly($)</th><th>Monthly($)</th>
                            <th>Event</th>
                            
                        </tr>
                        <?php foreach($RatePackage->result() as $pricerange)
						{
						 ?><tr> <td><?php echo $pricerange->PrName; 
						
						 $stDate=date('M d',strtotime($pricerange->PrStartDate));
						 $edDate=date('M d',strtotime($pricerange->PrEndDate));
						 echo '<br /><span style="color:#666644; font-size:10px;">'.$stDate.' - '.$edDate.'</span>';
						 
						 
						 
						 ?></td>
                        	<td><?php if($pricerange->Nightly > 0){ echo $pricerange->Nightly;} ?></td>
                            <td><?php if($pricerange->WkndNight > 0){  echo $pricerange->WkndNight;} ?> </td>
                            <td><?php if($pricerange->Weekend > 0){  echo $pricerange->Weekend; }?></td>
                            <td><?php if($pricerange->Weekly > 0){ echo $pricerange->Weekly;} ?></td>
                            <td><?php if($pricerange->Monthly > 0){ echo $pricerange->Monthly;} ?></td>
                            <td><?php if($pricerange->Event > 0){ echo $pricerange->Event;} ?></td>
                            
                       </tr><?php } ?> 
                    </table>
            
            </div>-->
            <div class="heading_tab">
            <h2>Availability Calendar<a  name="calendar"></a></h2></div>
        	<!--<a name="calendar" style="cursor:pointer;" class="example16" data-pid="<?php echo $product->id; ?>" href="<?php echo $product->id; ?>"> <h2>Click to View the Availability Calendar</h2></a>-->
            <div class="clear"></div>
            <?php
			
			
			$_SESSION['PropId'] =  $product->id; 
			 include('calendar.php'); ?>
            
        	
             
    			<div class="clear"></div>
            </div>
              <div class="clear"></div>
        </div>
    </div>
</div>
    <div id="right_column">
      <div id="user" class="box">
      <div class="middle clearfix">
		<div class="right_tab">
        	 <h2>Owner Detail</h2>
        	</div>
    <div class="profile_pic clearfix">
    <div class="matte-media-box matte_owner"><img alt="Owner" src="<?php echo $base_url_image; ?>images/users/<?php if($product->thumbnail=='')echo "owner_img.png"; else echo $product->thumbnail; ?>" width="180" height="180" title="Owner" />
      </div>
      <div class="field_info">
        	<span>Owner's Name:</span>
            <?php 
				echo ($product->user_id == 0)?'Administrator': $product->first_name; 
			?>
        </div>
        <div class="field_info">
        	<span>Phone No:</span>
             <?php 
				echo $product->phone_no; 
			?>
        </div>
        <!--<div class="field_info">
        	<span>Email:</span>
              <?php 
				echo ($product->user_id == 0)?'Administrator':$product->s_phone_no; 
			?>
        </div>-->
    </div>
  </div>
  <div class="middle clearfix">
  <?php echo form_open('site/contact/contact_owner',array('id'=>'contact_form')); ?>
  	<input type="hidden" name="owner" value="<?php echo $product->user_id; ?>" />
		<div class="right_tab">        
        	 <h2>Contact the Owner</h2>
        	</div>
         <div class="profile_pic clearfix">
      <div class="field_login">
        	<label>First Name :<span>*</span></label>
            <input type="text" class="scroll_6 required" name="first_name" id="first_name" />
            <div id="first_name_warn"  style="float:left; color:#FF0000;"></div>
        </div>

        <div class="field_login">
        	<label> Last Name :</label>
            <input type="text" class="scroll_6" name="last_name" id="last_name" />
        </div>
        <div class="field_login">
        	<label>E-mail Address :<span>*</span></label>
            <input type="text" class="scroll_6 required email" name="email_address" id="email_address" />
        	<div id="email_address_warn"  style="float:left; color:#FF0000;"></div>
            </div>
        <div class="field_login">
        	<label>Phone No :<span>*</span></label>
            <input type="text" class="scroll_6 required number" name="ph_no" id="ph_no"/>
        	<div id="ph_no_warn"  style="float:left; color:#FF0000;"></div>
            </div>
        <div class="field_main">
        	<div class="field_login">
        	<label>Arrival Date :<span>*</span></label>
            <input type="text" class="scroll_7 datepicker required" name="Arr_date" id="Arr_date" />
        	<div id="Arr_date_warn"  style="float:left; color:#FF0000;"></div>
            </div>
        </div>
        <div class="field_main">
        	<div class="field_login" style="width:100%;">
        	<label>Departure Date :<span style="padding:0px;">*</span></label>
           <input type="text" class="scroll_7 datepicker required" name="Dep_date" id="Dep_date" />
        	<div id="Dep_date_warn"  style="float:left; color:#FF0000;"></div>
            </div>
        </div>
        <div class="field_main">
        	<div class="field_login">
        	<label> Adults :<span>*</span></label>
            <input type="text" class="scroll_7 required number" name="Adult" id="Adult" />
        	<div id="Adult_warn"  style="float:left; color:#FF0000;"></div>
            </div>
        </div>
        <div class="field_main">
        	<div class="field_login">
        	<label> Children : </label>
           <input type="text" class="scroll_7" name="Children" />
        </div>
        </div>
        <div class="field_login">
        	<label>Message :</label>
            <textarea class="scroll_6" style="height:100px;" name="Message"></textarea>
        </div>
        
         <div class="field_login">
                                <div style="border: 1px solid #CCCCCC;color: #000000; float: left; font-size: 3em;font-style: oblique;font-weight: bold; height: 2em; line-height: 2em;text-align: center; text-decoration: line-through; width: 99%;">
                                <?php $random_values = substr(number_format(time() * rand(),0,'',''),0,4); $random_values1 = substr(number_format(time() * rand(),0,'',''),0,4); ?>
                                 <span style="color: #000000;float:left; text-align:right;text-decoration: line-through; width: 49%; transform: rotate(12deg);"><?php echo $random_values; ?></span><span style="color: #000000;float: left; text-align:left;text-decoration: line-through; width: 49%; transform: rotate(-12deg);"><?php echo $random_values1; ?></span></div>
                                 <input type="hidden" name="captcha_original" id="captcha_original" value="<?php echo $random_values.$random_values1; ?>" />
                                 </div>
                                 
                                 
        <div class="field_main">
        	<div class="field_login">
        	<label> Captcha : <span>*</span></label>
           <input type="text" name="captcha_value" id="captcha_value" class="scroll_7 required" equalto="#captcha_original" >
           <div id="captcha_value_warn"  style="float:left; color:#FF0000;"></div>
        </div>
        </div>
       <div class="field">
         <input type="hidden" name="renter_id" value="<?php echo $product->user_id; ?>" />
         <input type="hidden" name="RenterEmail" value="<?php echo $product->RenterEmail; ?>" />
        <input type="hidden" name="rental_id" value="<?php echo $product->id; ?>" />
        <input type="hidden" name="user_group" value="<?php echo $this->session->userdata('fc_session_group'); ?>"  />
            <input type="submit" value="Submit" name="submit" class="btn green font-medium">
        </div>
        
    </div>
    <?php echo form_close(); ?>
    
  </div>
<!--href="javascript:void(o);" onclick="javascript:window.location.href='mailto:?subject=I wanted you to see this site&amp;body=Check out this site  <?php echo current_url(); ?>'; return false;"
<div style="margin-left:40px;"><a target="_blank" href="javascript:void(0);"  onclick="javascript:window.open('mailto:?subject=I wanted you to see this site&amp;body=Check out this site  <?php echo current_url(); ?>'); return false;" enctype="text/plain" title="Email to a friend"><img src="images/friend-button.png" width="150"/></a>
-->





<script type="text/javascript">
/*
function emailThis() {

	var strTo,strSubject,strBody;strTo="";
	strSubject = "I wanted you to see this site";
	strPageURL = location.href;
	strBody="Check out the following page:"+"%0d%0a%0d%0a"+escape(strPageURL)+"%0d%0a%0d%0a"+"";
	window.location="mailto:"+strTo+"?subject="+strSubject+"&body="+strBody;
}
*/



</script>
  
  
  <!--<img style='display:block;width:800px;height:500px' title='canvas' alt='canvas' src='<?php echo base_url().'images/product/'.$imgArr[0]['product_image']; ?>' /><a target="_blank" title="Share this page" href="http://www.sharethis.com/share?url=<?php echo current_url(); ?>&title=<?php echo $product->product_name; ?>&img=<?php echo base_url().'images/product/'.$imgArr[0]['product_image'];?>&pageInfo=%7B%22hostname%22%3A%22[INSERT DOMAIN NAME]%22%2C%22publisher%22%3A%22<?php echo $product->id; ?>%22%7D"><img width="86" height="25" alt="Share this page" src="http://w.sharethis.com/images/share-classic.gif"></a>-->

</div>
    </div>
  </div>
</div>
      </div>
      </div>
             
		    </div>
    </div>
<!--body content-->
</section>


<script type="text/javascript">
$(function() {
			$("#contact_form").submit(function(){
				// var email = $('#vendor_email').val();
				//alert('');
				$("#first_name_warn").html('');
				 $("#email_address_warn").html('');
				 $("#ph_no_warn").html('');
				 $("#Arr_date_warn").html('');
				 $("#Dep_date_warn").html('');
				 $("#Adult_warn").html('');
				 $("#captcha_value_warn").html('');
				
					if(jQuery.trim($("#first_name").val()) == '')
					{
						
						$("#first_name_warn").html('First name is required');
						$("#first_name").focus();
						return false;
						
					}else if(IsEmail(jQuery.trim($("#email_address").val())) == false){
					  
						$("#email_address_warn").html('Invalid email address');
						$("#email_address").focus();
						return false;
						
					}else if(IsNumber(jQuery.trim($("#ph_no").val())) == false){
						
						$("#ph_no_warn").html('Phone number is required');
						$("#ph_no").focus();
						return false;
					
					}else if(jQuery.trim($("#Arr_date").val()) == ''){
						
						$("#Arr_date_warn").html('Arrival date is required');
						$("#Arr_date").focus();
						return false;
						
					}else if(jQuery.trim($("#Dep_date").val()) == ''){
						
						$("#Dep_date_warn").html('Departure date is required');
						$("#Dep_date").focus();
						return false;
												
					}else if(IsNumber(jQuery.trim($("#Adult").val())) == false){
					   
						$("#Adult_warn").html('Enter the number of persons');
						$("#Adult").focus();
						return false;
					
					}else if(jQuery.trim($("#captcha_value").val()) != jQuery.trim($("#captcha_original").val())){
						
						$("#captcha_value_warn").html('captcha dosent match');
						$("#captcha_value").focus();
						return false;
						
					}else
					{	
					      	$("#contact_form").submit();
					}
					
					return false;	
				});
		});
		function IsEmail(email_address) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(email_address)) {
           return false;
        }else{
           return true;
        }
      }
	  function IsNumber(ph_no) {
        var regextx = /^([0-9])+$/;
        if(!regextx.test(ph_no)) {
           return false;
        }else{
           return true;
        }
      }
	 
function removeError(idval){
	$("#"+idval+"_warn").html('');}
</script>




<!--<script type="text/javascript" src="js/site/jquery.validate.js"></script>
<script>
	$("#contact_form").validate({
	  rules:{
		  	first_name: {
				required: true,
				minlength: 2
			},
			email_address: {
				required: true,
				email: true
			},
			ph_no: {
				required: true,
				number: true
			},
			Arr_date: {
				required: true,
				
			},
			Dep_date: {
				required: true,
				
			},			
			Adult: {
				required: true,
				number: true
			},
			captcha_value: {
				required: true,
				minlength: 2,
				equalTo: "#captcha_original"
			}
	  },
	  messages: {
		  first_name: {
				required: "First name required",
				minlength: "First name must consist of at least 2 characters"
			},
			
			email_address: {
				required: "Please enter user email address",
				email:"Please enter a valid email address"
			},
			ph_no: {
				required: "Please enter phone number",
				number: "Only enter numbers"
			},
			Arr_date: {
				required: "Arrival date required",
				
			},
			Dep_date: {
				required: "Departure date required",
				
			},
			Adult: {
				required: "Please enter number of persons",
				number: "Only enter numbers"
			},
			captcha_value: {
				required: "Please type the above captch value",
				minlength: "Please verify the number of characters",
				equalTo: "Please enter the same characters as displayed above"
			}
	  }
  });
</script>-->

<script type="text/javascript">
$('.example16').click(function(){
	$('#inline_example11 .popup_page').html('<div class="cnt_load"><img src="images/ajax-loader.gif"/></div>');
	var pid = $(this).data('pid');
	var pname = $(this).text();
	var purl = baseURL+$(this).attr('href');
	$.ajax({
		type:'get',
		url:baseURL+'site/product/view_calendar',
		data:{'pid':pid},
		dataType:'html',
		success:function(data){ 
//			window.history.pushState({"html":data,"pageTitle":pname},"", purl);
			$('#inline_example11 .popup_page').html(data);
		}
	});
});
</script>

<?php
$this->load->view('site/product/front_calendar',$this->data);
$this->load->view('site/templates/footer');
?>