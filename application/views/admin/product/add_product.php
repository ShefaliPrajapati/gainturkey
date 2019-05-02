
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCMzMDYjFaRZ4z3rlY__4vYkNZkj8qX6qI&sensor=false"></script>

<?php
$this->load->view('admin/templates/header.php');
$this->load->view('admin/product/googlemap.php');
?>

<style>
#user_nav {
	width:auto !important;
}
.add_rental_list label {
    font-size: 1em !important;
	}
</style>

	<script type="text/javascript">
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

		
		
	</script>

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


/*$(document).ready(function(){
$("#generalInfo").click(function(){
		$('.tab_common').removeClass('active_tab');
		$('.tab_common_class').css('display','none');
		
		$("#property_id_warn").html('');
		
					 if(jQuery.trim($("#property_id").val()) == '')
						{
							$("#tab_common1").addClass("active_tab");
						 	$("#tab1").css("display","block"); 
							$("#property_id_warn").html('This field is required');
							$("#property_id").focus();
							return false;
						}
					else
						{
							TabbedPanels1.showPanel(1); 
						}
				});
				
/*$("#imageUpload").click(function(){
		$('.tab_common').removeClass('active_tab');
		$('.tab_common_class').css('display','none');
		
		$("#product_image_warn").html('');
		
					 if(jQuery.trim($("#product_image").val()) == '')
						{
							$("#tab_common2").addClass("active_tab");
						 	$("#tab2").css("display","block"); 
							$("#product_image_warn").html('This field is required');
							$("#product_image").focus();
							return false;
						}
					else
						{
							TabbedPanels1.showPanel(2); 
						}
				});
				
		
$("#attributes").click(function(){
		$('.tab_common').removeClass('active_tab');
		$('.tab_common_class').css('display','none');
		
		$("#bedrooms_warn").html('');
		$("#baths_warn").html('');
		$("#sq_feet_warn").html('');
		$("#built_warn").html('');
		$("#lot_size_warn").html('');
		
					 if(jQuery.trim($("#bedrooms").val()) == '')
						{
							$("#tab_common3").addClass("active_tab");
						 	$("#tab3").css("display","block"); 
							$("#bedrooms_warn").html('This field is required');
							$("#bedrooms").focus();
							return false;
						}
					 else  if(jQuery.trim($("#baths").val()) == '')
						{
						 	$("#tab_common3").addClass("active_tab");
						 	$("#tab3").css("display","block"); 
							$("#baths_warn").html('This field is required');
							$("#baths").focus();
							return false;
						}
					else  if(jQuery.trim($("#sq_feet").val()) == '')
						{
						 	$("#tab_common3").addClass("active_tab");
						 	$("#tab3").css("display","block"); 
							$("#sq_feet_warn").html('This field is required');
							$("#sq_feet").focus();
							return false;
						}
					else  if(jQuery.trim($("#built").val()) == '')
						{
						 	$("#tab_common3").addClass("active_tab");
						 	$("#tab3").css("display","block"); 
							$("#built_warn").html('This field is required');
							$("#built").focus();
							return false;
						}
					else  if(jQuery.trim($("#lot_size").val()) == '')
						{
						 	$("#tab_common3").addClass("active_tab");
						 	$("#tab3").css("display","block"); 
							$("#lot_size_warn").html('This field is required');
							$("#lot_size").focus();
							return false;
						}
					else
						{
							TabbedPanels1.showPanel(3); 
						}
				
				});

$("#priceInfo").click(function(){
		$('.tab_common').removeClass('active_tab');
		$('.tab_common_class').css('display','none');
		
		$("#member_price_warn").html('');
		$("#event_price_warn").html('');
		$("#monthly_rent_warn").html('');
		$("#hazard_ins_warn").html('');
		$("#property_tax_warn").html('');
		$("#management_expenses_warn").html('');
		$("#net_income_warn").html('');
		
					 if(jQuery.trim($("#member_price").val()) == '')
						{
							$("#tab_common4").addClass("active_tab");
						 	$("#tab4").css("display","block"); 
							$("#member_price_warn").html('This field is required');
							$("#member_price").focus();
							return false;
						}
					 else  if(jQuery.trim($("#event_price").val()) == '')
						{
						 	$("#tab_common4").addClass("active_tab");
						 	$("#tab4").css("display","block"); 
							$("#event_price_warn").html('This field is required');
							$("#event_price").focus();
							return false;
						}
					else  if(jQuery.trim($("#monthly_rent").val()) == '')
						{
						 	$("#tab_common4").addClass("active_tab");
						 	$("#tab4").css("display","block"); 
							$("#monthly_rent_warn").html('This field is required');
							$("#monthly_rent").focus();
							return false;
						}
					else  if(jQuery.trim($("#hazard_ins").val()) == '')
						{
						 	$("#tab_common4").addClass("active_tab");
						 	$("#tab4").css("display","block"); 
							$("#hazard_ins_warn").html('This field is required');
							$("#hazard_ins").focus();
							return false;
						}
					else  if(jQuery.trim($("#property_tax").val()) == '')
						{
						 	$("#tab_common4").addClass("active_tab");
						 	$("#tab4").css("display","block"); 
							$("#property_tax_warn").html('This field is required');
							$("#property_tax").focus();
							return false;
						}
					else  if(jQuery.trim($("#management_expenses").val()) == '')
						{
						 	$("#tab_common4").addClass("active_tab");
						 	$("#tab4").css("display","block"); 
							$("#management_expenses_warn").html('This field is required');
							$("#management_expenses").focus();
							return false;
						}
					else  if(jQuery.trim($("#net_income").val()) == '')
						{
						 	$("#tab_common4").addClass("active_tab");
						 	$("#tab4").css("display","block"); 
							$("#net_income_warn").html('This field is required');
							$("#net_income").focus();
							return false;
						}
					else
						{
							TabbedPanels1.showPanel(4); 
						}
				
				});
				
$("#addressInfo").click(function(){
		$('.tab_common').removeClass('active_tab');
		$('.tab_common_class').css('display','none');
		
		$("#post_code_warn").html('');
		
					 if(jQuery.trim($("#post_code").val()) == '')
						{
							$("#tab_common5").addClass("active_tab");
						 	$("#tab5").css("display","block"); 
							$("#post_code_warn").html('This field is required');
							$("#post_code").focus();
							return false;
						}
					else
						{
							TabbedPanels1.showPanel(5); 
						}
				});
				
$("#seoInfo").click(function(){
		$('.tab_common').removeClass('active_tab');
		$('.tab_common_class').css('display','none');
		
		$("#meta_title_warn").html('');
		
					 if(jQuery.trim($("#meta_title").val()) == '')
						{
							$("#tab_common6").addClass("active_tab");
						 	$("#tab6").css("display","block"); 
							$("#meta_title_warn").html('This field is required');
							$("#meta_title").focus();
							return false;
						}
					else
						{
							TabbedPanels1.showPanel(5); 
						}
				});


});

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
*/
</script>
<div id="content">
  <div class="grid_container">
    <div class="grid_12">
      <div class="widget_wrap">
        <div class="widget_top"> <span class="h_icon list"></span>
          <h6>Add Property</h6>
        
          <div id="widget_tab">
            <ul>
              <li><a href="#tab1" class="active_tab" >Images</a></li>
              <li><a href="#tab2" >General Information</a></li>
              <li><a href="#tab3" >Attributes</a></li>
              <li><a href="#tab4" >Price Information</a></li>
              <li><a href="#tab5" >Address</a></li>
              <li><a href="#tab6" >SEO</a></li>
           </ul>
          </div>
        </div>
        <div class="widget_content">
          <?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'addproperty_form', 'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/product/insertEditProduct',$attributes) 
					?>
               <div id="tab1" class="tab_common_class">
                   <ul>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="product_image">Property Image </label>
                     <div class="form_input controls imageAdd">
                     <div class="login_right1" style="margin:15px auto; float:none; width:65%; padding-right:389px;">
                     <div class="personal_text">
                               <table width="100%" border="0" cellpadding="2" cellspacing="0" class="member_ship">
                             	 <!--<tr>
                                  <td width="10%"> 
                                  <div class="field_login_imguse" style="width:183px;">
                                   <input style="float:left;" class="tipTop"  placeholder="Caption" name="imgtitle[]" type="text">
                                  </div></td>
                                 <td width="10%">
                                  <div class="field_login_imguse" style="width:183px;">
                                  <input style="float:left;" class="tipTop"  placeholder="Priority" name="imgPriority[]" type="text">
                                  </div>
                                  </td>
                                  </tr>
                                  <tr>&nbsp;&nbsp;
                                  </tr>-->
                                  <tr>
                                  <td width="10%">
                                  <div class="field_login_imguse">
                                   <!--<input style="float:left" type='file' name="product_image[]" multiple="multiple" id="product_image" value="Upload" onchange='Test1.UpdatePreview1(this)' class="required large multi tipTop" /><br /><br />-->
                                   
                                   
                                   
                                    <div class="dragndrop1"><button>Choose Image</button></div>
                                   
                                   
                                   <span id="product_image_warn" class="redfont" style="color:#F00;"></span>
                                   </div>
                                  </td>
                               <!--   <input type="file"  onblur="document.getElementById('moreUploadsLink').style.display = 'block';"  />
