<?php
$this->load->view('site/templates/new_header');
?>
<section>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-12 text-center">
                <h2>User Account Setting</h2>
                <br/>
                <h5>Edit Profile</h5>
            </div>
            <div class="col col-lg-6">
                <div class="dashboard_full_tex">
                    <?php
                    $attributes = array('id' => 'SignupForm', 'enctype' => 'multipart/form-data');
                    echo form_open('site/user/EditSiteUserLoginDetails', $attributes); ?>
                    <div class="form-group">
                        <label>First Name<span>*</span></label>
                        <input type="text" name="first_name" id="first_name"
                               value="<?php echo $AdminDisplay->row()->first_name; ?>" class="form-control required">
                    </div>
                    <div class="form-group">
                        <label>Last Name<span>*</span></label>
                        <input type="text" name="last_name" id="last_name"
                               value="<?php echo $AdminDisplay->row()->last_name; ?>" class="form-control required">
                    </div>
                    <div class="form-group">
                        <label>Email Address<span>*</span></label>
                        <input type="text" name="email" value="<?php echo $AdminDisplay->row()->email; ?>" id="email"
                               class="form-control required email">
                    </div>
                    <div class="form-group">
                            <label>Image</label>
                        <input type="file" name="user_image" id="user_image">
                        <div class="m-2">
                            <img src="<?php echo base_url(); ?>images/users/<?php if ($AdminDisplay->row()->thumbnail != '') echo $AdminDisplay->row()->thumbnail; else echo "owner_img.png"; ?>"
                                 width="150" height="100"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Phone<span>*</span></label>
                        <input type="text" name="phone_no" value="<?php echo $AdminDisplay->row()->phone_no; ?>"
                               id="phone_no" class="form-control required ">
                    </div>
                    <div class="form-group">
                        <label>About</label>
                        <textarea name="about" id="about"
                                  class="form-control"><?php echo $AdminDisplay->row()->about; ?></textarea>
                    </div>
                    <div class="form-group">
                        <a href="<?php base_url() ?>site/user/changeOwnpasswordForm">Change Password</a>
                        <input type="submit" name="signin" id="signin" class="pull-right btn btn-md submit_btn"
                               value="UPDATE">
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
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
$this->load->view('site/templates/new_footer');
?>
