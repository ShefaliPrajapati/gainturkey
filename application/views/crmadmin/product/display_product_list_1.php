<?php
$this->load->view('crmadmin/templates/header.php');
extract($crm_privileges);
?>
<script src="js/jquery.colorbox.js"></script>
<script>
$(document).ready(function(){

		$(".cboxClose1").click(function(){
			$("#cboxOverlay,#colorbox").hide();
			});
		
			$(".general_popup").colorbox({width:"650px", height:"600px", inline:true, href:"#inline_general"});
			$(".loi_popup").colorbox({width:"650px", height:"600px", inline:true, href:"#inline_loi"});
			$(".ein_popup").colorbox({width:"650px", height:"600px", inline:true, href:"#inline_ein"});
			$(".pa_popup").colorbox({width:"650px", height:"600px", inline:true, href:"#inline_pa"});
			$(".llc_popup").colorbox({width:"650px", height:"600px", inline:true, href:"#inline_llc"});
			$(".loan_popup").colorbox({width:"650px", height:"600px", inline:true, href:"#inline_loan"});
			$(".fedex_popup").colorbox({width:"650px", height:"600px", inline:true, href:"#inline_fedex"});
			$(".doi_popup").colorbox({width:"650px", height:"600px", inline:true, href:"#inline_doi"});
			$(".insurance_popup").colorbox({width:"650px", height:"600px", inline:true, href:"#inline_insurance"});
			$(".fund_popup").colorbox({width:"650px", height:"600px", inline:true, href:"#inline_fund"});
			$(".closed_popup").colorbox({width:"650px", height:"600px", inline:true, href:"#inline_closed"});
			$(".pmhand_popup").colorbox({width:"650px", height:"600px", inline:true, href:"#inline_pmhand"});
			$(".master_popup").colorbox({width:"650px", height:"600px", inline:true, href:"#inline_master"});
			$(".invoice_popup").colorbox({width:"650px", height:"600px", inline:true, href:"#inline_invoice"});
			
		
		//Example of preserving a JavaScript event for inline calls.
			$("#onLoad").click(function(){ 
				$('#onLoad').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
				return false;
			});

});
</script>
<div style='display:none'>

  <div id='inline_general' style='background:#fff;'>
  
  		<div class="popup_page">  
  			<div class="popup_header">General - Property Address</div>   
            <span class="popup_sub_txt">Choose Files to Upload</span>
            <div class="popup_top_right">
            	<input type="file" />
                <span class="popup_note">Note : To Upload multiple image, hold 'Control' button while choosing images</span>
            </div>
            </div>
				<table class="popup_table" align="center" border="0" bordercolor="#333" cellpadding="1" cellspacing="1" width="50%" style="float:left;">
                	<tr>
                    	<td class="tab_title">Buyer 1 First Name</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt">John</td>
                    </tr>
                    <tr>
                    	<td class="tab_title">Buyer 1 Last Name</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt">Dixon</td>
                    </tr>
                    <tr>
                    	<td class="tab_title">Buyer 2 First Name</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt">Henry</td>
                    </tr>
                    <tr>
                    	<td class="tab_title">Buyer 2 Last Name</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt">Ford</td>
                    </tr>
                    <tr>
                    	<td class="tab_title">Buyer Entity Name</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt">Til</td>
                    </tr>
                    <tr>
                    	<td class="tab_title">Buyer Entity Type</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt">Full pay</td>
                    </tr>
                    <tr>
                    	<td class="tab_title">Buyer Address</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt">674, 2nd avenue</td>
                    </tr>
                    <tr>
                    	<td class="tab_title">Buyer City</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt">Brookyln</td>
                    </tr>
                    <tr>
                    	<td class="tab_title">Buyer State</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt">New York</td>
                    </tr>
                    <tr>
                    	<td class="tab_title">Buyer Zip Code</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt">83688</td>
                    </tr>
                    <tr>
                    	<td class="tab_title">Buyer Phone 1</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt">9874556754</td>
                    </tr>
                    <tr>
                    	<td class="tab_title">Buyer Phone 2</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt">34568998</td>
                    </tr>
                    <tr>
                    	<td class="tab_title">Buyer Email 1</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt">john@hotmail.com</td>
                    </tr>
                    <tr>
                    	<td class="tab_title">Buyer Email 2</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt">Henry@yhamil.com</td>
                    </tr>
                    <tr>
                    	<td class="tab_title">Buyer Purchase Price</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt">956567</td>
                    </tr>
                    <tr>
                    	<td class="tab_title">Sale Date</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt">24-06-2013</td>
                    </tr>
                </table>
             <div class="popup_field" style="margin:40px 0 0 10px; width:95%">
                	<span>NOTES</span>
                    <input type="text" value="" class="popup_txt" style="width:250px;" />
                    <input type="submit" value="Submit" class="popup_btn" />
                </div>           
                <div class="popup_bottom">
                	<div class="popup_bottom_left">
                    	<div class="popup_txt_1" style="margin:0 0 0 10px; height:120px; width:95%;">
                        	<span><p style="color:#F00; float:left">7/13/2014, 11:33am -</p> Customer confirmed they want to work with us cause we are </span>
                            <span><p style="color:#F00; float:left">7/13/2014, 11:33am -</p> Customer confirmed they want to work with us cause we are </span>
                        </div>
                    </div>
                    
                  
        </div>
        
  </div>
  
