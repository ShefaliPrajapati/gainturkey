<?php $this->load->view('site/templates/new_header'); ?>

<?php if (isset($_SESSION['userdata']) && $_SESSION['userdata']['fc_session_user_id']) {
    ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="right_bt">
                    <a class="btn btn-primary <?php
                    if ($this->uri->segment(1, 0) == 'listing') {
                        echo 'nav-link';
                    } ?>" href="<?php
                    if ($loginCheck == '') {
                        echo base_url() . 'signin';
                    } else {
                        echo base_url() . 'listing/viewall/0';
                    } ?> ">Current Inventory</a>
                    <a class="btn btn-primary <?php
                    if ($this->uri->segment(1, 0) == 'soldlisting') {
                        echo 'nav-link';
                    } ?>" href="<?php
                    if ($loginCheck == '') {
                        echo base_url() . 'signin';
                    } else {
                        echo base_url() . 'soldlisting/viewall/0';
                    } ?>">Past/Sold Inventory </a>
                </div>
            </div>
        </div>
    </div>
    <?php
} ?>
<link rel="stylesheet" type="text/css" href="css/site/master.css"/>


<?php /*?><!--<input type="hidden" id="cookieendValue" value="<?php echo $endvalue;?>" />
<input type="hidden" id="cookiestartValue" value="<?php echo $startvalue;?>" />--><?php */?>

<link rel="stylesheet" href="js/timer2/jquery.countdown.css">
<style type="text/css">
    .error {
        color: red;
    }
    #defaultCountdown { width: 240px; height: 45px; }
</style>



<script src="js/timer2/jquery.plugin.js"></script>
<script src="js/timer2/jquery.countdown.js"></script>
<script src="js/site/jquery.cookie.js"></script>
<script type="text/javascript">
    var setTimerVal = '<?php echo $_SESSION['differenceTime']; ?>';
    $(function () {

        //var austDay = new Date();
        //austDay = new Date(austDay.getFullYear() + 1, 1 - 1, 26);
        //$(selector).countdown({until: 600});
        //var x = document.cookie;
        //if(setTimerVal ==''){
//		setTimerVal = 600;
//	}

        $('#defaultCountdown').countdown({until: setTimerVal, format: 'MS',onExpiry: liftOff});


        $( window ).load(function() {
            setTimeout(function(){
                changetoReserved(<?php echo $productDetails->row()->property_id; ?>);
            }, 600000);
        });



        //$('#defaultCountdown').countdown({until: austDay});
        //$('#year').text(austDay.getFullYear());
    });
    function liftOff() {
        var data = $('#property_id').val();
        window.location.href=baseURL+'site/product/changetoActive/'+data;
        // alert('We have lift off!');
    }
</script>
<script src="js/site/autoComplete.js"></script>


