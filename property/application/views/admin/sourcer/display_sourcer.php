<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
    <div class="grid_container">
        <?php
        $attributes = array('id' => 'display_form');
        echo form_open('admin/sourcer/change_sourcer_status_global', $attributes)
        ?>
        <div class="grid_12">
            <div class="widget_wrap">
                <div class="widget_top">
                    <span class="h_icon blocks_images"></span>
                    <h6><?php echo $heading ?></h6>
                    <div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
                        <?php if ($allPrev == '1' || in_array('2', $user)) { ?>
                            <div class="btn_30_light" style="height: 29px;">
                                <a href="<?php echo base_url();?>admin/sourcer/add_sourcer_form" class="tipTop" title="Add new sourcer "><span class="icon add_co"></span><span class="btn_link">Add</span></a>
                            </div>
                            <div class="btn_30_light" style="height: 29px;">
                                <a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Active', '<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to active records"><span class="icon accept_co"></span><span class="btn_link">Active</span></a>
                            </div>
                            <div class="btn_30_light" style="height: 29px;">
                                <a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Inactive', '<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to inactive records"><span class="icon delete_co"></span><span class="btn_link">Inactive</span></a>
                            </div>
                            <?php
                        }
                        if ($allPrev == '1' || in_array('3', $sourcer)) {
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
                                    Sourcer Email			
                                </th>
                                <th class="tip_top" title="Click to sort">
                                    Sourcer Name
                                </th>

                                <th class="tip_top" title="Click to sort">
                                    Sourcer Address
                                </th>
                                <th class="tip_top" title="Click to sort">
                                    Sourcer City
                                </th>
                                <th class="tip_top" title="Click to sort">
                                    Sourcer State
                                </th>
                                <th class="tip_top" title="Click to sort">
                                    Sourcer Zipcode
                                </th>
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
                            if ($sourcerList->num_rows() > 0) {
                                foreach ($sourcerList->result() as $row) {
                                    ?>
                                    <tr>
                                        <td class="center tr_select ">
                                            <input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id; ?>">
                                        </td>
                                        <td class="center">
                                            <?php echo $row->s_email; ?>
                                        </td>
                                        <td class="center">
                                            <?php echo $row->s_first_name . ' ' . $row->s_last_name; ?>
                                        </td>

                                        <td class="center">
                                            <?php echo $row->s_address; ?>
                                        </td>
                                        <td class="center">
                                            <?php echo $row->s_city; ?>
                                        </td>
                                        <td class="center">
                                            <?php echo $row->s_state; ?>
                                        </td>
                                        <td class="center">
                                            <?php echo $row->s_zipcode; ?>
                                        </td>

                                        <td class="center">
                                            <?php
                                            if ($allPrev == '1' || in_array('2', $sourcer)) {
                                                $mode = ($row->status == 'Active') ? '0' : '1';
                                                if ($mode == '0') {
                                                    ?>
                                                    <a title="Click to inactive" class="tip_top" href="javascript:confirm_status('admin/sourcer/change_sourcer_status/<?php echo $mode; ?>/<?php echo $row->id; ?>');"><span class="badge_style b_done"><?php echo $row->status; ?></span></a>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <a title="Click to active" class="tip_top" href="javascript:confirm_status('admin/sourcer/change_sourcer_status/<?php echo $mode; ?>/<?php echo $row->id; ?>')"><span class="badge_style"><?php echo $row->status; ?></span></a>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <span class="badge_style b_done"><?php echo $row->status; ?></span>
                                            <?php } ?>
                                        </td>

                                        <td class="center">
                                            <?php if ($allPrev == '1' || in_array('2', $sourcer)) { ?>
                                                <span><a class="action-icons c-edit" href="admin/sourcer/edit_sourcer_form/<?php echo $row->id; ?>" title="Edit">Edit</a></span>
                                            <?php } ?>
                                            <span><a class="action-icons c-suspend" href="admin/sourcer/view_sourcer/<?php echo $row->id; ?>" title="View">View</a></span>
                                            <?php if ($allPrev == '1' || in_array('3', $sourcer)) { ?>	
                                                <span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/sourcer/delete_sourcer/<?php echo $row->id; ?>')" title="Delete">Delete</a></span>
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
                                    Sourcer Email						
                                </th>
                                <th>
                                    Sourcer Name
                                </th>
                                <th>
                                    Sourcer Address
                                </th>
                                <th>
                                    Sourcer City
                                </th>
                                <th>
                                    Sourcer State
                                </th>
                                <th>
                                    Sourcer Zipcode
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