</div>
<div style='display:none'>

  <div id='inline_loi' style='background:#fff;'>
  
  		<div class="popup_page">  
  			<div class="popup_header">LOI - Property Address</div>   
            <span class="popup_sub_txt">Choose Files to Upload</span>
            <div class="popup_top_right">
            	<input type="file" />
                <span class="popup_note">Note : To Upload multiple image, hold 'Control' button while choosing images</span>
            </div>
            <div class="popup_middle">
            	<span>"Must Have" Information</span>
                <div class="popup_field">
                	<label>Entity Name</label>
                    <input type="text" value="" class="popup_txt" />
                </div>
                <div class="popup_field" style="margin:40px 0 0 10px; width:95%">
                	<span>NOTES</span>
                    <input type="text" value="" class="popup_txt" style="width:250px;" />
                    <input type="submit" value="Submit" class="popup_btn" />
                </div>           
                <div class="popup_bottom">
                	<div class="popup_bottom_left">
                    	<div class="popup_txt_1" style="margin:0 0 0 10px; height:120px; width:95%;">
                        	<span><p style="color:#F00; float:left">7/13/2014, 11:33am -</p> Customer confirmed they want to work with us cause we are </span>
                            <span><p style="color:#F00; float:left">7/13/2014, 11:33am -</p> Customer confirmed they want to work with us cause we are </span>
                        </div>
                    </div>
                    <div class="popup_bottom_right">
                    	<span style="text-align:center;">STATUS</span>
                        <select style="margin:0 0 20px 36px; padding:4px; width:130px; text-align:center" class="popup_txt">
                        	<option>NEW</option>
                            <option>PENDING</option>
                            <option>COMPLETED</option>
                        </select><br />
                         <input type="submit" value="Save & Close" class="popup_btn" style="margin:0 0 0 43px" />
                    </div>
                </div>     
            </div>
        </div>
        
  </div>
  
</div>
<div style='display:none'>

  <div id='inline_ein' style='background:#fff;'>
  
  		<div class="popup_page">  
  			<div class="popup_header">Articles / EIN - Property Address</div>   
            <span class="popup_sub_txt">Choose Files to Upload</span>
            <div class="popup_top_right">
            	<input type="file" />
                <span class="popup_note">Note : To Upload multiple image, hold 'Control' button while choosing images</span>
            </div>
            <div class="popup_middle">
            	<div style="float:left; width:100%; min-height:100px"></div>
                <div class="popup_field" style="margin:40px 0 0 10px; width:95%">
                	<span>NOTES</span>
                    <input type="text" value="" class="popup_txt" style="width:250px;" />
                    <input type="submit" value="Submit" class="popup_btn" />
                </div>           
                <div class="popup_bottom">
                	<div class="popup_bottom_left">
                    	<div class="popup_txt_1" style="margin:0 0 0 10px; height:120px; width:95%;">
                        	<span><p style="color:#F00; float:left">7/13/2014, 11:33am -</p> Customer confirmed they want to work with us cause we are </span>
                            <span><p style="color:#F00; float:left">7/13/2014, 11:33am -</p> Customer confirmed they want to work with us cause we are </span>
                        </div>
                    </div>
                    <div class="popup_bottom_right">
                    	<span style="text-align:center;">STATUS</span>
                        <select style="margin:0 0 20px 36px; padding:4px; width:130px; text-align:center" class="popup_txt">
                        	<option>NEW</option>
                            <option>PENDING</option>
                            <option>COMPLETED</option>
                        </select><br />
                         <input type="submit" value="Save & Close" class="popup_btn" style="margin:0 0 0 43px" />
                    </div>
                </div>     
            </div>
        </div>
        
  </div>
  
