<?php $this->load->view('site/templates/header'); ?>
<style>
.comp_h2 {
    margin: 0 0 10px 30px;
    font-family: 'OpenSansRegular';
    font-size: 18px;
    font-weight: bold;
}
.comps_table {
    font-family: 'OpenSansRegular';
    float: left;
    width: 95%;
    margin: 0 0 20px 30px;
}
.comps_table td {
    text-align: center;
}
</style>
<script src="js/drag-min.js"></script>



<script>

$(function() {

$( "#draggable" ).draggable();
$("#draggable1").draggable();
});

</script>

 <script type="text/javascript">



		function displayfunction(id,id2){

		

		

		if(document.getElementById(id).style.display=="none")

		{

		document.getElementById(id).style.display="block";

		document.getElementById(id2).style.display="none";

		return true;

		}

		if(document.getElementById(id).style.display=="block")

		{

		document.getElementById(id).style.display="none";

		document.getElementById(id2).style.display="block";

		return true;

		}

		

		}

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



</script>

<!-- Second, add the Timer and Easing plugins -->

<script type="text/javascript" src="js/site/slide/jquery.timers-1.2.js"></script>

<script type="text/javascript" src="js/site/slide/jquery.easing.1.3.js"></script>



<!-- Third, add the GalleryView Javascript and CSS files -->

<script type="text/javascript" src="js/site/jquery.galleryview-3.0-dev.js"></script>

<link type="text/css" rel="stylesheet" href="css/site/jquery.galleryview-3.0-dev.css" />



<!-- Lastly, call the galleryView() function on your unordered list(s) -->

<script type="text/javascript">

	$(function(){

		$('#myGallery').galleryView({

		transition_speed: 1000, 		//INT - duration of panel/frame transition (in milliseconds)

		transition_interval: 4000, 		//INT - delay between panel/frame transitions (in milliseconds)

		easing: 'swing', 				//STRING - easing method to use for animations (jQuery provides 'swing' or 'linear', more available with jQuery UI or Easing plugin)

		show_panels: true, 				//BOOLEAN - flag to show or hide panel portion of gallery

		show_panel_nav: false, 			//BOOLEAN - flag to show or hide panel navigation buttons

		enable_overlays: true, 			//BOOLEAN - flag to show or hide panel overlays

		

		panel_width: 416, 				//INT - width of gallery panel (in pixels)

		panel_height: 300, 				//INT - height of gallery panel (in pixels)

		panel_animation: 'slide', 		//STRING - animation method for panel transitions (crossfade,fade,slide,none)

		panel_scale: 'crop', 			//STRING - cropping option for panel images (crop = scale image and fit to aspect ratio determined by panel_width and panel_height, fit = scale image and preserve original aspect ratio)

		overlay_position: 'bottom', 	//STRING - position of panel overlay (bottom, top)

		pan_images: true,				//BOOLEAN - flag to allow user to grab/drag oversized images within gallery

		pan_style: 'drag',				//STRING - panning method (drag = user clicks and drags image to pan, track = image automatically pans based on mouse position

		pan_smoothness: 15,				//INT - determines smoothness of tracking pan animation (higher number = smoother)

		start_frame: 1, 				//INT - index of panel/frame to show first when gallery loads

		show_filmstrip: true, 			//BOOLEAN - flag to show or hide filmstrip portion of gallery

		show_filmstrip_nav: true, 		//BOOLEAN - flag indicating whether to display navigation buttons

		enable_slideshow: false,			//BOOLEAN - flag indicating whether to display slideshow play/pause button

		autoplay: false,				//BOOLEAN - flag to start slideshow on gallery load

		show_captions: true, 			//BOOLEAN - flag to show or hide frame captions	

		filmstrip_size: 3, 				//INT - number of frames to show in filmstrip-only gallery

		filmstrip_style: 'scroll', 		//STRING - type of filmstrip to use (scroll = display one line of frames, scroll filmstrip if necessary, showall = display multiple rows of frames if necessary)

		filmstrip_position: 'bottom', 	//STRING - position of filmstrip within gallery (bottom, top, left, right)

		frame_width: 65, 				//INT - width of filmstrip frames (in pixels)

		frame_height: 80, 				//INT - width of filmstrip frames (in pixels)

		frame_opacity: 1, 			//FLOAT - transparency of non-active frames (1.0 = opaque, 0.0 = transparent)

		frame_scale: 'crop', 			//STRING - cropping option for filmstrip images (same as above)

		frame_gap: 5, 					//INT - spacing between frames within filmstrip (in pixels)

		show_infobar: false,				//BOOLEAN - flag to show or hide infobar

		infobar_opacity: 1				//FLOAT - transparency for info bar

		});

	});

