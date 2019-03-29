<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
    <div class="grid_container">
        <div class="grid_12">
            <div class="widget_wrap">
                <div class="widget_top">
                    <span class="h_icon list"></span>
                    <h6>Add New News</h6>
                </div>
                <div class="widget_content">
                    <?php
                    $attributes = array('class' => 'form_container left_label', 'id' => 'addsourcer_form', 'enctype' => 'multipart/form-data');
                    echo form_open_multipart('admin/news/insertEditNews', $attributes)
                    ?>
                    <ul>
                        <li>
                            <div class="form_grid_12">
                                <label class="field_title" for="s_email">News Title<span class="req">*</span></label>
                                <div class="form_input">
                                    <input name="newstitle" id="newstitle" type="text" tabindex="1" class="large tipTop" title="Please enter the news title"/>
                                    <div id="s_email_warn"  style="float:right; color:#FF0000;"></div>
                                </div>

                            </div>
                        </li>
                        <li>
                            <div class="form_grid_12">
                                <label class="field_title" for="full_remarks">News Description</label>
                                <div class="form_input">
                                    <textarea name="newsdescription" id="newsdescription" tabindex="2" style="width:370px;" class="tipTop mceEditor" title="Please enter the news description"></textarea>
                                    <div id="s_desc_warn"  style="float:right; color:#FF0000;"></div>
                                </div>
                            </div>
                        </li>
                        
                        <li>
                            <div class="form_grid_12">
                                <label class="field_title" for="image">News Image<span class="req">*</span></label>
                                <div class="form_input">
                                    <input name="newsimage" id="newsimage" type="file" tabindex="7" class="required large tipTop" title="Please select slider image"/><br /><br />
                                    <div id="image_warn"  style="float:right; color:#FF0000;"></div>
                                </div>
                            </div>
                        </li>
                        
                        <li>
                            <div class="form_grid_12">
                                <label class="field_title" for="admin_name">Status <span class="req">*</span></label>
                                <div class="form_input">
                                    <div class="active_inactive">
                                        <input type="checkbox" tabindex="8" name="status" checked="checked" id="status" class="active_inactive"/>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="form_grid_12">
                                <div class="form_input">
                                    <button type="button" class="btn_small btn_blue" tabindex="9" onclick="addsourcerVal();"><span>Submit</span></button>
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
    function addsourcerVal() {
        if (jQuery.trim($("#newstitle").val()) == '') {
            $("#s_email_warn").html('');
            $("#s_email_warn").html('News Title is Required');
            $("#s_email").focus();
            return false;
        }
        else
        {
            $("#addsourcer_form").submit();
            return true;
        }
    }
</script>
<?php
$this->load->view('admin/templates/footer.php');
?>