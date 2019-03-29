<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
    <div class="grid_container">
        <?php
        $attributes = array('id' => 'display_form');
        echo form_open('admin/news/change_news_status_global', $attributes)
        ?>
        <div class="grid_12">
            <div class="widget_wrap">
                <div class="widget_top">
                    <span class="h_icon blocks_images"></span>
                    <h6><?php echo $heading ?></h6>
                    <div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
                        <?php if ($allPrev == '1' || in_array('2', $user)) { ?>
                            <div class="btn_30_light" style="height: 29px;">
                                <a href="<?php echo base_url();?>admin/news/add_news_form" class="tipTop" title="Add new news "><span class="icon add_co"></span><span class="btn_link">Add</span></a>
                            </div>
                            <div class="btn_30_light" style="height: 29px;">
                                <a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Active', '<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to active records"><span class="icon accept_co"></span><span class="btn_link">Active</span></a>
                            </div>
                            <div class="btn_30_light" style="height: 29px;">
                                <a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Inactive', '<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to inactive records"><span class="icon delete_co"></span><span class="btn_link">Inactive</span></a>
                            </div>
                            <?php
                        }
                        if ($allPrev == '1' || in_array('3', $news)) {
                            ?>
                            <div class="btn_30_light" style="height: 29px;">
                                <a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete', '<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="widget_content">
                    <table class="display" id="newsletter_tbl" >
                        <thead>
                            <tr>
                                <th class="center">
                                    <input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
                                </th>
                                <th class="tip_top" title="Click to sort">
                                    News Image			
                                </th>
                                <th class="tip_top" title="Click to sort">
                                    News Title
                                </th>
                                <th class="tip_top" title="Click to sort">
                                    Status
                                </th>

                                <th class="tip_top" title="Click to sort">
                                    Creation Date & Time
                                </th>

                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($newsList->num_rows() > 0) {
                                foreach ($newsList->result() as $row) {
                                    ?>
                                    <tr>
                                        <td class="center tr_select ">
                                            <input name="checkbox_id[]" type="checkbox" value="<?php echo $row->news_id; ?>">
                                        </td>
                                        <td class="center">
                                            <img height="40px" width="40px" src="<?php base_url(); ?>images/news/<?php echo $row->news_image; ?>"></img>
                                        </td>
                                        <td class="center">
                                            <?php echo $row->news_title; ?>
                                        </td>
                                        <td class="center">
                                            <?php
                                            if ($allPrev == '1' || in_array('2', $news)) {
                                                $mode = ($row->status == 'Active') ? '0' : '1';
                                                if ($mode == '0') {
                                                    ?>
                                                    <a title="Click to inactive" class="tip_top" href="javascript:confirm_status('admin/news/change_news_status/<?php echo $mode; ?>/<?php echo $row->news_id; ?>');"><span class="badge_style b_done"><?php echo $row->status; ?></span></a>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <a title="Click to active" class="tip_top" href="javascript:confirm_status('admin/news/change_news_status/<?php echo $mode; ?>/<?php echo $row->news_id; ?>')"><span class="badge_style"><?php echo $row->status; ?></span></a>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <span class="badge_style b_done"><?php echo $row->status; ?></span>
                                            <?php } ?>
                                        </td>

                                        <td class="center">
                                            <?php echo $row->creation_date; ?>
                                        </td>

                                        <td class="center">
                                            <?php if ($allPrev == '1' || in_array('2', $sourcer)) { ?>
                                                <span><a class="action-icons c-edit" href="admin/news/edit_news_form/<?php echo $row->news_id; ?>" title="Edit">Edit</a></span>
                                            <?php } ?>
                                            <span><a class="action-icons c-suspend" href="admin/news/view_news/<?php echo $row->news_id; ?>" title="View">View</a></span>
                                            <?php if ($allPrev == '1' || in_array('3', $sourcer)) { ?>	
                                                <span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/news/delete_news/<?php echo $row->news_id; ?>')" title="Delete">Delete</a></span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
<!--                        <tfoot>
                            <tr>
                                <th class="center">
                                    <input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
                                </th>
                                <th>
                                    News Image						
                                </th>
                                <th>
                                    News Title
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    Creation Date & Time
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </tfoot>-->
                    </table>
                </div>
            </div>
        </div>
        <input type="hidden" name="statusMode" id="statusMode"/>
        <input type="hidden" name="SubAdminEmail" id="SubAdminEmail"/>
        </form>	

    </div>
    <span class="clear"></span>
</div>
</div>
<?php
$this->load->view('admin/templates/footer.php');
?>