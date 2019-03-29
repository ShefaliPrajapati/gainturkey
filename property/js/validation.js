

$(document).ready(function () {
    $('.checkboxCon input:checked').parent().css('background-position', '-114px -260px');
    $("#selectallseeker").click(function () {
        $('.caseSeeker').attr('checked', this.checked);
        if (this.checked) {
            $(this).parent().addClass('checked');
            $('.checkboxCon').css('background-position', '-114px -260px');
        } else {
            $(this).parent().removeClass('checked');
            $('.checkboxCon').css('background-position', '-38px -260px');
        }
    });



    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".caseSeeker").click(function () {

        if ($(".caseSeeker").length == $(".caseSeeker:checked").length) {
            $("#selectallseeker").attr("checked", "checked");
            $("#selectallseeker").parent().addClass("checked");
        } else {
            $("#selectallseeker").removeAttr("checked");
            $("#selectallseeker").parent().removeClass("checked");
        }

    });

    $('.checkboxCon input').click(function () {
        if (this.checked) {
            $(this).parent().css('background-position', '-114px -260px');
        } else {
            $(this).parent().css('background-position', '-38px -260px');
        }
    });

    /*$("#location").focus(function()
     {
     $("#location_val").css("display","none");
     });*/

    $(".popup-signup-ajax").click(function ()
    {
        //alert(baseURL);return false;
        $.ajax(
                {
                    type: 'POST',
                    url: baseURL + 'googlelogin/index.php',
                    data: {},
                    success: function (data)
                    {
                        //location.reload();
                        //alert('sss');
                        //$("#popupCheckId").val('1');
                        $("#popup_container").css("display", "block");
                    }

                });
    });

    /**
     * Menu notifications hover
     * 
     */
    $('.gnb-notification').mouseenter(function () {
        if ($(this).hasClass('cntLoading'))
            return;
        $(this).addClass('cntLoading');
        $('.feed-notification').show();
        $('.feed-notification').find('ul').remove();
        $(this).find('.loading').show();
        $.ajax({
            type: 'post',
            url: baseURL + 'site/notify/getlatest',
            dataType: 'json',
            success: function (json) {
                if (json.status_code == 1) {
                    $('.feed-notification').find('.loading').after(json.content);
                    $('.moreFeed').show();
                } else if (json.status_code == 2) {
                    $('.feed-notification').find('.loading').after(json.content);
                    $('.moreFeed').hide();
                }
            },
            complete: function () {
                $('.gnb-notification').find('.loading').hide();
                $('.gnb-notification').removeClass('cntLoading');
            }
        });
    }).mouseleave(function () {
        $('.feed-notification').hide();
    });


});


function checkBoxValidationAdmin(req, AdmEmail) {
    var tot = 0;
    var chkVal = 'on';
    var frm = $('#display_form input');
    for (var i = 0; i < frm.length; i++)
    {
        if (frm[i].type == 'checkbox')
        {
            if (frm[i].checked)
            {
                tot = 1;
                if (frm[i].value != 'on')
                {
                    chkVal = frm[i].value;
                }
            }
        }
    }

    if (tot == 0) {
        alert("Please Select the CheckBox");
        return false;
    } else if (chkVal == 'on') {
        alert("No records found ");
        return false;
    } else {
        confirm_global_status(req, AdmEmail);
    }

}

function checkBoxValidationAdmin1(req) {
    var tot = 0;
    var chkVal = 'on';
    var frm = $('#display_form input');
    var j = 0;
    for (var i = 0; i < frm.length; i++)
    {
        if (frm[i].type == 'checkbox')
        {
            if (frm[i].checked)
            {
                j++;
                tot = 1;
                if (frm[i].value != 'on')
                {
                    chkVal = frm[i].value;
                }
            }
        }
    }

    if (tot == 0) {
        alert("Please Select one CheckBox");
        return false;
    } else if (j > 1) {
        alert("Please select only one checkBox");
        return false;
    } else if (chkVal == 'on') {
        alert("No records found ");
        return false;
    } else {
        confirm_global_status1(req);
    }

}

function checkBoxValidationuser(req, AdmEmail) {
    var tot = 0;
    var chkVal = 'on';
    var frm = $('#learn_form input');
    for (var i = 0; i < frm.length; i++) {
        if (frm[i].type == 'checkbox') {
            if (frm[i].checked) {
                tot = 1;
                if (frm[i].value != 'on') {
                    chkVal = frm[i].value;
                }
            }
        }
    }
    if (tot == 0) {
        alert("Please Select the CheckBox");
        return false;
    } else if (chkVal == 'on') {
        alert("No records found ");
        return false;

    } else {
        confirm_global_status(req, AdmEmail);
    }

}

function reset_password_user(req, AdmEmail) {
    alert(req);
}

function checkBoxWithSelectValidationAdmin(req, AdmEmail) {
    var templat = $('#mail_contents').val();
    if (templat == '') {
        alert("Please select the mail template");
        return false;
    }
    var tot = 0;
    var chkVal = 'on';
    var frm = $('#display_form input');
    for (var i = 0; i < frm.length; i++) {
        if (frm[i].type == 'checkbox') {
            if (frm[i].checked) {
                tot = 1;
                if (frm[i].value != 'on') {
                    chkVal = frm[i].value;
                }
            }
        }
    }
    if (tot == 0) {
        alert("Please Select the CheckBox");
        return false;
    } else if (chkVal == 'on') {
        alert("No records found ");
        return false;

    } else {
        confirm_global_status(req, AdmEmail);
    }

}
function SelectValidationAdmin(req, AdmEmail) {
    var templat = $('#mail_contents').val();
    if (templat == '') {
        alert("Please select the mail template");
        return false;
    }

    confirm_global_status(req, AdmEmail);


}
function confirm_global_status(req, AdmEmail) {
    $.confirm({
        'title': 'Confirmation',
        'message': 'Whether you want to continue this action?',
        'buttons': {
            'Yes': {
                'class': 'yes',
                'action': function () {
                    bulk_logs_action(req, AdmEmail);
                    //$('#statusMode').val(req);
                    //$('#display_form').submit();
                }
            },
            'No': {
                'class': 'no',
                'action': function () {
                    return false;
                }	// Nothing to do in this case. You can as well omit the action property.
            }
        }
    });
}

function confirm_global_status1(req) {
    $.confirm({
        'title': 'Confirmation',
        'message': 'Whether you want to continue this action?',
        'buttons': {
            'Yes': {
                'class': 'yes',
                'action': function () {
                    bulk_logs_action1(req);
                }
            },
            'No': {
                'class': 'no',
                'action': function () {
                    return false;
                }
            }
        }
    });
}

function confirmCancel(id) {
    $.confirm({
        'title': 'Confirmation',
        'message': 'Are you sure, you want to cancel this property?',
        'buttons': {
            'Yes': {
                'class': 'yes',
                'action': function () {

                    $.ajax({
                        type: 'POST',
                        url: baseURL + 'crmadmin/product/cancelProperty',
                        data: {"id": id},
                        success: function ()
                        {
                            location.reload();
                        }
                    });
                }
            },
            'No': {
                'class': 'no',
                'action': function () {
                    return false;
                }	// Nothing to do in this case. You can as well omit the action property.
            }
        }
    });
}

function confirm_property_sold_status(AdmEmail, mode, propId) {
    $.confirm({
        'title': 'Confirmation',
        'message': 'Whether you want to continue this action?',
        'buttons': {
            'Yes': {
                'class': 'yes',
                'action': function () {
                    action_logs(AdmEmail, mode, propId);
                    //$('#statusMode').val(req);
                    //$('#display_form').submit();
                }
            },
            'No': {
                'class': 'no',
                'action': function () {
                    return false;
                }	// Nothing to do in this case. You can as well omit the action property.
            }
        }
    });
}

