<script src="js/jquery.colorbox.js"></script>
<script>
$(document).ready(function(){

		$(".cboxClose1").click(function(){
			$("#cboxOverlay,#colorbox").hide();
			});
			
		$(".popup_dragndrop").colorbox({width:"1000px", height:"500px", href:baseURL+"crmadmin/product/popup_drag"});
			
		
		//Example of preserving a JavaScript event for inline calls.
			$("#onLoad").click(function(){ 
				$('#onLoad').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
				return false;
			});

});
</script>
<?php $details = $buyer_info->row();?>

<?php if($display == 'general')
{?>

<div id='inline_general' style='background:#fff;' class="pop_up_style">
  
  		<div class="popup_page">  
  			<div class="popup_header">General - <?php echo stripslashes($details->prop_address); ?></div>   
            <span class="popup_sub_txt">Choose Files to Upload</span>
            <div class="popup_top_right">
            	<div class="popup_dragndrop"><button class="popup_btn">Choose image</button></div>
                <span class="popup_note">Note : To Upload multiple image, hold 'Control' button while choosing images</span>
            </div>
            </div>
            
				<table class="popup_table" align="center" border="0" bordercolor="#333" cellpadding="1" cellspacing="1" width="50%" style="float:left;">
                	<tr>
                    	<td class="tab_title">Buyer 1 First Name</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><?php echo $details->first_name; ?></td>
                    </tr>
                    <tr>
                    	<td class="tab_title">Buyer 1 Last Name</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><?php echo $details->last_name; ?></td>
                    </tr>
                 <!--  <tr>
                    	<td class="tab_title">Buyer 2 First Name</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><?php echo $details->first_name; ?></td>
                    </tr>
                    <tr>
                    	<td class="tab_title">Buyer 2 Last Name</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><?php echo $details->last_name; ?></td>
                    </tr>-->
                    <tr>
                    	<td class="tab_title">Buyer Entity Name</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><?php echo $details->entity_name; ?></td>
                    </tr>
                    <tr>
                    	<td class="tab_title">Buyer Entity Type</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><?php echo $details->resrv_type; ?></td>
                    </tr>
                    <tr>
                    	<td class="tab_title">Buyer Address</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><?php echo $details->address; ?></td>
                    </tr>
                    <tr>
                    	<td class="tab_title">Buyer City</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><?php echo $details->city; ?></td>
                    </tr>
                    <tr>
                    	<td class="tab_title">Buyer State</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><?php echo $details->state; ?></td>
                    </tr>
                    <tr>
                    	<td class="tab_title">Buyer Zip Code</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><?php echo $details->postal_code; ?></td>
                    </tr>
                    <tr>
                    	<td class="tab_title">Buyer Phone 1</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><?php echo $details->phone_no; ?></td>
                    </tr>
                    <tr>
                    	<td class="tab_title">Buyer Phone 2</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><?php if($details ->phone_no1 != 0)echo $details->phone_no1; else echo ''; ?></td>
                    </tr>
                    <tr>
                    	<td class="tab_title">Buyer Email 1</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><?php echo $details->email; ?></td>
                    </tr>
                    <tr>
                    	<td class="tab_title">Buyer Email 2</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><?php echo $details->email1; ?></td>
                    </tr>
                    <tr>
                    	<td class="tab_title">Buyer Purchase Price</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><?php echo number_format($details->sales_price); ?></td>
                    </tr>
                    <tr>
                    	<td class="tab_title">Sale Date</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><?php echo date('Y-m-d', strtotime($details->dateAdded)); ?></td>
                    </tr>
                </table>
                 <div class="popup_field" style="width:95%; color:#FF0000; font-size:14px; margin-top:10px;" id="generalNote"></div>
             <div class="popup_field" style="margin:5px 0 0 10px; width:95%">
                	<span>NOTES</span>
                    <input type="text" id="notes1" class="popup_txt" style="width:250px;" />
                    <input type="hidden" id="reserd_id" value="<?php echo $details->id;?>" />
                    <input type="submit" value="Submit" onclick="submit_values('general')" class="popup_btn" />
                    </form>
                </div>           
                <div class="popup_bottom">
                	<div class="popup_bottom_left">
                    	<div class="popup_txt_1" style="margin:0 0 0 10px; height:120px; width:95%;" id="showGeneral">
                        <?php foreach($admin_notes->result() as $row){ ?>
                        	<span><p style="color:#F00; float:left"><?php if($row->general != ''){ echo $row->added.' -' ;?></p> <?php echo $row->general; }?> </span>
                           
                            <?php } ?>
                        </div>
                    </div>
                    
                  
        </div>
        
  </div>
  
  <?php } if ($display == 'loi'){?>
  
  <div id='inline_loi' style='background:#fff;' class="pop_up_style">
  
  		<div class="popup_page">  
  			<div class="popup_header">LOI - <?php echo stripslashes($details->prop_address);?></div>   
            <span class="popup_sub_txt">Choose Files to Upload</span>
            <div class="popup_top_right">
            	<div class="popup_dragndrop"><button class="popup_btn">Choose image</button></div>
                <span class="popup_note">Note : To Upload multiple image, hold 'Control' button while choosing images</span>
            </div>
            <div class="popup_middle">
            	<span>"Must Have" Information</span>
               <!-- <div class="popup_field">
                	<label>Entity Name</label> 
                    
                    <input type="text" name="entity_name1" id="entityNm1" class="popup_txt" value="<?php if($admin_status->row()->entity_name != '') echo $admin_status->row()->entity_name;?>" onblur="entity_name_pass()" />
                </div>-->
                
                
                
                <div class="popup_field">
                	<label>Custodian Name</label> 
                    
                    <input type="text" name="custodian_name" id="custodian_name" class="popup_txt" value="<?php if($admin_status->row()->custodian_name != '') echo $admin_status->row()->custodian_name;?>" />
                </div>
                <div class="popup_field">
                	<label>Account Type</label> 
                    
                    <input type="text" name="account_type" id="account_type" class="popup_txt" value="<?php if($admin_status->row()->account_type != '') echo $admin_status->row()->account_type;?>" />
                </div>
                <div class="popup_field">
                	<label>Account Number</label> 
                    
                    <input type="text" name="account_no" id="account_no" class="popup_txt" value="<?php if($admin_status->row()->account_no != '') echo $admin_status->row()->account_no;?>" />
                </div>
                
                
                
                <div class="popup_field" style="width:95%; color:#FF0000; font-size:14px; margin-top:10px;" id="generalNote1"></div>
                <div class="popup_field" style="margin:40px 0 0 10px; width:95%">
                	<span>NOTES</span>
                    <input type="text" id="notes2" class="popup_txt" style="width:250px;" />
                    <input type="hidden" id="reserd_id2" value="<?php echo $details->id;?>" />
                    <input type="submit" value="Submit" onclick="submit_values('loi')" class="popup_btn" />
                </div>           
                <div class="popup_bottom">
                	<div class="popup_bottom_left">
                    	<div class="popup_txt_1" style="margin:0 0 0 10px; height:120px; width:95%;" id="showGeneral1">
                        <?php foreach($admin_notes->result() as $row){ ?>
                        	<span><p style="color:#F00; float:left"><?php if($row->loi != '') { echo $row->added.' -' ;?></p> <?php echo $row->loi; }?> </span>
                           
                            <?php } ?>
                        </div>
                    </div>
                    <div class="popup_bottom_right">
                    	<span style="text-align:center;">STATUS</span>
                      
                        <select style="margin:0 0 20px 36px; padding:4px; width:130px; text-align:center" class="popup_txt" id="popup_status_loi">
                        	<option value="new" <?php if($admin_status->row()->loi_status == 'new') echo 'selected="selected"';?>>NEW</option>
                            <option value="processing" <?php if($admin_status->row()->loi_status == 'processing') echo 'selected="selected"';?>>PENDING</option>
                            <option value="complete" <?php if($admin_status->row()->loi_status == 'complete') echo 'selected="selected"';?>>COMPLETED</option>
                        </select>
                       
                        <input type="hidden" name="popup_id" id="popup_id_loi" value="<?php echo $admin_status->row()->id; ?>"/>
                       
                        <input type="hidden" value="<?php echo $details->id;?>" id="rsd_id_loi" />
                         
                         <input type="submit" value="Save & Close" onclick="loi_save()" class="popup_btn" style="margin:0 0 0 43px" />
                         
                    </div>
                </div>     
            </div>
        </div>
        
  </div>

 <?php } if ($display == 'articles'){?>
 
  <div id='inline_ein' style='background:#fff;' class="pop_up_style">
  
  		<div class="popup_page">  
  			<div class="popup_header">Articles / EIN - <?php echo stripslashes($details->prop_address);?></div>   
            <span class="popup_sub_txt">Choose Files to Upload</span>
            <div class="popup_top_right">
            	<input type="file" />
                <span class="popup_note">Note : To Upload multiple image, hold 'Control' button while choosing images</span>
            </div>
            <div class="popup_middle">
            	<div style="float:left; width:100%; min-height:100px"></div>
               
               <div class="popup_field" style="width:95%; color:#FF0000; font-size:14px; margin-top:10px;" id="generalNote2"></div>
                <div class="popup_field" style="margin:40px 0 0 10px; width:95%">
                	<span>NOTES</span>
                   
                    <input type="text" id="notes3" class="popup_txt" style="width:250px;" />
                    <input type="hidden" id="reserd_id3" value="<?php echo $details->id;?>" />
                    <input type="submit" value="Submit" onclick="submit_values('articles')" class="popup_btn" />
                    
                </div>           
                <div class="popup_bottom">
                	<div class="popup_bottom_left">
                    	<div class="popup_txt_1" style="margin:0 0 0 10px; height:120px; width:95%;" id="showGeneral2">
                        <?php foreach($admin_notes->result() as $row){ ?>
                        	<span><p style="color:#F00; float:left"><?php if($row->articles != '') { echo $row->added.' -' ;?></p> <?php echo $row->articles; }?> </span>
                           
                            <?php } ?>
                        </div>
                    </div>
                    <div class="popup_bottom_right">
                    	<span style="text-align:center;">STATUS</span>
                       
                        <select style="margin:0 0 20px 36px; padding:4px; width:130px; text-align:center" class="popup_txt" id="popup_status_articles">
                        	<option value="new" <?php if($admin_status->row()->articles_status == 'new') echo 'selected="selected"';?>>NEW</option>
                            <option value="processing" <?php if($admin_status->row()->articles_status == 'processing') echo 'selected="selected"';?>>PENDING</option>
                            <option value="complete" <?php if($admin_status->row()->articles_status == 'complete') echo 'selected="selected"';?>>COMPLETED</option>
                        </select>
                        
                         <input type="hidden" name="popup_id" id="popup_id_articles" value="<?php echo $admin_status->row()->id; ?>"/>
                       
                        <input type="hidden" value="<?php echo $details->id;?>" id="rsd_id_articles" />
                        
                         <input type="submit" value="Save & Close" onclick="articles_save()" class="popup_btn" style="margin:0 0 0 43px" />
                         
                    </div>
                </div>     
            </div>
        </div>
        
  </div>

 <?php } if ($display == 'pa'){?>

  <div id='inline_pa' style='background:#fff;' class="pop_up_style">
  
  		<div class="popup_page">  
  			<div class="popup_header">Purchase Agreement - <?php echo stripslashes($details->prop_address);?></div>   
            <span class="popup_sub_txt">Choose Files to Upload</span>
            <div class="popup_top_right">
            	<input type="file" />
                <span class="popup_note">Note : To Upload multiple image, hold 'Control' button while choosing images</span>
            </div>
            <div class="popup_middle">
            	<div style="float:left; width:100%; min-height:100px"></div>
                
                 <div class="popup_field" style="width:95%; color:#FF0000; font-size:14px; margin-top:10px;" id="generalNote2"></div>
                <div class="popup_field" style="margin:40px 0 0 10px; width:95%">
                	<span>NOTES</span>
                    
                     <input type="text" id="notes3" class="popup_txt" style="width:250px;" />
                    <input type="hidden" id="reserd_id3" value="<?php echo $details->id;?>" />
                    <input type="submit" value="Submit" onclick="submit_values('pa')" class="popup_btn" />
                </div>           
                <div class="popup_bottom">
                	<div class="popup_bottom_left">
                    	<div class="popup_txt_1" style="margin:0 0 0 10px; height:120px; width:95%;" id="showGeneral2">
                        <?php foreach($admin_notes->result() as $row){ ?>
                        	<span><p style="color:#F00; float:left"><?php if($row->pa != '') { echo $row->added.' -' ;?></p> <?php echo $row->pa; }?> </span>
                           
                            <?php } ?>
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
  
 <?php } if ($display == 'llc'){?>

  <div id='inline_llc' style='background:#fff;' class="pop_up_style">
  
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
 
 <?php } if ($display == 'loan'){?>

  <div id='inline_loan' style='background:#fff;' class="pop_up_style">
  
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
  
 <?php } if ($display == 'fedex'){?>

  <div id='inline_fedex' style='background:#fff;' class="pop_up_style">
  
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
  
 <?php } if ($display == 'doi'){?>

  <div id='inline_doi' style='background:#fff;' class="pop_up_style">
  
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
  
 <?php } if ($display == 'insurance'){?>

  <div id='inline_insurance' style='background:#fff;' class="pop_up_style">
  
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
  
 <?php } if ($display == 'funded'){?>

  <div id='inline_fund' style='background:#fff;' class="pop_up_style">
  
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

 <?php } if ($display == 'closed'){?>

  <div id='inline_closed' style='background:#fff;' class="pop_up_style">
  
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
  
 <?php } if ($display == 'hand_off'){?>

  <div id='inline_pmhand' style='background:#fff;' class="pop_up_style">
  
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
  
 <?php } if ($display == 'master'){?>

  <div id='inline_master' style='background:#fff;' class="pop_up_style">
  
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
  
 <?php } if ($display == 'invoice'){?>

  <div id='inline_invoice' style='background:#fff;' class="pop_up_style">
  
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
  
  <?php } ?>
