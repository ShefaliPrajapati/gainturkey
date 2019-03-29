<?php 
$this->load->view('site/templates/header');
?>

	<div class="main">
    			    <div class="feature_list">
    			<div class="page_title W99">Owner login</div>
                <div class="map_page">
                	                        
                        <div class="login_right" style="margin:15px auto; float:none;">
                        <?php echo form_open('site/user/seller_signin',array('id'=>'owner_SigninForm')); ?>
                    <h2>Owner Login</h2>
                        <div class="field_login">
                            <label>Email Address<span>*</span></label>
                             <input type="text" name="email" id="email" class="scroll_5 required email">
                             <div id="email_warn"  style="float:left; color:#FF0000;"></div>
                        </div>
                        <div class="field_login">
                            <label>Password<span>*</span></label>
                          <input type="password" name="password" id="password" class="scroll_5 required" size="32">
                          <div id="password_warn"  style="float:left; color:#FF0000;"></div>
                        </div>
                         <div class="field_login">
                            <label><a href="site/user/forgot_password_form" class="example9 cboxElement" style="font-size:12px;">Forgot Your Password?</a></label>
                        </div>
                         <!--<div class="field_login">
                           
                          <input type="checkbox" name="remember" class="sub_check" style="float:left; margin-left:0px;"/><span class="example9 cboxElement" style="float:left; margin-top:0px;">
Keep me signed in </span>
                        </div>-->
                        
                       
                    <div class="field_login">
               
                             <input type="submit" name="signin" id="signin" class="submit_btn" value="Sign In">
                        
                    </div>
                    <?php echo form_close(); ?> 
                    <div class="clear"></div>
                    <div class="border_dot"></div>
                    <p class="tex_use">
Want to list your property? <a href="list_your_property">Learn More</a>
</p>
             </div>
             
                </div>
		    </div>
    </div>

	
    </div>
<!--<script>
	$("#owner_SigninForm").validate({
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
</script>-->



<script type="text/javascript">
$(function() {
			$("#owner_SigninForm").submit(function(){
				// var email = $('#vendor_email').val();
				//alert('');
					 if(IsEmail(jQuery.trim($("#email").val())) == false)
					 {
					   $("#email_warn").html('');
						$("#email_warn").html('Invalid email address');
						$("#email").focus();
						return false;
						
					}else if(jQuery.trim($("#password").val()) == ''){
						$("#password_warn").html('');
						$("#password_warn").html('Password is required');
						$("#password").focus();
						return false;
						
					}else
					{	
					      	$("#owner_SigninForm").submit();
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
</body>
</html>