function action_logs(AdmEmail, mode, propId) {


    var perms = prompt("For Security Purpose, Please Enter Booking Code");
    if (perms == '') {
        alert("Please Enter The Booking Code");
        return false;
    } else if (perms == null) {
        return false;
    } else {
        if (perms != AdmEmail) {


            //$('#display_form').submit();

            /*$.ajax(
             {
             type: 'POST',
             url: 'admin/product/change_product_sold_status/',
             data: {"id": propId,'mode': mode},
             dataType: 'json',
             success: function(json)
             {
             alert(json);
             }
             });*/
            alert("Please Enter The Correct Booking Code");
            return false;

        } else {
            $.ajax({
                type: 'POST',
                url: baseURL + 'admin/product/change_product_sold_status/',
                data: {"id": propId, 'mode': mode},
                dataType: 'json',
                success: function (response)
                {
                    if (response.success == '0') {
                        alert(response.msg);
                        return false;
                    } else {
                        if (mode == '0') {
                            location.href = baseURL + 'admin/product/display_product_list';
                        } else {
                            location.href = baseURL + 'admin/product/display_user_product_list';
                        }
                    }
                }
            });
        }
    }



}

//Bulk Active, Inactive, Delete Logs created by siva
function bulk_logs_action(req, AdmEmail) {
    var perms = prompt("For Security Purpose, Please Enter Email Id");
    if (perms == '') {
        alert("Please Enter The Email ID");
        return false;
    } else if (perms == null) {
        return false;
    } else {
        if (perms == AdmEmail) {
            $('#statusMode').val(req);
            $('#SubAdminEmail').val(AdmEmail);
            $('#display_form').submit();
        } else {
            alert("Please Enter The Correct Email ID");
            return false;
        }
    }
}

function bulk_logs_action1(req)
{
    var perms = prompt("Please enter the new password");
    if (perms == '')
    {
        alert("Please enter valid password");
        return false;
    } else if (perms == null)
    {
        return false;
    } else
    {
        $('#statusMode').val(req);
        $('#password_value').val(perms);
        //$('#SubAdminEmail').val(AdmEmail);				
        $('#display_form').submit();
    }
}


//confirm status change
function confirm_status(path) {
    $.confirm({
        'title': 'Confirmation',
        'message': 'You are about to change the status of this record ! Continue?',
        'buttons': {
            'Yes': {
                'class': 'yes',
                'action': function () {
                    window.location = BaseURL + path;
                }
            },
            'No': {
                'class': 'no',
                'action': function () {
                    return false;
                }	// Nothing to do in this case. You can as well omit the action property.
            }
        }
    });
}
//confirm mode change
function confirm_mode(path) {
    $.confirm({
        'title': 'Confirmation',
        'message': 'You are about to change the display mode of this record ! Continue?',
        'buttons': {
            'Yes': {
                'class': 'yes',
                'action': function () {
                    window.location = BaseURL + path;
                }
            },
            'No': {
                'class': 'no',
                'action': function () {
                    return false;
                }	// Nothing to do in this case. You can as well omit the action property.
            }
        }
    });
}
function confirm_delete(path) {
    $.confirm({
        'title': 'Delete Confirmation',
        'message': 'You are about to delete this record. <br />It cannot be restored at a later time! Continue?',
        'buttons': {
            'Yes': {
                'class': 'yes',
                'action': function () {
                    window.location = BaseURL + path;
                }
            },
            'No': {
                'class': 'no',
                'action': function () {
                    return false;
                }	// Nothing to do in this case. You can as well omit the action property.
            }
        }
    });
}


//Category Add Function By Siva 
function checkBoxCategory() {

    var tot = 0;
    var chkVal = 'on';
    var frm = $('#display_form input');
    for (var i = 0; i < frm.length; i++) {
        if (frm[i].type == 'checkbox') {
            if (frm[i].checked) {
                tot = 1;
                chkVal = frm[i].value;
            }
        }
    }
    if (tot == 0) {
        alert("Please Select the CheckBox");
        return false;
    } else if (tot > 1) {
        alert("Please Select only one CheckBox at a time");
        return false;
    } else if (chkVal == 'on') {
        alert("No records found ");
        return false;

    } else {
        confirm_category_checkbox(chkVal);
    }

}

//Category Checkbox Confirmation
function confirm_category_checkbox(chkVal) {
    $.confirm({
        'title': 'Confirmation',
        'message': 'Whether you want to continue this action?',
        'buttons': {
            'Yes': {
                'class': 'yes',
                'action': function () {
                    $('#checkboxID').val(chkVal);
                    $('#display_form').submit();
                }
            },
            'No': {
                'class': 'no',
                'action': function () {
                    return false;
                }	// Nothing to do in this case. You can as well omit the action property.
            }
        }
    });
}

/**
 * 
 * Change the seller request status
 * @param val	-> status
 * @param sid	-> seller request id
 */
function changeSellerStatus(sid, uid) {
    val = $('#seller_status_' + sid).val();
    if (val != '' && sid != '') {
        $.ajax(
                {
                    type: 'POST',
                    url: 'admin/seller/change_seller_request',
                    data: {"id": sid, 'status': val, 'user_id': uid},
                    dataType: 'json',
                    success: function (json)
                    {
                        alert(json);
                    }
                });
    }
}



/**
 * 
 * Change the seller request status
 * @param val	-> search
 * @param sid	-> search request id
 */
function SearchValidation() {
    //$('#location_val').html('').show();
    val = $('#location').val();
    rentalval = $('#rentalid').val();
    if (val == '' && rentalval == '') {
        $('#location_val').html('Empty searches are not allowed').show();
        //$('#location_val').html('Vacation destination cannot be empty').show();
        //alert('Vacation destination cannot be empty');
        return false;
    } else {
        $('#location_val').html('').hide();
        return true;
    }
}
function NewsValidation() {
    //$('#location_val').html('').show();
    val = $('#newsletter').val();
    if (val == '') {
        $('#newletter_val').html('Please enter correct email address or email already exits').show();
        //alert('Vacation destination cannot be empty');
        return false;
    } else {
        $('#newletter_val').html('').hide();
        return true;
    }
}

function disableGiftCards(path, mail) {
    $.confirm({
        'title': 'Confirmation',
        'message': 'You are about to change the mode of giftcards ! Continue?',
        'buttons': {
            'Yes': {
                'class': 'yes',
                'action': function () {
                    var perms = prompt("For Security Purpose, Please Enter Email Id");
                    if (perms == '') {
                        alert("Please Enter The Email ID");
                        return false;
                    } else if (perms == null) {
                        return false;
                    } else {
                        if (perms == mail) {
                            window.location = BaseURL + path;
                        } else {
                            alert("Please Enter The Correct Email ID");
                            return false;
                        }
                    }
                }
            },
            'No': {
                'class': 'no',
                'action': function () {
                    return false;
                }	// Nothing to do in this case. You can as well omit the action property.
            }
        }
    });
}

function editPictureProducts(val, imgId) {

    var id = 'img_' + val;
    var sPath = window.location.pathname;
    var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
    $.ajax(
            {
                type: 'POST',
                url: BaseURL + 'admin/product/editPictureProducts',
                data: {"id": id, 'cpage': sPage, 'position': val, 'imgId': imgId},
                dataType: 'json',
                success: function (response)
                {
                    if (response == 'No') {
                        alert("You can't delete all the images");
                        return false;
                    } else {
                        $('#img_' + val).remove();
                    }
                }
            });
}

function ChangeFeatured(FeId, rateId) {
    $('#feature_' + rateId).html('<a class="c-loader" href="javascript:void(0);" title="Loading" >Loading</a>');
    var featuid = FeId;

    var id = 'feature_' + rateId;
    var sPath = window.location.pathname;
    var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
    $.ajax(
            {
                type: 'POST',
                url: BaseURL + 'admin/product/ChangeFeaturedProducts',
                data: {"id": id, 'cpage': sPage, 'imgId': rateId, 'FtrId': featuid},
                dataType: 'json',
                success: function (response)
                {
                    $('#feature_' + rateId).remove();
                }

            });

    if (featuid == 'Yes') {
        $('#feature_' + rateId).html('<a class="c-featured" href="javascript:ChangeFeatured(\'No\',' + rateId + ')" title="Click To Un-Featured" >Featured</a>').show();
    } else {
        $('#feature_' + rateId).html('<a class="c-unfeatured" href="javascript:ChangeFeatured(\'Yes\',' + rateId + ')" title="Click To Featured" >Un-Featured</a>').show();
    }
}