</div>
<div style='display:none'>

  <div id='inline_pa' style='background:#fff;'>
  
  		<div class="popup_page">  
  			<div class="popup_header">Purchase Agreement - Property Address</div>   
            <span class="popup_sub_txt">Choose Files to Upload</span>
            <div class="popup_top_right">
            	<input type="file" />
                <span class="popup_note">Note : To Upload multiple image, hold 'Control' button while choosing images</span>
            </div>
            <div class="popup_middle">
            	<div style="float:left; width:100%; min-height:100px"></div>
                <div class="popup_field" style="margin:40px 0 0 10px; width:95%">
                	<span>NOTES</span>
                    <input type="text" value="" class="popup_txt" style="width:250px;" />
                    <input type="submit" value="Submit" class="popup_btn" />
                </div>           
                <div class="popup_bottom">
                	<div class="popup_bottom_left">
                    	<div class="popup_txt_1" style="margin:0 0 0 10px; height:120px; width:95%;">
                        	<span><p style="color:#F00; float:left">7/13/2014, 11:33am -</p> Customer confirmed they want to work with us cause we are </span>
                            <span><p style="color:#F00; float:left">7/13/2014, 11:33am -</p> Customer confirmed they want to work with us cause we are </span>
                        </div>
                    </div>
                    <div class="popup_bottom_right">
                    	<span style="text-align:center;">STATUS</span>
                        <select style="margin:0 0 20px 36px; padding:4px; width:130px; text-align:center" class="popup_txt">
                        	<option>NEW</option>
                            <option>PENDING</option>
                            <option>COMPLETED</option>
                        </select><br />
                         <input type="submit" value="Save & Close" class="popup_btn" style="margin:0 0 0 43px" />
                    </div>
                </div>     
            </div>
        </div>
        
  </div>
  
</div>
<div style='display:none'>

  <div id='inline_llc' style='background:#fff;'>
  
  		<div class="popup_page">  
  			<div class="popup_header">LLC Account - Property Address</div>   
            <div class="popup_middle">
            	<span style="text-align:center">Make sure that the customer is setting up an LLC Bank Account</span>
            	<div style="float:left; width:100%; min-height:100px"></div>
                <div class="popup_field" style="margin:40px 0 0 10px; width:95%">
                	<span>NOTES</span>
                    <input type="text" value="" class="popup_txt" style="width:250px;" />
                    <input type="submit" value="Submit" class="popup_btn" />
                </div>           
                <div class="popup_bottom">
                	<div class="popup_bottom_left">
                    	<div class="popup_txt_1" style="margin:0 0 0 10px; height:120px; width:95%;">
                        	<span><p style="color:#F00; float:left">7/13/2014, 11:33am -</p> Customer confirmed they want to work with us cause we are </span>
                            <span><p style="color:#F00; float:left">7/13/2014, 11:33am -</p> Customer confirmed they want to work with us cause we are </span>
                        </div>
                    </div>
                    <div class="popup_bottom_right">
                         <input type="submit" value="Save & Close" class="popup_btn" style="margin:90px 0 0 43px" />
                    </div>
                </div>     
            </div>
        </div>
        
  </div>
  
</div>
<div style='display:none'>

  <div id='inline_loan' style='background:#fff;'>
  
  		<div class="popup_page">  
  			<div class="popup_header">Loan Docs - Property Address</div>   
            <span class="popup_sub_txt">Choose Files to Upload</span>
            <div class="popup_top_right">
            	<input type="file" />
                <span class="popup_note">Note : To Upload multiple image, hold 'Control' button while choosing images</span>
            </div>
            <div class="popup_middle">
            	<span style="font-size:14px; font-weight:bold">* Be sure these docs are Signed and Notorized by Custodian</span>
                <div class="popup_field" style="margin:40px 0 0 10px; width:95%">
                	<span>NOTES</span>
                    <input type="text" value="" class="popup_txt" style="width:250px;" />
                    <input type="submit" value="Submit" class="popup_btn" />
                </div>           
                <div class="popup_bottom">
                	<div class="popup_bottom_left">
                    	<div class="popup_txt_1" style="margin:0 0 0 10px; height:120px; width:95%;">
                        	<span><p style="color:#F00; float:left">7/13/2014, 11:33am -</p> Customer confirmed they want to work with us cause we are </span>
                            <span><p style="color:#F00; float:left">7/13/2014, 11:33am -</p> Customer confirmed they want to work with us cause we are </span>
                        </div>
                    </div>
                    <div class="popup_bottom_right">
                    	<span style="text-align:center;">STATUS</span>
                        <select style="margin:0 0 20px 36px; padding:4px; width:130px; text-align:center" class="popup_txt">
                        	<option>NEW</option>
                            <option>PENDING</option>
                            <option>COMPLETED</option>
                        </select><br />
                         <input type="submit" value="Save & Close" class="popup_btn" style="margin:0 0 0 43px" />
                    </div>
                </div>     
            </div>
        </div>
        
  </div>
  