</script>

<style>

#draggable { padding: 0.5em; }

</style>

<div class="listing_content" style="margin:20px 0 15px 0px;">



 	<script src="<?php echo base_url(); ?>js/calculator/custom_jscalc.js"></script>   



<!--<a id="openPopUp" class="calculateBtn" href="javascript:void(0);"></a>-->

 <div class="calculatorPopUp"   >

        <script type="text/javascript">

function addCommas(nStr)

{

	nStr += '';

	x = nStr.split('.');

	x1 = x[0];

	x2 = x.length > 1 ? '.' + x[1] : '';

	var rgx = /(\d+)(\d{3})/;

	while (rgx.test(x1)) {

		x1 = x1.replace(rgx, '\$1' + ',' + '\$2');

	}

	return x1 + x2;

}

 

function stripCommas(nStr)

{

  return nStr.replace(',', '') *1;

}

 

function compute_pvalue(form)

{

// Calculate total gross income

  var gross = 0;

  gross = stripCommas(form.rent.value) * 12;

  form.gross.value =  addCommas(gross);

 

 

  var other = stripCommas(form.other.value) * 1;

  var total_gross = gross + other;

   form.total_gross.value =  addCommas(total_gross);

   

   

	/*	vc = total_gross * form.vc_pct.value/100;

		mv = total_gross * form.maintes.value/100;

		mf = total_gross * form.mang_fee.value/100;

		form.vc_act.value = addCommas(vc);

		form.maint.value = addCommas(mv); 

		form.mgt.value = addCommas(mf); 

	*/



 

   if(form.vc_pct.value == 0)

   		{

			vc = (form.vc_act.value * 100) / total_gross;

			form.vc_pct.value = vc;

		}

	else

		{

			vc = total_gross * form.vc_pct.value/100;

			form.vc_act.value = addCommas(vc);

		}

	if(form.maintes.value == 0)

		{

			mv = (form.maint.value * 100) / total_gross;

			form.maintes.value = mv;

		}

	else

		{

			mv = total_gross * form.maintes.value/100;

			form.maint.value = addCommas(mv); 

		}

	if(form.mang_fee.value == 0)

		{

			mf = (form.mgt.value * 100) / total_gross;

			form.mang_fee.value = mf;

		}

	else

		{

			mf = total_gross * form.mang_fee.value/100;

			form.mgt.value = addCommas(mf); 

		}

		

		

		

	



 

  var noi = total_gross - vc

                  - stripCommas(form.impr.value)

                  - stripCommas(form.maint.value)

                  - stripCommas(form.util.value)

                  - stripCommas(form.tax.value)

                  - stripCommas(form.ins.value)

                  - stripCommas(form.mgt.value);

  form.noi.value = addCommas(noi);

 

  var cap_rate = form.cap_rate.value   * 1;

  var cur_value = stripCommas(form.cur_value.value) * 1;

 

  if (cur_value != 0) 

   {

    cap_rate = (noi * 100)/cur_value;

    form.cap_rate.value = cap_rate.toFixed(2);

   }

 

  if (cap_rate == 0)

      {cap_rate = 7.5;

       form.cap_rate.value = cap_rate;

      }

 

    

    cur_value = (noi * 100)/cap_rate;

    form.cur_value.value = addCommas(cur_value.toFixed(0));

	var capvalue = 0.00;

	if(noi){



		if(form.vcp_per.value>0){

			capvalue =  noi/(form.vcp_per.value/100);

		}else{

			capvalue =  '';

		}

     }

	 else{

	 		capvalue=0;

	 }

		form.vcp.value=addCommas(capvalue.toFixed(0));

}