function DeletePictureProducts(rateId) {

    var r = confirm("Are you sure to delete this image");
    if (r == true)
    {
        var id = 'img_' + rateId;
        var sPath = window.location.pathname;
        var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
        $.ajax(
                {
                    type: 'POST',
                    url: BaseURL + 'admin/product/DeleteImageProducts',
                    data: {"id": id, 'cpage': sPage, 'imgId': rateId},
                    dataType: 'json',
                    success: function (response)
                    {
                        if (response == 'No') {
                            alert("You can't delete all the Images");
                            return false;
                        } else {

                            $('#img_' + rateId).remove();

                        }
                    }
                });
    } else
    {
        return false;
    }

}

function DeleteRateProducts(rateId) {

    var id = 'rate_' + rateId;
    var sPath = window.location.pathname;
    var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
    $.ajax(
            {
                type: 'POST',
                url: BaseURL + 'admin/product/DeletePackageProducts',
                data: {"id": id, 'cpage': sPage, 'imgId': rateId},
                dataType: 'json',
                success: function (response)
                {
                    if (response == 'No') {
                        alert("You can't delete all the Package");
                        return false;
                    } else {
                        $('#rate_' + rateId).remove();
                    }
                }
            });
}


function DeleteComps(compsId) {
//alert(compsId);
    var id = 'comp_' + compsId;
    var sPath = window.location.pathname;
    var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
    $.ajax(
            {
                type: 'POST',
                url: BaseURL + 'admin/product/DeleteCompsProducts',
                data: {"id": id, 'cpage': sPage, 'compId': compsId},
                dataType: 'json',
                success: function (response)
                {
                    if (response == 'No') {
                        alert("You can't delete all the Comps");
                        return false;
                    } else {
                        $('#comp_' + compsId).remove();

                        var compsAs = $('#CompVals').val();
                        var cmVal = parseInt(compsAs) - 1;
                        //alert(compsAs+' - '+cmVal);
                        $('#CompVals').val(cmVal);
                        if (parseInt(cmVal) < 3) {
                            $('#compadd').show();
                        }

                    }
                }
            });
}

function editPictureProductsUser(val, imgId) {

    var id = 'img_' + val;
    var sPath = window.location.pathname;
    var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
    $.ajax(
            {
                type: 'POST',
                url: BaseURL + 'site/product/editPictureProducts',
                data: {"id": id, 'cpage': sPage, 'position': val, 'imgId': imgId},
                dataType: 'json',
                success: function (response)
                {
                    if (response == 'No') {
                        alert("You can't delete all the images");
                        return false;
                    } else {
                        $('#img_' + val).remove();
                    }
                }
            });
}

function quickSignup() {
    var dlg_signin = $.dialog('signin-overlay'),
            dlg_register = $.dialog('register');
    var email = $('#signin-email').val();
    $.ajax({
        type: 'POST',
        url: baseURL + 'site/user/quickSignup',
        data: {"email": email},
        dataType: 'json',
        success: function (response)
        {
            if (response.success == '0') {
                alert(response.msg);
                return false;
            } else {
                $('.quickSignup2 .username').val(response.user_name);
                $('.quickSignup2 .url b').text(response.user_name);
                $('.quickSignup2 .email').val(response.email);
                $('.quickSignup2 .fullname').val(response.full_name);
                dlg_register.open();
            }
        }
    });
}
function quickSignup2() {
    var username = $('.quickSignup2 .username').val();
    var email = $('.quickSignup2 .email').val();
    var password = $('.quickSignup2 .user_password').val();
    var fullname = $('.quickSignup2 .fullname').val();
    $.ajax({
        type: 'POST',
        url: baseURL + 'site/user/quickSignupUpdate',
        data: {"username": username, "email": email, "password": password, "fullname": fullname},
        dataType: 'json',
        success: function (response)
        {
            if (response.success == '0') {
                alert(response.msg);
                return false;
            } else {
                location.href = baseURL + 'send-confirm-mail';
            }
        }
    });
}
function register_user() {
    var fullname = $('.fullname').val();
    var username = $('.username').val();
    var email = $('.email').val();
    var pwd = $('.password').val();

    var api_id = $('#api_id').val();
    var thumbnail = $('#thumbnail').val();


    if (fullname == '') {
        alert('Full name required');
    } else if (username == '') {
        alert('User name required');
    } else if (email == '') {
        alert('Email required');
    } else if (pwd == '') {
        alert('Password required');
    } else if (pwd.length < 6) {
        alert('Password must be minimum of 6 characters');
    } else {
        var brand = 'no';
        if ($('.brandSt').is(':checked')) {
            brand = 'yes';
        }
        $.ajax({
            type: 'POST',
            url: baseURL + 'site/user/registerUser',
            data: {"fullname": fullname, "username": username, "email": email, "pwd": pwd, "brand": brand, "api_id": api_id, "thumbnail": thumbnail},
            dataType: 'json',
            success: function (response)
            {
                if (response.success == '0') {
                    alert(response.msg);
                    return false;
                } else {
                    location.href = baseURL + 'send-confirm-mail';
                }
            }
        });
    }
    return false;
}

function hideErrDiv(arg) {
    $("#" + arg).hide("slow");
}
function resendConfirmation(mail) {
    if (mail != '') {
        $('.confirm-email').html('<span>Sending...</span>');
        $.ajax({
            type: 'POST',
            url: baseURL + 'site/user/resend_confirm_mail',
            data: {"mail": mail},
            dataType: 'json',
            success: function (response) {
                if (response.success == '0') {
                    alert(response.msg);
                    return false;
                } else {
                    $('.confirm-email').html('<font color="green">Confirmation Mail Sent Successfully</font>');
                }
            }
        });
    }
}
function profileUpdate() {
    $('#save_account').disable();
    var full_name = $('.setting_fullname').val();
    var web_url = $('.setting_website').val();
    var location = $('.setting_location').val();
    var twitter = $('.setting_twitter').val();
    var facebook = $('.setting_facebook').val();
    var google = $('.setting_google').val();
    var b_year = $('.birthday_year').val();
    var b_month = $('.birthday_month').val();
    var b_day = $('.birthday_day').val();
    var setting_bio = $('.setting_bio').val();
    var email = $('.setting_email').val();
    var age = $('.setting_age').val();
    var gender = $('.setting_gender:checked').val();
    $.ajax({
        type: 'POST',
        url: baseURL + 'site/user_settings/update_profile',
        data: {"full_name": full_name, "web_url": web_url, "location": location, "twitter": twitter, "facebook": facebook, "google": google, "b_year": b_year, "b_month": b_month, "b_day": b_day, "about": setting_bio, "email": email, "age": age, "gender": gender},
        dataType: 'json',
        success: function (response) {
            if (response.success == '0') {
                alert(response.msg);
                $('#save_account').removeAttr('disabled');
                return false;
            } else {
                window.location.href = baseURL + 'settings';
            }
        }
    });
    return false;
}
function updateUserPhoto() {
    $('#save_profile_image').disable();
    if ($('.uploadavatar').val() == '') {
        alert('Choose a image to upload');
        $('#save_profile_image').removeAttr('disabled');
        return false;
    } else {
        $('#profile_settings_form').removeAttr('onSubmit');
        $('#profile_settings_form').submit();
    }
}
function deleteUserPhoto() {
    $('#delete_profile_image').disable();
    var res = window.confirm('Are you sure?');
    if (res) {
        $.ajax({
            type: 'POST',
            url: baseURL + 'site/user_settings/delete_user_photo',
            dataType: 'json',
            success: function (response) {
                if (response.success == '0') {
                    alert(response.msg);
                    $('#delete_profile_image').removeAttr('disabled');
                    return false;
                } else {
                    window.location.href = baseURL + 'settings';
                }
            }
        });
    } else {
        $('#delete_profile_image').removeAttr('disabled');
        return false;
    }
}
function deactivateUser() {
    $('#close_account').disable();
    var res = window.confirm('Are you sure?');
    if (res) {
        $.ajax({
            url: baseURL + 'site/user_settings/delete_user_account',
            success: function (response) {
                window.location.href = baseURL;
            }
        });
    } else {
        $('#close_account').removeAttr('disabled');
    }
}