<div class="container">
    <div class="listing_content">
        <div class="timer_con">
            <h2>Reservation will Expire in:</h2>
            <div class=" clear"></div>
            <div class="split_timer">
                <span class="error" id="defaultCountdown"></span>
            </div>
        </div>
        <h2 class="tit_head">Property Reservation & Agreement to Purchase</h2>
        <div class="reservation_cont">
            <div class="clear"></div>
            <div class="property_title"> Property Information
                <a href="javascript:void(0);" href="" class="detail_btn back_btn_reservation" onclick="liftOff();">Cancel
                    Reservation</a>
                <a href="javascript:void(0);" class="detail_btn back_btn_reservation" onclick="SaveReserveDetails();">
                    Back To Listing</a>
        </div>
            <div class="property_informaton">
                <ul class="proinform_list">
                    <li>
                        <p>ID :</p>
                        <span><?php echo $productDetails->row()->property_id; ?></span></li>
                    <li>
                        <p><?php echo $productAddress->row()->address . ', ' . $productAddress->row()->city . ', ' . str_replace('-', ' ', $productAddress->row()->state) . ' ' . $productAddress->row()->post_code; ?></p>
                    </li>
                    <li>
                        <p>EVENT PRICE :</p>
                        <span>$<?php echo number_format($productDetails->row()->event_price); ?></span>
                    </li>
                </ul>
                <div class="property_imgfull">
                    <img src="images/product/<?php echo $productImages->row()->product_image; ?>" width="150px" />
                </div>
            </div>
            <div class="col-sm-6 form-inline form-email-reserv">
                <div class="form-group">
                    <label >Email Address</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" class="userMail form-control" autocomplete="off" id="userMail" name="SelectUser"/>&nbsp;&nbsp;&nbsp;&nbsp;
                    <button onclick="SelectUserDetails();" class="detail_btn btn btn-sm" >Submit</button>
                </div>
            </div>
            <div class="for_auto_search"></div>
            <div id="userMail_val" ></div>
            <form name="reservationform" id="ReservationForm" action="site/product/ReservationForm_Submit" method="post" autocomplete="off">
                    <input type="hidden" name="property_id" id="property_id" value="<?php echo $productDetails->row()->id; ?>" />
                <input type="hidden" name="prop_address"
                       value="<?php echo $productAddress->row()->address . ', ' . ucwords($productAddress->row()->city) . ', ' . ucwords(str_replace('-', ' ', $productAddress->row()->state)) . ' ' . $productAddress->row()->post_code; ?>"/>
                    <input type="hidden" name="prop_price" id="prop_price" value="<?php echo $productDetails->row()->event_price; ?>" />
                    <input type="hidden" name="baths" value="<?php echo $productDetails->row()->baths; ?>" />
                    <input type="hidden" name="bedrooms" value="<?php echo $productDetails->row()->bedrooms; ?>" />
                    <input type="hidden" name="sq_feet" value="<?php echo $productDetails->row()->sq_feet; ?>" />
                    <input type="hidden" name="lot_size" value="<?php echo $productDetails->row()->lot_size; ?>" />
                    <input type="hidden" name="monthly_rent" value="<?php echo $productDetails->row()->monthly_rent; ?>" />
                    <input type="hidden" name="property_tax" value="<?php echo $productDetails->row()->property_tax; ?>" />
                    <input type="hidden" name="image" value="<?php echo $productImages->row()->product_image; ?>" />
                    <input type="hidden" name="user_id" id="user_id"/>
                    <span class="error" id="SelectUser_warn"></span>
                    <div class="clear"></div>
                    <div class="property_title"> BUYER & ENTITY INFORMATION </div>
                    <div class="clear"></div>
                    <div class="row form_reservation">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>First Name<span>*</span></label>
                                <input type="text" name="first_name" id="first_name" class="form-control"
                                       value="<?php if (($_SESSION['rfname']) != 'null') {
                                           echo $_SESSION['rfname'];
                                       } ?>"/>
                                <span class="error" id="first_name_warn"></span>
                            </div>
                            <div class="form-group">
                                <label>ENTITY NAME<span>*</span></label>
                                <input type="text" name="entity_name" id="entity_name" class="form-control"
                                       value="<?php if (($_SESSION['rename']) != 'null') {
                                           echo $_SESSION['rename'];
                                       } ?>"/>
                                <span class="error" id="entity_name_warn"></span>
                            </div>
                            <div class="form-group">
                                <label>Phone 1<span>*</span></label>
                                <input type="text" name="phone_no" id="phone_no" class="form-control"
                                       value="<?php if (($_SESSION['rphno']) != 'null') {
                                           echo $_SESSION['rphno'];
                                       } ?>"/>
                                <span class="error" id="phone_no_warn"></span>
                            </div>
                            <div class="form-group">
                                <label>Email 1<span>*</span></label>
                                <input type="text" name="email" id="email" class="form-control"
                                       value="<?php if (($_SESSION['remail']) != 'null') {
                                           echo $_SESSION['remail'];
                                       } ?>"/>
                                <span class="error" id="email_warn"></span>
                            </div>
                            <div class="form-group">
                                <label id="password_txt">Password<span>*</span></label>
                                <input type="password" name="password" id="password" class="form-control"  />
                            </div>
                            <div class="form-group" >
                                <label >ADDRESS<span>*</span></label>
                                <textarea name="address" id="address"
                                          class="form-control"><?php if (($_SESSION['raddress']) != 'null') {
                                        echo $_SESSION['raddress'];
                                    } ?></textarea>
                                <span class="error" id="address_warn"></span>
                            </div>
                            <div class="form-group">
                                <label>COUNTRY<span>*</span></label>
                                <input type="text" name="country" id="country" class="form-control"
                                       value="<?php if (($_SESSION['rcountry']) != 'null') {
                                           echo $_SESSION['rcountry'];
                                       } ?>"/>
                                <span class="error" id="country_warn"></span>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Last Name<span>*</span></label>
                                <input type="text" name="last_name" id="last_name" class="form-control"
                                       value="<?php if (($_SESSION['rlname']) != 'null') {
                                           echo $_SESSION['rlname'];
                                       } ?>"/>
                                <span class="error" id="last_name_warn"></span>
                            </div>
                            <div class="form-group">
                                <label>TYPE<span>*</span></label>
                                <select class="form-control" name="resrv_type" id="resrv_type" >
                                    <option value="INDIVIDUAL" <?php if ($_SESSION['rreservtype'] == 'INDIVIDUAL') {
                                        echo 'selected="selected"';
                                    } ?>>INDIVIDUAL
                                    </option>
                                    <option value="Corp" <?php if ($_SESSION['rreservtype'] == 'Corp') {
                                        echo 'selected="selected"';
                                    } ?>>Corp
                                    </option>
                                    <option value="LLC" <?php if ($_SESSION['rreservtype'] == 'LLC') {
                                        echo 'selected="selected"';
                                    } ?>>LLC
                                    </option>
                                    <option value="Trust" <?php if ($_SESSION['rreservtype'] == 'Trust') {
                                        echo 'selected="selected"';
                                    } ?>>Trust
                                    </option>
                                    <option value="Partnership" <?php if ($_SESSION['rreservtype'] == 'Partnership') {
                                        echo 'selected="selected"';
                                    } ?>>Partnership
                                    </option>
                                    <option value="IRA" <?php if ($_SESSION['rreservtype'] == 'IRA') {
                                        echo 'selected="selected"';
                                    } ?>>IRA
                                    </option>
                                </select>
                                <span class="error" id="resrv_type_warn"></span>
                            </div>
                            <div class="form-group">
                                <label>Phone 2</label>
                                <input type="text" name="phone_no1" id="phone_no1" class="form-control"
                                       value="<?php if (($_SESSION['rphno1']) != 'null') {
                                           echo $_SESSION['rphno1'];
                                       } ?>"/>
                            </div>
                            <div class="form-group">
                                <label>Email 2</label>
                                <input type="text" name="email1" id="email1" class="form-control"
                                       value="<?php if (($_SESSION['remail1']) != 'null') {
                                           echo $_SESSION['remail1'];
                                       } ?>"/>
                            </div>
                            <div class="form-group">
                                <label id="cnfpassword_text">Confirm Password<span>*</span></label>
                                <input type="password" name="conf_password" id="conf_password" class="form-control"  />
                                <span class="error" id="conf_password_warn"></span>
                            </div>
                            <div class="form-group">
                                <label>State<span>*</span></label>
                                <input type="text" name="state" id="state" class="form-control"
                                       value="<?php if (($_SESSION['rstate']) != 'null') {
                                           echo $_SESSION['rstate'];
                                       } ?>"/>
                                <span class="error" id="state_warn"></span>
                            </div>
                            <div class="form-group">
                                <label>City<span>*</span></label>
                                <input type="text" name="city" id="city" class="form-control"
                                       value="<?php if (($_SESSION['rcity']) != 'null') {
                                           echo $_SESSION['rcity'];
                                       } ?>"/>
                                <span class="error" id="city_warn"></span>
                            </div>
                            <div class="form-group">
                                <label>Zip<span>*</span></label>
                                <input type="text" name="postal_code" id="postal_code" class="form-control"
                                       value="<?php if (($_SESSION['rzip']) != 'null') {
                                           echo $_SESSION['rzip'];
                                       } ?>"/>
                                <span class="error" id="postal_code_warn"></span>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="property_title"> TRANSACTION INFORMATION </div>
                    <div class="clear"></div>
                    <div class="buyer form_reservation" style="width:47%; margin: 15px;">
                        <div class="form-group">
                            <label>Sales Price $<span style="color: red;">*</span></label>
                            <input type="text" name="sales_price" id="sales_price" class="form-control" value="<?php echo $productDetails->row()->event_price; ?>" />
                            <span class="error" id="sales_price_warn"></span>
                        </div>
                        <div class="buyer_field" style="width:89%">
                            <label style="width: 22%">&nbsp;</label>
                            <input type="checkbox" id="CheckBox_adjustment" name="CheckBox_adjustment" onclick="return adjustment_function();" />
                        </div>
                        <div style="display:none" id="adjustment_div">
                            <div class="form-group" style="width:100%;">
                                <label>Adjustment $</label>
                                <input type="text" name="adjustment" id="adjustment" class="form-control"
                                       onkeyup="adjustprice();" onkeypress="adjustprice();" onkeydown="adjustprice();"/>
                            </div>
                            <div class="buyer_field" id="netErr"></div>
                            <div class="form-group"  style="width:100%">
                                <label>Net Purchase Price $</label>
                                <input type="text" name="net_purchase_price" id="net_purchase_price" class="form-control" readonly="readonly"  />
                            </div>
                        </div>
                        <div class="form-group"  style="width:100%">
                            <label>RESV.FEE $<span style="color: red;">*</span></label>
                            <input type="text" name="reserv_price" id="reserv_price" class="form-control"
                                   value="<?php if (($_SESSION['rreservprice']) != 'null') {
                                       echo $_SESSION['rreservprice'];
                                   } ?>"/>
                            <span class="error" id="reserv_price_warn"></span>
                        </div>
                        <div class="form-group"  >
                            <label >IN FORM OF:</label>
                            <ul class="list_check" style="width:50%;">
                                <li>
                                    <input type="checkbox" name="cash_payment" id="cash_payment"
                                           value="Cash" <?php if ($_SESSION['rcashpt'] == 'true') {
                                        echo 'checked="checked"';
                                    } ?> />
                                    <span>Cash </span></li>
                                <li>
                                    <input type="checkbox" name="check_payment" id="check_payment"
                                           value="Check" <?php if ($_SESSION['rcheckpt'] == 'true') {
                                        echo 'checked="checked"';
                                    } ?>/>
                                    <span>CHECK</span></li>
                                <li>
                                    <input type="checkbox" name="credit_payment" id="credit_payment"
                                           value="Credit Card" <?php if ($_SESSION['rcreditpt'] == 'true') {
                                        echo 'checked="checked"';
                                    } ?>/>
                                    <span>Credit Card</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="sales_con form_reservation">
                        <div class="form-group">
                            <span class="list_usetite">Sales Type<br /> </span>
                            <ul class="list_check">
                                <li>
                                    <input type="checkbox" name="sales_cash" id="sales_cash"
                                           value="Cash Purchase" <?php if ($_SESSION['rsalescash'] == 'true') {
                                        echo 'checked="checked"';
                                    } ?>/>
                                    <span>Cash Purchase</span></li>
                                <li>
                                    <input type="checkbox" name="sales_cf" id="sales_cf"
                                           value="Cash And Finance" <?php if ($_SESSION['rsalescf'] == 'true') {
                                        echo 'checked="checked"';
                                    } ?>/>
                                    <span>Cash + Finance</span></li>
                                <li>
                                    <input type="checkbox" name="sales_sdira" id="sales_sdira" onclick="select_sdira()"
                                           value="SDIRA" <?php if ($_SESSION['rsalessdira'] == 'true') {
                                        echo 'checked="checked"';
                                    } ?>/>
                                    <span>SDIRA</span></li>
                                <li>
                                    <input type="checkbox" name="sales_fs" id="sales_fs" onclick="select_sdira()"
                                           value="FINANCE And SDIRA" <?php if ($_SESSION['rsalesfs'] == 'true') {
                                        echo 'checked="checked"';
                                    } ?>/>
                                    <span>FINANCE + SDIRA</span></li>
                                <li>
                                    <input type="checkbox" name="sales_sl" id="sales_sl" onclick="select_sdira()"
                                           value="SDIRA LLC" <?php if ($_SESSION['rsalessl'] == 'true') {
                                        echo 'checked="checked"';
                                    } ?>/>
                                    <span>SDIRA LLC</span></li>
                                <li>
                                    <input type="checkbox" name="sales_sl_fs" id="sales_sl_fs" onclick="select_sdira()"
                                           value="SDIRA LLC And FINANCE" <?php if ($_SESSION['rsalesslfs'] == 'true') {
                                        echo 'checked="checked"';
                                    } ?>/>
                                    <span>SDIRA LLC + FINANCE</span></li>
                            </ul>
                        </div>
                        <div class="form-group" id="cust_name_field" style="display: none;">
                            <label style="width: 25%;margin: 0 0 0 21px;"> Custodian Name:</label>
                            <input type="text" name="cust_name" id="cust_name" class="form-control" style="width: 52%"
                                   value="<?php if (($_SESSION['cust_name']) != 'null') {
                                       echo $_SESSION['cust_name'];
                                   } ?>"/>
                        </div>
                        <div class="form-group" id="account_no_field" style="display: none;">
                            <label style="width: 25%;margin: 0 0 0 21px;"> Account Number:</label>
                            <input type="text" name="account_no" id="account_no" class="form-control" style="width: 52%"
                                   value="<?php if (($_SESSION['acco_no']) != 'null') {
                                       echo $_SESSION['acco_no'];
                                   } ?>"/>
                        </div>
                        <div class="form-group">
                            <span class="list_usetite">Reservation Source <span style="color: red;">*</span> </span>
                            <ul class="list_check">
                                <li>
                                    <input type="radio" name="res_source" id="office_source"
                                           value="office" <?php if ($_SESSION['office_source'] == 'true') {
                                        echo 'checked="checked"';
                                    } ?>/> <span>Office</span>
                                </li>
                                <li>
                                    <input type="radio" name="res_source" id="event_source"
                                           value="event" <?php if ($_SESSION['event_source'] == 'true') {
                                        echo 'checked="checked"';
                                    } ?>/> <span>Event</span>
                                </li>

                            </ul>
                        </div>
                        <div class="form-group" >
                            <label style="width: 25%;margin: 0 0 0 21px;">CODE <span style="color: red;">*</span></label>
                            <select name="res_code" id="rese_code" class="form-control"  style="width: 52%" >
                                <option value="" selected="selected" disabled="disabled">Select</option>
                                <?php foreach ($reservationCode->result() as $code) {
                                    echo '<option value="' . $code->attribute_name . '">' . $code->attribute_name . '</option>';
                                }
                                ?>
                            </select>
                            <span class="error" id="reserv_source_warn"></span>
                        </div>
                        <div class="form-group" >
                            <label for="note" style="width: 25%;margin: 0 0 0 21px;">NOTE </label>
                            <textarea id="note" name="note" rows="4" cols="55" id="note" class="form-control"
                                      style="width: 52%"><?php if (($_SESSION['rnote']) != 'null') {
                                    echo $_SESSION['rnote'];
                                } ?></textarea>

                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="agree-cnt">
                        <h2 class="agree-tle">Property Reservation Agreement</h2>
                        <p class="agreement-cnt">This Property Reservation Conformation is your receipt of your commitment to purchase the above referenced property. Due to the nature of the Gain Turnkey Property, and the overwhelming interest the students have in purchasing the properties brought to the event by our preferred vendors, your possession of this document is evidence that the property has been removed from our active database and is not longer available for sale to other students. Our staff will contact you during the final two days of the event to arrange the production and execution of the final document for closing. Please keep this information for reference prior to closing. </p>
                        <!-- <h3 class="code-tle">Please Enter Sales Code </h3> <input type="text" class="sales-code" />-->
                    </div>
                    <div class="clear"></div>
                    <div class="field_login">
                        <input type="hidden" name="rental_id" value="<?php echo $productDetails->row()->property_id; ?>" />
                        <input type="submit" name="signin" id="signin" class="member_btn" value="RESERVE NOW"  style="border:none; margin-left:0px;" />
                    </div>
                 <?php echo form_close(); ?>
                 <div class="clear"></div>

        </div>
    </div>
