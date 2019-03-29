<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Edit Sourcer</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'editsourcer_form', 'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/sourcer/insertEditSourcer',$attributes) 
					?>
	 						<ul>
	 							
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="s_email">Sourcer Email <span class="req">*</span></label>
									<div class="form_input">
										<input name="s_email" id="s_email" type="text" tabindex="1" class="large tipTop" value="<?php echo $sourcer_details->row()->s_email;?>" title="Please enter the sourcer email"/>
                                       <div id="s_email_warn"  style="float:right; color:#FF0000;"></div>
									</div>
                                     
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="s_first_name">Sourcer First Name</label>
									<div class="form_input">
										<input name="s_first_name" id="s_first_name" type="text" tabindex="1" class="large tipTop" value="<?php echo $sourcer_details->row()->s_first_name;?>" title="Please enter the sourcer first name"/>
                                       <div id="s_first_name_warn"  style="float:right; color:#FF0000;"></div>
									</div>
                                     
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="s_last_name">Sourcer Last Name  </label>
									<div class="form_input">
										<input name="s_last_name" id="s_last_name" type="text" tabindex="1" class="large tipTop" value="<?php echo $sourcer_details->row()->s_last_name;?>" title="Please enter the sourcer last name"/>
                                       <div id="s_last_name_warn"  style="float:right; color:#FF0000;"></div>
									</div>
                                     
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="s_company_name">Sourcer Company Name </label>
									<div class="form_input">
										<input name="s_company_name" id="s_company_name" type="text" tabindex="1" class="large tipTop" value="<?php echo $sourcer_details->row()->s_company_name;?>" title="Please enter the sourcer company name"/>
                                       <div id="s_company_name_warn"  style="float:right; color:#FF0000;"></div>
									</div>
                                     
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="s_address">Sourcer Address </label>
									<div class="form_input">
										<input name="s_address" id="s_address" type="text" tabindex="1" class="large tipTop" value="<?php echo $sourcer_details->row()->s_address;?>" title="Please enter the sourcer address"/>
                                       <div id="s_address_warn"  style="float:right; color:#FF0000;"></div>
									</div>
                                     
								</div>
								</li>
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="s_city">Sourcer City </label>
									<div class="form_input">
										<input name="s_city" id="s_city" type="text" tabindex="1" class="large tipTop" value="<?php echo $sourcer_details->row()->s_city;?>" title="Please enter the sourcer city"/>
                                       <div id="s_city_warn"  style="float:right; color:#FF0000;"></div>
									</div>
                                     
								</div>
								</li>
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="s_state">Sourcer State </label>
									<div class="form_input">
										<input name="s_state" id="s_state" type="text" tabindex="1" class="large tipTop" value="<?php echo $sourcer_details->row()->s_state;?>" title="Please enter the sourcer state"/>
                                       <div id="s_state_warn"  style="float:right; color:#FF0000;"></div>
									</div>
                                     
								</div>
								</li>
                                
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="s_zipcode">Sourcer Zipcode </label>
									<div class="form_input">
										<input name="s_zipcode" id="s_zipcode" type="text" tabindex="1" class="large tipTop" value="<?php echo $sourcer_details->row()->s_zipcode;?>" title="Please enter the sourcer zipcode"/>
                                       <div id="s_zipcode_warn"  style="float:right; color:#FF0000;"></div>
									</div>
                                     
								</div>
								</li>
                                
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="s_contact_1">Sourcer Contact 1 </label>
									<div class="form_input">
										<input name="s_contact_1" id="s_contact_1" type="text" tabindex="1" class="large tipTop" value="<?php echo $sourcer_details->row()->s_contact_1;?>" title="Please enter the sourcer contact 1"/>
                                       <div id="s_contact_1_warn"  style="float:right; color:#FF0000;"></div>
									</div>
                                     
								</div>
								</li>
                                
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="s_contact_2">Sourcer Contact 2 </label>
									<div class="form_input">
										<input name="s_contact_2" id="s_contact_2" type="text" tabindex="1" class="large tipTop" value="<?php echo $sourcer_details->row()->s_contact_2;?>" title="Please enter the sourcer contact 2"/>
                                       <div id="s_contact_2_warn"  style="float:right; color:#FF0000;"></div>
									</div>
                                     
								</div>
								</li>
                                
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="s_phone_1">Sourcer Phone 1 </label>
									<div class="form_input">
										<input name="s_phone_1" id="s_phone_1" type="text" tabindex="1" class="large tipTop" value="<?php echo $sourcer_details->row()->s_phone_1;?>" title="Please enter the sourcer phone 1"/>
                                       <div id="s_phone_1_warn"  style="float:right; color:#FF0000;"></div>
									</div>
                                     
								</div>
								</li>
                                
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="s_phone_2">Sourcer Phone 2 </label>
									<div class="form_input">
										<input name="s_phone_2" id="s_phone_2" type="text" tabindex="1" class="large tipTop" value="<?php echo $sourcer_details->row()->s_phone_2;?>" title="Please enter the sourcer phone 2"/>
                                       <div id="s_phone_2_warn"  style="float:right; color:#FF0000;"></div>
									</div>
                                     
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="s_fax">Sourcer Fax </label>
									<div class="form_input">
										<input name="s_fax" id="s_fax" type="text" tabindex="1" class="large tipTop" value="<?php echo $sourcer_details->row()->s_fax;?>" title="Please enter the sourcer fax"/>
                                       <div id="s_fax_warn"  style="float:right; color:#FF0000;"></div>
									</div>
                                     
								</div>
								</li>
                                
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="s_price">Sourcer Price ($)</label>
									<div class="form_input">
										<input name="s_price" id="s_price" type="text" tabindex="1" class="large tipTop" value="<?php echo $sourcer_details->row()->s_price;?>" title="Please enter the sourcer price"/>
                                       <div id="s_price_warn"  style="float:right; color:#FF0000;"></div>
									</div>
                                     
								</div>
								</li>
								
								
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status <span class="req">*</span></label>
									<div class="form_input">
										<div class="active_inactive">
											<input type="checkbox" name="status" <?php if ($sourcer_details->row()->status == 'Active'){echo 'checked="checked"';}?> id="active_inactive_active" class="active_inactive"/>
										</div>
									</div>
								</div>
								<input type="hidden" name="sourcer_id" value="<?php echo $sourcer_details->row()->id;?>"/>
								</li>
                                
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="button" class="btn_small btn_blue" onclick="editsourcerVal();" tabindex="4"><span>Update</span></button>
									</div>
								</div>
								</li>
							</ul>
						</form>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>

<script type="text/javascript">
function editsourcerVal(){

	if(jQuery.trim($("#s_email").val()) == ''){
		$("#s_email_warn").html('');
		$("#s_email_warn").html('Sourcer Email is Required');
		$("#s_email").focus();
		return false;
	}else if(IsEmail($("#s_email").val()) == 0 ){
		$("#s_email_warn").html('');
		$("#s_email_warn").html('Email Id Not Valid');
		$("#s_email").focus();
		return false;	
	}else{	
		var emailval = $('#s_email').val();
		//alert(emailval);
		$.ajax({
			type: 'POST',
			url: baseURL+'admin/sourcer/Get_Sourcer_Check',
			data: {"semail": emailval},
			success: function(response)
			{
				//alert(response);
				if(parseInt(response) > 1) {
					$("#s_email_warn").html('');
					$("#s_email_warn").html('Sourcer Email Already Exists');
					$("#s_email").focus();
					return false;
				 } else {
					 $("#editsourcer_form").submit();
					return true;
				 }
				
			}
		});

	}
}

function IsEmail(email_address) {
	var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(!regex.test(email_address)) {
    	return 0;
    }else{
    	return 1;
	}
}	 

</script>

<?php 
$this->load->view('admin/templates/footer.php');
?>