</script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/calculator/simplecalendar.js" ></script>







 

 

 <div id="details" class="calc_popup"  style="display:none;"> <div id="draggable" class="ui-widget-content "> 













        

        	<!--calculatorPopUpTop starts here-->

            <span class="calculatorPopUpTop" ></span>

            <!--calculatorPopUpTop ends here-->

        

            <!--calculatorPopUpMain starts here-->

            <div class="calculatorPopUpMain datatable">

            

            	<a  id="cboxClose"  ></a>

                

                <h2>Calculate Your Own Estimated Return</h2>

               <div class="outLink"><a href="http://www.realtytrac.com/content/news-and-opinion/single-family-rentals-top-20-markets-7670" target="_blank" >Nationwide Cap Rate Averages</a></div>

               <div class="clear"></div>

              <form name="frm" id="frm">  

                <!--popupFormEnclose starts here-->

                <div class="popupFormEnclose width100">

                

                    <!--popupFormBox starts here-->

                    <div class="popupFormBox width100">

                     <label>Monthly Rent</label> <input type="text" name="rent" size="10" value="" />

					  <div class="ccrighttxt">Enter the total monthly rent you receive</div>

             </div>

                    <!--popupFormBox ends here-->

                    

                    <!--popupFormBox starts here-->

                    <div class="popupFormBox width100">

                    	

                        <label>Gross Annual Income</label>

                      <input type="text" disabled="disabled" name="gross" size="10" class="disabled" />

                        <div class="ccrighttxt">Calculated as monthly rent * 12</div>

                        

                    </div>

                    <!--popupFormBox ends here-->

                    

                    <!--popupFormBox starts here-->

                    <div class="popupFormBox width100">

                    	

                        <label>Other Income</label>

                       <input type="text" name="other" size="10" />

                        <div class="ccrighttxt">Enter the annual amount of any other income (e.g. Laundry)</div>

                        

                    </div>

                    <!--popupFormBox ends here-->

                    

                    <!--popupFormBox starts here-->

                    <div class="popupFormBox width100">

                    	

                        <label>Total Gross</label>

                        <input type="text"  name="total_gross" size="10" />

                       <div class="ccrighttxt">Calculated as the annual rent plus other income.</div>

                        

                    </div>

                    <!--popupFormBox ends here-->

                    

                    <!--popupFormBox starts here-->

                    <div class="popupFormBox width100">

                    	

                        <label style="width:50px;">Vacancy</label>  <input type="text"name="vc_pct" size="2" class="vc_pct" value="0" style="width:20px; " /> <label style="width:20px ;margin-right:57px;">%</label>

                       <input type="text"  name="vc_act" size="10" />

                        <div class="ccrighttxt">Estimate a value for expected vacancies (5% is typical)</div>

                        

                    </div>

                    <!--popupFormBox ends here-->

                    

                                    <!--popupFormBox starts here-->

               

                    <!--popupFormBox ends here-->

                      <input name="impr" type="hidden" size="10" value="0" />

                                    <!--popupFormBox starts here-->

  <!--                  <div class="popupFormBox width100">

                    	

                        <label>Amortized Costs </label>-->

                   

                       <!-- <h5>Estimate an annual amortized value for repairs and capital improvements (e.g. a $10,000 roof amortized over 10 years = $1,000)</h5>

                        

                    </div>-->

                    <!--popupFormBox ends here-->

                    

                             <div class="popupFormBox width100">

                    	

                        <label  style="width:75px;">Maintenance</label> <input  type="text"name="maintes" size="2" class="vc_pct" value="0" style="width:20px;  " /><label style="width:20px ;margin-right:32px;"> % </label>

                    <input name="maint" size="10" value="" type="text" />

                        <div class="ccrighttxt">Estimate an annual amortized value for repairs and capital improvements (e.g. a $10,000 roof amortized over 10 years = $1,000)</div>

                        

                    </div>

                   

                    

                    

                          <div class="popupFormBox width100">

                    	

                        <label>Utilities </label>

                   <input name="util" size="10" value=""  type="text" />

                        <div class="ccrighttxt">Enter the amount spent on utilities this year.</div>

                        

                    </div>

                    

                    

                    <div class="popupFormBox width100">

                    	

                        <label>Property Taxes </label>

                  <input name="tax" size="10" value="" type="text" />

                        <div class="ccrighttxt">Enter the annual property tax amount for the building.</div>

                        

                    </div>

                    

                      <div class="popupFormBox width100">

                    	

                        <label>Insurance </label>

                             <input name="ins" size="10" value="0" type="text" />

          

                        <div class="ccrighttxt">Enter the annual property insurance premium.</div>

                        

                    </div>

                    

                 

                    

                   <div class="popupFormBox width100">

                    	

                        <label style="width:115px;">Management Fees </label>  <input  type="text"name="mang_fee" size="2" class="vc_pct" value="0" style="width:20px; margin-left:7px; " /><label style="width:20px ;margin-right:16px;"> % </label>

                     <input name="mgt" size="10" type="text" style="margin-left:0px;" />

                        <div class="ccrighttxt">Net Operating Income</div>

                        

                    </div>

                    

                                       

                    

                    

                <div class="popupFormBox width100">

                <label>Net Operating Income</label>

                

                <input disabled="disabled" name="noi" class="disabled"  size="10"   type="text" />

                

                <div class="ccrighttxt">Calculated as the annual gross income minus expenses</div> 

                </div>

                    

                    

			      <div class="popupFormBox width100">

					 <label>Sale Price</label>

					<input name="cur_value" id="cur_value" size="10"  type="text" value="<?php echo number_format($productDetails->row()->event_price, 0); ?>"  />

					<div class="ccrighttxt">Enter the current market value <u>and leave the CAP Rate blank</u> to calculate the CAP Rate</div>

                    </div>

                    

                    

			      <div class="popupFormBox width100">

					 <label>CAP Rate</label>

					<input name="cap_rate" size="10"  type="text" class="result"   />        

					<div class="ccrighttxt">Enter a CAP Rate <u>and leave the sale Price blank</u> to calulate the property value</div>

                    </div>

                    

                     <div>

			      <div class="popupFormBox  floatLeft" style="width:21%;">

			

					<input name="Button" class="bt_c " style="padding-top:3px; padding-bottom:5px; " onclick="compute_pvalue(this.form)" type="button" value="Calculate" style="width:103px; float:left; "  />

					</div>

                    <div class="popupFormBox  floatLeft" style="width:70%; margin-top:10px;">

                    	

                        <label style="width:75px; margin-top:3px;" >Value at</label> <input  type="text"name="vcp_per" size="2" class="vc_pct" value="0" style="width:22px; margin:0px; float:left" /> <label style="width:44px;" >% Cap </label> <input name="vcp" size="10" type="text" style="margin:0px 0 0 20px;" />

                                               

                    </div>

                    

                    </div>

                    

                

                </div>

                <!--popupFormEnclose ends here-->

                </form>

                

            </div>

            <!--calculatorPopUpMain ends here-->

            

            <!--calculatorPopUpBotttom starts here-->

            <span class="calculatorPopUpBotttom"></span>

            <!--calculatorPopUpBotttom ends here-->

        

        </div>

        </div></div>





