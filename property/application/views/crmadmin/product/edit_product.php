<?php
$this->load->view('crmadmin/templates/header.php');
$this->load->view('crmadmin/product/googlemap.php');
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
$(document).ready(function(){
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
  
  
  var j = 1;
  $('#addAttr').click(function() { 
    $('<div style="float: left; margin: 12px 10px 10px; width:85%;" class="field">'+
        '<div class="image_text" style="float: left;margin: 5px;margin-right:50px;">'+
          '<span>Attribute Name:</span>&nbsp;'+
          '<select name="product_attribute_name[]" style="width:200px;color:gray;width:206px;" class="chzn-select">'+
            '<option value="">--Select--</option>'+
            <?php foreach ($PrdattrVal->result() as $prdattrRow){ ?>
            '<option value="<?php echo $prdattrRow->id; ?>"><?php echo $prdattrRow->attr_name; ?></option>'+
            <?php } ?>
           '</select>'+
        '</div>'+
        '<div class="attribute_box attrInput" style="float: left;margin: 5px;" >'+
           '<span>Attribute Price :</span>&nbsp;'+
           '<input type="text" name="product_attribute_val[]" style="width:75px;color:gray;" class="chzn-select" />'+
        '</div>'+
    '</div>').fadeIn('slow').appendTo('.inputss');
    j++;
  });
  
  $('#removeAttr').click(function() {
    $('.field:last').remove();
  });
  
});
</script>
<!--<script type="text/javascript">
    function delimage(val){
    $('#row'+val).remove();
    }
     $(function() {
      
    
    /* product Add images dynamically */
  var i = 1;
  
  
  $('#add').click(function() {
  
      $('<div class="control-group field" id="row'+i+'"><input type="text" class="small tipTop" name="imgtitle[]"  maxlength="25"  placeholder="Caption" /> <input class="small tipTop"  placeholder="Priority" name="imgPriority[]" type="text"><div class="uploader" id="uniform-productImage" style=""><input type="file" class="large tipTop" name="product_image[]" id="product_image" onchange="Test.UpdatePreview(this,'+i+')" style="opacity: 0;"><span class="filename" style="-moz-user-select: none;">No file selected</span><span class="action" style="-moz-user-select: none;">Choose File</span></div><img class="img'+i+'" style="display: inline-block; margin: 0 10px; position: relative;top: 13px;" width="150" height="150" alt="" src="images/noimage.jpg"><a href="javascript:void(0);" onclick="return delimage('+i+');"><div class="rmv_btn">Remove</div></a></div></div>').fadeIn('slow').appendTo('.imageAdd');
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
          <h6>Edit Property</h6>
          <div id="widget_tab">
            <ul>
              <li><a href="#tab1" class="active_tab tab_common" id="tab_common1">Images</a></li>
              <li><a href="#tab2" class="tab_common" id="tab_common2">General Information</a></li>
              <li><a href="#tab3" class="tab_common" id="tab_common3">Attributes</a></li>
              <li><a href="#tab4" class="tab_common" id="tab_common4">Price Information</a></li>
              <li><a href="#tab5" class="tab_common" id="tab_common5">Address</a></li>
              <li><a href="#tab6" class="tab_common" id="tab_common6">SEO</a></li>
             
              <!--<li><a href="#tab6">SEO</a></li>-->
            </ul>
          </div>
        </div>
        <div class="widget_content">
          <?php 
            $attributes = array('class' => 'form_container left_label', 'id' => 'editproperty_form', 'enctype' => 'multipart/form-data');
            echo form_open_multipart('crmadmin/product/insertEditProduct',$attributes) ;
/*            $optionsArr = unserialize($product_details->row()->option);
            if (is_array($optionsArr) && count($optionsArr)>0){
              $options = 'available';
              $attNameArr = $optionsArr['attribute_name'];
              $attValArr = $optionsArr['attribute_val'];
              $attWeightArr = $optionsArr['attribute_weight'];
              $attPriceArr = $optionsArr['attribute_price'];
            }else {
*/              $options = '';
//            }
            $list_names = $product_details->row()->list_name;
            $list_names_arr = explode(',', $list_names);
            $list_values = $product_details->row()->list_value;
            $list_values_arr = explode(',', $list_values);
//            $listsArr = array_combine($list_names_arr,$list_values_arr);
//            echo "<pre>";print_r($list_names_arr);print_r($list_values_arr);print_r($listsArr);die;
            $imgArr = explode(',', $product_details->row()->image);
          ?>
                  <!--  <input type="hidden" name="latitude" id="latitude" value="<?php echo trim(stripslashes($product_details->row()->latitude));?>" />
                    <input type="hidden" name="longitude" id="longitude" value="<?php echo trim(stripslashes($product_details->row()->longitude));?>" />-->
                    
          <div id="tab1">
            <ul>
              
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="product_image">Property Image</label>
                  <div class="form_input controls imageAdd">
                
                                 
                                <div class="dragndrop"><button>Choose Image</button></div>
                                  
                 
                </div><br />
                    <span class="input_instruction green" style="margin-left:320px">Note: To upload multiple image, hold 'Control' button while choosing images<!--<p style="color:#FF0000"> Max. 10 images per upload.</p>--></span>
                </div>
              </li>
              <li>
                <div class="widget_content">
                  <table class="display display_tbl" id="image_tbl">
                    <thead>
                      <tr>
                        <th class="center" width="15%"> Caption </th>
                        <th> Image </th>
                        <th> Position </th>
                        <th> Action </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if(count($product_image) > 0){ foreach($product_image->result() as $ProImag){
            ?>
            <tr id="img_<?php echo $ProImag->id; ?>">
                        <td class="center tr_select "><input type="text" name="imgtitle[]"  onChange="javascript:ChangeImagetitle(this,<?php echo $ProImag->id; ?>);" value="<?php echo $ProImag->imgtitle; ?>" /></td>
            <td class="center"><img src="<?php echo base_url();?>images/product/<?php echo $ProImag->product_image; ?>"  height="320px" width="320px" /> </td>
                        <td class="center"><div id="imgmsg_<?php echo $ProImag->id; ?>"></div><span>
                          <input type="text" style="width: 15%;" name="changeorder[]" onChange="javascript:ChangeImagePriority(this,<?php echo $ProImag->id; ?>);" value="<?php echo $ProImag->imgPriority; ?>" size="3" />
                          </span> </td>
                        <td class="center"><ul class="action_list" style="background:none;border-top:none;">
                            <li style="width:100%;"><a class="p_del tipTop" href="javascript:void(0)" onClick="DeletePictureProducts(<?php echo $ProImag->id; ?>);" title="Delete this image">Remove</a></li>
                          </ul></td>
                      </tr>
            
            <?php 
            }
            }
              if (count($imgArr)>0){
                $i=0;$j=1;
                $this->session->set_userdata(array('product_image_'.$product_details->row()->id => $product_details->row()->image));
                foreach ($imgArr as $img){
                  if ($img != ''){
              ?>
                      <tr id="img_<?php echo $i ?>">
                        <td class="center tr_select "><!--<input type="hidden" name="imaged[]" value="<?php echo $img; ?>"/>-->
                          <?php echo $j;?> </td>
                        <td class="center"><img src="<?php echo base_url();?>images/product/<?php echo $img; ?>"  height="80px" width="80px" /> </td>
                        <td class="center"><span>
                          <input type="text" style="width: 15%;" name="changeorder[]" value="<?php echo $i; ?>" size="3" />
                          </span> </td>
                        <td class="center"><ul class="action_list" style="background:none;border-top:none;">
                            <li style="width:100%;"><a class="p_del tipTop" href="javascript:void(0)" onClick="editPictureProducts(<?php echo $i; ?>,<?php echo $product_details->row()->id;?>);" title="Delete this image">Remove</a></li>
                          </ul></td>
                      </tr>
                      <?php 
              $j++;
                  }
                  $i++;
                }
              }
              ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th class="center"> Caption </th>
                        <th> Image </th>
                        <th> Position </th>
                        <th> Action </th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </li>
              <!--<li>
                <div class="form_grid_12">
                  <div class="form_input">
                    <button type="submit" class="btn_small btn_blue" tabindex="9"><span>Update</span></button>
                  </div>
                </div>
              </li>-->
            </ul>
          </div>
          
          <div id="tab2">
          <ul>
            <li>
                <div class="form_grid_12">
                  <label class="field_title" for="country">Status</label>
                  <div class="form_input">
                    <select class="chzn-select required" name="property_status" tabindex="-1" style="width: 375px; display: none;" data-placeholder="Please select the property status">
                      
                      <option value="Staging" <?php if($product_details->row()->property_status=='Staging'){echo 'selected="selected"';} ?>>Staging</option>
                      <option value="Active" <?php if($product_details->row()->property_status=='Active'){echo 'selected="selected"';} ?>>Active</option>
                      <option value="Reserved" <?php if($product_details->row()->property_status=='Reserved'){echo 'selected="selected"';} ?>>Reserved</option>
                      <option value="Under Contract" <?php if($product_details->row()->property_status=='Under Contract'){echo 'selected="selected"';} ?>>Under Contract</option>
                      <option value="Sold" <?php if($product_details->row()->property_status=='Sold'){echo 'selected="selected"';} ?>>Sold</option>
                     <option value="Funded" <?php if($product_details->row()->property_status=='Funded'){echo 'selected="selected"';} ?>>Funded</option>
                     <option value="Cancelled" <?php if($product_details->row()->property_status=='Cancelled'){echo 'selected="selected"';} ?>>Cancelled</option>
                     <option value="Email" <?php if($product_details->row()->property_status=='Email'){echo 'selected="selected"';} ?>>Email</option>
                    </select>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="full_remarks">Full Remarks</label>
                  <div class="form_input">
                    <textarea name="full_remarks" id="full_remarks" tabindex="2" style="width:370px;" class="tipTop mceEditor" title="Please enter the full remarks"><?php echo stripslashes($product_details->row()->full_remarks); ?></textarea>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="short_remarks">Short Remarks</label>
                  <div class="form_input">
                    <textarea name="short_remarks" id="short_remarks" tabindex="2" style="width:370px;" class="tipTop mceEditor" title="Please enter the short remarks"><?php echo stripslashes($product_details->row()->short_remarks); ?></textarea>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bedroom">Property ID<span class="req">*</span></label>
                  <div class="form_input">
                    <input id="property_id" type="text" tabindex="1" value="<?php echo stripslashes($product_details->row()->property_id); ?>" class="required large tipTop" name="property_id" title="Please enter the property id" />
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
                      <input type="checkbox" tabindex="11" name="status" <?php if(($product_details->row()->status) == 'Publish') echo 'checked="checked"'; ?> id="publish_unpublish_publish" class="publish_unpublish"/>
                    </div>
                  </div>
                </div>
              </li>-->
             
              <!-- <li>
                <div class="form_grid_12">
                  <div class="form_input">
                    <button type="submit" class="btn_small btn_blue" tabindex="9"><span>Update</span></button>
                  </div>
                </div>
              </li>-->
            </ul>
            
          </div>
          <div id="tab3">
            <ul id="AttributeView">
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bedroom">Bedrooms<span class="req">*</span></label>
                  <div class="form_input">
                    <input id="bedrooms" type="text" tabindex="1" class="required large tipTop" name="bedrooms" title="Please enter number of bedrooms" value="<?php echo stripslashes($product_details->row()->bedrooms); ?>"/>
                      <span id="bedrooms_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li> 
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bathroom">Baths<span class="req">*</span></label>
                  <div class="form_input">
                    <input id="baths" type="text" tabindex="1" class="required large tipTop" name="baths" title="Please enter number of baths" value="<?php echo stripslashes($product_details->row()->baths); ?>"/>
                      <span id="baths_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li> 
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bathroom">Square footage<span class="req">*</span></label>
                  <div class="form_input">
                    <input id="sq_feet" type="text" tabindex="1" class="required large tipTop" name="sq_feet" title="Please enter the rental area(in sq feet)" value="<?php echo stripslashes($product_details->row()->sq_feet); ?>"/>
                      <span id="sq_feet_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li> 
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bathroom">Year built<span class="req">*</span></label>
                  <div class="form_input">
                    <input id="built" type="text" tabindex="1" class="required large tipTop" name="built" title="Please enter the rental built year" value="<?php echo stripslashes($product_details->row()->built); ?>"/>
                      <span id="built_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li> 
            <li>
                <div class="form_grid_12">
                  <label class="field_title" for="price">Property Type</label>
                  <div class="form_input">
                  <select id="property_type" name="property_type" onchange="SelectSubType(this.value);" >
                  <?php foreach($Property_Type->result() as $PropertyType){ 
                ?>
                    <option value="<?php echo $PropertyType->id; ?>" <?php if($product_details->row()->property_type == $PropertyType->id) echo 'selected="selected"'; ?> ><?php echo $PropertyType->attr_name;?></option>
            <?php }
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
          foreach($Property_Sub_Type->result() as $PropertySubType){ ?>
              
                      <option value="<?php echo $PropertySubType->id;?>" <?php if($product_details->row()->property_sub_type == $PropertySubType->id) echo 'selected="selected"'; ?>><?php echo $PropertySubType->subattr_name;?></option>
          <?php } ?>
                   </select>
                  </div>
                </div>
              </li> 
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bathroom">Lot size<span class="req">*</span></label>
                  <div class="form_input">
                    <input id="lot_size" type="text" tabindex="1" class="required large tipTop" name="lot_size" title="Please enter the lot size" value="<?php echo stripslashes($product_details->row()->lot_size); ?>"/>
                      <span id="lot_size_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li> 
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bathroom">Featured?</label>
                  <div class="form_input">
                  <input type="radio" name="featured" value="Yes" <?php if(($product_details->row()->featured) == 'Yes') echo 'checked="checked"';?> title="Please choose featured option" /> Yes 
                  <input type="radio" name="featured" value="No" <?php if(($product_details->row()->featured) == 'No') echo 'checked="checked"';?> title="Please choose featured option" /> No
                  </div>
                </div>
              </li> 
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bathroom">Financing Available</label>
                  <div class="form_input">
                  <input type="radio" name="financing" value="Yes" <?php if(($product_details->row()->financing) == 'Yes') echo 'checked="checked"';?> title="Please choose financing option" /> Yes 
                  <input type="radio" name="financing" value="No" <?php if(($product_details->row()->financing) == 'No') echo 'checked="checked"';?> title="Please choose financing option" /> No
                  </div>
                </div>
              </li> 
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bathroom">Cash Only</label>
                  <div class="form_input">
                  <input type="radio" name="cash_only" value="Yes" <?php if(($product_details->row()->cash_only) == 'Yes') echo 'checked="checked"';?> title="Please choose cash option" /> Yes
                  <input type="radio" name="cash_only" value="No" <?php if(($product_details->row()->cash_only) == 'No') echo 'checked="checked"';?> title="Please choose cash option" /> No 
                  </div>
                </div>
              </li> 
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bathroom">Trust Deed</label>
                  <div class="form_input">
                  <input type="radio" name="trust_deed" value="Yes" <?php if(($product_details->row()->trust_deed) == 'Yes') echo 'checked="checked"';?> title="Please choose cash option" /> Yes
                  <input type="radio" name="trust_deed" value="No" <?php if(($product_details->row()->trust_deed) == 'No') echo 'checked="checked"';?> title="Please choose cash option" /> No 

                  </div>
                </div>
              </li>
               
            </ul>
            
                
                
              
          </div>
          <div id="tab4">
                        <ul id="AttributeView">
                          
                      
              <!--<li>
                <div class="form_grid_12">
                  <label class="field_title" for="price">Member Price<span class="req">*</span></label>
                  <div class="form_input">
                    <input type="text" name="member_price"  value="<?php echo $_SESSION['price'];?>" id="member_price" tabindex="9" class="required large tipTop" title="Please enter the member price" />
                    <span id="member_price_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
             -->
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="price">Member Price ($)<span class="req">*</span></label>
                  <div class="form_input">
                    <input type="text" name="member_price" value="<?php echo stripslashes($product_details->row()->member_price); ?>" id="member_price" tabindex="9" class="required large tipTop" title="Please enter the member price" />
                    <span id="member_price_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="price">Event only Price ($)<span class="req">*</span></label>
                  <div class="form_input">
                    <input type="text" name="event_price"  value="<?php echo stripslashes($product_details->row()->event_price); ?>" id="event_price" tabindex="9" class="required large tipTop" title="Please enter the event only price" />
                    <span id="event_price_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="price">Monthly rental PMT ($)<span class="req">*</span></label>
                  <div class="form_input">
                    <input type="text" name="monthly_rent"  value="<?php echo stripslashes($product_details->row()->monthly_rent); ?>" id="monthly_rent" tabindex="9" class="required large tipTop" title="Please enter the monthly rental" />
                    <span id="monthly_rental_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="price">Annual rental ($)<span class="req">*</span></label>
                  <div class="form_input">
                    <input type="text" name="annual_Rent"  value="<?php echo stripslashes($product_details->row()->annual_rent); ?>" id="annual_Rent" tabindex="9" class="required large tipTop" title="Please enter the annual rental" />
                    <span id="annual_Rental_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="price">Estimated* Annual hazard insurance ($)<span class="req">*</span></label>
                  <div class="form_input">
                    <input type="text" name="hazard_ins" value="<?php echo stripslashes($product_details->row()->hazard_ins); ?>" id="hazard_ins" tabindex="9" class="required large tipTop" title="Please enter the estimated annual hazard insurance" />
                    <span id="hazard_ins_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="price">Estimated property tax ($)<span class="req">*</span></label>
                  <div class="form_input">
                    <input type="text" name="property_tax"  value="<?php echo stripslashes($product_details->row()->property_tax); ?>" id="property_tax" tabindex="9" class="required large tipTop" title="Please enter the estimated property tax" />
                    <span id="property_tax_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="price">Property management exp ($)<span class="req">*</span></label>
                  <div class="form_input">
                    <input type="text" name="management_expenses" value="<?php echo stripslashes($product_details->row()->management_expenses); ?>" id="management_expenses" tabindex="9" class="required large tipTop" title="Please enter the property management expenses" />
                    <span id="mgmnt_expenses_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="utilities">Annual Utilities Exp($)<span class="req">*</span></label>
                  <div class="form_input">
                    <input type="text" name="utilities" value="<?php echo stripslashes($product_details->row()->utilities); ?>" id="utilities" tabindex="9" class="required large tipTop" title="Please enter the utilities" />
                    <span id="utilities_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="price">Estimated net income ($)<span class="req">*</span></label>
                  <div class="form_input">
                    <input type="text" name="net_income"  value="<?php echo stripslashes($product_details->row()->net_income); ?>" id="net_income" tabindex="9" class="required large tipTop" title="Please enter the estimated net income" />
                    <span id="net_income_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
             <!-- <li>
                <div class="form_grid_12">
                  <label class="field_title" for="price">Sales Code<span class="req">*</span></label>
                  <div class="form_input">
                    <input type="text" name="sales_code"  value="<?php echo $_SESSION['price'];?>" id="sales_code" tabindex="9" class="required large tipTop" title="Please enter the sales code" />
                    <span id="sales_code_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>-->
            </ul>
                        <!--<button type="submit" style="margin: 20px 5px;" class="btn_small btn_blue" tabindex="9"><span>Update</span></button>-->
                      </div>
          <div id="tab5">
            <ul id="AttributeView">
           <!--    <li>
                <div class="form_grid_12">
                  <label class="field_title" for="country">Country<span class="req">*</span></label>
                  <div class="form_input">
                    <select class="chzn-select required" onChange="javascript:loadCountryListValues(this)" name="country" tabindex="-1" style="width: 375px; display: none;" data-placeholder="Please select the country name">
                      <?php foreach ($RentalCountry->result() as $row){
            if($row->id==$product_details->row()->country){         
            echo '<option value="'.$row->id.'">'.$row->name.'</option>';          
            }         ?>
                      <option value="<?php echo $row->id;?>" <?php if($row->id==$product_details->row()->country){ echo 'selected="selected"'; } ?>><?php echo $row->name;?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>
              </li>-->
            
            <li>
                <div class="form_grid_12">
                  <label class="field_title" for="address">Address</label>
                  <div class="form_input">
                    <textarea type="text" name="address" onblur="return geocode();" id="address" tabindex="3" style="width:370px;" class="large tipTop" title="Enter address"><?php echo trim(stripslashes($product_details->row()->address));?></textarea>
                  </div>
                </div>
              </li>
          <!--    <li>
                <div class="form_grid_12">
                  <label class="field_title" for="country">Country<span class="req">*</span></label>
                  <div class="form_input">
                    <select class="chzn-select required" onChange="javascript:loadCountryListValues(this)" name="country" tabindex="-1" style="width: 375px; display: none;" data-placeholder="Please select the country name">
                      <?php foreach ($RentalCountry->result() as $row){
            if($row->id==$product_details->row()->country){
            echo '<option value="'.$row->id.'">'.$row->name.'</option>';          
            }         ?>
                      <option value="<?php echo $row->id;?>" <?php if($row->id==$product_details->row()->country){ echo 'selected="selected"'; } ?>><?php echo $row->name;?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>
              </li>
             <li>
                <div class="form_grid_12">
                  <label class="field_title" for="state">State<span class="req">*</span></label>
                  <div class="form_input" id="listCountryCnt">
                    <select class="chzn-select required" name="state" onChange="javascript:loadStateListValues(this)" tabindex="-1" style="width: 375px; display: none;" data-placeholder="Please select the state name">
                      
                             <?php foreach ($RentalState->result() as $row){
            if($row->id==$product_details->row()->statename){         
            echo '<option value="'.$row->id.'">'.$row->name.'</option>';        
            }         
                      
                      ?>
                      <option value="<?php echo $row->id;?>"  <?php if($row->id==$product_details->row()->statename){ echo 'selected="selected"';}?>><?php echo $row->name;?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>
              </li>-->
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="city">City<span class="req">*</span></label>
                  <div class="form_input" id="listCountryCnt">
                    <input type="text" name="city" onblur="return geocode();" id="city" value="<?php echo trim(stripslashes($product_details->row()->cityname));?>" tabindex="8" class="large tipTop" title="Please enter the city" />
                    <span id="city_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="state">State<span class="req">*</span></label>
                  <div class="form_input" id="listCountryCnt">
                    <input type="text" name="state" onblur="return geocode();" id="state" value="<?php echo trim(stripslashes($product_details->row()->statename));?>" tabindex="8" class="large tipTop" title="Please enter the state" />
                    <span id="state_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
             
             <!-- <li>
                <div class="form_grid_12">
                  <label class="field_title" for="city">City<span class="req">*</span></label>
                  <div class="form_input" id="listStateCnt">
                    <select class="chzn-select required" name="city" tabindex="-1" style="width: 375px; display: none;" data-placeholder="Please select the city name">
                      <option value=""></option>
                      <?php foreach ($RentalCity->result() as $row){
            if($row->id==$product_details->row()->city){          
            echo '<option value="'.$row->id.'">'.$row->name.'</option>';        
            }         
                      
                      ?>
                      <option value="<?php echo $row->id;?>"  <?php if($row->id==$product_details->row()->city){ echo 'selected="selected"';}?>><?php echo $row->name;?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>
              </li>-->
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="post_code">Zip<span class="req">*</span></label>
                  <div class="form_input">
                    <input type="text" name="post_code" onblur="return geocode();" id="post_code" value="<?php echo trim(stripslashes($product_details->row()->post_code));?>" tabindex="8" class="large tipTop" title="Please enter the post code" />
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
                                    <input type="hidden" name="latitude" id="latitude" class="gllpLatitude" value="<?php echo $product_details->row()->latitude;?>" />
                                    <input type="hidden" name="longitude" id="longitude" class="gllpLongitude" value="<?php echo $product_details->row()->longitude;?>" />
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
                   <!-- <small style="color:#990000; font-size:9px; text-transform:capitalize;">Eg:(Morocco discovery holidays, Marrakesh, Morocco)</small>--
                    <div class="form_input">
                             <div id="gmap">
       
        </div>
        <div id="crosshair"></div>
          <div id="ft" style="display:none;">
        <p><strong>Latitude, Longitude:</strong> <span id="latlon"></span></p>
        <p><strong>WKT:</strong> <span id="wkt"></span></p>
        <p><strong>Google Maps zoom level:</strong> <span id="zoom"></span></p>
       
    </div>
                      <!--<input type="hidden" name="zoom" id="zoom" value="6" />--
                    </div>
                  </div>
                </div>
              </li>
                <li>
                <div class="form_grid_12">
                  <label class="field_title" for="post_code">Latitude</label>
                  <div class="form_input">
                   <input type="text" name="latitude" id="latitude" value="<?php echo $product_details->row()->latitude;?>" class="input_text inputwidth2" readonly="readonly"/>
                    </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="post_code">Longitude</label>
                  <div class="form_input">
                   <input type="text" name="longitude" id="longitude" value="<?php echo $product_details->row()->longitude;?>" class="input_text inputwidth2" readonly="readonly"/>
                    <span id="postal_code_warn" class="redfont" style="color:#F00;"></span> </div>
                </div>
              </li>-->
              
             <!-- <li>
                                <div class="form_grid_12">
                                  <div class="team_location">
                                   <label class="field_title" for="attribute_name">Set location Map<br /><small style="color:#990000; font-size:9px; text-transform:capitalize;">Eg:(California, Boston, New York)</small></label>
                                        <div class="form_input">
                                            <input id="test-address" type="text" tabindex="1" class="required large tipTop" title="Please enter the team location" value=""/>
                                            <br /><br /><div id="test" class="gmap3"></div><br />
                                            <input type="hidden" name="latitude" id="lat" value="<?php echo trim(stripslashes($product_details->row()->latitude));?>"/>
                          <input type="hidden" name="longitude" id="lng" value="<?php echo trim(stripslashes($product_details->row()->longitude));?>" />
                                            <!--<input type="hidden" name="zoom" id="zoom" value="6" />--
                                    </div>
                                    </div>
                                   
                                </div>
              </li>-->
              
              
         
             
           
         <!-- <div id="tab6">
            <ul>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="confirm_email">Send a copy of confirmation email when users places order(s):</label>
                  <div class="form_input">
                    <div class="yes_no">
                      <input type="checkbox" tabindex="1" <?php if( $product_details->row()->confirm_email =='on'){ echo 'checked="checked"';}?> name="confirm_email" class="yes_no"/>
                    </div>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="order_email">The Email address to send order and payment Information: </label>
                  <div class="form_input">
                    <div class="yes_no">
                      <input type="checkbox" tabindex="1" name="order_email" <?php if($product_details->row()->order_email =='on'){ echo 'checked="checked"';}?> class="yes_no"/>
                    </div>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="invoice_template">Email Invoice Template</label>
                  <div class="form_input">
                    <textarea name="invoice_template" id="invoice_template" tabindex="3" class="tipTop mceEditor"><?php echo $product_details->row()->invoice_template;?></textarea>
                  </div>
                </div>
              </li>
            </ul>
            <ul>
              <li>
                <div class="form_grid_12">
                  <div class="form_input" style="margin:0px;width:100%;">
                    <button type="submit" style="margin-top: 20px;" class="btn_small btn_blue" tabindex="9"><span>Update</span></button>
                  </div>
                </div>
              </li>
            </ul>
          </div> -->
           </ul>
          </div>
          <div id="tab6">
            <ul>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="meta_title">Meta Title<span class="req">*</span></label>
                  <div class="form_input">
                    <input name="meta_title" id="meta_title" value="<?php echo $product_details->row()->meta_title;?>" type="text" tabindex="1" class="large tipTop" title="Please enter the page meta title"/>
                     <span id="meta_title_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="meta_tag">Meta Keyword</label>
                  <div class="form_input">
                    <textarea name="meta_keyword" id="meta_keyword"  tabindex="2" class="large tipTop" title="Please enter the page meta keyword"><?php echo $product_details->row()->meta_keyword;?></textarea>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="meta_description">Meta Description</label>
                  <div class="form_input">
                    <textarea name="meta_description" id="meta_description" tabindex="3" class="large tipTop" title="Please enter the meta description"><?php echo $product_details->row()->meta_description;?></textarea>
                  </div>
                </div>
              </li>
            </ul>
            </div>
           

    
            
            <span id="common_warn" class="redfont" style="color:#F00;"></span>
            <ul>
              <li>
                <div class="form_grid_12">
                  <div class="form_input">
                  <input type="submit" class="btn_small btn_blue prvTab" tabindex="9" value="Update" name="submit_button"/>
                    <button type="submit" name="submit_button" value="savencont" class="btn_small btn_blue" id="dealAdd" tabindex="4"><span>Save and continue to source information page</span></button>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <input type="hidden" name="propertyID" value="<?php echo $product_details->row()->id;?>"/>
          </form>
        </div>
      </div>
    
  <span class="clear"></span> </div>
</div>
<script>
/*$(document).ready(function(){


  var i = 1;
  
  
  $('#add').click(function() { 
    $('<div style="float: left; margin: 12px 10px 10px; width:85%;" class="field">'+
        '<div class="image_text" style="float: left;margin: 5px;margin-right:50px;">'+
          '<span>List Name:</span>&nbsp;'+
          '<select name="attribute_name[]" onchange="javascript:loadListValues(this)" style="width:200px;color:gray;width:206px;" class="chzn-select">'+
            '<option value="">--Select--</option>'+
            <?php foreach ($atrributeValue->result() as $attrRow){ 
              if (strtolower($attrRow->attribute_name) != 'price'){
            ?>
            '<option value="<?php echo $attrRow->id; ?>"><?php echo $attrRow->attribute_name; ?></option>'+
            <?php }} ?>
           '</select>'+
        '</div>'+
        '<div class="attribute_box attrInput" style="float: left;margin: 5px;" >'+
           '<span>List Value :</span>&nbsp;'+
           '<select name="attribute_val[]" style="width:200px;color:gray;width:206px;" class="chzn-select">'+
           '<option value="">--Select--</option>'+
           '</select>'+
        '</div>'+
    '</div>').fadeIn('slow').appendTo('.inputs');
    i++;
  });
  
  $('#remove').click(function() {
    $('.field:last').remove();
  });
  
  $('#reset').click(function() {
    $('.field').remove();
    $('#add').show();
    i=0;
  
  
  });
  
  
});*/
</script>
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
$(function(){
Test1 = {
        UpdatePreview1: function(obj){
          // if IE < 10 doesn't support FileReader
          if(!window.FileReader){
             // don't know how to proceed to assign src to image tag
          } else {
             var reader = new FileReader();
             var target = null;
             
             reader.onload = function(e) {
              target =  e.target || e.srcElement;
        
               $(".img").prop("src", target.result);
             };
              reader.readAsDataURL(obj.files[0]);
          }
        }
    };
  });
</script>
<!--<script type="text/javascript">
$('#property_type').change(function() {
    var selected = $(this).val();
    if(selected == '2'){
      $('#property_sub_type_disp').show();
    }
    else{
      $('#property_sub_type_disp').hide();
    }
});
</script>-->
<script type="text/javascript">
$(function() {
      $("#editproperty_form").submit(function(){
        // var email = $('#vendor_email').val();
        //alert('');
      
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
         $("#state_warn").html('');
          $("#city_warn").html('');
         $("#post_code_warn").html('');
         $("#meta_title_warn").html('');
        
        
          
          if(jQuery.trim($("#property_id").val()) == ''){
            
              $("#tab_common1").addClass("active_tab");
            //$("#tab1").css("display","block");
            $("#property_id_warn").html('Property id is required');
            $("#common_warn").html('Property id is required');
            $("#property_id").focus();
            return false;
            
          }else if(jQuery.trim($("#bedrooms").val()) == ''){
            
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
            $("#common_warn").html('meta title is required');
            $("#meta_title").focus();
            return false;
          }
          else
          { 
                  $("#editproperty_form").submit();
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

<script type="text/javascript">
function SelectSubType(Id)
{ 
var prodId = <?php echo $product_details->row()->id;?>;
    $.ajax(
    {
        type: 'POST',
        url: baseURL+'crmadmin/product/edit_sub_type_details',
        data:{'typeId':Id, 'prodId':prodId},
        success: function(data) 
        {
          //alert(data);return false;
          $("#property_sub_type_disp").html(data);
          //window.location.reload();
          
          
        }
        
      });
  
}
</script>


<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>

  <!-- CSS and JS for our code -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/site/jquery-gmaps-latlon-picker.css"/>
  <script src="<?php echo base_url(); ?>js/site/jquery-gmaps-latlon-picker.js"></script>
<?php 
$this->load->view('crmadmin/templates/footer.php');
include_once('googlemap.php');
?>
</strong>