<script>
function submit_values(tabVal)
{
if(tabVal == 'general')
{
	var note = document.getElementById("notes1").value;
	var id = document.getElementById("reserd_id").value;
}
if(tabVal == 'loi')
{
	var note = document.getElementById("notes2").value;
	var id = document.getElementById("reserd_id2").value;
}
if(tabVal == 'articles')
{
	var note = document.getElementById("notes3").value;
	var id = document.getElementById("reserd_id3").value;
}
	var field = tabVal;
		$.ajax({
			type: 'POST',
			url: baseURL+'crmadmin/product/genereal_note',
			data:{'notes':note, 'field':field, 'reserd_id':id},
			success: function(data){
				if(data == 'general'){
					$('#generalNote').html('Notes added successfully');
					$('#generalNote').show().delay('3000').fadeOut();
					var showGeneralMsg = $('#showGeneral').html();
					$('#notes1').val('');
					
					$('#showGeneral').html('<span><p style="color:#F00; float:left">'+ShowLocalDate()+' - </p> '+note+'</span><br>'+showGeneralMsg);
					
				}
				if(data == 'loi'){
					$('#generalNote1').html('Notes added successfully');
					$('#generalNote1').show().delay('3000').fadeOut();
					var showGeneralMsg = $('#showGeneral1').html();
					$('#notes2').val('');
					$('#showGeneral1').html('<span><p style="color:#F00; float:left">'+ShowLocalDate()+' - </p> '+note+'</span><br>'+showGeneralMsg);
					
				}
				if(data == 'articles'){
					$('#generalNote2').html('Notes added successfully');
					$('#generalNote2').show().delay('3000').fadeOut();
					var showGeneralMsg = $('#showGeneral2').html();
					$('#notes3').val('');
					$('#showGeneral2').html('<span><p style="color:#F00; float:left">'+ShowLocalDate()+' - </p> '+note+'</span><br>'+showGeneralMsg);
					
				}
			}
		});
}