</div>
<div style='display:none'>

  <div id='inline_fedex' style='background:#fff;'>
  
  		<div class="popup_page">  
  			<div class="popup_header">Fedex Labels - Property Address</div>   
            <span class="popup_sub_txt">Choose Files to Upload</span>
            <div class="popup_top_right">
            	<input type="file" />
                <span class="popup_note">Note : To Upload multiple image, hold 'Control' button while choosing images</span>
            </div>
            <div class="popup_middle">
            	<span style="font-size:14px; font-weight:bold">* Upload customer to Closing Attorney Fedex Label, if Available</span>
                <span style="font-size:14px; font-weight:bold">* Upload Attorney to RE cash Fedex Label, if Available</span>
                <div class="popup_field" style="margin:40px 0 0 10px; width:95%">
                	<span>NOTES</span>
                    <input type="text" value="" class="popup_txt" style="width:250px;" />
                    <input type="submit" value="Submit" class="popup_btn" />
                </div>           
                <div class="popup_bottom">
                	<div class="popup_bottom_left">
                    	<div class="popup_txt_1" style="margin:0 0 0 10px; height:120px; width:95%;">
                        	<span><p style="color:#F00; float:left">7/13/2014, 11:33am -</p> Customer confirmed they want to work with us cause we are </span>
                            <span><p style="color:#F00; float:left">7/13/2014, 11:33am -</p> Customer confirmed they want to work with us cause we are </span>
                        </div>
                    </div>
                    <div class="popup_bottom_right">
                    	<span style="text-align:center;">STATUS</span>
                        <select style="margin:0 0 20px 36px; padding:4px; width:130px; text-align:center" class="popup_txt">
                        	<option>NEW</option>
                            <option>PENDING</option>
                            <option>COMPLETED</option>
                        </select><br />
                         <input type="submit" value="Save & Close" class="popup_btn" style="margin:0 0 0 43px" />
                    </div>
                </div>     
            </div>
        </div>
        
  </div>
  
</div>
<div style='display:none'>

  <div id='inline_doi' style='background:#fff;'>
  
  		<div class="popup_page">  
  			<div class="popup_header">DOI - Property Address</div>   
            <span class="popup_sub_txt">Choose Files to Upload</span>
            <div class="popup_top_right">
            	<input type="file" />
                <span class="popup_note">Note : To Upload multiple image, hold 'Control' button while choosing images</span>
            </div>
            <div class="popup_middle">
            	<span style="font-size:14px; font-weight:bold">* Upload DOI with Signature</span>
                <div class="popup_field" style="margin:40px 0 0 10px; width:95%">
                	<span>NOTES</span>
                    <input type="text" value="" class="popup_txt" style="width:250px;" />
                    <input type="submit" value="Submit" class="popup_btn" />
                </div>           
                <div class="popup_bottom">
                	<div class="popup_bottom_left">
                    	<div class="popup_txt_1" style="margin:0 0 0 10px; height:120px; width:95%;">
                        	<span><p style="color:#F00; float:left">7/13/2014, 11:33am -</p> Customer confirmed they want to work with us cause we are </span>
                            <span><p style="color:#F00; float:left">7/13/2014, 11:33am -</p> Customer confirmed they want to work with us cause we are </span>
                        </div>
                    </div>
                    <div class="popup_bottom_right">
                    	<span style="text-align:center;">STATUS</span>
                        <select style="margin:0 0 20px 36px; padding:4px; width:130px; text-align:center" class="popup_txt">
                        	<option>NEW</option>
                            <option>PENDING</option>
                            <option>COMPLETED</option>
                        </select><br />
                         <input type="submit" value="Save & Close" class="popup_btn" style="margin:0 0 0 43px" />
                    </div>
                </div>     
            </div>
        </div>
        
  </div>
  