<div class="detail_titleuse">

	<ul class="button_tab_de">

    	<li><a href="javascript:void(0);">ID :<span><?php echo $productDetails->row()->property_id; ?></span> </a></li>

    </ul>

    

     <h2><?php echo $productAddress->row()->address.', '.$productAddress->row()->city.', '.str_replace('-', ' ', $productAddress->row()->state).' '.$productAddress->row()->post_code; ?></h2>

<?php if ($userDetails->row()->reservation == 'Yes') {
    ?>

<a href="<?php echo base_url().'reservation-continue/'.$userDetails->row()->property_id ; ?>" class="detail_btn" style="margin-top:10px;"> Back To Reservation</a>

<?php
} ?>

</div>

<div class="left_detail">



    <div class="scroll_product">

   <ul id="myGallery">

   <?php foreach ($productImages->result() as $Image) {
        ?> 

           <li><img src="<?php echo $base_url_image; ?>images/product/<?php
                        if ($Image->product_image != '') {
                            echo $Image->product_image;
                        } else {
                            echo 'no_image.jpg';
                        } ?>"  alt="<?php echo $Image->imgtitle; ?>" data-description=" " data-thumb="<?php echo $base_url_image; ?>images/product/thumb/<?php
                             if ($Image->product_image != '') {
                                 echo $Image->product_image;
                             } else {
                                 echo 'no_image.jpg';
                             } ?>" /></li>
            <?php
    } ?>

           

           

             

        </ul>

    </div>

 <div class="left_conttext">

 <h2>Short Remarks</h2>

 <?php echo $productDetails->row()->short_remarks; ?>

 <h2>Full Remarks</h2>

 <?php echo $productDetails->row()->full_remarks; ?>

 

 

 </div>

    

    

