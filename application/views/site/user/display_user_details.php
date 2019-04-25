<?php $this->load->view('site/templates/new_header');

$SignId=$this->session->userdata('SignID');
$UrlId=$this->session->userdata('UrlID');

$this->session->unset_userdata('SignID');
$this->session->unset_userdata('UrlID');

if ($SignId != '' && $UrlId != '') {
    ?>
	<script type="text/javascript">
	jQuery(document).ready(function(e){
		window.open("viewconfirmation/<?php echo $SignId; ?>/<?php echo $UrlId; ?>",'_blank');
	});
	</script>
    <?php
} ?>


<script type="text/javascript" src="js/site/SpryTabbedPanels.js"></script>
<link href="css/site/my-account.css" type="text/css" rel="stylesheet" media="all" />
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

$(document).ready(function(){
	$(".red_sign").click(function(){
		//alert('siva');
		var abc = $(this).attr('data-url');
		$('#customUrl').val(abc);
		//alert(abc);
	});
});
	
function showPopUpOrg(){
	if(document.getElementById('ShowPopupContentOrg').style.display=="none"){
		document.getElementById('ShowPopupContentOrg').style.display="block";
		return true;
	}else if(document.getElementById('ShowPopupContentOrg').style.display=="block"){
		document.getElementById('ShowPopupContentOrg').style.display="none";
		return true;
	}
}


function showPopUp(){

	if(document.getElementById('ShowPopupContent').style.display=="none"){
		document.getElementById('ShowPopupContent').style.display="block";
		return true;
	}else if(document.getElementById('ShowPopupContent').style.display=="block"){
		document.getElementById('ShowPopupContent').style.display="none";
		return true;
	}
}
</script>

<script language="javascript">
function validateFn(){

	var checkrate_value = $('input:radio[name=radio_button]:checked').val();

	if(checkrate_value == 'Yes'){
		var CurUrl = $('#customUrl').val();
		//alert(CurUrl);
		window.location.href = "<?php echo base_url(); ?>"+CurUrl;
	}else{
		showPopUpOrg();
	}
}
</script>

<style>
    .pdf_btn, .dwn_btn {
        background: #c7812b;
        color: #FFFFFF;
        margin: 10px 0 0 5px;
        padding: 3px 0;
        text-transform: uppercase;
    }
#draggablecalci { padding: 0.5em; }

.account_popup {
    background: url("images/popup_bg.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
    border-radius: 10px;
    height: 520px;
    overflow: auto;
    padding: 41px;
    position: absolute;
    top: 10%;
    width: 611px;
    z-index: 9999 !important;
	left:20%;
}


#cboxContent {
    background: url("images/popup_bg.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0) !important;
    border: medium none !important;
	background-size:100% 100% !important;
}
#cboxLoadedContent {
    background: none !important;
    box-shadow: none !important;
    width: 96% !important;
    margin: 0px !important;
    height: 1000px !important;
}
#colorbox{
	z-index:999 !important;
}
#cboxOverlay{
	z-index:99 !important;
}
#cboxWrapper{
	z-index:999 !important;
}
#cboxClose{
	right: 42px !important;
	top: 43px !important;
}
.popup_title{
    color: #82a800;
    float: left;
    font-family: 'OpenSansRegular';
    font-size: 20px;
    font-weight: bold;
    margin: 15px 0 10px 40px;
    padding: 0;
    width: 90%;
}
.popup_inner_content p{
	color: #000000;
    float: left;
    font-size: 13px;
    font-weight: normal;
    line-height: 24px;
    padding: 0 3px;
    width: 99%;
	font-family: 'OpenSansRegular';
	text-align:left !important;
	padding-bottom:10px !important;
}
.popup_inner_content p a{
	color:#696969;
	text-decoration:underline;
}
.popup_inner_content p a:hover{
	color:#696969;
	text-decoration:none;
}
.popup_list{
	float:left;
	width:100%;
}
.popup_list li{
	float:left;
	padding-right:15px;
}
.popup_list li strong{
	color: #000000;
    font-size: 13px;
    font-weight: bold;
    line-height: 24px;
	font-family: 'OpenSansRegular';
}
.next_btn_main{
	margin-top:40px;
	width:100%;
	float:right;
}
.next_btn{
	background:url(images/next_btn.png) no-repeat !important;
	width:61px !important;
	height:32px !important;
	text-indent:-9999px;
	border:none !important;
	float:right;
	cursor:pointer;
}
input.css-checkbox[type="checkbox"] {
    border: 0 none;
    clip: rect(0px, 0px, 0px, 0px);
    height: 26px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 29px;
}

