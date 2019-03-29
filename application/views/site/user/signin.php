<?php 
$this->load->view('site/templates/header');
?>
<div class="listing_content" style="margin:20px 0 15px 0px;">
		<div class="freemember">
        <h2>Login</h2>
        						
                               <?php echo form_open('site/user/signin_login_user',array('id'=>'loginForm')); ?>
                                
                                <div class="field_signin">
                                	<label>Email Address<span>*</span></label>
                                     <input type="text" name="email" id="email_address" class="scroll_5 required email">
                              		<div id="email_address_warn"  style="float:left; color:#FF0000;"></div>
                                </div>
                                <div class="field_signin">
                                	<label>Password<span>*</span></label>
                                  <input type="password" name="password" id="password_signin" class="scroll_5 required" size="32">
                         <div id="password_signin_warn"  style="float:left; color:#FF0000;"></div>
                                </div>
                                <div class="field_signin">
                                	<label  class="left"><span class="left">* Required Fields</span></label>
                                </div>
                                <div class="field_signin">
                                	<label class="left"><?php echo anchor(base_url('forgot-password'),'Forgot Your Password?',array('class'=>'')); ?></label>
                                    <!--<label class="left"><?php echo 'Need An Account '; echo '<a href="'.base_url(signup).'">Click Here</a>'; ?></label>-->
                                </div>
                                
                                <div class="field_signin">
                           
                                         <input type="submit" name="signin" id="signin" class="member_btn" value="SUBMIT" style="border:none; margin:0px;" />
                                    
                                </div>
                                  <?php echo form_close(); ?> 
        
        </div>


<!----------listing end content-------------->
</div>
<div class="clear"></div>
<script type="text/javascript">
$(function() {
			$("#loginForm").submit(function(){
				// var email = $('#vendor_email').val();
				//alert('');
			
				 $("#email_address_warn").html('');
				 $("#password_signin_warn").html('');
				
				
					
					if(IsEmail(jQuery.trim($("#email_address").val())) == false){
					  
						$("#email_address_warn").html('Email address is required');
						$("#email_address").focus();
						return false;
						
					}else if(jQuery.trim($("#password_signin").val()) == ''){
						
						$("#password_signin_warn").html('Password is required');
						$("#password_signin").focus();
						return false;
					}else
					{	
					      	$("#loginForm").submit();
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


<?php 
$this->load->view('site/templates/footer');
?>

