<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
unset($_SESSION['sCheckTimeReser']);
unset($_SESSION['sCheckTimeSold']);
if ($heading == ''){?>
<title><?php echo $title;?></title>
<?php }else {?>
<title><?php echo $heading;?></title>
<?php }?>

<meta name="Title" content="<?php echo $meta_title;?>" />
<meta name="keywords" content="<?php echo $meta_keyword; ?>" />
<meta name="description" content="<?php echo $meta_description; ?>" />
<link rel="shortcut icon" type="image/x-icon" href="images/logo/<?php echo $this->config->item('fevicon_image'); ?>">
<base href="<?php echo base_url(); ?>" />

<link rel="stylesheet" type="text/css" href="css/site/master.css"/>
<link href='http://fonts.googleapis.com/css?family=Oswald:700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/site/banner_style.css" type="text/css" media="all"/>
<link rel="stylesheet" href="css/developer.css" type="text/css" media="all"/>
<script src="js/site/jquery-1.7.1.min.js"></script> 
<script type="text/javascript" src="js/site/jcarousellite_1.0.1.pack.js"></script>

<script type="text/javascript">
		var baseURL = '<?php echo base_url();?>';
		$(function() {
    		$(".slider_1").jCarouselLite({
        		btnNext: ".next_1",
        		btnPrev: ".prev_1",
				auto: true,
    			speed: 5000,
        		visible:5
    		});
		});
		

</script>

<script type="text/javascript">


/*** 
    Simple jQuery Slideshow Script
    Released by Jon Raasch (jonraasch.com) under FreeBSD license: free to use or modify, not responsible for anything, etc.  Please link out to me if you like it :)
***/

function slideSwitch() {
    var $active = $('#slideshow IMG.active');

    if ( $active.length == 0 ) $active = $('#slideshow IMG:last');

    // use this to pull the images in the order they appear in the markup
    var $next =  $active.next().length ? $active.next()
        : $('#slideshow IMG:first');

    // uncomment the 3 lines below to pull the images in random order
    
    // var $sibs  = $active.siblings();
    // var rndNum = Math.floor(Math.random() * $sibs.length );
    // var $next  = $( $sibs[ rndNum ] );


    $active.addClass('last-active');

    $next.css({opacity: 0.0})
        .addClass('active')
        .animate({opacity: 1.0}, 1000, function() {
            $active.removeClass('active last-active');
        });
}

$(function() {
    setInterval( "slideSwitch()", 5000 );
});

function displayBlockIdeas() { 
	$.get( "site/product/changereservationStatus", function( data ) {
	  
	  $( "#reservatiosnIDLists" ).html( data );
	
	    $( ".front_popup_step1" ).fadeIn('slow');  
		 $( ".front_popup_step1" ).fadeOut(5000);
		var countCheck = '<?php echo $_SESSION['sCheckTimeReser'];?>';
		if(countCheck == 4) {
			 $( ".front_popup_step1" ).fadeOut( 'slow' );
		}
	});
}



function displayBlockIdeas2() { 
	$.get( "site/product/changesoldStatus", function( data ) {
	  
	  $( "#soldIDLists" ).html( data );
	    $( ".front_popup_step2" ).fadeIn( 'slow' );
		$( ".front_popup_step2" ).fadeOut(5000);
		var countCheck = '<?php echo $_SESSION['sCheckTimeSold'];?>';
		if(countCheck == 4) {
			 $( ".front_popup_step2" ).fadeOut( 'slow' );
		}
	});
}





</script> 
<?php 
if ($loginCheck != '' && $this->config->item('id_reservation') != ''){
?>    
<script type="text/javascript">
jQuery(function() {
			setInterval("displayBlockIdeas()",10000);
	});
	</script>
	<?php }
	if ($loginCheck != '' && $this->config->item('id_sold') != ''){
	?>
    <script type="text/javascript">
jQuery(function() {
			setInterval("displayBlockIdeas2()",10000);
	});
	
</script>

<?php } ?>
<!--Popup-->
<link rel="stylesheet" href="css/site/popup.css" type="text/css" media="all"/>
<!-- End pop up-->

<script src="js/site/jquery.colorbox.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="css/site/colorbox.css" />
</head>

<body>
<?php 

//$this->product_model->saveResevedSettings();	

$reservedID = array_filter(explode(',',$this->config->item('id_reservation')));

?>

<!--popup-->
<div class='popup'>
    <div class='content'>
   	 <img src='images/x.png' alt='quit' class='x' id='x' />
   	
        <div class="property_view propertyStatus">
        <p>Please login to view property</p>
        		
        </div>
              
    </div>
</div>
<!--End popup-->
<!--popup-->



