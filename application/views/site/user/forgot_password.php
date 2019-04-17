<?php
$this->load->view('site/templates/new_header');
?>
<style>
    .form-group span, .error{
        color: red;
    }
</style>
<div class="main_sec">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-12 text-center">
                <h2>Forgot Password</h2>
                <p class="mt-2 mb-2">Forgot your password? Enter your email address to reset it.</p>
            </div>
            <div class="clear"></div>
            <div class="col-md-6">
                <?php echo form_open('site/user/forgot_password_user',array('id'=>'forgotPasswordForm')); ?>
                <div class="field_login form-group">
                    <label>Email Address<span>*</span></label>
                    <input type="text" name="email" id="email_address" class="scroll_5 form-control required email">
                </div>
                <div class="field_login form-group">
                    <input type="submit" name="signin" id="signin" class="member_btn btn btn-primary" value="RESET PASSWORD">
                </div>
                <?php echo form_close(); ?>
            </div>

         </div>
    </div>
</div>
<div class="clear"></div>


	

 </div>
	 </div>
<div class="clear"></div>
<script type="text/javascript" src="js/site/jquery.validate.js"></script>
<script>
	$("#forgotPasswordForm").validate({
	  rules:{
			email: {
				required: true,
				email: true
			}
	  },
	  messages: {
			email: {
				required: "Please enter user email address",
				email:"Please enter a valid email address"
			}
	  }
  });
</script>
<?php
$this->load->view('site/templates/new_footer');
?>
