<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
    <div class="grid_container">
        <?php
        $attributes = array('id' => 'display_form');
        echo form_open('admin/video/change_video_status_global', $attributes)
        ?>
        <div class="grid_12">
            <div class="widget_wrap">
                <div class="widget_top">
                    <span class="h_icon blocks_images"></span>
                    <h6><?php echo $heading ?></h6>
                    <div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
                        <?php if ($allPrev == '1' || in_array('2', $user)) { ?>
                            <div class="btn_30_light" style="height: 29px;">
                                <a href="<?php echo base_url();?>admin/video/add_video_form" class="tipTop" title="Add video "><span class="icon add_co"></span><span class="btn_link">Add</span></a>
                            </div>
                            <div class="btn_30_light" style="height: 29px;">
                                <a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Active', '<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to active records"><span class="icon accept_co"></span><span class="btn_link">Active</span></a>
                            </div>
                            <div class="btn_30_light" style="height: 29px;">
                                <a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Inactive', '<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to inactive records"><span class="icon delete_co"></span><span class="btn_link">Inactive</span></a>
                            </div>
                            <?php
                        }
                        if ($allPrev == '1' || in_array('3', $video)) {
                            ?>
                            <div class="btn_30_light" style="height: 29px;">
                                <a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete', '<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="widget_content">
                    <table class="display" id="newsletter_tbl">
                        <thead>
                            <tr>
                                <th class="center">
                                    <input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
                                </th>
                                <th class="tip_top" title="Click to sort">
                                    Video Name			
                                </th>
                                <th class="tip_top" title="Click to sort">
                                    Video Link
                                </th>
                                <!--
                                                    <th>
                                                            Video Image
                                                    </th>-->
                                <th class="tip_top" title="Click to sort">
                                    Status
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($videoList->num_rows() > 0) {
                                foreach ($videoList->result() as $row) {
                                    ?>
                                    <tr>
                                        <td class="center tr_select ">
                                            <input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id; ?>">
                                        </td>
                                        <td class="center">
                                            <?php echo $row->video_name; ?>
                                        </td>
                                        <td class="center">
                                            <?php echo $row->video_link; ?>
                                        </td>

        <!--<td class="center">
        <div class="widget_thumb">
                                        <?php if ($row->image != '') { ?>
                     <img width="40px" height="40px" src="<?php echo base_url(); ?>images/video/<?php echo $row->image; ?>" />
                                        <?php } else { ?>
                     <img width="40px" height="40px" src="<?php echo base_url(); ?>images/common/dummyProductImage.jpg" />
                                        <?php } ?>
        </div>
        </td>-->

                                        <td class="center">
                                            <?php
                                            if ($allPrev == '1' || in_array('2', $video)) {
                                                $mode = ($row->status == 'Active') ? '0' : '1';
                                                if ($mode == '0') {
                                                    ?>
                                                    <a title="Click to inactive" class="tip_top" href="javascript:confirm_status('admin/video/change_video_status/<?php echo $mode; ?>/<?php echo $row->id; ?>');"><span class="badge_style b_done"><?php echo $row->status; ?></span></a>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <a title="Click to active" class="tip_top" href="javascript:confirm_status('admin/video/change_video_status/<?php echo $mode; ?>/<?php echo $row->id; ?>')"><span class="badge_style"><?php echo $row->status; ?></span></a>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <span class="badge_style b_done"><?php echo $row->status; ?></span>
                                            <?php } ?>
                                        </td>
                                        <td class="center">
                                            <?php if ($allPrev == '1' || in_array('2', $video)) { ?>
                                                <span><a class="action-icons c-edit" href="admin/video/edit_video_form/<?php echo $row->id; ?>" title="Edit">Edit</a></span>
                                            <?php } ?>
                                            <span><a class="action-icons c-suspend" href="admin/video/view_video/<?php echo $row->id; ?>" title="View">View</a></span>
                                            <?php if ($allPrev == '1' || in_array('3', $video)) { ?>	
                                                <span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/video/delete_video/<?php echo $row->id; ?>')" title="Delete">Delete</a></span>
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
                                    Video Name						
                                </th>
                                <th>
                                    Video Link
                                </th>
                                                            <th>
                                                                    Video Image
                                                            </th>
                                <th class="tip_top" title="Click to sort">
                                    Status
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