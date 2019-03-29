<?php
$this->load->view('admin/templates/header.php');

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
	
/*$(function() { 		

$("#generalInfo").click(function(){
		$('.tab_common').removeClass('active_tab');
		$('.tab_common_class').css('display','none');
					 if(jQuery.trim($("#property_id").val()) == '')
						{
						
							$("#tab_common1").addClass("active_tab");
						 	$("#tab1").css("display","block"); 
							$("#property_id_warn").html('');
							$("#property_id_warn").html('This field is required');
							$("#property_id").focus();
							
							return false;
						}
						else{
				TabbedPanels1.showPanel(3); 
				}
				});
				
				
				
				$("#priceInfo").click(function(){
		$('.tab_common').removeClass('active_tab');
		$('.tab_common_class').css('display','none');
					 if(jQuery.trim($("#member_price").val()) == '')
						{
						
							$("#tab_common1").addClass("active_tab");
						 	$("#tab1").css("display","block"); 
							$("#member_price_warn").html('');
							$("#member_price_warn").html('This field is required');
							$("#member_price").focus();
							
							return false;
						}else if(jQuery.trim($("#event_price").val()) == '')
						{
						
							$("#tab_common1").addClass("active_tab");
						 	$("#tab1").css("display","block"); 
							$("#event_price_warn").html('');
							$("#event_price_warn").html('This field is required');
							$("#event_price").focus();
							
							return false;
						}else if(jQuery.trim($("#monthly_rent").val()) == '')
						{
						
							$("#tab_common1").addClass("active_tab");
						 	$("#tab1").css("display","block"); 
							$("#monthly_rent_warn").html('');
							$("#monthly_rent_warn").html('This field is required');
							$("#monthly_rent").focus();
							
							return false;
						}else if(jQuery.trim($("#annual_Rent").val()) == '')
						{
						
							$("#tab_common1").addClass("active_tab");
						 	$("#tab1").css("display","block"); 
							$("#annual_Rent_warn").html('');
							$("#annual_Rent_warn").html('This field is required');
							$("#annual_Rent").focus();
							
							return false;
						}else if(jQuery.trim($("#hazard_ins").val()) == '')
						{
						
							$("#tab_common1").addClass("active_tab");
						 	$("#tab1").css("display","block"); 
							$("#hazard_ins_warn").html('');
							$("#hazard_ins_warn").html('This field is required');
							$("#hazard_ins").focus();
							
							return false;
						}else if(jQuery.trim($("#property_tax").val()) == '')
						{
						
							$("#tab_common1").addClass("active_tab");
						 	$("#tab1").css("display","block"); 
							$("#property_tax_warn").html('');
							$("#property_tax_warn").html('This field is required');
							$("#property_tax").focus();
							
							return false;
						}else if(jQuery.trim($("#management_expenses").val()) == '')
						{
						
							$("#tab_common1").addClass("active_tab");
						 	$("#tab1").css("display","block"); 
							$("#management_expenses_warn").html('');
							$("#management_expenses_warn").html('This field is required');
							$("#management_expenses").focus();
							
							return false;
						}else if(jQuery.trim($("#utilities").val()) == '')
						{
						
							$("#tab_common1").addClass("active_tab");
						 	$("#tab1").css("display","block"); 
							$("#utilities_warn").html('');
							$("#utilities_warn").html('This field is required');
							$("#utilities").focus();
							
							return false;
						}else if(jQuery.trim($("#net_income").val()) == '')
						{
						
							$("#tab_common1").addClass("active_tab");
						 	$("#tab1").css("display","block"); 
							$("#net_income_warn").html('');
							$("#net_income_warn").html('This field is required');
							$("#net_income").focus();
							
							return false;
						}

						else{
				TabbedPanels1.showPanel(5); 
				}
				});
				
				
				$("#seoInfo").click(function(){
		$('.tab_common').removeClass('active_tab');
		$('.tab_common_class').css('display','none');
					 if(jQuery.trim($("#meta_title").val()) == '')
						{
							$("#tab_common1").addClass("active_tab");
						 	$("#tab1").css("display","block"); 
							$("#meta_title_warn").html('');
							$("#meta_title_warn").html('This field is required');
							$("#meta_title").focus();
							
							return false;
						}
						else{
				TabbedPanels1.showPanel(5); 
				}
				});
				
				
		$("#addressInfo").click(function(){
		$('.tab_common').removeClass('active_tab');
		$('.tab_common_class').css('display','none');
					 if(jQuery.trim($("#post_code").val()) == '')
						{
						
							$("#tab_common1").addClass("active_tab");
						 	$("#tab1").css("display","block"); 
							$("#post_code_warn").html('');
							$("#post_code_warn").html('This field is required');
							$("#post_code").focus();
							
							return false;
						}
						else{
				TabbedPanels1.showPanel(6); 
				}
				});
				
				
		$("#attributes").click(function(){
		$('.tab_common').removeClass('active_tab');
		$('.tab_common_class').css('display','none');
					 if(jQuery.trim($("#bedrooms").val()) == '')
						{
						
							$("#tab_common1").addClass("active_tab");
						 	$("#tab1").css("display","block"); 
							$("#bedrooms_warn").html('');
							$("#bedrooms_warn").html('This field is required');
							$("#bedrooms").focus();
							
							return false;
						}else if(jQuery.trim($("#baths").val()) == ''){
						
							$("#tab_common1").addClass("active_tab");
						 	$("#tab1").css("display","block"); 
							$("#baths_warn").html('');
							$("#baths_warn").html('This field is required');
							$("#baths").focus();
							
							return false;
						}else if(jQuery.trim($("#sq_feet").val()) == ''){
						
							$("#tab_common1").addClass("active_tab");
						 	$("#tab1").css("display","block"); 
							$("#sq_feet_warn").html('');
							$("#sq_feet_warn").html('This field is required');
							$("#sq_feet").focus();
							
							return false;
						
						}else if(jQuery.trim($("#built").val()) == ''){
						
							$("#tab_common1").addClass("active_tab");
						 	$("#tab1").css("display","block"); 
							$("#built_warn").html('');
							$("#built_warn").html('This field is required');
							$("#built").focus();
							
							return false;
						
						}else if(jQuery.trim($("#lot_size").val()) == ''){
						
							$("#tab_common1").addClass("active_tab");
						 	$("#tab1").css("display","block"); 
							$("#lot_size_warn").html('');
							$("#lot_size_warn").html('This field is required');
							$("#lot_size").focus();
							
							return false;
						
						}
						else{
				TabbedPanels1.showPanel(4); 
				}
				});
				
				
			$("#property_id,#bedrooms").blur(function()
			{				
				$("#"+this.id+"_warn").html('');

			});
			});
			*/
				
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
	/*	*/
	
		/*	var atLeastOneIsChecked = $('input[name="list_value[]"]:checked').length;
			if(atLeastOneIsChecked == 0)
				{
					$("#checkbox_warn").html('');
					$("#checkbox_warn").html('This field is required');
					$('list_value').focus();
				return false;
				}
			else{
				TabbedPanels1.showPanel(3); 
				}
				});*/
    </script>





