<?php $this->load->view('site/templates/new_header'); ?>
<style>
    .form-group span {
        color: red;
    }
</style>
<div class="main_sec">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-12 text-center">
                <h2><?php echo $signup->row()->page_title; ?></h2>
                <p><?php echo $signup->row()->description; ?></p>
                <br>
            </div>
            <div class="col col-lg-6">
         					<?php echo form_open('site/user/registerUser',array('id'=>'SignupForm')); ?>
        						<div class="field_login form-group">
                                	<label>First Name<span>*</span></label>
                                    <input type="text" name="first_name" id="first_name" class="field_login form-control required"  />
                                    <div id="first_name_warn"  style="color:#FF0000;"></div>
                                </div>
                                <div class="field_login form-group">
                                	<label>Last Name<span>*</span></label>
                                    <input type="text" name="last_name" id="last_name"  class="field_login form-control required"  />
                                    <div id="last_name_warn"  style="color:#FF0000;"></div>
                                </div>
                                <div class="field_login form-group">
                                	<label>Email Address<span>*</span></label>
                                    <input type="text" name="email" id="email"  class="field_login form-control required" />
                                    <div id="email_warn"  style="color:#FF0000;"></div>
                                </div>
                                 <div class="field_login form-group">
                                	<label>Street Address 1<span>*</span></label>
                                    <input type="text" name="address" id="address" class="field_login form-control required" />
                                    <div id="address_warn"  style="color:#FF0000;"></div>
                                </div>
                                   <div class="field_login form-group">
                                	<label>Street Address 2</label>
                                    <input type="text" name="address1" id="address1" class="field_login form-control required" />
                                    <div id="address1_warn"  style="color:#FF0000;"></div>
                                </div>
                                <div class="field_login form-group">
                                	<label>City <span>*</span></label>
                                    <input type="text" name="city" id="city" class="field_login form-control required" />
                                    <div id="city_warn"  style="color:#FF0000;"></div>
                                </div>
                                <div class="field_login form-group">
                                	<label>State<span>*</span></label>
                                    <input type="text" name="state" id="state" class="field_login form-control required" />
                                    <div id="state_warn"  style="color:#FF0000;"></div>
                                </div>
                                <div class="field_login form-group">
                                	<label>Country<span>*</span></label>
                                    <input type="text" name="country" id="country" class="field_login form-control required" />
                                    <div id="country_warn"  style="color:#FF0000;"></div>
                                </div>
                                <div class="field_login form-group">
                                	<label>Post code<span>*</span></label>
                                    <input type="text" name="post" id="post" class="field_login form-control required" />
                                    <div id="post_warn"  style="color:#FF0000;"></div>
                                </div>
                                <div class="field_login form-group">
                                	<label>Phone #<span>*</span></label>
                                    <input type="text" name="ph_no" id="ph_no" class="field_login form-control required" />
                                    <div id="ph_no_warn"  style="color:#FF0000;"></div>
                                </div>
                               
                                 <div class="field_login form-group">
                                	<label>How did you hear about us </label>
                                    <input type="text" name="how_heared" id="how_heared" class="field_login form-control required" />
                                    <div id="how_heared_warn"  style="color:#FF0000;"></div>
                                </div>
                                 <div class="field_login form-group">
                                	<label>User Name<span>*</span></label>
                                    <input type="text" name="user_name" id="user_name" class="field_login form-control required" />
                                    <div id="user_name_warn"  style="color:#FF0000;"></div>
                                </div>
                                 <div class="field_login form-group">
                                	<label>Password<span>*</span></label>
                                    <input type="password" name="password" id="password" class="field_login form-control required" />
                                    <div id="password_warn"  style="color:#FF0000;"></div>
                                </div>
                                <div class="field_login form-group">
                                	<label>Confirm Password<span>*</span></label>
                                    <input type="password" name="cnf_password" id="cnf_password" class="field_login form-control required" />
                                    <div id="cnf_password_warn"  style="color:#FF0000;"></div>
                                </div>
                                
                                <div class="field_login form-group">
                                	<label >Enter the text given below<span>*</span>
                                    
                                    <div class="code_full">
                                    <div class="field_login form-group">
                                <div style="border: 1px solid #CCCCCC;color: #000000; float: left; font-size: 3em;font-style: oblique;font-weight: bold; height: 1em; line-height: 1em;text-align: center; text-decoration: line-through; width: 99%;">
                                <?php $random_values = substr(number_format(time() * rand(),0,'',''),0,7); ?>
                                 <span style="color: #990000;float:inherit; text-align:left; text-decoration: line-through; transform: rotate(-12deg); font-size:15px"><?php echo $random_values; ?></span></div>
                                 <input type="hidden" name="captcha_original" id="captcha_original" value="<?php echo $random_values; ?>" />
                                 </div>
                                    </div>
                                    </label>
                                    <input type="text" name="captcha" id="captcha" class="field_login form-control required" value="" equalto="#captcha_original" >
                                    <div id="captcha_warn"  style="color:#FF0000;"></div>
                                </div>

                                
                                <div class="field_login form-group" >
                           
                                         <input type="submit" name="signin" id="signin" class="member_btn btn btn-primary" value="REGISTER"  style="border:none;" />

                                    <div class="pull-right"><?php echo 'Already a Member? '; echo '<a href="'.base_url(signin).'" >Click Here</a>'; ?></div>
                                    
                                </div>
        				</form>

            </div>
        </div>
    </div>
