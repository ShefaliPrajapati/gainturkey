<?php
$this->load->view('admin/templates/header.php');
?>
<style type="text/css">
#tab2 ul.imagesList{
	display: inline-block;
	text-align: center;
	vertical-align: middle;
}
#tab2 ul.imagesList li {
    display: inline;
    height: 200px;
    width: 200px;    
    float: left;
    vertical-align: middle;
    margin:10px 0;
    padding:10px 0;
}

#tab2  ul.imagesList li img {
    vertical-align: middle;
    height:95%;
    width: 95%;
    margin: 0 auto;
}
#tab2  ul.imagesList li span{
	padding:5px 0 5px 0;
	display:block;
	width: 95%;
	margin: 0 auto;
}



</style>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>View Property</h6>
                        <div id="widget_tab">
              				<ul>
               					 <li><a href="#tab1" class="active_tab">General Information</a></li>
                                  <li><a href="#tab2">Images</a></li>
                                  <li><a href="#tab3">Attributes</a></li>
                                  <li><a href="#tab4">Price Information</a></li>
                                  <li><a href="#tab5">Address</a></li>
                                  <!--<li><a href="#tab6">Billing & Invoice Email Info</a></li>-->
                                   <li><a href="#tab6">SEO</a></li>
                                    <li><a href="#tab7">Buyer Info</a></li>
                                  <li><a href="#tab8">Sourcer Info</a></li>
             				 </ul>
            			</div>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'addproduct_form');
						echo form_open('admin',$attributes) ;