<script>
$(document).ready(function(){


		$('#cboxClose').click(function(){
			$("#details").hide();
			return false;
		});
		$(".cboxClose").click(function(){
			$("#cboxOverlay,#colorbox,#draggable").hide();
			//alert("jj");
			window.location.href = baseURL+'signin';
			});
		
			
			
			$(".inquiry-popup").colorbox({width:"365px", height:"380px", inline:true, href:"#inline_reg"});
			
			$(".click").colorbox({width:"500px", height:"150px", inline:true, href:"#inline_login"});
			$(".click1").colorbox({width:"500px", height:"150px", inline:true, href:"#inline_login1"});
			
			
			$(".clickreserved").colorbox({width:"500px", height:"150px", inline:true, href:"#inline_reserved"});
			$(".clicksold").colorbox({width:"500px", height:"150px", inline:true, href:"#inline_sold"});
			
			$(".youtubevideo1").colorbox({width:"625px", height:"375px", inline:true, href:"#youtube_video1"});
			$(".youtubevideo2").colorbox({width:"625px", height:"375px", inline:true, href:"#youtube_video2"});
			$(".youtubevideo3").colorbox({width:"625px", height:"375px", inline:true, href:"#youtube_video3"});
			$(".youtubevideo4").colorbox({width:"625px", height:"375px", inline:true, href:"#youtube_video4"});
			$(".youtubevideo5").colorbox({width:"625px", height:"375px", inline:true, href:"#youtube_video5"});
			$(".youtubevideo6").colorbox({width:"625px", height:"375px", inline:true, href:"#youtube_video6"});
			$(".youtubevideo7").colorbox({width:"625px", height:"375px", inline:true, href:"#youtube_video7"});
			$(".youtubevideo8").colorbox({width:"625px", height:"375px", inline:true, href:"#youtube_video8"});
			$(".youtubevideo9").colorbox({width:"625px", height:"375px", inline:true, href:"#youtube_video9"});
			$(".youtubevideo10").colorbox({width:"625px", height:"375px", inline:true, href:"#youtube_video10"});
		
			
			$(".clickcalc").colorbox({width:"800px", height:"650px", opacity:0, inline:true, href:"#draggable"});
		
		$(".example16").colorbox({width:"800px", height:"700px", inline:true, href:"#inline_example11"});
		//Example of preserving a JavaScript event for inline calls.
			$("#onLoad").click(function(){ 
				$('#onLoad').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
				return false;
			});

});
</script>
<div  style='display:none;'>
  <div id='inline_login' style='background:#fff;'>
  		<div class="property_view propertyStatus">
        <p style="margin:34px 0 0 0px;"><blink>Please login to view property</blink></p>
        		
        </div>
  </div>
</div>
<div  style='display:none;'>
  <div id='inline_login1' style='background:#fff;'>
  <?php 
echo $BuyNowPages[0]['description'];
?>
  
  		<!--<div class="property_view">
        <p style="margin:27px 0 10px 0px;">Please contact a property specialist to reserve this property</p>
        		
        </div>-->
  </div>
