<?php 
$this->load->view('site/templates/header');
?><script src="js/site/menu.js" type="text/javascript"></script>
<section>
	<div class="main"> 
    			    <div class="feature_list">
    			<div class="page_title W99">Change Password</div>
                <div class="map_page">
                	
                    <div class="dashboard_full_tex">
                    
                	<div class="login_left">
                    <?php 
					$attributes = array('id'=>'passwordChangeForm');
					echo form_open_multipart('site/user/changeOwnpassword',$attributes) ?>
                    	<h2>Change Password</h2>
                        <div class="field_login">
                            <label>Current Password<span>*</span></label>
                            <input type="password" name="old_password" id="old_password" class="required scroll_5" >
                            <div id="old_password_warn"  style="float:left; color:#FF0000;"></div>
                        </div>
                        <div class="field_login">
                            <label>New Password<span>*</span></label>
                            <input type="password" name="password" id="password" class="required scroll_5" >
                            <div id="password_warn"  style="float:left; color:#FF0000;"></div>
                        </div>
                        <div class="field_login">
                            <label>Retype New Password<span>*</span></label>
                            <input type="password" name="repeat_password" id="repeat_password" class="required scroll_5" >
                            <div id="repeat_password_warn"  style="float:left; color:#FF0000;"></div>
                        </div>
                       		<input type="hidden" name="pass_inDb" value="<?php echo $AdminDisplay->row()->password; ?>" />
                            <input type="hidden" name="group" value="<?php echo $AdminDisplay->row()->group; ?>" />
                            <input type="hidden" name="id" value="<?php echo $AdminDisplay->row()->id;?>" />
                                             
                        <div class="field_login">
                   
                                 <input type="submit" name="signin" id="signin" class="submit_btn" value="UPDATE">
                            
	                      </div> 
                          <?php echo form_close(); ?>                        
        				</div>
                </div>
                </div>
		    </div>
    </div>
<!--body content-->
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
$this->load->view('site/templates/footer');
?>