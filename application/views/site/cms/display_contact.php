<?php
$this->load->view('site/templates/new_header');
?>
<!----------listing content------------------>
<div class="main_sec">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-12 text-center">
                <h2 class="text-center">Keep in touch with us</h2>
            </div>
            <div class="col col-lg-5">
                <?php echo form_open('site/product/add_review', array('id' => 'SignupForm', 'class' => 'form')); ?>
                <div class="form-group ">
                    <label>First Name<span>*</span></label>
                    <input type="text" class="scroll_5 required form-control" name="firstname" id="firstname" />
                    <div id="firstname_warn"  style="color:#FF0000;"></div>
                </div>
                <div class="form-group">
                    <label>Last Name<span>*</span></label>
                    <input type="text"  class="scroll_5 required form-control" name="lastname" id="lastname" />
                    <div id="lastname_warn"  style="color:#FF0000;"></div>
                </div>
                <div class="form-group">
                    <label>Email Address<span>*</span></label>
                    <input type="text"  class="scroll_5 required form-control email" name="email" id="email"/>
                    <div id="email_warn"  style="color:#FF0000;"></div>
                </div>
                <div class="form-group">
                    <label>Comments<span>*</span></label>
                    <textarea class="scroll_5 required form-control" name="message" id="message" style="height:80px;"></textarea>
                    <div id="message_warn"  style="color:#FF0000;"></div>
                </div>
                <div class="form-group">
                    <label>Enter the text given below<span>*</span></label>
                    <input type="text" name="captcha_value" id="captcha_value" class="form-control scroll_5 required" value="" equalto="#captcha_original" >

                </div>
                <div class="form-group">
                    <div style="border: 1px solid #CCCCCC;color: #000000; float: left; font-size: 2em;font-style: oblique;font-weight: bold; height: 2em; line-height: 2em;text-align: center; width: 100%;">
                        <?php $random_values = substr(number_format(time() * rand(), 0, '', ''), 0, 7); ?>
                        <span style="color: #99080f;float: left; text-align:left; text-decoration: line-through; transform: rotate(-11deg); font-size:25px;"><?php echo $random_values; ?></span></div>
                    <input type="hidden" name="captcha_original" id="captcha_original" value="<?php echo $random_values; ?>" />
                    <div id="captcha_value_warn"  style="float:right; color:#FF0000;"></div>
                </div>
                  <div class="form-group" style=" margin-top: 20px; display: inline-block;">
                    <input type="submit" name="signin" id="signin" class="member_btn btn btn-md btn-primary" value="SUBMIT"/>
                </div>
                <?php echo form_close(); ?>
                <div class="clear"></div>

                <!----------listing end content-------------->
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        $("#SignupForm").submit(function () {
            // var email = $('#vendor_email').val();
            //alert('');
            $("#firstname_warn").html('');
            $("#lastname_warn").html('');
            $("#email_warn").html('');
            $("#message_warn").html('');
            $("#captcha_value_warn").html('');

            if (jQuery.trim($("#firstname").val()) == '') {

                $("#firstname_warn").html('First name is required');
                $("#firstname").focus();
                return false;
            } else if (jQuery.trim($("#lastname").val()) == '') {

                $("#lastname_warn").html('Last name is required');
                $("#lastname").focus();
                return false;
            } else if (IsEmail(jQuery.trim($("#email").val())) == false) {

                $("#email_warn").html('Email address is required');
                $("#email").focus();
                return false;

            } else if (jQuery.trim($("#message").val()) == '') {

                $("#message_warn").html('Message is required');
                $("#message").focus();
                return false;
            } else if (jQuery.trim($("#captcha_value").val()) != jQuery.trim($("#captcha_original").val())) {

                $("#captcha_value_warn").html('captcha dose not match');
                $("#captcha_value").focus();
                return false;

            } else
            {
                $("#SignupForm").submit();
            }

            return false;
        });
    });
    function IsEmail(email_address) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!regex.test(email_address)) {
            return false;
        } else {
            return true;
        }
    }


    function removeError(idval) {
        $("#" + idval + "_warn").html('');
    }
</script>

<?php
$this->load->view('site/templates/new_footer');
?>