</div>
<?php if($this->uri->segment(1) == 'Property') { ?>
<div  style='display:none;'>
  <div id='inline_reserved' style='background:#fff;'>
  		<div class="property_view propertyStatus" >
        <p style="margin:27px 0 10px 0px;"><blink>Property id(<?php echo $productDetails->row()->property_id;?>) is <b style="color:#C00">Reserved</b></blink></p>
        		
        </div>
  </div>
</div>
<div  style='display:none;'>
  <div id='inline_sold' style='background:#fff;'>

  		<div class="property_view propertyStatus">
        <p style="margin:27px 0 10px 0px;">Property id(<?php echo $productDetails->row()->property_id;?>) is <b style="color:#C00">Sold</b></p>
        		
        </div>
  </div>
</div>
<?php } ?>
<!--End popup-->
	<div class="wrapper">
		<!--<img src="images/site/img1.jpg" />	-->
        	<div id="slideshow">
                    
                    <?php if(count($SliderDisplay) > 0){$imgcount='1';
				foreach ($SliderDisplay->result() as $Slider){
				?>
      <img src="images/slider/<?php echo trim(stripslashes($Slider->image)); ?>" alt="" <?php if($imgcount=='1'){ ?> class="active" <?php } ?> />
      <?php $imgcount=$imgcount+1;}}?>
            </div>
            <div class="social-share">
            	<ul class="face_list">
                	<li>
                    <a target="_blank" href="<?php echo $this->config->item('facebook_link');?>" title="facebook"> <img src="<?php echo base_url();?>images/site/facebook.png" /></a>
                    <a target="_blank" href="<?php echo $this->config->item('facebook_link');?>" title="facebook">Facebook</a>
                    <div class="clear"></div>
                    <div class="bor_fa"></div>
                    </li>
                    
                    <li>
                    <a target="_blank" href="<?php echo $this->config->item('twitter_link');?>" title="twitter"> <img src="<?php echo base_url();?>images/site/twitter.png" /></a>
                    <a target="_blank" href="<?php echo $this->config->item('twitter_link');?>" title="twitter">Twitter</a>
                    <div class="clear"></div>
                    <div class="bor_fa"></div>
                    </li>
                    
                    <li>
                    <a target="_blank" href="<?php echo $this->config->item('linkedin_link');?>"> <img src="<?php echo base_url();?>images/site/in.png" /></a>
                    <a target="_blank" href="<?php echo $this->config->item('linkedin_link');?>">Linkedin</a>
                    <div class="clear"></div>
            
                    </li>
                
                
                
                </ul>
            
            </div>
                    
                  
              
                    
	</div>
    
   
  <?php /*?> <?php
  foreach($reservedStatus->result() as $reservedProp)
  	{ ?>
    <div id="validationErr" style="height:30px; ">
  <script>setTimeout("hideErrDiv('validationErr')", 5000);</script>
  <p style="font-size:18px; "><?php echo "Property id :".$reservedProp->property_id()." is reserved";?></p>
</div>
	
	<?php } ?>
	<?php */?>
   
    
   
   
    
		<div class="main">
        	<div class="container_full">
        	<div class="header">
            	<div class="logo">
                	<h1>
                    <a href="<?php echo base_url();?>"><img src="images/logo/<?php echo $this->config->item('logo_image');?>" /></a>
                    </h1>
                 </div>
                 	<div class="top_support">
                    	<p>Email: <?php echo $this->config->item('site_contact_mail');?></p>
                        <a href="javascript:void(0);"><img src="images/site/mobile.png" /></a>
                        <h2><?php echo $this->config->item('site_contact_number');?></h2>
                        <div class=" clear"></div>
                        
                        <?php 
						
						if($loginCheck == '')
								{?>
                                <div class="member_use">
                        	<a href="signin">Free Membership</a>
                            </div>
                            <?php
							}
							else
							{ ?>
								
                                 <div class="welcome-user" style="background:none; ">
                        	<span style="color:#333; margin-top:5px"><?php echo "WELCOME ".$userDetails->row()->user_name;?></span><?php if($userDetails->row()->group != 'Admin') {?><a href="<?php echo base_url(my_account);?>" class="detail_btn" style="text-decoration:none; margin-left:5px; padding:3px 11px 3px 11px;">My Account</a> <?php } ?>
                            <a href="<?php echo base_url(signout); ?>" class="detail_btn" style="text-decoration:none; margin-left:5px; padding:3px 11px 3px 11px;">LOGOUT</a>
                      </div>
                           <?php  } ?>
                        
                    </div>
            
        
        	</div>
  <div class="menufull">
  		<div class="menu_nav">
        	<ul>
            	<li><a href="<?php echo base_url();?>"  <?php if($menuActive==''){echo 'class="menu_act"';} ?> >Home</a></li>
                <li><a class="<?php if($menuActive=='property'){echo 'menu_act ';} ?>" href="<?php if($loginCheck==''){echo base_url().'signin'; }else{ echo base_url().'listing/viewall/0/2';/*echo base_url(listing)."/".$featureRow->id;*/}?>">Properties</a></li>
                <li><a href="<?php echo base_url();?>pages/about-us" <?php if($menuActive=='about-us'){echo 'class="menu_act"';} ?>>About Us  </a></li>
                <li><a href="<?php echo base_url(contact);?>" <?php if($menuActive=='contact'){echo 'class="menu_act"';} ?> >Contact Us </a></li>
            
            </ul>
    
   	    </div>
    		<div class="support_view">
            	<ul>
                	<li><a class="<?php if($this->uri->segment(1,0)=='listing'){echo 'listing_active';} ?>" href="<?php if($loginCheck==''){echo base_url().'signin'; }else{echo base_url().'listing/viewall/0/2';}?> ">Current Inventory</a><img src="images/site/arrow.png" /></li>
                    <li><a class="<?php if($this->uri->segment(1,0)=='soldlisting'){echo 'listing_active';} ?>" href="<?php if($loginCheck==''){echo base_url().'signin'; }else{echo base_url().'soldlisting/viewall/0/2';}?>">Past/Sold Inventory </a><img src="images/site/arrow.png" /></li>
                   </ul>
    		</div>
  </div>
        
<!----------listing content------------------>
<script type="text/javascript">
function hideErrDiv(arg) {
       $("#"+arg).slideUp();//window.location.reload();
	    document.getElementById(arg).style.display = 'none';
		
}</script>
<?php if (validation_errors() != ''){?>
<div id="validationErr" style="height:30px; ">
  <script>setTimeout("hideErrDiv('validationErr')", 5000);</script>
  <p style="font-size:18px; "><?php echo validation_errors();?></p>
</div>
<?php }?>
<script>setTimeout("hideErrDiv('location_val')", 5000);</script>
<?php if($flash_data != '') { ?>
                    <div class="errorContainer" style="min-height:40px;" id="<?php echo $flash_data_type;?>">
                        <script>setTimeout("hideErrDiv('<?php echo $flash_data_type;?>')", 5000);</script>
                        <p style="color:#FF0000; font-size:15px; font-weight:bold; font-family:Arial, Helvetica, sans-serif;"><span style="font-size:14px; font-weight:bold;"><?php echo $flash_data;?></span></p>
                    </div>
                    <?php } ?>
<?php 
//$this->load->view('site/templates/popup_templates.php',$this->data);

if($this->config->item('google_verification_code')){ echo stripslashes($this->config->item('google_verification_code'));}
?>
<script type="text/javascript">
function LoginPageRedirect(){
window.location.href=baseURL+'signin';
}
</script>