function delete_gift(val, gid) {

    $.ajax({
        type: 'POST',
        url: baseURL + 'site/cart/ajaxDelete',
        data: {'curval': val, 'cart': 'gift'},
        success: function (response) {
            var arr = response.split('|');
            $('#gift_cards_amount').val(arr[0]);
            $('#item_total').html(arr[0]);
            $('#total_item').html(arr[0]);
            $('#Shop_id_count').html(arr[1]);
            $('#Shop_MiniId_count').html(arr[1] + ' items');
            $('#giftId_' + gid).hide();
            $('#GiftMindivId_' + gid).hide();
            if (arr[0] == 0) {
                $('#GiftCartTable').hide();
                if (arr[1] == 0) {
                    $('#EmptyCart').show();
                }
            }
        }
    });
}


function delete_subscribe(val, sid) {

    $.ajax({
        type: 'POST',
        url: baseURL + 'site/cart/ajaxDelete',
        data: {'curval': val, 'cart': 'subscribe'},
        success: function (response) {
            var arr = response.split('|');
            $('#subcrib_amount').val(arr[0]);
            $('#subcrib_ship_amount').val(arr[1]);
            $('#subcribt_tax_amount').val(arr[2]);
            $('#subcrib_total_amount').val(arr[3]);
            $('#SubCartAmt').html(arr[0]);
            $('#SubCartSAmt').html(arr[1]);
            $('#SubCartTAmt').html(arr[2]);
            $('#SubCartGAmt').html(arr[3]);
            $('#Shop_id_count').html(arr[4]);
            $('#Shop_MiniId_count').html(arr[4] + ' items');
            $('#SubscribId_' + sid).hide();
            $('#SubcribtMinidivId_' + sid).hide();


            if (arr[0] == 0) {
                $('#SubscribeCartTable').hide();
                if (arr[4] == 0) {
                    $('#EmptyCart').show();
                }
            }
        }
    });
}


function ajaxEditproductAttribute(attname, attval, attId) {

    //alert(attname+''+attval+''+attId);

    $('#loadingImg_' + attId).html('<span class="loading"><img src="images/indicator.gif" alt="Loading..."></span>');

    $.ajax({
        type: 'POST',
        url: baseURL + 'admin/product/ajaxProductAttributeUpdate',
        data: {'attname': attname, 'attval': attval, 'attId': attId},
        success: function (response) {
            //alert(response);
            $('#loadingImg_' + attId).html('');
        }
    });

}

function ajaxCartAttributeChange(attId, prdId) {

    $('#loadingImg_' + prdId).html('<span class="loading"><img src="images/indicator.gif" alt="Loading..."></span>');
    $('#AttrErr').html('');
    $.ajax({
        type: 'POST',
        url: baseURL + 'site/product/ajaxProductDetailAttributeUpdate',
        data: {'prdId': prdId, 'attId': attId},
        success: function (response) {
            //alert(response);
            var arr = response.split('|');

            $('#attribute_values').val(arr[0]);
            $('#price').val(arr[1]);
            $('#SalePrice').html(arr[1]);
            $('#loadingImg_' + prdId).html('');
        }
    });

}


function ajaxCartAttributeChangePopup(attId, prdId) {


    $('#loadingImg1_' + prdId).html('<span class="loading"><img src="images/indicator.gif" alt="Loading..."></span>');
    $.ajax({
        type: 'POST',
        url: baseURL + 'site/product/ajaxProductDetailAttributeUpdate',
        data: {'prdId': prdId, 'attId': attId},
        success: function (response) {
            //alert(response);
            var arr = response.split('|');
            $('#attribute_values').val(arr[0]);
            $("#attr_name_id").val(attId);
            $('#price').val(arr[1]);
            $('#SalePrice').html(arr[1]);
            $('#loadingImg1_' + prdId).html('');
        }
    });

}


function delete_cart(val, cid) {
    $.ajax({
        type: 'POST',
        url: baseURL + 'site/cart/ajaxDelete',
        data: {'curval': val, 'cart': 'cart'},
        success: function (response) {

            //alert(response);
            var arr = response.split('|');
            $('#cart_amount').val(arr[0]);
            $('#cart_ship_amount').val(arr[1]);
            $('#cart_tax_amount').val(arr[2]);
            $('#cart_total_amount').val(arr[3]);
            $('#CartAmt').html(arr[0]);
            $('#CartSAmt').html(arr[1]);
            $('#CartTAmt').html(arr[2]);
            $('#CartGAmt').html(arr[3]);
            $('#Shop_id_count').html(arr[4]);
            $('#Shop_MiniId_count').html(arr[4] + ' items');
            $('#cartdivId_' + cid).hide();
            $('#cartMindivId_' + cid).hide();

            if (arr[0] == 0) {
                $('#CartTable').hide();
                if (arr[4] == 0) {
                    $('#EmptyCart').show();
                }
            }
        }
    });
}


function update_cart(val, cid) {

    var qty = $('#quantity' + cid).val();
    var mqty = $('#quantity' + cid).data('mqty');
    if (qty - qty != 0 || qty == '' || qty == '0') {
        alert('Invalid quantity');
        return false;
    }
    if (qty > mqty) {
        $('#quantity' + cid).val(mqty);
        qty = mqty;
        alert('Maximum stock available for this product is ' + mqty);
    }
    $.ajax({
        type: 'POST',
        url: baseURL + 'site/cart/ajaxUpdate',
        data: {'updval': val, 'qty': qty},
        success: function (response) {
            //alert(response); 
            var arr = response.split('|');
            $('#cart_amount').val(arr[1]);
            $('#cart_ship_amount').val(arr[2]);
            $('#cart_tax_amount').val(arr[3]);
            $('#cart_total_amount').val(arr[4]);
            $('#IndTotalVal' + cid).html(arr[0]);
            $('#CartAmt').html(arr[1]);
            $('#CartAmtDup').html(arr[1]);
            $('#CartSAmt').html(arr[2]);
            $('#CartTAmt').html(arr[3]);
            $('#CartGAmt').html(arr[4]);
            $('#Shop_id_count').html(arr[5]);
            $('#Shop_MiniId_count').html(arr[5] + ' items');

        }
    });
}

function CartChangeAddress(IDval) {

    var amt = $('#cart_amount').val();
    var disamt = $('#discount_Amt').val();


    $.ajax({
        type: 'POST',
        url: baseURL + 'site/cart/ajaxChangeAddress',
        data: {'add_id': IDval, 'amt': amt, 'disamt': disamt},
        success: function (response) {

            if (response != '0') {

                var arr = response.split('|');
                $('#cart_ship_amount').val(arr[0]);
                $('#cart_tax_amount').val(arr[1]);
                $('#cart_tax_Value').val(arr[2]);
                $('#cart_total_amount').val(arr[3]);
                $('#CartSAmt').html(arr[0]);
                $('#CartTAmt').html(arr[1]);
                $('#carTamt').html(arr[2]);
                $('#CartGAmt').html(arr[3]);

                $('#Ship_address_val').val(IDval);
                $('#Chg_Add_Val').html(arr[4]);
            } else {

                return false;
            }
        }
    });
}


function SubscribeChangeAddress(IDval) {

    var amt = $('#subcrib_amount').val();

    $.ajax({
        type: 'POST',
        url: baseURL + 'site/cart/ajaxSubscribeAddress',
        data: {'add_id': IDval, 'amt': amt},
        success: function (response) {
            if (response != '0') {
                //alert(response);
                var arr = response.split('|');
                $('#subcrib_ship_amount').val(arr[0]);
                $('#subcrib_tax_amount').val(arr[1]);
                $('#subcrib_total_amount').val(arr[3]);
                $('#SubCartSAmt').html(arr[0]);
                $('#SubCartTAmt').html(arr[1]);
                $('#SubTamt').html(arr[2]);
                $('#SubCartGAmt').html(arr[3]);
                $('#SubShip_address_val').val(IDval);
                $('#SubChg_Add_Val').html(arr[4]);
            } else {
                return false;
            }
        }
    });
}