<div id="moreUploads"></div>
<div id="moreUploadsLink" style="display:none;"><a href="javascript:addFileInput();">Attach another File</a></div>-->
                                   <td width="10%"></td>
                                </tr>
                              </table>
                              </div>
                                </div>
                     <span class="redfont" style="color:#F00;"></span>
                    <!--<div id="addRemoveResetProd"  class="product-add-remove">
                       <span id="add" style="cursor: pointer;" class="icon32 icon-add" title="Add Image"><div class="btn_30_light">
									<a href="javascript:void(0);"><span class="icon add_co"></span><span class="btn_link">Add</span></a>
								</div></span>                       
                       <span id="remove" class="icon32 icon-cross" title="Remove"><div class="btn_30_light">
									<a href="javascript:void(0);"><span class="icon cancel_co"></span><span class="btn_link" >Remove</span></a>
								</div></span>
                </div>--><span class="redfont" style="color:#F00;"></span>
                    <span class="input_instruction green">Note: To upload multiple image, hold 'Control' button while choosing images<!--<p style="color:#FF0000"> Max. 10 images per upload.</p>--></span></div>
                </div>
              </li>
              <li>
              <div class="form_grid_12">
                  <div class="form_input">
                   <input type="button" name="general" id="generalInfo" class="btn_small btn_blue nxtTab" tabindex="9" value="Next"/>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <div id="tab2" class="tab_common_class">
            <ul>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="country">Status</label>
                  <div class="form_input">
                    <select class="chzn-select required" name="property_status" tabindex="-1" style="width: 375px; display: none;" data-placeholder="Please select the property status">
                      
                      <option value="Staging" >Staging</option>
                      <option value="Active" >Active</option>
                     <!-- <option value="Reserved" >Reserved</option>
                      <option value="Under Contract" >Under Contract</option>
                      <option value="Sold" >Sold</option>
                     <option value="Funded">Funded</option>
                     <option value="Cancelled">Cancelled</option>
                     <option value="Email">Email</option>-->
                    </select>
                  </div>
                </div>
              </li> 
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="full_remarks">Full Remarks </label>
                  <div class="form_input">
                    <textarea name="full_remarks" id="full_remarks" tabindex="2" style="width:370px;" class="tipTop mceEditor" title="Please enter the full remarks"></textarea>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="short_remarks">Short Remarks</label>
                  <div class="form_input">
                    <textarea name="short_remarks" id="short_remarks" tabindex="2" style="width:370px;" class="tipTop mceEditor" title="Please enter the short remarks"></textarea>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bedroom">Property ID<span class="req">*</span></label>
                  <div class="form_input">
                    <input id="property_id" type="text" tabindex="1" class="required large tipTop" name="property_id" title="Please enter the property id" onchange="prpIdCheck()" onkeyup="prpIdCheck()"  onblur="prpIdCheck()" />
                      <span id="property_id_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
                <input type="radio" style="display: none;" checked="checked" tabindex="11" name="display" id="display" class="publish_unpublish" value="both" />