</div>
<div style='display:none'>

  <div id='inline_insurance' style='background:#fff;'>
  
  		<div class="popup_page">  
  			<div class="popup_header">Insurance - Property Address</div>               
            <div class="popup_middle">
            	<span style="font-size:18px; font-weight:bold; margin:50px 0 20px 60px; width:auto">Insuance Proposal Request</span>
                 <div class="popup_field" style="margin:0 0 15px;">
                	<label>Provider</label>
                    <input type="text" value="" class="popup_txt" />
                </div>
                 <div class="popup_field">
                	<label>Date Submitted</label>
                    <select class="popup_txt" style="padding:4px; width:80px;">
                    	<option>Month</option>
                    </select>
                    <select class="popup_txt" style="padding:4px; width:60px;">
                    	<option>Day</option>
                    </select>
                    <select class="popup_txt" style="padding:4px; width:90px;">
                    	<option>Year</option>
                    </select>
                </div>
                <div class="popup_field" style="margin:40px 0 0 10px; width:95%">
                	<span>NOTES</span>
                    <input type="text" value="" class="popup_txt" style="width:250px;" />
                    <input type="submit" value="Submit" class="popup_btn" />
                </div>           
                <div class="popup_bottom">
                	<div class="popup_bottom_left">
                    	<div class="popup_txt_1" style="margin:0 0 0 10px; height:120px; width:95%;">
                        	<span><p style="color:#F00; float:left">7/13/2014, 11:33am -</p> Customer confirmed they want to work with us cause we are </span>
                            <span><p style="color:#F00; float:left">7/13/2014, 11:33am -</p> Customer confirmed they want to work with us cause we are </span>
                        </div>
                    </div>
                    <div class="popup_bottom_right">
                    	<span style="text-align:center;">STATUS</span>
                        <select style="margin:0 0 20px 36px; padding:4px; width:130px; text-align:center" class="popup_txt">
                        	<option>NEW</option>
                            <option>PENDING</option>
                            <option>COMPLETED</option>
                        </select><br />
                         <input type="submit" value="Save & Close" class="popup_btn" style="margin:0 0 0 43px" />
                    </div>
                </div>     
            </div>
        </div>
        
  </div>
  
</div>
<div style='display:none'>

  <div id='inline_fund' style='background:#fff;'>
  
  		<div class="popup_page">  
  			<div class="popup_header">Funding - Property Address</div>               
            <div class="popup_middle">
            	<span style="font-size:18px; font-weight:bold; margin:30px 0 20px 60px; width:auto">Client Cash Funds</span>
                 <div class="popup_field" style="margin:0 0 15px;">
                	<label>Amount Expected $</label>
                    <input type="text" value="" class="popup_txt" />
                </div>
                 <div class="popup_field" style="margin:0 0 15px;">
                	<label>Amount Received $</label>
                    <input type="text" value="" class="popup_txt" />
                </div>
                 <div class="popup_field">
                	<label>Date Received</label>
                    <select class="popup_txt" style="padding:4px; width:80px;">
                    	<option>Month</option>
                    </select>
                    <select class="popup_txt" style="padding:4px; width:60px;">
                    	<option>Day</option>
                    </select>
                    <select class="popup_txt" style="padding:4px; width:90px;">
                    	<option>Year</option>
                    </select>
                </div>
                <div class="popup_field" style="margin:40px 0 0 10px; width:95%">
                	<span>NOTES</span>
                    <input type="text" value="" class="popup_txt" style="width:250px;" />
                    <input type="submit" value="Submit" class="popup_btn" />
                </div>           
                <div class="popup_bottom">
                	<div class="popup_bottom_left">
                    	<div class="popup_txt_1" style="margin:0 0 0 10px; height:120px; width:95%;">
                        	<span><p style="color:#F00; float:left">7/13/2014, 11:33am -</p> Customer confirmed they want to work with us cause we are </span>
                            <span><p style="color:#F00; float:left">7/13/2014, 11:33am -</p> Customer confirmed they want to work with us cause we are </span>
                        </div>
                    </div>
                    <div class="popup_bottom_right">
                    	<span style="text-align:center;">STATUS</span>
                        <select style="margin:0 0 20px 36px; padding:4px; width:130px; text-align:center" class="popup_txt">
                        	<option>NEW</option>
                            <option>PENDING</option>
                            <option>COMPLETED</option>
                        </select><br />
                         <input type="submit" value="Save & Close" class="popup_btn" style="margin:0 0 0 43px" />
                    </div>
                </div>     
            </div>
        </div>
        
  </div>
  