function shipping_Subcribe_address_delete() {
    var DelId = $('#SubShip_address_val').val();
    $.ajax({
        type: 'POST',
        url: baseURL + 'site/cart/ajaxDeleteAddress',
        data: {'del_ID': DelId},
        success: function (response) {
            if (response == 0) {
                location.reload();
            } else {
                $('#Ship_Sub_err').html('Default address don`t be deleted.');
                setTimeout("hideErrDiv('Ship_Sub_err')", 3000);
                return false;
            }
        }
    });
}

function shipping_cart_address_delete() {
    var DelId = $('#Ship_address_val').val();

    $.ajax({
        type: 'POST',
        url: baseURL + 'site/cart/ajaxDeleteAddress',
        data: {'del_ID': DelId},
        success: function (response) {
            if (response == 0) {
                location.reload();
            } else {
                $('#Ship_err').html('Default address don`t be deleted.');
                setTimeout("hideErrDiv('Ship_err')", 3000);
                return false;
            }
        }
    });
}



function ajax_add_cart(AttrCountVal) {
    $('#QtyErr').html('');
    var login = $('.add_to_cart').attr('require_login');
    if (login) {
        require_login();
        return;
    }
    var quantity = $('#quantity').val();
    var mqty = $('#quantity').data('mqty');
    if (quantity == '0' || quantity == '') {
        alert('Invalid quantity');
        return false;
    }
    if (quantity > mqty) {
        $('#QtyErr').html('Maximum Purchase Quantity at a time is ' + mqty);
        $('#quantity').val(mqty);
        return false;
    }
    if (AttrCountVal > 0) {
        $('#AttrErr').html(' ');
        var AttrVal = $('#attr_name_id').val();
        if (AttrVal == 0) {
            $('#AttrErr').html('Please Choose the Attribute');
            return false;
        }
    }



    //alert(AttrVal); return false;
    var product_id = $('#product_id').val();
    var sell_id = $('#sell_id').val();
    var price = $('#price').val();
    var product_shipping_cost = $('#product_shipping_cost').val();
    var product_tax_cost = $('#product_tax_cost').val();
    var cate_id = $('#cateory_id').val();
    var attribute_values = $('#attribute_values').val();

    //alert(product_id+''+sell_id+''+price+''+product_shipping_cost+''+product_tax_cost+''+attribute_values);
    $.ajax({
        type: 'POST',
        url: baseURL + 'site/cart/cartadd',
        data: {'mqty': mqty, 'quantity': quantity, 'product_id': product_id, 'sell_id': sell_id, 'cate_id': cate_id, 'price': price, 'product_shipping_cost': product_shipping_cost, 'product_tax_cost': product_tax_cost, 'attribute_values': attribute_values},
        success: function (response) {
            //alert(response);
            var arr = response.split('|');
            if (arr[0] == 'login') {
                window.location.href = baseURL + "login";
            } else if (arr[0] == 'Error') {
                //alert('siva');
                $('#ADDCartErr').html('Maximum Purchase Quantity: ' + mqty + '. Already in your cart: ' + arr[1] + '.');
            } else {
                $('#MiniCartViewDisp').html(arr[1]);
                $('#cart_popup').show().delay('2000').fadeOut();
            }

        }
    });
    return false;


}

function ajax_add_cart_subcribe() {
    var login = $('#subscribe').attr('require_login');
    if (login) {
        require_login();
        return;
    }

    var user_id = $('#user_id').val();
    var quantity = 1;
    var fancybox_id = $('#fancybox_id').val();
    var price = $('#price').val();
    var fancy_shipping_cost = $('#shipping_cost').val();
    var fancy_tax_cost = $('#tax').val();
    var category_id = $('#category_id').val();
    var name = $('#name').val();
    var seourl = $('#seourl').val();
    var image = $('#image').val();

    $.ajax({
        type: 'POST',
        url: baseURL + 'site/fancybox/cartsubscribe',
        data: {'name': name, 'quantity': quantity, 'user_id': user_id, 'fancybox_id': fancybox_id, 'price': price, 'fancy_ship_cost': fancy_shipping_cost, 'category_id': category_id, 'fancy_tax_cost': fancy_tax_cost, 'seourl': seourl, 'image': image},
        success: function (response) {
            //alert(response);
            if (response == 'login') {
                window.location.href = baseURL + "login";
            } else {
                $('#MiniCartViewDisp').html(response);
                $('#cart_popup').show().delay('3000').fadeOut();
            }

        }
    });
    return false;
}



function ajax_add_gift_card() {

    var login = $('.create-gift-card').attr('require_login');
    if (login) {
        require_login();
        return;
    }

    $('#GiftErr').html();

    var price = $('#price_value').val();
    var rec_name = $('#recipient_name').val();
    var rec_mail = $('#recipient_mail').val();
    var descp = $('#description').val();
    var sen_name = $('#sender_name').val();
    var sen_mail = $('#sender_mail').val();
    if (price == '') {
        $('#GiftErr').html('Please Select the Price Value');
        return false;
    }
    if (rec_name == '') {
        $('#GiftErr').html('Please Enter the Receiver Name');
        return false;
    }
    if (rec_mail == '') {
        $('#GiftErr').html('Please Enter the Receiver Email');
        return false;
    } else {
        if (!validateEmail(rec_mail)) {
            $('#GiftErr').html('Please Enter Valid Email Address');
            return false;
        }
    }
    if (descp == '') {
        $('#GiftErr').html('Please  Enter the Description');
        return false;
    }

    $.ajax({
        type: 'POST',
        url: baseURL + 'site/giftcard/insertEditGiftcard',
        data: {'price_value': price, 'recipient_name': rec_name, 'recipient_mail': rec_mail, 'description': descp, 'sender_name': sen_name, 'sender_mail': sen_mail},
        success: function (response) {
            if (response == 'login') {
                window.location.href = baseURL + "login";
            } else {
                $('#MiniCartViewDisp').html(response);
                $('#cart_popup').show();
            }
        }
    });

    return false;

}






function change_user_password() {
    $('#save_password').disable();
    var pwd = $('#pass').val();
    var cfmpwd = $('#confirmpass').val();
    if (pwd == '') {
        alert('Enter new password');
        $('#save_password').removeAttr('disabled');
        $('#pass').focus();
        return false;
    } else if (pwd.length < 6) {
        alert('Password must be minimum of 6 characters');
        $('#save_password').removeAttr('disabled');
        $('#pass').focus();
        return false;
    } else if (cfmpwd == '') {
        alert('Confirm password required');
        $('#save_password').removeAttr('disabled');
        $('#confirmpass').focus();
        return false;
    } else if (pwd != cfmpwd) {
        alert('Passwords doesnot match');
        $('#save_password').removeAttr('disabled');
        $('#confirmpass').focus();
        return false;
    } else {
        return true;
    }
}

function shipping_address_cart() {
    var dlg_address = $.dialog('newadds-frm'), dlg_address1 = $.dialog('editadds-frm'), $tpl = $('#address_tmpl').remove();
//	dlg_address.$obj.trigger('reset').find('.ltit').text(gettext('Add Shipping Address')).end().find('.ltxt dt').html('<b>'+gettext('New Shipping Address')+'</b><small>'+gettext('We ships worldwide with global delivery services.')+'</small>');
    dlg_address.open();

    setTimeout(function () {
        dlg_address.$obj.find(':text:first').focus()
    }, 10);
}


//Coupon code Used

