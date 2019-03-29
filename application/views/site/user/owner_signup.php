<?php 
$this->load->view('site/templates/header');
?>
<section>
	<div class="main">
    			    <div class="feature_list">
    			<div class="page_title W99">Sign In</div>
                <div class="map_page">
                	
                	<div class="login_left">
                    <?php echo form_open('site/user/registerOwner',array('id'=>'SignupForm')); ?>
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
                            <label>Password</label>
                            <input type="password" name="password" id="password" class="scroll_5 required">
                        </div>
                           <div class="field_login">
                            <label>Confirm Password</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="scroll_5 required">
                        </div>
                        <div class="field_login">
                   
                                 <input type="submit" name="signin" id="signin" class="submit_btn" value="CONTINUE">
                            
	                      </div> 
                          <?php echo form_close(); ?>                        
        				</div>
                        
                        <div class="login_right">
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
                                 <input type="submit" name="signin" id="signin" class="submit_btn" value="CONTINUE">
                        </div>
                   <?php echo form_close(); ?>
             </div>
             
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
				minlength: "User full name must consist of at least 2 characters"
			},
			last_name: {
				required: "Last name required",
				minlength: "User full name must consist of at least 2 characters"
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