function ShowLocalDate()
{
var dNow = new Date();
var localdate = dNow.getFullYear() + '-' + (dNow.getMonth() + 1 ) + '-' + dNow.getDate() + ' ' + dNow.getHours() + ':' + dNow.getMinutes()+ ':' + dNow.getSeconds();
return localdate;
}

function loi_save()
{
	var cust = document.getElementById("custodian_name").value;
	var ac_ty = document.getElementById("account_type").value;
	var ac_no = document.getElementById("account_no").value;
	var puId = document.getElementById("popup_id_loi").value;
	var status = document.getElementById("popup_status_loi").value;
	var rsdId = document.getElementById("rsd_id_loi").value;
	$.ajax({
			type: 'POST',
			url: baseURL+'crmadmin/product/popup_save_options',
			data:{'custodian_name':cust, 'account_type':ac_ty, 'account_no':ac_no, 'popup_id':puId, 'loi_status':status, 'reserved_id':rsdId},
			success: function(data)
			{
				if(data == 'success')
				{
					alert("LOI details saved");
					location.reload();
				}
			}
		});
	
}

function articles_save()
{
	var puId = document.getElementById("popup_id_articles").value;
	var status = document.getElementById("popup_status_articles").value;
	var rsdId = document.getElementById("rsd_id_articles").value;
	$.ajax({
			type: 'POST',
			url: baseURL+'crmadmin/product/popup_save_options',
			data:{'popup_id':puId, 'articles_status':status, 'reserved_id':rsdId},
			success: function(data)
			{
				if(data == 'success')
				{
					alert("Articles details saved");
					location.reload();
				}
			}
		});
	
}
</script>