</div>
<div class="clear"></div>


	

 </div>
	 </div>
     
<script type="text/javascript">
$(function() {
			$("#SignupForm").submit(function(){
				// var email = $('#vendor_email').val();
				//alert('');
				 $("#first_name_warn").html('');
				 $("#last_name_warn").html('');
				 $("#email_warn").html('');
				 $("#address_warn").html('');
				 $("#city_warn").html('');
				 $("#state_warn").html('');
				 $("#country_warn").html('');
				 $("#post_warn").html('');
				 $("#ph_no_warn").html('');
				 $("#user_name_warn").html('');
				 $("#password_warn").html('');
				 $("#cnf_password_warn").html('');
				 $("#captcha_warn").html('');
				
				
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
					else if(jQuery.trim($("#address").val()) == ''){
						
						$("#address_warn").html('Address is required');
						$("#address").focus();
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
					else if(jQuery.trim($("#country").val()) == ''){
						
						$("#country_warn").html('Country is required');
						$("#country").focus();
						return false;
					}
					else if(jQuery.trim($("#post").val()) == ''){
						
						$("#post_warn").html('Post code is required');
						$("#post").focus();
						return false;
					}
					else if(jQuery.trim($("#ph_no").val()) == ''){
						
						$("#ph_no_warn").html('Phone number is required');
						$("#ph_no").focus();
						return false;
					}
					else if(jQuery.trim($("#user_name").val()) == ''){
					  
						$("#user_name_warn").html('User name is required');
						$("#user_name").focus();
						return false;
						
					}
					else if(jQuery.trim($("#password").val()) == ''){
						
						$("#password_warn").html('Password is required');
						$("#password").focus();
						return false;
					}
					else if(jQuery.trim($("#cnf_password").val()) != jQuery.trim($("#password").val())){
						
						$("#cnf_password_warn").html('Passwords donot match');
						$("#cnf_password").focus();
						return false;
					}
					else if(jQuery.trim($("#captcha").val()) == ''){
						
						$("#captcha_warn").html('captcha is required');
						$("#captcha").focus();
						return false;
					}
					else if(jQuery.trim($("#captcha").val()) != jQuery.trim($("#captcha_original").val())){
						
						$("#captcha_warn").html('captcha dose not match');
						$("#captcha").focus();
						return false;
						
					}
					else
					{	
					      	$("#SignupForm").submit();
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
<?php $this->load->view('site/templates/new_footer'); ?>