<script language="javascript">
function viewAttributes(Val){

	if(Val == 'show'){
		document.getElementById('AttributeView').style.display = 'block';
	}else{
		document.getElementById('AttributeView').style.display = 'none';
	}
}
 

$(function() {
$("#addproperty_form").submit(function(){	
			
		$("#property_id_warn").html('');
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
		$("#post_code_warn").html('');
		$("#meta_title_warn").html('');
		
		
					 if(jQuery.trim($("#property_id").val()) == '')
						{
							$("#tab_common3").addClass("active_tab");
						 	$("#tab3").css("display","block");
							$("#property_id_warn").html('This field is required');
							$("#property_id").focus();
							return false;
						}
					else if(jQuery.trim($("#bedrooms").val()) == '')
						{
							$("#tab_common3").addClass("active_tab");
						 	$("#tab3").css("display","block"); 
							$("#bedrooms_warn").html('This field is required');
							$("#bedrooms").focus();
							return false;
						}
					else if(IsNumber(jQuery.trim($("#bedrooms").val())) == false)
						{
							$("#tab_common3").addClass("active_tab");
						 	$("#tab3").css("display","block"); 
							$("#bedrooms_warn").html('Please enter only number');
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
					else if(IsNumber(jQuery.trim($("#baths").val())) == false)
						{
						 	$("#tab_common3").addClass("active_tab");
						 	$("#tab3").css("display","block"); 
							$("#baths_warn").html('Please enter only number');
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
					else if(IsNumber(jQuery.trim($("#sq_feet").val())) == false)
						{
						 	$("#tab_common3").addClass("active_tab");
						 	$("#tab3").css("display","block"); 
							$("#sq_feet_warn").html('Please enter only number');
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
					else if(IsNumber(jQuery.trim($("#built").val())) == false)
						{
						 	$("#tab_common3").addClass("active_tab");
						 	$("#tab3").css("display","block"); 
							$("#built_warn").html('Please enter only number');
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
					else if(jQuery.trim($("#member_price").val()) == '')
						{
							$("#tab_common4").addClass("active_tab");
						 	$("#tab4").css("display","block"); 
							$("#member_price_warn").html('This field is required');
							$("#member_price").focus();
							return false;
						}
					else if(IsNumber(jQuery.trim($("#member_price").val())) == false)
						{
							$("#tab_common4").addClass("active_tab");
						 	$("#tab4").css("display","block"); 
							$("#member_price_warn").html('Please enter only number');
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
					else if(IsNumber(jQuery.trim($("#event_price").val())) == false)
						{
						 	$("#tab_common4").addClass("active_tab");
						 	$("#tab4").css("display","block"); 
							$("#event_price_warn").html('Please enter only number');
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
					else if(IsNumber(jQuery.trim($("#monthly_rent").val())) == false)
						{
						 	$("#tab_common4").addClass("active_tab");
						 	$("#tab4").css("display","block"); 
							$("#monthly_rent_warn").html('Please enter only number');
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
					else if(IsNumber(jQuery.trim($("#hazard_ins").val())) == false)
						{
						 	$("#tab_common4").addClass("active_tab");
						 	$("#tab4").css("display","block"); 
							$("#hazard_ins_warn").html('Please enter only number');
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
					else if(IsNumber(jQuery.trim($("#property_tax").val())) == false)
						{
						 	$("#tab_common4").addClass("active_tab");
						 	$("#tab4").css("display","block"); 
							$("#property_tax_warn").html('Please enter only number');
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
					else if(IsNumber(jQuery.trim($("#management_expenses").val())) == false)
						{
						 	$("#tab_common4").addClass("active_tab");
						 	$("#tab4").css("display","block"); 
							$("#management_expenses_warn").html('Please enter only number');
							$("#management_expenses").focus();
							return false;
						}
					else  if(jQuery.trim($("#utilities").val()) == '')
						{
						 	$("#tab_common4").addClass("active_tab");
						 	$("#tab4").css("display","block"); 
							$("#utilities_warn").html('This field is required');
							$("#utilities").focus();
							return false;
						}
					else if(IsNumber(jQuery.trim($("#utilities").val())) == false)  
						{
						 	$("#tab_common4").addClass("active_tab");
						 	$("#tab4").css("display","block"); 
							$("#utilities_warn").html('Please enter only number');
							$("#utilities").focus();
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
					else if(IsNumber(jQuery.trim($("#net_income").val())) == false)
						{
						 	$("#tab_common4").addClass("active_tab");
						 	$("#tab4").css("display","block"); 
							$("#net_income_warn").html('Please enter only number');
							$("#net_income").focus();
							return false;
						}
					else if(jQuery.trim($("#post_code").val()) == '')
						{
							$("#tab_common5").addClass("active_tab");
						 	$("#tab5").css("display","block"); 
							$("#post_code_warn").html('This field is required');
							$("#post_code").focus();
							return false;
						}
					else if(jQuery.trim($("#meta_title").val()) == '')
						{
							$("#tab_common6").addClass("active_tab");
						 	$("#tab6").css("display","block"); 
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
              <li><a href="#tab1" class="active_tab" >General Information</a></li>
              <li><a href="#tab2" >Images</a></li>
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
                  <label class="field_title" for="bedroom">Property ID<span class="req">*</span></label>
                  <div class="form_input">
                    <input id="property_id" type="text" tabindex="1" class="required large tipTop" name="property_id" title="Please enter the property id" />
                      <span id="property_id_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li> 
              <input type="hidden" tabindex="11" name="status" value="Publish"/> 
                 
              <!--<li>
                <div class="form_grid_12">
                  <label class="field_title" for="admin_name">Status </label>
                  <div class="form_input">
                    <div class="publish_unpublish">
                      <input type="checkbox" tabindex="11" name="status" checked="checked" id="publish_unpublish_publish" class="publish_unpublish"/>
                    </div>
                  </div>
                </div>
              </li>-->
              <li>
                <div class="form_grid_12">
                  <div class="form_input">
                   <input type="button" name="generalInfo" id="generalInfo" class="btn_small btn_blue nxtTab" tabindex="9" value="Next"/>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <div id="tab2" class="tab_common_class">
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
                                   <input style="float:left" type='file' name="product_image[]" multiple="multiple" id="product_image" onchange='Test1.UpdatePreview1(this)' class="required large tipTop"   />
                                   <span id="product_image_warn" class="redfont" style="color:#F00;"></span>
                                   </div>
                                  </td>
                                  
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
                    <span class="input_instruction green">Note: To upload multiple image, hold 'Control' button while choosing images<p style="color:#FF0000"> Max. 10 images.</p></span></div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <div class="form_input">
                    <input type="button" class="btn_small btn_blue prvTab"  tabindex="9" value="Prev"/>
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
                  <select id="property_type" name="property_type" >
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
                    <input type="button" id="priceInfo"  name="priceInfo" class="btn_small btn_blue nxtTab" tabindex="9" value="Next"/>
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
                    <textarea type="text" name="address" id="address" tabindex="3" style="width:370px;" class="large tipTop" title="Enter address"></textarea>
                  </div>
                </div>
              </li>
             <!-- <li>
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
              </li>
              <li>
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
                    <input type="text" name="post_code" id="post_code" tabindex="8" class="required large tipTop" title="Please enter the post code" />
                    <span id="post_code_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
               <li>
					<div class="form_grid_12">
                      <div class="team_location">
                       	 <label class="field_title" for="attribute_name">Set location Map <br /><small style="color:#990000; font-size:9px; text-transform:capitalize;">Eg:(California, Boston, New York)</small></label>
                                        <div class="form_input">
                                            <input id="test-address" type="text" tabindex="1" class="required large tipTop" title="Please enter the rental location" value=""/>
                                            <span id="test-address_warn" class="redfont" style="color:#F00;"></span>
                                            <br /><br /><div id="test" class="gmap3"></div><br />
                                            <input type="hidden" name="latitude" id="lat" value="31.6333333"/>
       										<input type="hidden" name="longitude" id="lng" value="-8" />
                                        </div>
                                    </div>
                                   
                                </div>
							</li>
          
              <li>
              <div class="form_grid_12">
                  <div class="form_input">
                    <input type="button" class="btn_small btn_blue prvTab" tabindex="9" value="Prev"/>
                    <input type="button" id="addressInfo"  name="addressInfo" class="btn_small btn_blue nxtTab" tabindex="9" value="Next"/>
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
              <li>
                <div class="form_grid_12">
                  <div class="form_input">
                  <input type="button" class="btn_small btn_blue prvTab" onclick="TabbedPanels1.showPanel(4); return false;" tabindex="9" value="Prev"/>
					<input type="submit" class="btn_small btn_blue" id="seoInfo" value="Submit" tabindex="4">
                  </div>
                </div>
              </li>
             
            </ul>
            </div>
            <ul>
              <li>
                <div class="form_grid_12">
                  <div class="form_input">
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
<script type="text/javascript">
         
            var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
        
            </script>
<?php 
$this->load->view('admin/templates/footer.php');
include_once('googlemap.php');
?>