</div>

 <div class="right_detail">



 <div class="inside_right">

 

 <?php if ($this->session->userdata('fc_session_group') == 'Admin') {
        ?>

 <form id="buy_property" name="buy_property" method="post" action="reservation/<?php echo $productDetails->row()->id; ?>">

 <input name="code" id="reservationconfirmcode" type="password" placeholder="Reservation code" size="20" maxlength="20" class=" required reservationcode" />

 <input type="hidden" name="admincode" id="admincode" value="<?php echo trim($admin_settings->row()->booking_code); ?>" />

 <div id="reservationconfirmcode_warn" style="float:right; color:#FF0000;"></div>

 	<ul class="proinform_list">

    	<li><p>Member Price :</p><span><?php echo "$".number_format($productDetails->row()->member_price, 0); ?></span></li>

        <li><p>Event only price :</p><span> <?php echo "$".number_format($productDetails->row()->event_price, 0); ?></span></li>

    

    </ul>

 <input type="submit" name="buy" class="buyer_btn <?php if ($productDetails->row()->property_status=='Sold') {
            echo 'clicksold';
        } elseif ($productDetails->row()->property_status=='Reserved') {
            echo 'clickreserved';
        } ?>" value="BUY NOW">

 </form>

 <?php
    } else {
     ?>

 <ul class="proinform_list">

    	<li><p>Member Price :</p><span><?php echo "$".number_format($productDetails->row()->member_price, 0); ?></span></li>

        <li><p>Event only price :</p><span> <?php echo "$".number_format($productDetails->row()->event_price, 0); ?></span></li>

    

    </ul>

 <a href="#" class="buyer_btn <?php if ($productDetails->row()->property_status=='Sold') {
         echo 'clicksold';
     } elseif ($productDetails->row()->property_status=='Reserved') {
         echo 'clickreserved';
     } else {
         echo 'click1';
     } ?>">BUY NOW</a>

 <?php
 } ?>

 <div class="clear"></div>

 <div class="bor_st"></div>

 

 <div class="split_detail1">

 <ul class="splitdetai_list">

        <li><p style="color:#104c89; font-size:15px;">Property Details </p></li>

    	<li><p>Bedrooms: </p><span><?php echo $productDetails->row()->bedrooms; ?></span></li>

        <li><p>Baths: </p><span> <?php echo $productDetails->row()->baths; ?></span></li>

        <li><p>Sq FT: </p><span>  <?php echo number_format($productDetails->row()->sq_feet, 0); ?></span></li>

        <li><p>YEAR Built: </p><span> <?php echo $productDetails->row()->built; ?></span></li>

        

                    <?php if ($productDetails->row()->property_sub_type != 0) {
     ?>

         <li><p>TYPE: </p><span> <?php foreach ($PropertySubType->result() as $row1) {
         if ($productDetails->row()->property_sub_type == $row1->id) {
             echo $row1->subattr_name;
         }
     } ?></span></li>

                                            

                     <?php
 } else {
                         ?>

        <li><p>TYPE: </p><span> <?php foreach ($PropertyType->result() as $row) {
                             if ($productDetails->row()->property_type == $row->id) {
                                 echo $row->attr_name;
                             }
                         } ?></span></li>

                                           <?php
                     } ?>

        <li><p>LOT SIZE:</p><span> <?php echo number_format($productDetails->row()->lot_size); ?></span></li>

    

    </ul>

  </div>

 <div class="split_detail2">

  <ul class="splitdetai_list2">

         <li><p style="color:#104c89; font-size:15px;">Cash Flow analysis</p></li>

    	<li><p>MONTHLY RENT PMT :</p><span><?php echo "$".number_format($productDetails->row()->monthly_rent, 0); ?></span></li>

        <li><p>ANNUAL RENT :</p><span><?php echo "$".number_format($productDetails->row()->annual_rent, 0); ?></span></li>

    

    </ul>

 </div>

 

 

 

 

 

 

        

        

        

        

        

           

        

 <div class="calculater"><a id="edit_options" onclick="return displayfunction('details','details_parent');" href="javascript:void(0);" ><img src="images/site/cal.png" /></a></div>

 

 

 

 

 

 



 

 

 

 

 

 

 

 <div class="split_detail2" style="width:66%;">

  <ul class="splitdetai_list2" style="margin-top:0px;">

       <li><p>Estimated* Hazard Insurance: </p><span><?php echo "$".number_format($productDetails->row()->hazard_ins, 0); ?></span></li>

        <li><p>Estimated* Property Taxes: </p><span> <?php echo "$".number_format($productDetails->row()->property_tax, 0); ?></span></li>

		  <li><p>Property Managment Exp: </p><span><?php echo "$".number_format($productDetails->row()->management_expenses, 0); ?></span></li>

           <li><p> Annual Utilites Exp: </p><span><?php echo "$".number_format($productDetails->row()->utilities, 0); ?></span></li>

    		

    </ul>

      <div class="clear"></div>

 <div class="bor_st"></div>

 

 <div class="total_full">

 <p>Estimated* Net Income: </p>

 <span><?php echo "$".number_format($productDetails->row()->net_income, 0); ?></span>

  </div>

   </div>

 

 <div class="clear"></div>

 <p class="detail_tex">* These estimates are based on current information and projections and are not a guarantee of 

   future income. All investments have risk. Additional or increased expenses and vacancies 

   could effect your actual realized return on your real estate investment property.</p>

 </div>
 
 <div class=" clear"></div>

 <!--<div class="map_con"> <iframe width="550" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/?q=,<?php echo $productAddress->row()->longitude;?>&amp;ie=UTF8&amp;t=m&amp;z=14&amp;ll=<?php echo $productAddress->row()->latitude;?>,<?php echo $productAddress->row()->longitude;?>&amp;output=embed"></iframe></div>-->

 

 

 <div class="map_con"><iframe width="550" height="350" src="https://maps.google.com/maps?width=550&amp;height=350&amp;hl=en&amp;q=<?php echo $productAddress->row()->address.','.$productAddress->row()->city.','.str_replace('-', ' ', $productAddress->row()->state);?>+(Return on Rentals)&amp;ie=UTF8&amp;t=&amp;z=15&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
 
 
 </div>

 

 </div>
 
 


