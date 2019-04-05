<script src="js/jquery.colorbox.js"></script>

<script>
    $(document).ready(function () {

        $(".cboxClose1").click(function () {
            $("#cboxOverlay,#colorbox").hide();
        });

        $(".popup_dragndrop1").colorbox({width: "1000px", height: "500px", returnFocus: true, href: baseURL + "crmadmin/product/popup_drag/loi/<?php echo $buyer_info->row()->id . '/' . $uri6; ?>"});
        $(".popup_dragndrop2").colorbox({width: "1000px", height: "500px", returnFocus: true, href: baseURL + "crmadmin/product/popup_drag/articles/<?php echo $buyer_info->row()->id . '/' . $uri6; ?>"});
        $(".popup_dragndrop3").colorbox({width: "1000px", height: "500px", returnFocus: true, href: baseURL + "crmadmin/product/popup_drag/pa/<?php echo $buyer_info->row()->id . '/' . $uri6; ?>"});
        $(".popup_dragndrop4").colorbox({width: "1000px", height: "500px", href: baseURL + "crmadmin/product/popup_drag/loan/<?php echo $buyer_info->row()->id . '/' . $uri6; ?>"});
        $(".popup_dragndrop5").colorbox({width: "1000px", height: "500px", href: baseURL + "crmadmin/product/popup_drag/fedex/<?php echo $buyer_info->row()->id . '/' . $uri6; ?>"});
        $(".popup_dragndrop6").colorbox({width: "1000px", height: "500px", href: baseURL + "crmadmin/product/popup_drag/doi/<?php echo $buyer_info->row()->id . '/' . $uri6; ?>"});
        $(".popup_dragndrop7").colorbox({width: "1000px", height: "500px", href: baseURL + "crmadmin/product/popup_drag/ror_iv/<?php echo $buyer_info->row()->id . '/' . $uri6; ?>"});
        $(".popup_dragndrop8").colorbox({width: "1000px", height: "500px", href: baseURL + "crmadmin/product/popup_drag/gen_iv/<?php echo $buyer_info->row()->id . '/' . $uri6; ?>"});
        $(".popup_dragndrop9").colorbox({width: "1000px", height: "500px", href: baseURL + "crmadmin/product/popup_drag/closed/<?php echo $buyer_info->row()->id . '/' . $uri6; ?>"});
        $(".gen-invoice-popup").colorbox({width: "1000px", height: "500px", inline: true, href: "#gen-invoice"});
        $(".gen-invoice-popup").colorbox({width: "1000px", height: "500px", inline: true, href: "#ror-invoice"});

        //Example of preserving a JavaScript event for inline calls.
        $("#onLoad").click(function () {
            $('#onLoad').css({"background-color": "#f00", "color": "#fff", "cursor": "inherit"}).text("Open this window again and this message will still be here.");
            return false;
        });
    });
</script>
<script>
    //$(document).ready(function(){$.fn.colorbox({inline:true, open:true, href:"#timetogo"});});
