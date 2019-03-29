<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Add New Manager</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'addmanager_form', 'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/manager/insertEditManager',$attributes) 
					?>
	 						<ul>
	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="m_email">Manager Email <span class="req">*</span></label>
									<div class="form_input">
										<input name="m_email" id="m_email" type="text" tabindex="1" class="large tipTop" title="Please enter the manager email"/>
                                       <div id="m_email_warn"  style="float:right; color:#FF0000;"></div>
									</div>
                                     
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="m_name">Manager Name</label>
									<div class="form_input">
										<input name="m_name" id="m_name" type="text" tabindex="1" class="large tipTop" title="Please enter the manager name"/>
                                       <div id="m_name_warn"  style="float:right; color:#FF0000;"></div>
									</div>
                                     
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="m_address">Manager Address </label>
									<div class="form_input">
										<input name="m_address" id="m_address" type="text" tabindex="1" class="large tipTop" title="Please enter the manager address"/>
                                       <div id="m_addresm_warn"  style="float:right; color:#FF0000;"></div>
									</div>
                                     
								</div>
								</li>
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="m_city">Manager City </label>
									<div class="form_input">
										<input name="m_city" id="m_city" type="text" tabindex="1" class="large tipTop" title="Please enter the manager city"/>
                                       <div id="m_city_warn"  style="float:right; color:#FF0000;"></div>
									</div>
                                     
								</div>
								</li>
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="m_state">Manager State </label>
									<div class="form_input">
										<input name="m_state" id="m_state" type="text" tabindex="1" class="large tipTop" title="Please enter the manager state"/>
                                       <div id="m_state_warn"  style="float:right; color:#FF0000;"></div>
									</div>
                                     
								</div>
								</li>
                                
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="m_zipcode">Manager Zipcode </label>
									<div class="form_input">
										<input name="m_zipcode" id="m_zipcode" type="text" tabindex="1" class="large tipTop" title="Please enter the manager zipcode"/>
                                       <div id="m_zipcode_warn"  style="float:right; color:#FF0000;"></div>
									</div>
                                     
								</div>
								</li>
                                
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="m_contact_1">Manager Contact 1 </label>
									<div class="form_input">
										<input name="m_contact_1" id="m_contact_1" type="text" tabindex="1" class="large tipTop" title="Please enter the manager contact 1"/>
                                       <div id="m_contact_1_warn"  style="float:right; color:#FF0000;"></div>
									</div>
                                     
								</div>
								</li>
                                
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="m_contact_2">Manager Contact 2 </label>
									<div class="form_input">
										<input name="m_contact_2" id="m_contact_2" type="text" tabindex="1" class="large tipTop" title="Please enter the manager contact 2"/>
                                       <div id="m_contact_2_warn"  style="float:right; color:#FF0000;"></div>
									</div>
                                     
								</div>
								</li>
                                
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="m_phone_1">Manager Phone 1 </label>
									<div class="form_input">
										<input name="m_phone_1" id="m_phone_1" type="text" tabindex="1" class="large tipTop" title="Please enter the manager phone 1"/>
                                       <div id="m_phone_1_warn"  style="float:right; color:#FF0000;"></div>
									</div>
                                     
								</div>
								</li>
                                
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="m_phone_2">Manager Phone 2 </label>
									<div class="form_input">
										<input name="m_phone_2" id="m_phone_2" type="text" tabindex="1" class="large tipTop" title="Please enter the manager phone 2"/>
                                       <div id="m_phone_2_warn"  style="float:right; color:#FF0000;"></div>
									</div>
                                     
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="m_fax">Manager Fax </label>
									<div class="form_input">
										<input name="m_fax" id="m_fax" type="text" tabindex="1" class="large tipTop" title="Please enter the manager fax"/>
                                       <div id="m_fax_warn"  style="float:right; color:#FF0000;"></div>
									</div>
                                     
								</div>
								</li>
                                
                                 
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="m_tenant_name">Tenant Name</label>
									<div class="form_input">
										<input name="m_tenant_name" id="m_tenant_name" type="text" tabindex="1" class="large tipTop" title="Please enter the Tenant Name"/>
                                       <div id="m_tenant_name_warn"  style="float:right; color:#FF0000;"></div>
									</div>
                                     
								</div>
								</li>
                                
                                 
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="m_lease_term">Lease Term (#of Months)</label>
									<div class="form_input">
										<input name="m_lease_term" id="m_lease_term" type="text" tabindex="1" class="large tipTop" title="Please enter the Lease Term"/>
                                       <div id="m_lease_term_warn"  style="float:right; color:#FF0000;"></div>
									</div>
                                     
								</div>
								</li>
                                
                                 
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="m_section">Section 8</label>
									<div class="form_input">
										<input name="m_section" id="m_section" type="text" tabindex="1" class="large tipTop" title="Please enter the manager section 8"/>
                                       <div id="m_section_warn"  style="float:right; color:#FF0000;"></div>
									</div>
                                     
								</div>
								</li>
                                
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="m_fee">Manager Fees(%) </label>
									<div class="form_input">
										<input name="m_fee" id="m_fee" type="text" tabindex="1" class="large tipTop" title="Please enter the manager Fees"/>
                                       <div id="m_fee_warn"  style="float:right; color:#FF0000;"></div>
									</div>
                                     
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status <span class="req">*</span></label>
									<div class="form_input">
										<div class="active_inactive">
											<input type="checkbox" tabindex="8" name="status" checked="checked" id="status" class="active_inactive"/>
                                        </div>
									</div>
								</div>
								</li>
                                
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="button" class="btn_small btn_blue" tabindex="9" onclick="addmanagerVal();"><span>Submit</span></button>
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
function addmanagerVal(){

	if(jQuery.trim($("#m_email").val()) == ''){
		$("#m_email_warn").html('');
		$("#m_email_warn").html('Manager Email is Required');
		$("#m_email").focus();
		return false;
	}else if(IsEmail($("#m_email").val()) == 0 ){
		$("#m_email_warn").html('');
		$("#m_email_warn").html('Email Id Not Valid');
		$("#m_email").focus();
		return false;	
	}else{	
		var emailval = $('#m_email').val();
		//alert(emailval);
		$.ajax({
			type: 'POST',
			url: baseURL+'admin/manager/Get_Manager_Check',
			data: {"semail": emailval},
			success: function(response)
			{
				//alert(response);
				if(parseInt(response) > 0) {
					$("#m_email_warn").html('');
					$("#m_email_warn").html('Manager Email Already Exists');
					$("#m_email").focus();
					return false;
				 } else {
					 $("#addmanager_form").submit();
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