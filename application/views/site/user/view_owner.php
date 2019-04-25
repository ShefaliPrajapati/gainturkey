<?php
$this->load->view('site/templates/new_header');
?>
<section>
	<div class="main">
    			    <div class="feature_list">
    			<div class="page_title W99">Owner Account Setting</div>
                <div class="map_page">
                	
                    <div class="dashboard_full_tex">
                    <?php $this->load->view('site/templates/dashboard_side'); ?>
                	<div class="login_left">
                    <?php 
					$attributes = array('id'=>'SignupForm', 'enctype' => 'multipart/form-data');
					echo form_open_multipart('site/user/EditUserLoginDetails',$attributes) ?>
                    	<h2>Account Settings</h2>
                       <div class="field_login">
                            <label>First Name<span>*</span></label>
                            <input type="text" name="first_name" id="first_name" value="<?php echo $AdminDisplay->row()->first_name; ?>" class="scroll_5 required" >
                        </div>
                        <div class="field_login">
                            <label>Last Name</label>
                            <input type="text" name="last_name" id="last_name" value="<?php echo $AdminDisplay->row()->last_name; ?>" class="scroll_5 " >
                        </div>
                        <div class="field_login">
                            <label>Email Address<span>*</span></label>
                            <input type="text" name="email" value="<?php echo $AdminDisplay->row()->email; ?>" id="email" class="scroll_5 required email">
                        </div>
                       <!-- <div class="field_login">
                            <label>Password</label>
                            <input type="password" name="password" id="password" class="scroll_5" >
                        </div>-->
                        <div class="field_login">
                            <label>Image</label>
                            <input type="file" name="user_image" id="user_image" class="scroll_5" > <br /></div>
                          <div class="field_login"> <img src="<?php echo base_url();?>images/users/<?php if($AdminDisplay->row()->thumbnail !='') echo $AdminDisplay->row()->thumbnail; else echo "owner_img.png"; ?>" width="150" height="150"  />
                        </div>
                        <div class="field_login">
                            <label>Phone<span>*</span></label>
                            <input type="text" name="phone_no" value="<?php echo $AdminDisplay->row()->phone_no; ?>" id="phone_no" class="scroll_5 required ">
                        </div>
                         <div class="field_login">
                            <label>About</label>
                            <textarea name="about" id="about" class="scroll_5"><?php echo $AdminDisplay->row()->about; ?></textarea>
                         </div>
                        
                        <!--<div class="field_login">
                            <label>Country Name<span>*</span></label>
                            <input type="text" name="country" value="<?php echo $AdminDisplay->row()->country; ?>" id="country" class="scroll_5 required ">
                        </div>
                        
                        <div class="field_login">
                            <label>State/Province<span>*</span></label>
                            <input type="text" name="state" value="<?php echo str_replace('-',' ',$AdminDisplay->row()->state); ?>" id="state" class="scroll_5 required ">
                        </div>
                        
                        <div class="field_login">
                            <label>City/Town<span>*</span></label>
                            <input type="text" name="city" value="<?php echo $AdminDisplay->row()->city; ?>" id="city" class="scroll_5 required ">
                        </div>
                        
                        <div class="field_login">
                            <label>Address<span>*</span></label>
                            <input type="text" name="address" value="<?php echo $AdminDisplay->row()->address; ?>" id="address" class="scroll_5 required ">
                        </div>
                        
                         <div class="field_login">
                            <label>Zip/Postal code<span>*</span></label>
                            <input type="text" name="postal_code" value="<?php echo $AdminDisplay->row()->postal_code; ?>" id="postal_code" class="scroll_5 required ">
                        </div>-->
                        <div class="field_login">
                    <a href="site/user/changeOwnpasswordForm">Change Password</a><br /><br />
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
<script type="text/javascript" src="js/site/jquery.validate.js"></script>
<script>
	$("#SignupForm").validate({
	  rules:{
		  	first_name: {
				required: true,
				minlength: 2
			},
			
			email: {
				required: true,
				email: true
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
				minlength: "User first name must consist of at least 2 characters"
			},
			
			email: {
				required: "Please enter user email address",
				email:"Please enter a valid email address"
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
$this->load->view('site/templates/new_footer');
?>