function checkCode() {

    $('#CouponErr').html('');
    $('#CouponErr').show();

    var cartValue = $('#cart_amount').val();
    if (cartValue > 0) {

        var code = $('#is_coupon').val();
        var amount = $('#cart_total_amount').val();
        var shipamount = $('#cart_ship_amount').val();
        var taxamount = $('#cart_tax_amount').val();

        if (code != '') {

            $.ajax({
                type: 'POST',
                url: baseURL + 'site/cart/checkCode',
                data: {'code': code, 'amount': amount, 'shipamount': shipamount},
                success: function (response) {
//				alert(response);
                    var resarr = response.split('|');
                    if (response == 1) {
                        $('#CouponErr').html('Entered code is invalid');
                        return false;
                    } else if (response == 2) {
                        $('#CouponErr').html('Code is already used');
                        return false;
                    } else if (response == 3) {
                        $('#CouponErr').html('Please add more items in the cart and enter the coupon code');
                        return false;
                    } else if (response == 4) {
                        $('#CouponErr').html('Entered Coupon code is not valid for this product');
                        return false;
                    } else if (response == 5) {
                        $('#CouponErr').html('Entered Coupon code is expired');
                        return false;
                    } else if (response == 6) {
                        $('#CouponErr').html('Entered code is Not Valid');
                        return false;
                    } else if (response == 7) {
                        $('#CouponErr').html('Please add more items quantity in the particular category or product, for using this coupon code');
                        return false;
                    } else if (response == 8) {
                        $('#CouponErr').html('Entered Gift code is expired');
                        return false;
                    } else if (resarr[0] == 'Success') {

                        $.ajax({
                            type: 'POST',
                            url: baseURL + 'site/cart/checkCodeSuccess',
                            data: {'code': code, 'amount': amount, 'shipamount': shipamount},
                            success: function (response) {
//						alert(response); 	
                                var arr = response.split('|');

                                $('#cart_amount').val(arr[0]);
                                $('#cart_ship_amount').val(arr[1]);
                                $('#cart_tax_amount').val(arr[2]);
                                $('#cart_total_amount').val(arr[3]);
                                $('#discount_Amt').val(arr[4]);
                                $('#CartAmt').html(arr[0]);
                                $('#CartSAmt').html(arr[1]);
                                $('#CartTAmt').html(arr[2]);
                                $('#CartGAmt').html(arr[3]);
                                $('#disAmtVal').html(arr[4]);
                                $('#disAmtValDiv').show();
                                $('#CouponCode').val(code);
                                $('#Coupon_id').val(resarr[1]);
                                $('#couponType').val(resarr[2]);
                                var j = 6;
                                for (var i = 0; i < arr[5]; i++) {
                                    //alert(arr[j]);
                                    $('#IndTotalVal' + i).html(arr[j]);
                                    j++;
                                }
                            }
                        });
                    }
                }
            });
        } else {
            $('#CouponErr').html('Enter Valid Code');
        }
    } else {
        $('#CouponErr').html('Please add items in cart and enter the coupon code');

    }
    setTimeout("hideErrDiv('CouponErr')", 3000);
}

function paypal() {
    $('#PaypalPay').show();
    $('#CreditCardPay').hide();
    $('#otherPay').hide();
    $("#dep1").attr("class", "depth1 current");
    $("#dep2").attr("class", "depth2");
    $("#dep1 a").attr("class", "current");
    $("#dep2 a").attr("class", "");
}

function creditcard() {

    $('#CreditCardPay').show();
    $('#PaypalPay').hide();
    $('#otherPay').hide();

    $("#dep1").attr("class", "depth1");
    $("#dep2").attr("class", "depth2 current");
    $("#dep1 a").attr("class", "");
    $("#dep2 a").attr("class", "current");

}

function othermethods() {

    $('#otherPay').show();
    $('#PaypalPay').hide();
    $('#CreditCardPay').hide();

    $("#dep1").attr("class", "depth1");
    $("#dep2").attr("class", "depth2");
    $("#dep3").attr("class", "depth3 current");
    $("#dep1 a").attr("class", "");
    $("#dep2 a").attr("class", "");
    $("#dep3 a").attr("class", "current");

}

function loadListValues(e) {
    var lid = $(e).val();
    var listValue = $(e).parent().next().find('select');
    if (lid == '') {
        listValue.html('<option value="">--Select--</option>');
    } else {
        listValue.hide();
        $(e).parent().next().append('<span class="loading">Loading...</span>');
        $.ajax({
            type: 'POST',
            url: BaseURL + 'admin/product/loadListValues',
            data: {lid: lid},
            dataType: 'json',
            success: function (json) {
                listValue.next().remove();
                listValue.html(json.listCnt).show();
            }
        });
    }
}
function loadStateListValues(e) {
    //$('#listCountryCnt').hide();	
    //$('#listCountryCnt').hide();
    var lid = $(e).val();
    var lvID = $(e).val();
    //var listValue = $(e).parent().next().find('select');
    if (lid == '') {

    } else {

        $.ajax({
            type: 'POST',
            url: BaseURL + 'admin/product/loadStateListValues',
            data: {lid: lid},
            dataType: 'json',
            success: function (json) {
                $('#listStateCnt').hide();
                $('#listStateCnt').html(json.listCountryCnt).show();
            }
        });

    }
}

function loadStateListValuesSite(e) {
    $('#listStateCnt').html('Loading...').show();
    //$('#listCountryCnt').hide();
    var lid = $(e).val();
    var lvID = $(e).val();
    //var listValue = $(e).parent().next().find('select');
    if (lid == '') {

    } else {

        $.ajax({
            type: 'POST',
            url: BaseURL + 'site/product/loadStateListValues',
            data: {lid: lid},
            dataType: 'json',
            success: function (json) {
                $('#listStateCnt').hide();
                $('#listStateCnt').html(json.listCountryCnt).show();
            }
        });

    }
}

function loadCountryListValues(e) {

    //$('#listCountryCnt').hide();	
    //$('#listCountryCnt').hide();
    var lid = $(e).val();
    var lvID = $(e).val();
    //var listValue = $(e).parent().next().find('select');
    if (lid == '') {

    } else {

        $.ajax({
            type: 'POST',
            url: BaseURL + 'admin/product/loadCountryListValues',
            data: {lid: lid},
            dataType: 'json',
            success: function (json) {
                $('#listCountryCnt').hide();
                $('#listCountryCnt').html(json.listCountryCnt).show();
            }
        });

    }
}

function loadListValuesUser(e) {
    var lid = $(e).val();
    var listValue = $(e).parent().next().find('select');
    if (lid == '') {
        listValue.html('<option value="">--Select--</option>');
    } else {
        listValue.hide();
        $(e).parent().next().append('<span class="loading">Loading...</span>');
        $.ajax({
            type: 'POST',
            url: BaseURL + 'site/product/loadListValues',
            data: {lid: lid},
            dataType: 'json',
            success: function (json) {
                listValue.next().remove();
                listValue.html(json.listCnt).show();
            }
        });
    }
}



function changeListValues(e, lvID) {
    var lid = $(e).val();
    var listValue = $(e).parent().next().find('select');
    if (lid == '') {
        listValue.html('<option value="">--Select--</option>');
    } else {
        listValue.hide();
        $(e).parent().next().append('<span class="loading">Loading...</span>');
        $.ajax({
            type: 'POST',
            url: BaseURL + 'admin/product/loadListValues',
            data: {lid: lid, lvID: lvID},
            dataType: 'json',
            success: function (json) {
                listValue.next().remove();
                listValue.html(json.listCnt).show();
            },
            complete: function () {
                listValue.next().remove();
                listValue.show();
            }
        });
    }
}

function changeListValuesUser(e, lvID) {
    var lid = $(e).val();
    var listValue = $(e).parent().next().find('select');
    if (lid == '') {
        listValue.html('<option value="">--Select--</option>');
    } else {
        listValue.hide();
        $(e).parent().next().append('<span class="loading">Loading...</span>');
        $.ajax({
            type: 'POST',
            url: BaseURL + 'site/product/loadListValues',
            data: {lid: lid, lvID: lvID},
            dataType: 'json',
            success: function (json) {
                listValue.next().remove();
                listValue.html(json.listCnt).show();
            },
            complete: function () {
                listValue.next().remove();
                listValue.show();
            }
        });
    }
}