/*						$optionsArr = unserialize($product_details->row()->option);
						if (is_array($optionsArr) && count($optionsArr)>0){
							$options = 'available';
							$attNameArr = $optionsArr['attribute_name'];
							$attValArr = $optionsArr['attribute_val'];
							$attWeightArr = $optionsArr['attribute_weight'];
							$attPriceArr = $optionsArr['attribute_price'];
						}else {
*/							$options = '';
//						}
						$list_names = $product_details->row()->list_name;
						$list_names_arr = explode(',', $list_names);
						$list_values = $product_details->row()->list_value;
						$list_values_arr = explode(',', $list_values);
						$imgArr = explode(',', $product_details->row()->image);
					?>
                    
                     <div id="tab1">
						<ul>
	 							
							<!--<li>
							<div class="form_grid_12">
							<label class="field_title" for="product_name">Rental Name </label>
							<div class="form_input">
								<?php 
								if ($product_details->row()->headline != ''){
									echo stripslashes($product_details->row()->headline);
								}else {
									echo 'Not available';
								}
								?>
							</div>
							</div>
							</li>-->
						<!--<li>
                <div class="form_grid_12">
                  <label class="field_title" for="product_title">Rentals Title <span class="req">*</span></label>
                  <div class="form_input">
                   <?php 
								if ($product_details->row()->product_title != ''){
									echo $product_details->row()->product_title;
								}else {
									echo 'Not available';
								}
								?>
                  </div>
                </div>
              </li>-->
                        	
	 						<li>
								<div class="form_grid_12">
								<label class="field_title" for="description">Full Remarks</label>
								<div class="form_input">
								<?php 
								if ($product_details->row()->full_remarks != ''){
									echo $product_details->row()->full_remarks;
								}else {
									echo 'Not available';
								}
								?>
								</div>
								</div>
							</li>
                            
                            <li>
								<div class="form_grid_12">
								<label class="field_title" for="description">Short Remarks</label>
								<div class="form_input">
								<?php 
								if ($product_details->row()->short_remarks != ''){
									echo $product_details->row()->short_remarks;
								}else {
									echo 'Not available';
								}
								?>
								</div>
								</div>
							</li>
                            <li>
                            	<div class="form_grid_12">
								<label class="field_title" for="description">Property ID</label>
								<div class="form_input">
								<?php 
								if ($product_details->row()->property_id != ''){
									echo stripslashes($product_details->row()->property_id);
								}else {
									echo 'Not available';
								}
								?>
								</div>
								</div>
							</li>
              				<li>
                            	<div class="form_grid_12">
								<label class="field_title" for="description">Status</label>
								<div class="form_input">
								<?php 
								if ($product_details->row()->property_status != ''){
									echo $product_details->row()->property_status;
								}else {
									echo 'Not available';
								}
								?>
								</div>
								</div>
							</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="admin/product/display_product_list" class="tipLeft" title="Go to property list"><span class="badge_style b_done">Back</span></a>
									</div>
								</div>
								</li>
							</ul>
                     </div>
                      
                      <div id="tab2">
									<ul class="imagesList">
                                    
										 <?php if($product_image->num_rows() > 0){ foreach($product_image->result() as $ProImag){
					  ?>
										<li style="float: left;">
										
										 	<img width="" height="" src="<?php echo base_url();?>images/product/thumb/<?php echo $ProImag->product_image; ?>" />
										 	<span>
										
                                         <?php echo $ProImag->imgtitle; ?></span>
										</li>
										 <?php 
					  }
					  }?></ul>

					  
					  <?php if($product_image->num_rows() > 0){ ?>
					  	<ul>
			  <li>
                <div class="form_grid_12">
                  <label class="field_title">&nbsp;</label>
                  <div class="form_input">
                    <a href="admin/product/download_images/<?php echo $product_details->row()->id;?>" class="btn_small btn_blue" target="_blank">Download Images</a>
                  </div>
                </div>
              </li>			</ul>
			  <?php } ?>
							
								<ul>
                           <li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="admin/product/display_product_list" class="tipLeft" title="Go to property list"><span class="badge_style b_done">Back</span></a>
									</div>
								</div>
								</li>     
                      </ul>          
                      </div>
                       
                      <div id="tab3">
                      <ul id="AttributeView">
                      
                       <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bedroom">Bedrooms<span class="req">*</span></label>
                  <div class="form_input">
                   <?php echo trim(stripslashes($product_details->row()->bedrooms));?>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bathroom">Baths<span class="req">*</span></label>
                  <div class="form_input">
                   <?php echo trim(stripslashes($product_details->row()->baths));?>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sleeps">Square footage<span class="req">*</span></label>
                  <div class="form_input">
                   <?php echo trim(stripslashes($product_details->row()->sq_feet));?>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sleeps">Year built<span class="req">*</span></label>
                  <div class="form_input">
                   <?php echo trim(stripslashes($product_details->row()->built));?>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bathroom">Property Type</label>
                  <div class="form_input">
                   <?php echo trim(stripslashes($product_details->row()->property_type));?>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sleeps">Lot size<span class="req">*</span></label>
                  <div class="form_input">
                   <?php echo trim(stripslashes($product_details->row()->lot_size));?>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sleeps">Featured?<span class="req">*</span></label>
                  <div class="form_input">
                   <?php echo trim(stripslashes($product_details->row()->featured));?>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sleeps">Financing Available<span class="req">*</span></label>
                  <div class="form_input">
                   <?php echo trim(stripslashes($product_details->row()->financing));?>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sleeps">Cash Only<span class="req">*</span></label>
                  <div class="form_input">
                   <?php echo trim(stripslashes($product_details->row()->cash_only));?>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sleeps">Trust Deed<span class="req">*</span></label>
                  <div class="form_input">
                   <?php echo trim(stripslashes($product_details->row()->trust_deed));?>
                  </div>
                </div>
              </li>
              <li>
                  <div class="form_grid_12">
                    <div class="form_input"><a href="admin/product/display_product_list" class="tipLeft" title="Go to property list"><span class="badge_style b_done">Back</span></a>
                      </div>
                      </div>
                      </li>
                      </ul>                      
                      </div>
                      
                      
                      <div id="tab4">
	                      <ul id="AttributeView">
                           
                       <li>
								<div class="form_grid_12">
								<label class="field_title" for="price">Member Price</label>
								<div class="form_input">
								<?php 
								if ($product_details->row()->member_price != ''){
									echo $product_details->row()->member_price;
								}else {
									echo 'Not available';
								}
								?>
								</div>
								</div>
							</li>
                              <li>
								<div class="form_grid_12">
								<label class="field_title" for="price">Event only Price</label>
								<div class="form_input">
								<?php 
								if ($product_details->row()->event_price != ''){
									echo $product_details->row()->event_price;
								}else {
									echo 'Not available';
								}
								?>
								</div>
								</div>
							</li>
                              <li>
								<div class="form_grid_12">
								<label class="field_title" for="price">Monthly rental PMT</label>
								<div class="form_input">
								<?php 
								if ($product_details->row()->monthly_rent != ''){
									echo $product_details->row()->monthly_rent;
								}else {
									echo 'Not available';
								}
								?>
								</div>
								</div>
							</li>
                            <!-- <li>
								<div class="form_grid_12">
								<label class="field_title" for="price">Annual rental</label>
								<div class="form_input">
								<?php 
								if ($product_details->row()->annual_rent != ''){
									echo $product_details->row()->annual_rent;
								}else {
									echo 'Not available';
								}
								?>
								</div>
								</div>
							</li>-->
                              <li>
								<div class="form_grid_12">
								<label class="field_title" for="price">Estimated* Annual hazard insurance</label>
								<div class="form_input">
								<?php 
								if ($product_details->row()->hazard_ins != ''){
									echo $product_details->row()->hazard_ins;
								}else {
									echo 'Not available';
								}
								?>
								</div>
								</div>
							</li>
                              <li>
								<div class="form_grid_12">
								<label class="field_title" for="price">Estimated property tax</label>
								<div class="form_input">
								<?php 
								if ($product_details->row()->property_tax != ''){
									echo $product_details->row()->property_tax;
								}else {
									echo 'Not available';
								}
								?>
								</div>
								</div>
							</li>
                            <li>
								<div class="form_grid_12">
								<label class="field_title" for="price">Property management exp</label>
								<div class="form_input">
								<?php 
								if ($product_details->row()->management_expenses != ''){
									echo $product_details->row()->management_expenses;
								}else {
									echo 'Not available';
								}
								?>
								</div>
								</div>
							</li>
                            <li>
								<div class="form_grid_12">
								<label class="field_title" for="price">Utilities</label>
								<div class="form_input">
								<?php 
								if ($product_details->row()->utilities != ''){
									echo $product_details->row()->utilities;
								}else {
									echo 'Not available';
								}
								?>
								</div>
								</div>
							</li>
                            <li>
								<div class="form_grid_12">
								<label class="field_title" for="price">Estimated net income</label>
								<div class="form_input">
								<?php 
								if ($product_details->row()->net_income != ''){
									echo $product_details->row()->net_income;
								}else {
									echo 'Not available';
								}
								?>
								</div>
								</div>
							</li>
                            <li>
                            <div class="form_grid_12">
									<div class="form_input">
										<a href="admin/product/display_product_list" class="tipLeft" title="Go to property list"><span class="badge_style b_done">Back</span></a>
									</div>
								</div>
                                </li>
                           
                      </ul>       
                      </div>
              <div id="tab5">
                      <ul>
                      <li>
                <div class="form_grid_12">
                  <label class="field_title" for="address">Address</label>
                  <div class="form_input">
                    <?php echo trim(stripslashes($product_details->row()->address));?>
                  </div>
                </div>
              </li>
             <!-- <li>
                <div class="form_grid_12">
                  <label class="field_title" for="country">Country<span class="req">*</span></label>
                  <div class="form_input">
                    
                      <?php foreach ($RentalCountry->result() as $row){
						if($row->id==$product_details->row()->country){					
						echo $row->name;					
						}}?>
                  
                  </div>
                </div>
              </li>-->
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="state">State<span class="req">*</span></label>
                  <div class="form_input" id="listCountryCnt">
                    
                      <?php foreach ($RentalState->result() as $row){
							if($row->id==$product_details->row()->statename){					
						echo $row->name;					
						}}?>
                    
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="city">City<span class="req">*</span></label>
                  <div class="form_input" id="listStateCnt">
                   
                      <?php echo trim(stripslashes($product_details->row()->cityname));?>
                    
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="post_code">Zip<span class="req">*</span></label>
                  <div class="form_input">
                    <?php echo trim(stripslashes($product_details->row()->post_code));?>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="address">location Map</label>
                  <div class="form_input">
                  <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/?q=<?php echo $product_details->row()->latitude;?>,<?php echo $product_details->row()->longitude;?>&amp;ie=UTF8&amp;t=m&amp;z=14&amp;ll=<?php echo $product_details->row()->latitude;?>,<?php echo $product_details->row()->longitude;?>&amp;output=embed"></iframe>
                  
                  
                    <?php //echo $map['html']; ?>
                  </div>
                </div>
              </li>
                <!--<li>
                <div class="form_grid_12">
                  <label class="field_title" for="feature">Feature Information</label>
                  <div class="form_input">
                    <?php echo $product_details->row()->feature;?>
                  </div>
                </div>
              </li>-->
             
             <!-- <li>
                <div class="form_grid_12">
                  <label class="field_title" for="expiredate">Expire Date: <span class="req">*</span></label>
                  <div class="form_input">
                    <input name="expiredate" id="expiredate" value="<?php echo $product_details->row()->expiredate;?>" type="text" tabindex="6" class="required small tipTop " title="Please select the date"/>
                  </div>
                </div>
              </li> -->
              <!--<h4>Others Information</h4>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="google_map">Google Map: </label>
                  <div class="form_input">
                   <?php echo $product_details->row()->google_map;?>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="add_feature">Additional Feature: </label>
                  <div class="form_input">
                    <?php echo $product_details->row()->add_feature;?>
                  </div>
                </div>
              </li>-->
              <!--<li>
                <div class="form_grid_12">
                  <label class="field_title" for="rentals_policy">Rentals Policy: </label>
                  <div class="form_input">
                   <?php echo $product_details->row()->rentals_policy;?>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="trams_condition">Trams and condition : </label>
                  <div class="form_input">
                    <?php echo $product_details->row()->trams_condition;?>
                  </div>
                </div>
              </li>-->
              </ul>
			          <ul><li><div class="form_grid_12">
				<div class="form_input">
					<a href="admin/product/display_product_list" class="tipLeft" title="Go to property list"><span class="badge_style b_done">Back</span></a>
				</div>
			</div></li></ul>
                      </div>
                      <!--<div id="tab6">
                      <ul>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="confirm_email">Send a copy of confirmation email when users places order(s):</label>
                  <div class="form_input">
                    <div class="yes_no">
                      <?php echo $product_details->row()->confirm_email;?>
                    </div>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="order_email">The Email address to send order and payment Information: </label>
                  <div class="form_input">
                    <div class="yes_no">
                     <?php echo $product_details->row()->order_email;?>
                    </div>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="invoice_template">Email Invoice Template</label>
                  <div class="form_input">
                    <?php echo $product_details->row()->invoice_template;?>
                  </div>
                </div>
              </li>
            </ul>
			          <ul><li><div class="form_grid_12">
				<div class="form_input">
					<a href="admin/product/display_product_list" class="tipLeft" title="Go to property list"><span class="badge_style b_done">Back</span></a>
				</div>
			</div></li></ul>
                      </div> -->
                      <div id="tab6">
                      <ul>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_title">Meta Title</label>
                    <div class="form_input">
                      <?php 
								if ($product_details->row()->meta_title != ''){
									echo $product_details->row()->meta_title;
								}else {
									echo 'Not available';
								}
								?>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_tag">Meta Keyword</label>
                    <div class="form_input">
                      <?php 
								if ($product_details->row()->meta_keyword != ''){
									echo $product_details->row()->meta_keyword;
								}else {
									echo 'Not available';
								}
								?>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_description">Meta Description</label>
                    <div class="form_input">
                      <?php 
								if ($product_details->row()->meta_description != ''){
									echo $product_details->row()->meta_description;
								}else {
									echo 'Not available';
								}
								?>
                    </div>
                  </div>
                </li>
              </ul>
			          <ul><li><div class="form_grid_12">
				<div class="form_input">
					<a href="admin/product/display_product_list" class="tipLeft" title="Go to property list"><span class="badge_style b_done">Back</span></a>
				</div>
			</div></li></ul>
                      </div>
            
            			<div id="tab7">
            <ul>
            <li>
                <div class="form_grid_12">
                  <label class="field_title" for="b1firstname">Property Address</label>
                  <div class="form_input">
                    <?php echo $ReservedDetails->row()->prop_address;?>
                     <span id="b1_firstname_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="b1firstname">Buyer 1 First Name<span class="req">*</span></label>
                  <div class="form_input">
                    <?php echo $ReservedDetails->row()->first_name;?>
                     <span id="b1_firstname_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="b1lastname">Buyer 1 Last Name<span class="req">*</span></label>
                  <div class="form_input">
                    <?php echo $ReservedDetails->row()->last_name;?>
                     <span id="b1_lastname_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="b2firstname">Buyer 2 First Name<span class="req">*</span></label>
                  <div class="form_input">
                   <?php echo $ReservedDetails->row()->first_name;?>
                     <span id="b2_firstname_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="b2lastname">Buyer 2 Last Name<span class="req">*</span></label>
                  <div class="form_input">
                    <?php echo $ReservedDetails->row()->last_name;?>
                     <span id="b2_lastname_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bentityname">Buyer Entity Name<span class="req">*</span></label>
                  <div class="form_input">
                 <?php echo $ReservedDetails->row()->entity_name;?>
                     <span id="b_entityname_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bentitytype">Buyer Entity Type<span class="req">*</span></label>
                  <div class="form_input">
                    <?php echo $ReservedDetails->row()->resrv_type;?>
                     <span id="b_entitytype_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="baddress">Buyer Address<span class="req">*</span></label>
                  <div class="form_input">
                    <?php echo $ReservedDetails->row()->address;?>
                     <span id="b_address_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bcity">Buyer City<span class="req">*</span></label>
                  <div class="form_input">
                   <?php echo $ReservedDetails->row()->city;?>
                     <span id="b_city_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
               <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bstate">Buyer State<span class="req">*</span></label>
                  <div class="form_input">
                 <?php echo $ReservedDetails->row()->state;?>
                     <span id="b_state_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bzipcode">Buyer zip code<span class="req">*</span></label>
                  <div class="form_input">
                    <?php echo $ReservedDetails->row()->postal_code;?>
                     <span id="b_zipcode_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bphone1">Buyer phone 1<span class="req">*</span></label>
                  <div class="form_input">
              	<?php echo $ReservedDetails->row()->phone_no;?>
                     <span id="b_phone1_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bphone2">Buyer phone 2</label>
                  <div class="form_input">
              	<?php if($ReservedDetails->row()->phone_no1!=0)echo $ReservedDetails->row()->phone_no1;else echo '';?>
                     <span id="b_phone2_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bemail1">Buyer email 1<span class="req">*</span></label>
                  <div class="form_input">
                   <?php echo $ReservedDetails->row()->email;?>
                     <span id="b_email1_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bemail2">Buyer email 2</label>
                  <div class="form_input">
                    <?php echo $ReservedDetails->row()->email1;?>
                     <span id="b_email2_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bpurchaseprice">Buyer purchase price<span class="req">*</span></label>
                  <div class="form_input">
                    <?php echo number_format($ReservedDetails->row()->sales_price,0);?>
                     <span id="b_purchase_price_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bpurchaseprice">Reserved price</label>
                  <div class="form_input">
                    <?php if($ReservedDetails->row()->id != '') echo number_format($ReservedDetails->row()->reserv_price,0);?>
                     <span id="b_purchase_price_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bpurchaseprice">In Form Of</label>
                  <div class="form_input">
                  	<?php if($ReservedDetails->row()->cash_payment!= '') echo $ReservedDetails->row()->cash_payment;?>
                    <?php if($ReservedDetails->row()->check_payment!= '') echo $ReservedDetails->row()->check_payment;?>
                    <?php if($ReservedDetails->row()->credit_payment!= '') echo $ReservedDetails->row()->credit_payment;?>
                     <span id="b_purchase_price_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bpurchaseprice">Reservation Source</label>
                  <div class="form_input">
                  	<?php echo $ReservedDetails->row()->res_source;?>
                     <span id="b_purchase_price_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bpurchaseprice">Sales Type</label>
                  <div class="form_input">
                    <?php if($ReservedDetails->row()->sales_sdira!= '') echo $ReservedDetails->row()->sales_sdira;?>
                    <?php if($ReservedDetails->row()->sales_sl!= '') echo $ReservedDetails->row()->sales_sl;?> 
                    <?php if($ReservedDetails->row()->sales_cash!= '') echo $ReservedDetails->row()->sales_cash;?> 
                    <?php if($ReservedDetails->row()->sales_cf!= '') echo $ReservedDetails->row()->sales_cf;?>
                    <?php if($ReservedDetails->row()->sales_fs!= '') echo $ReservedDetails->row()->sales_fs;?> 
                   <span id="b_purchase_price_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <?php if($ReservedDetails->row()->sales_fs != '' || $ReservedDetails->row()->sales_sl != '' || $ReservedDetails->row()->sales_sdira != '') {?>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bpurchaseprice">Custodian Name</label>
                  <div class="form_input">
                  	<?php echo $ReservedDetails->row()->cust_name; ?>
                     <span id="b_purchase_price_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="bpurchaseprice">Account Number</label>
                  <div class="form_input">
                  	<?php echo $ReservedDetails->row()->account_no; ?>                   
                     <span id="b_purchase_price_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <?php } ?>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sale_date">Code</label>
                  <div class="form_input">
                    <?php if($ReservedDetails->row()->id != '') echo $ReservedDetails->row()->res_code;?>
                     <span id="sale_date_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sale_date">Notes</label>
                  <div class="form_input">
                    <?php if($ReservedDetails->row()->id != '') echo $ReservedDetails->row()->note;?>
                     <span id="sale_date_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <li>
                <div class="form_grid_12">
                  <label class="field_title" for="sale_date">Sale Date<span class="req">*</span></label>
                  <div class="form_input">
                    <?php echo date('Y-m-d', strtotime($ReservedDetails->row()->dateAdded));?>
                     <span id="sale_date_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
             <li>
            	<div class="form_grid_12">
                    <div class="form_input">
                        <a href="admin/product/display_product_list" class="tipLeft" title="Go to property list"><span class="badge_style b_done">Back</span></a>
                    </div>
                </div>
             </li>
            </ul>
            </div>
              <?php  extract($source_info); ?>
			  <div id="tab8" class="tab_common_class">
            <ul>
            <li>
            <h4>Sourcer Info</h4>
            </li>
             <li>
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
                  <label class="field_title" for="saddress">Sourcer City</label>
                  <div class="form_input">
                  <?php echo $s_city;?>
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
            <!--    <li>
                <div class="form_grid_12">
                  <div class="form_input">
                   <a href="admin/product/display_product_list" class="tipLeft" title="Go to property list"><span class="badge_style b_done">Back</span></a>
                  </div>
                </div>
              </li>
             </ul>
              </div>
              <div id="tab2" class="tab_common_class">
              <ul>-->
              <li><h4>Property Management Info</h4></li>
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
               <!--<li>
                <div class="form_grid_12">
                  <div class="form_input">
                   <a href="admin/product/display_product_list" class="tipLeft" title="Go to property list"><span class="badge_style b_done">Back</span></a>
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
                  <label class="field_title" for="sprice">Settlement  Date</label>
                  <div class="form_input">
                  <?php echo $settlement;?>  
                     <span id="settlement_date_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
               <!--<li>
                <div class="form_grid_12">
                  <div class="form_input">
                   <a href="admin/product/display_product_list" class="tipLeft" title="Go to property list"><span class="badge_style b_done">Back</span></a>
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
               <!--<li>
                <div class="form_grid_12">
                  <div class="form_input">
                    <a href="admin/product/display_product_list" class="tipLeft" title="Go to property list"><span class="badge_style b_done">Back</span></a>
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
              <!-- <li>
                <div class="form_grid_12">
                  <div class="form_input">
                  <a href="admin/product/display_product_list" class="tipLeft" title="Go to property list"><span class="badge_style b_done">Back</span></a>
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
              <!-- <li>
                <div class="form_grid_12">
                  <div class="form_input">
                    <a href="admin/product/display_product_list" class="tipLeft" title="Go to property list"><span class="badge_style b_done">Back</span></a>
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
                   <?php echo $in_fax;?>   
                     <span id="in_fax_warn" class="redfont" style="color:#F00;"></span>
                  </div>
                </div>
              </li>
              <!-- <li>
                <div class="form_grid_12">
                  <div class="form_input">
                   <a href="admin/product/display_product_list" class="tipLeft" title="Go to property list"><span class="badge_style b_done">Back</span></a>
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
                  <a href="admin/product/display_product_list" class="tipLeft" title="Go to property list"><span class="badge_style b_done">Back</span></a>
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
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>