</div>
<script>
    function SelectUserDetails(){
        var val = $('#userMail').val();
        $.ajax({
            type: 'POST',
            url: baseURL+'site/product/Get_Reservation_User',
            data: {"uid": val},
            dataType: 'json',
            success: function(response)
            {
                if(response.success == '0') {
                    alert(response.alert_msg);
                    return false;
                } else {
                    $('#first_name').val(response.first_name);
                    $('#last_name').val(response.last_name);
                    $('#email').val(response.email);
                    $('#address').val(response.address);
                    $('#address1').val(response.address1);
                    $('#city').val(response.city);
                    $('#state').val(response.state);
                    $('#country').val(response.country);
                    $('#postal_code').val(response.postal_code);
                    $('#phone_no').val(response.phone_no);
                    $('#prop_price').val(response.sales_price);
                    $('#user_id').val(response.user_id);
                    $('#password').hide();
                    $('#conf_password').hide();
                    $('#password_txt').hide();
                    $('#cnfpassword_text').hide();
                }
            }
        });
    }
</script>
<script type="text/javascript">
    $(function() {
        $("#ReservationForm").submit(function(){

            $("#first_name_warn").html('');
            $("#user_name_warn").html('');
            $("#last_name_warn").html('');
            $("#email_warn").html('');
            $("#email1_warn").html('');
            $("#address_warn").html('');
            $("#address1_warn").html('');
            $("#city_warn").html('');
            $("#state_warn").html('');
            $("#phone_no_warn").html('');
            $("#phone_no1_warn").html('');
            $("#entity_name_warn").html('');
            $("#sales_price_warn").html('');
            $("#reserv_price_warn").html('');
            $("#reserv_source_warn").html('');

            if(jQuery.trim($("#first_name").val()) == ''){
                $("#first_name_warn").html('');
                $("#first_name").focus();
                return false;
            }else if(jQuery.trim($("#last_name").val()) == ''){
                $("#last_name_warn").html('Last name is required');
                $("#last_name").focus();
                return false;
            }else if(jQuery.trim($("#entity_name").val()) == ''){
                $("#entity_name_warn").html('Entity name is required');
                $("#entity_name").focus();
                return false;
            }else if(jQuery.trim($("#address").val()) == ''){
                $("#address_warn").html('Address is required');
                $("#address").focus();
                return false;
            }else if(jQuery.trim($("#city").val()) == ''){
                $("#city_warn").html('City is required');
                $("#city").focus();
                return false;
            }else if(jQuery.trim($("#state").val()) == ''){
                $("#state_warn").html('State is required');
                $("#state").focus();
                return false;
            }else if(jQuery.trim($("#phone_no").val()) == ''){
                $("#phone_no_warn").html('Phone number is required');
                $("#phone_no").focus();
                return false;
            }else if(jQuery.trim($("#email").val()) == ''){
                $("#email_warn").html('Email address is required');
                $("#email").focus();
                return false;
            }else if(jQuery.trim($("#conf_password").val()) != jQuery.trim($("#password").val()) && (jQuery.trim($("#userMail").val().length) == '')){
                $("#conf_password_warn").html('passwords did not match');
                $("#conf_password").focus();
                return false;
            }else if(jQuery.trim($("#sales_price").val()) == ''){
                $("#sales_price_warn").html('Sales Price is required');
                $("#sales_price").focus();
                return false;
            }else if(jQuery.trim($("#reserv_price").val()) == ''){

                $("#reserv_price_warn").html('RESV Fee is required');
                $("#reserv_price").focus();
                return false;
            }else if(document.getElementById("office_source").checked == false && document.getElementById("event_source").checked == false){
                $("#reserv_source_warn").html('Reservation Source is required');
                $("#reserv_source_warn").focus();
                return false;
            }else{
                $("#ReservationForm").submit();
                return true;
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

<script type="text/javascript">
    function SaveReserveDetails()
    {
        var rsId = <?php echo $productDetails->row()->id; ?>;
        var rsfname = document.getElementById("first_name").value;
        var rslname = document.getElementById("last_name").value;
        var rsename = document.getElementById("entity_name").value;
        var rsreservtype = document.getElementById("resrv_type").value;
        var rsaddress = document.getElementById("address").value;
        var rscountry = document.getElementById("country").value;
        var rsstate = document.getElementById("state").value;
        var rscity = document.getElementById("city").value;
        var rszip = document.getElementById("postal_code").value;
        var rsphno = document.getElementById("phone_no").value;
        var rsphno1 = document.getElementById("phone_no1").value;
        var rsmail = document.getElementById("email").value;
        var rsmail1 = document.getElementById("email1").value;
        var rsreservprice = document.getElementById("reserv_price").value;
        var rsnote = document.getElementById("note").value;

        var rscashpt = document.getElementById("cash_payment").checked;
        var rscheckpt = document.getElementById("check_payment").checked;
        var rscreditpt = document.getElementById("credit_payment").checked;
//var rsdotpt = document.getElementById("dot_payment").checked;
        var rsslcash = document.getElementById("sales_cash").checked;
        var rsslcf = document.getElementById("sales_cf").checked;
//var rsslcs = document.getElementById("sales_cs").checked;
        var rsslsdira = document.getElementById("sales_sdira").checked;
        var rsslfs = document.getElementById("sales_fs").checked;
        var rsslsl = document.getElementById("sales_sl").checked;

        var custname = document.getElementById("cust_name").value;
        var accno = document.getElementById("account_no").value;
        var offisource = document.getElementById("office_source").checked;
        var evensource = document.getElementById("event_source").checked;
        $.ajax(
            {
                type: 'POST',
                url: baseURL+'site/product/ajaxreservedetailssave',
                data:{"fname": rsfname,'lname': rslname,"ename": rsename,'reservtype': rsreservtype,"address": rsaddress,'country': rscountry,"state": rsstate,'city': rscity,"zip": rszip,'phno': rsphno,"phno1": rsphno1,'email': rsmail,"email1": rsmail1,'reservprice': rsreservprice, "note": rsnote, "propertyId": rsId,'cashpt': rscashpt,"checkpt": rscheckpt,'creditpt': rscreditpt,'salescash': rsslcash, "salescf": rsslcf, "salessdira": rsslsdira, "salesfs": rsslfs,"salessl": rsslsl, "cu_name": custname, "acc_no": accno, "off_source": offisource, "eve_source": evensource},
                success: function(data)
                {
                    //alert(data);return false;
                    location.href = baseURL + 'listing/viewall';
                    //window.location.reload();
                }

            });
    }
</script>

<script type="text/javascript">
    function select_sdira()
    {
        //var cas_sd = document.getElementById("sales_cs").checked;
        var sd = document.getElementById("sales_sdira").checked;
        var fin_sd = document.getElementById("sales_fs").checked;
        var sd_llc = document.getElementById("sales_sl").checked;
        var sd_llc_fs = document.getElementById("sales_sl_fs").checked;

        if(sd == true || fin_sd == true || sd_llc == true || sd_llc_fs == true)
        {
            //$('#cust_name_field').show();
            //$('#account_no_field').show();
            $('#cust_name_field').css('display', 'flex' );
            $('#account_no_field').css('display', 'flex');

        }
        else
        {
            $('#cust_name_field').hide();
            $('#account_no_field').hide();

        }

    }

    function adjustment_function()
    {
        var chkd = document.getElementById("CheckBox_adjustment").checked;

        if(chkd == true)
        {
            $('#adjustment_div').css('display', 'block');
        }
        else
        {
            $('#adjustment_div').css('display', 'none');
        }

    }
    function adjustprice(){
        $('#netErr').html('');
        var salePrice = $('#sales_price').val();
        var adjPrice = $('#adjustment').val();

        if(parseFloat(adjPrice)>0){
            if(parseFloat(salePrice) > parseFloat(adjPrice)){
                var newPrice = parseFloat(salePrice) - parseFloat(adjPrice);
                var NwPric = Number(newPrice).toFixed(parseInt(2));

                if($.isNumeric(NwPric)==true){
                    $('#net_purchase_price').val(NwPric);
                }
            }else{
                $('#netErr').html('<font style="color:#FF0000;">Please Enter Adjustment Price smaller than Sales Price. </font>');
                $('#net_purchase_price').val(0);
                return false;
            }
        }


    }
    function changetoReserved(id){
        var prid = $('#property_id').val();

    }
</script>


</div>
<?php $this->load->view('site/templates/new_footer'); ?>