</div>
<div style='display:none'>

  <div id='inline_closed' style='background:#fff;'>
  
  		<div class="popup_page">  
  			<div class="popup_header">Closed - Property Address</div>               
            <div class="popup_middle">
            	<span style="font-size:18px; font-weight:bold; margin:30px 0 20px 60px; width:auto">Closing Information</span>
                 <div class="popup_field" style="margin:0 0 15px;">
                 	<input type="checkbox" value=""  style="float:left; margin:9px 0 0 10px"/>
                	<label style="width:25%">Documenst to Buyer</label>                    
                </div>
                 <div class="popup_field" style="margin:0 0 15px;">
                 	<input type="checkbox" value=""   style="float:left; margin:9px 0 0 10px" />
                	<label>Documenst to Seller</label>
                </div>
                 <div class="popup_field">
                	<label>Close Date</label>
                    <select class="popup_txt" style="padding:4px; width:80px;">
                    	<option>Month</option>
                    </select>
                    <select class="popup_txt" style="padding:4px; width:60px;">
                    	<option>Day</option>
                    </select>
                    <select class="popup_txt" style="padding:4px; width:90px;">
                    	<option>Year</option>
                    </select>
                </div>
                <div class="popup_field" style="margin:40px 0 0 10px; width:95%">
                	<span>NOTES</span>
                    <input type="text" value="" class="popup_txt" style="width:250px;" />
                    <input type="submit" value="Submit" class="popup_btn" />
                </div>           
                <div class="popup_bottom">
                	<div class="popup_bottom_left">
                    	<div class="popup_txt_1" style="margin:0 0 0 10px; height:120px; width:95%;">
                        	<span><p style="color:#F00; float:left">7/13/2014, 11:33am -</p> Customer confirmed they want to work with us cause we are </span>
                            <span><p style="color:#F00; float:left">7/13/2014, 11:33am -</p> Customer confirmed they want to work with us cause we are </span>
                        </div>
                    </div>
                    <div class="popup_bottom_right">
                    	<span style="text-align:center;">STATUS</span>
                        <select style="margin:0 0 20px 36px; padding:4px; width:130px; text-align:center" class="popup_txt">
                        	<option>NEW</option>
                            <option>PENDING</option>
                            <option>COMPLETED</option>
                        </select><br />
                         <input type="submit" value="Save & Close" class="popup_btn" style="margin:0 0 0 43px" />
                    </div>
                </div>     
            </div>
        </div>
        
  </div>
  
</div>
<div style='display:none'>

  <div id='inline_pmhand' style='background:#fff;'>
  
  		<div class="popup_page">  
  			<div class="popup_header">Property Management Hand Off - Property Address</div>               
            <div class="popup_middle">
            	<span style="font-size:18px; font-weight:bold; margin:30px 0 20px 60px; width:auto">To Do List</span>
                 <div class="popup_field" style="margin:0 0 15px;">
                 	<input type="checkbox" value=""  style="float:left; margin:9px 0 0 10px"/>
                	<label style="width:35%">Congratulations Email to Buyer</label>                    
                </div>
                 <div class="popup_field" style="margin:0 0 15px;">
                 	<input type="checkbox" value=""   style="float:left; margin:9px 0 0 10px" />
                	<label style="width:35%">PM Intro Email to Buyer & PM</label>
                </div>
                 
                <div class="popup_field" style="margin:40px 0 0 10px; width:95%">
                	<span>NOTES</span>
                    <input type="text" value="" class="popup_txt" style="width:250px;" />
                    <input type="submit" value="Submit" class="popup_btn" />
                </div>           
                <div class="popup_bottom">
                	<div class="popup_bottom_left">
                    	<div class="popup_txt_1" style="margin:0 0 0 10px; height:120px; width:95%;">
                        	<span><p style="color:#F00; float:left">7/13/2014, 11:33am -</p> Customer confirmed they want to work with us cause we are </span>
                            <span><p style="color:#F00; float:left">7/13/2014, 11:33am -</p> Customer confirmed they want to work with us cause we are </span>
                        </div>
                    </div>
                    <div class="popup_bottom_right">
                    	<span style="text-align:center;">STATUS</span>
                        <select style="margin:0 0 20px 36px; padding:4px; width:130px; text-align:center" class="popup_txt">
                        	<option>NEW</option>
                            <option>PENDING</option>
                            <option>COMPLETED</option>
                        </select><br />
                         <input type="submit" value="Save & Close" class="popup_btn" style="margin:0 0 0 43px" />
                    </div>
                </div>     
            </div>
        </div>
        
  </div>
  