<div class="clear"></div>

	<h2 class="comp_h2">Comps</h2>
    <table class="comps_table" width="100%" border="0">
        <thead>
            <tr>
                <th width="35%"> Property Address </th>
                <th width="15%"> Purchase Price </th>
                <th width="14%"> Date Sold </th>
                <th width="16%"> Type of Deal </th>
                <th width="9%"> # of Beds </th>
                <th width="11%"> # of Baths </th>

            </tr>
        </thead>
        <tbody>
            <?php
            if ($CompDetails->num_rows > 0) {
                foreach ($CompDetails->result() as $CompDets) {
                    ?>
                    <tr>
                        <td class="center"><?php echo $CompDets->comp_prop_address; ?></td>
                        <td class="center">$<?php echo $CompDets->comp_purchase_price; ?></td>
                        <td class="center"><?php echo $CompDets->comp_date_sold; ?></td>
                        <td class="center"><?php echo $CompDets->comp_type_deal; ?></td>
                        <td class="center"><?php echo $CompDets->no_of_beds; ?></td>
                        <td class="center"><?php echo $CompDets->no_of_baths; ?></td>
                    </tr>

                    <?php
                }
            }
            ?>
        </tbody>
    </table>

</div>


<!----------listing end content-------------->

</div>

<div class="clear"></div>





	



 </div>

	 </div>

<script type="text/javascript">

$(function() {

			$("#buy_property").submit(function(){

			//alert('fuck you');

			 		$("#reservationconfirmcode").html('');

				 	

					if(jQuery.trim($("#reservationconfirmcode").val()) == ''){

						

						$("#reservationconfirmcode_warn").html('Reservation code is required');

						$("#reservationconfirmcode").focus();

						return false;

					}else

					{	

						if(jQuery.trim($("#admincode").val()) == jQuery.trim($("#reservationconfirmcode").val())){

					      	

							$("#buy_property").submit();

							return true;

						}else{

							$("#reservationconfirmcode_warn").html('Invalid Reservation code');

							$("#reservationconfirmcode").focus();

							return false;

						}

					}

					

					return false;

			}); 

			}); 

            </script>    

<?php $this->load->view('site/templates/footer'); ?>