input[type=checkbox].css-checkbox + label.css-label {
	background-position: 0 0;
    background-repeat: no-repeat;
    cursor: pointer;
    display: inline-block;
    font-size: 15px;
    font-weight: bold;
    height: 26px;
    line-height: 27px;
    padding-left: 31px;
    vertical-align: middle;
	font-family: 'OpenSansRegular';
						}

input[type=checkbox].css-checkbox:checked + label.css-label { background-position: 0 -15px; }

.click_popup{
	position:absolute;
	top:10%;
	background:#FFFFFF;
	border-radius:10px;
	box-shadow: 0 0 0 10px rgba(0, 0, 0, 0.1);
	-moz-box-shadow: 0 0 0 10px rgba(0, 0, 0, 0.1);
	-webkit-box-shadow: 0 0 0 10px rgba(0, 0, 0, 0.1);
	padding:25px;
	z-index:9999 !important;
	width:790px;
	height:520px;
	overflow:auto;
	left:13%;
}
.click_popup p {
    color: #000000;
    float: left;
    font-family: 'OpenSansRegular';
    font-size: 13px;
    font-weight: normal;
    line-height: 24px;
    padding-bottom: 10px !important;
    padding-left: 3px;
    padding-right: 3px;
    padding-top: 0;
    text-align: left !important;
    width: 99%;
}
.click_popup .popup_title{
	margin:15px 0 10px !important;
}
.click_popup ul li {
    color: #000000;
    float: left;
    font-family: 'OpenSansRegular';
    font-size: 15px;
    font-weight: normal;
    line-height: 24px;
    padding-bottom: 10px !important;
    padding-left: 3px;
    padding-right: 3px;
    padding-top: 0;
    text-align: left !important;
    width: 99%;
	font-weight:bold;
	list-style:disc;
}
.click_popup ul li ul{
  	margin-left: 20px;
    margin-top: 15px;
}
.click_popup ul li ul li{
	font-size: 13px !important;
	font-weight:normal !important;
	list-style:circle;
}
.click_close {
    background: url("images/controls.png") no-repeat scroll -25px 0 transparent !important;
    border: medium none;
    height: 24px;
    position: absolute;
    right: 35px;
    text-indent: -9999px;
    top: 30px;
    width: 26px;
}

.click_close1 {
    background: url("images/controls.png") no-repeat scroll -25px 0 transparent !important;
    border: medium none;
    height: 24px;
    position: absolute;
    right: 5px;
    text-indent: -9999px;
    top: 8px;
    width: 26px;
}


#cboxContent {
    background: #f8f8f8 !important;
    border: 7px solid #c7812b !important;
    color: #222222 !important;
    height: 850px !important;
    width: 660px !important;
    border-radius: 5px!important;
    overflow: auto;
}


.calculatorPopUpMain h2 {
    color: #000000;
    font-size: 24px;
    font-weight: bold;
    margin: 10px 0 10px 10px;
    padding: 0px;
}

.outLink a {
    color: #c7812b !important;
    font-size: 17px;
    margin: 20px 15px 10px 0px;
    padding: 0px;
    float: right;
}
.popupFormBox {
    margin: 11px 0px 11px 0px;
    padding: 0px;
    float: left;
}


.popupFormBox label {
    width: 175px;
    font-size: 12px;
    margin: 0 0 0 5px;
    padding: 0px;
    color: #333333;
    float: left;
    text-align: left;
    font-weight: bold;
    text-transform: uppercase;
}
.popupFormBox input {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 12px;
    float: left;
    margin: 1px 0 0 15px;
    background: none repeat scroll 0 0 #e8e8e8;
    border: 1px solid #C9BDB4;
    color: #4A4A4A;
    height: 20px;
    padding: 0 0 0 4px;
    width: 96px;
}
.ccrighttxt {
    font-size: 11px;
    color: #666666;
    margin: 0 0 0 15px;
    padding: 0px;
    width: 335px;
    overflow: hidden;
    text-align: left;
    float: left;
}
.popupFormBox input {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 12px;
    float: left;
    margin: 1px 0 0 15px;
    background: none repeat scroll 0 0 #e8e8e8;
    border: 1px solid #C9BDB4;
    color: #4A4A4A;
    height: 20px;
    padding: 0 0 0 4px;
    width: 96px;
}