</div>
<div style='display:none'>

  <div id='inline_master' style='background:#fff;'>
  
  		<div class="popup_page">  
  			<div class="popup_header">Master Notes - Property Address</div>               
            <div class="popup_middle">       
                <div class="popup_field" style="margin:40px 0 0 10px; width:95%">
                	<span>NOTES</span>
                    <input type="text" value="" class="popup_txt" style="width:290px;" />
                    <input type="submit" value="Submit" class="popup_btn" />
                </div>           
                <div class="popup_bottom">
                	<div class="popup_bottom_left">
                    	<div class="popup_txt_1" style="margin:0 0 0 10px; height:250px; width:95%;">
                        	<span><p style="color:#F00; float:left">7/13/2014, 11:33am -</p> Customer confirmed they want to work with us cause we are </span>
                            <span><p style="color:#F00; float:left">7/13/2014, 11:33am -</p> Customer confirmed they want to work with us cause we are </span>
                        </div>
                    </div>
                    <div class="popup_bottom_right">
                         <input type="submit" value="Save & Close" class="popup_btn" style="margin:218px 0 0 43px" />
                    </div>
                </div>     
            </div>
        </div>
        
  </div>
  
</div>
<div style='display:none'>

  <div id='inline_invoice' style='background:#fff;'>
  
  		<div class="popup_page">  
  			<div class="popup_header">Invoice - Property Address</div>               
            <div class="popup_middle">       
            	<span style="font-size:18px; font-weight:bold; margin:0px 0 20px 60px; width:auto">Invoice Checklist</span>
                <span style="font-size: 16px; margin: 0 0 15px 60px; line-height:24px; width: 80%;">1. Everything has been complete with this deal</span>
                <span style="font-size: 16px; margin: 0 0 15px 60px; width: 80%; line-height:24px;">2. We are ready to send invoices to involved parties</span>
                <span style="font-size: 16px; margin: 0 0 0px 60px; width: 80%; line-height:24px;">3. If all other tabs are Green, be sure to change Status to Complete and push Save & Close. This deal 
                will then move to the SOLD tab in the left menu bar.</span>
                <div class="popup_field" style="margin:40px 0 0 10px; width:95%">
                	<span>NOTES</span>
                    <input type="text" value="" class="popup_txt" style="width:290px;" />
                    <input type="submit" value="Submit" class="popup_btn" />
                </div>           
                <div class="popup_bottom">
                	<div class="popup_bottom_left">
                    	<div class="popup_txt_1" style="margin:0 0 0 10px; height:120px; width:95%;">
                        	<span><p style="color:#F00; float:left">7/13/2014, 11:33am -</p> Customer confirmed they want to work with us cause we are </span>
                            <span><p style="color:#F00; float:left">7/13/2014, 11:33am -</p> Customer confirmed they want to work with us cause we are </span>
                        </div>
                    </div>
                    <div class="popup_bottom_right">
                    	<span style="text-align:center;">STATUS</span>
                        <select style="margin:0 0 20px 36px; padding:4px; width:130px; text-align:center" class="popup_txt">
                        	<option>NEW</option>
                            <option>PENDING</option>
                            <option>COMPLETED</option>
                        </select><br />
                         <input type="submit" value="Save & Close" class="popup_btn" style="margin:0px 0 0 43px" />
                    </div>
                </div>     
            </div>
        </div>
        
  </div>
  
