<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Add New User</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'adduser_form', 'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/users/insertEditUser',$attributes) 
					?>
	 						<ul>
	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="first_name">First Name <span class="req">*</span></label>
									<div class="form_input">
										<input name="first_name" id="first_name" type="text" tabindex="1" class="required large tipTop" title="Please enter the user first name"/>
                                        <div id="first_name_warn"  style="float:right; color:#FF0000;"></div>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="last_name">Last Name <span class="req">*</span></label>
									<div class="form_input">
										<input name="last_name" id="last_name" type="text" tabindex="2" class=" required large tipTop" title="Please enter the last name"/>
                                        <div id="last_name_warn"  style="float:right; color:#FF0000;"></div>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="user_name">User Name <span class="req">*</span></label>
									<div class="form_input">
										<input name="user_name" id="user_name" type="text" tabindex="2" class="required large tipTop" title="Please enter the username"/>
                                        <div id="user_name_warn"  style="float:right; color:#FF0000;"></div>
									</div>
								</div>
								</li>
	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="email">Email Address <span class="req">*</span></label>
									<div class="form_input">
										<input name="email" id="email" type="text" tabindex="4" class="required large tipTop" title="Please enter the user email address"/>
                                        <div id="email_warn"  style="float:right; color:#FF0000;"></div>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="new_password">New Password <span class="req">*</span></label>
									<div class="form_input">
										<input name="new_password" id="new_password" type="password" tabindex="4" class="required large tipTop" title="Please enter the new password"/>
                                        <div id="new_password_warn"  style="float:right; color:#FF0000;"></div>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="confirm_password">Re-type Password <span class="req">*</span></label>
									<div class="form_input">
										<input name="confirm_password" id="confirm_password" type="password" tabindex="4" class="required large tipTop" title="Please re-type the above password"/>
                                        <div id="confirm_password_warn"  style="float:right; color:#FF0000;"></div>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="address1">Address <span class="req">*</span></label>
									<div class="form_input">
										<input name="address" id="address" type="text" tabindex="4" class="required large tipTop" title="Please enter the user address"/>
                                        <div id="address1_warn"  style="float:right; color:#FF0000;"></div>
									</div>
								</div>
								</li>
                                <?php /*<li>
								<div class="form_grid_12">
									<label class="field_title" for="address2">Address 2</label>
									<div class="form_input">
										<input name="address2" id="address2" type="text" tabindex="4" class="large tipTop" title="Please enter the user address"/>
                                        
									</div>
								</div>
								</li>*/ ?>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="city">City <span class="req">*</span></label>
									<div class="form_input">
										<input name="city" id="city" type="text" tabindex="4" class="required large tipTop" title="Please enter the user city"/>
                                        <div id="city_warn"  style="float:right; color:#FF0000;"></div>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="state">State <span class="req">*</span></label>
									<div class="form_input">
										<input name="state" id="state" type="text" tabindex="4" class="required large tipTop" title="Please enter the user state"/>
                                        <div id="state_warn"  style="float:right; color:#FF0000;"></div>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="phone">Phone Number <span class="req">*</span></label>
									<div class="form_input">
										<input name="phone_no" id="phone_no" type="text" tabindex="4" class="required number large tipTop" title="Please enter the user phone number"/>
                                        <div id="phone_no_warn"  style="float:right; color:#FF0000;"></div>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="email"><b>(Optional)</b></label>
									<div class="form_input">&nbsp;</div>
									
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="email">Email1</label>
									<div class="form_input">
										<input name="email1" style=" width:295px" id="email1" value="" type="text" tabindex="1" class="tipTop" title="Please enter the user email address"/>
                                        <div id="email1_warn"  style="float:right; color:#FF0000;"></div>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="email">Phone Number 1</label>
									<div class="form_input">
										<input name="phone_no1" style=" width:295px" id="phone_no1" value="" type="text" tabindex="1" class="tipTop" title="Please enter the user phone no1"/>
                                        
									</div>
								</div>
								</li>
                               <!-- <li>
								<div class="form_grid_12">
									<label class="field_title" for="group">Group </label>
									<div class="form_input">
										<div class="user_renter">
											<input type="checkbox" tabindex="4" name="group" checked="checked" id="User_Seller_User" class="User_Renter"/>
										</div>
									</div>
								</div>
								</li>-->
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status <span class="req">*</span></label>
									<div class="form_input">
										<div class="active_inactive">
											<input type="checkbox" tabindex="8" name="status" checked="checked" id="active_inactive_active" class="active_inactive"/>
										</div>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="9"><span>Submit</span></button>
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
<!--<script type="text/javascript">
$(function() {
			$("#adduser_form").submit(function(){
				// var email = $('#vendor_email').val();
				//alert('');
				 $("#first_name_warn").html('');
				 $("#last_name_warn").html('');
				 $("#user_name_warn").html('');
				 $("#email_warn").html('');
				 $("#new_password_warn").html('');
				 $("#confirm_password_warn").html('');
				 $("#address1_warn").html('');
				 $("#city_warn").html('');
				 $("#state_warn").html('');
				 $("#ph_no_warn").html('');
				 
				 $("#password_warn").html('');
				 
				
				
					if(jQuery.trim($("#first_name").val()) == ''){
						
						$("#first_name_warn").html('First name is required');
						$("#first_name").focus();
						return false;
					}
					else if(jQuery.trim($("#last_name").val()) == ''){
					  
						$("#last_name_warn").html('Last name is required');
						$("#last_name").focus();
						return false;
						
					}
					else if(jQuery.trim($("#user_name").val()) == ''){
					  
						$("#user_name_warn").html('User name is required');
						$("#user_name").focus();
						return false;
						
					}
					else if(jQuery.trim($("#email").val()) == ''){
					  
						$("#email_warn").html('Email address is required');
						$("#email").focus();
						return false;
						
					}
					else if(IsEmail(jQuery.trim($("#email").val())) == false){
					  
						$("#email_warn").html('Please enter valid email address');
						$("#email").focus();
						return false;
						
					}
					else if(jQuery.trim($("#new_password").val()) == ''){
					  
						$("#new_password_warn").html('Email address is required');
						$("#new_password").focus();
						return false;
						
					}
					else if(jQuery.trim($("#confirm_password").val()) != jQuery.trim($("#new_password").val())){
					  
						$("#confirm_password_warn").html('Email address is required');
						$("#confirm_password").focus();
						return false;
						
					}
					else if(jQuery.trim($("#address1").val()) == ''){
						
						$("#address1_warn").html('Address is required');
						$("#address1").focus();
						return false;
					}
					else if(jQuery.trim($("#city").val()) == ''){
					  
						$("#city_warn").html('City is required');
						$("#city").focus();
						return false;
						
					}
					else if(jQuery.trim($("#state").val()) == ''){
						
						$("#state_warn").html('State is required');
						$("#state").focus();
						return false;
					}
					else if(jQuery.trim($("#ph_no").val()) == ''){
						
						$("#ph_no_warn").html('Phone number is required');
						$("#ph_no").focus();
						return false;
					}
					else
					{	
					      	$("#adduser_form").submit();
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
</script>-->
<?php 
$this->load->view('admin/templates/footer.php');
?>