.bt_c {
    background: url(./images/site/by_tt.jpg) repeat-x scroll 0 0 rgba(0, 0, 0, 0) !important;
    border: medium none;
    border-radius: 5px;
    color: #FFFFFF !important;
    cursor: pointer;
    float: right;
    font-size: 12px !important;
    font-weight: bold;
    margin: 5px 10px 0 0;
    outline: medium none;
    padding: 4px 28px;
    text-transform: uppercase !important;
    height: 25px !important;
}
.bt_c:hover {
    background: #c7812b !important;
}


.css-label{ /*background-image:url(images/radio_btn.png);*/ }

</style>


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


<div class="container">

<div class="listing_content">
		<div class="freemember">
        <h2>Profile</h2>
       <div id="TabbedPanels1" class="TabbedPanels">
           
            <ul class="TabbedPanelsTabGroup">
              <li class="TabbedPanelsTab " tabindex="0">View Profile</li>
                <?php if ($UserDetails->row()->group != 'Admin') {
                    ?>
                    <li class="TabbedPanelsTab " tabindex="0">Reserved Property</li><?php
                } ?>
             <li class="TabbedPanelsTab " tabindex="0">Documents</li>
            </ul>
            
            <div class="TabbedPanelsContentGroup">
              <div class="TabbedPanelsContent ">
            	  	<div class="tab_box">
                      <div>
                          <div class="personal_detail" id="details_parent">
                                <div class="personal_title">
                                    <span>Personal Details</span>
                                    <a href="javascript:void(0);" id="edit_options" onclick="return displayfunction('details','details_parent');" class="edit_btn"></a>
                                </div>
                                <ul class="personal_text">
                                
                                	<li>
                                         <label>Email Address</label><em>:</em>
                                         <span><?php echo $UserDetails->row()->email; ?></span>
                                    </li>
                                    
                                    <li>
                                         <label>First Name </label><em>:</em>
                                         <span><?php echo $UserDetails->row()->first_name; ?></span>
                                    </li>
                                    
                                     <li>
                                         <label>Last Name </label><em>:</em>
                                         <span><?php echo $UserDetails->row()->last_name; ?></span>
                                    </li>
                                    
                                    <li>
                                         <label>Address  </label><em>:</em>
                                         <span><?php echo $UserDetails->row()->address; ?></span>
                                    </li>
                                    
                                     <li>
                                         <label>City </label><em>:</em>
                                         <span><?php echo $UserDetails->row()->city; ?></span>
                                    </li>
                                    
                                     <li>
                                         <label>Country </label><em>:</em>
                                         <span><?php echo $UserDetails->row()->country; ?></span>
                                    </li>
                                    
                                     <li>
                                         <label>State </label><em>:</em>
                                         <span><?php echo str_replace('-', ' ', $UserDetails->row()->state); ?></span>
                                    </li>
                                    
                                     <li>
                                         <label>Phone Number </label><em>:</em>
                                        <span><?php echo $UserDetails->row()->phone_no; ?></span>
                                    </li>
									<li>
                                         <label>Zip Code </label><em>:</em>
                                        <span><?php echo $UserDetails->row()->postal_code; ?></span>
                                    </li>
									<li>
                                         <label><h3><b>(Optional)</b></h3></label><em></em>
                                        <span></span>
                                    </li>
									<li>
                                         <label>Email1</label><em>:</em>
                                        <span><?php echo $UserDetails->row()->email1; ?></span>
                                    </li>
									<li>
                                         <label>Phone1 </label><em>:</em>
                                        <span><?php echo $UserDetails->row()->phone_no1; ?></span>
                                    </li>
									
                                
                                
                                  
                                </ul>
                          </div>
                          <div class="personal_detail" id="details" style="display:none;">
                                <div class="personal_title">
                                    <span>Personal Details</span>
                                      <a href="javascript:void(0);" id="edit_options" onclick="return displayfunction('details','details_parent');" class="edit_btn"></a>
                                </div>
                                <?php
                    $attributes = array('id'=>'SignupForm', 'enctype' => 'multipart/form-data');
                                echo form_open('site/user/EditSiteUserLoginDetails', $attributes); ?>
                                <ul class="personal_text">
                                
                                    <li>
                                           <label>Email Address </label><span>:</span>
                                           <input type="text" name="email" value="<?php echo $UserDetails->row()->email; ?>" id="email" class="text_field_use required" />
                                     </li>
                                    
                                    <li>
                                        <label>First Name </label><span>:</span>
                                       <input type="text" name="first_name" id="first_name" value="<?php echo $UserDetails->row()->first_name; ?>" class="text_field_use required" />
                                    </li>
                                    
                                    <li>
                                        <label>Last Name </label><span>:</span>
                                        <input type="text" name="last_name" id="last_name" value="<?php echo $UserDetails->row()->last_name; ?>" class="text_field_use required" />
                                    </li>
                                    
                                     <li>
                                        <label>Address </label><span>:</span>
                                        <input type="text" name="address" id="address" value="<?php echo $UserDetails->row()->address; ?>" class="text_field_use required" />
                                    </li>
                                    
                                     <li>
                                        <label>City </label><span>:</span>
                                        <input type="text" name="city" id="city" value="<?php echo $UserDetails->row()->city; ?>" class="text_field_use required" />
                                    </li>
                                    
                                    <li>
                                        <label>Country </label><span>:</span>
                                        <input type="text" name="country" id="country" value="<?php echo $UserDetails->row()->country; ?>" class="text_field_use required" />
                                    </li>
                                    
                                     <li>
                                        <label>State </label><span>:</span>
                                         <input type="text" name="state" id="state"
                                                value="<?php echo str_replace('-', ' ', $UserDetails->row()->state); ?>"
                                                class="text_field_use required"/>
                                    </li>
                                    
                                     <li>
                                        <label>Phone Number </label><span>:</span>
                                        <input type="text" name="phone_no" value="<?php echo $UserDetails->row()->phone_no; ?>" id="phone_no" class="text_field_use required" />
                                    </li>
                                    
                                     <li>
                                        <label>Zip code </label><span>:</span>
                                        <input type="text" name="postal_code" id="postal_code" value="<?php echo $UserDetails->row()->postal_code; ?>" class="text_field_use required" />
                                    </li>
                                    <li>
                                        <label><h3><b>(Optional)</b></h3></label><span>:</span>
                                    </li>
									<li>
                                        <label>Email1 </label><span>:</span>
                                        <input type="text" name="email1" id="email1" value="<?php echo $UserDetails->row()->email1; ?>" class="text_field_use" />
                                    </li>
									
									<li>
                                        <label>Phoneno1</label><span>:</span>
                                        <input type="text" name="phone_no1" id="phone_no1" value="<?php echo $UserDetails->row()->phone_no1; ?>" class="text_field_use" />
                                    </li>
                                      <li>
                                            <label>&nbsp; </label><span>&nbsp;</span>
                                            <input type="submit" name="signin" id="signin" class="cancel_btn" value="UPDATE">
                                           <!-- <input type="submit" value="Submit" class="cancel_btn" />
                                            <input type="submit"  value="Cancel" class="cancel_btn" />-->
                                        </li>
                               
                                </ul>
                         <?php echo form_close(); ?>       
                                 
                          </div>
                          </div>
                          <div>
                          <div class="personal_detail" id="pass_parent">
                                <div class="personal_title">
                                    <span>Password Details</span>
                                    <a href="javascript:void(0);" id="change_options" onclick="return displayfunction('password','pass_parent');" class="edit_btn" ></a>
                                </div>
                          </div>
                      		<div class="personal_detail" id="password" style="display:none;">
                                <div class="personal_title">
                                    <span>Password Details</span>
                                      <a href="javascript:void(0);" id="change_options" onclick="return displayfunction('password','pass_parent');" class="edit_btn" ></a>
                                </div>
                                
                                <ul class="personal_text">

                                    <?php
                                    $attributes = array('id' => 'passwordChangeForm');
                                    echo form_open_multipart('site/user/changeOwnpassword', $attributes) ?>
					
                                        <li>
                                            <label>Current Password </label><span>:</span>
                                            <input type="password" name="old_password" id="old_password" class="required text_field_use" >
                            				<div id="old_password_warn"  style="float:left; color:#FF0000;"></div>
                                        </li>
                                        
                                        <li>
                                            <label>New Password </label><span>:</span>
                                            <input type="password" name="password" id="password" class="required text_field_use" >
                            				<div id="password_warn"  style="float:left; color:#FF0000;"></div>
                                        </li>
                                        
                                        <li>
                                            <label>Confirm Password </label><span>:</span>
                                            <input type="password" name="repeat_password" id="repeat_password" class="required text_field_use" >
                            				<div id="repeat_password_warn"  style="float:left; color:#FF0000;"></div>
                                        </li>
                                        
                                         <li>
                                            <label>&nbsp; </label><span>&nbsp;</span>
                                            <input type="hidden" name="pass_inDb" value="<?php echo $UserDetails->row()->password; ?>" />
                                            <input type="hidden" name="id" value="<?php echo $UserDetails->row()->id;?>" />
                                            <input type="submit" name="signin" id="signin" class="cancel_btn" value="UPDATE">
                                            <!--<input type="submit"  value="Submit" class="cancel_btn" />
                                            <input type="submit"  value="Cancel" class="cancel_btn" />-->
                                        </li>
                                    
                                  
                                  <?php echo form_close(); ?>
                                </ul>
                                
                          </div>
                      <div>
                          
                          
                      </div>
                     </div>
             	   <div class="clear"></div>
              </div>
              </div>
              <div class="TabbedPanelsContent">
              	<div class="view_invoice">
                
  <div><a id="edit_options" onclick="return displayfunction89('details','details_parent');" href="javascript:void(0);" class="calculatercal" ><img src="images/site/cal.png" /></a></div>
                
        <div style="display:none" >

                <div id="draggablecalci">
                 <span class="calculatorPopUpTop" ></span>

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
					<input name="cur_value" id="cur_value" size="10"  type="text" />
					<div class="ccrighttxt">Enter the current market value <u>and leave the CAP Rate blank</u> to calculate the CAP Rate</div>
                    </div>


                    <div class="popupFormBox width100">
					 <label>CAP Rate</label>
                        <input name="cap_rate" size="10" type="text" class="result"/>
					<div class="ccrighttxt">Enter a CAP Rate <u>and leave the sale Price blank</u> to calulate the property value</div>
                    </div>

                    <div>
			      <div class="popupFormBox  floatLeft" style="width:21%;">

                      <input name="Button" class="bt_c " style="padding-top:3px; padding-bottom:5px; "
                             onclick="compute_pvalue(this.form)" type="button" value="Calculate"
                             style="width:103px; float:left; "/>
					</div>
                    <div class="popupFormBox  floatLeft" style="width:70%; margin-top:10px;">

                        <label style="width:75px; margin-top:3px;" >Value at</label> <input  type="text"name="vcp_per" size="2" class="vc_pct" value="0" style="width:22px; margin:0px; float:left" /> <label style="width:44px;" >% Cap </label> <input name="vcp" size="10" type="text" style="margin:0px 0 0 20px;" />

                    </div>

                    </div>


                </div>
                <!--popupFormEnclose ends here-->
                </form>

                    </div>
         
                 <span class="calculatorPopUpBotttom"></span>
                </div>
                </div>
        
                
              <table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" class="myorders">
                      <tr class="heading_bar">
                        <td width="10%"><span class="heading">Property Id</span></td>
                        <td width="27%"><span class="heading">Property Image </span></td>
                        <td width="11%"><span class="heading">Property Address</span></td>
                        <td width="13%"><span class="heading">Purchase Price</span></td>
                        <td width="30%"><span class="heading">Cash Flow Analysis</span></td>
                        <td width="19%"><span class="heading">View PDF</span></td>
                      </tr>
                  <?php
                  if ($orderList->num_rows() > 0) {
                      foreach ($orderList->result() as $row) {
                          ?>
                      <tr>
                        <td><ul class="order_number"><li> <?php echo $row->rental_id; ?><?php $atts = array(
              'width'      => '1100',
              'height'     => '700',
              'scrollbars' => '1',
            );/*
echo  anchor_popup("view_orders/".$row->property_id, $atts); */?></li></ul>
                        </td><td>
                              <?php if ($row->image != '') {
                                  $imgName = $row->image;
                              } else {
                                  $imgName = 'dummyProductImage.jpg';
                              } ?>
                              <img src="images/product/thumb/<?php echo $imgName; ?>" width="250px"/>
                       <!-- <ul class="order_number">
                        <li>
                         <?php echo $row->product_name; ?><br />
                        </li><li>
                          Status: <?php echo $row->images; ?>
                        </li></ul>-->
                        
                        </td>
                        <td>
                        <ul class="order_number">
                        <li>
                          <?php echo $row->prop_address; ?>
                        </li></ul>
                        </td>
                        
                       <td>
                          $<?php echo number_format($row->sales_price); ?>
                        </td>
                        <td>
                        	Monthly Rent PMT : $<?php echo number_format($row->monthly_rent); ?><br />
                            Annual Rent : $<?php echo number_format($row->annual_rent); ?><br />
                            Estimated* Hazard Insurance : $<?php echo number_format($row->hazard_ins); ?><br />
                            Estimated* Property Taxes : $<?php echo number_format($row->property_tax); ?><br />
                            Property Management Exp : $<?php echo number_format($row->management_expenses); ?><br />
                            Estimated* Annual Utilities Exp : $<?php echo number_format($row->utilities); ?><br />
                            Estimated* Net Income : $<?php echo number_format($row->net_income); ?>
                        </td>
                          <td>
                              <a href="<?php echo "view_orders/" . $row->id; ?>" class="pdf_btn btn btn-sm">VIEW PDF</a>
                              <a href="<?php echo "site/product/download_images/" . $row->prdId; ?>"
                                 class="dwn_btn btn btn-sm">Download Images</a>
                          </td>
                      </tr>
                      <?php
                      }
                  }
                  ?>
                    </table>
                    </tr>
                    </div>
              </div>
              
              <div class="TabbedPanelsContent">
              	<div class="view_invoice">
                
                
              <table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" class="myorders">
                      <tr class="heading_bar">
                        <td width="10%"><span class="heading">Property Id</span></td>
                        <td width="20%"><span class="heading">Property Address </span></td>
                        <td width="25%"><span class="heading">Purchase Agreement</span></td>
                        <td width="25%"><span class="heading">DOI / Reoccuring Bill Pay</span></td>
                        <td width="25%"><span class="heading">Closing Docs</span></td>
                      </tr>
                  <?php
                  if ($signDetailsGroup->num_rows() > 0) {
                      foreach ($signDetailsGroup->result() as $row) {
                          $paVal = $loanVal = $doiVal = '---';
                          foreach ($signDetails->result() as $signrow) {
                              if ($signrow->reserve_id == $row->reserve_id) {
                                  if ($signrow->pa != '') {
                                      if ($signrow->pa_signed == 'Yes') {
                                          $paVal = '<a href="' . base_url() . 'images/crm-popup-images/' . $signrow->download_name . '" class="green_sign" target="_blank"><b>Signed and Verified</b></a>';
                                      } else {
                                          $paVal = '<a id="edit_options" onclick="showPopUpOrg();" href="javascript:void(0);" data-url="displaysign/' . $signrow->id . '/pa" class=" red_sign" ><b>Click to Sign</b></a>';
                                      }
                                  }

                                  if ($signrow->doi != '') {
                                      if ($signrow->doi_signed == 'Yes') {
                                          $doiVal = '<a href="' . base_url() . 'images/crm-popup-images/' . $signrow->download_name . '" class="green_sign" target="_blank"><b>Signed and Verified</b></a>';
                                      } else {
                                          $doiVal = '<a id="edit_options" onclick="showPopUpOrg();" href="javascript:void(0);" data-url="displaysign/' . $signrow->id . '/doi" class=" red_sign" ><b>Click to Sign</b></a>';
                                      }
                                  }
                                  if ($signrow->loan != '') {
                                      if ($signrow->loan_signed == 'Yes') {
                                          $loanVal = '<a href="' . base_url() . 'images/crm-popup-images/' . $signrow->download_name . '" class="green_sign" target="_blank"><b>Signed and Verified</b></a>';
                                      } else {
                                          $loanVal = '<a id="edit_options" onclick="showPopUpOrg();" href="javascript:void(0);" data-url="displaysign/' . $signrow->id . '/loan" class=" red_sign" ><b>Click to Sign</b></a>';
                                      }
                                  }
                              }
                          } ?>

						
                      <tr>
                        <td><ul class="order_number"><li> <?php echo $row->rental_id; ?></li></ul>
                        </td>
                        <td>
                        <ul class="order_number">
                        <li>
                          <?php echo $row->prop_address; ?>
                        </li></ul>
                        </td>
                        <td><?php echo $paVal; ?></td>
                        <td><?php echo $doiVal; ?></td>
                        <td><?php echo $loanVal; ?>
                        
                          
                
        
                
               
                
                        </td>
                        
                         <!--href="site/user/display_signaturepad" >Click to Sign</a>-->
                      </tr>
                      <?php
                      }
                  } else {
                      ?>
							<tr>
                            	<td colspan="5">Oops.... No Signature Document Found.</td>
                            </tr>
                      <?php
                  } ?>
                    </table>
                    </tr>
                    </div>
              </div>
              
		 <script type="text/javascript">
            <!--
            var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
            //-->
            </script>
            
            </div>
            
           <div class="clear"></div>
           <!--end of tab panels-->
          </div> 						
                              
                               
        
        
        
        
        
        </div>


