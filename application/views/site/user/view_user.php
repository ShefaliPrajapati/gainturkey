<?php 
$this->load->view('site/templates/header');
?><script src="js/site/menu.js" type="text/javascript"></script>
<section>
	<div class="main">
    			    <div class="feature_list">
    			<div class="page_title W99">User Account Setting</div>
                <div class="map_page">
                	
                    <div class="dashboard_full_tex">
                    <?php //$this->load->view('site/templates/dashboard_side'); ?>
                	<div class="login_left">
                    <?php
                    $attributes = array('id'=>'SignupForm', 'enctype' => 'multipart/form-data');
                    echo form_open('site/user/EditSiteUserLoginDetails',$attributes); ?>
                    	<h2>Edit Profile</h2>
                       <div class="field_login">
                            <label>First Name<span>*</span></label>
                            <input type="text" name="first_name" id="first_name" value="<?php echo $AdminDisplay->row()->first_name; ?>" class="scroll_5 required" >
                        </div>
                        <div class="field_login">
                            <label>Last Name<span>*</span></label>
                            <input type="text" name="last_name" id="last_name" value="<?php echo $AdminDisplay->row()->last_name; ?>" class="scroll_5 required" >
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
                            <input type="file" name="user_image" id="user_image" class="scroll_5" >
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
			last_name: {
				required: "Last name required",
				minlength: "User last name must consist of at least 2 characters"
			},
			user_name: {
				required: "User name required",
				minlength: "User name must consist of at least 3 characters"
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
$this->load->view('site/templates/footer');
?>