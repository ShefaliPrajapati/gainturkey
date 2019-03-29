<?php 
$this->load->view('site/templates/header');
?>
<section>
	<div class="main">
    			    <div class="feature_list">
    			<div class="page_title W99">Sign up</div>
                <div class="map_page">
                	
                	<div class="login_left">
                    <?php echo form_open('site/user/registerUser',array('id'=>'SignupForm')); ?>
                    	<h2>Create an Account</h2>
                       <div class="field_login">
                            <label>First Name<span>*</span></label>
                            <input type="text" name="first_name" id="first_name" class="scroll_5 required" >
                        </div>
                        <div class="field_login">
                            <label>Last Name<span>*</span></label>
                            <input type="text" name="last_name" id="last_name" class="scroll_5 required" >
                        </div>
                        <div class="field_login">
                            <label>Username<span>*</span></label>
                            <input type="text" name="user_name" id="user_name" class="scroll_5 required" >
                        </div>
                        <div class="field_login">
                            <label>Email Address<span>*</span></label>
                            <input type="text" name="email" id="email" class="scroll_5 required email">
                        </div>
                         <div class="field_login">
                            <label>Password<span>*</span></label>
                            <input type="password" name="password" id="password" class="scroll_5 required">
                        </div>
                           <div class="field_login">
                            <label>Confirm Password</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="scroll_5 required">
                        </div>
                        
                         <div class="field_login">
                                <div style="border: 1px solid #CCCCCC;color: #000000; float: left; font-size: 3em;font-style: oblique;font-weight: bold; height: 2em; line-height: 2em;text-align: center; text-decoration: line-through; width: 99%;">
                                <?php $random_values = substr(number_format(time() * rand(),0,'',''),0,4); $random_values1 = substr(number_format(time() * rand(),0,'',''),0,5); ?>
                                 <span style="color: #000000;float:left; text-align:right;text-decoration: line-through; width: 49%; transform: rotate(12deg);"><?php echo $random_values; ?></span><span style="color: #000000;float: left; text-align:left;text-decoration: line-through; width: 49%; transform: rotate(-12deg);"><?php echo $random_values1; ?></span></div>
                                 <input type="hidden" name="captcha_original" id="captcha_original" value="<?php echo $random_values.$random_values1; ?>" />
                                 </div>
                                 
                                 
        <div class="field_main">
        	<div class="field_login">
        	<label> Captcha : <span>*</span></label>
           <input type="text" name="captcha_value" id="captcha_value" class="scroll_7 required" equalto="#captcha_original" >
           <div id="captcha_value_warn"  style="float:left; color:#FF0000;"></div>
        </div>
        </div>
                        
                        
                         <div class="field_login">
                            <input type="checkbox" name="signup_news" /> I want to Subscribe for the Newsletter                            
                        </div>
                        <div class="field_login">
                   
                                 <input type="submit" name="signin" id="signin" class="submit_btn" value="SUBMIT">
                            
	                      </div> 
                          <?php echo form_close(); ?>                        
        				</div>
                        
                    <!--    <div class="login_right">
                    <h2>Log in to your account</h2>
                    <?php echo form_open('site/user/login_user',array('id'=>'loginForm')); ?>
                        <div class="field_login">
                            <label>Email Address<span>*</span></label>
                             <input type="text" name="email" id="email_address" class="scroll_5 required email">
                        </div>
                        <div class="field_login">
                            <label>Password<span>*</span></label>
                          <input type="password" name="password" id="password" class="scroll_5 required" size="32">
                        </div>
                        <div class="field_login">
                            <label><span>* Required Fields</span></label>
                        </div>
                        <div class="field_login">
                            <label><?php echo anchor(base_url('forgot-password'),'Forgot Your Password?',array('class'=>'example9 cboxElement')); ?></label>
                        </div>
                        <div class="field_login">
                                 <input type="submit" name="signin" id="signin" class="submit_btn" value="SUBMIT">
                        </div>
                   <?php echo form_close(); ?>
             </div>-->
             
                </div>
		    </div>
    </div>
<!--body content-->
</section>
<script type="text/javascript" src="js/site/jquery.validate.js"></script>
<script>
	$("#SignupForm").validate({
	  rules:{
		  	first_name: {
				required: true,
				minlength: 2
			},
			last_name: {
				required: true,
				minlength: 2
			},
			user_name: {
				required: true,
				minlength: 3
			},
			email: {
				required: true,
				email: true
			},
			password: {
				required: true,
				minlength: 5
			},
			confirm_password: {
				required: true,
				minlength: 5,
				equalTo: "#password"
			}
	  },
	  messages: {
		  first_name: {
				required: "First name required",
				minlength: "First name must consist of at least 2 characters"
			},
			last_name: {
				required: "Last name required",
				minlength: "Last name must consist of at least 2 characters"
			},
			user_name: {
				required: "User name required",
				minlength: "User name must consist of at least 3 characters"
			},
			email: {
				required: "Please enter user email address",
				email:"Please enter a valid email address"
			},
			password: {
				required: "Please enter a new password",
				minlength: "Password must consist of at least 5 characters"
			},
			confirm_password: {
				required: "Please re-type the above password",
				minlength: "Password must consist of at least 5 characters",
				equalTo: "Please enter the same password as above"
			}
	  }
  });
</script>
<script>
	$("#loginForm").validate({
	  rules:{
			email: {
				required: true,
				email: true
			},
			password: {
				required: true,
				minlength: 5
			}
	  },
	  messages: {
			email: {
				required: "Please enter user email address",
				email:"Please enter a valid email address"
			},
			password: {
				required: "Please enter a password",
			}
	  }
  });
</script>
<?php 
$this->load->view('site/templates/footer');
?>