<!----------listing end content-------------->
</div>
<div class="clear"></div>



 </div>
	 </div>
     
     
     


     </div>
     
<?php $this->load->view('site/templates/new_footer'); ?>


<div id="ShowPopupContentOrg" style="display:none" >
	<div class="account_popup">
            
          
                <a href="javascript:void(0);" class="click_close" onclick="showPopUpOrg();">Close</a>
                
                <div class="popup_title">Consent to Use of Electronic Records and Signatures</div>
                
                <div class="popup_inner_content">
                	<p>Laws require that certain information must be provided to you in writing. In order to provide you with that information in electronic form, your consent must be obtained and certain consumer disclosures must be given to you. Click <a href="javascript:void(0);" onclick="showPopUp();" >here</a> to read and accept these consumer disclosures regarding use of electronic records and signatures (the "E-Sign Legal Consent Notice").</p>
                    
                    <p>Additionally, to use the electronic signature service you must agree to be bound by the terms and conditions of use. Click <a href="javascript:void(0);" onclick="showPopUp();" >here</a> to read and accept the terms and conditions.</p>
                    
                    <p>By selecting the "Accept" button below, you are consenting to the use of electronic records and signatures for this signature transaction using the electronic signature service under the terms and conditions of the E-Sign Legal Consent Notice. You are also confirming that you are able to access the electronic signature service and all of the documents provided to you in electronic form and you agree to be bound by the terms and conditions of use for the electronic signature service.</p>
                
                
                </div>
                
                
                
                <ul class="popup_list">
                
                
                	<li><input name="radio_button" id="demo_box_18" class="" type="radio" value="Yes" /><label for="demo_box_18" name="demo_lbl_18" class="css-label">Accept</label></li>
                    
                    <li><input name="radio_button" id="demo_box_18" class="" type="radio" value="No" /><label for="demo_box_23" name="demo_lbl_23" class="css-label">Decline</label></li>
                
                
                </ul>
                
                <div class="next_btn_main">
                <input type="hidden" name="customUrl" id="customUrl" />
                    <input type="button" value="Next" class="next_btn" onclick="validateFn();"/></div>
                
               
               
              
                
            </div>