//confirm status change
function confirm_status_dashboard(path) {
    $.confirm({
        'title': 'Confirmation',
        'message': 'You are about to change the status of this record ! Continue?',
        'buttons': {
            'Yes': {
                'class': 'yes',
                'action': function () {
                    window.location = BaseURL + 'admin/dashboard/admin_dashboard';
                }
            },
            'No': {
                'class': 'no',
                'action': function () {
                    return false;
                }	// Nothing to do in this case. You can as well omit the action property.
            }
        }
    });
}


function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    if (!emailReg.test($email)) {
        return false;
    } else {
        return true;
    }
}

function changeShipStatus(value, dealCode, seller) {
    $('.status_loading_' + dealCode).prev().hide();
    $('.status_loading_' + dealCode).show();
    $.ajax({
        type: 'post',
        url: baseURL + 'site/user/change_order_status',
        data: {'value': value, 'dealCode': dealCode, 'seller': seller},
        dataType: 'json',
        success: function (json) {
            if (json.status_code == 1) {
//				alert('Shipping status changed successfully');
            }
        },
        fail: function (data) {
            alert(data);
        },
        complete: function () {
            $('.status_loading_' + dealCode).hide();
            $('.status_loading_' + dealCode).prev().show();
        }
    });
}

function changeCatPos(evt, catID) {
    var pos = $(evt).prev().val();
    if ((pos - pos) != 0) {
        alert('Invalid position');
        return;
    } else {
        $(evt).hide();
        $(evt).next().show();
        $.ajax({
            type: 'post',
            url: baseURL + 'admin/category/changePosition',
            data: {'catID': catID, 'pos': pos},
            complete: function () {
                $(evt).next().hide();
                $(evt).show().text('Done').delay(800).text('Update');
            }
        });
    }
}


function changeProductPos(evt, catID) {
    var pos = $(evt).prev().val();
    if ((pos - pos) != 0) {
        alert('Invalid position');
        return;
    } else {
        $(evt).hide();
        $(evt).next().show();
        $.ajax({
            type: 'post',
            url: baseURL + 'admin/product/changePosition',
            data: {'catID': catID, 'pos': pos},
            complete: function () {
                $(evt).next().hide();
                $(evt).show().text('Done').delay(800).text('Update');
            }
        });
    }
}


function ChangeImagePriority(evt, catID) {
    var pos = evt.value;
    //alert(pos);
    if ((pos - pos) != 0) {
        alert('Invalid position');
        return;
    } else {

        $.ajax({
            type: 'post',
            url: baseURL + 'admin/product/changeImagePosition',
            data: {'catID': catID, 'pos': pos},
            complete: function () {
                $('#imgmsg_' + catID).hide();
                $('#imgmsg_' + catID).show().text('Done').delay(800).text('');
            }
        });
    }
}


function ChangeImagetitle(evt, catID) {
    var title = evt.value;
    //alert(pos);

    $.ajax({
        type: 'post',
        url: baseURL + 'admin/product/changeImagetitle',
        data: {'catID': catID, 'title': title},
        complete: function () {
            $('#imgmsg_' + catID).hide();
            $('#imgmsg_' + catID).show().text('Done').delay(800).text('');
        }
    });

}


function subType(evt) {
    var type = evt.value;
    //alert(pos);
    if (type == 'Multi Family')
    {

    }
    $.ajax({
        type: 'post',
        url: baseURL + 'admin/product/changeImagetitle',
        data: {'catID': catID, 'title': title},
        complete: function () {
            $('#imgmsg_' + catID).hide();
            $('#imgmsg_' + catID).show().text('Done').delay(800).text('');
        }
    });

}


function ChangeSiteImagePriority(evt, catID) {
    var pos = evt.value;
    //alert(pos);
    if ((pos - pos) != 0) {
        alert('Invalid position');
        return;
    } else {

        $.ajax({
            type: 'post',
            url: baseURL + 'site/owner/changeImagePosition',
            data: {'catID': catID, 'pos': pos},
            complete: function () {
                $('#imgmsg_' + catID).hide();
                $('#imgmsg_' + catID).show().text('Done').delay(800).text('');
            }
        });
    }
}

function ChangeSiteImagetitle(evt, catID) {
    var title = evt.value;
    //alert(pos);

    $.ajax({
        type: 'post',
        url: baseURL + 'site/owner/changeImagetitle',
        data: {'catID': catID, 'title': title},
        complete: function () {
            $('#imgmsg_' + catID).hide();
            $('#imgmsg_' + catID).show().text('Done').delay(800).text('');
        }
    });
}


function approveCmt(evt) {
    if ($(evt).hasClass('approving'))
        return;
    $(evt).addClass('approving');
    $(evt).text('Approving...');
    var cfm = window.confirm('Are you sure to approve this comment ?\n This action cannot be undone.');
    if (cfm) {
        var cid = $(evt).data('cid');
        var tid = $(evt).data('tid');
        var uid = $(evt).data('uid');
        $.ajax({
            type: 'post',
            url: baseURL + 'site/product/approve_comment',
            data: {'cid': cid, 'tid': tid, 'uid': uid},
            dataType: 'json',
            success: function (json) {
                if (json.status_code == '1') {
                    $(evt).parent().remove();
                } else {
                    $(evt).removeClass('approving');
                    $(evt).text('Approve');
                }
            }
        });
    } else {
        $(evt).removeClass('approving');
        $(evt).text('Approve');
    }
}

function deleteCmt(evt) {
    if ($(evt).hasClass('deleting'))
        return;
    $(evt).addClass('deleting');
    $(evt).text('Deleting...');
    var cfm = window.confirm('Are you sure to delete this comment ?\n This action cannot be undone.');
    if (cfm) {
        var cid = $(evt).data('cid');
        $.ajax({
            type: 'post',
            url: baseURL + 'site/product/delete_comment',
            data: {'cid': cid},
            dataType: 'json',
            success: function (json) {
                if (json.status_code == '1') {
                    $(evt).parent().parent().remove();
                } else {
                    $(evt).removeClass('deleting');
                    $(evt).text('Delete');
                }
            }
        });
    } else {
        $(evt).removeClass('deleting');
        $(evt).text('Delete');
    }
}

function post_order_comment(pid, utype, uid, dealcode) {
    if ($('.order_comment_' + pid).hasClass('posting'))
        return;
    $('.order_comment_' + pid).addClass('posting');
    var $form = $('.order_comment_' + pid).parent();
    if (uid == '') {
        alert('Login required');
        $('.order_comment_' + pid).removeClass('posting');
    } else {
        if ($('.order_comment_' + pid).val() == '') {
            alert('Your comment is empty');
            $('.order_comment_' + pid).removeClass('posting');
        } else {
            $form.find('img').show();
            $form.find('input').hide();
            $.ajax({
                type: 'post',
                url: baseURL + 'site/user/post_order_comment',
                data: {'product_id': pid, 'comment_from': utype, 'commentor_id': uid, 'deal_code': dealcode, 'comment': $('.order_comment_' + pid).val()},
                complete: function () {
                    $form.find('img').hide();
                    $form.find('input').show();
                    window.location.reload();
                }
            });
        }
    }
}

function post_order_comment_admin(pid, dealcode) {
    if ($('.order_comment_' + pid).hasClass('posting'))
        return;
    $('.order_comment_' + pid).addClass('posting');
    var $form = $('.order_comment_' + pid).parent();
    if ($('.order_comment_' + pid).val() == '') {
        alert('Your comment is empty');
        $('.order_comment_' + pid).removeClass('posting');
    } else {
        $form.find('img').show();
        $form.find('input').hide();
        $.ajax({
            type: 'post',
            url: baseURL + 'admin/order/post_order_comment',
            data: {'product_id': pid, 'comment_from': 'admin', 'commentor_id': '1', 'deal_code': dealcode, 'comment': $('.order_comment_' + pid).val()},
            complete: function () {
                $form.find('img').hide();
                $form.find('input').show();
                window.location.reload();
            }
        });
    }
}