<!--                <li>-->
<!--                    <div class="form_grid_12">-->
<!--                        <label class="field_title" for="admin_name">Display <span class="req">*</span></label>-->
<!--                        <div class="form_input">-->
<!--                            <div class="publish_unpublish">-->
<!--                                <input type="radio" tabindex="11" name="display" id="display" class="publish_unpublish" value="main" /> returnonrentals.com-->
<!--                                <input type="radio" tabindex="11" name="display" id="display" class="publish_unpublish" value="sub" /> preigrentals.com-->
<!--                                <input type="radio" tabindex="11" name="display" id="display" class="publish_unpublish" value="both" /> all-->
<!--                                <span id="display_warn" class="redfont" style="color:#F00;"></span>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </li>-->
              <li>
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
            <ul id="AttributeView">
                <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bedroom">Bedrooms<span class="req">*</span></label>
                  <div class="form_input">
                    <input id="bedrooms" type="text" tabindex="1" class="required large tipTop" name="bedrooms" title="Please enter number of bedrooms" />
                      <span id="bedrooms_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li> 
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bathroom">Baths<span class="req">*</span></label>
                  <div class="form_input">
                    <input id="baths" type="text" tabindex="1" class="required large tipTop" name="baths" title="Please enter number of baths" />
                      <span id="baths_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li> 
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bathroom">Square footage<span class="req">*</span></label>
                  <div class="form_input">
                   	<input id="sq_feet" type="text" tabindex="1" class="required large tipTop" name="sq_feet" title="Please enter the rental area(in sq feet)" />
                      <span id="sq_feet_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li> 
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="built">Year built<span class="req">*</span></label>
                  <div class="form_input">
                   	<input id="built" type="text" tabindex="1" class="required large tipTop" name="built" title="Please enter the rental built year" />
                      <span id="built_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li> 
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="price">Property Type</label>
                  <div class="form_input">
                  <select id="property_type" name="property_type" onchange="SelectSubType(this.value);">
                  <?php foreach($Property_Type->result() as $PropertyType){ 
				  			
                		 echo '<option value="'.$PropertyType->id.'">'.$PropertyType->attr_name.'</option>';
						 }
					?>
                   </select>
                  </div>
                </div>
              </li>
              <li id="property_sub_type_disp">
                <div class="form_grid_12">
                  <label class="field_title" for="property_sub_type">Property Sub Type</label>
                  <div class="form_input">
                  <select id="property_sub_type" name="property_sub_type">
                  	<option value="0" selected="selected">Select</option>
                  <?php				  
				  foreach($Property_Sub_Type->result() as $PropertySubType){ 
				  		
                		 echo '<option value="'.$PropertySubType->id.'">'.$PropertySubType->subattr_name.'</option>';
					 } ?>
                   </select>
                  </div>
                </div>
              </li> 
             
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bathroom">Lot size<span class="req">*</span></label>
                  <div class="form_input">
                   	<input id="lot_size" type="text" tabindex="1" class="required large tipTop" name="lot_size" title="Please enter the lot size" />
                      <span id="lot_size_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li> 
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bathroom">Featured?</label>
                  <div class="form_input">
                  <input type="radio" name="featured" value="Yes" title="Please choose featured option" /> Yes 
                  <input type="radio" name="featured" checked="checked" value="No" title="Please choose featured option" /> No
                  </div>
                </div>
              </li> 
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bathroom">Financing Available</label>
                  <div class="form_input">
                  <input type="radio" name="financing" value="Yes" title="Please choose financing option" /> Yes 
                  <input type="radio" checked="checked" name="financing" value="No" title="Please choose financing option" /> No
                  </div>
                </div>
              </li> 
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bathroom">Cash Only</label>
                  <div class="form_input">
                  <input type="radio" name="cash_only" value="Yes" title="Please choose cash option" /> Yes
                  <input type="radio" checked="checked" name="cash_only" value="No" title="Please choose cash option" /> No 
                  </div>
                </div>
              </li> 
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bathroom">Trust Deed</label>
                  <div class="form_input">
                  <input type="radio" name="trust_deed" value="Yes" title="Please choose cash option" /> Yes
                  <input type="radio" checked="checked" name="trust_deed" value="No" title="Please choose cash option" /> No 

                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <div class="form_input">
                    <input type="button" class="btn_small btn_blue prvTab" tabindex="9" value="Prev"/>
                    <input type="button" name="attributes" id="attributes" class="btn_small btn_blue nxtTab" tabindex="9" value="Next"/>
                 </div>
                </div>
              </li>
            </ul>
          </div>
          <div id="tab4" class="tab_common_class">
            <ul id="AttributeView">
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="price">Member Price ($)<span class="req">*</span></label>
                  <div class="form_input">
                    <input type="text" name="member_price" id="member_price" tabindex="9" class="required large tipTop" title="Please enter the member price" />
                    <span id="member_price_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="price">Event only Price ($)<span class="req">*</span></label>
                  <div class="form_input">
                    <input type="text" name="event_price"   id="event_price" tabindex="9" class="required large tipTop" title="Please enter the event only price" />
                    <span id="event_price_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="price">Monthly rental PMT ($)<span class="req">*</span></label>
                  <div class="form_input">
                    <input type="text" name="monthly_rent" id="monthly_rent" tabindex="9" class="required large tipTop" title="Please enter the monthly rental" onblur="MonthlyRent()" />
                    <span id="monthly_rental_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="price">Annual rental ($)<span class="req">*</span></label>
                  <div class="form_input">
                    <input type="text" name="annual_Rent" id="annual_Rent" tabindex="9" class="required large tipTop" title="Please enter the annual rental" />
                    <span id="annual_Rental_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="price">Estimated* Annual hazard insurance ($)<span class="req">*</span></label>
                  <div class="form_input">
                    <input type="text" name="hazard_ins"  id="hazard_ins" tabindex="9" class="required large tipTop" title="Please enter the estimated annual hazard insurance" />
                    <span id="hazard_ins_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="price">Estimated property tax ($)<span class="req">*</span></label>
                  <div class="form_input">
                    <input type="text" name="property_tax"  id="property_tax" tabindex="9" class="required large tipTop" title="Please enter the estimated property tax" />
                    <span id="property_tax_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="price">Property management exp ($)<span class="req">*</span></label>
                  <div class="form_input">
                    <input type="text" name="management_expenses" id="management_expenses" tabindex="9" class="required large tipTop" title="Please enter the property management expenses" />
                    <span id="mgmnt_expenses_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="utilities">Annual Utilities Exp ($)<span class="req">*</span></label>
                  <div class="form_input">
                    <input type="text" name="utilities" id="utilities" tabindex="9" class="required large tipTop" title="Please enter the utilities" />
                    <span id="utilities_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="price">Estimated net income ($)<span class="req">*</span></label>
                  <div class="form_input">
                    <input type="text" name="net_income"  id="net_income" tabindex="9" class="required large tipTop" title="Please enter the estimated net income" />
                    <span id="net_income_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
         		</li>
              <li>
                <div class="form_grid_12">
                  <div class="form_input">
                    <input type="button" class="btn_small btn_blue prvTab" tabindex="9" value="Prev"/>
                    <input type="button" id="priceInfo" class="btn_small btn_blue nxtTab" tabindex="9" value="Next"/>
                  </div>
                </div>
              </li>
                
             
            </ul>
          </div>
          <div id="tab5" class="tab_common_class">
            <ul id="AttributeView">
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="address">Address</label>
                  <div class="form_input">
                    <textarea type="text" name="address" onblur="return geocode();" id="address" tabindex="3" style="width:370px;" class="large tipTop" title="Enter address"></textarea>
                  </div>
                </div>
              </li>
           <!--  <li>
                <div class="form_grid_12">
                  <label class="field_title" for="country">Country</label>
                  <div class="form_input">
                    <select class="chzn-select required" onchange="javascript:loadCountryListValues(this)" name="country" tabindex="-1" style="width: 375px; display: none;" data-placeholder="Please select the country name">
                      <?php foreach ($RentalCountry->result() as $row)
					  		{ ?>
                      <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="state">State</label>
                  <div class="form_input" id="listCountryCnt">
                   <select class="chzn-select required" name="state" onchange="javascript:loadStateListValues(this)" tabindex="-1" style="width: 375px; display: none;" data-placeholder="Please select the state name">
                      <?php foreach ($RentalState->result() as $row)
					  		{ ?>
                      <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>
              </li>-->
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="state">City<span class="req">*</span></label>
                  <div class="form_input" id="listCountryCnt">
                  <input type="text" name="city" id="city"  onblur="return geocode();" tabindex="8" class="required large tipTop" title="Please enter the city name" maxlength="16" />
                  <span id="city_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li> 
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="state">State<span class="req">*</span></label>
                  <div class="form_input" id="listCountryCnt">
                  <select name="state" id="state" onblur="return geocode();" title="Please enter the post code">
                  	<?php foreach($stateDetails->result() as $state){ 
					echo '<option value="'.$state->seourl.'">'.ucwords(str_replace("-"," ",$state->seourl)).'</option>';
                     } ?>
                   </select>
                   <!-- <input type="text" name="state" id="state"  onblur="return geocode();" tabindex="8" class="large tipTop" title="Please enter the post code" />-->
                    <span id="city_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
             <!-- <li>
                <div class="form_grid_12">
                  <label class="field_title" for="city">City</label>
                  <div class="form_input" id="listStateCnt">
                    <select class="chzn-select required" name="city" tabindex="-1" style="width: 375px; display: none;" data-placeholder="Please select the city name">
                      <?php foreach ($RentalCity->result() as $row)
					  		{ ?>
                      <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>
              </li>-->
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="post_code">Zip<span class="req">*</span></label>
                  <div class="form_input">
                    <input type="text" name="post_code"  onblur="return geocode();" id="post_code" tabindex="8" class="required large tipTop" title="Please enter the post code" />
                    <span id="post_code_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              
              <li>
                <div class="form_grid_12">
                  <div class="team_location">
                    <label class="field_title" for="attribute_name">Set location Map <br />
                   <!-- <small style="color:#990000; font-size:9px; text-transform:capitalize;">Eg:(Morocco discovery holidays, Marrakesh, Morocco)</small>--></label>
                    <div class="form_input">
                    <label class="text_design_bold"></label>
                    <span class="input_instruction green">Note: Drag pin to correct location if not shown accurately</span>   
                             <fieldset class="gllpLatlonPicker">
                               <!-- <input type="text" class="gllpSearchField" value="">-->
                                <input type="button" class="gllpSearchButton" value="search">
                                <br/><br/>
                                <div class="gllpMap">Google Maps</div>
                                <br/>
                                    <input type="hidden" name="latitude" id="latitude" value="31.6333333" class="gllpLatitude" />
                                    <input type="hidden" name="longitude" id="longitude" value="-8" class="gllpLongitude" />
                                zoom: <input type="text" class="gllpZoom" value="13"/>
                                <input type="button" class="gllpUpdateButton" value="update map">
                                <br/>
                            </fieldset>
                            
                    </div>
                  </div>
                </div>
              </li>
              
              
              <!-- <input type="hidden" name="googlelat" id="googlelat" value="39.0120168225808" />
	               <input type="hidden" name="googlelng"  id="googlelng" value="13.842212855815887" />
                   <input type="hidden" name="q" id="geocodeInput">
                   <input type="hidden" name="output" value="html">

 <input type="button" value="Zoom to place" name="Reload" id="Reload">
              <li>
                <div class="form_grid_12">
                  <div class="team_location">
                    <label class="field_title" for="attribute_name">Set location Map <br /></label>
                    <div class="form_input">
                             <div id="gmap">
       
        </div>
        <div id="crosshair"></div>
          <div id="ft" style="display:none;">
        <p><strong>Latitude, Longitude:</strong> <span id="latlon"></span></p>
        <p><strong>WKT:</strong> <span id="wkt"></span></p>
        <p><strong>Google Maps zoom level:</strong> <span id="zoom"></span></p>
       
    </div>
                     <!-- <input type="hidden" name="zoom" id="zoom" value="6" />--
                    </div>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="post_code">Latitude</label>
                  <div class="form_input">
                   <input type="text" name="latitude" id="latitude"  class="input_text inputwidth2" readonly="readonly"/>
                    </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="post_code">Longitude</label>
                  <div class="form_input">
                   <input type="text" name="longitude" id="longitude"  class="input_text inputwidth2" readonly="readonly"/>
                    <span id="postal_code_warn" class="redfont" style="color:#F00;"></span> </div>
                </div>
              </li>-->
              <!-- <li>
                <div class="form_grid_12">
                  <div class="team_location">
                    <label class="field_title" for="attribute_name">Set location Map <br />
                    <small style="color:#990000; font-size:9px; text-transform:capitalize;">enter only city name Eg:(new york, washington)</small></label>
                    <div class="form_input">
                      <input id="test-address" type="text" tabindex="1" class="required large tipTop" title="Please enter the property location" value=""/>
                      <span id="test-address_warn" class="redfont" style="color:#F00;"></span> <br />
                      <br />
                      <div id="test" class="gmap3"></div>
                      <br />
                      <input type="hidden" name="latitude" id="lat" value="31.6333333"/>
                      <input type="hidden" name="longitude" id="lng" value="-8" />
                    
                    </div>
                  </div>
                </div>
              </li>-->
          
              <li>
              <div class="form_grid_12">
                  <div class="form_input">
                    <input type="button" class="btn_small btn_blue prvTab" tabindex="9" value="Prev"/>
                    <input type="button" id="addressInfo" class="btn_small btn_blue nxtTab" tabindex="9" value="Next"/>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <div id="tab6" class="tab_common_class">
            <ul>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="meta_title">Meta Title <span class="req">*</span></label>
                  <div class="form_input">
                    <input name="meta_title" id="meta_title" type="text"  tabindex="1" class="required large tipTop" title="Please enter the page meta title"/>
                    <span id="meta_title_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="meta_tag">Meta Keyword</label>
                  <div class="form_input">
                    <textarea name="meta_keyword" id="meta_keyword"  tabindex="2" class="large tipTop" title="Please enter the page meta keyword"></textarea>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="meta_description">Meta Description</label>
                  <div class="form_input">
                    <textarea name="meta_description" id="meta_description" tabindex="3" class="large tipTop" title="Please enter the meta description"></textarea>
                  </div>
                </div>
              </li>
             
            <span id="common_warn" class="redfont" style="color:#F00;"></span>
              <li>
                <div class="form_grid_12">
                  <div class="form_input">
                  <input type="button" class="btn_small btn_blue prvTab" tabindex="9" value="Prev"/>
                  <input type="submit" class="btn_small btn_blue prvTab" tabindex="9" value="Save" name="submit_button"/>
					<button type="submit" name="submit_button" value="savencont" class="btn_small btn_blue" id="seoInfoValidation" tabindex="4"><span>Save and continue to source information page</span></button>
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
$(function() {
			$("#addproperty_form").submit(function(){
				// var email = $('#vendor_email').val();
				//alert('');
			
				 $("#property_id_warn").html('');
				 $("#display_warn").html('');
				 $("#bedrooms_warn").html('');
				  $("#baths_warn").html('');
				 $("#sq_feet_warn").html('');
				  $("#built_warn").html('');
				 $("#lot_size_warn").html('');
				  $("#member_price_warn").html('');
				 $("#event_price_warn").html('');
				  $("#monthly_rent_warn").html('');
				 $("#hazard_ins_warn").html('');
				 $("#property_tax_warn").html('');
				 $("#management_expenses_warn").html('');
				  $("#utilities_warn").html('');
				 $("#net_income_warn").html('');
				 $("#state_warn").html('');
				  $("#city_warn").html('');
				 $("#post_code_warn").html('');
				 $("#meta_title_warn").html('');
				
				
					
					if(jQuery.trim($("#property_id").val()) == ''){
					  
					  	$("#tab_common2").addClass("active_tab");
						//$("#tab1").css("display","block");
						$("#property_id_warn").html('Property id is required');
						$("#common_warn").html('Property id is required');
						$("#property_id").focus();
						return false;
						
					}else if(jQuery.trim($("#display").val()) == ''){
						
						$("#tab_common2").addClass("active_tab");
						//$("#tab3").css("display","block");
						$("#display_warn").html('Please choose dispaly option');
						$("#common_warn").html('Please choose dispaly option');
						$("#display").focus();
						return false;
					}
					else if(jQuery.trim($("#bedrooms").val()) == ''){
						
						$("#tab_common3").addClass("active_tab");
						//$("#tab3").css("display","block");
						$("#bedrooms_warn").html('Bedrooms is required');
						$("#common_warn").html('Bedrooms field is required');
						$("#bedrooms").focus();
						return false;
					}
					else if(jQuery.trim($("#baths").val()) == ''){
						
						$("#tab_common3").addClass("active_tab");
						//$("#tab3").css("display","block");
						$("#baths_warn").html('Baths is required');
						$("#common_warn").html('Baths field is required');
						$("#baths").focus();
						return false;
					}
					else if(jQuery.trim($("#sq_feet").val()) == ''){
						
						$("#tab_common3").addClass("active_tab");
						//$("#tab3").css("display","block");
						$("#sq_feet").html('Sq_feet is required');
						$("#common_warn").html('Sq_feet field is required');
						$("#sq_feet_warn").focus();
						return false;
					}
					else if(jQuery.trim($("#built").val()) == ''){
						
						$("#tab_common3").addClass("active_tab");
						//$("#tab3").css("display","block");
						$("#built_warn").html('This field is required');
						$("#common_warn").html(' Year built field is required');
						$("#built").focus();
						return false;
					}else if(jQuery.trim($("#lot_size").val()) == ''){
						
						$("#tab_common3").addClass("active_tab");
						//$("#tab3").css("display","block");
						$("#lot_size_warn").html('This field is required');
						$("#common_warn").html('Lot Size field is required');
						$("#lot_size").focus();
						return false;
					}else if(jQuery.trim($("#member_price").val()) == ''){
						
						$("#tab_common4").addClass("active_tab");
						//$("#tab4").css("display","block");
						$("#member_price_warn").html('This field is required');
						$("#common_warn").html('Member price field is required');
						$("#member_price").focus();
						return false;
					}else if(jQuery.trim($("#event_price").val()) == ''){
						
						$("#tab_common4").addClass("active_tab");
						//$("#tab4").css("display","block");
						$("#event_price_warn").html('This field is required');
						$("#common_warn").html('Event price field is required');
						$("#event_price").focus();
						return false;
					}else if(jQuery.trim($("#monthly_rent").val()) == ''){
						
						$("#tab_common4").addClass("active_tab");
						//$("#tab4").css("display","block");
						$("#monthly_rent_warn").html('This field is required');
						$("#common_warn").html('Monthly Rent field is required');
						$("#monthly_rent").focus();
						return false;
					}else if(jQuery.trim($("#annual_Rent").val()) == ''){
						
						$("#tab_common4").addClass("active_tab");
						//$("#tab4").css("display","block");
						$("#annual_Rent_warn").html('This field is required');
						$("#common_warn").html('Annual Rent field is required');
						$("#annual_Rent").focus();
						return false;
					}else if(jQuery.trim($("#hazard_ins").val()) == ''){
						
						$("#tab_common4").addClass("active_tab");
						//$("#tab4").css("display","block");
						$("#hazard_ins_warn").html('This field is required');
						$("#common_warn").html('Hazard insurance field is required');
						$("#hazard_ins").focus();
						return false;
					}else if(jQuery.trim($("#property_tax").val()) == ''){
						
						$("#tab_common4").addClass("active_tab");
						//$("#tab4").css("display","block");
						$("#property_tax_warn").html('This field is required');
						$("#common_warn").html('property tax field is required');
						$("#property_tax").focus();
						return false;
					}else if(jQuery.trim($("#management_expenses").val()) == ''){
						
						$("#tab_common4").addClass("active_tab");
						//$("#tab4").css("display","block");
						$("#management_expenses_warn").html('This field is required');
						$("#common_warn").html('Management expenses field is required');
						$("#management_expenses").focus();
						return false;
					}else if(jQuery.trim($("#utilities").val()) == ''){
						
						$("#tab_common4").addClass("active_tab");
						//$("#tab4").css("display","block");
						$("#utilities_warn").html('This field is required');
						$("#common_warn").html('Utilities exp field is required');
						$("#utilities").focus();
						return false;
					}else if(jQuery.trim($("#net_income").val()) == ''){
						
						$("#tab_common4").addClass("active_tab");
						//$("#tab4").css("display","block");
						$("#net_income_warn").html('This field is required');
						$("#common_warn").html('Net income field is required');
						$("#net_income").focus();
						return false;
					}else if(jQuery.trim($("#state").val()) == ''){
						
						$("#tab_common5").addClass("active_tab");
						//$("#tab5").css("display","block");
						$("#state_warn").html('This field is required');
						$("#common_warn").html('State field is required');
						$("#state").focus();
						return false;
					}else if(jQuery.trim($("#city").val()) == ''){
						
						$("#tab_common5").addClass("active_tab");
						//$("#tab5").css("display","block");
						$("#city_warn").html('This field is required');
						$("#common_warn").html('City field is required');
						$("#city").focus();
						return false;
					}else if(jQuery.trim($("#post_code").val()) == ''){
						
						$("#tab_common5").addClass("active_tab");
						//$("#tab5").css("display","block");
						$("#post_code_warn").html('This field is required');
						$("#common_warn").html('Post code field is required');
						$("#post_code").focus();
						return false;
					}else if(jQuery.trim($("#meta_title").val()) == ''){
						
						$("#tab_common6").addClass("active_tab");
						//$("#tab6").css("display","block");
						$("#meta_title_warn").html('This field is required');
						$("#meta_title").focus();
						return false;
					}
					else
					{	
					      	$("#addproperty_form").submit();
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
	 
	 
function removeError(idval){
	$("#"+idval+"_warn").html('');}
</script>
<!--<script type="text/javascript">
var upload_number = 2;
function addFileInput() {
 	var d = document.createElement("div");
 	var file = document.createElement("input");
 	file.setAttribute("type", "file");
 	file.setAttribute("name", "attachment"+upload_number);
 	d.appendChild(file);
 	document.getElementById("moreUploads").appendChild(d);
 	upload_number++;
}
</script>-->
<script type="text/javascript">
$("#multipleupload").uploadFile({
url:"http://hayageek.com/examples/jquery/ajax-multiple-file-upload/upload.php",
multiple:true,
fileName:"myfile"
});
</script>
<style>
#dragandrophandler
{
border:2px dotted #0B85A1;
width:400px;
color:#92AAB0;
text-align:left;vertical-align:middle;
padding:10px 10px 10 10px;
margin-bottom:10px;
font-size:200%;
}
</style>
<script type="text/javascript">
var obj = $("#dragandrophandler");
obj.on('dragenter', function (e)
{
    e.stopPropagation();
    e.preventDefault();
    $(this).css('border', '2px solid #0B85A1');
});
obj.on('dragover', function (e)
{
     e.stopPropagation();
     e.preventDefault();
});
obj.on('drop', function (e)
{
 
     $(this).css('border', '2px dotted #0B85A1');
     e.preventDefault();
     var files = e.originalEvent.dataTransfer.files;
 
     //We need to send dropped files to Server
     handleFileUpload(files,obj);
});
</script>

<script type="text/javascript">
function SelectSubType(Id)
{ 
		$.ajax(
		{
				type: 'POST',
				url: baseURL+'admin/product/get_sub_type_details',
				data:{'typeId':Id},
				success: function(data) 
				{
					//alert(data);return false;
					$("#property_sub_type_disp").html(data);
					//window.location.reload();
					
					
				}
				
			});
	
}
function prpIdCheck(){ 
		var propID = $('#property_id').val();
		$.ajax({
				type: 'POST',
				url: baseURL+'admin/product/prop_id_check_dub',
				data:{'propId':propID},
				success: function(data) 
				{
					//alert(data);return false;
					if(data==1){
						$("#property_id_warn").html('Property Id Already Exists.');
						$('#property_id').val('');
					}else{
						$("#property_id_warn").html('');
					}
					
				}
				
			});
}
</script>

	<!-- CSS and JS for our code -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/site/jquery-gmaps-latlon-picker.css"/>
	<script src="<?php echo base_url(); ?>js/site/jquery-gmaps-latlon-picker.js"></script>
<?php 
$this->load->view('admin/templates/footer.php');
include_once('googlemap.php');
?>
