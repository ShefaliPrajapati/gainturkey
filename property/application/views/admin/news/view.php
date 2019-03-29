<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
    <div class="grid_container">
        <div class="grid_12">
            <div class="widget_wrap">
                <div class="widget_top">
                    <span class="h_icon list"></span>
                    <h6>View news Details</h6>
                    <div id="widget_tab">
                        <ul>
                            <li><a href="#tab1" class="active_tab">Details</a></li>
                        </ul>
                    </div>
                </div>
                <div class="widget_content">
                    <?php
                    $attributes = array('class' => 'form_container left_label');
                    echo form_open('admin', $attributes)
                    ?>
                    <div id="tab1">
                        <ul>
                            <li>
                                <div class="form_grid_12">
                                    <label class="field_title">News Image</label>
                                    <div class="form_input">
                                        <?php if ($news_details->row()->news_image == '') { ?>
                                            <img src="<?php echo base_url(); ?>images/users/user-thumb1.png" width="100px"/>
                                        <?php } else { ?>
                                            <img src="<?php echo base_url(); ?>images/news/<?php echo $news_details->row()->news_image; ?>" width="100px"/>
                                        <?php } ?>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="form_grid_12">
                                    <label class="field_title">News Title</label>
                                    <div class="form_input">
                                        <?php echo $news_details->row()->news_title; ?>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="form_grid_12">
                                    <label class="field_title">News Status</label>
                                    <div class="form_input">
                                        <?php echo $news_details->row()->status; ?>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="form_grid_12">
                                    <label class="field_title" for="slider_desc">News Description</label>
                                    <div class="form_input">
                                        <?php echo $news_details->row()->news_description; ?>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="form_grid_12">
                                    <label class="field_title" for="slider_desc">Creation Date & Time</label>
                                    <div class="form_input">
                                        <?php
                                        echo $news_details->row()->creation_date;
                                        ?>
                                    </div>
                                </div>
                            </li>
                            
                            <li>
                                <div class="form_grid_12">
                                    <div class="form_input">
                                        <a href="admin/news/newsList" class="tipLeft" title="Go to news list"><span class="badge_style b_done">Back</span></a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <span class="clear"></span>
    </div>
</div>
<?php
$this->load->view('admin/templates/footer.php');
?>