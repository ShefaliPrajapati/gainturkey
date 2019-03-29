<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
    <div class="grid_container">
        <div class="grid_12">
            <div class="widget_wrap">
                <div class="widget_top">
                    <span class="h_icon list"></span>
                    <h6>Add New Slider</h6>
                </div>
                <div class="widget_content">
                    <?php
                    $attributes = array('class' => 'form_container left_label', 'id' => 'addslider_form', 'enctype' => 'multipart/form-data');
                    echo form_open_multipart('admin/slider/insertEditSlider', $attributes)
                    ?>
                    <ul>
                        <li>
                            <div class="form_grid_12">
                                <label class="field_title" for="slider_name">Slider Name <span class="req">*</span></label>
                                <div class="form_input">
                                    <input name="slider_name" id="slider_name" type="text" tabindex="1" class="required large tipTop" title="Please enter the slider name"/>
                                    <div id="slider_name_warn"  style="float:right; color:#FF0000;"></div>
                                </div>

                            </div>

                        </li>
                        <li>
                            <div class="form_grid_12">
                                <label class="field_title" for="slider_title">Slider Title <span class="req">*</span></label>
                                <div class="form_input">
                                    <input name="slider_title" id="slider_title" type="text" tabindex="2" class="required large tipTop" title="Please enter the slider title"/>
                                    <div id="slider_title_warn"  style="float:right; color:#FF0000;"></div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="form_grid_12">
                                <label class="field_title" for="slider_link">Slider Link</label>
                                <div class="form_input">
                                    <input name="slider_link" id="slider_link" type="text" tabindex="2" class=" large tipTop" title="Please enter the slider link"/>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="form_grid_12">
                                <label class="field_title" for="slider_desc">Slider Description </label>
                                <div class="form_input">
                                    <textarea name="slider_desc" id="slider_desc" class=" large tipTop" title="Please enter the slider description"></textarea>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="form_grid_12">
                                <label class="field_title" for="image">Slider Image<span class="req">*</span></label>
                                <div class="form_input">
                                    <input name="sliderimage" id="sliderimage" type="file" tabindex="7" class="required large tipTop" title="Please select slider image"/><br /><br />
                                    Note: Please upload images of size 1349 * 644 only, For better viewing 
                                    <div id="image_warn"  style="float:right; color:#FF0000;"></div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="form_grid_12">
                                <label class="field_title" for="admin_name">Status </label>
                                <div class="form_input">
                                    <div class="active_inactive">
                                        <input type="checkbox" tabindex="8" name="status" checked="checked" id="status" class="active_inactive"/>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="form_grid_12">
                                <label class="field_title" for="admin_name">Site </label>
                                <div class="form_input">
                                    <div class="active_inactive">
                                        <input type="radio" tabindex="11" name="site" id="site" class="publish_unpublish" value="main" /> returnonrentals.com
                                        <input type="radio" tabindex="11" name="site" id="site" class="publish_unpublish" value="sub" /> preigrentals.com

                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="form_grid_12">
                                <div class="form_input">
                                    <button type="submit" class="btn_small btn_blue" tabindex="9"><span>Submit</span></button>
                                </div>
                            </div>
                        </li>
                    </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <span class="clear"></span>
</div>
</div>

<script type="text/javascript">
    $(function () {
        $("#addslider_form").submit(function () {
            // var email = $('#vendor_email').val();
            //alert('');
            if (jQuery.trim($("#slider_name").val()) == '')
            {
                $("#slider_name_warn").html('');
                $("#slider_name_warn").html('Slider name is required');
                $("#slider_name").focus();
                return false;

            } else if (jQuery.trim($("#slider_title").val()) == '') {
                $("#slider_title_warn").html('');
                $("#slider_title_warn").html('Slider title is required');
                $("#slider_title").focus();
                return false;

            } else if (jQuery.trim($("#sliderimage").val()) == '') {
                $("#image_warn").html('');
                $("#image_warn").html('Please upload a image');
                $("#image").focus();
                return false;

            } else
            {
                $("#addslider_form").submit();
            }

            return false;
        });
    });


    function removeError(idval) {
        $("#" + idval + "_warn").html('');
    }
</script>
<?php
$this->load->view('admin/templates/footer.php');
?>