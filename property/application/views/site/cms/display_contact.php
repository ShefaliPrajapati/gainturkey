<?php
$this->load->view('site/templates/header');
?>
<!----------listing content------------------>
<div class="listing_content" style="margin:20px 0 15px 0px;">
    <?php echo form_open('site/product/add_review', array('id' => 'SignupForm')); ?>
    <div class="freemember">
        <h2>Keep in touch with us</h2>
        <div class="field_login">
            <label>First Name<span>*</span></label>
            <input type="text" class="scroll_5 required" name="firstname" id="firstname" />
            <div id="firstname_warn"  style="float:left; color:#FF0000;"></div>
        </div>
        <div class="field_login">
            <label>Last Name<span>*</span></label>
            <input type="text"  class="scroll_5 required" name="lastname" id="lastname" />
            <div id="lastname_warn"  style="float:left; color:#FF0000;"></div>
        </div>
        <div class="field_login">
            <label>Email Address<span>*</span></label>
            <input type="text"  class="scroll_5 required email" name="email" id="email"/>
            <div id="email_warn"  style="float:left; color:#FF0000;"></div>
        </div>
        <div class="field_login">
            <label>Comments<span>*</span></label>

            <textarea class="scroll_5 required" name="message" id="message" style="height:80px;"></textarea>
            <div id="message_warn"  style="float:left; color:#FF0000;"></div>
        </div>
        <div class="field_login">
            <label style="height:30px;">Enter the text given below<span>*</span>

                <div class="code_full">
                    <div class="field_login">
                        <div style="border: 1px solid #CCCCCC;color: #000000; float: left; font-size: 3em;font-style: oblique;font-weight: bold; height: 2em; line-height: 2em;text-align: center; text-decoration: line-through; width: 99%;">
                            <?php $random_values = substr(number_format(time() * rand(), 0, '', ''), 0, 7); ?>
                            <span style="color: #990000;float: left; text-align:left; text-decoration: line-through; transform: rotate(-12deg); font-size:15px;"><?php echo $random_values; ?></span></div>
                        <input type="hidden" name="captcha_original" id="captcha_original" value="<?php echo $random_values; ?>" />
                    </div>
                    <!--<img src="images/site/fi.jpg" style="margin-bottom:5px;" />-->
                </div>
            </label>
            <input type="text" name="captcha_value" id="captcha_value" class="scroll_5 required" value="" equalto="#captcha_original" >
            <div id="captcha_value_warn"  style="float:left; color:#FF0000;"></div>
        </div>
        <div class="field_login">

            <input type="submit" name="signin" id="signin" class="member_btn" value="SUBMIT"  style="border:none;" />

        </div>

    </div>
    <?php echo form_close(); ?> 
    <div class="clear"></div>

    <!----------listing end content-------------->
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
$this->load->view('site/templates/footer');
?>