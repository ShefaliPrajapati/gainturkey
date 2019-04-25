<?php 
$this->load->view('site/templates/new_header');
?>
<section>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-12 text-center">
                <h2>Change Password</h2>
            </div>
            <div class="col col-lg-6">
                <div class="dashboard_full_tex">
                    <?php 
					$attributes = array('id'=>'passwordChangeForm');
					echo form_open_multipart('site/user/changeOwnpassword',$attributes) ?>
                    <div class="form-group">
                            <label>Current Password<span>*</span></label>
                        <input type="password" name="old_password" id="old_password" class="required form-control">
                            <div id="old_password_warn"  style="float:left; color:#FF0000;"></div>
                        </div>
                    <div class="form-group">
                            <label>New Password<span>*</span></label>
                        <input type="password" name="password" id="password" class="required form-control">
                            <div id="password_warn"  style="float:left; color:#FF0000;"></div>
                        </div>
                    <div class="form-group">
                            <label>Retype New Password<span>*</span></label>
                        <input type="password" name="repeat_password" id="repeat_password"
                               class="required form-control">
                            <div id="repeat_password_warn"  style="float:left; color:#FF0000;"></div>
                        </div>
                    <input type="hidden" name="pass_inDb" value="<?php echo $AdminDisplay->row()->password; ?>"/>
                    <input type="hidden" name="group" value="<?php echo $AdminDisplay->row()->group; ?>"/>
                    <input type="hidden" name="id" value="<?php echo $AdminDisplay->row()->id; ?>"/>

                    <div class="form-group">
                        <input type="submit" name="signin" id="signin" class="btn btn-md submit_btn" value="UPDATE">
                    </div>
                    <?php echo form_close(); ?>
                </div>
                </div>
        </div>
    </div>
</section>
<script type="text/javascript">
$(function() {
			$("#passwordChangeForm").submit(function(){
				// var email = $('#vendor_email').val();
				//alert('');
				$("#old_password_warn").html('');
				 $("#password_warn").html('');
				 $("#repeat_password_warn").html('');
				
				
					if(jQuery.trim($("#old_password").val()) == '')
					{
						
						$("#old_password_warn").html('Enter your current password');
						$("#old_password").focus();
						return false;
						
					
					}else if(jQuery.trim($("#password").val()) == ''){
					  
						$("#password_warn").html('Enter new password');
						$("#password").focus();
						return false;
						
					}else if(jQuery.trim($("#repeat_password").val()) != jQuery.trim($("#password").val())){
						
						$("#repeat_password_warn").html('Passwords donot match ');
						$("#repeat_password").focus();
						return false;
					
					}else
					{	
					      	$("#passwordChangeForm").submit();
					}
					
					return false;	
				});
		});
		
	 
function removeError(idval){
	$("#"+idval+"_warn").html('');}
</script>

<?php
$this->load->view('site/templates/new_footer');
?>