</div>
                
                
                
                

<div id="ShowPopupContent" style="display:none" >
			<div class="click_popup" style="background:#FFF; z-index:9999;" >
            
            	<a href="javascript:void(0);" class="click_close1" onclick="showPopUp();">Close</a>
                
                <div class="popup_title">E-Sign Legal Consent Notice </div>
                
                <div class="popup_inner_content">
                
                <p>Laws require that certain information must be provided to consumers in writing.</p>
                
                <p>In order to provide you with that information in electronic form, your consent must be obtained and the consumer disclosures in this notice must be given to you. This may be the only time you will be able to access this notice, so you should print or save this notice and keep a copy for your records. If you have any questions about receiving documents in electronic form, please contact your agent or an attorney directly or contact us via web support at <a href="<?php echo base_url(); ?>contact" target="_blank">http://beta.gainturnkeyproperty.com/ contact</a>. Additionally, to use Gain Turnkey Property E-Sign (the "Service") you must agree to be bound by the terms and conditions of use.</p>
                
                <p>By clicking the "Accept" button, you agree to receive documents in electronic form, use electronic signatures in this signature transaction and to abide by this E-Sign Legal Consent Notice. Your consent applies to documents provided to you in connection with this signature transaction. After all parties involved in the delivery and signing process have performed their actions, you will be notified by email and will have an opportunity to download fully-executed archive copies of the documents for your records. You may not have another opportunity to access the Service to print or save archived copies of the documents, so you should print or save them at that time. You may also obtain copies of any document you have signed or received using the Service at any time from your agent.</p>
                
                <p>You have the right to decline to provide consent to receive documents in electronic form. You also have the right to withdraw your consent to receipt of electronic records for this signature transaction at any time before you click on the "Commit Signatures" button. To withdraw consent, notify your agent of your withdrawal and do not click on the "Commit Signatures" button. Once you click the "Commit Signatures" button, you will not have an opportunity to withdraw consent with respect to the documents you have signed and received. If other documents are sent to you using the Service in the future, you will have the right to decline to provide consent to receive those documents electronically at that time. If you do not consent to electronic delivery or withdraw your consent prior to clicking on the "Commit Signatures" button, you have the option of receiving the documents in paper form. Contact your agent if you wish to receive the documents in paper form. </p>
                
                <p>For Wisconsin users: by consenting you also agree to the use of electronic documents, e-mail delivery and electronic signatures in the transaction.</p>
                
                <p>There are certain hardware and software requirements for you to be able to access or retain the electronic documents using the Service. The computer requirements are as follows: </p>
                
                <ul>
                <li>Windows PC: 
                	<ul>
                    <li>Microsoft Windows 2000, Windows XP, Windows Vista, Windows 7 </li>
                    <li>Java 6 update 11 or higher </li>
                    <li>1 Ghz CPU or higher </li>
                    <li>1 GB of RAM or higher </li>
                    <li>1024x768 screen resolution or higher </li>
                    <li>Internet Explorer or Mozilla Firefox 3 (Internet Explorer 9 and Firefox 4 are currently not supported) </li>
                    <li>Adobe Acrobat or Adobe Reader 9, for viewing and printing electronic documents. </li>
                    <li>High Speed Internet connection </li>
                    </ul>
                 </li>
                 
                 <li>Macintosh: 
                 	<ul>
                    <li>Mac OS X (10.5 Leopard or higher) </li>
                    <li>Java 1.5 or higher </li>
                    <li>???ghz.cpu??? </li>
                    <li>1 GB of RAM or higher </li>
                    <li>1024x768 screen resolution or higher </li>
                    <li>Safari or Mozilla Firefox 3 (Firefox 4 is currently not supported) </li>
                    <li>Adobe Acrobat or Adobe Reader 9, for viewing and printing electronic documents. </li>
                    <li>High Speed Internet connection </li>
                    </ul>
                 </li>
                 
                 <li>General Requirements: 
                 	<ul>
                    <li>Cookies, JavaScript and browser display must be enabled. To check whether you already have this required software and that it is configured appropriately, click <a href="https://www.signix.net/imm/PDFViewerCompatibilityTest.pdf?s38vh9=UjJQ5N3lBDC361AxDpxhA6" target="_blank">here</a>. For a free copy of Adobe Reader, go to <a href="http://www.adobe.com/products/acrobat/readstep2.html" target="_blank">www.adobe.com</a>. </li>
                    <li>Sufficient computer memory to store electronic records on your computer or external storage medium. </li>
                    <li>E-mail capability. </li>
                    <li>A printer (if you want to print copies of electronic records) </li>
                    </ul>
                </li>
                </ul>
                
                <p>By clicking the "Accept" button, you confirm that you will be able to access and retain the electronic records subject to this consent using a device that contains the hardware and software set forth above. If we change the minimum hardware or software requirements needed to access or retain records, and the change creates a material risk that you will not be able to access or retain a subsequent record that is subject to this consent, we will notify you of the new requirements via email before the change takes effect and you will have the right to withdraw your consent to receipt of electronic records at that time.</p>
                
                <p>If you need to change the email address or any other contact information you have on file with us, please contact your agent.</p>
                
                <p>By clicking the "Accept" button, you agree to the use of electronic signatures and receipt of electronic records using the Service under the terms of this consent.</p>

                
                
                </div>
                
         
</div>
</div>
