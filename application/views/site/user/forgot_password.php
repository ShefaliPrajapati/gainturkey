<?php 
$this->load->view('site/templates/header');
?>
<div class="listing_content" style="margin:20px 0 15px 0px;">
		<div class="freemember">
       
        <h2>Forgot Password</h2>

         <div class="clear"></div>
                    	
                    <?php echo form_open('site/user/forgot_password_user',array('id'=>'forgotPasswordForm')); ?>
                    	<h2>Forgot your password? Enter your email address to reset it.</h2>
                        <div class="field_login">
                            <label>Email Address<span>*</span></label>
                             <input type="text" name="email" id="email_address" class="scroll_5 required email">
                        </div>
                        <div class="field_login">
                            <input type="submit" name="signin" id="signin" class="member_btn" value="RESET PASSWORD">
                      	</div> 
                      <?php echo form_close(); ?>                        
                    </div>


<!----------listing end content-------------->
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
$this->load->view('site/templates/footer');
?>