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
						<h6>View Source Info</h6>
                        <div id="widget_tab">
              				<ul>
               					  <li><a href="#tab1" class="active_tab">Sourcer Info</a></li>
                                  <li><a href="#tab2">Property Management Info</a></li>
                                  <li><a href="#tab3">Title Company Info</a></li>
                                  <li><a href="#tab4">SDIRA Info</a></li>
                                  <li><a href="#tab5">Home Warranty Info</a></li>
                                  <li><a href="#tab6">Rental Guarantee Info</a></li>
                                  <li><a href="#tab7">Insurance Info</a></li>
                                  <li><a href="#tab8">Lead Source Info</a></li>
             				 </ul>
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
                    
                    
			  <div id="tab1" class="tab_common_class">
            <ul>
            <li>
            </li>
             <li>
             <input type="hidden" name="id" value="<?php echo $product_source_details->row()->property_id;?>" />
                <div class="form_grid_12">
                  <label class="field_title" for="sfirstname">Sourcer First Name</label>
                  <div class="form_input">
                    <?php echo $s_firstname;?>
                     <span id="s_firstname_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="slastname">Sourcer Last Name</label>
                  <div class="form_input">
                    <?php echo $s_lastname;?>
                     <span id="s_lastname_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="scompanyname">Sourcer Company Name</label>
                  <div class="form_input">
                   <?php echo $s_companyname;?>
                     <span id="s_companyname_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="saddress">Sourcer Address</label>
                  <div class="form_input">
                  <?php echo $s_address;?>
                     <span id="s_address_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sstate">Sourcer State</label>
                  <div class="form_input">
                    <?php echo $s_state;?>
                     <span id="s_state_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="szipcode">Sourcer zip code</label>
                  <div class="form_input">
                <?php echo $s_zipcode;?>
                     <span id="s_zipcode_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="scontact1">Sourcer Contact 1</label>
                  <div class="form_input">
                    <?php echo $s_contact1;?>
                     <span id="s_contact1_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="scontact2">Sourcer Contact 2</label>
                  <div class="form_input">
                   <?php echo $s_contact2;?>
                     <span id="s_contact2_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sphone1">Sourcer phone 1</label>
                  <div class="form_input">
                   <?php echo $s_phone1;?>
                     <span id="s_phone1_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sphone2">Sourcer phone 2</label>
                  <div class="form_input">
                    <?php echo $s_phone2;?>
                     <span id="s_phone2_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="semail">Sourcer email</label>
                  <div class="form_input">
                   <?php echo $s_email;?>
                     <span id="s_email_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sfax">Sourcer Fax</label>
                  <div class="form_input">
                    <?php echo $s_fax;?>
                     <span id="s_fax_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sprice">Sourcer price</label>
                  <div class="form_input">
                   <?php echo $s_price;?>
                     <span id="s_price_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <div class="form_input">
                   <a href="crmadmin/product/display_product_list" class="tipLeft" title="Go to property list"><span class="badge_style b_done">Back</span></a>
                  </div>
                </div>
              </li>
              </ul>
              </div>
              <div id="tab2" class="tab_common_class">
              <ul><li></li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="mname">Manager Name</label>
                  <div class="form_input">
                    <?php echo $m_name;?>
                     <span id="m_name_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="maddress">Manager Address</label>
                  <div class="form_input">
                  <?php echo $m_address;?>
                     <span id="m_address_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="mcity">Manager City</label>
                  <div class="form_input">
                   <?php echo $m_city;?>
                     <span id="m_city_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="mstate">Manager State</label>
                  <div class="form_input">
                   <?php echo $m_state;?>
                     <span id="m_state_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="mzipcode">Manager zip code</label>
                  <div class="form_input">
                    <?php echo $m_zipcode;?>
                     <span id="m_zipcode_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="mcontact1">Manager Contact 1</label>
                  <div class="form_input">
                 <?php echo $m_contact1;?>
                     <span id="m_contact1_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>

              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="mcontact2">Manager Contact 2</label>
                  <div class="form_input">
                    <?php echo $m_contact2;?>
                     <span id="m_contact2_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="mphone1">Manager phone 1</label>
                  <div class="form_input">
                    <?php echo $m_phone1;?>
                     <span id="m_phone1_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="mphone2">Manager phone 2</label>
                  <div class="form_input">
                   <?php echo $m_phone2;?>
                     <span id="m_phone2_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="memail">Manager email</label>
                  <div class="form_input">
                    <?php echo $m_email;?>
                     <span id="m_email_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="mfax">Manager Fax</label>
                  <div class="form_input">
                   <?php echo $m_fax;?>
                     <span id="m_fax_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="tname">Tenant Name</label>
                  <div class="form_input">
                    <?php echo $t_name;?>
                     <span id="t_name_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="leaseterm">Lease Term (# of months)</label>
                  <div class="form_input">
                  <?php echo $lease_term;?>
                     <span id="lease_term_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="section8">Section 8</label>
                  <div class="form_input">
                   <?php echo $section8;?>
                     <span id="section8_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
               <div class="form_grid_12">
                  <label class="field_title" for="mfee">Manager Fee $(%)</label>
                  <div class="form_input">
                   <?php echo $mfee;?>
                     <span id="mfee_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <div class="form_input">
                   <a href="crmadmin/product/display_product_list" class="tipLeft" title="Go to property list"><span class="badge_style b_done">Back</span></a>
                  </div>
                </div>
              </li>
              </ul>
              </div>
              <div id="tab3" class="tab_common_class">
              <ul>
              <li>
              
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sfirstname">Title Company Name</label>
                  <div class="form_input">
                   <?php echo $t_companyname;?> 
                     <span id="t_companyname_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="saddress">Title Company Address</label>
                  <div class="form_input">
                   <?php echo $t_address;?> 
                     <span id="t_address_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sstate">Title Company City</label>
                  <div class="form_input">
                   <?php echo $t_city;?>
                     <span id="t_city_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sstate">Title Company State</label>
                  <div class="form_input">
                  <?php echo $t_state;?>
                     <span id="t_state_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="szipcode">Title Company zip code</label>
                  <div class="form_input">
                  <?php echo $t_zipcode;?> 
                     <span id="t_zipcode_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="scontact1">Title Company Contact 1</label>
                  <div class="form_input">
                  <?php echo $t_contact1;?> 
                     <span id="t_contact1_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="scontact2">Title Company Contact 2</label>
                  <div class="form_input">
                  <?php echo $t_contact2;?> 
                     <span id="t_contact2_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sphone1">Title Company Phone 1</label>
                  <div class="form_input">
                  <?php echo $t_phone1;?> 
                     <span id="t_phone1_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sphone2">Title Company Phone 2</label>
                  <div class="form_input">
                  <?php echo $t_phone2;?>
                     <span id="t_phone2_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="semail">Title Company email</label>
                  <div class="form_input">
                  <?php echo $t_email;?> 
                     <span id="t_email_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sfax">Title Company Fax</label>
                  <div class="form_input">
                  <?php echo $t_fax;?> 
                     <span id="t_fax_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sprice">Projected Closing Date</label>
                  <div class="form_input">
                  <?php echo $projected_closing_date;?> 
                     <span id="projected_closing_date_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sprice">Closing Date</label>
                  <div class="form_input">
                  <?php echo $closing_date;?> 
                     <span id="closing_date_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
                <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sprice">Settlement Date</label>
                  <div class="form_input">
                  <?php echo $settlement_date;?>  
                     <span id="settlement_date_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <div class="form_input">
                   <a href="crmadmin/product/display_product_list" class="tipLeft" title="Go to property list"><span class="badge_style b_done">Back</span></a>
                  </div>
                </div>
              </li>
              </ul>
              </div>
              <div id="tab4" class="tab_common_class">
              <ul>
              <li>
              
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sfirstname">SDIRA Name</label>
                  <div class="form_input">
                   <?php echo $sd_firstname;?> 
                     <span id="sd_firstname_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="saddress">SDIRA Address</label>
                  <div class="form_input">
                  <?php echo $sd_address;?> 
                     <span id="sd_address_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sstate">SDIRA City</label>
                  <div class="form_input">
                  <?php echo $sd_city;?> 
                     <span id="sd_city_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sstate">SDIRA State</label>
                  <div class="form_input">
                  <?php echo $sd_state;?> 
                     <span id="sd_state_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="szipcode">SDIRA zip code</label>
                  <div class="form_input">
                  <?php echo $sd_zipcode;?> 
                     <span id="sd_zipcode_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="scontact1">SDIRA Contact 1</label>
                  <div class="form_input">
                  <?php echo $sd_contact1;?>  
                     <span id="sd_contact1_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="scontact2">SDIRA Contact 2</label>
                  <div class="form_input">
                  <?php echo $sd_contact2;?> 
                     <span id="sd_contact2_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sphone1">SDIRA phone 1</label>
                  <div class="form_input">
                  <?php echo $sd_phone1;?>
                     <span id="sd_phone1_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sphone2">SDIRA phone 2</label>
                  <div class="form_input">
                  <?php echo $sd_phone2;?>
                     <span id="sd_phone2_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="semail">SDIRA email</label>
                  <div class="form_input">
                  <?php echo $sd_email;?>
                     <span id="sd_email_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sfax">SDIRA Fax</label>
                  <div class="form_input">
                  <?php echo $sd_fax;?>
                     <span id="sd_fax_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>

              </li>
               <li>
                <div class="form_grid_12">
                  <div class="form_input">
                    <a href="crmadmin/product/display_product_list" class="tipLeft" title="Go to property list"><span class="badge_style b_done">Back</span></a>
                  </div>
                </div>
              </li>
              </ul>
              </div>
              <div id="tab5" class="tab_common_class">
              <ul>
              <li>
             
              </li>
                <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sfirstname">HW Name</label>
                  <div class="form_input">
                 <?php echo $hw_firstname;?>
                     <span id="hw_firstname_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="saddress">HW Address</label>
                  <div class="form_input">
                 <?php echo $hw_address;?>  
                     <span id="hw_address_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sstate">HW City</label>
                  <div class="form_input">
                  <?php echo $hw_city;?>
                     <span id="hw_city_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sstate">HW State</label>
                  <div class="form_input">
                 <?php echo $hw_state;?>
                     <span id="hw_state_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="szipcode">HW zip code</label>
                  <div class="form_input">
                 <?php echo $hw_zipcode;?>
                     <span id="hw_zipcode_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="scontact1">HW Contact 1</label>
                  <div class="form_input">
                <?php echo $hw_contact1;?> 
                     <span id="hw_contact1_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="scontact2">HW Contact 2</label>
                  <div class="form_input">
                <?php echo $hw_contact2;?>   
                     <span id="hw_contact2_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sphone1">HW phone 1</label>
                  <div class="form_input">
                 <?php echo $hw_phone1;?>   
                     <span id="hw_phone1_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sphone2">HW phone 2</label>
                  <div class="form_input">
                 <?php echo $hw_phone2;?>  
                     <span id="sd_phone2_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="semail">HW email</label>
                  <div class="form_input">
                <?php echo $hw_email;?> 
                     <span id="hw_email_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sfax">HW Fax</label>
                  <div class="form_input">
                 <?php echo $hw_fax;?> 
                     <span id="hw_fax_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sfax">Fee ($)</label>
                  <div class="form_input">
                  <?php echo $hw_fax;?>  
                     <span id="hw_fax_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <div class="form_input">
                  <a href="crmadmin/product/display_product_list" class="tipLeft" title="Go to property list"><span class="badge_style b_done">Back</span></a>
                  </div>
                </div>
              </li>
              </ul>
              </div>
              <div id="tab6" class="tab_common_class">
              <ul>
               <li>
             
              </li>
                <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sfirstname">Rental Guarantee  Name</label>
                  <div class="form_input">
                     <?php echo $rg_firstname;?> 
                   <span id="rg_firstname_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="saddress">Rental Guarantee  Address</label>
                  <div class="form_input">
                   <?php echo $rg_address;?>   
                     <span id="rg_address_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sstate">Rental Guarantee  City</label>
                  <div class="form_input">
                    <?php echo $rg_city;?> 
                     <span id="rg_city_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sstate">Rental Guarantee  State</label>
                  <div class="form_input">
                    <?php echo $rg_state;?>  
                     <span id="rg_state_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="szipcode">Rental Guarantee  zip code</label>
                  <div class="form_input">
                    <?php echo $rg_zipcode;?>  
                     <span id="rg_zipcode_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="scontact1">Rental Guarantee  Contact 1</label>
                  <div class="form_input">
                    <?php echo $rg_contact1;?> 
                     <span id="rg_contact1_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="scontact2">Rental Guarantee  Contact 2</label>
                  <div class="form_input">
                   <?php echo $rg_contact2;?>  
                     <span id="rg_contact2_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sphone1">Rental Guarantee  phone 1</label>
                  <div class="form_input">
                  <?php echo $rg_phone1;?>   
                     <span id="rg_phone1_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sphone2">Rental Guarantee  phone 2</label>
                  <div class="form_input">
                  <?php echo $rg_phone2;?>  
                     <span id="sd_phone2_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="semail">Rental Guarantee  email</label>
                  <div class="form_input">
                  <?php echo $rg_email;?>
                     <span id="rg_email_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sfax">Rental Guarantee  Fax</label>
                  <div class="form_input">
                  <?php echo $rg_fax;?> 
                     <span id="rg_fax_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sfax">Rental Guarantee Fee ($)</label>
                  <div class="form_input">
                  <?php echo $rg_fax;?>  
                     <span id="rg_fax_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <div class="form_input">
                    <a href="crmadmin/product/display_product_list" class="tipLeft" title="Go to property list"><span class="badge_style b_done">Back</span></a>
                  </div>
                </div>
              </li>
              </ul>
              </div>
              <div id="tab7" class="tab_common_class">
              <ul>
              <li>
              
              </li>
                <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sfirstname">Insurance  Name</label>
                  <div class="form_input">
                  <?php echo $in_firstname;?>   
                     <span id="in_firstname_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="saddress">Insurance  Address</label>
                  <div class="form_input">
                   <?php echo $in_address;?>  
                     <span id="in_address_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sstate">Insurance  City</label>
                  <div class="form_input">
                   <?php echo $in_city;?>   
                     <span id="in_city_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sstate">Insurance  State</label>
                  <div class="form_input">
                   <?php echo $in_state;?>   
                     <span id="in_state_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="szipcode">Insurance  zip code</label>
                  <div class="form_input">
                  <?php echo $in_zipcode;?>   
                     <span id="in_zipcode_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="scontact1">Insurance  Contact 1</label>
                  <div class="form_input">
                  <?php echo $in_contact1;?>   
                     <span id="in_contact1_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="scontact2">Insurance  Contact 2</label>
                  <div class="form_input">
                   <?php echo $in_contact2;?>   
                     <span id="in_contact2_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sphone1">Insurance  phone 1</label>
                  <div class="form_input">
                   <?php echo $in_phone1;?>   
                     <span id="in_phone1_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sphone2">Insurance  phone 2</label>
                  <div class="form_input">
                   <?php echo $in_phone2;?>  
                     <span id="sd_phone2_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="semail">Insurance  email</label>
                  <div class="form_input">
                   <?php echo $in_email;?>  
                     <span id="in_email_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sfax">Insurance  Fax</label>
                  <div class="form_input">
                  <?php echo $in_fax;?>   
                     <span id="in_fax_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sfax">Insurance Fee ($)</label>
                  <div class="form_input">
                   <?php echo $in_fee;?>   
                     <span id="in_fee_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <div class="form_input">
                   <a href="crmadmin/product/display_product_list" class="tipLeft" title="Go to property list"><span class="badge_style b_done">Back</span></a>
                  </div>
                </div>
              </li>
              </ul>
              </div>
              <div id="tab8" class="tab_common_class">
              <ul>
              <li>
              
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sfax">Event Type</label>
                  <div class="form_input">
                   <?php echo $event_type;?>
                     <span id="event_type_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sfax">Lead Source</label>
                  <div class="form_input">
                   <?php echo $lead_source;?> 
                     <span id="lead_source_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
             <li>
                <div class="form_grid_12">
                  <div class="form_input">
                  <a href="crmadmin/product/display_product_list" class="tipLeft" title="Go to property list"><span class="badge_style b_done">Back</span></a>
                  <!--<input type="submit" class="btn_small btn_blue prvTab" tabindex="9" value="Submit"/>-->
					<!--<button type="submit" class="btn_small btn_blue" id="seoInfoValidation" tabindex="4"><span>Submit</span></button>-->
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
