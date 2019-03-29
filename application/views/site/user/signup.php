<?php $this->load->view('site/templates/header'); ?>
<div class="listing_content" style="margin:20px 0 15px 0px;">
		<div class="freemember">
       
        <h2><?php echo $signup->row()->page_title; ?></h2>
         <?php echo $signup->row()->description; ?>
         <div class="clear"></div>
         <div style="margin:10px 0px 35px 23px"><font size="3"><?php echo 'Already a Member? '; echo '<a href="'.base_url(signin).'" style="color:#FF0000">Click Here</a>'; ?></font></div>
         					<?php echo form_open('site/user/registerUser',array('id'=>'SignupForm')); ?>
        						<div class="field_login">
                                	<label>First Name<span>*</span></label>
                                    <input type="text" name="first_name" id="first_name" class="scroll_5 required"  />
                                    <div id="first_name_warn"  style="float:left; color:#FF0000;"></div>
                                </div>
                                <div class="field_login">
                                	<label>Last Name<span>*</span></label>
                                    <input type="text" name="last_name" id="last_name"  class="scroll_5 required"  />
                                    <div id="last_name_warn"  style="float:left; color:#FF0000;"></div>
                                </div>
                                <div class="field_login">
                                	<label>Email Address<span>*</span></label>
                                    <input type="text" name="email" id="email"  class="scroll_5 required" />
                                    <div id="email_warn"  style="float:left; color:#FF0000;"></div>
                                </div>
                                 <div class="field_login">
                                	<label>Street Address 1<span>*</span></label>
                                    <input type="text" name="address" id="address" class="scroll_5 required" />
                                    <div id="address_warn"  style="float:left; color:#FF0000;"></div>
                                </div>
                                   <div class="field_login">
                                	<label>Street Address 2</label>
                                    <input type="text" name="address1" id="address1" class="scroll_5 required" />
                                    <div id="address1_warn"  style="float:left; color:#FF0000;"></div>
                                </div>
                                <div class="field_login">
                                	<label>City <span>*</span></label>
                                    <input type="text" name="city" id="city" class="scroll_5 required" />
                                    <div id="city_warn"  style="float:left; color:#FF0000;"></div>
                                </div>
                                <div class="field_login">
                                	<label>State<span>*</span></label>
                                    <input type="text" name="state" id="state" class="scroll_5 required" />
                                    <div id="state_warn"  style="float:left; color:#FF0000;"></div>
                                </div>
                                <div class="field_login">
                                	<label>Country<span>*</span></label>
                                    <input type="text" name="country" id="country" class="scroll_5 required" />
                                    <div id="country_warn"  style="float:left; color:#FF0000;"></div>
                                </div>
                                <div class="field_login">
                                	<label>Post code<span>*</span></label>
                                    <input type="text" name="post" id="post" class="scroll_5 required" />
                                    <div id="post_warn"  style="float:left; color:#FF0000;"></div>
                                </div>
                                <div class="field_login">
                                	<label>Phone #<span>*</span></label>
                                    <input type="text" name="ph_no" id="ph_no" class="scroll_5 required" />
                                    <div id="ph_no_warn"  style="float:left; color:#FF0000;"></div>
                                </div>
                               
                                 <div class="field_login">
                                	<label>How did you hear about us </label>
                                    <input type="text" name="how_heared" id="how_heared" class="scroll_5 required" />
                                    <div id="how_heared_warn"  style="float:left; color:#FF0000;"></div>
                                </div>
                                 <div class="field_login">
                                	<label>User Name<span>*</span></label>
                                    <input type="text" name="user_name" id="user_name" class="scroll_5 required" />
                                    <div id="user_name_warn"  style="float:left; color:#FF0000;"></div>
                                </div>
                                 <div class="field_login">
                                	<label>Password<span>*</span></label>
                                    <input type="password" name="password" id="password" class="scroll_5 required" />
                                    <div id="password_warn"  style="float:left; color:#FF0000;"></div>
                                </div>
                                <div class="field_login">
                                	<label>Confirm Password<span>*</span></label>
                                    <input type="password" name="cnf_password" id="cnf_password" class="scroll_5 required" />
                                    <div id="cnf_password_warn"  style="float:left; color:#FF0000;"></div>
                                </div>
                                
                                <div class="field_login">
                                	<label style="height:30px;">Enter the text given below<span>*</span>
                                    
                                    <div class="code_full">
                                    <div class="field_login">
                                <div style="border: 1px solid #CCCCCC;color: #000000; float: left; font-size: 3em;font-style: oblique;font-weight: bold; height: 1em; line-height: 1em;text-align: center; text-decoration: line-through; width: 99%;">
                                <?php $random_values = substr(number_format(time() * rand(),0,'',''),0,7); ?>
                                 <span style="color: #990000;float:inherit; text-align:left; text-decoration: line-through; transform: rotate(-12deg); font-size:15px"><?php echo $random_values; ?></span></div>
                                 <input type="hidden" name="captcha_original" id="captcha_original" value="<?php echo $random_values; ?>" />
                                 </div>
                                    
                                    
                                    
                                    <!--<img src="images/site/fi.jpg" style="margin-bottom:5px;" />-->
                                    </div>
                                    </label>
                                    <input type="text" name="captcha" id="captcha" class="scroll_5 required" value="" equalto="#captcha_original" >
                                    <div id="captcha_warn"  style="float:left; color:#FF0000;"></div>
                                </div>
                                
                                
                                <div class="field_login" style="margin-bottom: 35px;">
                           
                                         <input type="submit" name="signin" id="signin" class="member_btn" value="REGISTER"  style="border:none;" />
                                    
                                </div>
        				</form>
        </div>


<!----------listing end content-------------->
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
<?php $this->load->view('site/templates/footer'); ?>