</div>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('crmadmin/product/change_product_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php if ($allPrev == '1' || in_array('2', $rental)){?>
							<!--<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Publish','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to publish records"><span class="icon accept_co"></span><span class="btn_link">Publish</span></a>
							</div>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('UnPublish','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to unpublish records"><span class="icon delete_co"></span><span class="btn_link">UnPublish</span></a>
							</div>-->
						<?php 
						}
						if ($allPrevCrm == '1' || in_array('3', $rental)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }?>
						</div>
					</div>
                    
					<div class="widget_content">
                    	
						<table class="display display_tbl" id="subadmin_tbl">
						<thead>
                        <div class="click_doc">
                        	<span style="float:left; font-size:13px; font-weight:bold; color:#333333; margin:15px 0px 0 12px;">Click in Icon to View</span>
                            
                        </div>
                        
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
                            <th class="tip_top" title="Click to sort">
								Type
							</th>
                            <th class="tip_top" title="Click to sort">
								 Code
							</th>
							<th class="tip_top" title="Click to sort">
								 Property Address
							</th>
							<th class="tip_top" title="Click to sort">
								 Purchase Price
                            </th>
							<th>
								Sales Type
							</th>
							<th class="tip_top" title="Click to sort">
								Entity Name
							</th>
							
                            <th class="tip_top" title="Click to sort">
								Buyer Name
							</th>
							<th class="tip_top" title="Click to sort">
								Buyer Email Address
							</th>
                            <th class="tip_top" title="Click to sort">
								Buyer Phone
							</th>
							<th>
								 Sale Date
							</th>
							
 						</tr>
						</thead>
						<tbody>
						<?php 
						if ($productList->num_rows() > 0){
						//for ($x=0; $x<=100; $x++){
							foreach ($productList->result() as $row){
								
						?>
                         
						<tr>
                       
                      
							<td class="center tr_select ">
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
							</td>
							<td class="center">
								<?php echo $row->res_source;?>
							</td><td class="center">
								<?php echo $row->property_id;?>
							</td>
                            <td class="center">
								<?php echo $row->address.','.$row->cityname.','.$row->statename;?>
							</td>
							<td class="center">
						 		
                                <?php echo number_format($row->sales_price,0); ?>
							</td>
							<td class="center">
								<?php echo $row->sales_cash.' '.$row->sales_cf.' '.$row->sales_cs.' '.$row->sales_fs.' '.$row->sales_sl.' '.$row->sales_sdira;?>
							</td>
							<td class="center">
								<?php echo $row->entity_name;?>
							</td>
							
                            <td class="center">
							<?php echo $row->first_name;?>
							</td>
							<td class="center">
								<?php echo $row->email;?>
							</td>
                            <td class="center">
								<?php echo $row->phone_no; ?>
							</td>
							<td class="center">
							<?php echo date('m/d/Y',strtotime($row->dateAdded)); ?>
							</td>
                            
                             
						</tr>
                        
                         <tr><td colspan="11">
                        <ul class="doc_list">
                            	<li class="doc_grey"><a href="javascript:void(0);" class="general_popup">General</a></li>
                                <li class="doc_green"><a href="javascript:void(0);" class="loi_popup">LOI</a></li>
                                <li class="doc_green1"><a href="javascript:void(0);" class="ein_popup">Articles / EIN</a></li>
                                <li class="doc_yellow"><a href="javascript:void(0);" class="pa_popup">PA</a></li>
                                <li class="doc_yellow"><a href="javascript:void(0);" class="llc_popup">LLC</a></li>
                                <li class="doc_yellow"><a href="javascript:void(0);" class="loan_popup">Loan Docs</a></li>
                                <li class="doc_yellow"><a href="javascript:void(0);" class="fedex_popup">Fedex Labels</a></li>
                                <li class="doc_yellow"><a href="javascript:void(0);" class="doi_popup">DOI</a></li>
                                <li class="doc_red"><a href="javascript:void(0);" class="insurance_popup">Insurance</a></li>
                                <li class="doc_yellow"><a href="javascript:void(0);" class="fund_popup">Funded</a></li>
                                <li class="doc_red"><a href="javascript:void(0);" class="closed_popup">Closed</a></li>
                                <li class="doc_red"><a href="javascript:void(0);" class="pmhand_popup">PM Hand Off</a></li>
                                <li class="doc_red"><a href="javascript:void(0);" class="master_popup">Master Notes</a></li>
                                <li class="doc_red"><a href="javascript:void(0);" class="invoice_popup">Invoice</a></li>
                            </ul>
                        
                        
                        </td></tr>  
                      
						<?php 
							}
						}
						?>
                        
                       
						</tbody>
						<tfoot>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							<th>
								 Type
							</th>
                            <th>
								 Code
							</th>
                            <th>
								 Property Address
							</th>
							<th>
								 Purchase Price
							</th>
							<th>
								 Sales Type
							</th>
							<th>
								Entity Name
							</th>
							<th>
								Buyer Name
							</th>
							<th>
								Buyer Email Address
							</th>
                            <th >
								Buyer Phone
							</th>
							<th>
								Sale Date
							</th>
						</tr>
						</tfoot>
						</table>
					</div>
				</div>
			</div>
			<input type="hidden" name="statusMode" id="statusMode"/>
			<input type="hidden" name="SubAdminEmail" id="SubAdminEmail"/>
		</form>	
			
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('crmadmin/templates/footer.php');
?>