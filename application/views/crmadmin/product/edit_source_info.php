<?php
$this->load->view('crmadmin/templates/header.php');

?>
<style>
#user_nav {
	width:auto !important;
}
.add_rental_list label {
    font-size: 1em !important;
	}
</style>

	<!--<script type="text/javascript">
		function delimage(val){
		$('#row'+val).remove();
		}
		
		 $(function() {
			
		
		/* product Add images dynamically */
	var i = 1;
	
	
	$('#add').click(function() {
	
			$('<div id="row'+i+'" class="control-group field"><input type="text" class="small tipTop" name="imgtitle[]"  maxlength="25"  placeholder="Caption" /> <input class="small tipTop"  placeholder="Priority" name="imgPriority[]" type="text"><div class="uploader" id="uniform-productImage" style=""><input type="file" class="large tipTop" name="product_image[]" id="product_image" onchange="Test.UpdatePreview(this,'+i+')" style="opacity: 0;"><span class="filename" style="-moz-user-select: none;">No file selected</span><span class="action" style="-moz-user-select: none;">Choose File</span></div><img style="display: inline-block; margin: 0 10px; position: relative;top: 13px;" class="img'+i+'" width="150" height="150" alt="" src="images/noimage.jpg"><a href="javascript:void(0);" onclick="return delimage('+i+');"><div class="rmv_btn">Remove</div></a></div></div><br />').fadeIn('slow').appendTo('.imageAdd');
			i++;
		});
	
			Test = {
        UpdatePreview: function(obj,ival){
          // if IE < 10 doesn't support FileReader
          if(!window.FileReader){
             // don't know how to proceed to assign src to image tag
          } else {
             var reader = new FileReader();
             var target = null;
             
             reader.onload = function(e) {
              target =  e.target || e.srcElement;
			 
               $(".img"+ival).prop("src", target.result);
             };
              reader.readAsDataURL(obj.files[0]);
          }
        }
    };					 
		
		$('#remove').click(function() {
									
		if(i > 0) {
			$('.field:last').remove();
			i--; 
		}
		});
		
		$('#reset').click(function() {
		
			$('.field').remove();
			$('.field').remove();
			$('#add').show();
			i=0;
		
		
		});
		
		$('#add').click(function() {
		if(i > 7) {
			$('#add').hide();
		
		}
		});
		});
	/* end */

		
		
	</script>-->

<script type="text/javascript">
	

    jQuery(document).ready( function () {
                    
              
	var q = 1001;
                   
  
    $("#append").click( function() {
    
	
	$(".inc").append('<div class="controls"><input class=""  placeholder="Dates" name="PrName[]" type="text" style="width:100px;" >&nbsp;&nbsp;<input id="rateStartDate'+q+'" name="PrStartDate[]" type="text" style="width:100px;">&nbsp;<input  id="rateEndDate'+q+'" name="PrEndDate[]" type="text" style="width:100px;">&nbsp;<input id="Nightly" placeholder="Nightly" name="Nightly[]" type="text" style="width:100px;" ><input id="WkndNight" placeholder="Wknd Night" name="WkndNight[]" type="text" style="width:100px;" ><input id="Weekend" placeholder="Weekend" name="Weekend[]" type="text" style="width:100px;" ><input id="Weekly" placeholder="Weekly" name="Weekly[]" type="text" style="width:100px;" ><input id="Monthly" placeholder="Monthly" name="Monthly[]" type="text" style="width:100px;" ><input id="Event" placeholder="Event" name="Event[]" type="text" style="width:100px;" >&nbsp;&nbsp;<a href="#" class="remove_this btn btn-danger">remove</a><br><br></div>');
		$("#rateStartDate"+q).datepicker({ minDate:0, dateFormat: 'yy-mm-dd'});
		$("#rateEndDate"+q).datepicker({ minDate:0, dateFormat: 'yy-mm-dd'});
    q++;
    return false;
    });
     
    jQuery('.remove_this').live('click', function() {
    jQuery(this).parent().remove();
    return false;
    });
     
     
    });
    </script>




<script>
$(document).ready(function(){
	$('.nxtTab').click(function(){
		var cur = $(this).parent().parent().parent().parent().parent();
		cur.hide();
		cur.next().show();
		var tab = cur.parent().parent().prev();
		tab.find('a.active_tab').removeClass('active_tab').parent().next().find('a').addClass('active_tab');
	});
	$('.prvTab').click(function(){
		var cur = $(this).parent().parent().parent().parent().parent();
		cur.hide();
		cur.prev().show();
		var tab = cur.parent().parent().prev();
		tab.find('a.active_tab').removeClass('active_tab').parent().prev().find('a').addClass('active_tab');
	});
	$('#tab2 input[type="checkbox"]').click(function(){
		var cat = $(this).parent().attr('class');
		var curCat = cat;
		var catPos = '';
		var added = '';
		var curPos = curCat.substring(3);
		var newspan = $(this).parent().prev();
		if($(this).is(':checked')){
			while(cat != 'cat1'){
				cat = newspan.attr('class');
				catPos = cat.substring(3);
				if(cat != curCat && catPos<curPos){
					if (jQuery.inArray(catPos, added.replace(/,\s+/g, ',').split(',')) >= 0) {
					    //Found it!
					}else{
						newspan.find('input[type="checkbox"]').attr('checked','checked');
						added += catPos+',';
					}
				}
				newspan = newspan.prev(); 
			}
		}else{
			var newspan = $(this).parent().next();
			if(newspan.get(0)){
				var cat = newspan.attr('class');
				var catPos = cat.substring(3);
			}
			while(newspan.get(0) && cat != curCat && catPos>curPos){
				newspan.find('input[type="checkbox"]').attr('checked',this.checked);	
				newspan = newspan.next(); 	
				cat = newspan.attr('class');
				catPos = cat.substring(3);
			}
		}
	});
		
});
</script>
<script language="javascript">
function viewAttributes(Val){

	if(Val == 'show'){
		document.getElementById('AttributeView').style.display = 'block';
	}else{
		document.getElementById('AttributeView').style.display = 'none';
	}
}