function changeReceivedStatus(evt, rid) {
    $(evt).hide();
    $(evt).next().show();
    $.ajax({
        type: 'post',
        url: baseURL + 'site/user/change_received_status',
        data: {'rid': rid, 'status': $(evt).val()},
        complete: function () {
            $(evt).show();
            $(evt).next().hide();
        }
    });
}

function update_refund(evt, uid) {
    if ($(evt).hasClass('updating'))
        return;
    $(evt).addClass('updating').text('Updating..');
    var amt = $(evt).prev().val();
    if (amt == '' || (amt - amt != 0)) {
        alert('Enter valid amount');
        $(evt).removeClass('updating').text('Update');
        return false;
    } else {
        $.ajax({
            type: 'post',
            url: baseURL + 'admin/seller/update_refund',
            data: {'amt': amt, 'uid': uid},
            complete: function () {
                window.location.reload();
            }
        });
    }
}

function view_inquiry(shipval) {
    $.ajax({
        type: 'POST',
        url: baseURL + 'site/contact/view_inquiry_details',
        data: {'inqID': shipval},
        dataType: 'html',
        success: function (response) {
            //alert(response);
            $('#inquiry_popup').html(response);
        }
    });
    $('#inquiry_popup').show();
    $($(".inquiry_link").colorbox({width: "600px", height: "600px", inline: true, href: "#inquiry_popup"})).trigger('click');
}

function view_review(shipval) {
    $.ajax({
        type: 'POST',
        url: baseURL + 'site/contact/view_review_details',
        data: {'inqID': shipval},
        dataType: 'html',
        success: function (response) {
            //alert(response);
            $('#inquiry_popup').html(response);
        }
    });
    $('#inquiry_popup').show();
    $($(".inquiry_link").colorbox({width: "600px", height: "600px", inline: true, href: "#inquiry_popup"})).trigger('click');
}

function Delete_inquiry(shipval) {
    $.ajax({
        type: 'POST',
        url: baseURL + 'site/contact/Delete_inquiry_details',
        data: {'inqID': shipval},
        dataType: 'html',
        success: function (response) {
            alert(response);
            //$('#inquiry_popup').html(response);
        }
    });
    $('#row_' + shipval).hide();
}

function view_rental_bookingcalendar(shipval) {
    $.ajax({
        type: 'POST',
        url: baseURL + 'site/product/view_calendar',
        data: {'inqID': shipval},
        dataType: 'html',
        success: function (response) {
            alert(response);
            $('#inquiry_popup').html(response);
        }
    });
    $('#inquiry_popup').show();
    $($(".inquiry_link").colorbox({width: "600px", height: "600px", inline: true, href: "#inquiry_popup"})).trigger('click');
}

function DeleteSiteRentalPicture(rateId) {
    var r = confirm("Are you sure to delete this image");
    if (r == true)
    {
        var id = 'img_' + rateId;
        var sPath = window.location.pathname;
        var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
        $.ajax(
                {
                    type: 'POST',
                    url: BaseURL + 'site/product/DeleteImageProducts',
                    data: {"id": id, 'cpage': sPage, 'imgId': rateId},
                    dataType: 'json',
                    success: function (response)
                    {
                        if (response == 'No') {
                            alert("You can't delete all the Images");
                            return false;
                        } else {
                            $('#img_' + rateId).remove();
                        }
                    }
                });
    } else
    {
        return false;
    }
}


function DeleteSiteRental(rateId) {

    var id = 'img_' + rateId;
    var sPath = window.location.pathname;
    var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
    $.ajax(
            {
                type: 'POST',
                url: BaseURL + 'site/product/DeleteSiteProducts',
                data: {"id": id, 'cpage': sPage, 'imgId': rateId},
                dataType: 'json',
                success: function (response)
                {
                    if (response == 'No') {
                        alert("You can't delete all the Images");
                        return false;
                    } else {
                        $('#img_' + rateId).remove();
                    }
                }
            });
}
function TitleCheck(evt)
{
    var data = evt.value;
    //alert(data);
    $.ajax({
        type: 'post',
        url: baseURL + 'site/product/titlecheck',
        data: {'value': data},
        dataType: 'json',
        success: function (response)
        {

            alert("Rental name already exists");
            return false;
            //location.reload();

        }
    });
}




function Change_Status(CStatus, rateId) {
    if (CStatus == 'UnPublish') {
        var cste = 'Publish';
        var uste = 'UnPublish';
    } else {
        var cste = 'UnPublish';
        var uste = 'Publish';
    }

    var id = 'stat_' + rateId;
    var sPath = window.location.pathname;
    var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
    $.ajax(
            {
                type: 'POST',
                url: BaseURL + 'site/product/ChangeStatus',
                data: {"cste": cste, 'cpage': sPage, 'imgId': rateId},
                dataType: 'json',
                success: function (response)
                {
                    if (response == 'No') {
                        alert("You can't delete all the Images");
                        return false;
                    } else {
                        location.reload();
                        // $('#img_'+rateId).remove();
                        // if(CStatus=='Publish'){
//							 	 $('#stat_'+rateId).html("<a title='Click to UnPublish' href='javascript:Change_Status("+uste+","+rateId+");'>UnPublish</a>").show();
//							  }else{
//								 $('#stat_'+rateId).html("<a title='Click to Publish' href='javascript:Change_Status("+rateId+","+rateId+");'>Publish</a>").show();  
//								}
                    }
                }
            });
}
var checked = false;
function checkBoxController(frm, names, search_mode) {


    if (checked == false) {
        checked = true;
    } else {
        checked = false;
    }
    for (var i = 0; i < frm.elements.length; i++) {
        if (frm.elements[i].name == names) {
            frm.elements[i].checked = checked;
        }
    }
}

// Check whether checkbox is seleted or not 
function checkBoxValidationAdminValide(req) {

    var tot = 0;
    var chkVal = 'on';
    var frm = document.learn_form;
    for (var i = 0; i < frm.elements.length; i++) {
        if (frm.elements[i].type == 'checkbox') {
            if (frm.elements[i].checked) {
                tot = 1;
                chkVal = frm.elements[i].value;
            }
        }
    }
    if (tot == 0) {
        alert("Please Select the CheckBox");
        return false;
    } else if (chkVal == 'on') {
        alert("No records found ");
        return false;

    } else {
        //var submt = today_submit();
        var res = window.confirm('Whether you want to continue this action');
        if (res == true) {
            document.getElementById("statusMode").value = req;
            frm.submit();
        } else {
            return false;
        }
    }

}





// Check whether checkbox is seleted or not 
/*function checkBoxValidationAdmin(req) {	
 
 var tot=0;
 var chkVal = 'on';
 var frm = document.learn_form;
 for (var i = 0; i < frm.elements.length; i++){
 if(frm.elements[i].type=='checkbox') {
 if(frm.elements[i].checked) {
 tot=1;
 chkVal = frm.elements[i].value;
 }
 }
 }
 if(tot == 0) {
 alert("Please Select the CheckBox");
 return false;
 }else if(chkVal == 'on') {
 alert("No records found ");
 return false;  
 
 } else {
 //var submt = today_submit();
 var res = window.confirm('Whether you want to continue this action');
 if(res == true){
 document.getElementById("statusMode").value=req;
 frm.submit();
 } else { 
 return false; 				  
 }
 } 
 
 }*/


/*function starts jp*/
//function checkInitialColor(color_code){
$(document).change(function () {
    $("#color").change(function () {
        $("#initial_color_warn").html('');
        var color_code = $("#color").val();
        $.ajax({
            type: 'POST',
            url: BaseURL + 'admin/consultant/checkColor',
            data: {"color": color_code},
            //dataType: 'json',
            success: function (response) {
                if (response != 'availabe') {
                    $("#initial_color_warn").html('Already in Use');
                    $("#color").val('');
                } else {
                    $("#initial_color_warn").html('');
                }
            }
        });
    });
});
//}