</script>
<div id="timetogo">
    <?php
    $details = $buyer_info->row();
    $mons = array(1 => "January", 2 => "February", 3 => "March", 4 => "April", 5 => "May", 6 => "June", 7 => "July", 8 => "August", 9 => "September", 10 => "October", 11 => "November", 12 => "December");

    $imgArr = array('png', 'jpg', 'JPG', 'jpeg', 'bmp', 'gif', 'JPEG', 'PNG');
    $docArr = array('doc', 'docx', 'docs');
    $ExcelArr = array('xls', 'xlsx');
    ?>

    <?php if ($display == 'general') { ?>

        <div id='inline_general' style='background:#fff;' class="pop_up_style">

            <div class="popup_page">  
                <div class="popup_header">General- <span> <?php echo stripslashes($details->prop_address); ?></span> </div>   
            </div>
            <form name="general_popup" method="post" id="general_popup_form" action="crmadmin/product/general_popup_save_options">
                <table class="popup_table" align="center" border="0" bordercolor="#333" cellpadding="1" cellspacing="1" width="50%" style="float:left; margin-top:20px;">
                    <tr>
                        <td class="tab_title">Buyer First Name</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="first_name" value="<?php echo $details->first_name; ?>"  /></td>
                    </tr>
                    <tr>
                        <td class="tab_title">Buyer Last Name</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="last_name" value="<?php echo $details->last_name; ?>" /></td>
                    </tr>
                 <!--  <tr>
                        <td class="tab_title">Buyer 2 First Name</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="first_name1" value="<?php echo $details->first_name; ?>"></td>
                    </tr>
                    <tr>
                        <td class="tab_title">Buyer 2 Last Name</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="last_name1" value="<?php echo $details->last_name; ?>"></td>
                    </tr>-->
                    <tr>
                        <td class="tab_title">Buyer Entity Name</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="entity_name" value="<?php echo $details->entity_name; ?>" /></td>
                    </tr>
                    <tr>
                        <td class="tab_title">Buyer Entity Type</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt">
                            <select class="select_scroll" name="resrv_type" id="resrv_type" >
                                <option value="INDIVIDUAL" <?php if ($details->resrv_type == 'INDIVIDUAL') echo 'selected="selected"'; ?>>INDIVIDUAL</option>
                                <option value="Corp" <?php if ($details->resrv_type == 'Corp') echo 'selected="selected"'; ?>>Corp</option>
                                <option value="LLC" <?php if ($details->resrv_type == 'LLC') echo 'selected="selected"'; ?>>LLC</option>
                                <option value="Trust" <?php if ($details->resrv_type == 'Trust') echo 'selected="selected"'; ?>>Trust</option>
                                <option value="Partnership" <?php if ($details->resrv_type == 'Partnership') echo 'selected="selected"'; ?>>Partnership</option>
                                <option value="IRA" <?php if ($details->resrv_type == 'IRA') echo 'selected="selected"'; ?>>IRA</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td class="tab_title">Buyer Address</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="address" value="<?php echo $details->address; ?>" /></td>
                    </tr>
                    <tr>
                        <td class="tab_title">Buyer City</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="city" value="<?php echo $details->city; ?>" /></td>
                    </tr>
                    <tr>
                        <td class="tab_title">Buyer State</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt">
                            <input type="text" name="state" value="<?php echo $details->state; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="tab_title">Buyer Zip Code</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="postal_code" value="<?php echo $details->postal_code; ?>" /></td>
                    </tr>
                    <tr>
                        <td class="tab_title">Buyer Phone 1</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="phone_no" value="<?php echo $details->phone_no; ?>" /></td>
                    </tr>
                    <tr>
                        <td class="tab_title">Buyer Phone 2</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="phone_no1" value="<?php if ($details->phone_no1 != 0)
        echo $details->phone_no1;
    else
        echo '';
    ?>" /></td>
                    </tr>
                    <tr>
                        <td class="tab_title">Buyer Email 1</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="email" value="<?php echo $details->email; ?>" /></td>
                    </tr>
                    <tr>
                        <td class="tab_title">Buyer Email 2</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="email1" value="<?php echo $details->email1; ?>" /></td>
                    </tr>

                    <tr>
                        <td class="tab_title"><font color="#2DA42B"><b>Sourcer Information</b></font></td>
                        <td class="tab_mid"></td>
                        <td class="tab_txt"></td>
                    </tr>


                    <tr>
                        <td class="tab_title">Sourcer First Name</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="s_firstname" value="<?php echo $details->s_firstname; ?>" /></td>
                    </tr>

                    <tr>
                        <td class="tab_title">Sourcer Last Name</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="s_lastname" value="<?php echo $details->s_lastname; ?>" /></td>
                    </tr>

                    <tr>
                        <td class="tab_title">Sourcer Company Name</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="s_companyname" value="<?php echo $details->s_companyname; ?>" /></td>
                    </tr>

                    <tr>
                        <td class="tab_title">Sourcer Address</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="s_address" value="<?php echo $details->s_address; ?>" /></td>
                    </tr>

                    <tr>
                        <td class="tab_title">Sourcer City</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="s_city" value="<?php echo $details->s_city; ?>" /></td>
                    </tr>

                    <tr>
                        <td class="tab_title">Sourcer State</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="s_state" value="<?php echo $details->s_state; ?>" /></td>
                    </tr>

                    <tr>
                        <td class="tab_title">Sourcer Zipcode</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="s_zipcode" value="<?php echo $details->s_zipcode; ?>" /></td>
                    </tr>

                    <tr>
                        <td class="tab_title">Buyer Purchase Price</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="sales_price" value="<?php echo $details->sales_price; ?>" /></td>
                    </tr>
    <?php if ($details->adjustment != '') { ?>
                        <tr>
                            <td class="tab_title">Adjustment</td>
                            <td class="tab_mid">:</td>
                            <td class="tab_txt"><input type="text" name="adjustment" value="<?php echo $details->adjustment; ?>" /></td>
                        </tr>
                        <tr>
                            <td class="tab_title">Net Purchse Price</td>
                            <td class="tab_mid">:</td>
                            <td class="tab_txt"><input type="text" name="net_purchase_price" value="<?php echo $details->net_purchase_price; ?>" /></td>
                        </tr>

    <?php } ?>
                    <tr>
                        <td class="tab_title">Reservation Fees</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="reserv_price" value="<?php echo $details->reserv_price; ?>" /></td>
                    </tr>

                    <tr>
                        <td class="tab_title">In Form of</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt1">
                            <input type="checkbox" name="cash_payment" value="Cash" <?php if ($details->cash_payment != '') echo 'checked="checked"'; ?> />Cash
                            <input type="checkbox" name="check_payment" value="Check" <?php if ($details->check_payment != '') echo 'checked="checked"'; ?> />Check
                            <input type="checkbox" name="credit_payment" value="Credit Card" <?php if ($details->credit_payment != '') echo 'checked="checked"'; ?> />Credit Card
                            <!--<input type="checkbox" name="dot_payment" value="DOI" <?php if ($details->dot_payment != '') echo 'checked="checked"'; ?> />DOI-->
                        </td>
                    </tr>
                    <tr>
                        <td class="tab_title">Sales Type</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt1">
                            <input type="checkbox" name="sales_cash" value="Cash Purchase" <?php if ($details->sales_cash != '') echo 'checked="checked"'; ?> />Cash Purchase
                            <input type="checkbox" name="sales_cf" value="Cash And Finance" <?php if ($details->sales_cf != '') echo 'checked="checked"'; ?> />Cash + Finance<br />
                            <input type="checkbox" name="sales_sdira" value="SDIRA" <?php if ($details->sales_sdira != '') echo 'checked="checked"'; ?> />SDIRA
                            <input type="checkbox" name="sales_fs" value="FINANCE And SDIRA" <?php if ($details->sales_fs != '') echo 'checked="checked"'; ?> />Finance + SDIRA<br />
                            <input type="checkbox" name="sales_sl" value="SDIRA LLC" <?php if ($details->sales_sl != '') echo 'checked="checked"'; ?> />SDIRA LLC                       </td>
                    </tr>
                    <tr>
                        <td class="tab_title">Reservation Source</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt1">
                            <input type="radio" name="res_source" value="office"<?php if ($details->res_source == 'office') echo 'checked="checked"'; ?> />Office
                            <input type="radio" name="res_source" value="event" <?php if ($details->res_source == 'event') echo 'checked="checked"'; ?> />Event
                        </td>
                    </tr>

    <?php if ($details->sales_fs != '' || $details->sales_sl != '' || $details->sales_sdira != '') { ?>
                        <tr>
                            <td class="tab_title">Custodian Name</td>
                            <td class="tab_mid">:</td>
                            <td class="tab_txt"><input type="text" name="cust_name" value="<?php echo $details->cust_name; ?>" /></td>
                        </tr>
                        <tr>
                            <td class="tab_title">Account Number</td>
                            <td class="tab_mid">:</td>
                            <td class="tab_txt"><input type="text" name="account_no" value="<?php echo $details->account_no; ?>" /></td>
                        </tr>
    <?php } ?>
                    <tr>
                        <td class="tab_title">Code</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><select name="res_code">
                                <?php foreach ($resCode->result() as $code) { ?>
                                    <option value=<?php
                                            echo '"' . $code->attribute_name . '"';
                                            if ($details->res_code == $code->attribute_name) {
                                                echo 'selected="selected"';
                                            } echo '>' . $code->attribute_name;
                                            ?></option>
    <?php } ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td class="tab_title"><font color="#2DA42B"><b>Property Management Fields</b></font></td>
                        <td class="tab_mid"></td>
                        <td class="tab_txt"></td>
                    </tr>

                    <tr>
                        <td class="tab_title">Property Manager Name</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="p_manager_name" value="<?php echo $details->p_manager_name; ?>" /></td>
                    </tr>

                    <tr>
                        <td class="tab_title">Property Manager Address</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="p_manager_address" value="<?php echo $details->p_manager_address; ?>" /></td>
                    </tr>

                    <tr>
                        <td class="tab_title">Property Manager City</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="p_manager_city" value="<?php echo $details->p_manager_city; ?>" /></td>
                    </tr>

                    <tr>
                        <td class="tab_title">Property Manager State</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="p_manager_state" value="<?php echo $details->p_manager_state; ?>" /></td>
                    </tr>

                    <tr>
                        <td class="tab_title">Property Manager Zipcode</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="p_manager_zipcode" value="<?php echo $details->p_manager_zipcode; ?>" /></td>
                    </tr>

                    <tr>
                        <td class="tab_title">Property Manager Contact1</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="p_manager_contact1" value="<?php echo $details->p_manager_contact1; ?>" /></td>
                    </tr>

                    <tr>
                        <td class="tab_title">Property Manager Contact2</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="p_manager_contact2" value="<?php echo $details->p_manager_contact2; ?>" /></td>
                    </tr>

                    <tr>
                        <td class="tab_title">Property Manager Phone1</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="p_manager_phone1" value="<?php echo $details->p_manager_phone1; ?>" /></td>
                    </tr>

                    <tr>
                        <td class="tab_title">Property Manager Phone2</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="p_manager_phone2" value="<?php echo $details->p_manager_phone2; ?>" /></td>
                    </tr>

                    <tr>
                        <td class="tab_title">Property Manager email</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="p_manager_email" value="<?php echo $details->p_manager_email; ?>" /></td>
                    </tr>

                    <tr>
                        <td class="tab_title">Property Manager Fax</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="p_manager_fax" value="<?php echo $details->p_manager_fax; ?>" /></td>
                    </tr>

                    <tr>
                        <td class="tab_title">Property Tenant Name</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="p_tenant_name" value="<?php echo $details->p_tenant_name; ?>" /></td>
                    </tr>

                    <tr>
                        <td class="tab_title">Property Lease Term</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="p_lease_term" value="<?php echo $details->p_lease_term; ?>" /></td>
                    </tr>


                    <tr>
                        <td class="tab_title">Property Section 8</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="p_section_8" value="<?php echo $details->p_section_8; ?>" /></td>
                    </tr>

                    <tr>
                        <td class="tab_title">Property Manager Fee (%)</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="p_manager_fee" value="<?php echo $details->p_manager_fee; ?>" /></td>
                    </tr>



                    <tr>
                        <td class="tab_title">Notes</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="note" value="<?php echo $details->note; ?>" /></td>
                    </tr>
                    <tr>
                        <td class="tab_title">Sale Date</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><?php echo date('Y-m-d', strtotime($details->dateAdded)); ?></td>
                    </tr>
                    <tr>
                        <td class="tab_title">Sold Admin Name</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><?php echo $details->sold_admin_name; ?></td>
                    </tr>
                    <tr>
                        <td class="tab_title">Property Management Info</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="prop_mgmt_info" value="<?php echo $details->prop_mgmt_info; ?>" /></td>
                    </tr>

                    <tr>
                        <td class="tab_title">Source Info</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="source_info" value="<?php echo $details->source_info; ?>" /></td>
                    </tr>
                    <tr>
                        <td class="tab_title"><font color="#2DA42B"><b>Pricing Information</b></font></td>
                        <td class="tab_mid"></td>
                        <td class="tab_txt"></td>
                    </tr>

                    <tr>
                        <td class="tab_title">Monthly Rental ($)</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="pr_monthly_rent" value="<?php echo $details->pr_monthly_rent; ?>" /></td>
                    </tr>
                    <tr>
                        <td class="tab_title">Annual Rental ($)</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="pr_annual_rent" value="<?php echo $details->pr_annual_rent; ?>" /></td>
                    </tr>
                    <tr>
                        <td class="tab_title">Estimated Annual hazard insurance ($)</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="pr_hazard_ins" value="<?php echo $details->pr_hazard_ins; ?>" /></td>
                    </tr>
                    <tr>
                        <td class="tab_title">Estimated property tax ($)</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="pr_property_tax" value="<?php echo $details->pr_property_tax; ?>" /></td>
                    </tr>
                    <tr>
                        <td class="tab_title">Property management exp ($)</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="pr_mgmt_expense" value="<?php echo $details->pr_mgmt_expense; ?>" /></td>
                    </tr>
                    <tr>
                        <td class="tab_title">Annual Utilities Exp ($)</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="pr_utilities" value="<?php echo $details->pr_utilities; ?>" /></td>
                    </tr>
                    <tr>
                        <td class="tab_title">Estimated net income ($)</td>
                        <td class="tab_mid">:</td>
                        <td class="tab_txt"><input type="text" name="pr_net_income" value="<?php echo $details->pr_net_income; ?>" /></td>
                    </tr>

                </table>
                <input type="hidden" name="reserd_id" value="<?php echo $details->id; ?>" />
            </form>
            <div class="popup_field" style="width:95%; color:#FF0000; font-size:14px; margin-top:10px;" id="generalNote"></div>
            <div class="popup_field" style="margin:5px 0 0 10px; width:95%">
                <span>NOTES</span>
                <input type="text" id="notes" class="popup_txt" style="width:250px;" placeholder="Click here to add text" />
                <input type="hidden" id="reserd_id" value="<?php echo $details->id; ?>" />
                <input type="submit" value="Submit" onclick="submit_values('general')" class="popup_btn" style=" width:82px; height:29px !important;" />

            </div>   

            <div class="popup_bottom">
                <div class="popup_bottom_left">
                    <div class="popup_txt_1" style="margin:0 0 0 10px; height:120px; width:95%;" id="showGeneral">
                        <?php
                        foreach ($admin_notes->result() as $row) {
                            if ($row->general != '') {
                                echo '<span><p style="color:#F00; float:left; margin-right:3px;">' . $row->added . ' - </p>' . $row->general . ' - <b>' . $row->admin_name . '</b> </span> ';
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="clear"></div>    
                <div class="popup_bottom_right">

                    <input type="submit" value="Save & Close" onclick="general_save()" class="popup_btn" style="margin:15px 0 0 10px" />

                </div>

            </div>

        </div>

<?php } if ($display == 'loi') { ?>

        <div id='inline_loi' style='background:#fff;' class="pop_up_style">

            <div class="popup_page">  
                <div class="popup_header">LOI - <span><?php echo stripslashes($details->prop_address); ?></span></div>   
                <span class="popup_sub_txt">Choose Files to Upload</span>
                <div class="popup_top_right">
                    <div class="popup_dragndrop1"><button class="popup_btn">Upload File </button></div>
                    <span class="popup_note">Note : To Upload multiple files, hold 'Control' button while choosing files</span>
                </div>
                <div class="clear"></div>
                <?php
                foreach ($popup_img->result() as $imgs) {
                    if ($imgs->loi != '') {

                        $imgName = $imgs->loi;
                        $imgNameExt = @explode('.', $imgName);

                        if (in_array($imgNameExt[1], $imgArr) == 1) {
                            ?>
                            <div class="full_viewuse">
                                <img src="./images/crm-popup-images/<?php echo $imgName; ?>" width="105px" height="105px" />
                                <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                            </div> 
                        <?php } elseif (in_array($imgNameExt[1], $docArr) == 1) { ?>
                            <div class="full_viewuse">
                                <img src="./images/doc-img.png" width="105px" height="105px" />
                                <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                            </div> 
                        <?php } elseif (in_array($imgNameExt[1], $ExcelArr) == 1) { ?>
                            <div class="full_viewuse">
                                <img src="./images/excel-img.png" width="105px" height="105px" />
                                <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                            </div> 
                        <?php } elseif ($imgNameExt[1] == 'pdf') { ?>
                            <div class="full_viewuse">
                                <img src="./images/pdf-img.png" width="105px" height="105px" />
                                <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                            </div> 
                        <?php } elseif ($imgNameExt[1] == 'txt') { ?>
                            <div class="full_viewuse">
                                <img src="./images/txt-img.png" width="105px" height="105px" />
                                <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                            </div> 
            <?php } elseif ($imgNameExt[1] == 'html') { ?>
                            <div class="full_viewuse">
                                <img src="./images/html-img.png" width="105px" height="105px" />
                                <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                            </div>    

                            <?php
                            }
                        }
                    }
                    ?>
                <div class="popup_middle">
                    <span style="width:42%;">"Must Have" Information</span>

                    <?php if ($details->sales_cash != '' || $details->sales_cf != '' || $details->sales_sl != '' || $details->sales_sl_fs != '') { ?>

                        <div class="popup_field">
                            <label>Entity Name</label> 

                            <input type="text" name="entity_name" id="entityNm" class="popup_txt" value="<?php if ($admin_status->row()->entity_name != '') echo $admin_status->row()->entity_name; ?>" />
                        </div>

    <?php } if ($details->sales_sl != '' || $details->sales_fs != '' || $details->sales_sdira != '' || $details->sales_sl_fs != '') { ?>

                        <div class="popup_field">
                            <label>Custodian Name</label> 

                            <input type="text" name="custodian_name" id="custodian_name" class="popup_txt" value="<?php if ($admin_status->row()->custodian_name != '') echo $admin_status->row()->custodian_name; ?>" />
                        </div>
                        <div class="popup_field">
                            <label>Account Type</label> 

                            <input type="text" name="account_type" id="account_type" class="popup_txt" value="<?php if ($admin_status->row()->account_type != '') echo $admin_status->row()->account_type; ?>" />
                        </div>
                        <div class="popup_field">
                            <label>Account Number</label> 

                            <input type="text" name="account_no" id="account_no" class="popup_txt" value="<?php if ($admin_status->row()->account_no != '') echo $admin_status->row()->account_no; ?>" />
                        </div>

    <?php } ?>

                    <div class="popup_field" style="width:95%; color:#FF0000; font-size:14px; margin:60px 0 0 10px;" id="generalNote"></div>
                    <div class="popup_field" style="margin-top:10px; width:95%">
                        <span >NOTES</span>
                        <input type="text" id="notes" class="popup_txt" style="width:237px;" placeholder="Click here to add text" />
                        <input type="hidden" id="reserd_id" value="<?php echo $details->id; ?>" />
                        <input type="submit" value="Submit" onclick="submit_values('loi')" class="popup_btn" style=" width:82px; height:29px !important;"  />
                    </div>           
                    <div class="popup_bottom">
                        <div class="popup_bottom_left">
                            <div class="popup_txt_1" style="margin:0 0 0 10px; height:120px; width:95%;" id="showGeneral">
    <?php
    foreach ($admin_notes->result() as $row) {
        if ($row->loi != '') {
            echo '<span><p style="color:#F00; float:left; margin-right:3px;">' . $row->added . ' - </p>' . $row->loi . ' - <b>' . $row->admin_name . '</b> </span> ';
        }
    }
    ?>
                            </div>
                        </div>

                        <div class="clear"></div>
                        <div class="popup_bottom_right" style="width:70%;">
                            <span style="text-align:center;  margin:10px 0 0 0px;">STATUS</span>

                            <select style="margin: 6px 0 12px 10px; padding:4px; width:281px; text-align:center" class="popup_txt" id="popup_status_loi">
                                <option value="new" <?php if ($admin_status->row()->loi_status == 'new') echo 'selected="selected"'; ?>>NEW</option>
                                <option value="processing" <?php if ($admin_status->row()->loi_status == 'processing') echo 'selected="selected"'; ?>>PENDING</option>
                                <option value="complete" <?php if ($admin_status->row()->loi_status == 'complete') echo 'selected="selected"'; ?>>COMPLETED</option>
                            </select>

                            <input type="hidden" name="popup_id" id="popup_id_loi" value="<?php echo $admin_status->row()->id; ?>"/>

                            <input type="hidden" value="<?php echo $details->id; ?>" id="rsd_id_loi" />

                            <input type="submit" value="Save & Close" <?php if ($details->sales_sl != '' || $details->sales_sl_fs != '' || $details->sales_fs != '' || $details->sales_sdira != '')
                                   echo 'onclick="loi_save()"';
                               if ($details->sales_cash != '' || $details->sales_cf != '')
                                   echo 'onclick="cash_loi_save()"';
                               ?> class="popup_btn" style=" margin: 0 0 0 116px;" />

                        </div>
                    </div>     
                </div>
            </div>

        </div>

<?php } if ($display == 'articles') { ?>

        <div id='inline_ein' style='background:#fff;' class="pop_up_style">

            <div class="popup_page">  
                <div class="popup_header">Articles / EIN - <span> <?php echo stripslashes($details->prop_address); ?></span></div>   
                <span class="popup_sub_txt">Choose Files to Upload</span>
                <div class="popup_top_right">
                    <div class="popup_dragndrop2"><button class="popup_btn">Upload File </button></div>
                    <span class="popup_note">Note : To Upload multiple files, hold 'Control' button while choosing files</span>
                </div>
                <div class="clear"></div>
                <div class="popup_middle">
                    <div class="clear"></div>
    <?php
    foreach ($popup_img->result() as $imgs) {
        if ($imgs->articles != '') {

            $imgName = $imgs->articles;
            $imgNameExt = @explode('.', $imgName);

            if (in_array($imgNameExt[1], $imgArr) == 1) {
                ?>
                                <div class="full_viewuse">
                                    <img src="./images/crm-popup-images/<?php echo $imgName; ?>" width="105px" height="105px" />
                                    <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                    <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                    <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                                </div> 
            <?php } elseif (in_array($imgNameExt[1], $docArr) == 1) { ?>
                                <div class="full_viewuse">
                                    <img src="./images/doc-img.png" width="105px" height="105px" />
                                    <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                    <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                    <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                                </div> 
            <?php } elseif (in_array($imgNameExt[1], $ExcelArr) == 1) { ?>
                                <div class="full_viewuse">
                                    <img src="./images/excel-img.png" width="105px" height="105px" />
                                    <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                    <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                    <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                                </div> 
            <?php } elseif ($imgNameExt[1] == 'pdf') { ?>
                                <div class="full_viewuse">
                                    <img src="./images/pdf-img.png" width="105px" height="105px" />
                                    <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                    <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                    <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                                </div> 
            <?php } elseif ($imgNameExt[1] == 'txt') { ?>
                                <div class="full_viewuse">
                                    <img src="./images/txt-img.png" width="105px" height="105px" />
                                    <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                    <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                    <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                                </div>
            <?php } elseif ($imgNameExt[1] == 'html') { ?>
                                <div class="full_viewuse">
                                    <img src="./images/html-img.png" width="105px" height="105px" />
                                    <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                    <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                    <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                                </div>      

            <?php } ?>

                            <!--<div class="full_viewuse">   
                            <img src="./images/crm-popup-images/<?php echo $imgs->articles; ?>" width="100px" height="100px" style=" float:left; width:100%;" />
                             <a href="./images/crm-popup-images/<?php echo $imgs->articles; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                            <a class="sub-btn" href='crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgs->articles; ?>' >Download</a>
                               </div>-->
        <?php }
    }
    ?>

                    <div style="float:left; width:100%; min-height:100px"></div>

                    <div class="popup_field" style="width:95%; color:#FF0000; font-size:14px; margin:85px 0 0 10px;" id="generalNote"></div>
                    <div class="popup_field" style="margin-top:10px; width:95%">
                        <span>NOTES</span>

                        <input type="text" id="notes" class="popup_txt" style="width:250px;" placeholder="Click here to add text" />
                        <input type="hidden" id="reserd_id" value="<?php echo $details->id; ?>" />
                        <input type="submit" value="Submit" onclick="submit_values('articles')" class="popup_btn" style=" height: 29px !important;
                               width: 82px;" />

                    </div>           
                    <div class="popup_bottom">
                        <div class="popup_bottom_left">
                            <div class="popup_txt_1" style="margin:0 0 0 10px; height:120px; width:95%;" id="showGeneral">
    <?php
    foreach ($admin_notes->result() as $row) {
        if ($row->articles != '') {
            echo '<span><p style="color:#F00; float:left; margin-right:3px;">' . $row->added . ' - </p>' . $row->articles . ' - <b>' . $row->admin_name . '</b> </span> ';
        }
    }
    ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="popup_bottom_right" style="width:75%; margin:8px 0 0 0px">
                            <span style="text-align:center; margin-left:5px">STATUS</span>

                            <select style="margin:0 0 20px 36px; padding:4px; width:305px; text-align:center" class="popup_txt" id="popup_status_articles">
                                <option value="new" <?php if ($admin_status->row()->articles_status == 'new') echo 'selected="selected"'; ?>>NEW</option>
                                <option value="processing" <?php if ($admin_status->row()->articles_status == 'processing') echo 'selected="selected"'; ?>>PENDING</option>
                                <option value="complete" <?php if ($admin_status->row()->articles_status == 'complete') echo 'selected="selected"'; ?>>COMPLETED</option>
                            </select>

                            <input type="hidden" name="popup_id" id="popup_id_articles" value="<?php echo $admin_status->row()->id; ?>"/>

                            <input type="hidden" value="<?php echo $details->id; ?>" id="rsd_id_articles" />

                            <input type="submit" value="Save & Close" onclick="articles_save()" class="popup_btn" style="margin:0 0 0 43px" />

                        </div>
                    </div>     
                </div>
            </div>

        </div>

                <?php } if ($display == 'pa') { ?>

        <div id='inline_pa' style='background:#fff;' class="pop_up_style">

            <div class="popup_page">  
                <div class="popup_header">Purchase Agreement - <span><?php echo stripslashes($details->prop_address); ?></span></div>   
                <span class="popup_sub_txt">Choose Files to Upload</span>
                <div class="popup_top_right">
                    <div class="popup_dragndrop3"><button class="popup_btn">Upload File </button></div>
                    <span class="popup_note">Note : To Upload multiple files, hold 'Control' button while choosing files</span>
                </div>
                <div class="popup_middle"> <div class="clear"></div>
    <?php
    foreach ($popup_img->result() as $imgs) {
        if ($imgs->pa != '') {

            $imgName = $imgs->pa;
            $imgNameExt = @explode('.', $imgName);

            if (in_array($imgNameExt[1], $imgArr) == 1) {
                ?>
                                <div class="full_viewuse">
                                    <img src="./images/crm-popup-images/<?php echo $imgName; ?>" width="105px" height="105px" />
                                    <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                    <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                    <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                                </div> 
                            <?php } elseif (in_array($imgNameExt[1], $docArr) == 1) { ?>
                                <div class="full_viewuse">
                                    <img src="./images/doc-img.png" width="105px" height="105px" />
                                    <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                    <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                    <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                                </div> 
                            <?php } elseif (in_array($imgNameExt[1], $ExcelArr) == 1) { ?>
                                <div class="full_viewuse">
                                    <img src="./images/excel-img.png" width="105px" height="105px" />
                                    <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                    <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                    <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                                </div> 
                            <?php } elseif ($imgNameExt[1] == 'pdf') { ?>
                                <div class="full_viewuse">
                                    <img src="./images/pdf-img.png" width="105px" height="105px" />
                                    <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                    <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                    <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                                </div> 
            <?php } elseif ($imgNameExt[1] == 'txt') { ?>
                                <div class="full_viewuse">
                                    <img src="./images/txt-img.png" width="105px" height="105px" />
                                    <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                    <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                    <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                                </div>
            <?php } elseif ($imgNameExt[1] == 'html') { ?>
                                <div class="full_viewuse">
                                    <img src="./images/html-img.png" width="105px" height="105px" />
                                    <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                    <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                    <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                                </div>        

            <?php
            }
        }
    }
    ?>
                    <div style="float:left; width:100%; min-height:100px"></div>
                    <a href="crmadmin/product/displayproducttemplate/<?php echo $details->id . '/' . $details->property_id . '/' . $details->user_id . '/pa/' . $uri6 . '/upload'; ?>"><button class="sub-btn">Add / Edit Purchase Agreement</button></a>




                    <div class="popup_field" style="width:95%; color:#FF0000; font-size:14px; margin:85px 0 0 10px;" id="generalNote"></div>
                    <div class="popup_field" style="margin-top:10px; width:95%">
                        <span>NOTES</span>

                        <input type="text" id="notes" class="popup_txt" style="width:250px;" placeholder="Click here to add text" />
                        <input type="hidden" id="reserd_id" value="<?php echo $details->id; ?>" />
                        <input type="submit" value="Submit" onclick="submit_values('pa')" class="popup_btn" style=" height: 29px !important;
                               width: 82px;"  />

                    </div>           
                    <div class="popup_bottom">
                        <div class="popup_bottom_left">
                            <div class="popup_txt_1" style="margin:0 0 0 10px; height:120px; width:95%;" id="showGeneral">
    <?php
    foreach ($admin_notes->result() as $row) {
        if ($row->pa != '') {
            echo '<span><p style="color:#F00; float:left; margin-right:3px;">' . $row->added . ' - </p>' . $row->pa . ' - <b>' . $row->admin_name . '</b> </span> ';
        }
    }
    ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="popup_bottom_right" style="width:75%;">
                            <span style="text-align:center; margin:8px 0 0 9px;">STATUS</span>

                            <select style="margin:6px 0 20px 36px; padding:4px; width:300px; text-align:center" class="popup_txt" id="popup_status_pa">
                                <option value="new" <?php if ($admin_status->row()->pa_status == 'new') echo 'selected="selected"'; ?>>NEW</option>
                                <option value="processing" <?php if ($admin_status->row()->pa_status == 'processing') echo 'selected="selected"'; ?>>PENDING</option>
                                <option value="complete" <?php if ($admin_status->row()->pa_status == 'complete') echo 'selected="selected"'; ?>>COMPLETED</option>
                            </select>

                            <input type="hidden" name="popup_id" id="popup_id_pa" value="<?php echo $admin_status->row()->id; ?>"/>

                            <input type="hidden" value="<?php echo $details->id; ?>" id="rsd_id_pa" />

                            <input type="submit" value="Save & Close" onclick="pa_save()" class="popup_btn" style="margin:0 0 0 43px" />

                        </div>
                    </div>     
                </div>
            </div>

        </div>

<?php } if ($display == 'llc') { ?>

        <div id='inline_llc' style='background:#fff;' class="pop_up_style">

            <div class="popup_page">  
                <div class="popup_header">LLC Account - <span> <?php echo stripslashes($details->prop_address); ?></span></div>   
                <div class="popup_middle">
                    <span style="text-align:center; width:100%">Make sure that the customer is setting up an LLC Bank Account</span>
                    <div style="float:left; width:100%; min-height:100px"></div>

                    <div class="popup_field" style="width:95%; color:#FF0000; font-size:14px; margin:170px 0 0 10px;" id="generalNote"></div>
                    <div class="popup_field" style="margin-top:10px; width:95%">
                        <span>NOTES</span>

                        <input type="text" id="notes" class="popup_txt" style="width:250px;" placeholder="Click here to add text"/>
                        <input type="hidden" id="reserd_id" value="<?php echo $details->id; ?>" />
                        <input type="submit" value="Submit" onclick="submit_values('llc')" class="popup_btn" style="height: 29px !important;
                               width: 82px;" />

                    </div>           
                    <div class="popup_bottom">
                        <div class="popup_bottom_left">
                            <div class="popup_txt_1" style="margin:0 0 0 10px; height:120px; width:95%;" id="showGeneral">
    <?php
    foreach ($admin_notes->result() as $row) {
        if ($row->llc != '') {
            echo '<span><p style="color:#F00; float:left; margin-right:3px;">' . $row->added . ' - </p>' . $row->llc . ' - <b>' . $row->admin_name . '</b> </span> ';
        }
    }
    ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="popup_bottom_right">
                            <input type="submit" value="Save & Close" class="popup_btn" style="margin:10px 0 0 10px" />
                        </div>
                    </div>     
                </div>
            </div>

        </div>

            <?php } if ($display == 'loan') { ?>

        <div id='inline_loan' style='background:#fff;' class="pop_up_style">

            <div class="popup_page">  
                <div class="popup_header">Loan Docs - <span><?php echo stripslashes($details->prop_address); ?></span></div>   
                <span class="popup_sub_txt">Choose Files to Upload</span>
                <div class="popup_top_right">
                    <div class="popup_dragndrop4"><button class="popup_btn">Upload File </button></div>
                    <span class="popup_note" >Note : To Upload multiple files, hold 'Control' button while choosing files</span>
                </div><div class="clear"></div>
    <?php
    foreach ($popup_img->result() as $imgs) {
        if ($imgs->loan != '') {

            $imgName = $imgs->loan;
            $imgNameExt = @explode('.', $imgName);

            if (in_array($imgNameExt[1], $imgArr) == 1) {
                ?>
                            <div class="full_viewuse">
                                <img src="./images/crm-popup-images/<?php echo $imgName; ?>" width="105px" height="105px" />
                                <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                            </div> 
            <?php } elseif (in_array($imgNameExt[1], $docArr) == 1) { ?>
                            <div class="full_viewuse">
                                <img src="./images/doc-img.png" width="105px" height="105px" />
                                <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                            </div> 
            <?php } elseif (in_array($imgNameExt[1], $ExcelArr) == 1) { ?>
                            <div class="full_viewuse">
                                <img src="./images/excel-img.png" width="105px" height="105px" />
                                <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                            </div> 
            <?php } elseif ($imgNameExt[1] == 'pdf') { ?>
                            <div class="full_viewuse">
                                <img src="./images/pdf-img.png" width="105px" height="105px" />
                                <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                            </div> 
            <?php } elseif ($imgNameExt[1] == 'txt') { ?>
                            <div class="full_viewuse">
                                <img src="./images/txt-img.png" width="105px" height="105px" />
                                <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                            </div> 
            <?php } elseif ($imgNameExt[1] == 'html') { ?>
                            <div class="full_viewuse">
                                <img src="./images/html-img.png" width="105px" height="105px" />
                                <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                            </div>     

            <?php } ?>


        <?php }
    }
    ?>
                <div class="popup_middle">

                    <span style="width:42%;">"Must Have" Information</span>

                    <div class="popup_field">
                        <label>Property Description</label> 

                        <input type="text" name="prop_desc_loan" id="prop_desc_loan" class="popup_txt" value="<?php if ($admin_status->row()->prop_desc_loan != '') echo $admin_status->row()->prop_desc_loan; ?>" />
                    </div>

                    <div class="popup_field">
                        <label>SBL / Tax ID No</label> 

                        <input type="text" name="sbl_tax_id_loan" id="sbl_tax_id_loan" class="popup_txt" value="<?php if ($admin_status->row()->sbl_tax_id_loan != '') echo $admin_status->row()->sbl_tax_id_loan; ?>" />
                    </div>

                    <span style="font-size:14px; font-weight:bold ; width:100%;">* Be sure these docs are Signed and Notorized by Custodian</span>
                    <a href="crmadmin/product/displayproducttemplate/<?php echo $details->id . '/' . $details->property_id . '/' . $details->user_id . '/loan/' . $uri6 . '/upload'; ?>"><button class="sub-btn">Add / Edit Loan Agreement</button></a>
                    <div class="popup_field" style="width:95%; color:#FF0000; font-size:14px; margin:150px 0 0 10px;" id="generalNote"></div>
                    <div class="popup_field" style="margin-top:10px; width:95%">
                        <span>NOTES</span>

                        <input type="text" id="notes" class="popup_txt" style="width:250px;" placeholder="Click here to add text" />
                        <input type="hidden" id="reserd_id" value="<?php echo $details->id; ?>" />
                        <input type="submit" value="Submit" onclick="submit_values('loan')" class="popup_btn"  style="height: 29px !important;
                               width: 82px;"/>

                    </div>           
                    <div class="popup_bottom">
                        <div class="popup_bottom_left">
                            <div class="popup_txt_1" style="margin:0 0 0 10px; height:120px; width:95%;" id="showGeneral">
    <?php
    foreach ($admin_notes->result() as $row) {
        if ($row->loan != '') {
            echo '<span><p style="color:#F00; float:left; margin-right:3px;">' . $row->added . ' - </p>' . $row->loan . ' - <b>' . $row->admin_name . '</b> </span> ';
        }
    }
    ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="popup_bottom_right" style="margin:5px 0 0 0px; width:75%;">
                            <span style="text-align:center;">STATUS</span>

                            <select style="margin:0 0 20px 36px; padding:4px; width:310px; text-align:center" class="popup_txt" id="popup_status_loan">
                                <option value="new" <?php if ($admin_status->row()->loan_status == 'new') echo 'selected="selected"'; ?>>NEW</option>
                                <option value="processing" <?php if ($admin_status->row()->loan_status == 'processing') echo 'selected="selected"'; ?>>PENDING</option>
                                <option value="complete" <?php if ($admin_status->row()->loan_status == 'complete') echo 'selected="selected"'; ?>>COMPLETED</option>
                            </select>

                            <input type="hidden" name="popup_id" id="popup_id_loan" value="<?php echo $admin_status->row()->id; ?>"/>

                            <input type="hidden" value="<?php echo $details->id; ?>" id="rsd_id_loan" />

                            <input type="submit" value="Save & Close" onclick="loan_save()" class="popup_btn" style="margin:0 0 0 86px" />

                        </div>
                    </div>     
                </div>
            </div>

        </div>

            <?php } if ($display == 'fedex') { ?>

        <div id='inline_fedex' style='background:#fff;' class="pop_up_style">

            <div class="popup_page">  
                <div class="popup_header">Fedex Labels - <span><?php echo stripslashes($details->prop_address); ?></span></div>   
                <span class="popup_sub_txt">Choose Files to Upload</span>
                <div class="popup_top_right">
                    <div class="popup_dragndrop5"><button class="popup_btn">Upload File </button></div>
                    <span class="popup_note">Note : To Upload multiple files, hold 'Control' button while choosing files</span>
                </div><div class="clear"></div>
    <?php
    foreach ($popup_img->result() as $imgs) {
        if ($imgs->fedex != '') {

            $imgName = $imgs->fedex;
            $imgNameExt = @explode('.', $imgName);

            if (in_array($imgNameExt[1], $imgArr) == 1) {
                ?>
                            <div class="full_viewuse">
                                <img src="./images/crm-popup-images/<?php echo $imgName; ?>" width="105px" height="105px" />
                                <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                            </div> 
            <?php } elseif (in_array($imgNameExt[1], $docArr) == 1) { ?>
                            <div class="full_viewuse">
                                <img src="./images/doc-img.png" width="105px" height="105px" />
                                <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                            </div> 
            <?php } elseif (in_array($imgNameExt[1], $ExcelArr) == 1) { ?>
                            <div class="full_viewuse">
                                <img src="./images/excel-img.png" width="105px" height="105px" />
                                <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                            </div> 
            <?php } elseif ($imgNameExt[1] == 'pdf') { ?>
                            <div class="full_viewuse">
                                <img src="./images/pdf-img.png" width="105px" height="105px" />
                                <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                            </div> 
                        <?php } elseif ($imgNameExt[1] == 'txt') { ?>
                            <div class="full_viewuse">
                                <img src="./images/txt-img.png" width="105px" height="105px" />
                                <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                            </div> 
            <?php } elseif ($imgNameExt[1] == 'html') { ?>
                            <div class="full_viewuse">
                                <img src="./images/html-img.png" width="105px" height="105px" />
                                <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                            </div>     

            <?php } ?>

                                    <?php }
                                }
                                ?>
                <div class="popup_middle">
                    <span style="font-size:14px; font-weight:bold ; width:100%;">* Upload customer to Closing Attorney Fedex Label, if Available</span>
                    <span style="font-size:14px; font-weight:bold;width:100%;">* Upload Attorney to RE cash Fedex Label, if Available</span>

                    <div class="popup_field" style="width:95%; color:#FF0000; font-size:14px; margin:140px 0 0 10px;" id="generalNote"></div>
                    <div class="popup_field" style="margin-top:10px; width:95%">
                        <span>NOTES</span>

                        <input type="text" id="notes" class="popup_txt" style="width:250px;" placeholder="Click here to add text"/>
                        <input type="hidden" id="reserd_id" value="<?php echo $details->id; ?>" />
                        <input type="submit" value="Submit" onclick="submit_values('fedex')" class="popup_btn" style="height: 29px !important;
                               width: 82px;" />

                    </div>           
                    <div class="popup_bottom">
                        <div class="popup_bottom_left">
                            <div class="popup_txt_1" style="margin:0 0 0 10px; height:120px; width:95%;" id="showGeneral">
    <?php
    foreach ($admin_notes->result() as $row) {
        if ($row->fedex != '') {
            echo '<span><p style="color:#F00; float:left; margin-right:3px;">' . $row->added . ' - </p>' . $row->fedex . ' - <b>' . $row->admin_name . '</b> </span> ';
        }
    }
    ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="popup_bottom_right">
                            <!--<span style="text-align:center;">STATUS</span>
                            <select style="margin:0 0 20px 36px; padding:4px; width:130px; text-align:center" class="popup_txt">
                                    <option>NEW</option>
                                <option>PENDING</option>
                                <option>COMPLETED</option>
                            </select>-->
                            <input type="submit" value="Save & Close" class="popup_btn" onclick="fedex_save()" style="margin:10px 0 0 10px" />
                        </div>
                    </div>     
                </div>
            </div>

        </div>

<?php } if ($display == 'doi') { ?>

        <div id='inline_doi' style='background:#fff;' class="pop_up_style">

            <div class="popup_page">  
                <div class="popup_header">DOI <?php if ($details->sales_fs != '' || $details->sales_sl_fs != '') echo '/ Reoccuring Bill Pay'; ?> - <span> <?php echo stripslashes($details->prop_address); ?></span></div>   
                <span class="popup_sub_txt">Choose Files to Upload</span>
                <div class="popup_top_right">
                    <div class="popup_dragndrop6"><button class="popup_btn">Upload File </button></div>
                    <span class="popup_note">Note : To Upload multiple files, hold 'Control' button while choosing files</span>
                </div> <div class="clear"></div>
    <?php
    foreach ($popup_img->result() as $imgs) {
        if ($imgs->doi != '') {

            $imgName = $imgs->doi;
            $imgNameExt = @explode('.', $imgName);

            if (in_array($imgNameExt[1], $imgArr) == 1) {
                ?>
                            <div class="full_viewuse">
                                <img src="./images/crm-popup-images/<?php echo $imgName; ?>" width="105px" height="105px" />
                                <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                            </div> 
                        <?php } elseif (in_array($imgNameExt[1], $docArr) == 1) { ?>
                            <div class="full_viewuse">
                                <img src="./images/doc-img.png" width="105px" height="105px" />
                                <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                            </div> 
                        <?php } elseif (in_array($imgNameExt[1], $ExcelArr) == 1) { ?>
                            <div class="full_viewuse">
                                <img src="./images/excel-img.png" width="105px" height="105px" />
                                <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                            </div> 
            <?php } elseif ($imgNameExt[1] == 'pdf') { ?>
                            <div class="full_viewuse">
                                <img src="./images/pdf-img.png" width="105px" height="105px" />
                                <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                            </div> 
                            <?php } elseif ($imgNameExt[1] == 'txt') { ?>
                            <div class="full_viewuse">
                                <img src="./images/txt-img.png" width="105px" height="105px" />
                                <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                            </div> 
            <?php } elseif ($imgNameExt[1] == 'html') { ?>
                            <div class="full_viewuse">
                                <img src="./images/html-img.png" width="105px" height="105px" />
                                <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                            </div>    

            <?php } ?>

        <?php }
    }
    ?>
                <div class="popup_middle">
                    <span style="font-size:14px; font-weight:bold ; width:100%;">* Upload DOI with Signature</span>
                                <?php if ($details->sales_fs != '' || $details->sales_sl_fs != '') { ?>
                        <span style="font-size:14px; font-weight:bold ;width:100%;">* Upload Reoccuring Bill Pay Form Complete</span>
                                <?php } ?>
                    <span style="font-size:14px; font-weight:bold ; width:100%;">Download Horizon Trust Documents</span>
                    <a href="./images/pdf/horizondoi.pdf" target="_blank"><button class="sub-btn">Editable DOI</button></a><a href="./images/pdf/reoccuring.pdf" target="_blank"><button class="sub-btn">Reoccuring Bill Pay</button></a>


                    <a href="crmadmin/product/displayproducttemplate/<?php echo $details->id . '/' . $details->property_id . '/' . $details->user_id . '/doi/' . $uri6 . '/upload'; ?>"><button class="sub-btn">Add / Edit DOI Agreement</button></a>
                    <div class="popup_field" style="width:95%; color:#FF0000; font-size:14px; margin:150px 0 0 10px;" id="generalNote"></div>
                    <div class="popup_field" style="margin-top:10px; width:95%">
                        <span>NOTES</span>

                        <input type="text" id="notes" class="popup_txt" style="width:250px;" placeholder="Click here to add text"/>
                        <input type="hidden" id="reserd_id" value="<?php echo $details->id; ?>" />
                        <input type="submit" value="Submit" onclick="submit_values('doi')" class="popup_btn"  style="height: 29px !important;
                               width: 82px;"/>

                    </div>           
                    <div class="popup_bottom">
                        <div class="popup_bottom_left">
                            <div class="popup_txt_1" style="margin:0 0 0 10px; height:120px; width:95%;" id="showGeneral">
    <?php
    foreach ($admin_notes->result() as $row) {
        if ($row->doi != '') {
            echo '<span><p style="color:#F00; float:left; margin-right:3px;">' . $row->added . ' - </p>' . $row->doi . ' - <b>' . $row->admin_name . '</b> </span> ';
        }
    }
    ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="popup_bottom_right" style=" width:75%; margin:5px 0 0 0px;">
                            <span style="text-align:center;">STATUS</span>

                            <select style="margin:0 0 20px 36px; padding:4px; width:310px; text-align:center" class="popup_txt" id="popup_status_doi">
                                <option value="new" <?php if ($admin_status->row()->doi_status == 'new') echo 'selected="selected"'; ?>>NEW</option>
                                <option value="processing" <?php if ($admin_status->row()->doi_status == 'processing') echo 'selected="selected"'; ?>>PENDING</option>
                                <option value="complete" <?php if ($admin_status->row()->doi_status == 'complete') echo 'selected="selected"'; ?>>COMPLETED</option>
                            </select>

                            <input type="hidden" name="popup_id" id="popup_id_doi" value="<?php echo $admin_status->row()->id; ?>"/>

                            <input type="hidden" value="<?php echo $details->id; ?>" id="rsd_id_doi" />

                            <input type="submit" value="Save & Close" onclick="doi_save()" class="popup_btn" style="margin:0 0 0 43px" />

                        </div>
                    </div>     
                </div>
            </div>

        </div>

<?php } if ($display == 'insurance') { ?>

        <div id='inline_insurance' style='background:#fff;' class="pop_up_style">

            <div class="popup_page">  
                <div class="popup_header">Insurance - <span> <?php echo stripslashes($details->prop_address); ?></span></div>               
                <div class="popup_middle">
                    <span style="font-size:18px; font-weight:bold; margin:50px 0 20px 60px; width:auto">Insurance Proposal Request</span>
                    <div class="popup_field" style="margin:0 0 15px;">
                        <label>Provider</label>
                        <input type="text" id="provider" class="popup_txt" value="<?php if ($admin_status->row()->ins_provider != '') echo $admin_status->row()->ins_provider; ?>" />
                    </div>
                    <div class="popup_field">
                        <label>Date Submitted</label>
                        <select class="popup_txt" style="padding:4px; width:80px;" id="ins_month">
                            <option>Month</option>
    <?php for ($i = 1; $i < 13; $i++) {
        ?>
                                <option value="<?php echo $i; ?>" <?php if ($admin_status->row()->ins_month == $i) echo 'selected="selected"'; ?>><?php echo $mons[$i]; ?></option>
    <?php } ?>

                        </select>
                        <select class="popup_txt" style="padding:4px; width:60px;" id="ins_day">
                            <option>Day</option>
    <?php for ($j = 1; $j < 32; $j++) {
        ?>
                                <option value="<?php echo $j; ?>" <?php if ($admin_status->row()->ins_day == $j) echo 'selected="selected"'; ?>><?php echo $j; ?></option>
    <?php } ?>
                        </select>
                        <select class="popup_txt" style="padding:4px; width:90px;" id="ins_year">
                            <option>Year</option>
    <?php for ($k = date('Y'); $k < (date('Y') + 25); $k++) {
        ?>
                                <option value="<?php echo $k; ?>" <?php if ($admin_status->row()->ins_year == $k) echo 'selected="selected"'; ?>><?php echo $k; ?></option>
                                <?php } ?>
                        </select>
                    </div>

                    <div class="popup_field" style="margin-top:10px;">                
                        <a href="http://www.formstack.com/forms/NREIG-affinity_proposal_Bethni_Moppin-v3" target="_blank">
                            http://www.formstack.com/forms/NREIG-affinity_proposal_Bethni_Moppin-v3
                        </a>
                    </div>

                    <div class="popup_field" style="width:95%; color:#FF0000; font-size:14px; margin:90px 0 0 10px;" id="generalNote"></div>
                    <div class="popup_field" style="margin-top:10px; width:95%">
                        <span>NOTES</span>

                        <input type="text" id="notes" class="popup_txt" style="width:250px;" placeholder="Click here to add text"/>
                        <input type="hidden" id="reserd_id" value="<?php echo $details->id; ?>" />
                        <input type="submit" value="Submit" onclick="submit_values('insurance')" class="popup_btn"  style="height: 29px !important;
                               width: 82px;"/>

                    </div>           
                    <div class="popup_bottom">
                        <div class="popup_bottom_left">
                            <div class="popup_txt_1" style="margin:0 0 0 10px; height:120px; width:95%;" id="showGeneral">
    <?php
    foreach ($admin_notes->result() as $row) {
        if ($row->insurance != '') {
            echo '<span><p style="color:#F00; float:left; margin-right:3px;">' . $row->added . ' - </p>' . $row->insurance . ' - <b>' . $row->admin_name . '</b> </span> ';
        }
    }
    ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="popup_bottom_right" style="width:75%; margin:6px 0 0px 0px">
                            <span style="text-align:center;">STATUS</span>

                            <select style="margin:0px 0 20px 36px; padding:4px; width:310px; text-align:center" class="popup_txt" id="popup_status_insurance">
                                <option value="new" <?php if ($admin_status->row()->insurance_status == 'new') echo 'selected="selected"'; ?>>NEW</option>
                                <option value="processing" <?php if ($admin_status->row()->insurance_status == 'processing') echo 'selected="selected"'; ?>>PENDING</option>
                                <option value="complete" <?php if ($admin_status->row()->insurance_status == 'complete') echo 'selected="selected"'; ?>>COMPLETED</option>
                            </select>

                            <input type="hidden" name="popup_id" id="popup_id_insurance" value="<?php echo $admin_status->row()->id; ?>"/>

                            <input type="hidden" value="<?php echo $details->id; ?>" id="rsd_id_insurance" />

                            <input type="submit" value="Save & Close" onclick="insurance_save()" class="popup_btn" style="margin:0 0 0 43px" />

                        </div>
                    </div>     
                </div>
            </div>

        </div>

                        <?php } if ($display == 'funded') { ?>

        <div id='inline_fund' style='background:#fff;' class="pop_up_style">

            <div class="popup_page">  
                <div class="popup_header">Funding - <span> <?php echo stripslashes($details->prop_address); ?> </span></div>               
                <div class="popup_middle">
                    <span style="font-size:18px; font-weight:bold; margin:30px 0 20px 5px; width:auto">Client Cash Funds</span>
                    <div class="popup_field" style="margin:0 0 15px;">
                        <label>Amount Expected $</label>

                        <input type="text" id="amount_exp" class="popup_txt" value="<?php if ($admin_status->row()->fun_amount_exp != '') echo number_format($admin_status->row()->fun_amount_exp); ?>" />
                    </div>
                    <div class="popup_field" style="margin:0 0 15px;">
                        <label>Amount Received $</label>

                        <input type="text" id="amount_rec" class="popup_txt" value="<?php if ($admin_status->row()->fun_amount_rec != '') echo number_format($admin_status->row()->fun_amount_rec); ?>" />
                    </div>
                    <div class="popup_field">
                        <label>Date Received</label>
                        <select class="popup_txt" style="padding:4px; width:80px;" id="fun_month">
                            <option>Month</option>
    <?php for ($i1 = 1; $i1 < 13; $i1++) {
        ?>
                                <option value="<?php echo $i1; ?>" <?php if ($admin_status->row()->fun_month == $i1) echo 'selected="selected"'; ?>><?php echo $mons[$i1]; ?></option>
    <?php } ?>

                        </select>
                        <select class="popup_txt" style="padding:4px; width:60px;" id="fun_day">
                            <option>Day</option>
    <?php for ($j1 = 1; $j1 < 32; $j1++) {
        ?>
                                <option value="<?php echo $j1; ?>" <?php if ($admin_status->row()->fun_day == $j1) echo 'selected="selected"'; ?>><?php echo $j1; ?></option>
    <?php } ?>
                        </select>
                        <select class="popup_txt" style="padding:4px; width:90px;" id="fun_year">
                            <option>Year</option>
                                <?php for ($k1 = date('Y'); $k1 < (date('Y') + 25); $k1++) {
                                    ?>
                                <option value="<?php echo $k1; ?>" <?php if ($admin_status->row()->fun_year == $k1) echo 'selected="selected"'; ?>><?php echo $k1; ?></option>
                                <?php } ?>
                        </select>

                    </div>

                    <div class="popup_field" style="width:95%; color:#FF0000; font-size:14px; margin:80px 0 0 10px;" id="generalNote"></div>
                    <div class="popup_field" style="margin-top:10px; width:95%">
                        <span>NOTES</span>

                        <input type="text" id="notes" class="popup_txt" style="width:250px;" placeholder="Click here to add text" />
                        <input type="hidden" id="reserd_id" value="<?php echo $details->id; ?>" />
                        <input type="submit" value="Submit" onclick="submit_values('funded')" class="popup_btn" style="height: 29px !important;
                               width: 82px;"  />

                    </div>           
                    <div class="popup_bottom">
                        <div class="popup_bottom_left">
                            <div class="popup_txt_1" style="margin:0 0 0 10px; height:120px; width:95%;" id="showGeneral">
    <?php
    foreach ($admin_notes->result() as $row) {
        if ($row->funded != '') {
            echo '<span><p style="color:#F00; float:left; margin-right:3px;">' . $row->added . ' - </p>' . $row->funded . ' - <b>' . $row->admin_name . '</b> </span> ';
        }
    }
    ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="popup_bottom_right" style="width:75%; margin:5px 0 0 0px;">
                            <span style="text-align:center;">STATUS</span>

                            <select style="margin:0 0 20px 36px; padding:4px; width:310px; text-align:center" class="popup_txt" id="popup_status_funded">
                                <option value="new" <?php if ($admin_status->row()->funded_status == 'new') echo 'selected="selected"'; ?>>NEW</option>
                                <option value="processing" <?php if ($admin_status->row()->funded_status == 'processing') echo 'selected="selected"'; ?>>PENDING</option>
                                <option value="complete" <?php if ($admin_status->row()->funded_status == 'complete') echo 'selected="selected"'; ?>>COMPLETED</option>
                            </select>

                            <input type="hidden" name="popup_id" id="popup_id_funded" value="<?php echo $admin_status->row()->id; ?>"/>

                            <input type="hidden" value="<?php echo $details->id; ?>" id="rsd_id_funded" />

                            <input type="submit" value="Save & Close" onclick="funded_save()" class="popup_btn" style="margin:0 0 0 43px" />

                        </div>
                    </div>     
                </div>
            </div>

        </div>

<?php } if ($display == 'closed') { ?>

        <div id='inline_closed' style='background:#fff;' class="pop_up_style">

            <div class="popup_page">  
                <div class="popup_header">Closed - <span> <?php echo stripslashes($details->prop_address); ?></span></div>  
                <span class="popup_sub_txt">Choose Files to Upload</span>
                <div class="popup_top_right">
                    <div class="popup_dragndrop9"><button class="popup_btn">Upload File </button></div>
                    <span class="popup_note" >Note : To Upload multiple files, hold 'Control' button while choosing files</span>
                </div><div class="clear"></div>
    <?php
    foreach ($popup_img->result() as $imgs) {
        if ($imgs->closed != '') {

            $imgName = $imgs->closed;
            $imgNameExt = @explode('.', $imgName);

            if (in_array($imgNameExt[1], $imgArr) == 1) {
                ?>
                            <div class="full_viewuse">
                                <img src="./images/crm-popup-images/<?php echo $imgName; ?>" width="105px" height="105px" />
                                <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                            </div> 
            <?php } elseif (in_array($imgNameExt[1], $docArr) == 1) { ?>
                            <div class="full_viewuse">
                                <img src="./images/doc-img.png" width="105px" height="105px" />
                                <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                            </div> 
            <?php } elseif (in_array($imgNameExt[1], $ExcelArr) == 1) { ?>
                            <div class="full_viewuse">
                                <img src="./images/excel-img.png" width="105px" height="105px" />
                                <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                            </div> 
            <?php } elseif ($imgNameExt[1] == 'pdf') { ?>
                            <div class="full_viewuse">
                                <img src="./images/pdf-img.png" width="105px" height="105px" />
                                <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                            </div> 
            <?php } elseif ($imgNameExt[1] == 'txt') { ?>
                            <div class="full_viewuse">
                                <img src="./images/txt-img.png" width="105px" height="105px" />
                                <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                            </div> 

            <?php } elseif ($imgNameExt[1] == 'html') { ?>
                            <div class="full_viewuse">
                                <img src="./images/html-img.png" width="105px" height="105px" />
                                <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                            </div>    

            <?php } ?>


                                <?php }
                            }
                            ?>             
                <div class="popup_middle">
                    <span style="font-size:18px; font-weight:bold; margin:30px 0 20px 5px; width:auto">Closing Information</span>
                    <div class="popup_field" style="margin:0 0 15px;">
                        <input type="checkbox" <?php if ($admin_status->row()->clo_buy == 'yes') echo 'checked="checked"'; ?> style="width:2%; float:left; margin:9px 0 0 10px" id="clo_by"/>
                        <label style="width:25% ; margin-top:10px">Documents to Buyer</label>                    
                    </div>
                    <div class="popup_field" style="margin:0 0 15px;">
                        <input type="checkbox" <?php if ($admin_status->row()->clo_sel == 'yes') echo 'checked="checked"'; ?> style="width:2%;float:left; margin:9px 0 0 10px" id="clo_se" />
                        <label style="margin-top:8px;">Documents to Seller</label>
                    </div>
                    <div class="popup_field">
                        <label>Close Date</label>
                        <select class="popup_txt" style="padding:4px; width:80px;" id="clo_month">
                            <option>Month</option>
    <?php for ($i2 = 1; $i2 < 13; $i2++) {
        ?>
                                <option value="<?php echo $i2; ?> " <?php if ($admin_status->row()->clo_month == $i2) echo 'selected="selected"'; ?>><?php echo $mons[$i2]; ?></option>
    <?php } ?>

                        </select>
                        <select class="popup_txt" style="padding:4px; width:60px;" id="clo_day">
                            <option>Day</option>
                                <?php for ($j2 = 1; $j2 < 32; $j2++) {
                                    ?>
                                <option value="<?php echo $j2; ?>" <?php if ($admin_status->row()->clo_day == $j2) echo 'selected="selected"'; ?>><?php echo $j2; ?></option>
                                <?php } ?>
                        </select>
                        <select class="popup_txt" style="padding:4px; width:90px;" id="clo_year">
                            <option>Year</option>
    <?php for ($k2 = date('Y'); $k2 < (date('Y') + 25); $k2++) {
        ?>
                                <option value="<?php echo $k2; ?>" <?php if ($admin_status->row()->clo_year == $k2) echo 'selected="selected"'; ?>><?php echo $k2; ?></option>
    <?php } ?>
                        </select>
                    </div>
                    <div class="popup_field" style="width:95%; color:#FF0000; font-size:14px; margin:40px 0 0 10px;" id="generalNote"></div>
                    <div class="popup_field" style="margin-top:10px; width:95%">
                        <span>NOTES</span>

                        <input type="text" id="notes" class="popup_txt" style="width:250px;" placeholder="Click here to add text" />
                        <input type="hidden" id="reserd_id" value="<?php echo $details->id; ?>" />
                        <input type="submit" value="Submit" onclick="submit_values('closed')" class="popup_btn"  style="height: 29px !important;
                               width: 82px;"/>

                    </div>           
                    <div class="popup_bottom">
                        <div class="popup_bottom_left">
                            <div class="popup_txt_1" style="margin:0 0 0 10px; height:120px; width:95%;" id="showGeneral">
    <?php
    foreach ($admin_notes->result() as $row) {
        if ($row->closed != '') {
            echo '<span><p style="color:#F00; float:left; margin-right:3px;">' . $row->added . ' - </p>' . $row->closed . ' - <b>' . $row->admin_name . '</b> </span> ';
        }
    }
    ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="popup_bottom_right" style="width:75%; margin:5px 0 0 0px">
                            <span style="text-align:center;">STATUS</span>

                            <select style="margin:0 0 20px 36px; padding:4px; width:310px; text-align:center" class="popup_txt" id="popup_status_closed">
                                <option value="new" <?php if ($admin_status->row()->closed_status == 'new') echo 'selected="selected"'; ?>>NEW</option>
                                <option value="processing" <?php if ($admin_status->row()->closed_status == 'processing') echo 'selected="selected"'; ?>>PENDING</option>
                                <option value="complete" <?php if ($admin_status->row()->closed_status == 'complete') echo 'selected="selected"'; ?>>COMPLETED</option>
                            </select>

                            <input type="hidden" name="popup_id" id="popup_id_closed" value="<?php echo $admin_status->row()->id; ?>"/>

                            <input type="hidden" value="<?php echo $details->id; ?>" id="rsd_id_closed" />

                            <input type="submit" value="Save & Close" onclick="closed_save()" class="popup_btn" style="margin:0 0 0 85px"   />

                        </div>
                    </div>     
                </div>
            </div>

        </div>

<?php } if ($display == 'hand_off') { ?>

        <div id='inline_pmhand' style='background:#fff;' class="pop_up_style">

            <div class="popup_page">  
                <div class="popup_header">Property Management Hand Off - <span><?php echo stripslashes($details->prop_address); ?></span></div>               
                <div class="popup_middle">
                    <span style="font-size:18px; font-weight:bold; margin:20px 0 10px 5px; width:auto">To Do List</span>
                    <div class="popup_field" style="margin:0 0 15px;">
                        <input type="checkbox" <?php if ($admin_status->row()->ho_buy == 'yes') echo 'checked="checked"'; ?> style="width:2%;float:left; margin:9px 0 0 10px" id="ho_buy"/>
                        <label style="width:35% ; margin-top:8px;" >Congratulations Email to Buyer</label>                    
                    </div>
                    <div class="popup_field" style="margin:0 0 15px;">
                        <input type="checkbox"  <?php if ($admin_status->row()->ho_pm == 'yes') echo 'checked="checked"'; ?> style="width:2%; float:left; margin:9px 0 0 10px" id="ho_pm"/>
                        <label style="width:35% ;margin-top:8px;">PM Intro Email to Buyer & PM</label>
                    </div>
                    <div class="popup_field" style="width:95%; color:#FF0000; font-size:14px; margin:110px 0 0 10px;" id="generalNote"></div>  
                    <div class="popup_field" style="margin-top:10px; width:95%">
                        <span>NOTES</span>

                        <input type="text" id="notes" class="popup_txt" style="width:250px;" placeholder="Click here to add text" />
                        <input type="hidden" id="reserd_id" value="<?php echo $details->id; ?>" />
                        <input type="submit" value="Submit" onclick="submit_values('hand_off')" class="popup_btn" style="height: 29px !important;
                               width: 82px;" />

                    </div>           
                    <div class="popup_bottom">
                        <div class="popup_bottom_left">
                            <div class="popup_txt_1" style="margin:0 0 0 10px; height:120px; width:95%;" id="showGeneral">
    <?php
    foreach ($admin_notes->result() as $row) {
        if ($row->hand_off != '') {
            echo '<span><p style="color:#F00; float:left; margin-right:3px;">' . $row->added . ' - </p>' . $row->hand_off . ' - <b>' . $row->admin_name . '</b> </span> ';
        }
    }
    ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="popup_bottom_right" style="width:75%; margin-top:5px;">
                            <span style="text-align:center;">STATUS</span>

                            <select style="margin:0 0 20px 36px; padding:4px; width:310px; text-align:center" class="popup_txt" id="popup_status_hand_off">
                                <option value="new" <?php if ($admin_status->row()->hand_off_status == 'new') echo 'selected="selected"'; ?>>NEW</option>
                                <option value="processing" <?php if ($admin_status->row()->hand_off_status == 'processing') echo 'selected="selected"'; ?>>PENDING</option>
                                <option value="complete" <?php if ($admin_status->row()->hand_off_status == 'complete') echo 'selected="selected"'; ?>>COMPLETED</option>
                            </select>

                            <input type="hidden" name="popup_id" id="popup_id_hand_off" value="<?php echo $admin_status->row()->id; ?>"/>

                            <input type="hidden" value="<?php echo $details->id; ?>" id="rsd_id_hand_off" />

                            <input type="submit" value="Save & Close" onclick="hand_off_save()" class="popup_btn" style="margin:0 0 0 86px" />

                        </div>
                    </div>     
                </div>
            </div>

        </div>

                            <?php } if ($display == 'master') { ?>

        <div id='inline_master' style='background:#fff;' class="pop_up_style">

            <div class="popup_page">  
                <div class="popup_header">Master Notes - <span> <?php echo stripslashes($details->prop_address); ?></span></div>               
                <div class="popup_middle">       
                    <div class="popup_field" style="width:95%; color:#FF0000; font-size:14px; margin:210px 0 0 10px;" id="generalNote"></div>

                    <div class="popup_field" style="margin-top:10px; width:95%">
                        <span>NOTES</span>

                        <input type="text" id="notes" class="popup_txt" style="width:250px;" placeholder="Click here to add text"/>
                        <input type="hidden" id="reserd_id" value="<?php echo $details->id; ?>" />
                        <input type="submit" value="Submit" onclick="submit_values('master')" class="popup_btn" style="height: 29px !important; width: 82px;"  />

                    </div>           
                    <div class="popup_bottom">
                        <div class="popup_bottom_left">
                            <div class="popup_txt_1" style="margin:0 0 0 10px; height:195px; width:95%;" id="showGeneral">
                                <?php foreach ($admin_notes->result() as $row) { ?>
                                    <?php
                                    if ($row->ror_iv != '' && $this->session->userdata('ror_crm_session_admin_type') == '') {
                                        echo '<span><p style="color:#F00; float:left; margin-right:3px;">' . $row->added . ' - </p>' . $row->ror_iv . ' - <b>' . $row->admin_name . '</b> </span> ';
                                    }
                                    if ($row->gen_iv != '' && $this->session->userdata('ror_crm_session_admin_type') == '') {
                                        echo '<span><p style="color:#F00; float:left; margin-right:3px;">' . $row->added . ' - </p>' . $row->gen_iv . ' - <b>' . $row->admin_name . '</b> </span> ';
                                    }
                                    if ($row->master != '') {
                                        echo '<span><p style="color:#F00; float:left; margin-right:3px;">' . $row->added . ' - </p>' . $row->master . ' - <b>' . $row->admin_name . '</b> </span> ';
                                    }
                                    if ($row->hand_off != '') {
                                        echo '<span><p style="color:#F00; float:left; margin-right:3px;">' . $row->added . ' - </p>' . $row->hand_off . ' - <b>' . $row->admin_name . '</b> </span> ';
                                    }
                                    if ($row->closed != '') {
                                        echo '<span><p style="color:#F00; float:left; margin-right:3px;">' . $row->added . ' - </p>' . $row->closed . ' - <b>' . $row->admin_name . '</b> </span> ';
                                    }
                                    if ($row->funded != '') {
                                        echo '<span><p style="color:#F00; float:left; margin-right:3px;">' . $row->added . ' - </p>' . $row->funded . ' - <b>' . $row->admin_name . '</b> </span> ';
                                    }
                                    if ($row->insurance != '') {
                                        echo '<span><p style="color:#F00; float:left; margin-right:3px;">' . $row->added . ' - </p>' . $row->insurance . ' - <b>' . $row->admin_name . '</b> </span> ';
                                    }
                                    if ($row->doi != '') {
                                        echo '<span><p style="color:#F00; float:left; margin-right:3px;">' . $row->added . ' - </p>' . $row->doi . ' - <b>' . $row->admin_name . '</b> </span> ';
                                    }
                                    if ($row->fedex != '') {
                                        echo '<span><p style="color:#F00; float:left; margin-right:3px;">' . $row->added . ' - </p>' . $row->fedex . ' - <b>' . $row->admin_name . '</b> </span> ';
                                    }
                                    if ($row->loan != '') {
                                        echo '<span><p style="color:#F00; float:left; margin-right:3px;">' . $row->added . ' - </p>' . $row->loan . ' - <b>' . $row->admin_name . '</b> </span> ';
                                    }
                                    if ($row->llc != '') {
                                        echo '<span><p style="color:#F00; float:left; margin-right:3px;">' . $row->added . ' - </p>' . $row->llc . ' - <b>' . $row->admin_name . '</b> </span> ';
                                    }
                                    if ($row->pa != '') {
                                        echo '<span><p style="color:#F00; float:left; margin-right:3px;">' . $row->added . ' - </p>' . $row->pa . ' - <b>' . $row->admin_name . '</b> </span> ';
                                    }
                                    if ($row->articles != '') {
                                        echo '<span><p style="color:#F00; float:left; margin-right:3px;">' . $row->added . ' - </p>' . $row->articles . ' - <b>' . $row->admin_name . '</b> </span> ';
                                    }
                                    if ($row->loi != '') {
                                        echo '<span><p style="color:#F00; float:left; margin-right:3px;">' . $row->added . ' - </p>' . $row->loi . ' - <b>' . $row->admin_name . '</b> </span> ';
                                    }
                                    if ($row->general != '') {
                                        echo '<span><p style="color:#F00; float:left; margin-right:3px;">' . $row->added . ' - </p>' . $row->general . ' - <b>' . $row->admin_name . '</b> </span> ';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="popup_bottom_right">
                            <input type="submit" value="Save & Close"  onclick="master_save()" class="popup_btn" style="margin:35px 0 0 10px" />
                        </div>
                    </div>     
                </div>
            </div>

        </div>

                            <?php } if ($display == 'invoice') { ?>

        <div id='inline_invoice' style='background:#fff;' class="pop_up_style">

            <div class="popup_page">  
                <div class="popup_header">Invoice - <span><?php echo stripslashes($details->prop_address); ?> </span></div>               
                <div class="popup_middle">       
                    <span style="font-size:18px; font-weight:bold; margin:0px 0 20px 60px; width:auto">Invoice Checklist</span>
                    <span style="font-size: 16px; margin: 0 0 15px 60px; line-height:24px; width: 80%;">1. Everything has been complete with this deal</span>
                    <span style="font-size: 16px; margin: 0 0 15px 60px; width: 80%; line-height:24px;">2. We are ready to send invoices to involved parties</span>
                    <span style="font-size: 16px; margin: 0 0 0px 60px; width: 80%; line-height:24px;">3. If all other tabs are Green, be sure to change Status to Complete and push Save & Close. This deal 
                        will then move to the Completed deals tab in the left menu bar.</span>
                    <div class="popup_field" style="width:95%; color:#FF0000; font-size:14px; margin:100px 0 0 10px;" id="generalNote"></div>
                    <div class="popup_field" style="margin-top:10px; width:95%">
                        <span>NOTES</span>

                        <input type="text" id="notes" class="popup_txt" style="width:250px;" placeholder="Click here to add text"/>
                        <input type="hidden" id="reserd_id" value="<?php echo $details->id; ?>" />
                        <input type="submit" value="Submit" onclick="submit_values('invoice')" class="popup_btn" style="height: 29px !important;
                               width: 82px;" />

                    </div>           
                    <div class="popup_bottom">
                        <div class="popup_bottom_left">
                            <div class="popup_txt_1" style="margin:0 0 0 10px; height:120px; width:95%;" id="showGeneral">
                                <?php
                                foreach ($admin_notes->result() as $row) {
                                    if ($row->invoice != '') {
                                        echo '<span><p style="color:#F00; float:left; margin-right:3px;">' . $row->added . ' - </p>' . $row->invoice . ' - <b>' . $row->admin_name . '</b> </span> ';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="popup_bottom_right" style="width:75%; margin:8px 0 0 0px;">
                            <span style="text-align:center; margin-left:8px;">STATUS</span>

                            <select style="margin:0 0 20px 36px; padding:4px; width:300px; text-align:center" class="popup_txt" id="popup_status_invoice">
                                <option value="new" <?php if ($admin_status->row()->invoice_status == 'new') echo 'selected="selected"'; ?>>NEW</option>
                                <option value="processing" <?php if ($admin_status->row()->inovice_status == 'processing') echo 'selected="selected"'; ?>>PENDING</option>


                                <?php
                                if ($details->sales_sl != '') {
                                    //&& $admin_status->row()->loan_status == 'complete'
                                    if ($admin_status->row()->loi_status == 'complete' && $admin_status->row()->articles_status == 'complete' && $admin_status->row()->pa_status == 'complete' && $admin_status->row()->doi_status == 'complete' && $admin_status->row()->insurance_status == 'complete' && $admin_status->row()->funded_status == 'complete' && $admin_status->row()->closed_status == 'complete' && $admin_status->row()->hand_off_status == 'complete') {
                                        ?>
                                        <option value="complete" <?php if ($admin_status->row()->invoice_status == 'complete') echo 'selected="selected"'; ?>>COMPLETED</option>
                                        <?php
                                    }
                                }else if ($details->sales_sl_fs != '') {
                                    if ($admin_status->row()->loi_status == 'complete' && $admin_status->row()->articles_status == 'complete' && $admin_status->row()->pa_status == 'complete' && $admin_status->row()->loan_status == 'complete' && $admin_status->row()->doi_status == 'complete' && $admin_status->row()->insurance_status == 'complete' && $admin_status->row()->funded_status == 'complete' && $admin_status->row()->closed_status == 'complete' && $admin_status->row()->hand_off_status == 'complete') {
                                        ?>
                                        <option value="complete" <?php if ($admin_status->row()->invoice_status == 'complete') echo 'selected="selected"'; ?>>COMPLETED</option>
            <?php
        }
    } else if ($details->sales_fs != '') {
        if ($admin_status->row()->loi_status == 'complete' && $admin_status->row()->pa_status == 'complete' && $admin_status->row()->loan_status == 'complete' && $admin_status->row()->doi_status == 'complete' && $admin_status->row()->insurance_status == 'complete' && $admin_status->row()->funded_status == 'complete' && $admin_status->row()->closed_status == 'complete' && $admin_status->row()->hand_off_status == 'complete') {
            ?>
                                        <option value="complete" <?php if ($admin_status->row()->invoice_status == 'complete') echo 'selected="selected"'; ?>>COMPLETED</option>
            <?php
        }
    } else if ($details->sales_sdira != '') {
        //&& $admin_status->row()->articles_status == 'complete'
        if ($admin_status->row()->loi_status == 'complete' && $admin_status->row()->pa_status == 'complete' && $admin_status->row()->doi_status == 'complete' && $admin_status->row()->insurance_status == 'complete' && $admin_status->row()->funded_status == 'complete' && $admin_status->row()->closed_status == 'complete' && $admin_status->row()->hand_off_status == 'complete') {
            ?>
                                        <option value="complete" <?php if ($admin_status->row()->invoice_status == 'complete') echo 'selected="selected"'; ?>>COMPLETED</option>
            <?php
        }
    } else if ($details->sales_cf != '') {
        if ($admin_status->row()->loi_status == 'complete' && $admin_status->row()->articles_status == 'complete' && $admin_status->row()->pa_status == 'complete' && $admin_status->row()->loan_status == 'complete' && $admin_status->row()->insurance_status == 'complete' && $admin_status->row()->funded_status == 'complete' && $admin_status->row()->closed_status == 'complete' && $admin_status->row()->hand_off_status == 'complete') {
            ?>
                                        <option value="complete" <?php if ($admin_status->row()->invoice_status == 'complete') echo 'selected="selected"'; ?>>COMPLETED</option>
            <?php
        }
    } else if ($details->sales_cash != '') {
        if ($admin_status->row()->loi_status == 'complete' && $admin_status->row()->articles_status == 'complete' && $admin_status->row()->pa_status == 'complete' && $admin_status->row()->insurance_status == 'complete' && $admin_status->row()->funded_status == 'complete' && $admin_status->row()->closed_status == 'complete' && $admin_status->row()->hand_off_status == 'complete') {
            ?>
                                        <option value="complete" <?php if ($admin_status->row()->invoice_status == 'complete') echo 'selected="selected"'; ?>>COMPLETED</option>
        <?php }
    }
    ?>


                            </select>

                            <input type="hidden" name="popup_id" id="popup_id_invoice" value="<?php echo $admin_status->row()->id; ?>"/>

                            <input type="hidden" value="<?php echo $details->id; ?>" id="rsd_id_invoice" />

                            <input type="submit" value="Save & Close" onclick="invoice_save()" class="popup_btn" style="margin:0 0 0 10px" />

                        </div>
                    </div>     
                </div>
            </div>

        </div>

<?php } if ($display == 'ror_iv') { ?>

        <div id='ror-invoice' style='background:#fff;' class="pop_up_style">

            <div class="popup_page">  
                <div class="popup_header">ROR Invoice - <span style="font-size:13px!important;"><?php echo stripslashes($details->prop_address); ?></span></div>   
                <span class="popup_sub_txt">Choose Files to Upload</span>
                <div class="popup_top_right">
                    <div class="popup_dragndrop7"><button class="popup_btn">Upload File </button></div>
                    <span class="popup_note">Note : To Upload multiple images, hold 'Control' button while choosing images</span>
                </div>
                <div class="clear"></div>

                <div class="popup_middle">
                    <div class="clear"></div>
                    <?php
                    foreach ($popup_img->result() as $imgs) {
                        if ($imgs->ror_iv != '') {

                            $imgName = $imgs->ror_iv;
                            $imgNameExt = @explode('.', $imgName);

                            if (in_array($imgNameExt[1], $imgArr) == 1) {
                                ?>
                                <div class="full_viewuse">
                                    <img src="./images/crm-popup-images/<?php echo $imgName; ?>" width="105px" height="105px" />
                                    <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                    <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                    <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                                </div> 
                            <?php } elseif (in_array($imgNameExt[1], $docArr) == 1) { ?>
                                <div class="full_viewuse">
                                    <img src="./images/doc-img.png" width="105px" height="105px" />
                                    <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                    <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                    <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                                </div> 
                            <?php } elseif (in_array($imgNameExt[1], $ExcelArr) == 1) { ?>
                                <div class="full_viewuse">
                                    <img src="./images/excel-img.png" width="105px" height="105px" />
                                    <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                    <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                    <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                                </div> 
                            <?php } elseif ($imgNameExt[1] == 'pdf') { ?>
                                <div class="full_viewuse">
                                    <img src="./images/pdf-img.png" width="105px" height="105px" />
                                    <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                    <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                    <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                                </div> 
            <?php } elseif ($imgNameExt[1] == 'txt') { ?>
                                <div class="full_viewuse">
                                    <img src="./images/txt-img.png" width="105px" height="105px" />
                                    <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                    <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                    <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                                </div> 
            <?php } elseif ($imgNameExt[1] == 'html') { ?>
                                <div class="full_viewuse">
                                    <img src="./images/html-img.png" width="105px" height="105px" />
                                    <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                    <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                    <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                                </div>    

            <?php } ?>

                            <!--<div class="full_viewuse">   
                            <img src="./images/crm-popup-images/<?php echo $imgs->ror_iv; ?>" width="100px" height="100px" style=" float:left; width:100%;" />
                             <a href="./images/crm-popup-images/<?php echo $imgs->ror_iv; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                            <a class="sub-btn" href='crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgs->ror_iv; ?>' >Download</a>
                               </div>-->
                                <?php }
                            }
                            ?>
                    <div style="float:left; width:100%; min-height:100px"></div>
                    <span style="width:42%;">Invoice Information</span>


                    <div class="popup_field">
                        <label>Marketing Fee Amount&nbsp;&nbsp; $<span style="color:#FF0000; float:right;">*</span></label> 

                        <input type="text" name="ror_iv_fee" id="ror_iv_fee" class="popup_txt" value="<?php if ($admin_status->row()->ror_iv_fee != '') echo $admin_status->row()->ror_iv_fee; ?>" onblur="saveMarketingFee()" onkeypress="return event.charCode < 58;"/>
                        <div id="ror_iv_fee_warn" style="color:#FF0000"></div>
                    </div>

                    <div class="popup_field">
                        <label>Date Created <span style="color:#FF0000; float:right; ">*</span></label> 
                        <select class="popup_txt" style="padding:4px; width:80px;" id="ror_iv_mon">
                            <option>Month</option>
    <?php for ($i = 1; $i < 13; $i++) {
        ?>
                                <option value="<?php echo $i; ?>" <?php if ($admin_status->row()->ror_iv_mon == $i) echo 'selected="selected"'; ?>><?php echo $mons[$i]; ?></option>
    <?php } ?>

                        </select>
                        <select class="popup_txt" style="padding:4px; width:60px;" id="ror_iv_day">
                            <option>Day</option>
                                <?php for ($j = 1; $j < 32; $j++) {
                                    ?>
                                <option value="<?php echo $j; ?> " <?php if ($admin_status->row()->ror_iv_day == $j) echo 'selected="selected"'; ?>><?php echo $j; ?></option>
                                <?php } ?>
                        </select>
                        <select class="popup_txt" style="padding:4px; width:90px;" id="ror_iv_year">
                            <option>Year</option>
    <?php for ($k = date('Y'); $k < (date('Y') + 25); $k++) {
        ?>
                                <option value="<?php echo $k; ?>" <?php if ($admin_status->row()->ror_iv_year == $k) echo 'selected="selected"'; ?>><?php echo $k; ?></option>
    <?php } ?>
                        </select>

                        <div class="generate-invoices"> <a onclick="return invoiceValidation()" href="<?php echo base_url() . 'crmadmin/product/downloadPDF/' . $admin_status->row()->reserved_id; ?>" class="popup_btn">Generate Invoice</a></div>      
                        <div id="ror_iv_date_warn"  style="color:#FF0000"></div>

                    </div>

                    <div class="popup_field" style="width:95%; color:#FF0000; font-size:14px; margin:60px 0 0 10px;" id="generalNote"></div>

                    <div class="popup_field" style="margin-top:10px; width:95%">

                        <span >NOTES</span>
                        <input type="text" id="notes" class="popup_txt" style="width:257px;" placeholder="Click here to add text" />
                        <input type="hidden" id="reserd_id" value="<?php echo $details->id; ?>" />
                        <input type="submit" value="Submit" onclick="submit_values('ror_iv')" class="popup_btn" style=" width:82px; height:29px !important;"  />
                    </div>           
                    <div class="popup_bottom">
                        <div class="popup_bottom_left">
                            <div class="popup_txt_1" style="margin:0 0 0 0px; height:120px; width:95%!important;" id="showGeneral">
    <?php
    foreach ($admin_notes->result() as $row) {
        if ($row->ror_iv != '') {
            echo '<span><p style="color:#F00; float:left; margin-right:3px;">' . $row->added . ' - </p>' . $row->ror_iv . ' - <b>' . $row->admin_name . '</b> </span> ';
        }
    }
    ?>
                            </div>
                        </div>



                        <!--<div class="clear"></div>-->
                        <div class="popup_bottom_right" style="width:30%;">
                            <span style="text-align:center;  margin:20px 0 0 0px; font-weight: bold; width:200px;">STATUS&nbsp; &nbsp;</span>

                            &nbsp;&nbsp;<select style="margin: 6px 0 12px 10px; padding:4px; width:200px; text-align:center" class="popup_txt" id="ror_iv_status">

                                <option value="new" <?php if ($admin_status->row()->ror_iv_status == 'new') echo 'selected="selected"'; ?>>NEW</option>
                                <option value="processing" <?php if ($admin_status->row()->ror_iv_status == 'processing') echo 'selected="selected"'; ?>>PENDING</option>
                                <option value="complete" <?php if ($admin_status->row()->ror_iv_status == 'complete') echo 'selected="selected"'; ?>>COMPLETED</option>
                            </select>

                            <input type="hidden" name="popup_id" id="popup_id_ror_iv" value="<?php echo $admin_status->row()->id; ?>"/>

                            <input type="hidden" value="<?php echo $details->id; ?>" id="rsd_id_ror_iv" />

                            <input type="submit" value="Save & Close" onclick="ror_iv_save()" class="popup_btn" style=" margin: 0 0 0 50px;" />

                        </div>
                    </div>     
                </div>
            </div>

        </div>

                <?php } if ($display == 'gen_iv') { ?>

        <div id='gen-invoice' style='background:#fff;' class="pop_up_style">

            <div class="popup_page">  
                <div class="popup_header">Lead Gen Invoice - <span style="font-size:13px!important;"><?php echo stripslashes($details->prop_address); ?></span></div>   
                <span class="popup_sub_txt">Choose Files to Upload</span>
                <div class="popup_top_right">
                    <div class="popup_dragndrop8"><button class="popup_btn">Upload File </button></div>
                    <span class="popup_note">Note : To Upload multiple images, hold 'Control' button while choosing images</span>
                </div>
                <div class="clear"></div>

                <div class="popup_middle">

                    <div class="clear"></div>
    <?php
    foreach ($popup_img->result() as $imgs) {
        if ($imgs->gen_iv != '') {

            $imgName = $imgs->gen_iv;
            $imgNameExt = @explode('.', $imgName);

            if (in_array($imgNameExt[1], $imgArr) == 1) {
                ?>
                                <div class="full_viewuse">
                                    <img src="./images/crm-popup-images/<?php echo $imgName; ?>" width="105px" height="105px" />
                                    <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                    <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                    <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                                </div> 
            <?php } elseif (in_array($imgNameExt[1], $docArr) == 1) { ?>
                                <div class="full_viewuse">
                                    <img src="./images/doc-img.png" width="105px" height="105px" />
                                    <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                    <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                    <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                                </div> 
                            <?php } elseif (in_array($imgNameExt[1], $ExcelArr) == 1) { ?>
                                <div class="full_viewuse">
                                    <img src="./images/excel-img.png" width="105px" height="105px" />
                                    <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                    <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                    <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                                </div> 
                            <?php } elseif ($imgNameExt[1] == 'pdf') { ?>
                                <div class="full_viewuse">
                                    <img src="./images/pdf-img.png" width="105px" height="105px" />
                                    <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                    <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                    <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                                </div> 
            <?php } elseif ($imgNameExt[1] == 'txt') { ?>
                                <div class="full_viewuse">
                                    <img src="./images/txt-img.png" width="105px" height="105px" />
                                    <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                    <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                    <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                                </div> 
            <?php } elseif ($imgNameExt[1] == 'html') { ?>
                                <div class="full_viewuse">
                                    <img src="./images/html-img.png" width="105px" height="105px" />
                                    <a href="./images/crm-popup-images/<?php echo $imgName; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                                    <a href="crmadmin/product/DeleteFiles/<?php echo $this->uri->segment(6) . '/' . $imgs->id . '/' . $imgs->reserved_id . '/' . $this->uri->segment(5) . '/' . $imgName; ?>" class="sub-btn" style="margin-left:14px;">Remove</a>
                                    <a href="crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgName; ?>" class="sub-btn">Download</a>
                                </div>     


            <?php } ?>

                            <!--<div class="full_viewuse">   
                            <img src="./images/crm-popup-images/<?php echo $imgs->gen_iv; ?>" width="100px" height="100px" style=" float:left; width:100%;" />
                             <a href="./images/crm-popup-images/<?php echo $imgs->gen_iv; ?>" class="sub-btn" target="_blank" style="margin-left:26px;">View</a>
                            <a class="sub-btn" href='crmadmin/adminlogin/downloadPopupUploadImage/<?php echo $imgs->gen_iv; ?>' >Download</a>
                               </div>-->
        <?php }
    }
    ?>
                    <div style="float:left; width:100%; min-height:100px"></div>

                    <span style="width:42%;">Invoice Information</span>


                    <div class="popup_field">
                        <label>Marketing Fee Amount&nbsp;&nbsp; $</label> 

                        <input type="text" name="gen_iv_fee" id="gen_iv_fee" class="popup_txt" value="<?php if ($admin_status->row()->gen_iv_fee != '') echo $admin_status->row()->gen_iv_fee; ?>" onkeypress="return event.charCode < 58;" />
                    </div>
                    <div class="popup_field">
                        <label>Date Created</label> 

                        <select class="popup_txt" style="padding:4px; width:80px;" id="gen_iv_mon">
                            <option>Month</option>
    <?php for ($i = 1; $i < 13; $i++) {
        ?>
                                <option value="<?php echo $i; ?>" <?php if ($admin_status->row()->gen_iv_mon == $i) echo 'selected="selected"'; ?>><?php echo $mons[$i]; ?></option>
                                <?php } ?>

                        </select>
                        <select class="popup_txt" style="padding:4px; width:60px;" id="gen_iv_day">
                            <option>Day</option>
                                <?php for ($j = 1; $j < 32; $j++) {
                                    ?>
                                <option value="<?php echo $j; ?>" <?php if ($admin_status->row()->gen_iv_day == $j) echo 'selected="selected"'; ?>><?php echo $j; ?></option>
    <?php } ?>
                        </select>
                        <select class="popup_txt" style="padding:4px; width:90px;" id="gen_iv_year">
                            <option>Year</option>
    <?php for ($k = date('Y'); $k < (date('Y') + 25); $k++) {
        ?>
                                <option value="<?php echo $k; ?>" <?php if ($admin_status->row()->gen_iv_year == $k) echo 'selected="selected"'; ?>><?php echo $k; ?></option>
    <?php } ?>
                        </select>
                    </div>



                    <div class="popup_field" style="width:95%; color:#FF0000; font-size:14px; margin:60px 0 0 10px;" id="generalNote"></div>
                    <div class="popup_field" style="margin-top:10px; width:95%">
                        <span >NOTES</span>
                        <input type="text" id="notes" class="popup_txt" style="width:257px;" placeholder="Click here to add text" />
                        <input type="hidden" id="reserd_id" value="<?php echo $details->id; ?>" />
                        <input type="submit" value="Submit" onclick="submit_values('gen_iv')" class="popup_btn" style=" width:82px; height:29px !important;"  />
                    </div>           
                    <div class="popup_bottom">
                        <div class="popup_bottom_left">
                            <div class="popup_txt_1" style="margin:0 0 0 0px; height:120px; width:95%!important;" id="showGeneral">
        <?php
        foreach ($admin_notes->result() as $row) {
            if ($row->gen_iv != '') {
                echo '<span><p style="color:#F00; float:left; margin-right:3px;">' . $row->added . ' - </p>' . $row->gen_iv . ' - <b>' . $row->admin_name . '</b> </span> ';
            }
        }
        ?>
                            </div>
                        </div>

                        <!--<div class="clear"></div>-->
                        <div class="popup_bottom_right" style="width:30%;">
                            <span style="text-align:center;  margin:20px 0 0 0px; font-weight: bold; width:200px;">STATUS&nbsp; &nbsp;</span>

                            &nbsp;&nbsp;<select style="margin: 6px 0 12px 10px; padding:4px; width:200px; text-align:center" class="popup_txt" id="gen_iv_status">
                                <option value="new" <?php if ($admin_status->row()->gen_iv_status == 'new') echo 'selected="selected"'; ?>>NEW</option>
                                <option value="processing" <?php if ($admin_status->row()->gen_iv_status == 'processing') echo 'selected="selected"'; ?>>PENDING</option>
                                <option value="complete" <?php if ($admin_status->row()->gen_iv_status == 'complete') echo 'selected="selected"'; ?>>COMPLETED</option>
                            </select>
                            <input type="hidden" name="popup_id" id="popup_id_gen_iv" value="<?php echo $admin_status->row()->id; ?>"/>

                            <input type="hidden" value="<?php echo $details->id; ?>" id="rsd_id_gen_iv" />

                            <input type="submit" value="Save & Close" onclick="gen_iv_save()" class="popup_btn" style=" margin: 0 0 0 50px;" />

                        </div>
                    </div>     
                </div>
            </div>

        </div>

<?php } ?>

<?php if ($display == 'create-alert') { ?>

        <div id='inline_create_alert' style='background:#fff;' class="pop_up_style inline_alert">
            <div class="popup_page">  
                <div class="popup_header">Create Alert</div>   
                <span class="popup_sub_txt prop_address"><?php echo stripslashes($details->prop_address); ?></span>
                <div class="clear"></div>
                <div class="popup_middle">   
                    <div style="margin:0 0 15px;" class="popup_field">
                        <label class="title">TITLE</label>
                        <div class="popup_control">
                            <input type="text" value="" class="popup_txt" id="alert_title" style="width: 70%;">
                        </div>
                    </div>
                    <div style="margin:0 0 15px;" class="popup_field">
                        <label class="title">DESCRIPTION</label>
                        <div class="popup_control">
                            <textarea type="text" value="" class="popup_txt_1" id="alert_description" style="height: 103px;width: 455px;"></textarea>
                        </div>
                    </div>
                    <div style="margin:0 0 15px;" class="popup_field">
                        <label class="title">SETUP ALERT DATE/TIME</label>
                        <div class="popup_control">
                            <div class="popup_field">
                                <label class="sub_titles">DATE</label>
                                <select id="alert_month" class="popup_choose">
                                    <option value="">Month</option>
                                    <option value="01">January</option>
                                    <option value="02">February</option>
                                    <option value="03">March</option>
                                    <option value="04">April</option>
                                    <option value="05">May</option>
                                    <option value="06">June</option>
                                    <option value="07">July</option>
                                    <option value="08">August</option>
                                    <option value="09">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>&nbsp;
                                <select id="alert_day" class="popup_choose">
                                    <option value="">Day</option>
    <?php for ($d = 01; $d <= 31; $d++) { ?>
                                        <option value="<?php echo $d; ?>"><?php echo $d; ?></option>
    <?php } ?>
                                </select>
                                <select id="alert_year" class="popup_choose">
                                    <option>Year</option>
    <?php for ($y = date("Y"); $y <= date("Y") + 25; $y++) { ?>
                                        <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
    <?php } ?>
                                </select>
                            </div>
                            <div class="popup_field">
                                <label class="sub_titles">TIME</label>
                                <select id="alert_hour" class="popup_choose">
                                    <option value="">Hours</option>
        <?php for ($h = 01; $h <= 12; $h++) { ?>
                                        <option value="<?php echo $h; ?>"><?php echo $h; ?></option>
    <?php } ?>
                                </select>:
                                <select id="alert_minutes" class="popup_choose">
                                    <option value="">Minutes</option>
    <?php for ($min = 00; $min <= 60; $min++) { ?>
                                        <option value="<?php echo $min; ?>"><?php echo $min; ?></option>
                    <?php } ?>
                                </select>
                                <select id="alert_meridiem" class="popup_choose">
                                    <option>Meridium</option>
                                    <option value="AM">AM</option>
                                    <option value="PM">PM</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <span class="popup_error" id="popup_error" style="display:none;">Fill All The Fields to Save and Set Alert.</span>
                <div class="popup_bottom">
                    <div class="clear"></div>
                    <div style="width:90%; margin:5px 0 0 0px" class="popup_bottom_right">
                        <input type="hidden" id="reserved_id" value="<?php echo $details->id; ?>">
                        <input type="hidden" id="property_id" value="<?php echo $details->property_id; ?>">
                        <input type="hidden" name="popup_id" id="popup_id_create_alert" value=""/>
                        <input type="submit" style="float:right;" class="popup_btn" onclick="create_alert()" value="Save and Set">
                    </div>
                </div>
            </div>
        </div>

                <?php } ?>
<?php if ($display == 'view-alert-list') { ?>

        <div id='inline_list_alert' style='background:#fff;' class="pop_up_style inline_alert">
            <div class="popup_page">  
                <div class="popup_header">Alerts</div>   
                <span class="popup_sub_txt prop_address"><?php echo stripslashes($details->prop_address); ?></span>
                <div class="clear"></div>
                <div class="popup_middle">   
    <?php if ($alertLists->num_rows() > 0) { ?>
                        <ul class="alert-ulist">
                            <li class="alert-list dark">
                                <span  class="alnum">#</span>
                                <span class="altitle">Title</span>
                                <span class="aluser">User</span>
                                <span class="altime">Alert Time</span>
                            </li>
        <?php
        $i = 0;
        foreach ($alertLists->result() as $alert) {
            $i++;
            ?>
                                <li class="alert-list">
                                    <a href="javascript:void(0);" onclick="popupCall('<?php echo $alert->reserved_id . '/view-alert/' . $uri6 . '/' . $alert->id; ?>')" class="alert_popup <?php echo $alert->alert_status; ?>">
                                        <span class="alnum"><?php echo $i; ?></span>
                                        <span class="altitle"><?php echo $alert->alert_title; ?></span>
                                        <span class="aluser"><?php echo $alert->userName; ?></span>
                                        <span class="altime"><?php echo date("m/d/y h:i A", strtotime($alert->alert_date)); ?></span>
                                    </a>
                                </li>
        <?php } ?>
                        </ul>
    <?php } else { ?>
                        No Alerts Available
    <?php } ?>
                </div>
            </div>
        </div>

<?php } ?>
<?php if ($display == 'view-alert') { ?>

        <div id='inline_create_alert' style='background:#fff;' class="pop_up_style inline_alert">
            <div class="popup_page">  
                <div class="popup_header">Alert Details</div>   
                <span class="popup_sub_txt prop_address"><?php echo stripslashes($details->prop_address); ?></span>
                <div class="clear"></div>
                <div class="popup_middle">   
                    <div style="margin:0 0 15px;" class="popup_field">
                        <label class="title">TITLE</label>
                        <div class="popup_control">
                            <input type="text" class="popup_txt" id="alert_title" style="width: 70%;" value="<?php echo $alertInfo->row()->alert_title; ?>" disabled>
                        </div>
                    </div>
                    <div style="margin:0 0 15px;" class="popup_field">
                        <label class="title">DESCRIPTION</label>
                        <div class="popup_control">
                            <textarea type="text" class="popup_txt_1" id="alert_description" style="height: 103px;width: 455px;" disabled><?php echo $alertInfo->row()->alert_description; ?></textarea>
                        </div>
                    </div>
                    <div style="margin:0 0 15px;" class="popup_field">
                        <label class="title">ALERT DATE/TIME</label>
                        <div class="popup_control">
                            <div class="popup_field">
                                <label class="sub_titles">DATE</label>
                                <select id="alert_month" class="popup_choose" disabled>
                                    <option value="">Month</option>
                                    <option value="01" <?php if ($alertInfo->row()->alert_month == "01") echo 'selected="selected"'; ?>>January</option>
                                    <option value="02" <?php if ($alertInfo->row()->alert_month == "02") echo 'selected="selected"'; ?>>February</option>
                                    <option value="03" <?php if ($alertInfo->row()->alert_month == "03") echo 'selected="selected"'; ?>>March</option>
                                    <option value="04" <?php if ($alertInfo->row()->alert_month == "04") echo 'selected="selected"'; ?>>April</option>
                                    <option value="05" <?php if ($alertInfo->row()->alert_month == "05") echo 'selected="selected"'; ?>>May</option>
                                    <option value="06" <?php if ($alertInfo->row()->alert_month == "06") echo 'selected="selected"'; ?>>June</option>
                                    <option value="07" <?php if ($alertInfo->row()->alert_month == "07") echo 'selected="selected"'; ?>>July</option>
                                    <option value="08" <?php if ($alertInfo->row()->alert_month == "08") echo 'selected="selected"'; ?>>August</option>
                                    <option value="09" <?php if ($alertInfo->row()->alert_month == "09") echo 'selected="selected"'; ?>>September</option>
                                    <option value="10" <?php if ($alertInfo->row()->alert_month == "10") echo 'selected="selected"'; ?>>October</option>
                                    <option value="11" <?php if ($alertInfo->row()->alert_month == "11") echo 'selected="selected"'; ?>>November</option>
                                    <option value="12" <?php if ($alertInfo->row()->alert_month == "12") echo 'selected="selected"'; ?>>December</option>
                                </select>&nbsp;
                                <select id="alert_day" class="popup_choose" disabled>
                                    <option value="">Day</option>
    <?php for ($d = 01; $d <= 31; $d++) { ?>
                                        <option value="<?php echo $d; ?>" <?php if ($alertInfo->row()->alert_day == $d) echo 'selected="selected"'; ?>>
        <?php echo $d; ?>
                                        </option>
    <?php } ?>
                                </select>
                                <select id="alert_year" class="popup_choose" disabled>
                                    <option>Year</option>
    <?php for ($y = date("Y"); $y <= date("Y") + 25; $y++) { ?>
                                        <option value="<?php echo $y; ?>" <?php if ($alertInfo->row()->alert_year == $y) echo 'selected="selected"'; ?>>
        <?php echo $y; ?>
                                        </option>
    <?php } ?>
                                </select>
                            </div>
                            <div class="popup_field">
                                <label class="sub_titles">TIME</label>
                                <select id="alert_hour" class="popup_choose" disabled>
                                    <option value="">Hours</option>
    <?php for ($h = 01; $h <= 12; $h++) { ?>
                                        <option value="<?php echo $h; ?>" <?php if ($alertInfo->row()->alert_hour == $h) echo 'selected="selected"'; ?>>
        <?php echo $h; ?>
                                        </option>
    <?php } ?>
                                </select>:
                                <select id="alert_minutes" class="popup_choose" disabled>
                                    <option value="">Minutes</option>
    <?php for ($min = 00; $min <= 60; $min++) { ?>
                                        <option value="<?php echo $min; ?>" <?php if ($alertInfo->row()->alert_minutes == $min) echo 'selected="selected"'; ?>>
        <?php echo $min; ?>
                                        </option>
    <?php } ?>
                                </select>
                                <select id="alert_meridiem" class="popup_choose" disabled>
                                    <option>Meridium</option>
                                    <option value="AM" <?php if ($alertInfo->row()->alert_meridiem == 'AM') echo 'selected="selected"'; ?>>AM</option>
                                    <option value="PM" <?php if ($alertInfo->row()->alert_meridiem == 'PM') echo 'selected="selected"'; ?>>PM</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <span class="popup_error" id="popup_error" style="display:none;">Fill All The Fields to Save and Set Alert.</span>
                <div class="popup_bottom">
                    <div class="clear"></div>
                    <div style="width:90%; margin:5px 0 0 0px" class="popup_bottom_right">			
                        <div class="alert_status">
                            <span style="text-align:center;  margin:20px 0 0 0px; font-weight: bold; width:200px;">STATUS&nbsp; &nbsp;</span>
                            &nbsp;&nbsp;
                            <select style="margin: 6px 0 12px 10px; padding:4px; width:122px; text-align:center" class="popup_txt" id="alert_status">
                                <option value="New" <?php if ($alertInfo->row()->alert_status == 'New') echo 'selected="selected"'; ?>>
                                    NEW
                                </option>
                                <option value="Completed" <?php if ($alertInfo->row()->alert_status == 'Completed') echo 'selected="selected"'; ?>>
                                    COMPLETED
                                </option>
                                <option value="Pending" <?php if ($alertInfo->row()->alert_status == 'Pending') echo 'selected="selected"'; ?>>
                                    PENDING
                                </option>
                            </select>
                        </div>
                        <input type="hidden" id="alert_id" value="<?php echo $alertInfo->row()->id; ?>">
                        <input type="hidden" id="reserved_id" value="<?php echo $details->id; ?>">
                        <input type="hidden" id="property_id" value="<?php echo $details->property_id; ?>">
                        <input type="hidden" name="popup_id" id="popup_id_create_alert" value=""/>
                        <input type="submit" style="float:right;" class="popup_btn" onclick="change_alert()" value="Save &amp; Close">
                    </div>
                </div> 
            </div>
        </div>

<?php } ?>


</div>

<script>
    function submit_values(tabVal)
    {
        var note = document.getElementById("notes").value;
        var id = document.getElementById("reserd_id").value;
        var adminName = '<?php echo $login_admin_name; ?>';
        var field = tabVal;
        if (note == '') {
            $('#generalNote').html('Empty notes are not encouraged');
            $('#generalNote').show().delay('3000').fadeOut();
            return false;
        } else {
            $.ajax({
                type: 'POST',
                url: baseURL + 'crmadmin/product/genereal_note',
                data: {'notes': note, 'field': field, 'reserd_id': id, 'admin_name': adminName},
                success: function (data) {
					var data = $.trim(data);
                    if (data == 'success') {
                        $('#generalNote').html('Notes added successfully');
                        $('#generalNote').show().delay('3000').fadeOut();
                        var showGeneralMsg = $('#showGeneral').html();
                        $('#notes').val('');

                        $('#showGeneral').html('<span><p style="color:#F00; float:left; margin-right:3px;">' + ShowLocalDate() + ' -  </p> ' + note + ' - <b>' + adminName + '</b></span><br>' + showGeneralMsg);

                    }

                }
            });
        }
    }

    function ShowLocalDate()
    {
        var dNow = new Date();
        var localdate = dNow.getFullYear() + '-' + (dNow.getMonth() + 1) + '-' + dNow.getDate() + ' ' + dNow.getHours() + ':' + dNow.getMinutes() + ':' + dNow.getSeconds();
        return localdate;
    }

    function general_save()
    {
        $("#general_popup_form").submit();
    }

    function loi_save()
    {
<?php if ($details->sales_cash != '' || $details->sales_cf != '' || $details->sales_sl != '' || $details->sales_sl_fs != '') { ?>
        var entName = document.getElementById("entityNm").value;
<?php } ?>
    var cust = document.getElementById("custodian_name").value;
            var ac_ty = document.getElementById("account_type").value;
            var ac_no = document.getElementById("account_no").value;
            var puId = document.getElementById("popup_id_loi").value;
            var status = document.getElementById("popup_status_loi").value;
            var rsdId = document.getElementById("rsd_id_loi").value;
            $.ajax({
            type: 'POST',
                    url: baseURL + 'crmadmin/product/popup_save_options',
<?php if ($details->sales_cash != '' || $details->sales_cf != '' || $details->sales_sl != '' || $details->sales_sl_fs != '') { ?>
                data:{'entity_name':entName, 'custodian_name':cust, 'account_type':ac_ty, 'account_no':ac_no, 'popup_id':puId, 'loi_status':status, 'reserved_id':rsdId},
<?php } else { ?>
                data:{'custodian_name':cust, 'account_type':ac_ty, 'account_no':ac_no, 'popup_id':puId, 'loi_status':status, 'reserved_id':rsdId},
<?php } ?>
            success: function(data)
            {
				var data = $.trim(data);
            if (data == 'success')
            {
            //alert("LOI details saved");
            window.location.href = baseURL + "crmadmin/product/display_product_list/" + $('#pagenames').val();
            }
            }
            });
    }

    function cash_loi_save()
    {
    var entName = document.getElementById("entityNm").value;
            var puId = document.getElementById("popup_id_loi").value;
            var status = document.getElementById("popup_status_loi").value;
            var rsdId = document.getElementById("rsd_id_loi").value;
            $.ajax({
            type: 'POST',
                    url: baseURL + 'crmadmin/product/popup_save_options',
                    data:{'entity_name':entName, 'popup_id':puId, 'loi_status':status, 'reserved_id':rsdId},
                    success: function(data)
                    {
						var data = $.trim(data);
                    if (data == 'success')
                    {
                    //alert("LOI details saved");
                    window.location.href = baseURL + "crmadmin/product/display_product_list/" + $('#pagenames').val();
                    }
                    }
            });
    }

    function articles_save()
    {
    var puId = document.getElementById("popup_id_articles").value;
            var status = document.getElementById("popup_status_articles").value;
            var rsdId = document.getElementById("rsd_id_articles").value;
            $.ajax({
            type: 'POST',
                    url: baseURL + 'crmadmin/product/popup_save_options',
                    data:{'popup_id':puId, 'articles_status':status, 'reserved_id':rsdId},
                    success: function(data)
                    {
						var data = $.trim(data);
                    if (data == 'success')
                    {
                    //alert("Articles details saved");
                    window.location.href = baseURL + "crmadmin/product/display_product_list/" + $('#pagenames').val();
                    }
                    }
            });
    }

    function pa_save()
    {
    var puId = document.getElementById("popup_id_pa").value;
            var status = document.getElementById("popup_status_pa").value;
            var rsdId = document.getElementById("rsd_id_pa").value;
            $.ajax({
            type: 'POST',
                    url: baseURL + 'crmadmin/product/popup_save_options',
                    data:{'popup_id':puId, 'pa_status':status, 'reserved_id':rsdId},
                    success: function(data)
                    {
						var data = $.trim(data);
                    if (data == 'success')
                    {
                    //alert("PA details saved");
                    window.location.href = baseURL + "crmadmin/product/display_product_list/" + $('#pagenames').val();
                    }
                    }
            });
    }

    function loan_save()
    {
    var puId = document.getElementById("popup_id_loan").value;
            var status = document.getElementById("popup_status_loan").value;
            var rsdId = document.getElementById("rsd_id_loan").value;
            var propdescloan = document.getElementById("prop_desc_loan").value;
            var sbltaxid = document.getElementById("sbl_tax_id_loan").value;
            $.ajax({
            type: 'POST',
                    url: baseURL + 'crmadmin/product/popup_save_options',
                    data:{'popup_id':puId, 'loan_status':status, 'reserved_id':rsdId, 'prop_desc_loan':propdescloan, 'sbl_tax_id_loan':sbltaxid},
                    success: function(data)
                    {
						var data = $.trim(data);
                    if (data == 'success')
                    {
                    //alert("Loan Docs details saved");
                    window.location.href = baseURL + "crmadmin/product/display_product_list/" + $('#pagenames').val();
                    }
                    }
            });
    }

    function fedex_save()
    {
    window.location.href = baseURL + "crmadmin/product/display_product_list/" + $('#pagenames').val();
    }

    function doi_save()
    {
    var puId = document.getElementById("popup_id_doi").value;
            var status = document.getElementById("popup_status_doi").value;
            var rsdId = document.getElementById("rsd_id_doi").value;
            $.ajax({
            type: 'POST',
                    url: baseURL + 'crmadmin/product/popup_save_options',
                    data:{'popup_id':puId, 'doi_status':status, 'reserved_id':rsdId},
                    success: function(data)
                    {
						var data = $.trim(data);
                    if (data == 'success')
                    {
                    //alert("Doi details saved");
                    window.location.href = baseURL + "crmadmin/product/display_product_list/" + $('#pagenames').val();
                    }
                    }
            });
    }

    function insurance_save()
    {
    var puId = document.getElementById("popup_id_insurance").value;
            var status = document.getElementById("popup_status_insurance").value;
            var rsdId = document.getElementById("rsd_id_insurance").value;
            var provider = document.getElementById("provider").value;
            var day = document.getElementById("ins_day").value;
            var month = document.getElementById("ins_month").value;
            var year = document.getElementById("ins_year").value;
            $.ajax({
            type: 'POST',
                    url: baseURL + 'crmadmin/product/popup_save_options',
                    data:{'popup_id':puId, 'insurance_status':status, 'reserved_id':rsdId, 'ins_provider':provider, 'ins_day':day, 'ins_month':month, 'ins_year':year},
                    success: function(data)
                    {
						var data = $.trim(data);
                    if (data == 'success')
                    {
                    //alert("Insurance details saved");
                    window.location.href = baseURL + "crmadmin/product/display_product_list/" + $('#pagenames').val();
                    }
                    }
            });
    }

    function funded_save()
    {
    var puId = document.getElementById("popup_id_funded").value;
            var status = document.getElementById("popup_status_funded").value;
            var rsdId = document.getElementById("rsd_id_funded").value;
            var amtexp = document.getElementById("amount_exp").value;
            var amtrec = document.getElementById("amount_rec").value;
            var day = document.getElementById("fun_day").value;
            var month = document.getElementById("fun_month").value;
            var year = document.getElementById("fun_year").value;
            $.ajax({
            type: 'POST',
                    url: baseURL + 'crmadmin/product/popup_save_options',
                    data:{'popup_id':puId, 'funded_status':status, 'reserved_id':rsdId, 'fun_amount_exp':amtexp, 'fun_amount_rec':amtrec, 'fun_day':day, 'fun_month':month, 'fun_year':year},
                    success: function(data)
                    {
						var data = $.trim(data);
                    if (data == 'success')
                    {
                    //alert("Funded details saved");
                    window.location.href = baseURL + "crmadmin/product/display_product_list/" + $('#pagenames').val();
                    }
                    }
            });
    }

    function closed_save()
    {
    var puId = document.getElementById("popup_id_closed").value;
            var status = document.getElementById("popup_status_closed").value;
            var rsdId = document.getElementById("rsd_id_closed").value;
            var clobuy = document.getElementById("clo_by").checked;
            var closel = document.getElementById("clo_se").checked;
            var day = document.getElementById("clo_day").value;
            var month = document.getElementById("clo_month").value;
            var year = document.getElementById("clo_year").value;
            if (clobuy == true)
            buy = 'yes';
            else
            buy = 'no';
            if (closel == true)
            sell = 'yes';
            else
            sell = 'no';
            $.ajax({
            type: 'POST',
                    url: baseURL + 'crmadmin/product/popup_save_options',
                    data:{'popup_id':puId, 'closed_status':status, 'reserved_id':rsdId, 'clo_buy':buy, 'clo_sel':sell, 'clo_day':day, 'clo_month':month, 'clo_year':year},
                    success: function(data)
                    {
						var data = $.trim(data);
                    if (data == 'success')
                    {
                    //alert("Closed details saved");
                    window.location.href = baseURL + "crmadmin/product/display_product_list/" + $('#pagenames').val();
                    }
                    }
            });
    }

    function hand_off_save()
    {
    var puId = document.getElementById("popup_id_hand_off").value;
            var status = document.getElementById("popup_status_hand_off").value;
            var rsdId = document.getElementById("rsd_id_hand_off").value;
            var buyr = document.getElementById("ho_buy").checked;
            var pmr = document.getElementById("ho_pm").checked;
            if (buyr == true)
            buy = 'yes';
            else
            buy = 'no';
            if (pmr == true)
            sell = 'yes';
            else
            sell = 'no';
            $.ajax({
            type: 'POST',
                    url: baseURL + 'crmadmin/product/popup_save_options',
                    data:{'popup_id':puId, 'hand_off_status':status, 'reserved_id':rsdId, 'ho_buy':buy, 'ho_pm':sell},
                    success: function(data)
                    {
						var data = $.trim(data);
                    if (data == 'success')
                    {
                    //alert("Hand off details saved");
                    window.location.href = baseURL + "crmadmin/product/display_product_list/" + $('#pagenames').val();
                    }
                    }
            });
    }

    function master_save()
    {
    window.location.href = baseURL + "crmadmin/product/display_product_list/" + $('#pagenames').val();
    }

    function invoice_save()
    {
    var puId = document.getElementById("popup_id_invoice").value;
            var status = document.getElementById("popup_status_invoice").value;
            var rsdId = document.getElementById("rsd_id_invoice").value;
            $.ajax({
            type: 'POST',
                    url: baseURL + 'crmadmin/product/popup_save_options',
                    data:{'popup_id':puId, 'invoice_status':status, 'reserved_id':rsdId},
                    success: function(data)
                    {
						var data = $.trim(data);
                    //alert(data);
                    if (data == 'success')
                    {
                    //alert("Invoice details saved");
                    window.location.href = baseURL + "crmadmin/product/display_product_list/" + $('#pagenames').val();
                    }
                    }
            });
    }

</script>
<?php if ($this->uri->segment(6) != 'cancelled') { ?>
    <script>
        function ror_iv_save()
        {
        var puId = document.getElementById("popup_id_ror_iv").value;
                var status = document.getElementById("ror_iv_status").value;
                var rsdId = document.getElementById("rsd_id_ror_iv").value;
                var fee = document.getElementById("ror_iv_fee").value;
                var day = document.getElementById("ror_iv_day").value;
                var month = document.getElementById("ror_iv_mon").value;
                var year = document.getElementById("ror_iv_year").value;
                $.ajax({
                type: 'POST',
                        url: baseURL + 'crmadmin/product/popup_save_options',
                        data:{'popup_id':puId, 'ror_iv_status':status, 'reserved_id':rsdId, 'ror_iv_fee':fee, 'ror_iv_day':day, 'ror_iv_mon':month, 'ror_iv_year':year},
                        success: function(data)
                        {
							var data = $.trim(data);
                        if (data == 'success')
                        {
                        //alert("Insurance details saved");
                        window.location.href = baseURL + "crmadmin/product/display_product_list/" + $('#pagenames').val();
                        }
                        }
                });
        }

        function gen_iv_save()
        {
        var puId = document.getElementById("popup_id_gen_iv").value;
                var status = document.getElementById("gen_iv_status").value;
                var rsdId = document.getElementById("rsd_id_gen_iv").value;
                var fee = document.getElementById("gen_iv_fee").value;
                var day = document.getElementById("gen_iv_day").value;
                var month = document.getElementById("gen_iv_mon").value;
                var year = document.getElementById("gen_iv_year").value;
                $.ajax({
                type: 'POST',
                        url: baseURL + 'crmadmin/product/popup_save_options',
                        data:{'popup_id':puId, 'gen_iv_status':status, 'reserved_id':rsdId, 'gen_iv_fee':fee, 'gen_iv_day':day, 'gen_iv_mon':month, 'gen_iv_year':year},
                        success: function(data)
                        {
							var data = $.trim(data);
                        if (data == 'success')
                        {
                        //alert("Insurance details saved");
                        window.location.href = baseURL + "crmadmin/product/display_product_list/" + $('#pagenames').val();
                        }
                        }
                });
        }

        function saveMarketingFee()
        {
        var fee = document.getElementById("ror_iv_fee").value;
    <?php if ($admin_status->row()->id != '') { ?>
            var status_id = <?php echo $admin_status->row()->id; ?>;
    <?php } ?>
        $.ajax({
        type: 'POST',
                url: baseURL + 'crmadmin/product/saveMarketingFee',
                data:{'fee':fee, 'id':status_id},
                complete: function()
                {

                }
        });
        }

        function invoiceValidation()
        {
        var fee = document.getElementById("ror_iv_fee").value;
                var day = document.getElementById("ror_iv_day").value;
                var month = document.getElementById("ror_iv_mon").value;
                var year = document.getElementById("ror_iv_year").value;
    <?php if ($admin_status->row()->id != '') { ?>
            var statid = <?php echo $admin_status->row()->id; ?>;
    <?php } ?>
        if (fee != '' && day != 'Day' && month != 'Month' && year != 'Year')
        {
        return true;
        }
        else
        {
        if (fee == '')
        {
        document.getElementById("ror_iv_fee").focus();
                $('#ror_iv_fee_warn').html('Please enter the marketing fee');
                $('#ror_iv_fee_warn').show().delay('3000').fadeOut();
                return false;
        }
        if (month == 'Month')
        {
        document.getElementById("ror_iv_mon").focus();
                $('#ror_iv_date_warn').html('Please choose the month');
                $('#ror_iv_date_warn').show().delay('3000').fadeOut();
                return false;
        }
        if (day == 'Day')
        {
        document.getElementById("ror_iv_day").focus();
                $('#ror_iv_date_warn').html('Please choose the day');
                $('#ror_iv_date_warn').show().delay('3000').fadeOut();
                return false;
        }
        if (year == 'Year')
        {
        document.getElementById("ror_iv_year").focus();
                $('#ror_iv_date_warn').html('Please choose the year');
                $('#ror_iv_date_warn').show().delay('3000').fadeOut();
                return false;
        }
        }
        }

    </script>
<?php } ?>

<script>
    /*Scripting for phase 8*/

    function create_alert(){
    var alert_title = document.getElementById("alert_title").value.trim();
            var alert_description = document.getElementById("alert_description").value.trim();
            var alert_day = document.getElementById("alert_day").value.trim();
            var alert_month = document.getElementById("alert_month").value.trim();
            var alert_year = document.getElementById("alert_year").value.trim();
            var alert_hour = document.getElementById("alert_hour").value.trim();
            var alert_minutes = document.getElementById("alert_minutes").value.trim();
            var alert_meridiem = document.getElementById("alert_meridiem").value.trim();
            var popup_id_create_alert = document.getElementById("popup_id_create_alert").value.trim();
            var reserved_id = document.getElementById("reserved_id").value.trim();
            var property_id = document.getElementById("property_id").value.trim();
            var isVerified = true;
            if (alert_title == null || alert_title == ""){
    isVerified = false;
    }
    if (alert_description == null || alert_description == ""){
    isVerified = false;
    }
    if (alert_day == null || alert_day == ""){
    isVerified = false;
    }
    if (alert_month == null || alert_month == ""){
    isVerified = false;
    }
    if (alert_year == null || alert_year == ""){
    isVerified = false;
    }
    if (alert_hour == null || alert_hour == ""){
    isVerified = false;
    }
    if (alert_minutes == null || alert_minutes == ""){
    isVerified = false;
    }
    if (alert_meridiem == null || alert_meridiem == ""){
    isVerified = false;
    }


    if (isVerified){
    $("#popup_error").hide();
            $.ajax({
            type: 'POST',
                    url: baseURL + 'crmadmin/product/popup_creat_alert',
                    data:{'alert_title':alert_title, 'alert_description':alert_description, 'alert_day':alert_day, 'alert_month':alert_month, 'alert_year':alert_year, 'alert_hour':alert_hour, 'alert_minutes':alert_minutes, 'alert_meridiem':alert_meridiem, 'reserved_id':reserved_id, 'property_id':property_id},
                    success: function(data){
						var data = $.trim(data);
                    if (data == 'success'){
                    window.location.href = baseURL + "crmadmin/product/display_product_list/" + $('#pagenames').val();
                    } else{
                    $("#popup_error").html(data);
                            $("#popup_error").show();
                    }
                    }
            });
    } else{
    $("#popup_error").show();
    }

    }


    function change_alert(){
    var alert_id = document.getElementById("alert_id").value;
            var alert_status = document.getElementById("alert_status").value;
            $.ajax({
            type: 'POST',
                    url: baseURL + 'crmadmin/product/change_alert_status',
                    data:{'alert_status':alert_status, 'alert_id':alert_id},
                    success: function(data){
						var data = $.trim(data);
                    if (data == 'success'){
                    window.location.href = baseURL + "crmadmin/product/display_product_list/" + $('#pagenames').val();
                    } else{
                    $("#popup_error").html(data);
                            $("#popup_error").show();
                    }
                    }
            });
    }
</script>