</script>
<div id="content">
  <div class="grid_container">
    <div class="grid_12">
      <div class="widget_wrap">
        <div class="widget_top"> <span class="h_icon list"></span>
						<h6>Edit Source Info</h6>
                        <div id="widget_tab">
              				<ul>
               					  <li><a href="#tab1" class="active_tab">Buyer Info</a></li>
                                  <li><a href="#tab2">Sourcer Info</a></li>

<!--                                  <li><a href="#tab2">Property Management Info</a></li>
                                  <li><a href="#tab3">Title Company Info</a></li>
                                  <li><a href="#tab4">SDIRA Info</a></li>
                                  <li><a href="#tab5">Home Warranty Info</a></li>
                                  <li><a href="#tab6">Rental Guarantee Info</a></li>
                                  <li><a href="#tab7">Insurance Info</a></li>
                                  <li><a href="#tab8">Lead Source Info</a></li>
-->             				 </ul>
            			</div>
					</div>
					<div class="widget_content">
				
					 <?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'property_source_form', 'enctype' => 'multipart/form-data');
						echo form_open_multipart('crmadmin/product/edit_source_info',$attributes);
					
                  
					
                    
                    extract($source_info);
					//echo $s_firstname;die; 
					//echo "<pre>";print_r($source_details_unserialize);die;
					//echo "<pre>";print_r($get_source_info->result_array());die;
                    ?>
                    
               <div id="tab1">
            <ul>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="b1firstname">Buyer 1 First Name</label>
                  <div class="form_input">
                    <input name="b1_firstname" id="b1_firstname" value="<?php echo $ReservedDetails->row()->first_name;?>" type="text" tabindex="1" class="large tipTop" title="Please enter buyer 1 first name"/>
                     <span id="b1_firstname_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="b1lastname">Buyer 1 Last Name</label>
                  <div class="form_input">
                    <input name="b1_lastname" id="b1_lastname" value="<?php echo $ReservedDetails->row()->last_name;?>" type="text" tabindex="1" class="large tipTop" title="Please enter buyer 1 last name"/>
                     <span id="b1_lastname_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="b2firstname">Buyer 2 First Name</label>
                  <div class="form_input">
                    <input name="b2_firstname" id="b2_firstname" value="<?php echo $ReservedDetails->row()->first_name;?>" type="text" tabindex="1" class="large tipTop" title="Please enter buyer 2 first name"/>
                     <span id="b2_firstname_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="b2lastname">Buyer 2 Last Name</label>
                  <div class="form_input">
                    <input name="b2_lastname" id="b2_lastname" value="<?php echo $ReservedDetails->row()->last_name;?>" type="text" tabindex="1" class="large tipTop" title="Please enter buyer 2 last name"/>
                     <span id="b2_lastname_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bentityname">Buyer Entity Name</label>
                  <div class="form_input">
                    <input name="b_entityname" id="b_entityname" value="<?php echo $ReservedDetails->row()->entity_name;?>" type="text" tabindex="1" class="large tipTop" title="Please enter buyer entity name"/>
                     <span id="b_entityname_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bentitytype">Buyer Entity Type</label>
                  <div class="form_input">
                    <input name="b_entitytype" id="b_entitytype" value="<?php echo $ReservedDetails->row()->resrv_type;?>" type="text" tabindex="1" class="large tipTop" title="Please enter buyer entity name"/>
                     <span id="b_entitytype_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="baddress">Buyer Address</label>
                  <div class="form_input">
                    <input name="b_address" id="b_address" value="<?php echo $ReservedDetails->row()->address;?>" type="text" tabindex="1" class="large tipTop" title="Please enter buyer address"/>
                     <span id="b_address_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bcity">Buyer City</label>
                  <div class="form_input">
                    <input name="b_city" id="b_city" value="<?php echo $ReservedDetails->row()->city;?>" type="text" tabindex="1" class="large tipTop" title="Please enter buyer city"/>
                     <span id="b_city_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bstate">Buyer State</label>
                  <div class="form_input">
                    <input name="b_state" id="b_state" value="<?php echo $ReservedDetails->row()->state;?>" type="text" tabindex="1" class="large tipTop" title="Please enter buyer state"/>
                     <span id="b_state_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bzipcode">Buyer zip code</label>
                  <div class="form_input">
                    <input name="b_zipcode" id="b_zipcode" value="<?php echo $ReservedDetails->row()->postal_code;?>" type="text" tabindex="1" class="large tipTop" title="Please enter buyer zip code"/>
                     <span id="b_zipcode_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bphone1">Buyer phone 1</label>
                  <div class="form_input">
                    <input name="b_phone1" id="b_phone1" value="<?php echo $ReservedDetails->row()->phone_no;?>" type="text" tabindex="1" class="large tipTop" title="Please enter buyer phone 1"/>
                     <span id="b_phone1_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bphone2">Buyer phone 2</label>
                  <div class="form_input">
                    <input name="b_phone2" id="b_phone2" value="<?php if($ReservedDetails->row()->phone_no1!=0)echo $ReservedDetails->row()->phone_no1;else echo '';?>" type="text" tabindex="1" class="large tipTop" title="Please enter buyer phone 2"/>
                     <span id="b_phone2_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bemail1">Buyer email 1</label>
                  <div class="form_input">
                    <input name="b_email1" id="b_email1" value="<?php echo $ReservedDetails->row()->email;?>" type="text" tabindex="1" class="large tipTop" title="Please enter buyer email 1"/>
                     <span id="b_email1_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bemail2">Buyer email 2</label>
                  <div class="form_input">
                    <input name="b_email2" id="b_email2" value="<?php echo $ReservedDetails->row()->email1;?>" type="text" tabindex="1" class="large tipTop" title="Please enter buyer email 2"/>
                     <span id="b_email2_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bpurchaseprice">Buyer purchase price</label>
                  <div class="form_input">
                    <input name="b_purchase_price" id="b_purchase_price" value="<?php if($ReservedDetails->row()->id != '') echo number_format($ReservedDetails->row()->sales_price,0);?>" type="text" tabindex="1" class="large tipTop" title="Please enter buyer email 2"/>
                     <span id="b_purchase_price_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sale_date">Sale Date</label>
                  <div class="form_input">
                    <input name="sale_date" id="sale_date" value="<?php if($ReservedDetails->row()->id != '') echo date('Y-m-d', strtotime($ReservedDetails->row()->dateAdded));?>" type="text" tabindex="1" class="large tipTop" title="Please enter sale date"/>
                     <span id="sale_date_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
             <li>
                <div class="form_grid_12">
                  <div class="form_input">
                  <a href="crmadmin/product/edit_product_form/<?php echo $propertyID;?>" class="tipLeft" title="Go to property page"><span class="btn_small btn_blue nxtTab">Back</span></a>
                   <input type="button" name="general" id="generalInfo" class="btn_small btn_blue nxtTab" tabindex="9" value="Next"/>
                  </div>
                </div>
              </li>
            </ul>
            </div>
                    
			  <div id="tab2" class="tab_common_class">
            <ul>
            <li>
            <h4>Sourcer Info</h4>
            </li>
             <li>
             <div class="form_grid_12">
                  <label class="field_title" for="sfirstname">Property Address</label>
             <div class="form_input">
                     <?php echo $propertyaddress->row()->address.', '.$propertyaddress->row()->city.', '.$propertyaddress->row()->state.', '.$propertyaddress->row()->post_code; ?>
                  </div>
            </li>
             <li>
             <input type="hidden" name="id" value="<?php echo $propertyID;?>" />
            
                <div class="form_grid_12">
                  <label class="field_title" for="sfirstname">Sourcer First Name</label>
                  <div class="form_input">
                    <input name="s_firstname" id="s_firstname" value="<?php echo $s_firstname;?>" type="text" tabindex="1" class="large tipTop" title="Please enter sourcer first name"/>
                     <span id="s_firstname_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="slastname">Sourcer Last Name</label>
                  <div class="form_input">
                    <input name="s_lastname" id="s_lastname" value="<?php echo $s_lastname;?>" type="text" tabindex="1" class="large tipTop" title="Please enter sourcer last name"/>
                     <span id="s_lastname_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="scompanyname">Sourcer Company Name</label>
                  <div class="form_input">
                    <input name="s_companyname" id="s_companyname" value="<?php echo $s_companyname;?>" type="text" tabindex="1" class="large tipTop" title="Please enter sourcer company name"/>
                     <span id="s_companyname_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="saddress">Sourcer Address</label>
                  <div class="form_input">
                    <input name="s_address" id="s_address" value="<?php echo $s_address;?>" type="text" tabindex="1" class="large tipTop" title="Please enter sourcer address"/>
                     <span id="s_address_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sstate">Sourcer State</label>
                  <div class="form_input">
                    <input name="s_state" id="s_state" value="<?php echo $s_state;?>" type="text" tabindex="1" class="large tipTop" title="Please enter sourcer state"/>
                     <span id="s_state_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="szipcode">Sourcer zip code</label>
                  <div class="form_input">
                    <input name="s_zipcode" id="s_zipcode" value="<?php echo $s_zipcode;?>" type="text" tabindex="1" class="large tipTop" title="Please enter sourcer zip code"/>
                     <span id="s_zipcode_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="scontact1">Sourcer Contact 1</label>
                  <div class="form_input">
                    <input name="s_contact1" id="s_contact1" value="<?php echo $s_contact1;?>" type="text" tabindex="1" class="large tipTop" title="Please enter sourcer contact 1"/>
                     <span id="s_contact1_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="scontact2">Sourcer Contact 2</label>
                  <div class="form_input">
                    <input name="s_contact2" id="s_contact2" value="<?php echo $s_contact2;?>" type="text" tabindex="1" class="large tipTop" title="Please enter sourcer contact 2"/>
                     <span id="s_contact2_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sphone1">Sourcer phone 1</label>
                  <div class="form_input">
                    <input name="s_phone1" id="s_phone1" value="<?php echo $s_phone1;?>" type="text" tabindex="1" class="large tipTop" title="Please enter sourcer phone 1"/>
                     <span id="s_phone1_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sphone2">Sourcer phone 2</label>
                  <div class="form_input">
                    <input name="s_phone2" id="s_phone2" value="<?php echo $s_phone2;?>" type="text" tabindex="1" class="large tipTop" title="Please enter sourcer phone 2"/>
                     <span id="s_phone2_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="semail">Sourcer email</label>
                  <div class="form_input">
                    <input name="s_email" id="s_email" value="<?php echo $s_email;?>" type="text" tabindex="1" class="large tipTop" title="Please enter sourcer email"/>
                     <span id="s_email_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sfax">Sourcer Fax</label>
                  <div class="form_input">
                    <input name="s_fax" id="s_fax" value="<?php echo $s_fax;?>" type="text" tabindex="1" class="large tipTop" title="Please enter sourcer fax"/>
                     <span id="s_fax_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sprice">Sourcer price</label>
                  <div class="form_input">
                    <input name="s_price" id="s_price" value="<?php echo $s_price;?>" type="text" tabindex="1" class="large tipTop" title="Please enter sourcer price"/>
                     <span id="s_price_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
               
             <!-- </ul>
              </div>
              <div id="tab2" class="tab_common_class">
              <ul>-->
              <li>
              <h4>Property Management Info</h4>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="mname">Manager Name</label>
                  <div class="form_input">
                    <input name="m_name" id="m_name" value="<?php echo $m_name;?>" type="text" tabindex="1" class="large tipTop" title="Please enter manager name"/>
                     <span id="m_name_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="maddress">Manager Address</label>
                  <div class="form_input">
                    <input name="m_address" id="m_address" value="<?php echo $m_address;?>" type="text" tabindex="1" class="large tipTop" title="Please enter manager address"/>
                     <span id="m_address_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="mcity">Manager City</label>
                  <div class="form_input">
                    <input name="m_city" id="m_city" value="<?php echo $m_city;?>" type="text" tabindex="1" class="large tipTop" title="Please enter manager city"/>
                     <span id="m_city_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="mstate">Manager State</label>
                  <div class="form_input">
                    <input name="m_state" id="m_state" value="<?php echo $m_state;?>" type="text" tabindex="1" class="large tipTop" title="Please enter manager state"/>
                     <span id="m_state_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="mzipcode">Manager zip code</label>
                  <div class="form_input">
                    <input name="m_zipcode" id="m_zipcode" value="<?php echo $m_zipcode;?>" type="text" tabindex="1" class="large tipTop" title="Please enter manager zip code"/>
                     <span id="m_zipcode_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="mcontact1">Manager Contact 1</label>
                  <div class="form_input">
                    <input name="m_contact1" id="m_contact1" value="<?php echo $m_contact1;?>" type="text" tabindex="1" class="large tipTop" title="Please enter manager contact 1"/>
                     <span id="m_contact1_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>

              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="mcontact2">Manager Contact 2</label>
                  <div class="form_input">
                    <input name="m_contact2" id="m_contact2" value="<?php echo $m_contact2;?>" type="text" tabindex="1" class="large tipTop" title="Please enter manager contact 2"/>
                     <span id="m_contact2_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="mphone1">Manager phone 1</label>
                  <div class="form_input">
                    <input name="m_phone1" id="m_phone1" value="<?php echo $m_phone1;?>" type="text" tabindex="1" class="large tipTop" title="Please enter manager phone 1"/>
                     <span id="m_phone1_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="mphone2">Manager phone 2</label>
                  <div class="form_input">
                    <input name="m_phone2" id="m_phone2" value="<?php echo $m_phone2;?>" type="text" tabindex="1" class="large tipTop" title="Please enter manager phone 2"/>
                     <span id="m_phone2_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="memail">Manager email</label>
                  <div class="form_input">
                    <input name="m_email" id="m_email" value="<?php echo $m_email;?>" type="text" tabindex="1" class="large tipTop" title="Please enter manager email"/>
                     <span id="m_email_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="mfax">Manager Fax</label>
                  <div class="form_input">
                    <input name="m_fax" id="m_fax" value="<?php echo $m_fax;?>" type="text" tabindex="1" class="large tipTop" title="Please enter manager fax"/>
                     <span id="m_fax_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="tname">Tenant Name</label>
                  <div class="form_input">
                    <input name="t_name" id="t_name" value="<?php echo $t_name;?>" type="text" tabindex="1" class="large tipTop" title="Please enter tenant name"/>
                     <span id="t_name_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="leaseterm">Lease Term (# of months)</label>
                  <div class="form_input">
                    <input name="lease_term" id="lease_term" value="<?php echo $lease_term;?>" type="text" tabindex="1" class="large tipTop" title="Please enter lease term"/>
                     <span id="lease_term_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="section8">Section 8</label>
                  <div class="form_input">
                    <input name="section8" id="section8" value="<?php echo $section8;?>" type="text" tabindex="1" class="large tipTop" title="Please enter section 8"/>
                     <span id="section8_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
               <div class="form_grid_12">
                  <label class="field_title" for="mfee">Manager Fee $(%)</label>
                  <div class="form_input">
                    <input name="mfee" id="mfee" value="<?php echo $mfee;?>" type="text" tabindex="1" class="large tipTop" title="Please enter manager fee"/>
                     <span id="mfee_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
            <!--   <li>
                <div class="form_grid_12">
                  <div class="form_input">
                    <input type="button" class="btn_small btn_blue prvTab" onclick="TabbedPanels1.showPanel(0); return false;" tabindex="9" value="Prev"/>
                    <input type="button" id="imageUpload" class="btn_small btn_blue nxtTab" tabindex="9" value="Next"/>
                  </div>
                </div>
              </li>
              </ul>
              </div>
              <div id="tab3" class="tab_common_class">
              <ul>-->
              <li>
              <h4>Title Company Info</h4>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sfirstname">Title Company Name</label>
                  <div class="form_input">
                    <input name="t_companyname" id="t_companyname" value="<?php echo $t_companyname;?>" type="text" tabindex="1" class="large tipTop" title="Please enter title company name"/>
                     <span id="t_companyname_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="saddress">Title Company Address</label>
                  <div class="form_input">
                    <input name="t_address" id="t_address" value="<?php echo $t_address;?>" type="text" tabindex="1" class="large tipTop" title="Please enter title company address"/>
                     <span id="t_address_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sstate">Title Company City</label>
                  <div class="form_input">
                    <input name="t_city" id="t_city" value="<?php echo $t_city;?>" type="text" tabindex="1" class="large tipTop" title="Please enter title company city"/>
                     <span id="t_city_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sstate">Title Company State</label>
                  <div class="form_input">
                    <input name="t_state" id="t_state" value="<?php echo $t_state;?>" type="text" tabindex="1" class="large tipTop" title="Please enter title company state"/>
                     <span id="t_state_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="szipcode">Title Company zip code</label>
                  <div class="form_input">
                    <input name="t_zipcode" id="t_zipcode" value="<?php echo $t_zipcode;?>" type="text" tabindex="1" class="large tipTop" title="Please enter title company zip code"/>
                     <span id="t_zipcode_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="scontact1">Title Company Contact 1</label>
                  <div class="form_input">
                    <input name="t_contact1" id="t_contact1" value="<?php echo $t_contact1;?>" type="text" tabindex="1" class="large tipTop" title="Please enter title company contact 1"/>
                     <span id="t_contact1_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="scontact2">Title Company Contact 2</label>
                  <div class="form_input">
                    <input name="t_contact2" id="t_contact2" value="<?php echo $t_contact2;?>" type="text" tabindex="1" class="large tipTop" title="Please enter title company contact 2"/>
                     <span id="t_contact2_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sphone1">Title Company Phone 1</label>
                  <div class="form_input">
                    <input name="t_phone1" id="t_phone1" value="<?php echo $t_phone1;?>" type="text" tabindex="1" class="large tipTop" title="Please enter Title company phone 1"/>
                     <span id="t_phone1_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sphone2">Title Company Phone 2</label>
                  <div class="form_input">
                    <input name="t_phone2" id="t_phone2" value="<?php echo $t_phone2;?>" type="text" tabindex="1" class="large tipTop" title="Please enter title company phone 2"/>
                     <span id="t_phone2_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="semail">Title Company email</label>
                  <div class="form_input">
                    <input name="t_email" id="t_email" value="<?php echo $t_email;?>" type="text" tabindex="1" class="large tipTop" title="Please enter title company email"/>
                     <span id="t_email_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sfax">Title Company Fax</label>
                  <div class="form_input">
                    <input name="t_fax" id="t_fax" value="<?php echo $t_fax;?>" type="text" tabindex="1" class="large tipTop" title="Please enter title company fax"/>
                     <span id="t_fax_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sprice">Projected Closing Date</label>
                  <div class="form_input">
                    <input name="projected_closing_date" id="projected_closing_date" value="<?php echo $projected_closing_date;?>" type="text" tabindex="1" class="large tipTop" title="Please enter Projected Closing Date"/>
                     <span id="projected_closing_date_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sprice">Closing Date</label>
                  <div class="form_input">
                    <input name="closing_date" id="closing_date" value="<?php echo $closing_date;?>" type="text" tabindex="1" class="large tipTop" title="Please enter Closing Date"/>
                     <span id="closing_date_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
                <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sprice">Settlement Date</label>
                  <div class="form_input">
                    <input name="settlement_date" id="settlement_date" value="<?php echo $settlement_date;?>" type="text" tabindex="1" class="large tipTop" title="Please enter Settlement  Date"/>
                     <span id="settlement_date_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
         <!--      <li>
                <div class="form_grid_12">
                  <div class="form_input">
                    <input type="button" class="btn_small btn_blue prvTab" onclick="TabbedPanels1.showPanel(0); return false;" tabindex="9" value="Prev"/>
                    <input type="button" id="imageUpload" class="btn_small btn_blue nxtTab" tabindex="9" value="Next"/>
                  </div>
                </div>
              </li>
              </ul>
              </div>
              <div id="tab4" class="tab_common_class">
              <ul>-->
              <li>
              <h4>SDIRA Info</h4>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sfirstname">SDIRA Name</label>
                  <div class="form_input">
                    <input name="sd_firstname" id="sd_firstname" value="<?php echo $sd_firstname;?>" type="text" tabindex="1" class="large tipTop" title="Please enter SDIRA name"/>
                     <span id="sd_firstname_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="saddress">SDIRA Address</label>
                  <div class="form_input">
                    <input name="sd_address" id="sd_address" value="<?php echo $sd_address;?>" type="text" tabindex="1" class="large tipTop" title="Please enter SDIRA address"/>
                     <span id="sd_address_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sstate">SDIRA City</label>
                  <div class="form_input">
                    <input name="sd_city" id="sd_city" value="<?php echo $sd_city;?>" type="text" tabindex="1" class="large tipTop" title="Please enter SDIRA state"/>
                     <span id="sd_city_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sstate">SDIRA State</label>
                  <div class="form_input">
                    <input name="sd_state" id="sd_state" value="<?php echo $sd_state;?>" type="text" tabindex="1" class="large tipTop" title="Please enter SDIRA state"/>
                     <span id="sd_state_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="szipcode">SDIRA zip code</label>
                  <div class="form_input">
                    <input name="sd_zipcode" id="sd_zipcode" value="<?php echo $sd_zipcode;?>" type="text" tabindex="1" class="large tipTop" title="Please enter SDIRA zip code"/>
                     <span id="sd_zipcode_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="scontact1">SDIRA Contact 1</label>
                  <div class="form_input">
                    <input name="sd_contact1" id="sd_contact1" value="<?php echo $sd_contact1;?>" type="text" tabindex="1" class="large tipTop" title="Please enter SDIRA contact 1"/>
                     <span id="sd_contact1_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="scontact2">SDIRA Contact 2</label>
                  <div class="form_input">
                    <input name="sd_contact2" id="sd_contact2" value="<?php echo $sd_contact2;?>" type="text" tabindex="1" class="large tipTop" title="Please enter SDIRA contact 2"/>
                     <span id="sd_contact2_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sphone1">SDIRA phone 1</label>
                  <div class="form_input">
                    <input name="sd_phone1" id="sd_phone1" value="<?php echo $sd_phone1;?>" type="text" tabindex="1" class="large tipTop" title="Please enter SDIRA phone 1"/>
                     <span id="sd_phone1_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sphone2">SDIRA phone 2</label>
                  <div class="form_input">
                    <input name="sd_phone2" id="sd_phone2" value="<?php echo $sd_phone2;?>" type="text" tabindex="1" class="large tipTop" title="Please enter SDIRA phone 2"/>
                     <span id="sd_phone2_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="semail">SDIRA email</label>
                  <div class="form_input">
                    <input name="sd_email" id="sd_email" value="<?php echo $sd_email;?>" type="text" tabindex="1" class="large tipTop" title="Please enter SDIRA email"/>
                     <span id="sd_email_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sfax">SDIRA Fax</label>
                  <div class="form_input">
                    <input name="sd_fax" id="sd_fax" value="<?php echo $sd_fax;?>" type="text" tabindex="1" class="large tipTop" title="Please enter SDIRA fax"/>
                     <span id="sd_fax_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>

              </li>
           <!--    <li>
                <div class="form_grid_12">
                  <div class="form_input">
                    <input type="button" class="btn_small btn_blue prvTab" onclick="TabbedPanels1.showPanel(0); return false;" tabindex="9" value="Prev"/>
                    <input type="button" id="imageUpload" class="btn_small btn_blue nxtTab" tabindex="9" value="Next"/>
                  </div>
                </div>
              </li>
              </ul>
              </div>
              <div id="tab5" class="tab_common_class">
              <ul>-->
              <li>
             <h4>Home Warranty Info</h4>
              </li>
                <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sfirstname">HW Name</label>
                  <div class="form_input">
                    <input name="hw_firstname" id="hw_firstname" value="<?php echo $hw_firstname;?>" type="text" tabindex="1" class="large tipTop" title="Please enter HW name"/>
                     <span id="hw_firstname_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="saddress">HW Address</label>
                  <div class="form_input">
                    <input name="hw_address" id="hw_address" value="<?php echo $hw_address;?>" type="text" tabindex="1" class="large tipTop" title="Please enter HW address"/>
                     <span id="hw_address_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sstate">HW City</label>
                  <div class="form_input">
                    <input name="hw_city" id="hw_city" value="<?php echo $hw_city;?>" type="text" tabindex="1" class="large tipTop" title="Please enter HW state"/>
                     <span id="hw_city_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sstate">HW State</label>
                  <div class="form_input">
                    <input name="hw_state" id="hw_state" value="<?php echo $hw_state;?>" type="text" tabindex="1" class="large tipTop" title="Please enter HW state"/>
                     <span id="hw_state_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="szipcode">HW zip code</label>
                  <div class="form_input">
                    <input name="hw_zipcode" id="hw_zipcode" value="<?php echo $hw_zipcode;?>" type="text" tabindex="1" class="large tipTop" title="Please enter HW zip code"/>
                     <span id="hw_zipcode_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="scontact1">HW Contact 1</label>
                  <div class="form_input">
                    <input name="hw_contact1" id="hw_contact1" value="<?php echo $hw_contact1;?>" type="text" tabindex="1" class="large tipTop" title="Please enter HW contact 1"/>
                     <span id="hw_contact1_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="scontact2">HW Contact 2</label>
                  <div class="form_input">
                    <input name="hw_contact2" id="hw_contact2" value="<?php echo $hw_contact2;?>" type="text" tabindex="1" class="large tipTop" title="Please enter HW contact 2"/>
                     <span id="hw_contact2_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sphone1">HW phone 1</label>
                  <div class="form_input">
                    <input name="hw_phone1" id="hw_phone1" value="<?php echo $hw_phone1;?>" type="text" tabindex="1" class="large tipTop" title="Please enter HW phone 1"/>
                     <span id="hw_phone1_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sphone2">HW phone 2</label>
                  <div class="form_input">
                    <input name="hw_phone2" id="hw_phone2" value="<?php echo $hw_phone2;?>" type="text" tabindex="1" class="large tipTop" title="Please enter HW phone 2"/>
                     <span id="sd_phone2_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="semail">HW email</label>
                  <div class="form_input">
                    <input name="hw_email" id="hw_email" value="<?php echo $hw_email;?>" type="text" tabindex="1" class="large tipTop" title="Please enter HW email"/>
                     <span id="hw_email_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sfax">HW Fax</label>
                  <div class="form_input">
                    <input name="hw_fax" id="hw_fax" value="<?php echo $hw_fax;?>" type="text" tabindex="1" class="large tipTop" title="Please enter HW fax"/>
                     <span id="hw_fax_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sfax">Fee ($)</label>
                  <div class="form_input">
                    <input name="hw_fax" id="hw_fax" value="<?php echo $hw_fax;?>" type="text" tabindex="1" class="large tipTop" title="Please enter HW fax"/>
                     <span id="hw_fax_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
             <!--   <li>
                <div class="form_grid_12">
                  <div class="form_input">
                    <input type="button" class="btn_small btn_blue prvTab" onclick="TabbedPanels1.showPanel(0); return false;" tabindex="9" value="Prev"/>
                    <input type="button" id="imageUpload" class="btn_small btn_blue nxtTab" tabindex="9" value="Next"/>
                  </div>
                </div>
              </li>
             </ul>
              </div>
              <div id="tab6" class="tab_common_class">
              <ul>-->
               <li>
             <h4>Rental Guarantee Info</h4>
              </li>
                <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sfirstname">Rental Guarantee  Name</label>
                  <div class="form_input">
                    <input name="rg_firstname" id="rg_firstname" value="<?php echo $rg_firstname;?>" type="text" tabindex="1" class="large tipTop" title="Please enter Rental Guarantee  name"/>
                     <span id="rg_firstname_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="saddress">Rental Guarantee  Address</label>
                  <div class="form_input">
                    <input name="rg_address" id="rg_address" value="<?php echo $rg_address;?>" type="text" tabindex="1" class="large tipTop" title="Please enter Rental Guarantee  address"/>
                     <span id="rg_address_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sstate">Rental Guarantee  City</label>
                  <div class="form_input">
                    <input name="rg_city" id="rg_city" value="<?php echo $rg_city;?>" type="text" tabindex="1" class="large tipTop" title="Please enter Rental Guarantee  state"/>
                     <span id="rg_city_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sstate">Rental Guarantee  State</label>
                  <div class="form_input">
                    <input name="rg_state" id="rg_state" value="<?php echo $rg_state;?>" type="text" tabindex="1" class="large tipTop" title="Please enter Rental Guarantee  state"/>
                     <span id="rg_state_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="szipcode">Rental Guarantee  zip code</label>
                  <div class="form_input">
                    <input name="rg_zipcode" id="rg_zipcode" value="<?php echo $rg_zipcode;?>" type="text" tabindex="1" class="large tipTop" title="Please enter Rental Guarantee  zip code"/>
                     <span id="rg_zipcode_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="scontact1">Rental Guarantee  Contact 1</label>
                  <div class="form_input">
                    <input name="rg_contact1" id="rg_contact1" value="<?php echo $rg_contact1;?>" type="text" tabindex="1" class="large tipTop" title="Please enter Rental Guarantee  contact 1"/>
                     <span id="rg_contact1_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="scontact2">Rental Guarantee  Contact 2</label>
                  <div class="form_input">
                    <input name="rg_contact2" id="rg_contact2" value="<?php echo $rg_contact2;?>" type="text" tabindex="1" class="large tipTop" title="Please enter Rental Guarantee  contact 2"/>
                     <span id="rg_contact2_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sphone1">Rental Guarantee  phone 1</label>
                  <div class="form_input">
                    <input name="rg_phone1" id="rg_phone1" value="<?php echo $rg_phone1;?>" type="text" tabindex="1" class="large tipTop" title="Please enter Rental Guarantee  phone 1"/>
                     <span id="rg_phone1_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sphone2">Rental Guarantee  phone 2</label>
                  <div class="form_input">
                    <input name="rg_phone2" id="rg_phone2" value="<?php echo $rg_phone2;?>" type="text" tabindex="1" class="large tipTop" title="Please enter Rental Guarantee  phone 2"/>
                     <span id="sd_phone2_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="semail">Rental Guarantee  email</label>
                  <div class="form_input">
                    <input name="rg_email" id="rg_email" value="<?php echo $rg_email;?>" type="text" tabindex="1" class="large tipTop" title="Please enter Rental Guarantee  email"/>
                     <span id="rg_email_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sfax">Rental Guarantee  Fax</label>
                  <div class="form_input">
                    <input name="rg_fax" id="rg_fax" value="<?php echo $rg_fax;?>" type="text" tabindex="1" class="large tipTop" title="Please enter Rental Guarantee  fax"/>
                     <span id="rg_fax_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sfax">Rental Guarantee Fee ($)</label>
                  <div class="form_input">
                    <input name="rg_fax" id="rg_fax" value="<?php echo $rg_fax;?>" type="text" tabindex="1" class="large tipTop" title="Please enter Rental Guarantee fee"/>
                     <span id="rg_fax_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <!--   <li>
                <div class="form_grid_12">
                  <div class="form_input">
                    <input type="button" class="btn_small btn_blue prvTab" onclick="TabbedPanels1.showPanel(0); return false;" tabindex="9" value="Prev"/>
                    <input type="button" id="imageUpload" class="btn_small btn_blue nxtTab" tabindex="9" value="Next"/>
                  </div>
                </div>
              </li>
            </ul>
              </div>
              <div id="tab7" class="tab_common_class">
              <ul>-->
              <li>
              <h4>Insurance Info</h4>
              </li>
                <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sfirstname">Insurance  Name</label>
                  <div class="form_input">
                    <input name="in_firstname" id="in_firstname" value="<?php echo $in_firstname;?>" type="text" tabindex="1" class="large tipTop" title="Please enter Insurance  name"/>
                     <span id="in_firstname_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="saddress">Insurance  Address</label>
                  <div class="form_input">
                    <input name="in_address" id="in_address" value="<?php echo $in_address;?>" type="text" tabindex="1" class="large tipTop" title="Please enter Insurance  address"/>
                     <span id="in_address_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sstate">Insurance  City</label>
                  <div class="form_input">
                    <input name="in_city" id="in_city" value="<?php echo $in_city;?>" type="text" tabindex="1" class="large tipTop" title="Please enter Insurance  state"/>
                     <span id="in_city_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sstate">Insurance  State</label>
                  <div class="form_input">
                    <input name="in_state" id="in_state" value="<?php echo $in_state;?>" type="text" tabindex="1" class="large tipTop" title="Please enter Insurance  state"/>
                     <span id="in_state_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="szipcode">Insurance  zip code</label>
                  <div class="form_input">
                    <input name="in_zipcode" id="in_zipcode" value="<?php echo $in_zipcode;?>" type="text" tabindex="1" class="large tipTop" title="Please enter Insurance  zip code"/>
                     <span id="in_zipcode_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="scontact1">Insurance  Contact 1</label>
                  <div class="form_input">
                    <input name="in_contact1" id="in_contact1" value="<?php echo $in_contact1;?>" type="text" tabindex="1" class="large tipTop" title="Please enter Insurance  contact 1"/>
                     <span id="in_contact1_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="scontact2">Insurance  Contact 2</label>
                  <div class="form_input">
                    <input name="in_contact2" id="in_contact2" value="<?php echo $in_contact2;?>" type="text" tabindex="1" class="large tipTop" title="Please enter Insurance  contact 2"/>
                     <span id="in_contact2_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sphone1">Insurance  phone 1</label>
                  <div class="form_input">
                    <input name="in_phone1" id="in_phone1" value="<?php echo $in_phone1;?>" type="text" tabindex="1" class="large tipTop" title="Please enter Insurance  phone 1"/>
                     <span id="in_phone1_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sphone2">Insurance  phone 2</label>
                  <div class="form_input">
                    <input name="in_phone2" id="in_phone2" value="<?php echo $in_phone2;?>" type="text" tabindex="1" class="large tipTop" title="Please enter Insurance  phone 2"/>
                     <span id="sd_phone2_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="semail">Insurance  email</label>
                  <div class="form_input">
                    <input name="in_email" id="in_email" value="<?php echo $in_email;?>" type="text" tabindex="1" class="large tipTop" title="Please enter Insurance  email"/>
                     <span id="in_email_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sfax">Insurance  Fax</label>
                  <div class="form_input">
                    <input name="in_fax" id="in_fax" value="<?php echo $in_fax;?>" type="text" tabindex="1" class="large tipTop" title="Please enter Insurance  fax"/>
                     <span id="in_fax_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sfax">Insurance Fee ($)</label>
                  <div class="form_input">
                    <input name="in_fee" id="in_fee" value="<?php echo $in_fee;?>" type="text" tabindex="1" class="large tipTop" title="Please enter Insurance fee"/>
                     <span id="in_fee_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
           <!--    <li>
                <div class="form_grid_12">
                  <div class="form_input">
                    <input type="button" class="btn_small btn_blue prvTab" onclick="TabbedPanels1.showPanel(0); return false;" tabindex="9" value="Prev"/>
                    <input type="button" id="imageUpload" class="btn_small btn_blue nxtTab" tabindex="9" value="Next"/>
                  </div>
                </div>
              </li>
              </ul>
              </div>
              <div id="tab8" class="tab_common_class">
              <ul>-->
              <li>
              <h4>Lead Source Information</h4>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sfax">Event Type</label>
                  <div class="form_input">
                    <input name="event_type" id="event_type" value="<?php echo $event_type;?>" type="text" tabindex="1" class="large tipTop" title="Please enter event type"/>
                     <span id="event_type_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sfax">Lead Source</label>
                  <div class="form_input">
                    <input name="lead_source" id="lead_source" value="<?php echo $lead_source;?>" type="text" tabindex="1" class="large tipTop" title="Please enter lead source"/>
                     <span id="lead_source_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
             <li>
                <div class="form_grid_12">
                  <div class="form_input">
                  <a href="crmadmin/product/edit_product_form/<?php echo $propertyID;?>" class="tipLeft" title="Go to property page"><span class="btn_small btn_blue nxtTab">Back</span></a>
                  <input type="button" class="btn_small btn_blue prvTab" tabindex="9" value="Prev"/>
                  <!--<input type="submit" class="btn_small btn_blue prvTab" tabindex="9" value="Submit"/>-->
					<button type="submit" class="btn_small btn_blue" id="seoInfoValidation" tabindex="4"><span>Submit</span></button>
                  </div>
                </div>
              </li>
            </ul>
            </div>
               
         </form>
        </div>
      </div>
    </div>
  </div>
  <span class="clear"></span> </div>
</div>
<script type="text/javascript" language="javascript">
		function limitKeyword(limitCount, limitNum) {
		var limitField = document.getElementById("product_name");
			if (limitField.value.length > limitNum) {
				limitField.value = limitField.value.substring(0, limitNum);
				} else {
				limitCount.value = limitNum - limitField.value.length;
			}
		}
</script>
			
<script type="text/javascript">
$('#property_type').change(function() {
    var selected = $(this).val();
    if(selected == '1'){
      $('#property_sub_type_disp').show();
    }
    else{
      $('#property_sub_type_disp').hide();
    }
});
</script>

<?php 
$this->load->view('crmadmin/templates/footer.php');
include_once('googlemap.php');
?>
